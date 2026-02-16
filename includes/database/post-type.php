<?php

namespace EasyBooking\Database;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PostType{
    public static function init(){
        $self = new self();
        add_action('init', [$self, 'register_post']);
    }

    public function register_post(){
        register_post_type(EASYBOOKING_SERVICE_POST_TYPE, [
            'labels' => [
                'name' => esc_html__('Services', 'easybooking'),
                'singular_name' => esc_html__('Service', 'easybooking'),
                'add_new_item' => esc_html__('Add new service', 'easybooking'),
                'edit_item' => esc_html__('Edit service item', 'easybooking'),
                'view_item' => esc_html__('View item', 'easybooking')
            ],
            'public' => true,
            'show_ui' => false,
            'supports' => ['title', 'content'],
            'has_archive' => true,
            'show_in_menu' => false,
            'show_in_rest' => true,
            'rest_base' => EASYBOOKING_SERVICE_POST_TYPE,
            'rest_namespace' => EASYBOOKING_PLUGIN_SLUG . '/v1',
            'rest_controller_class' => 'WP_REST_Post_Controller'
        ]);
    }
}