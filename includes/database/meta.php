<?php

namespace EasyBooking\Database;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Meta extends MetaBase{
    public static function init(){
        $self = new self();
        add_action('init', [$self, 'register_service_meta']);
    }

    public function register_service_meta(){
        $meta = [
            EASYBOOKING_DB_PREFIX . '_future_days' => 'integer',
            EASYBOOKING_DB_PREFIX . '_availability_id' => 'integer'
        ];

        $this->register_meta(EASYBOOKING_SERVICE_POST_TYPE, $meta);

        register_post_meta(EASYBOOKING_SERVICE_POST_TYPE, EASYBOOKING_DB_PREFIX . '_gallery', [
            'type' => 'array', 
            'single' => true,
            'show_in_rest' => [
                'schema' => [
                    'type' => 'array',
                    'items' => [
                        'type' => 'integer'
                    ]
                ]
            ]
        ]);

        register_post_meta(EASYBOOKING_SERVICE_POST_TYPE, EASYBOOKING_DB_PREFIX . '_service_duration', [
            'type' => 'object',
            'single' => true,
            'show_in_rest' => [
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'value' => [
                            'type' => 'integer'
                        ],
                        'unit' => [
                            'type' => 'string'
                        ]
                    ]
                ]
            ]
        ]);

        register_post_meta(EASYBOOKING_SERVICE_POST_TYPE, EASYBOOKING_DB_PREFIX . '_booking_quantity', [
            'type' => 'object',
            'single' => true,
            'show_in_rest' => [
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'max' => [
                            'type' => 'integer'
                        ],
                        'min' => [
                            'type' => 'integer'
                        ]
                    ]
                ]
            ]
        ]);

        register_post_meta(EASYBOOKING_SERVICE_POST_TYPE, EASYBOOKING_DB_PREFIX . 'booking_can_cancel', [
            'type' => 'object',
            'single' => true,
            'show_in_rest' => [
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'value' => [
                            'type' => 'integer'
                        ],
                        'unit' => [
                            'type' => 'string'
                        ]
                    ]
                ]
            ]
        ]);

        register_post_meta(EASYBOOKING_SERVICE_POST_TYPE, EASYBOOKING_DB_PREFIX . '_date_rage', [
            'type' => 'object',
            'single' => true,
            'show_in_rest' => [
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'start_date' => [
                            'type' => 'string'
                        ],
                        'end_date' => [
                            'type' => 'string'
                        ]
                    ]
                ]
            ]
        ]);

        register_post_meta(EASYBOOKING_SERVICE_POST_TYPE, EASYBOOKING_DB_PREFIX . '_custom_availability', [
            'type' => 'object',
            'single' => true,
            'show_in_rest' => [
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'timezone' => [
                            'type' => 'string'
                        ],
                        'mon' => $this->day_schema(),
                        'tue' => $this->day_schema(),
                        'wed' => $this->day_schema(),
                        'thu' => $this->day_schema(),
                        'fri' => $this->day_schema(),
                        'sat' => $this->day_schema(),
                        'sun' => $this->day_schema(),
                    ]
                ]
            ]
        ]);

        register_post_meta(EASYBOOKING_SERVICE_POST_TYPE, EASYBOOKING_DB_PREFIX . '_limit_booking_frequency', [
            'type' => 'array',
            'single' => true,
            'show_in_rest' => [
                'schema' => [
                    'type' => 'array',
                    'items' => [
                        'type' => 'object',
                        'properties' => [
                            'value' => [
                                'type' => 'integer'
                            ],
                            'unit' => [
                                'type' => 'string'
                            ]
                        ]
                    ]
                ]
            ]
        ]);

    }

    public function day_schema(){
        return [
            'type' => 'object',
            'properties' => [
                'is_enable' => [
                    'type' => 'boolean'
                ],
                'slots' => [
                    'type' => 'array',
                    'items' => [
                        'type' => 'object',
                        'properties' => [
                            'start_time' => [
                                'type' => 'string'
                            ],
                            'end_time' => [
                                'type' => 'string'
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

}