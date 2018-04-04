<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       nlsltd.com
 * @since      1.0.0
 *
 * @package    Mcpcon
 * @subpackage Mcpcon/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mcpcon
 * @subpackage Mcpcon/admin
 * @author     NLS ltd <devteam@nlsltd.com>
 */
class Mcpcon_Admin {

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
		 * defined in Mcpcon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mcpcon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mcpcon-admin.css', array(), $this->version, 'all' );

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
		 * defined in Mcpcon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mcpcon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mcpcon-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 *  Adds an options menu item in dashboard->settings
	 */
	public function mcpcon_add_admin_menu()
	{

		add_options_page( 'Mycognition pro Connector', 'Mycognition pro Connector', 'manage_options', 'mcpcon', array($this, 'mcpcon_options_page') );
	}

	/**
	 * Set up admin option fields & sections
	 */
	public function mcpcon_settings_init()
	{
		register_setting( 'mcpcon', 'mcpcon_settings' );

		add_settings_section(
			'mcpcon_section',
			__( '', 'mcpcon' ),
			array($this, 'mcpcon_settings_section_callback'),
			'mcpcon'
		);

		add_settings_field(
			'mcpcon_salt',
			__( 'Salt', 'mcpcon' ),
			array($this, 'mcpcon_salt_render'),
			'mcpcon',
			'mcpcon_section'
		);

		add_settings_field(
			'mcpcon_secret',
			__( 'Secret', 'mcpcon' ),
			array($this,'mcpcon_secret_render'),
			'mcpcon',
			'mcpcon_section'
		);

	}


	function mcpcon_salt_render()
	{
		$options = get_option( 'mcpcon_settings' );
		?>
		<input type='text' name='mcpcon_settings[mcpcon_salt]' value='<?php echo $options['mcpcon_salt']; ?>'>
		<?php
	}

	function mcpcon_secret_render()
	{
		$options = get_option( 'mcpcon_settings' );
		?>
		<input type='text' name='mcpcon_settings[mcpcon_secret]' value='<?php echo $options['mcpcon_secret']; ?>'>
		<?php
	}

	function mcpcon_settings_section_callback(  )
	{
		echo __( 'Credentials to build autologin endpoint', 'mcpcon' );
	}


	function mcpcon_options_page(  )
	{
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/mcpcon-admin-display.php';
	}

}
