<?php

namespace EasyBooking\API;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use WP_REST_Request;
use EasyBooking\Classes\Availablity as AvailabilityQuery;

class Availability{
    protected $namespace = EASYBOOKING_PLUGIN_SLUG . '/v1';
    protected $rest_base = '/availability';

    public function register_routes(){
        register_rest_route($this->namespace, $this->rest_base, [
            [
                'methods' => 'GET',
                'callback' => [$this, 'get_item'],
                'permission_callback' => [$this, 'admin_only']
            ],
            [
                'methods' => 'POST',
                'callback' => [$this, 'create_item'],
                'permission_callback' => [$this, 'admin_only']
            ]
        ]);
    }

    public function get_item(WP_REST_Request $request){
        $search = isset($request->get_param('search')) ?? '';

        $data = AvailabilityQuery::index($search);
        
        return rest_ensure_response([
            'success' => true,
            'data' => $data
        ]);
    }

    public function create_item(WP_REST_Request $request){

    }

    public function admin_only(){
        return current_user_can('manage_options');
    }
}