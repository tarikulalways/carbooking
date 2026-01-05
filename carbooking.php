<?php

/**
 * Plugin Name: CarBooking
 * Plugin URI: https://example.com/
 * Description: plugin description.
 * Version: 0.0.1
 * Author: Tarikul
 * Author URI: https://author.com/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: carbooking
 */


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

final class Carbooking{
    private function __construct(){
        $this->define_constant();
        $this->load_dependency();
        register_activation_hook(__FILE__, [$this, 'activation']);
        add_action('plugins_loaded', [$this, 'on_plugins_loaded']);
        add_action('carbooking_loaded', [$this, 'init_plugin']);
    }

    public static function init(){
        static $instance = false;
        if(! $instance){
            $instance = new self();
        }
        return $instance;
    }

    public function define_constant(){
        define('CARBOOKING_VERSION', '0.0.1');
        define('CARBOOKING_PLUGIN_SLUG', 'carbooking');
        define('CARBOOKING_SETTINGS_NAME', 'carbooking_settings');
        define('CARBOOKING_PLUGIN_FILE', __FILE__);
        define('CARBOOKING_PLUGIN_BASENAME', plugin_basename(__FILE__));
        define('CARBOOKING_PLUGIN_ROOT_URL', plugin_dir_url(__FILE__));
        define('CARBOOKING_PLUGIN_ROOT_PATH', plugin_dir_path(__FILE__));
        define('CARBOOKING_PLUGIN_ASSETS_PATH', CARBOOKING_PLUGIN_ROOT_PATH . 'assets/');
        define('CARBOOKING_PLUGIN_ASSETS_URL', CARBOOKING_PLUGIN_ROOT_URL . 'assets/');
        define('CARBOOKING_PLUGIN_INCLUDES_PATH', CARBOOKING_PLUGIN_ROOT_PATH . 'includes/');
    }

    public function load_dependency(){
        require_once CARBOOKING_PLUGIN_INCLUDES_PATH . 'autoload.php';
    }

    public function on_plugins_loaded(){
        do_action('carbooking_loaded');
    }

    public function init_plugin(){
        do_action('carbooking_before_init');
        $this->dispatch_hooks();
        do_action('carbooking_init');
    }

    public function dispatch_hooks(){
        CarBooking\Admin::init();
    }

    public function activation(){
        CarBooking\Installer::init();
    }
}

function start_carbooking(){
    return Carbooking::init();
}
start_carbooking();