<?php

namespace EasyBooking;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Api{
    
    public static function init(){
        $self = new self();
        $self->dispatch_api();
        add_action('rest_api_init', [$self, 'register_routes']);
    }

    public function dispatch_api(){
        API\Settings::init();
    }

    public function register_routes(){
        (new API\Availability())->register_routes();
    }
}