<?php

namespace EasyBooking\API;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use WP_REST_Request;
use EasyBooking\Classes\Availability as AvailabilityQuery;

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

        register_rest_route($this->namespace, $this->rest_base . '/(?P<id>\d+)', [
            [
                'methods' => 'PUT',
                'callback' => [$this, 'update_item'],
                'permission_callback' => [$this, 'admin_only']
            ],
            [
                'methods' => 'DELETE',
                'callback' => [$this, 'delete_item'],
                'permission_callback' => [$this, 'admin_only']
            ]
        ]);
    }

    public function get_item(WP_REST_Request $request){
        $search = $request->get_param('search')? sanitize_text_field($request->get_param('search')): '';

        $data = AvailabilityQuery::get_availability($search);
        
        return rest_ensure_response([
            'success' => true,
            'data' => $data
        ]);
    }

    public function create_item(WP_REST_Request $request){
        $name = $request->get_param('name')? sanitize_text_field($request->get_param('name')): '';
        $timezone = $request->get_param('timezone')? sanitize_text_field($request->get_param('timezone')): wp_timezone();
        $schedule = $request->get_param('schedule')? json_encode($request->get_param('schedule')):'';
        $is_default = AvailabilityQuery::total() ? 0 : 1;

        $data = [
            'name' => $name,
            'timezone' => $timezone,
            'schedule' => $schedule,
            'is_default' => $is_default
        ];

        $is_created = AvailabilityQuery::create_availability($data);
        do_action('easybooking/after_create_availability', $is_created);

        if($is_created){
            return rest_ensure_response([
                'success' => true,
                'data' => $is_created
            ]);
        }else{
            return rest_ensure_response([
                'success' => false,
                'message' => __('Availability create failed', 'easybooking')
            ]);
        }
        
    }

    public function update_item(WP_REST_Request $request){
        $name = $request->get_param('name')? sanitize_text_field($request->get_param('name')): '';
        $timezone = $request->get_param('timezone')? sanitize_text_field($request->get_param('timezone')): wp_timezone();
        $schedule = $request->get_param('schedule')? json_encode($request->get_param('schedule')):'';
        $id = $request->get_param('id') ? absint($request->get_param('id')): 0;

        $data = [
            'name' => $name,
            'timezone' => $timezone,
            'schedule' => $schedule
        ];

        $is_update = AvailabilityQuery::update_availability($id, $data);
        if($is_update){
            return rest_ensure_response([
                'success' => true,
                'data' => $is_update
            ]);
        }else{
            return rest_ensure_response([
                'success' => false,
                'id' => $id,
                'message' => __('Availability update faild', 'easybooking')
            ]);
        }
    }

    public function delete_item(WP_REST_Request $request){
        $id = $request->get_param('id') ? absint($request->get_param('id')): 0;
        
        $is_delete = AvailabilityQuery::delete_availability($id);
        if($is_delete){
            return rest_ensure_response([
                'success' => true,
                'message' => __('Availability delete successfull', 'easybooking')
            ]);
        }else{
            return rest_ensure_response([
                'success' => false,
                'id' => $id,
                'message' => __('Availability delete failed', 'easybooking')
            ]);
        }
    }

    public function admin_only(){
        return current_user_can('manage_options');
    }
}