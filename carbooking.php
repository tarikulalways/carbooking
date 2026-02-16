<?php

/**
 * Plugin Name: EasyBooking
 * Plugin URI: https://example.com/
 * Description: plugin description.
 * Version: 0.0.1
 * Author: Tarikul
 * Author URI: https://author.com/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: easybooking
 */


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

final class Easybooking{
    private function __construct(){
        $this->define_constant();
        $this->load_dependency();
        register_activation_hook(__FILE__, [$this, 'activation']);
        add_action('plugins_loaded', [$this, 'on_plugins_loaded']);
        add_action('easybooking_loaded', [$this, 'init_plugin']);
    }

    public static function init(){
        static $instance = false;
        if(! $instance){
            $instance = new self();
        }
        return $instance;
    }

    public function define_constant(){
        define('EASYBOOKING_VERSION', '0.0.1');
        define('EASYBOOKING_PLUGIN_SLUG', 'easybooking');
        define('EASYBOOKING_SETTINGS_NAME', 'easybooking_settings');
        define('EASYBOOKING_PLUGIN_FILE', __FILE__);
        define('EASYBOOKING_DB_PREFIX', 'carbk');
        define('EASYBOOKING_SERVICE_POST_TYPE', EASYBOOKING_DB_PREFIX . '_service');
        define('EASYBOOKING_PLUGIN_BASENAME', plugin_basename(__FILE__));
        define('EASYBOOKING_PLUGIN_ROOT_URL', plugin_dir_url(__FILE__));
        define('EASYBOOKING_PLUGIN_ROOT_PATH', plugin_dir_path(__FILE__));
        define('EASYBOOKING_PLUGIN_ASSETS_PATH', EASYBOOKING_PLUGIN_ROOT_PATH . 'assets/');
        define('EASYBOOKING_PLUGIN_ASSETS_URL', EASYBOOKING_PLUGIN_ROOT_URL . 'assets/');
        define('EASYBOOKING_PLUGIN_INCLUDES_PATH', EASYBOOKING_PLUGIN_ROOT_PATH . 'includes/');
    }

    public function load_dependency(){
        require_once EASYBOOKING_PLUGIN_INCLUDES_PATH . 'autoload.php';
    }

    public function on_plugins_loaded(){
        do_action('easybooking_loaded');
    }

    public function init_plugin(){
        do_action('easybooking_before_init');
        $this->dispatch_hooks();
        do_action('easybooking_init');
    }

    public function dispatch_hooks(){
        EasyBooking\Admin::init();
        EasyBooking\Api::init();
        EasyBooking\Assets::init();
    }

    public function activation(){
        EasyBooking\Installer::init();
    }
}

function start_easybooking(){
    return Easybooking::init();
}
start_easybooking();