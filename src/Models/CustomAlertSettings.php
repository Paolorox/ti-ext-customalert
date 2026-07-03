<?php

declare(strict_types=1);

namespace Paolorox\CustomAlert\Models;

use Igniter\Flame\Database\Model;
use Igniter\System\Actions\SettingsModel;

class CustomAlertSettings extends Model
{
    public array $implement = [SettingsModel::class];

    public string $settingsCode = 'paolorox_customalert_settings';

    public string $settingsFieldsConfig = 'customalertsettings';

    public static function getConfigHash(): string
    {
        $title = (string) self::get('title', '');
        $message = (string) self::get('message', '');
        $buttons = self::get('buttons', []);

        return md5($title . $message . json_encode($buttons));
    }

    public static function isEnabled(): bool
    {
        return (bool) self::get('is_enabled', false);
    }
}
