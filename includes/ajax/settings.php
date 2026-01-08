<?php

namespace CarBooking\Ajax;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Carbooking\Classes\AbstractAjaxHandler;
use CarBooking\Admin\Settings as Basesettings;

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
        $data = Basesettings::get_save_data();
        wp_send_json_success($data);
    }

    public function update_base_settings(){
        $data = [
            // general
            'carbooking_currency' => isset($_POST['carbooking_currency'])? sanitize_text_field($_POST['carbooking_currency']) : '',

            'carbooking_symbol_position' => isset($_POST['carbooking_symbol_position']) ? sanitize_text_field($_POST['carbooking_symbol_position']) : '',
            'carbooking_base_pricing_unit' => isset($_POST['carbooking_base_pricing_unit']) ? sanitize_text_field($_POST['carbooking_base_pricing_unit']) : '',
            'carbooking_min_days' => isset($_POST['carbooking_min_days']) ? sanitize_text_field($_POST['carbooking_min_days']) : '',
            'carbooking_min_driver_age' => isset($_POST['carbooking_min_driver_age']) ? sanitize_text_field($_POST['carbooking_min_driver_age']) : '',
            'carbooking_daily_opration_from' => isset($_POST['carbooking_daily_opration_from']) ? sanitize_text_field($_POST['carbooking_daily_opration_from']) : '',
            'carbooking_daily_opration_to' => isset($_POST['carbooking_daily_opration_to']) ? sanitize_text_field($_POST['carbooking_daily_opration_to']) : '',
            'carbooking_before_buffer_time' => isset($_POST['carbooking_before_buffer_time']) ? sanitize_text_field($_POST['carbooking_before_buffer_time']) : '',
            'carbooking_allow_weekend_day' => isset($_POST['carbooking_allow_weekend_day']) ? filter_var($_POST['carbooking_allow_weekend_day'], FILTER_VALIDATE_BOOLEAN) : false,
            // payments
            'carbooking_book_now_pay_later' => isset($_POST['carbooking_book_now_pay_later']) ? filter_var($_POST['carbooking_book_now_pay_later'], FILTER_VALIDATE_BOOLEAN) : false,
            'carbooking_direct_bank_transfer' => isset($_POST['carbooking_direct_bank_transfer']) ? filter_var($_POST['carbooking_direct_bank_transfer'], FILTER_VALIDATE_BOOLEAN) : false,
            'carbooking_cash_on_picup' => isset($_POST['carbooking_cash_on_picup']) ? filter_var($_POST['carbooking_cash_on_picup'], FILTER_VALIDATE_BOOLEAN) : false,
            // email
            'carbooking_admin_email' => isset($_POST['carbooking_admin_email']) ? sanitize_email($_POST['carbooking_admin_email']) : '',
            'carbooking_brand_logo_url' => isset($_POST['carbooking_brand_logo_url']) ? sanitize_text_field($_POST['carbooking_brand_logo_url']) : '',
            'carbooking_email_footer_text' => isset($_POST['carbooking_email_footer_text']) ? sanitize_text_field($_POST['carbooking_email_footer_text']) : '',
            'carbooking_picup_&_drop_location' => isset($_POST['carbooking_picup_&_drop_location']) ? sanitize_text_field($_POST['carbooking_picup_&_drop_location']) : '',
        ];

        $is_update = Basesettings::save_settings($data);
        wp_send_json_success($is_update);
    }
}
 
