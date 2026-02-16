<?php

namespace EasyBooking\Database;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Meta extends MetaBase{
    public static function init(){
        $self = new self();
        $self->register_service_meta();
    }

    public function register_service_meta(){
        $meta = [
            '_' . EASYBOOKING_DB_PREFIX . '_ad' => 'string'
        ];

        $this->register_meta(EASYBOOKING_SERVICE_POST_TYPE, $meta);

    }
}