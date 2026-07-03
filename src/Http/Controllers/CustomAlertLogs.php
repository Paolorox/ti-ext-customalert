<?php

declare(strict_types=1);

namespace Paolorox\CustomAlert\Http\Controllers;

use Igniter\Admin\Classes\AdminController;
use Igniter\Admin\Facades\AdminMenu;
use Igniter\Admin\Http\Actions\ListController;
use Paolorox\CustomAlert\Models\CustomAlertLog;

class CustomAlertLogs extends AdminController
{
    public array $implement = [
        ListController::class,
    ];

    public array $listConfig = [
        'list' => [
            'model' => CustomAlertLog::class,
            'title' => 'Custom Alert Logs',
            'emptyMessage' => 'No logs found.',
            'defaultSort' => ['id', 'DESC'],
            'configFile' => 'customalertlog',
        ],
    ];

    protected null|string|array $requiredPermissions = 'Paolorox.CustomAlert.Manage';

    public static function getSlug(): string
    {
        return 'paolorox/customalert/customalertlogs';
    }

    public function __construct()
    {
        parent::__construct();

        AdminMenu::setContext('tools', 'customalertlogs');
    }
}
