<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.sinawiwebdesign.com
 * @since      1.0.0
 *
 * @package    Hipster_Pixel
 * @subpackage Hipster_Pixel/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Hipster_Pixel
 * @subpackage Hipster_Pixel/admin
 * @author     Laith Sinawi <info@sinawiwebdesign.com>
 */
class Hipster_Pixel_Admin {

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
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hipster_Pixel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hipster_Pixel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

//		$screen = get_current_screen();
//		if($screen->base == 'post') {
//			wp_enqueue_script( $this->plugin_name . '-jquery-ui', plugin_dir_url( __DIR__ ) . 'lib/jquery-ui/jquery-ui.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-admin', plugin_dir_url( __FILE__ ) . 'js/hipster-pixel-admin.js', array('jquery', 'jquery-ui-core', 'jquery-ui-slider'), $this->version, true );
			wp_enqueue_style( $this->plugin_name . '-jquery-ui', plugin_dir_url( __DIR__ ) . 'lib/jquery-ui/jquery-ui.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name . '-bootstrap', plugin_dir_url( __DIR__ ) . 'lib/bootstrap/bootstrap.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name . '-admin', plugin_dir_url( __FILE__ ) . 'css/hipster-pixel-admin.css', array(), $this->version, 'all' );

//		}



	}

	/**
	 * Insert shortcode media button
	 *
	 *
	 */
	public function add_media_button(){
		global $post;

		?>
			<a href="#TB_inline?width=782&inlineId=hipster-pixel-modal" class="thickbox button" id="button-hipster-pixel-modal" title="Hipster Pixel HTML Builder">Hipster Pixel</a>
	<?php

	}

	public function add_modal_template() {

		$screen = get_current_screen();
		if($screen->base != 'post') {
			return;
		}
		//add_thickbox();
		include_once 'partials/hipster-pixel-modal.php';
	}

}
