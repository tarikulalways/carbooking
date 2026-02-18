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
        $self->insert_database_table();
    }

    public function save_main_settings(){
        Settings::save_settings();
    }

    public function insert_database_table(){
        Database::dispatch_post_type();
        Database::create_initial_custom_table();
    }
}
