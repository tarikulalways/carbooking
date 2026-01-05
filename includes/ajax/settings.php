<?php

namespace CarBooking\Ajax;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Carbooking\Classes\AbstractAjaxHandler;
use CarBooking\Admin\Settings;

class Settings extends AbstractAjaxHandler{
    public function __construct(){
        $this->actions = [
            'get_settings' => [
                'callback' => [$this, 'get_settings']
            ],
            'update_base_settings' => [
                'callback' => [$this, 'update_base_settings']
            ]
        ];
    }

    public function get_settings(){
        $data = Settings::get_save_data();
        wp_send_json_success($data);
    }

    public function update_base_settings(){
        wp_send_json($_POST);
    }
}
 
