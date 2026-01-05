<?php

namespace CarBooking\Admin;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Menu{
    public static function init(){
        $self = new self();
        add_action('admin_menu', [$self, 'register_menu']);
    }

    public function register_menu(){
        $menu = [];
        $menu[CARBOOKING_PLUGIN_SLUG] = [
            'parent_slug' => CARBOOKING_PLUGIN_SLUG, 
            'title' => __('Dashboard', 'carbooking'),
            'capability' => 'manage_options'
        ];
        $menu[CARBOOKING_PLUGIN_SLUG . '-service'] = [
            'parent_slug' => CARBOOKING_PLUGIN_SLUG,
            'title' => __('Service', 'carbooking'),
            'capability' => 'manage_options'
        ];
        $menu[CARBOOKING_PLUGIN_SLUG . '-bookings'] = [
            'parent_slug' => CARBOOKING_PLUGIN_SLUG,
            'title' => __('Bookings', 'carbooking'),
            'capability' => 'manage_options'
        ];
        $menu[CARBOOKING_PLUGIN_SLUG . '-shortcode'] = [
            'parent_slug' => CARBOOKING_PLUGIN_SLUG, 
            'title' => __('Shortcode', 'carbooking'),
            'capability' => 'manage_options'
        ];

        add_menu_page('CarBooking', 'CarBooking', 'manage_options', CARBOOKING_PLUGIN_SLUG, [$this, 'load_main_template'], null, 26);

        foreach($menu as $item_key => $item){
            add_submenu_page($item['parent_slug'], $item['title'], $item['title'], $item['capability'], $item_key, [$this, 'load_main_template']);
        }
        
    }

    public function load_main_template(){
        echo '<div id="carbooking" class="carbooking wrap">loading</div>';
    }
}