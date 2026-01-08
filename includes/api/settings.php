<?php

namespace CarBooking\API;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use WP_REST_Request;
use WP_REST_Server;
use Carbooking\Admin\Settings as BaseSettings;

class Settings{
    public static function init(){
        $self = new self();
        add_action('rest_api_init', [$self, 'register_routes']);
    }

    public function register_routes(){
        register_rest_route(CARBOOKING_PLUGIN_SLUG . '/v1' . '/settings', [
            'methods' => WP_REST_Server::READABLE,
            'callback' => [$this, 'get_items'],
            'permission_callback' => [$this, 'get_user_permission']
        ]);
    }

    public function get_items(WP_REST_Request $request){
        $settings = BaseSettings::get_save_data();
        if($settings){
            return rest_ensure_response($settings);
        }
        return rest_ensure_response([
            'message' => 'No Settings found'
        ], 404);
    }

    public function get_user_permission(){
        return current_user_can('manage_options');
    }
}