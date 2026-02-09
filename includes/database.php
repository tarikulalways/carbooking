<?php

namespace CarBooking;

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
}