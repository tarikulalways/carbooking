<?php

namespace EasyBooking\Database;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class MetaBase{
    public function register_meta(string $post_type, array $meta_field){
        if(! is_array($meta_field)){
            return null;
        }
        if(! $post_type){
            return null;
        }

        foreach($meta_field as $meta_key => $type){
            register_post_meta($post_type, $meta_key, [
                'type' => $type,
                'single' => true,
                'show_in_rest' => true,
                'sanitize_callback' => function($value){
                    if(empty($value)){
                        return 0;
                    }
                    return $value;
                }
            ]);
        }
    }
}