<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 * @author     Your Name <email@example.com>
 */
class Cirkle_Contact_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cirkle-contact-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cirkle-contact-admin.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'ajax_object', array( 'ajax_url' => admin_url('admin-ajax.php') ) );

	}

	public function add_menu_pages(){
		add_menu_page( 'Project Inquiry', 'Project Inquiry', 'manage_options', 'project-inquiry', array($this,'project_inquiry_callback'), '
		dashicons-testimonial', 10 );
		add_menu_page( 'Job Inquiry', 'Job Inquiry', 'manage_options', 'job-inquiry', array($this,'job_inquiry_callback'), 'dashicons-admin-users', 11 );
	}

	function project_inquiry_callback(){
		require( dirname( __FILE__ ) . '/partials/project-inquiry-display.php' );
	}

	function job_inquiry_callback(){
		require( dirname( __FILE__ ) . '/partials/job-inquiry-display.php' );
	}

	function job_status(){
		global $wpdb;
		$job_table = $wpdb->prefix . "job";

		$id = $_POST['id'];
		$status = $_POST['status'];

		$update = $wpdb->update( 
			$job_table, 
			array( 'status' => $status ), 
			array( 'id' => $id ), 
			array( '%s' ), 
			array( '%d' ) 
		);

		if($update){
			echo "Status Updated successfully.";
		}else{
			echo "Failed to update status.";
		}

		wp_die();
	}
}
