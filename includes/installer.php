<?php

namespace CarBooking;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use CarBooking\Admin\Settings;

class Installer{
    public static function init(){
        $self = new self();
        $self->save_main_settings();
    }

    public function save_main_settings(){
        Settings::save_settings();
    }
}
