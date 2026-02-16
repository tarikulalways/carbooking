<?php

namespace EasyBooking;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use EasyBooking\Admin\Settings;

class Installer{
    public static function init(){
        $self = new self();
        $self->save_main_settings();
    }

    public function save_main_settings(){
        Settings::save_settings();
    }
}
