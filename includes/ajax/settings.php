<?php

namespace EasyBooking\Ajax;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use EasyBooking\Classes\AbstractAjaxHandler;
use EasyBooking\Admin\Settings as Basesettings;

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
            EASYBOOKING_DB_PREFIX . '_currency' => isset($_POST['carbk_currency'])? sanitize_text_field($_POST['carbk_currency']) : '',

            EASYBOOKING_DB_PREFIX . '_symbol_position' => isset($_POST['carbk_symbol_position']) ? sanitize_text_field($_POST['carbk_symbol_position']) : '',
            EASYBOOKING_DB_PREFIX . '_base_pricing_unit' => isset($_POST['carbk_base_pricing_unit']) ? sanitize_text_field($_POST['carbk_base_pricing_unit']) : '',
            EASYBOOKING_DB_PREFIX . '_min_days' => isset($_POST['carbk_min_days']) ? sanitize_text_field($_POST['carbk_min_days']) : '',
            EASYBOOKING_DB_PREFIX . '_min_driver_age' => isset($_POST['carbk_min_driver_age']) ? sanitize_text_field($_POST['carbk_min_driver_age']) : '',
            EASYBOOKING_DB_PREFIX . '_daily_opration_from' => isset($_POST['carbk_daily_opration_from']) ? sanitize_text_field($_POST['carbk_daily_opration_from']) : '',
            EASYBOOKING_DB_PREFIX . '_daily_opration_to' => isset($_POST['carbk_daily_opration_to']) ? sanitize_text_field($_POST['carbk_daily_opration_to']) : '',
            EASYBOOKING_DB_PREFIX . '_before_buffer_time' => isset($_POST['carbk_before_buffer_time']) ? sanitize_text_field($_POST['carbk_before_buffer_time']) : '',
            EASYBOOKING_DB_PREFIX . '_allow_weekend_day' => isset($_POST['carbk_allow_weekend_day']) ? filter_var($_POST['carbk_allow_weekend_day'], FILTER_VALIDATE_BOOLEAN) : false,
            // payments
            EASYBOOKING_DB_PREFIX . '_book_now_pay_later' => isset($_POST['carbk_book_now_pay_later']) ? filter_var($_POST['carbk_book_now_pay_later'], FILTER_VALIDATE_BOOLEAN) : false,
            EASYBOOKING_DB_PREFIX . '_direct_bank_transfer' => isset($_POST['carbk_direct_bank_transfer']) ? filter_var($_POST['carbk_direct_bank_transfer'], FILTER_VALIDATE_BOOLEAN) : false,
            EASYBOOKING_DB_PREFIX . '_cash_on_picup' => isset($_POST['carbk_cash_on_picup']) ? filter_var($_POST['carbk_cash_on_picup'], FILTER_VALIDATE_BOOLEAN) : false,
            // email
            EASYBOOKING_DB_PREFIX . '_admin_email' => isset($_POST['carbk_admin_email']) ? sanitize_email($_POST['carbk_admin_email']) : '',
            EASYBOOKING_DB_PREFIX . '_brand_logo_url' => isset($_POST['carbk_brand_logo_url']) ? sanitize_text_field($_POST['carbk_brand_logo_url']) : '',
            EASYBOOKING_DB_PREFIX . '_email_footer_text' => isset($_POST['carbk_email_footer_text']) ? sanitize_text_field($_POST['carbk_email_footer_text']) : '',
            EASYBOOKING_DB_PREFIX . '_picup_&_drop_location' => isset($_POST['carbk_picup_&_drop_location']) ? sanitize_text_field($_POST['carbk_picup_&_drop_location']) : '',
        ];

        $is_update = Basesettings::save_settings($data);
        wp_send_json_success($is_update);
    }
}
 
