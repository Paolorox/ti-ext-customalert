<?php

use Paolorox\CustomAlert\Models\CustomAlertLog;
use Igniter\User\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/customalert/log-interaction', function () {
    $configHash = request()->input('config_hash');
    $buttonClicked = request()->input('button_clicked');
    $status = request()->input('status', 'dismissed');

    if (empty($configHash)) {
        return response()->json(['error' => 'Config hash required'], 400);
    }

    $customer = Auth::customer();
    $sessionId = session()->getId();

    $logQuery = CustomAlertLog::query()
        ->where('config_hash', $configHash);

    if ($customer) {
        $logQuery->where(function ($query) use ($customer, $sessionId) {
            $query->where('customer_id', $customer->customer_id)
                  ->orWhere('session_id', $sessionId);
        });
    } else {
        $logQuery->where('session_id', $sessionId);
    }

    $log = $logQuery->first();

    if ($log) {
        $log->update([
            'status' => $status,
            'button_clicked' => $buttonClicked,
        ]);
    } else {
        CustomAlertLog::create([
            'customer_id' => $customer ? $customer->customer_id : null,
            'session_id' => $sessionId,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'config_hash' => $configHash,
            'status' => $status,
            'button_clicked' => $buttonClicked,
        ]);
    }

    return response()->json(['success' => true]);
})->middleware('web');
