<?php
	
		/*
		
			THIS FILE IS REGISTERS THE ACF FIELDS FOR USE WITH THIS PLUGIN.
			IT CHECKS IF THE GALLERY PLUGIN IS ACTIVE - IF YES, THE FIELDS WILL BE REGISTERED. 
			IF NOT, IT SHOW AN ERROR NOTICE FOR ADMINS.
			
		*/
		
	
		//define error notice if gallery plugin is not installed and active
		function acf_repeater_not_found_notice() {
		    ?>
		    <div class="error">
		        <p><?php _e( 'ACHTUNG! Du hast das Tabbing Plugin installiert. Allerdings wurde das benötigte ACF Repeater Plugin nicht gefunden. Installiere es bitte damit das Tabbing Plugin korrekt funktionieren kann.', 'Tabbing' ); ?></p>
		    </div>
		    <?php
		}
	
	
		//main register acf function
		function register_acf_repeater(){
						
			//check if gallery plugin is installed and active
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			if ( is_plugin_active( 'acf-repeater/acf-repeater.php' ) ) {
				
				//check if function exists to prevent errors
				if(function_exists("register_field_group"))
				{
					register_field_group(array (
						'id' => 'acf_tabs',
						'title' => 'Tabs',
						'fields' => array (
							array (
								'key' => 'field_535633062b193',
								'label' => 'Tabs',
								'name' => 'tabs',
								'type' => 'repeater',
								'sub_fields' => array (
									array (
										'key' => 'field_535633b02b195',
										'label' => 'Titel',
										'name' => 'titel',
										'type' => 'text',
										'column_width' => '',
										'default_value' => '',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'formatting' => 'html',
										'maxlength' => '',
									),
									array (
										'key' => 'field_535633b82b196',
										'label' => 'Inhalt',
										'name' => 'inhalt',
										'type' => 'wysiwyg',
										'column_width' => '',
										'default_value' => '',
										'toolbar' => 'full',
										'media_upload' => 'no',
									),
									array (
										'key' => 'field_535636f52b197',
										'label' => '1. Bild',
										'name' => 'first_img',
										'type' => 'image',
										'column_width' => '',
										'save_format' => 'id',
										'preview_size' => 'thumbnail',
										'library' => 'all',
									),
									array (
										'key' => 'field_535637062b198',
										'label' => '2. bild',
										'name' => 'second_img',
										'type' => 'image',
										'column_width' => '',
										'save_format' => 'id',
										'preview_size' => 'thumbnail',
										'library' => 'all',
									),
									array (
										'key' => 'field_535637112b199',
										'label' => 'Bilder rechts oder links?',
										'name' => 'img_ausrichtung',
										'type' => 'radio',
										'column_width' => '',
										'choices' => array (
											'left' => 'Links',
											'right' => 'Rechts',
										),
										'other_choice' => 0,
										'save_other_choice' => 0,
										'default_value' => '',
										'layout' => 'horizontal',
									),
								),
								'row_min' => '',
								'row_limit' => '',
								'layout' => 'table',
								'button_label' => 'Tab hinzufügen',
							),
						),
						'location' => array (
							array (
								array (
									'param' => 'post_type',
									'operator' => '==',
									'value' => 'page',
									'order_no' => 0,
									'group_no' => 0,
								),
							),
						),
						'options' => array (
							'position' => 'normal',
							'layout' => 'no_box',
							'hide_on_screen' => array (
								0 => 'permalink',
								1 => 'the_content',
								2 => 'excerpt',
								3 => 'custom_fields',
								4 => 'discussion',
								5 => 'comments',
								6 => 'revisions',
								7 => 'slug',
								8 => 'author',
								9 => 'format',
								10 => 'featured_image',
								11 => 'categories',
								12 => 'tags',
								13 => 'send-trackbacks',
							),
						),
						'menu_order' => 0,
					));
				}
			} else {
				//if gallery plugin is not installed, show error notice (defined on top of this filed)
				add_action( 'admin_notices', 'acf_repeater_not_found_notice' );
			}
		}
		add_action('init','register_acf_repeater');
	
