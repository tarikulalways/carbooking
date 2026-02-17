<?php

namespace EasyBooking;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Ajax{
    public static function init(){
        $self = new self();
        $self->dispatch_hook();
    }

    public function dispatch_hook(){
        (new Ajax\Settings())->dispatch_actions();
        (new Ajax\Dashboard())->dispatch_actions();
    }
}