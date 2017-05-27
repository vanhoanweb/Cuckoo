<?php
class ZBOptions {
	private $zb_options_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'zb_options_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'zb_options_page_init' ) );
	}

	public function zb_options_add_plugin_page() {
		add_menu_page(
			'ZB Options', // page_title
			'ZB Options', // menu_title
			'manage_options', // capability
			'zb-options', // menu_slug
			array( $this, 'zb_options_create_admin_page' ), // function
			'dashicons-admin-generic', // icon_url
			100 // position
		);
		/*add_submenu_page(
			'options-general.php',
			'ZB Options', // page_title
			'ZB Options', // menu_title
			'manage_options', // capability
			'zb-options', // menu_slug
			array( $this, 'zb_options_create_admin_page' ) // function
		);*/
	}

	public function zb_options_create_admin_page() {
		$this->zb_options_options = get_option( 'zb_options_option_name' ); ?>

		<div class="wrap">
			<h2>ZB Settings</h2>
			<p>ZB Custom Settings</p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'zb_options_option_group' );
					do_settings_sections( 'zb-options-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function zb_options_page_init() {
		register_setting(
			'zb_options_option_group', // option_group
			'zb_options_option_name', // option_name
			array( $this, 'zb_options_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'zb_options_setting_section', // id
			'Settings', // title
			array( $this, 'zb_options_section_info' ), // callback
			'zb-options-admin' // page
		);

		add_settings_field(
			'text_0', // id
			'Text', // title
			array( $this, 'text_0_callback' ), // callback
			'zb-options-admin', // page
			'zb_options_setting_section' // section
		);

		add_settings_field(
			'textarea_1', // id
			'Textarea', // title
			array( $this, 'textarea_1_callback' ), // callback
			'zb-options-admin', // page
			'zb_options_setting_section' // section
		);

		add_settings_field(
			'select_2', // id
			'Select', // title
			array( $this, 'select_2_callback' ), // callback
			'zb-options-admin', // page
			'zb_options_setting_section' // section
		);

		add_settings_field(
			'checkbox_3', // id
			'Checkbox', // title
			array( $this, 'checkbox_3_callback' ), // callback
			'zb-options-admin', // page
			'zb_options_setting_section' // section
		);

		add_settings_field(
			'radio_4', // id
			'Radio', // title
			array( $this, 'radio_4_callback' ), // callback
			'zb-options-admin', // page
			'zb_options_setting_section' // section
		);
	}

	public function zb_options_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['text_0'] ) ) {
			$sanitary_values['text_0'] = sanitize_text_field( $input['text_0'] );
		}

		if ( isset( $input['textarea_1'] ) ) {
			$sanitary_values['textarea_1'] = esc_textarea( $input['textarea_1'] );
		}

		if ( isset( $input['select_2'] ) ) {
			$sanitary_values['select_2'] = $input['select_2'];
		}

		if ( isset( $input['checkbox_3'] ) ) {
			$sanitary_values['checkbox_3'] = $input['checkbox_3'];
		}

		if ( isset( $input['radio_4'] ) ) {
			$sanitary_values['radio_4'] = $input['radio_4'];
		}

		return $sanitary_values;
	}

	public function zb_options_section_info() {
		
	}

	public function text_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="zb_options_option_name[text_0]" id="text_0" value="%s">',
			isset( $this->zb_options_options['text_0'] ) ? esc_attr( $this->zb_options_options['text_0']) : ''
		);
	}

	public function textarea_1_callback() {
		printf(
			'<textarea class="large-text" rows="5" name="zb_options_option_name[textarea_1]" id="textarea_1">%s</textarea>',
			isset( $this->zb_options_options['textarea_1'] ) ? esc_attr( $this->zb_options_options['textarea_1']) : ''
		);
	}

	public function select_2_callback() {
		?> <select name="zb_options_option_name[select_2]" id="select_2">
			<?php $selected = (isset( $this->zb_options_options['select_2'] ) && $this->zb_options_options['select_2'] === '1') ? 'selected' : '' ; ?>
			<option value="1" <?php echo $selected; ?>>1</option>
			<?php $selected = (isset( $this->zb_options_options['select_2'] ) && $this->zb_options_options['select_2'] === '2') ? 'selected' : '' ; ?>
			<option value="2" <?php echo $selected; ?>>2</option>
			<?php $selected = (isset( $this->zb_options_options['select_2'] ) && $this->zb_options_options['select_2'] === '3') ? 'selected' : '' ; ?>
			<option value="3" <?php echo $selected; ?>>3</option>
			<?php $selected = (isset( $this->zb_options_options['select_2'] ) && $this->zb_options_options['select_2'] === '4') ? 'selected' : '' ; ?>
			<option value="4" <?php echo $selected; ?>>4</option>
			<?php $selected = (isset( $this->zb_options_options['select_2'] ) && $this->zb_options_options['select_2'] === '5') ? 'selected' : '' ; ?>
			<option value="5" <?php echo $selected; ?>>5</option>
		</select> <?php
	}

	public function checkbox_3_callback() {
		printf(
			'<input type="checkbox" name="zb_options_option_name[checkbox_3]" id="checkbox_3" value="checkbox_3" %s> <label for="checkbox_3">Checkbox</label>',
			( isset( $this->zb_options_options['checkbox_3'] ) && $this->zb_options_options['checkbox_3'] === 'checkbox_3' ) ? 'checked' : ''
		);
	}

	public function radio_4_callback() {
		?> <fieldset><?php $checked = ( isset( $this->zb_options_options['radio_4'] ) && $this->zb_options_options['radio_4'] === '1' ) ? 'checked' : '' ; ?>
		<label for="radio_4-0"><input type="radio" name="zb_options_option_name[radio_4]" id="radio_4-0" value="1" <?php echo $checked; ?>> 1</label><br>
		<?php $checked = ( isset( $this->zb_options_options['radio_4'] ) && $this->zb_options_options['radio_4'] === '2' ) ? 'checked' : '' ; ?>
		<label for="radio_4-1"><input type="radio" name="zb_options_option_name[radio_4]" id="radio_4-1" value="2" <?php echo $checked; ?>> 2</label><br>
		<?php $checked = ( isset( $this->zb_options_options['radio_4'] ) && $this->zb_options_options['radio_4'] === '3' ) ? 'checked' : '' ; ?>
		<label for="radio_4-2"><input type="radio" name="zb_options_option_name[radio_4]" id="radio_4-2" value="3" <?php echo $checked; ?>> 3</label><br>
		<?php $checked = ( isset( $this->zb_options_options['radio_4'] ) && $this->zb_options_options['radio_4'] === '4' ) ? 'checked' : '' ; ?>
		<label for="radio_4-3"><input type="radio" name="zb_options_option_name[radio_4]" id="radio_4-3" value="4" <?php echo $checked; ?>> 4</label><br>
		<?php $checked = ( isset( $this->zb_options_options['radio_4'] ) && $this->zb_options_options['radio_4'] === '5' ) ? 'checked' : '' ; ?>
		<label for="radio_4-4"><input type="radio" name="zb_options_option_name[radio_4]" id="radio_4-4" value="5" <?php echo $checked; ?>> 5</label></fieldset> <?php
	}

}
if ( is_admin() )
	$zb_options = new ZBOptions();

/* 
 * Retrieve this value with:
 * $zb_options_options = get_option( 'zb_options_option_name' ); // Array of All Options
 * $text_0 = $zb_options_options['text_0']; // Text
 * $textarea_1 = $zb_options_options['textarea_1']; // Textarea
 * $select_2 = $zb_options_options['select_2']; // Select
 * $checkbox_3 = $zb_options_options['checkbox_3']; // Checkbox
 * $radio_4 = $zb_options_options['radio_4']; // Radio
 */
