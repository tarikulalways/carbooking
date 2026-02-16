<?php

namespace EasyBooking\Classes;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

abstract class AbstractAjaxHandler{
    protected $nonce_action = 'easybooking_nonce';
    protected $namespace = EASYBOOKING_PLUGIN_SLUG;
    protected $actions = [];

    public function dispatch_actions(){
        foreach($this->actions as $action => $details){
            add_action('wp_ajax_' . $this->namespace . '/' . $action, [$this, 'handle_ajax_request']);
            if(isset($details['allow_visitor_action']) && true === $details['allow_visitor_action']){
                add_action('wp_ajax_nopriv_' . $this->namespace . '/' . $action, [$this, 'handle_ajax_request']);
            }
        }
    }

    public function handle_ajax_request(){
        $action = isset($_POST['action']) ? sanitize_text_field($_POST['action']) : '';
        $action = $this->namespace . '/' . $action;
        if(! isset($this->actions[$action])){
            wp_send_json_error(['Invalide AJAX Action'], 400);
        }

        $nonce = isset($_POST['security']) ? sanitize_text_field($_POST['security']) : '';
        if(! wp_verify_nonce($nonce, $this->nonce_action)){
            wp_send_json_error(['Invalide nonce'], 400);
        }

        $allow_visitor_action = isset($details['allow_visitor_action']) ? $details['allow_visitor_action'] : false;
        $current_user = isset($details['capability']) ? $details['capability'] : 'manage_options';
        if(! $allow_visitor_action && (! is_user_logged_in() || ! current_user_can($current_user) )){
            wp_send_json_error(['Insaficient permission'], 400);
        }

        if(isset($details['callback'])){
            call_user_func($details['callback'], wp_unslash($_POST));
        }else{
            wp_send_json_error(['Invalide callback method'], 500);
        }
    }
}