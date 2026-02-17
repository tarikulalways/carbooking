<?php

namespace EasyBooking\Ajax;

if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

use EasyBooking\Classes\AbstractAjaxHandler;
use EasyBooking\Admin\Menu;

class Dashboard extends AbstractAjaxHandler{
    public function __construct(){
        $this->actions = [
            'get_menu_list' => [
                'callback' => [$this, 'get_menu_list']
            ]
        ];
    }

    public function get_menu_list(){
        $menu = Menu::get_menu_lists();
        wp_send_json_success($menu);
    }
}
