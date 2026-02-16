<?php

namespace EasyBooking\Admin;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Menu{
    public static function init(){
        $self = new self();
        add_action('admin_menu', [$self, 'register_menus']);
    }

    public static function get_menu_lists(){
        $menu = [];
        $menu[EASYBOOKING_PLUGIN_SLUG] = [
            'parent_slug' => EASYBOOKING_PLUGIN_SLUG, 
            'title' => __('Dashboard', 'easybooking'),
            'capability' => 'manage_options'
        ];
        $menu[EASYBOOKING_PLUGIN_SLUG . '-service'] = [
            'parent_slug' => EASYBOOKING_PLUGIN_SLUG,
            'title' => __('Services', 'easybooking'),
            'capability' => 'manage_options'
        ];
        $menu[EASYBOOKING_PLUGIN_SLUG . '-bookings'] = [
            'parent_slug' => EASYBOOKING_PLUGIN_SLUG,
            'title' => __('Bookings', 'easybooking'),
            'capability' => 'manage_options'
        ]; 
        $menu[EASYBOOKING_PLUGIN_SLUG . '-availability'] = [
            'parent_slug' => EASYBOOKING_PLUGIN_SLUG,
            'title' => __('Availability', 'easybooking'),
            'capability' => 'manage_options'
        ];
        $menu[EASYBOOKING_PLUGIN_SLUG . '-shortcode'] = [
            'parent_slug' => EASYBOOKING_PLUGIN_SLUG, 
            'title' => __('Shortcode', 'easybooking'),
            'capability' => 'manage_options'
        ];
        $menu[EASYBOOKING_PLUGIN_SLUG . '-settings'] = [
            'parent_slug' => EASYBOOKING_PLUGIN_SLUG,
            'title' => __('Settings', 'easybooking'),
            'capability' => 'manage_options'
        ];
        return apply_filters('easybooking/admin/menu_list', $menu);
    }

    public function register_menus(){
        add_menu_page('EasyBooking', 'EasyBooking', 'manage_options', EASYBOOKING_PLUGIN_SLUG, [$this, 'load_main_template'], null, 26);

        foreach(self::get_menu_lists() as $item_slug => $item){
            add_submenu_page($item['parent_slug'], $item['title'], $item['title'], $item['capability'], $item_slug, [$this, 'load_main_template']);
        }
        
    }

    public function load_main_template(){
        echo '<div id="easybooking" class="easybooking wrap"></div>';
    }
}