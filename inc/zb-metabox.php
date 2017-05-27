<?php
class ZB_Meta_Box {
	private $screens = array( 'zb-post' ); // Post Types: post, page, dashboard, link, attachment, custom_post_type

	private $fields = array(
		array(
			'id' => 'text',
			'label' => 'Text',
			'type' => 'text',
		),
		array(
			'id' => 'number',
			'label' => 'Number',
			'type' => 'number',
		),
		array(
			'id' => 'email',
			'label' => 'Email',
			'type' => 'email',
		),
		array(
			'id' => 'tel',
			'label' => 'Tel',
			'type' => 'tel',
		),
		array(
			'id' => 'url',
			'label' => 'Url',
			'type' => 'url',
		),
		array(
			'id' => 'password',
			'label' => 'Password',
			'type' => 'password',
		),
		array(
			'id' => 'textarea',
			'label' => 'Textarea',
			'type' => 'textarea',
		),		
		array(
			'id' => 'checkbox',
			'label' => 'Checkbox',
			'type' => 'checkbox',
		),
		array(
			'id' => 'radio',
			'label' => 'Radio',
			'type' => 'radio',
			'options' => array(
				'1',
				'2',
				'3',
				'4',
				'5',
			),
		),
		array(
			'id' => 'select',
			'label' => 'Select',
			'type' => 'select',
			'options' => array(
				'1',
				'2',
				'3',
				'4',
				'5',
			),
		),		
		array(
			'id' => 'date',
			'label' => 'Date',
			'type' => 'date',
		),
		array(
			'id' => 'time',
			'label' => 'Time',
			'type' => 'time',
		),
		array(
			'id' => 'datetime-local',
			'label' => 'Datetime Local',
			'type' => 'datetime-local',
		),
		array(
			'id' => 'month',
			'label' => 'Month',
			'type' => 'month',
		),
		array(
			'id' => 'week',
			'label' => 'Week',
			'type' => 'week',
		),
		array(
			'id' => 'color',
			'label' => 'Color',
			'type' => 'color',
		),
		array(
			'id' => 'media',
			'label' => 'Media',
			'type' => 'media',
		),
		array(
			'id' => 'range',
			'label' => 'Range',
			'type' => 'range',
		),
	);

	/**
	 * Class construct method. Adds actions to their respective WordPress hooks.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'admin_footer', array( $this, 'admin_footer' ) );
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	/**
	 * Hooks into WordPress' add_meta_boxes function.
	 * Goes through screens (post types) and adds the meta box.
	 */
	public function add_meta_boxes() {
		foreach ( $this->screens as $screen ) {
			add_meta_box(
				'zb-meta-box',
				__( 'ZB Meta Box', 'zero-blank' ),
				array( $this, 'add_meta_box_callback' ),
				$screen,
				'advanced', // Context: normal, advanced, side
				'default' // Priority: hight, core, default, low
			);
		}
	}

	/**
	 * Generates the HTML for the meta box
	 * 
	 * @param object $post WordPress post object
	 */
	public function add_meta_box_callback( $post ) {
		wp_nonce_field( 'zb_meta_box_data', 'zb_meta_box_nonce' );
		echo 'Advanced Options';
		$this->generate_fields( $post );
	}

	/**
	 * Hooks into WordPress' admin_footer function.
	 * Adds scripts for media uploader.
	 */
	public function admin_footer() {
		?><script>
			// https://codestag.com/how-to-use-wordpress-3-5-media-uploader-in-theme-options/
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$('.rational-metabox-media').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$("#"+id).val(attachment.url);
							} else {
								return _orig_send_attachment.apply( this, [props, attachment] );
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function(){
						_custom_media = false;
					});
				}
			});
		</script><?php
	}

	/**
	 * Generates the field's HTML for the meta box.
	 */
	public function generate_fields( $post ) {
		$output = '';
		foreach ( $this->fields as $field ) {
			$label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
			$db_value = get_post_meta( $post->ID, 'zb_meta_box_' . $field['id'], true );
			switch ( $field['type'] ) {
				case 'checkbox':
					$input = sprintf(
						'<input %s id="%s" name="%s" type="checkbox" value="1">',
						$db_value === '1' ? 'checked' : '',
						$field['id'],
						$field['id']
					);
					break;
				case 'media':
					$input = sprintf(
						'<input class="regular-text" id="%s" name="%s" type="text" value="%s"> <input class="button rational-metabox-media" id="%s_button" name="%s_button" type="button" value="Upload" />',
						$field['id'],
						$field['id'],
						$db_value,
						$field['id'],
						$field['id']
					);
					break;
				case 'radio':
					$input = '<fieldset>';
					$input .= '<legend class="screen-reader-text">' . $field['label'] . '</legend>';
					$i = 0;
					foreach ( $field['options'] as $key => $value ) {
						$field_value = !is_numeric( $key ) ? $key : $value;
						$input .= sprintf(
							'<label><input %s id="%s" name="%s" type="radio" value="%s"> %s</label>%s',
							$db_value === $field_value ? 'checked' : '',
							$field['id'],
							$field['id'],
							$field_value,
							$value,
							$i < count( $field['options'] ) - 1 ? '<br>' : ''
						);
						$i++;
					}
					$input .= '</fieldset>';
					break;
				case 'select':
					$input = sprintf(
						'<select id="%s" name="%s">',
						$field['id'],
						$field['id']
					);
					foreach ( $field['options'] as $key => $value ) {
						$field_value = !is_numeric( $key ) ? $key : $value;
						$input .= sprintf(
							'<option %s value="%s">%s</option>',
							$db_value === $field_value ? 'selected' : '',
							$field_value,
							$value
						);
					}
					$input .= '</select>';
					break;
				case 'textarea':
					$input = sprintf(
						'<textarea class="large-text" id="%s" name="%s" rows="5">%s</textarea>',
						$field['id'],
						$field['id'],
						$db_value
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$field['type'] !== 'color' ? 'class="regular-text"' : '',
						$field['id'],
						$field['id'],
						$field['type'],
						$db_value
					);
			}
			$output .= $this->row_format( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}

	/**
	 * Generates the HTML for table rows.
	 */
	public function row_format( $label, $input ) {
		return sprintf(
			'<tr><th scope="row">%s</th><td>%s</td></tr>',
			$label,
			$input
		);
	}
	/**
	 * Hooks into WordPress' save_post function
	 */
	public function save_post( $post_id ) {
		if ( ! isset( $_POST['zb_meta_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['zb_meta_box_nonce'];
		if ( !wp_verify_nonce( $nonce, 'zb_meta_box_data' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		foreach ( $this->fields as $field ) {
			if ( isset( $_POST[ $field['id'] ] ) ) {
				switch ( $field['type'] ) {
					case 'email':
						$_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
						break;
					case 'text':
						$_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
						break;
				}
				update_post_meta( $post_id, 'zb_meta_box_' . $field['id'], $_POST[ $field['id'] ] );
			} else if ( $field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, 'zb_meta_box_' . $field['id'], '0' );
			}
		}
	}
}
new ZB_Meta_Box;
