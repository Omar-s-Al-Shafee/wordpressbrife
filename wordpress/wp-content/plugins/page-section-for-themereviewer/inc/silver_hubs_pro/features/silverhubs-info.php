<?php

function silver_hubs_section_setting( $wp_customize ) {
	$sections = array();
	$featured_section = apply_filters('silver_hubs_pro_section', $sections);
	//Featured Section
		$wp_customize->add_section( 'silver_hubs_featured_section' , array(
			'title'  => 'Featured Section',
			'panel'  => 'silver_hubs_theme_option_panel',
		) ); 
		// Featured Section tabing
			$wp_customize->add_setting( 'featured_section_tab', 
		        array(
		            'default'    => 'general', //Default setting/value to save
		            'type'       => 'theme_mod',
		            'transport'   => 'refresh',
		            'capability'     => 'edit_theme_options',
		            'sanitize_callback' => 'silver_hubs_sanitize_select',
		        ) 
		    ); 
	        $wp_customize->add_control( new silver_hubs_Custom_Radio_Control( 
		        $wp_customize,'featured_section_tab',array(
		            'settings'   => 'featured_section_tab', 
		            'priority'   => 10,
		            'section'    => 'silver_hubs_featured_section',
		            'type'    => 'select',
		            'choices'    => array(
			        	'general' => 'General',
			        	'design' => 'Design',
		        	),
		        ) 
	        ) );
	    //Featured Slider in number of slides
		    $wp_customize->add_setting( 'featured_section_number', array(
		    	'default'  => 4,
			    'type'       => 'theme_mod',
		        'transport'   => 'refresh',
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'silver_hubs_sanitize_number_range',
			) );
			$wp_customize->add_control( new WP_Customize_Control(
		    	$wp_customize,'featured_section_number',
		    	array(
					'type' => 'number',
					'settings'   => 'featured_section_number', 
					'section' => 'silver_hubs_featured_section', // // Add a default or your own section
					'label' => 'No of Section',
					'description' => 'Save and refresh the page if No. of Sections is changed (Max no of slides is 20)',
					'input_attrs' => array(
								    'min' => 1,
								    'max' => 20,
								),
					'active_callback' => 'silver_hubs_featured_section_callback',					   
				)
			) );
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial(
					'featured_section_number',
					array(
						'selector'        => '.featured-section_data',
						'render_callback' => 'silver_hubs_customize_partial_featured_section',
					)
				);
			}
			$about_number = get_theme_mod( 'featured_section_number', 4 );
				for ( $i = 1; $i <= $about_number ; $i++ ) {
					//Featured section Heading
						$wp_customize->add_setting('featured_section'.$i, array(
					        'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
					    ));
					    $wp_customize->add_control( new silver_hubs_GeneratePress_Upsell_Section(
					    	$wp_customize,'featured_section'.$i,
					    	array(
						        'settings' => 'featured_section'.$i,
						        'label'   => 'Featured Section '.$i ,
						        'section' => 'silver_hubs_featured_section',
						        'type'     => 'ast-description',
						        'active_callback' => 'silver_hubs_featured_section_callback',
					        )
					    ));
					if($i <= 4){
						//Featured Section icon
							$wp_customize->add_setting('features_one_icon'. $i,
						        array(
						        	'default'    => $featured_section['featured_section']['icon'][$i-1],
						            'transport' => 'refresh',
						            'type'       => 'theme_mod',
						            'capability' => 'edit_theme_options',
						            'sanitize_callback' => 'sanitize_text_field',
						        )
						    );
						    $wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'features_one_icon'.$i,
						    	array(
						            'type'        => 'text',
									'settings'    => 'features_one_icon'.$i,
									'label'       => 'Select Features Icon '.$i,
									'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v4/icons/">Click Here</a> for select icon','silver_hubs'),
									'section'     => 'silver_hubs_featured_section',
									'active_callback' => 'silver_hubs_featured_section_callback',
						        )
						    ));	
					    //Featured Section Title 
							$wp_customize->add_setting( 'featured_section_title_' . $i , array(
								'default'    => $featured_section['featured_section']['title'][$i-1],
							    'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
							) );
							$wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'featured_section_title_' . $i,
						    	array(
									'type' => 'text',
									'settings'   => 'featured_section_title_' . $i, 
									'section' => 'silver_hubs_featured_section', // // Add a default or your own section
									'label' => 'Title ' . $i,
									'active_callback' => 'silver_hubs_featured_section_callback',
								)
							) );
						//Featured Section Description 
							$wp_customize->add_setting( 'featured_section_description_' . $i , array(
								'default'    => $featured_section['featured_section']['description'][$i-1],
							    'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
							) );
							$wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'featured_section_description_' . $i,
						    	array(
									'type' => 'text',
									'settings'   => 'featured_section_description_' . $i, 
									'section' => 'silver_hubs_featured_section', // // Add a default or your own section
									'label' => 'Description ' . $i,
									'active_callback' => 'silver_hubs_featured_section_callback',
								)
							) );
					}else{
						//Featured Section icon
							$wp_customize->add_setting('features_one_icon'. $i,
						        array(
						            'transport' => 'refresh',
						            'type'       => 'theme_mod',
						            'capability' => 'edit_theme_options',
						            'sanitize_callback' => 'sanitize_text_field',
						        )
						    );
						    $wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'features_one_icon'.$i,
						    	array(
						            'type'        => 'text',
									'settings'    => 'features_one_icon'.$i,
									'label'       => 'Select Features Icon '.$i,
									'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v4/icons/">Click Here</a> for select icon','silver_hubs'),
									'section'     => 'silver_hubs_featured_section',
									'active_callback' => 'silver_hubs_featured_section_callback',
						        )
						    ));	
					    //Featured Section Title 
							$wp_customize->add_setting( 'featured_section_title_' . $i , array(
							    'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
							) );
							$wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'featured_section_title_' . $i,
						    	array(
									'type' => 'text',
									'settings'   => 'featured_section_title_' . $i, 
									'section' => 'silver_hubs_featured_section', // // Add a default or your own section
									'label' => 'Title ' . $i,
									'active_callback' => 'silver_hubs_featured_section_callback',
								)
							) );
						//Featured Section Description 
							$wp_customize->add_setting( 'featured_section_description_' . $i , array(
							    'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
							) );
							$wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'featured_section_description_' . $i,
						    	array(
									'type' => 'text',
									'settings'   => 'featured_section_description_' . $i, 
									'section' => 'silver_hubs_featured_section', // // Add a default or your own section
									'label' => 'Description ' . $i,
									'active_callback' => 'silver_hubs_featured_section_callback',
								)
							) );
					}
				}
				//Featured Section icon size 
					$wp_customize->add_setting( 'featured_section_icon_size', array(
						'default'    => '35',
					    'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',
				        'sanitize_callback' => 'sanitize_text_field',
					) );
					$wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'featured_section_icon_size',
				    	array(
							'type' => 'number',
							'settings'   => 'featured_section_icon_size',
							'section' => 'silver_hubs_featured_section', // // Add a default or your own section
							'label' => 'Icon Size',
							'description' =>'in px',
							'active_callback' => 'silver_hubs_featured_section_design_callback',
						)
					) );
				//Featured Section Background color
				    $wp_customize->add_setting( 'silver_hubs_featured_section_bg_color', 
				        array(
				            'default'    => '#eeeeee', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'silver_hubs_featured_section_bg_color', 
				        array(
				            'label'      => __( 'Background Color', 'silver_hubs' ), 
				            'settings'   => 'silver_hubs_featured_section_bg_color', 
				            'priority'   => 10,
				            'section'    => 'silver_hubs_featured_section',
				            'active_callback' => 'silver_hubs_featured_section_design_callback',
				        ) 
			        ) );
			    //Featured Section Text color
				    $wp_customize->add_setting( 'silver_hubs_featured_section_color', 
				        array(
				            'default'    => '#333', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'silver_hubs_featured_section_color', 
				        array(
				            'label'      => __( 'Color', 'silver_hubs' ), 
				            'settings'   => 'silver_hubs_featured_section_color', 
				            'priority'   => 10,
				            'section'    => 'silver_hubs_featured_section',
				            'active_callback' => 'silver_hubs_featured_section_design_callback',
				        ) 
			        ) ); 
			    //Featured Section Background hover color
				    $wp_customize->add_setting( 'silver_hubs_featured_section_bg_hover_color', 
				        array(
				            'default'    => '#333', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'silver_hubs_featured_section_bg_hover_color', 
				        array(
				            'label'      => __( 'Background Hover Color', 'silver_hubs' ), 
				            'settings'   => 'silver_hubs_featured_section_bg_hover_color', 
				            'priority'   => 10,
				            'section'    => 'silver_hubs_featured_section',
				            'active_callback' => 'silver_hubs_featured_section_design_callback',
				        ) 
			        ) ); 
			    //Featured Section Text hover color
				    $wp_customize->add_setting( 'silver_hubs_featured_section_text_hover_color', 
				        array(
				            'default'    => '#ffffff', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'silver_hubs_featured_section_text_hover_color', 
				        array(
				            'label'      => __( 'Text Hover Color', 'silver_hubs' ), 
				            'settings'   => 'silver_hubs_featured_section_text_hover_color', 
				            'priority'   => 10,
				            'section'    => 'silver_hubs_featured_section',
				            'active_callback' => 'silver_hubs_featured_section_design_callback',
				        ) 
			        ) ); 
			    //Featured Section Icon color
				    $wp_customize->add_setting( 'silver_hubs_featured_section_icon_color', 
				        array(
				            'default'    => '#ffffff', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'silver_hubs_featured_section_icon_color', 
				        array(
				            'label'      => __( 'Icon Color', 'silver_hubs' ), 
				            'settings'   => 'silver_hubs_featured_section_icon_color', 
				            'priority'   => 10,
				            'section'    => 'silver_hubs_featured_section',
				            'active_callback' => 'silver_hubs_featured_section_design_callback',
				        ) 
			        ) ); 
			    //Featured Section Icon Hover color
				    $wp_customize->add_setting( 'silver_hubs_featured_section_icon_hover_color', 
				        array(
				            'default'    => '#333', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'silver_hubs_featured_section_icon_hover_color', 
				        array(
				            'label'      => __( 'Icon Hover Color', 'silver_hubs' ), 
				            'settings'   => 'silver_hubs_featured_section_icon_hover_color', 
				            'priority'   => 10,
				            'section'    => 'silver_hubs_featured_section',
				            'active_callback' => 'silver_hubs_featured_section_design_callback',
				        ) 
			        ) ); 
			    //Featured Section Icon Backgroundcolor
				    $wp_customize->add_setting( 'silver_hubs_featured_section_icon_bg_color', 
				        array(
				            'default'    => '#333', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'silver_hubs_featured_section_icon_bg_color', 
				        array(
				            'label'      => __( 'Icon Background Color', 'silver_hubs' ), 
				            'settings'   => 'silver_hubs_featured_section_icon_bg_color', 
				            'priority'   => 10,
				            'section'    => 'silver_hubs_featured_section',
				            'active_callback' => 'silver_hubs_featured_section_design_callback',
				        ) 
			        ) ); 
			    //Featured Section Icon Background Hover color
				    $wp_customize->add_setting( 'silver_hubs_featured_section_icon_bg_hover_color', 
				        array(
				            'default'    => '#ffffff', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'silver_hubs_featured_section_icon_bg_hover_color', 
				        array(
				            'label'      => __( 'Icon Background Hover Color', 'silver_hubs' ), 
				            'settings'   => 'silver_hubs_featured_section_icon_bg_hover_color', 
				            'priority'   => 10,
				            'section'    => 'silver_hubs_featured_section',
				            'active_callback' => 'silver_hubs_featured_section_design_callback',
				        ) 
			        ) ); 
			    //Featured Section margin
			        $wp_customize->add_setting( 'silver_hubs_featured_section_margin', 
				        array(
				            'default'    => '-100px 0px 20px 0px', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_text_field',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Control( 
				        $wp_customize,'silver_hubs_featured_section_margin', 
				        array(
				            'label'      => __( 'Margin', 'silver_hubs' ), 
				            'description'=> '-100px 0px 20px 0px',
				            'settings'   => 'silver_hubs_featured_section_margin', 
				            'priority'   => 10,
				            'section'    => 'silver_hubs_featured_section',
				            'active_callback' => 'silver_hubs_featured_section_design_callback',
				        ) 
			        ) ); 	    
}
add_action( 'customize_register', 'silver_hubs_section_setting' );

function silver_hubs_featured_section_callback(){
	$featured_section_tab = get_theme_mod( 'featured_section_tab','general');
	if ( 'general' === $featured_section_tab ) {
		return true;
	}
	return false;
}
function silver_hubs_featured_section_design_callback(){
	$featured_section_tab = get_theme_mod( 'featured_section_tab','general');
	if ( 'design' === $featured_section_tab ) {
		return true;
	}
	return false;
}