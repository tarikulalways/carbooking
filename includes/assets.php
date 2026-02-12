<?php

namespace CarBooking;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Assets{
    public static function init(){
        $self = new self();
        add_action('admin_enqueue_scripts', [$self, 'enqueue_app_assets']);
    }

    public function enqueue_app_assets($hook){
        if(strpos($hook, '_page_' . CARBOOKING_PLUGIN_SLUG) !== false){
            $dependencies = include_once CARBOOKING_PLUGIN_ASSETS_PATH . sprintf('build/backend.%s.asset.php', CARBOOKING_VERSION);
            
            wp_enqueue_script('carbk-backend-scripts', CARBOOKING_PLUGIN_ASSETS_URL . sprintf('build/backend.%s.js', CARBOOKING_VERSION), $dependencies['dependencies'], $dependencies['version'], true);
        }
        
    }
}