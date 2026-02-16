<?php

namespace EasyBooking;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Assets{
    public static function init(){
        $self = new self();
        add_action('admin_enqueue_scripts', [$self, 'enqueue_app_assets']);
    }

    public function enqueue_app_assets($hook){
        if(strpos($hook, '_page_' . EASYBOOKING_PLUGIN_SLUG) !== false){
            $dependencies = include_once EASYBOOKING_PLUGIN_ASSETS_PATH . sprintf('build/backend.%s.asset.php', EASYBOOKING_VERSION);
            
            wp_enqueue_style('carbk-app-style', EASYBOOKING_PLUGIN_ASSETS_URL . 'build/style-backend.css', [], filemtime(EASYBOOKING_PLUGIN_ASSETS_PATH . 'build/style-backend.css'), 'all');
            wp_enqueue_script('carbk-app-scripts', EASYBOOKING_PLUGIN_ASSETS_URL . sprintf('build/backend.%s.js', EASYBOOKING_VERSION), $dependencies['dependencies'], $dependencies['version'], true);
        }
        
    }
}