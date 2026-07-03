<?php

declare(strict_types=1);

namespace Paolorox\CustomAlert\Models;

use Igniter\Flame\Database\Model;
use Igniter\User\Models\Customer;

class CustomAlertLog extends Model
{
    protected $table = 'paolorox_customalert_logs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_id',
        'session_id',
        'ip_address',
        'user_agent',
        'config_hash',
        'status',
        'button_clicked',
    ];

    public $relation = [
        'belongsTo' => [
            'customer' => [Customer::class, 'foreignKey' => 'customer_id'],
        ],
    ];

    public $timestamps = true;
}
