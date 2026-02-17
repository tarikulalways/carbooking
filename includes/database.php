<?php

namespace EasyBooking;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Database{
    public static function init(){
        $self = new self();
        $self->dispatch_event();
    }

    public function dispatch_event(){
        Database\PostType::init();
        Database\Meta::init();
    }

    public static function create_initial_custom_table(){
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        global $wpdb;
        $prefix = $wpdb->prefix;
        $charset_collate = $wpdb->get_charset_collate();

        Database\CreateAvailabilityTable::up($prefix, $charset_collate);
    }
}