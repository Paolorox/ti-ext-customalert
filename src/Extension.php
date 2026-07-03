<?php

declare(strict_types=1);

namespace Paolorox\CustomAlert;

use Paolorox\CustomAlert\Http\Middleware\InjectCustomAlert;
use Paolorox\CustomAlert\Models\CustomAlertSettings;
use Igniter\System\Classes\BaseExtension;
use Illuminate\Contracts\Http\Kernel;
use Override;

class Extension extends BaseExtension
{
    #[Override]
    public function register(): void
    {
        parent::register();
    }

    #[Override]
    public function boot(): void
    {
        $viewsDir = __DIR__.'/../resources/views';
        $langDir = __DIR__.'/../resources/lang';

        $this->loadViewsFrom($viewsDir, 'paolorox.customalert');
        $this->loadTranslationsFrom($langDir, 'paolorox.customalert');

        if (app()->bound('translator')) {
            app('translator')->addNamespace('paolorox.customalert', $langDir);
        }

        $this->app[Kernel::class]->pushMiddleware(InjectCustomAlert::class);
    }

    #[Override]
    public function registerPermissions(): array
    {
        return [
            'Paolorox.CustomAlert.Manage' => [
                'description' => 'Manage Custom Alert settings and view logs',
                'group' => 'igniter::admin.permissions.name',
            ],
        ];
    }

    #[Override]
    public function registerNavigation(): array
    {
        return [
            'tools' => [
                'child' => [
                    'customalertlogs' => [
                        'priority' => 12,
                        'class' => 'customalert-logs',
                        'href' => admin_url('paolorox/customalert/customalertlogs'),
                        'title' => 'Custom Alert Logs',
                        'permission' => 'Paolorox.CustomAlert.Manage',
                    ],
                ],
            ],
        ];
    }

    #[Override]
    public function registerSettings(): array
    {
        return [
            'settings' => [
                'priority' => 12,
                'label' => 'Custom Alert Settings',
                'description' => 'Configure the global fullscreen announcement popup',
                'icon' => 'fa fa-bell',
                'model' => CustomAlertSettings::class,
                'permissions' => ['Paolorox.CustomAlert.Manage'],
            ],
        ];
    }
}
