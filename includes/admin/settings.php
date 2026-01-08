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
        $users = wp_get_current_user();
        $data = [
            // general
            'carbooking_currency' => [
                'US Dollar',
                'British Pound',
                'Bangladeshi Taka',
                'Indian Rupee'
            ],
            'carbooking_symbol_position' => [
                'Before',
                'After'
            ],
            'carbooking_base_pricing_unit' => [
                'Daily (Fixed 24h cycles)',
                'Hourly (Flexable duration)'
            ],
            'carbooking_min_days' => '1',
            'carbooking_min_driver_age' => '21',
            'carbooking_daily_opration_from' => '',
            'carbooking_daily_opration_to' => '',
            'carbooking_before_buffer_time' => '',
            'carbooking_allow_weekend_day' => 'boolean',
            // payments
            'carbooking_book_now_pay_later' => 'boolean',
            'carbooking_direct_bank_transfer' => 'boolean',
            'carbooking_cash_on_picup' => 'boolean',
            // email
            'carbooking_admin_email' => $users->user_email,
            'carbooking_brand_logo_url' => '',
            'carbooking_email_footer_text' => '',
            'carbooking_picup_&_drop_location' => [],
        ];

        return apply_filters('carbooking/admin/settings_default_data', $data);
    }

    public static function save_settins($form_data = []){
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