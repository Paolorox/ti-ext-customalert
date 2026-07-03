<?php

declare(strict_types=1);

namespace Paolorox\CustomAlert\Http\Middleware;

use Closure;
use Paolorox\CustomAlert\Models\CustomAlertLog;
use Paolorox\CustomAlert\Models\CustomAlertSettings;
use Igniter\Flame\Support\Facades\Igniter;
use Igniter\User\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InjectCustomAlert
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (
            app()->runningInConsole() ||
            Igniter::runningInAdmin() ||
            $request->ajax() ||
            !$request->isMethod('GET') ||
            !CustomAlertSettings::isEnabled()
        ) {
            return $response;
        }

        if (!($response instanceof Response) || !str_contains((string)$response->headers->get('Content-Type'), 'text/html')) {
            return $response;
        }

        $configHash = CustomAlertSettings::getConfigHash();
        $cookieName = 'paolorox_customalert_dismissed';

        if ($request->cookies->get($cookieName) === $configHash) {
            return $response;
        }

        $customer = Auth::customer();

        if ($customer) {
            $hasDismissed = CustomAlertLog::query()
                ->where('customer_id', $customer->customer_id)
                ->where('config_hash', $configHash)
                ->where('status', 'dismissed')
                ->exists();

            if ($hasDismissed) {
                cookie()->queue(cookie()->forever($cookieName, $configHash));
                return $response;
            }
        }

        $sessionId = session()->getId();
        $logQuery = CustomAlertLog::query()->where('config_hash', $configHash);

        if ($customer) {
            $logQuery->where(function ($query) use ($customer, $sessionId) {
                $query->where('customer_id', $customer->customer_id)
                      ->orWhere('session_id', $sessionId);
            });
        } else {
            $logQuery->where('session_id', $sessionId);
        }

        $logExists = $logQuery->exists();

        if (!$logExists) {
            CustomAlertLog::create([
                'customer_id' => $customer ? $customer->customer_id : null,
                'session_id' => $sessionId,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'config_hash' => $configHash,
                'status' => 'shown',
            ]);
        }

        $popupHtml = view('paolorox.customalert::customalert.popup', [
            'title' => CustomAlertSettings::get('title', 'Avviso'),
            'message' => CustomAlertSettings::get('message', ''),
            'popupTheme' => CustomAlertSettings::get('theme', 'dark_glass'),
            'backdrop_blur' => CustomAlertSettings::get('backdrop_blur', 'medium'),
            'buttons' => CustomAlertSettings::get('buttons', []),
            'config_hash' => $configHash,
        ])->render();

        $content = $response->getContent();
        $pos = strripos($content, '</body>');
        if ($pos !== false) {
            $content = substr($content, 0, $pos) . $popupHtml . substr($content, $pos);
            $response->setContent($content);
        }

        return $response;
    }
}
