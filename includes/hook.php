<?php

namespace EasyBooking;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Hook{
    public static function init(){
        $self = new self();
        add_action('easybooking/after_create_availability'); //after create availability
    }
}