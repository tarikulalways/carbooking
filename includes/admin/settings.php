<?php

namespace CarBooking\Admin;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Settings{
    public static function get_save_data(){
        $settings = get_option(CARBOOKING_SETTINGS_NAME);
        if($settings){
            return apply_filters('carbooking/admin/save_data', json_decode($settings, true));
        }
        return [];
    }

    public static function set_default_data(){
        $data = [
            'carbooking_version' => '0.0.1'
        ];

        return apply_filters('carbooking/admin/settings_default_data', $data);
    }

    public static function save_settings($form_data = []){
        $default_data = self::set_default_data();
        $save_data = self::get_save_data();

        $settings_data = wp_parse_args($default_data, $save_data);

        if($form_data){
            $settings_data = wp_parse_args($form_data, $settings_data);
        }

        if(count($save_data)){
            return update_option(CARBOOKING_SETTINGS_NAME, wp_json_encode($settings_data));
        }
        return add_option(CARBOOKING_SETTINGS_NAME, wp_json_encode($settings_data));
    }
}