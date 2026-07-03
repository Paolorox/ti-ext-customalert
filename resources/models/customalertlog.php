<?php

return [
    'list' => [
        'filter' => [
            'search' => [
                'prompt' => 'lang:paolorox.customalert::default.text_filter_search',
                'mode' => 'all',
            ],
            'scopes' => [
                'date' => [
                    'label' => 'lang:igniter::admin.text_filter_date',
                    'type' => 'date',
                    'conditions' => 'YEAR(created_at) = :year AND MONTH(created_at) = :month AND DAY(created_at) = :day',
                ],
                'status' => [
                    'label' => 'lang:paolorox.customalert::default.label_status',
                    'type' => 'select',
                    'conditions' => 'status = :filtered',
                    'options' => [
                        'shown' => 'lang:paolorox.customalert::default.status_shown',
                        'dismissed' => 'lang:paolorox.customalert::default.status_dismissed',
                    ],
                ],
            ],
        ],
        'toolbar' => [
            'buttons' => [
                'delete' => [
                    'label' => 'lang:igniter::admin.button_delete',
                    'class' => 'btn btn-danger text-white',
                    'data-request' => 'onDelete',
                    'data-request-confirm' => 'lang:igniter::admin.alert_warning_confirm',
                ],
                'settings' => [
                    'label' => 'lang:paolorox.customalert::default.button_settings',
                    'class' => 'btn btn-default',
                    'href' => 'extensions/edit/paolorox/customalert/settings',
                ],
            ],
        ],
        'columns' => [
            'customer_name' => [
                'label' => 'lang:paolorox.customalert::default.column_customer',
                'relation' => 'customer',
                'select' => 'concat(first_name, " ", last_name)',
                'searchable' => true,
                'formatter' => function($record, $column, $value) {
                    return $value ?: 'Guest';
                },
            ],
            'ip_address' => [
                'label' => 'lang:paolorox.customalert::default.column_ip_address',
                'type' => 'text',
                'searchable' => true,
            ],
            'status' => [
                'label' => 'lang:paolorox.customalert::default.column_status',
                'type' => 'text',
                'formatter' => function($record, $column, $value) {
                    if ($value === 'dismissed') {
                        return '<span class="badge badge-success">'.lang('paolorox.customalert::default.status_dismissed').'</span>';
                    }
                    return '<span class="badge badge-warning">'.lang('paolorox.customalert::default.status_shown').'</span>';
                },
            ],
            'button_clicked' => [
                'label' => 'lang:paolorox.customalert::default.column_button_clicked',
                'type' => 'text',
                'formatter' => function($record, $column, $value) {
                    return $value ? '<code>'.e($value).'</code>' : '-';
                },
            ],
            'session_id' => [
                'label' => 'lang:paolorox.customalert::default.column_session_id',
                'type' => 'text',
                'searchable' => true,
            ],
            'created_at' => [
                'label' => 'lang:paolorox.customalert::default.column_date',
                'type' => 'text',
            ],
        ],
    ],
];
