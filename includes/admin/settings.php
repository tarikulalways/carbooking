<?php

namespace EasyBooking\Admin;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Settings{
    public static function get_save_data(){
        $settings = get_option(EASYBOOKING_SETTINGS_NAME);
        if($settings){
            return apply_filters('easybooking/admin/save_data', json_decode($settings, true));
        }
        return [];
    }

    public static function set_default_data(){
        $users = wp_get_current_user();
        $data = [
            // general
            EASYBOOKING_DB_PREFIX .'_currency' => [
                'US Dollar',
                'British Pound',
                'Bangladeshi Taka',
                'Indian Rupee'
            ],
            EASYBOOKING_DB_PREFIX . '_symbol_position' => [
                'Before',
                'After'
            ],
            EASYBOOKING_DB_PREFIX . '_base_pricing_unit' => [
                'Daily (Fixed 24h cycles)',
                'Hourly (Flexable duration)'
            ],
            EASYBOOKING_DB_PREFIX . '_min_days' => 1,
            EASYBOOKING_DB_PREFIX . '_min_driver_age' => 21,
            EASYBOOKING_DB_PREFIX . '_daily_opration_from' => '',
            EASYBOOKING_DB_PREFIX . '_daily_opration_to' => '',
            EASYBOOKING_DB_PREFIX . '_before_buffer_time' => '',
            EASYBOOKING_DB_PREFIX . '_allow_weekend_day' => 'boolean',
            // payments
            EASYBOOKING_DB_PREFIX . '_book_now_pay_later' => 'boolean',
            EASYBOOKING_DB_PREFIX . '_direct_bank_transfer' => 'boolean',
            EASYBOOKING_DB_PREFIX . '_cash_on_picup' => 'boolean',
            // email
            EASYBOOKING_DB_PREFIX . '_admin_email' => $users->user_email,
            EASYBOOKING_DB_PREFIX . '_brand_logo_url' => '',
            EASYBOOKING_DB_PREFIX . '_email_footer_text' => '',
            EASYBOOKING_DB_PREFIX . '_picup_&_drop_location' => [],
        ];
        return apply_filters('easybooking/admin/settings_default_data', $data);
    }

    public static function save_settings($form_data = []){
        $default_data = self::set_default_data();
        $save_data = self::get_save_data();

        $settings_data = wp_parse_args($default_data, $save_data);

        if($form_data){
            $settings_data = wp_parse_args($form_data, $settings_data);
        }

        if(count($save_data)){
            return update_option(EASYBOOKING_SETTINGS_NAME, wp_json_encode($settings_data));
        }
        return add_option(EASYBOOKING_SETTINGS_NAME, wp_json_encode($settings_data));
    }
}