<?php
/**
 * Plugin Name:       WP OKR Manager
 * Plugin URI:        https://huskystudios.digital/plugins/wp-okr-manager
 * Description:       This plugin is helping agencies and companies to manage and track their company OKRs and KPIs.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            HuskyStudios
 * Author URI:        https://huskystudios.digital/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

/**
 * All the constants that are used through the plugin
 */
define('OKMR_TEXTDOMAIN', 'wp-okr-manager');
define('OKMR_PLUGIN_NAME', 'wp-okr-manager');

// Paths
define('OKMR_PATH', WP_PLUGIN_DIR . '/' . OKMR_PLUGIN_NAME);
define('OKMR_URL', plugin_dir_url(__FILE__));
define('OKMR_INC_PATH', OKMR_PATH . '/includes');
define('OKMR_MODEL_PATH', OKMR_INC_PATH . '/Models');
define('OKMR_ASSET_PATH', OKMR_URL . 'assets');
define('OKMR_CSS_PATH', OKMR_ASSET_PATH . '/css');
define('OKMR_JS_PATH', OKMR_ASSET_PATH . '/js');
define('OKMR_VIEWS', OKMR_PATH . '/views');
define('OKMR_PUBLIC_VIEWS', OKMR_VIEWS . '/public');
define('OKMR_ADMIN_VIEWS', OKMR_VIEWS . '/admin');

/**
 * Class WP_OKR_MANAGER
 *
 * The main class of the plugin. It constructs the whole plugin functionality
 */
class WP_OKR_MANAGER {
	// The constructor activates the plugin and loads all the requirements
	public function __construct() {
		$this->activate();
		$this->load();

		add_action('init', array($this, 'init'));
		add_action('add_meta_boxes', array('Okmr_OKR', 'kpi_meta_box'));
		add_action('admin_menu', array($this, 'pages'));
		add_action('admin_post_okrm_new_kpi_form_response', array($this,'add_kpi_form_submission'));
		add_action('admin_enqueue_scripts', array($this, 'enqeue'));
	}

	// Adds the option that gives the news
	public function activate(){
		if (!get_option('okmr-active')){
			add_option( 'okmr_active', 'true' );
		}
	}

	// Loads all the requirements
	public function load() {
		require_once( OKMR_MODEL_PATH . '/Okmr_OKR.php' );
		require_once( OKMR_MODEL_PATH . '/Okmr_KPI.php' );
	}

	public function enqeue () {
		wp_enqueue_script('okmr-main-script', OKMR_JS_PATH . '/OKMR_editForm.js');
		wp_enqueue_style('okmr-main-stylesheet', OKMR_CSS_PATH . '/style.css');
	}

	// Inits the requirements of the plugins
	public function init(){
		Okmr_OKR::init();
		Okmr_KPI::init();
	}

	// Adds the pages in the admin dashboard
	public function pages(){
	    add_menu_page('Add new KPI','Add KPI','manage_options','add-kpi',array($this,'add_kpi_callback'));
    }

    public function add_kpi_callback(){
        $_add_meta_nonce = wp_create_nonce( 'okmr_add_user_meta_form_nonce' );
        include_once OKMR_ADMIN_VIEWS . '/add_new_kpi_admin.php';
    }

    /**
     * NOTE: It seems like this is the easiest way to relate the OKRs and the KPIS
     */
    public function add_kpi_form_submission(){
        if( isset( $_POST['okmr_add_user_meta_nonce'] ) && wp_verify_nonce( $_POST['okmr_add_user_meta_nonce'], 'okmr_add_user_meta_form_nonce') ) {
            echo wp_insert_post(
                array(
                    'post_content' => $_POST['okmr_name'],
                    'post_title' => $_POST['okmr_name'],
                    'post_type' => 'okmr_kpi',
                    'meta_input' => array(
                        'parent_okr' => 24
                    )
                ),
            );
        }else{
            die("Something didn't go right");
        }
    }
}

new WP_OKR_MANAGER();