<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.sinawiwebdesign.com
 * @since      1.0.0
 *
 * @package    Hipsum_Pixel
 * @subpackage Hipsum_Pixel/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Hipsum_Pixel
 * @subpackage Hipsum_Pixel/admin
 * @author     Laith Sinawi <info@sinawiwebdesign.com>
 */
class Hipsum_Pixel_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * Holds the values to be used in the fields callbacks
	 *
	 * @since    1.0.0
	 * @access    private
	 * @var    string $options The options for this plugin
	 */
	private $options;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->options     = get_option( 'hp_settings' );

	}

	/**
	 * Register the JavaScript and CSS for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hipsum_Pixel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hipsum_Pixel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( function_exists( 'get_current_screen' ) ) {
			$screen = get_current_screen();
			if ( $screen->id == 'post' || $screen->id == 'page' ) {

				wp_enqueue_script( $this->plugin_name . '-admin', plugin_dir_url( __FILE__ ) . 'js/hipsum-pixel-admin.js', array(
					'jquery',
					'jquery-ui-core',
					'jquery-ui-slider'
				), $this->version, true );
				wp_enqueue_style( $this->plugin_name . '-jquery-ui', plugin_dir_url( __DIR__ ) . 'lib/jquery-ui/jquery-ui.min.css', array(), $this->version, 'all' );
				wp_enqueue_style( $this->plugin_name . '-bootstrap', plugin_dir_url( __DIR__ ) . 'lib/bootstrap/bootstrap.min.css', array(), $this->version, 'all' );
				wp_enqueue_style( $this->plugin_name . '-admin', plugin_dir_url( __FILE__ ) . 'css/hipsum-pixel-admin.css', array(), $this->version, 'all' );

				wp_localize_script( $this->plugin_name . '-admin', 'HIPSUM_PIXEL',
					array(
						'token'        => wp_create_nonce( 'hp-token' ),
						'image_source' => $this->options['image_source']
					)
				);

			}
			if ( $screen->id == 'tools_page_hipsum-pixel' ) {
				wp_enqueue_style( $this->plugin_name . '-settings', plugin_dir_url( __FILE__ ) . 'css/hipsum-pixel-settings.css', array(), $this->version, 'all' );
			}

//			var_dump($screen);

		}
	}

	/**
	 * Add button to editor toolbar
	 */
	public function add_media_button() {

		if ( function_exists( 'get_current_screen' ) ) {
			$screen = get_current_screen();
			if ( $screen->id == 'post' || $screen->id == 'page' ) : ?>
				<a href="#TB_inline?width=782&inlineId=hipsum-pixel-modal" class="thickbox button"
				   id="button-hipsum-pixel-modal" title="Hipsum Pixel HTML Builder"> <span class="hp-icon"></span>
					Hipsum
					Pixel</a>
			<?php endif;
		}

	}

	/**
	 * Create UI in modal
	 */
	public function add_modal_template() {

		$screen = get_current_screen();
		if ( $screen->base != 'post' ) {
			return;
		}

		include_once 'partials/hipsum-pixel-modal.php';
	}

	/************** OPTIONS PAGE RELATED METHODS *******************/

	/**
	 * Add options page
	 */
	public function add_settings_page() {
		// This page will be under Tools menu
		add_submenu_page(
			'tools.php',
			__( 'Hipsum Pixel Options', 'hipsum-pixel' ),
			__( 'Hipsum Pixel Options', 'hipsum-pixel' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'create_options_page' )
		);

	}

	/**
	 * Callback for Options page
	 */
	public function create_options_page() {
		// Set class property
		$this->options = get_option( 'hp_settings' );
		?>
		<div class="wrap hp-options">
			<form method="post" action="options.php">
				<?php
				// This prints out all setting fields
				settings_fields( 'hp_options_group' );
				do_settings_sections( $this->plugin_name );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register and add settings
	 */
	public function add_settings() {
		register_setting(
			'hp_options_group', // Option group
			'hp_settings', // Option name
			array( $this, 'sanitize_fields' ) // Sanitize
		);

		add_settings_section(
			$this->plugin_name . '_info', // ID
			'', // Title
			array( $this, 'print_section_info' ), // Callback
			$this->plugin_name // Page
		);

		add_settings_section(
			$this->plugin_name . '_fields', // ID
			'Settings', // Title
			array( $this, 'fields_callback' ), // Callback
			$this->plugin_name // Page
		);

		add_settings_field(
			'image_source',
			'Image Source',
			array( $this, 'image_source_callback' ),
			$this->plugin_name,
			$this->plugin_name . '_fields',
			array(
				'label_for' => 'image_source',
				'desc'      => 'Choose random image source.  If you need your images to load over https, use PlaceKitten.',
				'class'     => 'image-source'
			)
		);

	}

	/**
	 * Print the fields section text
	 */
	public function fields_callback() {
		// Output for fields section - doing nothing!
		// Callback function required by add_settings_section()
	}

	/**
	 * Print the section text
	 */
	public function print_section_info() {
		include_once 'partials/hipsum-pixel-section-info.php';
	}

	/**
	 *  Print out image source fields
	 */
	public function image_source_callback( $args ) {
		$class        = isset( $args['class'] ) ? $args['class'] : '';
		$image_source = isset( $this->options['image_source'] ) ? $this->options['image_source'] : 'lorempixel';
		?>
		<label for="hp_settings[image_source]" class="<?php echo $class; ?>">
			<input type="radio" name="hp_settings[image_source]"
			       value="lorempixel" <?php checked( 'lorempixel', $image_source, true ); ?>>LoremPixel
			<span>(for random images with multiple categories in color or grayscale
				<p class="description"><a
					target="_blank" href="http://lorempixel.com/">LoremPixel</a> </span>
			<span class="important">DOES NOT load images HTTPS</span></p>
		</label>
		<label for="hp_settings[image_source]" class="<?php echo $class; ?>">
			<input type="radio" name="hp_settings[image_source]"
			       value="placekitten" <?php checked( 'placekitten', $image_source, true ); ?>>PlaceKitten
			<span>(for random cute kitten images in color or grayscale <a target="_blank"
			                                                               href="http://placekitten.com/">PlaceKitten</a>)</span>
		</label>
		<?php
	}

	/**
	 * Sanitize input fields
	 */
	public function sanitize_fields( $input ) {
		$new_input = array();

		if ( isset( $input['image_source'] ) ) {
			$new_input['image_source'] = ( 'lorempixel' == $input['image_source'] ) ||
			                             ( 'placekitten' == $input['image_source'] ) ? $input['image_source'] : '';
		}

		return $new_input;
	}

}
