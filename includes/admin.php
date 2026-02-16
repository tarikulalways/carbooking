<?php

namespace EasyBooking;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Admin{
    public static function init(){
        $self = new self();
        $self->dispatch_menu();
    }

    public function dispatch_menu(){
        Admin\Menu::init();
    }
}