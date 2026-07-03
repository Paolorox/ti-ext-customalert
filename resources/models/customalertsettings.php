<?php

return [
    'form' => [
        'toolbar' => [
            'buttons' => [
                'save' => [
                    'label' => 'lang:admin::lang.button_save',
                    'class' => 'btn btn-primary',
                    'data-request' => 'onSave',
                ],
                'saveClose' => [
                    'label' => 'lang:admin::lang.button_save_close',
                    'class' => 'btn btn-default',
                    'data-request' => 'onSave',
                    'data-request-data' => 'close:1',
                ],
            ],
        ],
        'fields' => [
            'is_enabled' => [
                'label' => 'lang:paolorox.customalert::default.label_enabled',
                'type' => 'switch',
                'span' => 'left',
                'default' => false,
                'comment' => 'lang:paolorox.customalert::default.help_enabled',
            ],
            'theme' => [
                'label' => 'lang:paolorox.customalert::default.label_theme',
                'type' => 'select',
                'span' => 'right',
                'default' => 'dark_glass',
                'options' => [
                    'dark_glass' => 'lang:paolorox.customalert::default.theme_dark_glass',
                    'light_glass' => 'lang:paolorox.customalert::default.theme_light_glass',
                    'minimal_light' => 'lang:paolorox.customalert::default.theme_minimal_light',
                    'vibrant_aurora' => 'lang:paolorox.customalert::default.theme_vibrant_aurora',
                ],
                'comment' => 'lang:paolorox.customalert::default.help_theme',
            ],
            'title' => [
                'label' => 'lang:paolorox.customalert::default.label_title',
                'type' => 'text',
                'span' => 'left',
                'default' => 'Avviso Importante',
                'comment' => 'lang:paolorox.customalert::default.help_title',
            ],
            'backdrop_blur' => [
                'label' => 'lang:paolorox.customalert::default.label_backdrop_blur',
                'type' => 'select',
                'span' => 'right',
                'default' => 'medium',
                'options' => [
                    'none' => 'lang:paolorox.customalert::default.blur_none',
                    'low' => 'lang:paolorox.customalert::default.blur_low',
                    'medium' => 'lang:paolorox.customalert::default.blur_medium',
                    'high' => 'lang:paolorox.customalert::default.blur_high',
                ],
                'comment' => 'lang:paolorox.customalert::default.help_backdrop_blur',
            ],
            'message' => [
                'label' => 'lang:paolorox.customalert::default.label_message',
                'type' => 'richeditor',
                'span' => 'full',
                'comment' => 'lang:paolorox.customalert::default.help_message',
            ],
            'buttons' => [
                'label' => 'lang:paolorox.customalert::default.label_buttons',
                'type' => 'repeater',
                'span' => 'full',
                'sortable' => true,
                'commentAbove' => 'lang:paolorox.customalert::default.help_buttons',
                'form' => [
                    'fields' => [
                        'text' => [
                            'label' => 'lang:paolorox.customalert::default.label_button_text',
                            'type' => 'text',
                            'span' => 'left',
                        ],
                        'action' => [
                            'label' => 'lang:paolorox.customalert::default.label_button_action',
                            'type' => 'select',
                            'span' => 'right',
                            'default' => 'close',
                            'options' => [
                                'close' => 'lang:paolorox.customalert::default.action_close',
                                'link' => 'lang:paolorox.customalert::default.action_link',
                            ],
                        ],
                        'link' => [
                            'label' => 'lang:paolorox.customalert::default.label_button_link',
                            'type' => 'text',
                            'span' => 'left',
                            'comment' => 'lang:paolorox.customalert::default.help_button_link',
                        ],
                        'style' => [
                            'label' => 'lang:paolorox.customalert::default.label_button_style',
                            'type' => 'select',
                            'span' => 'right',
                            'default' => 'primary',
                            'options' => [
                                'primary' => 'lang:paolorox.customalert::default.style_primary',
                                'secondary' => 'lang:paolorox.customalert::default.style_secondary',
                                'danger' => 'lang:paolorox.customalert::default.style_danger',
                                'outline' => 'lang:paolorox.customalert::default.style_outline',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'rules' => [
            ['is_enabled', 'lang:paolorox.customalert::default.label_enabled', 'required|boolean'],
            ['title', 'lang:paolorox.customalert::default.label_title', 'required|string|max:255'],
            ['message', 'lang:paolorox.customalert::default.label_message', 'required|string'],
            ['backdrop_blur', 'lang:paolorox.customalert::default.label_backdrop_blur', 'required|string'],
            ['theme', 'lang:paolorox.customalert::default.label_theme', 'required|string'],
            ['buttons.*.text', 'lang:paolorox.customalert::default.label_button_text', 'required|string|max:50'],
            ['buttons.*.action', 'lang:paolorox.customalert::default.label_button_action', 'required|string'],
            ['buttons.*.link', 'lang:paolorox.customalert::default.label_button_link', 'nullable|string'],
            ['buttons.*.style', 'lang:paolorox.customalert::default.label_button_style', 'required|string'],
        ],
    ],
];
