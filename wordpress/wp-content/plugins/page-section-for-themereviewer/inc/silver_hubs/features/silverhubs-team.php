<?php
function silver_hubs_team_setting( $wp_customize ) {
	$sections = array();
	$teams = apply_filters('silver_hubs_pro_section', $sections);
	$image_position = array(
							'left top' => 'Left Top',
				        	'left center' => 'Left Center',
				        	'left bottom' => 'Left Bottom',
				            'right top' => 'Right Top',
				            'right center' => 'Right Center',
				            'right bottom' => 'Right Bottom',
				            'center top' => 'Center Top',
				            'center center' => 'Center Center',
				            'center bottom' => 'Center Bottom',
		);
		//Our Team
			$wp_customize->add_section( 'silver_hubs_our_team_section' , array(
				'title'  => 'Our Team',
				'panel'  => 'silver_hubs_theme_option_panel',
			) );
			//Our Team tabing 
				$wp_customize->add_setting( 'our_team_section_tab', 
			        array(
			            'default'    => 'general', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'silver_hubs_sanitize_select',
			        ) 
			    ); 
		        $wp_customize->add_control( new silver_hubs_Custom_Radio_Control( 
			        $wp_customize,'our_team_section_tab',array(
			            'settings'   => 'our_team_section_tab', 
			            'priority'   => 10,
			            'section'    => 'silver_hubs_our_team_section',
			            'type'    => 'select',
			            'choices'    => array(
				        	'general' => 'General',
				        	'design' => 'Design',
			        	),
			        ) 
		        ) );
			//Our Team in Title
				$wp_customize->add_setting( 'our_team_main_title', array(
					'default'    => 'Our Team',
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_team_main_title',
			    	array(
						'type' => 'text',
						'settings' => 'our_team_main_title',
						'section' => 'silver_hubs_our_team_section', // // Add a default or your own section
						'label' => 'Our Team Title',
						'active_callback' => 'silver_hubs_our_team_general_callback',
					)
				) );
				if ( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial(
						'our_team_main_title',
						array(
							'selector'        => '.our_team_section',
							'render_callback' => 'silver_hubs_customize_partial_our_team',
						)
					);
				}
			//Our Team in Discription
				$wp_customize->add_setting( 'our_team_main_discription', array(
					'default'    => $teams['team']['description'],
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_team_main_discription',
			    	array(
						'type' => 'textarea',
						'settings' => 'our_team_main_discription',
						'section' => 'silver_hubs_our_team_section', // // Add a default or your own section
						'label' => 'Our Team Discription',  
						'active_callback' => 'silver_hubs_our_team_general_callback',
					)
				) );
			//Our Team in number of section
			    $wp_customize->add_setting( 'our_team_number', array(
			    	'default'  => 4,
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'silver_hubs_sanitize_number_range',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_team_number',
			    	array(
						'type' => 'number',
						'settings'   => 'our_team_number', 
						'section' => 'silver_hubs_our_team_section', // // Add a default or your own section
						'label' => 'No of Section',
						'description' => 'Save and refresh the page if No. of Sections is changed (Max no of section is 4)',
						'input_attrs' => array(
									    'min' => 1,
									    'max' => 4,
									),
						'active_callback' => 'silver_hubs_our_team_general_callback',					   
					)
				) );
				$our_team_number = get_theme_mod( 'our_team_number', 4 );
				for ( $i = 1; $i <= $our_team_number ; $i++ ) {
					//Our Team in headline
						$wp_customize->add_setting( 'our_team_heading_'.$i, array(
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new silver_hubs_GeneratePress_Upsell_Section(
					    	$wp_customize,'our_team_heading_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_team_heading_'.$i, 
								'section' => 'silver_hubs_our_team_section', // // Add a default or your own section
								'label' => 'Our Team ' .$i,	
								'active_callback' => 'silver_hubs_our_team_general_callback',
							)
						) );					
					//Our Team image option
				        $wp_customize->add_setting('our_team_image'.$i, array(
				        	'type'       => 'theme_mod',
					        'transport'     => 'refresh',
					        'height'        => 180,
					        'width'        => 160,
					        'capability' => 'edit_theme_options',
					        'sanitize_callback' => 'esc_url_raw'
					    ));
					    $wp_customize->add_control( new WP_Customize_Image_Control( 
					    	$wp_customize, 'our_team_image'.$i, array(
						        'label' => 'Image '.$i, 
						        'section' => 'silver_hubs_our_team_section',
						        'settings' => 'our_team_image'.$i,
						        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
						        'active_callback' => 'silver_hubs_our_team_general_callback',
						    )
					    ) );
					//Our Team in title
						$wp_customize->add_setting( 'our_team_title_'.$i, array(
							'default'    => $teams['team']['title'][$i-1],
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_team_title_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_team_title_'.$i, 
								'section' => 'silver_hubs_our_team_section', // // Add a default or your own section
								'label' => 'Title ' .$i,
								'active_callback' => 'silver_hubs_our_team_general_callback',
							)
						) );
					//Our Team in title link
						$wp_customize->add_setting( 'our_team_title_link_'.$i, array(
							'default'  => '#',
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_team_title_link_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_team_title_link_'.$i, 
								'section' => 'silver_hubs_our_team_section', // // Add a default or your own section
								'label' => 'Link ' .$i,
								'active_callback' => 'silver_hubs_our_team_general_callback',
							)
						) );
					//Our Team in headline
						$wp_customize->add_setting( 'our_team_headline_'.$i, array(
							'default'    => $teams['team']['headline'][$i-1],
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_team_headline_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_team_headline_'.$i, 
								'section' => 'silver_hubs_our_team_section', // // Add a default or your own section
								'label' => 'Headline ' .$i,	 
								'active_callback' => 'silver_hubs_our_team_general_callback',
							)
						) );
					//header topbar in twitter link
					    $wp_customize->add_setting( 'our_team_twitter_link_'.$i, array(		                
					                'default'   => 'https://twitter.com/',
									'priority'  => 10,
									'capability' => 'edit_theme_options',
									'sanitize_callback' => 'sanitize_text_field',
					    ));				    
					    $wp_customize->add_control(  new WP_Customize_Control(
						    	$wp_customize,'our_team_twitter_link_'.$i, 
						    	array(
					                'label' => 'Twitter Link',
					                'section' => 'silver_hubs_our_team_section',
					                'settings' => 'our_team_twitter_link_'.$i,
					                'active_callback' => 'silver_hubs_our_team_general_callback',
						        )
					    ));
					//Our Team in facebook link
					    $wp_customize->add_setting( 'our_team_facebook_link_'.$i, array(		                
					                'default'   => 'https://www.facebook.com/',
									'priority'  => 10,
									'capability' => 'edit_theme_options',
									'sanitize_callback' => 'sanitize_text_field',
					    ));					    
					    $wp_customize->add_control(  new WP_Customize_Control(
						    	$wp_customize,'our_team_facebook_link_'.$i, 
						    	array(
					                'label' => 'Facebook Link',
					                'section' => 'silver_hubs_our_team_section',
					                'settings' => 'our_team_facebook_link_'.$i, 
					                'active_callback' => 'silver_hubs_our_team_general_callback',
						        )
					    ));	
				    //Our Team in instagram link
					    $wp_customize->add_setting( 'our_team_instagram_link_'.$i, array(		                
					                'default'   => 'https://www.instagram.com/',
									'priority'  => 10,
									'capability' => 'edit_theme_options',
									'sanitize_callback' => 'sanitize_text_field',
					    )); 				    
					    $wp_customize->add_control(  new WP_Customize_Control(
						    	$wp_customize,'our_team_instagram_link_'.$i, 
						    	array(
					                'label' => 'Instagram Link',
					                'section' => 'silver_hubs_our_team_section',
					                'settings' => 'our_team_instagram_link_'.$i,
					                'active_callback' => 'silver_hubs_our_team_general_callback',
						        )
					    ));	
				    //Our Team in linkedin link
					    $wp_customize->add_setting( 'our_team_linkedin_link_'.$i, array(		                
					                'default'   => 'https://www.linkedin.com/feed/',
									'priority'  => 10,
									'capability' => 'edit_theme_options',
									'sanitize_callback' => 'sanitize_text_field',
					    ));				    
					    $wp_customize->add_control(  new WP_Customize_Control(
						    	$wp_customize,'our_team_linkedin_link_'.$i, 
						    	array(
					                'label' => 'Linkedin Link',
					                'section' => 'silver_hubs_our_team_section',
					                'settings' => 'our_team_linkedin_link_'.$i,
					                'active_callback' => 'silver_hubs_our_team_general_callback',
						        )
					    ));
				}
			//Our Team Section Pro Link
				$wp_customize->add_setting('our_team_slider_pro', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new silver_hubs_pro_option_Control(
			    	$wp_customize,'our_team_slider_pro',
			    	array(
				        'settings' => 'our_team_slider_pro',
				        //'label'   => 'More Options Available in Goldly Pro!',
				        'section' => 'silver_hubs_our_team_section',
				        'active_callback' => 'silver_hubs_our_team_general_callback',
			        )
			    ));	
			//Our Team Section in Background Title
		    	$wp_customize->add_setting('our_team_background_section', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new silver_hubs_GeneratePress_Upsell_Section(
			    	$wp_customize,'our_team_background_section',
			    	array(
				        'settings' => 'our_team_background_section',
				        'label'   => 'Background Color Or Image',
				        'section' => 'silver_hubs_our_team_section',
				        'type'     => 'ast-description',
				        'active_callback' => 'silver_hubs_our_team_design_callback',
			        )
			    ));
			    //Our Team backgroung Image
			    	$wp_customize->add_setting('our_team_bg_image', array(
			    		'default'  => '',
			        	'type'       => 'theme_mod',
				        'transport'     => 'refresh',
				        'height'        => 180,
				        'width'        => 160,
				        'capability' => 'edit_theme_options',
				        'sanitize_callback' => 'esc_url_raw'
				    ));
				    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'our_team_bg_image', array(
				        'label' => __('Backgroung Image', 'silver_hubs'),
				        'section' => 'silver_hubs_our_team_section',
				        'settings' => 'our_team_bg_image',
				        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
				        'active_callback' => 'silver_hubs_our_team_design_callback',
				    )));
				//Our Team in Background Position
				    $wp_customize->add_setting('silver_hubs_our_team_bg_position', array(
				        'default'        => 'center center',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'silver_hubs_our_team_bg_position',
				    	array(
					        'settings' => 'silver_hubs_our_team_bg_position',
					        'label'   => 'Background Position',
					        'section' => 'silver_hubs_our_team_section',
					        'type'  => 'select',
					        'active_callback' => 'silver_hubs_our_team_design_callback',
					        'choices'    => $image_position,
				        )
				    ));
				//Our Team Section in Background Attachment
					$wp_customize->add_setting('silver_hubs_our_team_bg_attachment', array(
				        'default'        => 'scroll',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'silver_hubs_our_team_bg_attachment',
				    	array(
					        'settings' => 'silver_hubs_our_team_bg_attachment',
					        'label'   => 'Background Attachment',
					        'section' => 'silver_hubs_our_team_section',
					        'type'  => 'select',
					        'choices'    => array(
					        	'scroll' => 'Scroll',
					        	'fixed' => 'Fixed',
				        	),
				        	'active_callback' => 'silver_hubs_our_team_design_callback',
				        )
				    ));
				//Our Team Section in image background Size
				    $wp_customize->add_setting('silver_hubs_our_team_bg_size', array(
				        'default'        => 'cover',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'silver_hubs_our_team_bg_size',
				    	array(
					        'settings' => 'silver_hubs_our_team_bg_size',
					        'label'   => 'Background Size',
					        'section' => 'silver_hubs_our_team_section',
					        'type'  => 'select',
					        'active_callback' => 'silver_hubs_our_team_design_callback',
					        'choices'    => array(
					        	'auto' => 'Auto',
					        	'cover' => 'Cover',
					            'contain' => 'Contain'
				        	),
				        )
				    ));   
				//Our team background color
					$wp_customize->add_setting( 'our_team_bg_color', 
				        array(
				            'default'    => '#ffffff', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'silver_hubs_custom_sanitization_callback',
				        ) 
				    ); 
			        $wp_customize->add_control( new Silver_Hubs_Transparent_Color_Control( 
				        $wp_customize,'our_team_bg_color', 
				        array(
				            'label'      => __( 'Background Color', 'silver_hubs' ), 
				            'settings'   => 'our_team_bg_color', 
				            'priority'   => 10,
				            'section'    => 'silver_hubs_our_team_section',
				            'active_callback' => 'silver_hubs_our_team_design_callback',
				        ) 
			        ) ); 
		    //Our team text color
				$wp_customize->add_setting( 'our_team_text_color', 
			        array(
			            'default'    => '#333', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'silver_hubs_custom_sanitization_callback',
			        ) 
			    ); 
		        $wp_customize->add_control( new Silver_Hubs_Transparent_Color_Control( 
			        $wp_customize,'our_team_text_color', 
			        array(
			            'label'      => __( 'Text Color', 'silver_hubs' ), 
			            'settings'   => 'our_team_text_color', 
			            'priority'   => 10,
			            'section'    => 'silver_hubs_our_team_section',
			            'active_callback' => 'silver_hubs_our_team_design_callback',
			        ) 
		        ) ); 
			//Our team container background color
				$wp_customize->add_setting( 'our_team_container_bg_color', 
			        array(
			            'default'    => '#333', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'silver_hubs_custom_sanitization_callback',
			        ) 
			    ); 
		        $wp_customize->add_control( new Silver_Hubs_Transparent_Color_Control( 
			        $wp_customize,'our_team_container_bg_color', 
			        array(
			            'label'      => __( 'Container Background Color', 'silver_hubs' ), 
			            'settings'   => 'our_team_container_bg_color', 
			            'priority'   => 10,
			            'section'    => 'silver_hubs_our_team_section',
			            'active_callback' => 'silver_hubs_our_team_design_callback',
			        ) 
		        ) );  
		    //Our team container text color
				$wp_customize->add_setting( 'our_team_container_text_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'silver_hubs_custom_sanitization_callback',
			        ) 
			    ); 
		        $wp_customize->add_control( new Silver_Hubs_Transparent_Color_Control( 
			        $wp_customize,'our_team_container_text_color', 
			        array(
			            'label'      => __( 'Container Text Color', 'silver_hubs' ), 
			            'settings'   => 'our_team_container_text_color', 
			            'priority'   => 10,
			            'section'    => 'silver_hubs_our_team_section',
			            'active_callback' => 'silver_hubs_our_team_design_callback',
			        ) 
		        ) ); 
		    //Our team icon color
				$wp_customize->add_setting( 'our_team_icon_color', 
			        array(
			            'default'    => '#333333', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'silver_hubs_custom_sanitization_callback',
			        ) 
			    ); 
		        $wp_customize->add_control( new Silver_Hubs_Transparent_Color_Control( 
			        $wp_customize,'our_team_icon_color', 
			        array(
			            'label'      => __( 'Icon Color', 'silver_hubs' ), 
			            'settings'   => 'our_team_icon_color', 
			            'priority'   => 10,
			            'section'    => 'silver_hubs_our_team_section',
			            'active_callback' => 'silver_hubs_our_team_design_callback',
			        ) 
		        ) );  
		    //Our team icon hover color
				$wp_customize->add_setting( 'our_team_icon_hover_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'silver_hubs_custom_sanitization_callback',
			        ) 
			    ); 
		        $wp_customize->add_control( new Silver_Hubs_Transparent_Color_Control( 
			        $wp_customize,'our_team_icon_hover_color', 
			        array(
			            'label'      => __( 'Icon Hover Color', 'silver_hubs' ), 
			            'settings'   => 'our_team_icon_hover_color', 
			            'priority'   => 10,
			            'section'    => 'silver_hubs_our_team_section',
			            'active_callback' => 'silver_hubs_our_team_design_callback',
			        ) 
		        ) );  
		    //Our team icon background color
				$wp_customize->add_setting( 'our_team_icon_background_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'silver_hubs_custom_sanitization_callback',
			        ) 
			    ); 
		        $wp_customize->add_control( new Silver_Hubs_Transparent_Color_Control( 
			        $wp_customize,'our_team_icon_background_color', 
			        array(
			            'label'      => __( 'Icon Background Color', 'silver_hubs' ), 
			            'settings'   => 'our_team_icon_background_color', 
			            'priority'   => 10,
			            'section'    => 'silver_hubs_our_team_section',
			            'active_callback' => 'silver_hubs_our_team_design_callback',
			        ) 
		        ) );  
		    //Our team icon background hover color
				$wp_customize->add_setting( 'our_team_icon_bg_hover_color', 
			        array(
			            'default'    => '#333333', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'silver_hubs_custom_sanitization_callback',
			        ) 
			    ); 
		        $wp_customize->add_control( new Silver_Hubs_Transparent_Color_Control( 
			        $wp_customize,'our_team_icon_bg_hover_color', 
			        array(
			            'label'      => __( 'Icon Background Hover Color', 'silver_hubs' ), 
			            'settings'   => 'our_team_icon_bg_hover_color', 
			            'priority'   => 10,
			            'section'    => 'silver_hubs_our_team_section',
			            'active_callback' => 'silver_hubs_our_team_design_callback',
			        ) 
		        ) );  
		    //Our team Link color
				$wp_customize->add_setting( 'our_team_link_color', 
			        array(
			            'default'    => '#fff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'silver_hubs_custom_sanitization_callback',
			        ) 
			    ); 
		        $wp_customize->add_control( new Silver_Hubs_Transparent_Color_Control( 
			        $wp_customize,'our_team_link_color', 
			        array(
			            'label'      => __( 'Link Color', 'silver_hubs' ), 
			            'settings'   => 'our_team_link_color', 
			            'priority'   => 10,
			            'section'    => 'silver_hubs_our_team_section',
			            'active_callback' => 'silver_hubs_our_team_design_callback',
			        ) 
		        ) );  
		    //Our team Link Hover color
				$wp_customize->add_setting( 'our_team_link_hover_color', 
			        array(
			            'default'    => '#000000', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'silver_hubs_custom_sanitization_callback',
			        ) 
			    ); 
		        $wp_customize->add_control( new Silver_Hubs_Transparent_Color_Control( 
			        $wp_customize,'our_team_link_hover_color', 
			        array(
			            'label'      => __( 'Link Hover Color', 'silver_hubs' ), 
			            'settings'   => 'our_team_link_hover_color', 
			            'priority'   => 10,
			            'section'    => 'silver_hubs_our_team_section',
			            'active_callback' => 'silver_hubs_our_team_design_callback',
			        ) 
		        ) );  
}
add_action( 'customize_register', 'silver_hubs_team_setting' );

function silver_hubs_our_team_general_callback(){
	$our_team_section_tab = get_theme_mod( 'our_team_section_tab','general');
	if ( 'general' === $our_team_section_tab ) {
		return true;
	}
	return false;
}
function silver_hubs_our_team_design_callback(){
	$our_team_section_tab = get_theme_mod( 'our_team_section_tab','general');
	if ( 'design' === $our_team_section_tab ) {
		return true;
	}
	return false;
}
?>