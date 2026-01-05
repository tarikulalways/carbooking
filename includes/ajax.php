<?php

namespace CarBooking;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use CarBooking\Ajax\Settings;
use Carbooking\Ajax\Dashboard;

class Ajax{
    public static function init(){
        $self = new self();
        $self->dispatch_hook();
    }

    public function dispatch_hook(){
        (new Settings())->dispatch_actions();
        (new Dashboard())->dispatch_actions();
    }
}