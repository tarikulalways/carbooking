<?php

namespace CarBooking;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Api{
    
    public static function init(){
        $self = new self();
        $self->dispatch_api();
    }

    public function dispatch_api(){
        API\Settings::init();
    }
}