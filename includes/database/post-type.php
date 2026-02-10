<?php

namespace CarBooking\Database;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PostType{
    public static function init(){
        $self = new self();
        add_action('init', [$self, 'register_post']);
    }

    public function register_post(){
        register_post_type(CARBOOKING_SERVICE_POST_TYPE, [
            'labels' => [
                'name' => esc_html__('Services', 'carbooking'),
                'singular_name' => esc_html__('Service', 'carbooking'),
                'add_new_item' => esc_html__('Add new service', 'carbooking'),
                'edit_item' => esc_html__('Edit service item', 'carbooking'),
                'view_item' => esc_html__('View item', 'carbooking')
            ],
            'public' => true,
            'show_ui' => false,
            'supports' => ['title', 'content'],
            'has_archive' => true,
            'show_in_menu' => false,
            'show_in_rest' => true,
            'rest_base' => CARBOOKING_SERVICE_POST_TYPE,
            'rest_namespace' => CARBOOKING_PLUGIN_SLUG . '/v1',
            'rest_controller_class' => 'WP_REST_Post_Controller'
        ]);
    }
}