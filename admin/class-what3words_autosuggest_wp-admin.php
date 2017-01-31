<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://codetheory.london
 * @since      1.0.0
 *
 * @package    What3words_autosuggest_wp
 * @subpackage What3words_autosuggest_wp/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    What3words_autosuggest_wp
 * @subpackage What3words_autosuggest_wp/admin
 * @author     Jozsef Francovszky <franszo@codetheory.london>
 */
class What3words_autosuggest_wp_Admin {

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
		 * defined in What3words_autosuggest_wp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The What3words_autosuggest_wp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/what3words_autosuggest_wp-admin.css', array(), $this->version, 'all' );

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
		 * defined in What3words_autosuggest_wp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The What3words_autosuggest_wp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/what3words_autosuggest_wp-admin.js', array( 'jquery' ), $this->version, false );

	}

}


/* w3w Autosuggest Plugin - Admin page *************/
/*
*
*
/
/**
 * @internal    never define functions inside callbacks.
 *              these functions could be run multiple times; this would result in a fatal error.
 */

/**
 * custom option and settings
 */
function w3w_settings_init()
{
    // register a new setting for "w3w" page
    register_setting('w3w', 'w3w_options');

    // register a new section in the "w3w" page
    add_settings_section(
        'w3w_section_developers',
        __('<img src="https://assets.what3words.com/images/what3words_e-mail-logo.png" width="250"/>', 'w3w'),
        'w3w_section_developers_cb',
        'w3w'
    );

    add_settings_field(
        'w3w_field_input', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __('Input field', 'w3w'),
        'w3w_field_input_cb',
        'w3w',
        'w3w_section_developers',
        [
            'label_for'         => 'w3w_field_input',
            'class'             => 'w3w_row',
            'w3w_custom_data' => 'custom',
        ]
    );

    add_settings_field(
        'w3w_field_country', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __('Country Selector', 'w3w'),
        'w3w_field_country_cb',
        'w3w',
        'w3w_section_developers',
        [
            'label_for'         => 'w3w_field_country',
            'class'             => 'w3w_row',
            'w3w_custom_data' => 'custom',
        ]
    );

    add_settings_field(
        'w3w_field_api_key', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __('w3w API KEY', 'w3w'),
        'w3w_field_api_key_cb',
        'w3w',
        'w3w_section_developers',
        [
            'label_for'         => 'w3w_field_api_key',
            'class'             => 'w3w_row',
            'w3w_custom_data' => 'custom',
        ]
    );

    // register a new field in the "w3w_section_developers" section, inside the "w3w" page
    add_settings_field(
        'w3w_field_items_to_show', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __('Number of results', 'w3w'),
        'w3w_field_items_to_show_cb',
        'w3w',
        'w3w_section_developers',
        [
            'label_for'         => 'w3w_field_items_to_show',
            'class'             => 'w3w_row',
            'w3w_custom_data' => 'custom',
        ]
    );

}

/**
 * register our w3w_settings_init to the admin_init action hook
 */
add_action('admin_init', 'w3w_settings_init');

/**
 * custom option and settings:
 * callback functions
 */

// developers section cb

// section callbacks can accept an $args parameter, which is an array.
// $args have the following keys defined: title, id, callback.
// the values are defined at the add_settings_section() function.
function w3w_section_developers_cb($args)
{
    ?>
    <p id="<?= esc_attr($args['id']); ?>"><?= esc_html__('In order to use w3w services you must use your own w3w API key!', 'w3w'); ?></p>
    <?php
}

// pill field cb

// field callbacks can accept an $args parameter, which is an array.
// $args is defined at the add_settings_field() function.
// wordpress has magic interaction with the following keys: label_for, class.
// the "label_for" key value is used for the "for" attribute of the <label>.
// the "class" key value is used for the "class" attribute of the <tr> containing the field.
// you can add custom key value pairs to be used inside your callbacks.


    // Create / Add the object field where we initialising the plugin on

function w3w_field_input_cb($args)
{
    // get the value of the setting we've registered with register_setting()
    $options = get_option('w3w_options');
    // output the field
    ?>
    <input id="<?= esc_attr($args['label_for']); ?>" data-custom="<?= esc_attr($args['w3w_custom_data']); ?>" name="w3w_options[<?= esc_attr($args['label_for']); ?>]" type="text" value="<?php echo esc_attr( $options['w3w_field_input'] ); ?>">
    <p class="description">
        <?= esc_html('Selector of input object where you like the w3w Autosuggest to initialise on?', 'w3w'); ?>
    </p>
    <?php
}

    // Create / Add Country selector field

function w3w_field_country_cb($args)
{
    // get the value of the setting we've registered with register_setting()
    $options = get_option('w3w_options');
    // output the field
    ?>
    <input id="<?= esc_attr($args['label_for']); ?>" data-custom="<?= esc_attr($args['w3w_custom_data']); ?>" name="w3w_options[<?= esc_attr($args['label_for']); ?>]" type="text" value="<?php echo esc_attr( $options['w3w_field_country'] ); ?>">
    <p class="description">
        <?= esc_html('OPTIONAL - Selector of Country Selector field', 'w3w'); ?>
    </p>
    <?php
}

    //Create / Add API key field

function w3w_field_api_key_cb($args)
{
    // get the value of the setting we've registered with register_setting()
    $options = get_option('w3w_options');
    // output the field
    ?>
    <input id="<?= esc_attr($args['label_for']); ?>" data-custom="<?= esc_attr($args['w3w_custom_data']); ?>" name="w3w_options[<?= esc_attr($args['label_for']); ?>]" type="text" value="<?php echo esc_attr( $options['w3w_field_api_key'] ); ?>">
    <p class="description">
        <?= esc_html('Please proved your what3words API KEY.', 'w3w'); ?>
    </p>
    <?php
}

function w3w_field_items_to_show_cb($args)
{
    // get the value of the setting we've registered with register_setting()
    $options = get_option('w3w_options');

    //var_dump($options);
    // output the field
    ?>
    <select id="<?= esc_attr($args['label_for']); ?>"
            data-custom="<?= esc_attr($args['w3w_custom_data']); ?>"
            name="w3w_options[<?= esc_attr($args['label_for']); ?>]"
    >
        <option value="1" <?= isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], '1', false)) : (''); ?>>
            <?= esc_html('1', 'w3w'); ?>
        </option>
        <option value="2" <?= isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], '2', false)) : (''); ?>>
            <?= esc_html('2', 'w3w'); ?>
        </option>
        <option value="3" <?= isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], '3', false)) : (''); ?>>
            <?= esc_html('3', 'w3w'); ?>
        </option>
        <option value="4" <?= isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], '4', false)) : (''); ?>>
            <?= esc_html('4', 'w3w'); ?>
        </option>
        <option value="5" <?= isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], '5', false)) : (''); ?>>
            <?= esc_html('5', 'w3w'); ?>
        </option>
        <option value="6" <?= isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], '6', false)) : (''); ?>>
            <?= esc_html('6', 'w3w'); ?>
        </option>
        <option value="7" <?= isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], '7', false)) : (''); ?>>
            <?= esc_html('7', 'w3w'); ?>
        </option>
        <option value="8" <?= isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], '8', false)) : (''); ?>>
            <?= esc_html('8', 'w3w'); ?>
        </option>
    </select>
    <p class="description">
        <?= esc_html('Select number of results wanted in the w3w Autosuggest field', 'w3w'); ?>
    </p>
    <?php
}

/**
 * top level menu
 */
function w3w_options_page()
{
    // add top level menu page
    add_menu_page(
        'what3words Autosuggest Wordpress plugin',
        'w3w Options',
        'manage_options',
        'w3w',
        'w3w_options_page_html'
    );
}

/**
 * register our w3w_options_page to the admin_menu action hook
 */
add_action('admin_menu', 'w3w_options_page');

/**
 * top level menu:
 * callback functions
 */
function w3w_options_page_html()
{
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    // add error/update messages

    // check if the user have submitted the settings
    // wordpress will add the "settings-updated" $_GET parameter to the url
    if (isset($_GET['settings-updated'])) {
        // add settings saved message with the class of "updated"
        add_settings_error('w3w_messages', 'w3w_message', __('Settings Saved', 'w3w'), 'updated');
    }

    // show error/update messages
    settings_errors('w3w_messages');
    ?>
    <div class="wrap">
        <h1><?= esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "w3w"
            settings_fields('w3w');
            // output setting sections and their fields
            // (sections are registered for "w3w", each field is registered to a specific section)
            do_settings_sections('w3w');
            // output save settings button
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}