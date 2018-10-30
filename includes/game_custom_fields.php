<?php

/*
_____                        _____                        _
|  __ \                      |  ___|                      | |
| |  \/ __ _ _ __ ___   ___  | |____  _____ ___ _ __ _ __ | |_
| | __ / _` | '_ ` _ \ / _ \ |  __\ \/ / __/ _ \ '__| '_ \| __|
| |_\ \ (_| | | | | | |  __/ | |___>  < (_|  __/ |  | |_) | |_
\____/\__,_|_| |_| |_|\___| \____/_/\_\___\___|_|  | .__/ \__|
                                                   | |
                                                   |_|
*/
class gamedescriptionMetabox {
	private $screen = array(
		'game',
	);
	private $meta_fields = array(
		array(
			'label' => 'Excerpt',
			'id' => 'excerpt_32125',
			'type' => 'textarea',
		),
	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'gamedescription',
				__( 'Game Description', 'textdomain' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'advanced',
				'high'
			);
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'gamedescription_data', 'gamedescription_nonce' );
		echo 'Type in an excerpt for archive/directory listing of this game';
		$this->field_generator( $post );
	}
	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
			if ( empty( $meta_value ) ) {
				$meta_value = $meta_field['default']; }
			switch ( $meta_field['type'] ) {
				case 'textarea':
					$input = sprintf(
						'<textarea style="width: 100%%" id="%s" name="%s" rows="5">%s</textarea>',
						$meta_field['id'],
						$meta_field['id'],
						$meta_value
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}
	public function format_rows( $label, $input ) {
		return '<tr><th>'.$label.'</th><td>'.$input.'</td></tr>';
	}
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['gamedescription_nonce'] ) )
			return $post_id;
		$nonce = $_POST['gamedescription_nonce'];
		if ( !wp_verify_nonce( $nonce, 'gamedescription_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}
if (class_exists('gamedescriptionMetabox')) {
	new gamedescriptionMetabox;
};
/*
_____                       ______                   ______     _        _ _
|  __ \                      | ___ \                  |  _  \   | |      (_) |
| |  \/ __ _ _ __ ___   ___  | |_/ / __ ___  ___ ___  | | | |___| |_ __ _ _| |___
| | __ / _` | '_ ` _ \ / _ \ |  __/ '__/ _ \/ __/ __| | | | / _ \ __/ _` | | / __|
| |_\ \ (_| | | | | | |  __/ | |  | | |  __/\__ \__ \ | |/ /  __/ || (_| | | \__ \
\____/\__,_|_| |_| |_|\___| \_|  |_|  \___||___/___/ |___/ \___|\__\__,_|_|_|___/

*/
class gamepressdetailsMetabox {
	private $screen = array(
		'game',
	);
	private $meta_fields = array(
		array(
			'label' => 'Release Date',
			'id' => 'releasedate_93314',
			'type' => 'date',
		),
		array(
			'label' => 'Developer',
			'id' => 'developer_84172',
			'type' => 'text',
		),
		array(
			'label' => 'Developer Logo',
			'id' => 'developerlogo_77382',
			'type' => 'text',
		),
		array(
			'label' => 'Publisher',
			'id' => 'publisher_77615',
			'type' => 'text',
		),
		array(
			'label' => 'Publisher Logo',
			'id' => 'publisherlogo_29221',
			'type' => 'media',
		),
		array(
			'label' => 'Facebook',
			'id' => 'facebook_15829',
			'type' => 'url',
		),
		array(
			'label' => 'Twitter',
			'id' => 'twitter_51024',
			'type' => 'url',
		),
		array(
			'label' => 'Instagram',
			'id' => 'instagram_24141',
			'type' => 'url',
		),
		array(
			'label' => 'Twitch',
			'id' => 'twitch_87287',
			'type' => 'url',
		),
		array(
			'label' => 'Youtube',
			'id' => 'youtube_37891',
			'type' => 'url',
		),
		array(
			'label' => 'LinkedIn',
			'id' => 'linkedin_58827',
			'type' => 'url',
		),
		array(
			'label' => 'Google +',
			'id' => 'google_95131',
			'type' => 'text',
		),
		array(
			'label' => 'Medium',
			'id' => 'medium_91591',
			'type' => 'url',
		),
	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'admin_footer', array( $this, 'media_fields' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'gamepressdetails',
				__( 'Game Press Details', 'textdomain' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'advanced',
				'default'
			);
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'gamepressdetails_data', 'gamepressdetails_nonce' );
		$this->field_generator( $post );
	}
	public function media_fields() {
		?><script>
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$('.gamepressdetails-media').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$('input#'+id).val(attachment.url);
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
	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
			if ( empty( $meta_value ) ) {
				$meta_value = $meta_field['default']; }
			switch ( $meta_field['type'] ) {
				case 'media':
					$input = sprintf(
						'<input style="width: 80%%" id="%s" name="%s" type="text" value="%s"> <input style="width: 19%%" class="button gamepressdetails-media" id="%s_button" name="%s_button" type="button" value="Upload" />',
						$meta_field['id'],
						$meta_field['id'],
						$meta_value,
						$meta_field['id'],
						$meta_field['id']
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}
	public function format_rows( $label, $input ) {
		return '<tr><th>'.$label.'</th><td>'.$input.'</td></tr>';
	}
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['gamepressdetails_nonce'] ) )
			return $post_id;
		$nonce = $_POST['gamepressdetails_nonce'];
		if ( !wp_verify_nonce( $nonce, 'gamepressdetails_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}
if (class_exists('gamepressdetailsMetabox')) {
	new gamepressdetailsMetabox;
};

/*
______                    _   ___ _
| ___ \                  | | / (_) |
| |_/ / __ ___  ___ ___  | |/ / _| |_
|  __/ '__/ _ \/ __/ __| |    \| | __|
| |  | | |  __/\__ \__ \ | |\  \ | |_
\_|  |_|  \___||___/___/ \_| \_/_|\__|
*/

class presskitMetabox {
	private $screen = array(
		'game',
	);
	private $meta_fields = array(
		array(
			'label' => 'File Upload',
			'id' => 'fileupload_54174',
			'type' => 'media',
		),
	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'admin_footer', array( $this, 'media_fields' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'presskit',
				__( 'Press Kit', 'textdomain' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'advanced',
				'default'
			);
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'presskit_data', 'presskit_nonce' );
		echo 'Upload a .zip file of the press materials';
		$this->field_generator( $post );
	}
	public function media_fields() {
		?><script>
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$('.presskit-media').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$('input#'+id).val(attachment.url);
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
	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
			if ( empty( $meta_value ) ) {
				$meta_value = $meta_field['default']; }
			switch ( $meta_field['type'] ) {
				case 'media':
					$input = sprintf(
						'<input style="width: 80%%" id="%s" name="%s" type="text" value="%s"> <input style="width: 19%%" class="button presskit-media" id="%s_button" name="%s_button" type="button" value="Upload" />',
						$meta_field['id'],
						$meta_field['id'],
						$meta_value,
						$meta_field['id'],
						$meta_field['id']
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}
	public function format_rows( $label, $input ) {
		return '<tr><th>'.$label.'</th><td>'.$input.'</td></tr>';
	}
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['presskit_nonce'] ) )
			return $post_id;
		$nonce = $_POST['presskit_nonce'];
		if ( !wp_verify_nonce( $nonce, 'presskit_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}
if (class_exists('presskitMetabox')) {
	new presskitMetabox;
};

/*
______                          _   _                   _  ___  ___      _            _       _
| ___ \                        | | (_)                 | | |  \/  |     | |          (_)     | |
| |_/ / __ ___  _ __ ___   ___ | |_ _  ___  _ __   __ _| | | .  . | __ _| |_ ___ _ __ _  __ _| |___
|  __/ '__/ _ \| '_ ` _ \ / _ \| __| |/ _ \| '_ \ / _` | | | |\/| |/ _` | __/ _ \ '__| |/ _` | / __|
| |  | | | (_) | | | | | | (_) | |_| | (_) | | | | (_| | | | |  | | (_| | ||  __/ |  | | (_| | \__ \
\_|  |_|  \___/|_| |_| |_|\___/ \__|_|\___/|_| |_|\__,_|_| \_|  |_/\__,_|\__\___|_|  |_|\__,_|_|___/
*/
class promotionalmediaMetabox {
	private $screen = array(
		'game',
	);
	private $meta_fields = array(
		array(
			'label' => 'Trailer (External URL)',
			'id' => 'trailerexterna_73186',
			'type' => 'url',
		),
		array(
			'label' => 'Cover Art Banner',
			'id' => 'coverartbanner_31294',
			'type' => 'media',
		),
		array(
			'label' => 'Screenshot 1',
			'id' => 'screenshot1_95638',
			'type' => 'media',
		),
		array(
			'label' => 'Screenshot 2',
			'id' => 'screenshot2_52269',
			'type' => 'media',
		),
		array(
			'label' => 'Screenshot 3',
			'id' => 'screenshot3_24110',
			'type' => 'media',
		),
		array(
			'label' => 'Screenshot 4',
			'id' => 'screenshot4_69112',
			'type' => 'media',
		),
		array(
			'label' => 'Screenshot 5',
			'id' => 'screenshot5_11335',
			'type' => 'media',
		),
	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'admin_footer', array( $this, 'media_fields' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'promotionalmedia',
				__( 'Promotional Media', 'textdomain' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'advanced',
				'default'
			);
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'promotionalmedia_data', 'promotionalmedia_nonce' );
		echo 'Add screenshots and cover-art for your game.';
		$this->field_generator( $post );
	}
	public function media_fields() {
		?><script>
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$('.promotionalmedia-media').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$('input#'+id).val(attachment.url);
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
	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
			if ( empty( $meta_value ) ) {
				$meta_value = $meta_field['default']; }
			switch ( $meta_field['type'] ) {
				case 'media':
					$input = sprintf(
						'<input style="width: 80%%" id="%s" name="%s" type="text" value="%s"> <input style="width: 19%%" class="button promotionalmedia-media" id="%s_button" name="%s_button" type="button" value="Upload" />',
						$meta_field['id'],
						$meta_field['id'],
						$meta_value,
						$meta_field['id'],
						$meta_field['id']
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}
	public function format_rows( $label, $input ) {
		return '<tr><th>'.$label.'</th><td>'.$input.'</td></tr>';
	}
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['promotionalmedia_nonce'] ) )
			return $post_id;
		$nonce = $_POST['promotionalmedia_nonce'];
		if ( !wp_verify_nonce( $nonce, 'promotionalmedia_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}
if (class_exists('promotionalmediaMetabox')) {
	new promotionalmediaMetabox;
};

/*
   ___             _ _ _     _       ______ _       _    __
  / _ \           | (_) |   | |      | ___ \ |     | |  / _|
 / /_\ \_   ____ _| |_| |__ | | ___  | |_/ / | __ _| |_| |_ ___  _ __ _ __ ___  ___
|  _  \ \ / / _` | | | '_ \| |/ _ \ |  __/| |/ _` | __|  _/ _ \| '__| '_ ` _ \/ __|
| | | |\ V / (_| | | | |_) | |  __/ | |   | | (_| | |_| || (_) | |  | | | | | \__ \
\_| |_/ \_/ \__,_|_|_|_.__/|_|\___| \_|   |_|\__,_|\__|_| \___/|_|  |_| |_| |_|___/
*/

class platformsMetabox {
	private $screen = array(
		'game',
	);
	private $meta_fields = array(
		array(
			'label' => 'Windows',
			'id' => 'windows_48100',
			'type' => 'url',
		),
		array(
			'label' => 'MacOS',
			'id' => 'macos_32147',
			'type' => 'url',
		),
		array(
			'label' => 'Linux',
			'id' => 'linux_18351',
			'type' => 'url',
		),
		array(
			'label' => 'Xbox One',
			'id' => 'xboxone_45137',
			'type' => 'url',
		),
		array(
			'label' => 'PlayStation 4',
			'id' => 'playstation4_94115',
			'type' => 'url',
		),
		array(
			'label' => 'Nintendo Switch',
			'id' => 'nintendoswitch_65714',
			'type' => 'url',
		),
		array(
			'label' => 'Xbox 360',
			'id' => 'xbox361_49697',
			'type' => 'url',
		),
		array(
			'label' => 'PlayStation 3 ',
			'id' => 'playstation3_62445',
			'type' => 'url',
		),
		array(
			'label' => 'Nintendo Wii',
			'id' => 'nintendowii_52498',
			'type' => 'url',
		),
		array(
			'label' => 'Nintendo DS',
			'id' => 'nintendods_23911',
			'type' => 'url',
		),
		array(
			'label' => 'PlayStation Vita',
			'id' => 'playstationvita_52129',
			'type' => 'url',
		),
    array(
			'label' => 'Android',
			'id' => 'android_52129',
			'type' => 'url',
		),
    array(
			'label' => 'IPhone',
			'id' => 'iphone_52129',
			'type' => 'url',
		),
	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'platforms',
				__( 'Platforms', 'textdomain' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'advanced',
				'default'
			);
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'platforms_data', 'platforms_nonce' );
		echo 'Add links to all platforms that your game is available on.';
		$this->field_generator( $post );
	}
	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
			if ( empty( $meta_value ) ) {
				$meta_value = $meta_field['default']; }
			switch ( $meta_field['type'] ) {
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}
	public function format_rows( $label, $input ) {
		return '<tr><th>'.$label.'</th><td>'.$input.'</td></tr>';
	}
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['platforms_nonce'] ) )
			return $post_id;
		$nonce = $_POST['platforms_nonce'];
		if ( !wp_verify_nonce( $nonce, 'platforms_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}
if (class_exists('platformsMetabox')) {
	new platformsMetabox;
};

/*
______                 _                               _\
| ___ \               (_)                             | |
| |_/ /___  __ _ _   _ _ _ __ ___ _ __ ___   ___ _ __ | |_ ___
|    // _ \/ _` | | | | | '__/ _ \ '_ ` _ \ / _ \ '_ \| __/ __|
| |\ \  __/ (_| | |_| | | | |  __/ | | | | |  __/ | | | |_\__ \
\_| \_\___|\__, |\__,_|_|_|  \___|_| |_| |_|\___|_| |_|\__|___/
              | |
              |_|
*/
class systemrequirementsMetabox {
	private $screen = array(
		'game',
	);
	private $meta_fields = array(
		array(
			'label' => 'Desktop',
			'id' => 'desktop_36797',
			'type' => 'wysiwyg',
		),
		array(
			'label' => 'Console',
			'id' => 'console_99245',
			'type' => 'wysiwyg',
		),
		array(
			'label' => 'Handheld',
			'id' => 'handheld_22994',
			'type' => 'wysiwyg',
		),
		array(
			'label' => 'Mobile',
			'id' => 'mobile_68715',
			'type' => 'wysiwyg',
		),
	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'systemrequirements',
				__( 'System Requirements', 'textdomain' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'advanced',
				'default'
			);
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'systemrequirements_data', 'systemrequirements_nonce' );
		echo 'Requirements on all available platforms';
		$this->field_generator( $post );
	}
	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
			if ( empty( $meta_value ) ) {
				$meta_value = $meta_field['default']; }
			switch ( $meta_field['type'] ) {
				case 'wysiwyg':
					ob_start();
					wp_editor($meta_value, $meta_field['id']);
					$input = ob_get_contents();
					ob_end_clean();
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}
	public function format_rows( $label, $input ) {
		return '<tr><th>'.$label.'</th><td>'.$input.'</td></tr>';
	}
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['systemrequirements_nonce'] ) )
			return $post_id;
		$nonce = $_POST['systemrequirements_nonce'];
		if ( !wp_verify_nonce( $nonce, 'systemrequirements_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}
if (class_exists('systemrequirementsMetabox')) {
	new systemrequirementsMetabox;
};

/*
______      _   _
| ___ \    | | (_)
| |_/ /__ _| |_ _ _ __   __ _ ___
|    // _` | __| | '_ \ / _` / __|
| |\ \ (_| | |_| | | | | (_| \__ \
\_| \_\__,_|\__|_|_| |_|\__, |___/
                         __/ |
                        |___/
*/

class ratingMetabox {
	private $screen = array(
		'game',
	);
	private $meta_fields = array(
		array(
			'label' => 'ESRB',
			'id' => 'esrb_51945',
			'default' => '0',
			'type' => 'select',
			'options' => array(
				'None',
				'Rating Pending',
				'Early Childhood',
				'Everyone',
				'Everyone 10+',
				'Teen',
				'Mature',
				'Adults Only',
			),
		),
		array(
			'label' => 'PEGI',
			'id' => 'pegi_15286',
			'type' => 'select',
			'options' => array(
				'None',
				'PEGI 3',
				'PEGI 7',
				'PEGI 12',
				'PEGI 16',
				'PEGI 18',
			),
		),
	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'rating',
				__( 'Rating', 'textdomain' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'side',
				'default'
			);
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'rating_data', 'rating_nonce' );
		echo 'The rating for your game (Supports ESRB and PEGI)';
		$this->field_generator( $post );
	}
	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
			if ( empty( $meta_value ) ) {
				$meta_value = $meta_field['default']; }
			switch ( $meta_field['type'] ) {
				case 'select':
					$input = sprintf(
						'<select id="%s" name="%s">',
						$meta_field['id'],
						$meta_field['id']
					);
					foreach ( $meta_field['options'] as $key => $value ) {
						$meta_field_value = !is_numeric( $key ) ? $key : $value;
						$input .= sprintf(
							'<option %s value="%s">%s</option>',
							$meta_value === $meta_field_value ? 'selected' : '',
							$meta_field_value,
							$value
						);
					}
					$input .= '</select>';
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}
	public function format_rows( $label, $input ) {
		return '<tr><th>'.$label.'</th><td>'.$input.'</td></tr>';
	}
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['rating_nonce'] ) )
			return $post_id;
		$nonce = $_POST['rating_nonce'];
		if ( !wp_verify_nonce( $nonce, 'rating_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}
if (class_exists('ratingMetabox')) {
	new ratingMetabox;
};
