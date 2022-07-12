<?php
function designhubs_portfolio_setting($wp_customize){
	$sections = array();
	$portfolios = apply_filters('designhubs_pro_section', $sections);
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
	//Our Portfolio
	    $wp_customize->add_section( 'designhubs_our_portfolio_section' , array(
			'title'  => 'Our Portfolio',
			'panel'  => 'designhubs_theme_option_panel',
		) ); 
		//Our Portfolio tabing
			$wp_customize->add_setting( 'our_portfolio_section_tab', 
		        array(
		            'default'    => 'general', //Default setting/value to save
		            'type'       => 'theme_mod',
		            'transport'   => 'refresh',
		            'capability'     => 'edit_theme_options',
		            'sanitize_callback' => 'designhubs_sanitize_select',
		        ) 
		    ); 
	        $wp_customize->add_control( new Designhubs_Custom_Radio_Control( 
		        $wp_customize,'our_portfolio_section_tab',array(
		            'settings'   => 'our_portfolio_section_tab', 
		            'priority'   => 10,
		            'section'    => 'designhubs_our_portfolio_section',
		            'type'    => 'select',
		            'choices'    => array(
			        	'general' => 'General',
			        	'design' => 'Design',
		        	),
		        ) 
	        ) );
	    //Our Portfolio in Title
			$wp_customize->add_setting( 'our_portfolio_main_title', array(
				'default'    => 'Our Portfolio',
			    'type'       => 'theme_mod',
		        'transport'   => 'refresh',
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( new WP_Customize_Control(
		    	$wp_customize,'our_portfolio_main_title',
		    	array(
					'type' => 'text',
					'settings' => 'our_portfolio_main_title',
					'section' => 'designhubs_our_portfolio_section', // // Add a default or your own section
					'label' => 'Our Portfolio Title',
					'active_callback' => 'designhubs_our_portfolio_general_callback',
				)
			) );
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial(
					'our_portfolio_main_title',
					array(
						'selector'        => '.our_portfolio_info',
						'render_callback' => 'designhubs_customize_partial_name',
					)
				);
			}
		//Our Portfolio in Discription
			$wp_customize->add_setting( 'our_portfolio_main_discription', array(
				'default'   => $portfolios['portfolio']['description'],
			    'type'       => 'theme_mod',
		        'transport'   => 'refresh',
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( new WP_Customize_Control(
		    	$wp_customize,'our_portfolio_main_discription',
		    	array(
					'type' => 'textarea',
					'settings' => 'our_portfolio_main_discription',
					'section' => 'designhubs_our_portfolio_section', // // Add a default or your own section
					'label' => 'Our Portfolio Discription',
					'active_callback' => 'designhubs_our_portfolio_general_callback',
				)
			) );
		//Our Portfolio in number of section
		    $wp_customize->add_setting( 'our_portfolio_number', array(
		    	'default'  => 6,
			    'type'       => 'theme_mod',
		        'transport'   => 'refresh',
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'designhubs_sanitize_number_range',
			) );
			$wp_customize->add_control( new WP_Customize_Control(
		    	$wp_customize,'our_portfolio_number',
		    	array(
					'type' => 'number',
					'settings'   => 'our_portfolio_number', 
					'section' => 'designhubs_our_portfolio_section', // // Add a default or your own section
					'label' => 'No of Section',
					'description' => 'Save and refresh the page if No. of Sections is changed (Max no of section is 20)',
					'input_attrs' => array(
								    'min' => 1,
								    'max' => 20,
								),	
					'active_callback' => 'designhubs_our_portfolio_general_callback',				   
				)
			) );
			$our_portfolio_number = get_theme_mod( 'our_portfolio_number', 6 );
			for ( $i = 1; $i <= $our_portfolio_number ; $i++ ) {
				//Our Portfolio Heading
					$wp_customize->add_setting('our_portfolio_'.$i, array(
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new Designhubs_GeneratePress_Upsell_Section(
				    	$wp_customize,'our_portfolio_'.$i,
				    	array(
					        'settings' => 'our_portfolio_'.$i,
					        'label'   => 'Our Portfolio '.$i ,
					        'section' => 'designhubs_our_portfolio_section',
					        'type'     => 'ast-description',
					        'active_callback' => 'designhubs_our_portfolio_general_callback',
				        )
				    ));
				    if($i <= 6){
						//Our Portfolio Image
						    $wp_customize->add_setting('our_portfolio_image_' .$i, array(
					        	'type'       => 'theme_mod',
						        'transport'     => 'refresh',
						        'height'        => 180,
						        'width'        => 160,
						        'capability' => 'edit_theme_options',
						        'sanitize_callback' => 'esc_url_raw'
						    ));
						    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'our_portfolio_image_' .$i , array(
						        'label' =>  'Image',
						        'section' => 'designhubs_our_portfolio_section',
						        'settings' => 'our_portfolio_image_' .$i,
						        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
						        'active_callback' => 'designhubs_our_portfolio_general_callback',
						    ))); 
						//Our Portfolio Title
							$wp_customize->add_setting('our_portfolio_title_'.$i, array(
								'default'   => $portfolios['portfolio']['title'][$i-1],
						        'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
						    ));
						    $wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'our_portfolio_title_'.$i,
						    	array(
							        'settings' => 'our_portfolio_title_'.$i,
							        'label'   => 'Our Portfolio Title '.$i ,
							        'section' => 'designhubs_our_portfolio_section',
							        'type'     => 'text',
							        'active_callback' => 'designhubs_our_portfolio_general_callback',
						        )
						    ));
						//Our Portfolio subheading Title
							$wp_customize->add_setting('our_portfolio_subheading_'.$i, array(
								'default'   => $portfolios['portfolio']['sub_heading'][$i-1],
						        'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
						    ));
						    $wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'our_portfolio_subheading_'.$i,
						    	array(
							        'settings' => 'our_portfolio_subheading_'.$i,
							        'label'   => 'Sub Heading ' .$i,
							        'section' => 'designhubs_our_portfolio_section',
							        'type'     => 'text',
							        'active_callback' => 'designhubs_our_portfolio_general_callback',
						        )
						    ));
						//Our Portfolio button
						    $wp_customize->add_setting('our_portfolio_button_'. $i,
						        array(
						            'default' => 'fa fa-arrow-right',
						            'transport' => 'refresh',
						            'type'       => 'theme_mod',
						            'capability' => 'edit_theme_options',
						            'sanitize_callback' => 'sanitize_text_field',
						        )
						    );
						    $wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'our_portfolio_button_'.$i,
						    	array(
						            'type'        => 'text',
									'settings'    => 'our_portfolio_button_'.$i,
									'label'       => 'Select Our Portfolio button '.$i,
									'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v4.7.0/icons/">Click Here</a> for select icon','designhubs'),
									'section'     => 'designhubs_our_portfolio_section',
									'active_callback' => 'designhubs_our_portfolio_general_callback',
						        )
						    ));
						//Our Portfolio button link
							$wp_customize->add_setting('our_portfolio_buttonlink_'.$i, array(
								'default'    => '#',
						        'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
						    ));
						    $wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'our_portfolio_buttonlink_'.$i,
						    	array(
							        'settings' => 'our_portfolio_buttonlink_'.$i,
							        'label'   => 'Our Portfolio button link ' .$i,
							        'section' => 'designhubs_our_portfolio_section',
							        'type'     => 'text',
							        'active_callback' => 'designhubs_our_portfolio_general_callback',
						        )
						    ));
				    }else{
				    	//Our Portfolio Image
						    $wp_customize->add_setting('our_portfolio_image_' .$i, array(
					        	'type'       => 'theme_mod',
						        'transport'     => 'refresh',
						        'height'        => 180,
						        'width'        => 160,
						        'capability' => 'edit_theme_options',
						        'sanitize_callback' => 'esc_url_raw'
						    ));
						    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'our_portfolio_image_' .$i , array(
						        'label' =>  'Image',
						        'section' => 'designhubs_our_portfolio_section',
						        'settings' => 'our_portfolio_image_' .$i,
						        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
						        'active_callback' => 'designhubs_our_portfolio_general_callback',
						    ))); 
						//Our Portfolio Title
							$wp_customize->add_setting('our_portfolio_title_'.$i, array(
						        'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
						    ));
						    $wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'our_portfolio_title_'.$i,
						    	array(
							        'settings' => 'our_portfolio_title_'.$i,
							        'label'   => 'Our Portfolio Title '.$i ,
							        'section' => 'designhubs_our_portfolio_section',
							        'type'     => 'text',
							        'active_callback' => 'designhubs_our_portfolio_general_callback',
						        )
						    ));
						//Our Portfolio subheading Title
							$wp_customize->add_setting('our_portfolio_subheading_'.$i, array(
						        'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
						    ));
						    $wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'our_portfolio_subheading_'.$i,
						    	array(
							        'settings' => 'our_portfolio_subheading_'.$i,
							        'label'   => 'Sub Heading ' .$i,
							        'section' => 'designhubs_our_portfolio_section',
							        'type'     => 'text',
							        'active_callback' => 'designhubs_our_portfolio_general_callback',
						        )
						    ));
						//Our Portfolio button
						    $wp_customize->add_setting('our_portfolio_button_'. $i,
						        array(
						            'default' => 'fa fa-arrow-right',
						            'transport' => 'refresh',
						            'type'       => 'theme_mod',
						            'capability' => 'edit_theme_options',
						            'sanitize_callback' => 'sanitize_text_field',
						        )
						    );
						    $wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'our_portfolio_button_'.$i,
						    	array(
						            'type'        => 'text',
									'settings'    => 'our_portfolio_button_'.$i,
									'label'       => 'Select Our Portfolio button '.$i,
									'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v4.7.0/icons/">Click Here</a> for select icon','designhubs'),
									'section'     => 'designhubs_our_portfolio_section',
									'active_callback' => 'designhubs_our_portfolio_general_callback',
						        )
						    ));
						//Our Portfolio button link
							$wp_customize->add_setting('our_portfolio_buttonlink_'.$i, array(
								'default'    => '#',
						        'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
						    ));
						    $wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'our_portfolio_buttonlink_'.$i,
						    	array(
							        'settings' => 'our_portfolio_buttonlink_'.$i,
							        'label'   => 'Our Portfolio button link ' .$i,
							        'section' => 'designhubs_our_portfolio_section',
							        'type'     => 'text',
							        'active_callback' => 'designhubs_our_portfolio_general_callback',
						        )
						    ));
				    }
		    }
		//Our Portfolio in Background Title
			$wp_customize->add_setting('our_portfolio_bg_heading', array(
		        'type'       => 'theme_mod',
		        'transport'   => 'refresh',
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'sanitize_text_field',
		    ));
		    $wp_customize->add_control( new designhubs_GeneratePress_Upsell_Section(
		    	$wp_customize,'our_portfolio_bg_heading',
		    	array(
			        'settings' => 'our_portfolio_bg_heading',
			        'label'   => 'Background Color',
			        'section' => 'designhubs_our_portfolio_section',
			        'type'     => 'ast-description',
			        'active_callback' => 'designhubs_our_portfolio_design_callback',
		        )
		    )); 
	    //Our Portfolio Section in Background Image
	    	$wp_customize->add_setting('our_portfolio_bg_image', array(
	    		'default'  => '',
	        	'type'       => 'theme_mod',
		        'transport'     => 'refresh',
		        'height'        => 180,
		        'width'        => 160,
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw'
		    ));
		    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'our_portfolio_bg_image', array(
		        'label' => __('Background Image', 'designhubs'),
		        'section' => 'designhubs_our_portfolio_section',
		        'settings' => 'our_portfolio_bg_image',
		        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
		        'active_callback' => 'designhubs_our_portfolio_design_callback',
		    )));
		//Our Portfolio  in image background position
		    $wp_customize->add_setting('designhubs_our_portfolio_bg_position', array(
		        'default'        => 'center center',
		        'type'       => 'theme_mod',
		        'transport'   => 'refresh',
		        'capability'     => 'edit_theme_options',		
		        'sanitize_callback' => 'designhubs_sanitize_select',
		    ));
		    $wp_customize->add_control( new WP_Customize_Control(
		    	$wp_customize,'designhubs_our_portfolio_bg_position',
		    	array(
			        'settings' => 'designhubs_our_portfolio_bg_position',
			        'label'   => 'Background Position',
			        'section' => 'designhubs_our_portfolio_section',
			        'type'  => 'select',
			        'choices'    => $image_position,
		        	'active_callback' => 'designhubs_our_portfolio_design_callback',
		        )
		    )); 
		//Our Portfolio  in image background attachment
		    $wp_customize->add_setting('designhubs_our_portfolio_design_callback', array(
		        'default'        => 'scroll',
		        'type'       => 'theme_mod',
		        'transport'   => 'refresh',
		        'capability'     => 'edit_theme_options',		
		        'sanitize_callback' => 'sanitize_text_field',
		    ));
		    $wp_customize->add_control( new WP_Customize_Control(
		    	$wp_customize,'designhubs_our_portfolio_design_callback',
		    	array(
			        'settings' => 'designhubs_our_portfolio_design_callback',
			        'label'   => 'Background Attachment',
			        'section' => 'designhubs_our_portfolio_section',
			        'type'  => 'select',
			        'choices'    => array(
			        	'scroll' => 'Scroll',
			        	'fixed' => 'Fixed',
		        	),
		        	'active_callback' => 'designhubs_our_portfolio_design_callback',
		        )
		    ));
		//Our Portfolio  in image background Size
		    $wp_customize->add_setting('designhubs_our_portfolio_bg_size', array(
		        'default'        => 'cover',
		        'type'       => 'theme_mod',
		        'transport'   => 'refresh',
		        'capability'     => 'edit_theme_options',		
		        'sanitize_callback' => 'sanitize_text_field',
		    ));
		    $wp_customize->add_control( new WP_Customize_Control(
		    	$wp_customize,'designhubs_our_portfolio_bg_size',
		    	array(
			        'settings' => 'designhubs_our_portfolio_bg_size',
			        'label'   => 'Background Size',
			        'section' => 'designhubs_our_portfolio_section',
			        'type'  => 'select',
			        'choices'    => array(
			        	'auto' => 'Auto',
			        	'cover' => 'Cover',
			            'contain' => 'Contain'
		        	),
		        	'active_callback' => 'designhubs_our_portfolio_design_callback',
		        )
		    ));  
		//Our Portfolio in background color
		   	$wp_customize->add_setting( 'designhubs_our_portfolio_bg_color', 
		        array(
		            'default'    => '#ffffff', //Default setting/value to save
		            'type'       => 'theme_mod',
		            'transport'   => 'refresh',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'sanitize_hex_color',
		        ) 
		    ); 
	        $wp_customize->add_control( new WP_Customize_Color_Control( 
		        $wp_customize,'designhubs_our_portfolio_bg_color', 
		        array(
		            'label'      => __( 'Background Color', 'designhubs' ), 
		            'settings'   => 'designhubs_our_portfolio_bg_color', 
		            'priority'   => 10,
		            'section'    => 'designhubs_our_portfolio_section',
		            'active_callback' => 'designhubs_our_portfolio_design_callback',
		        ) 
	        ) ); 
	    //Our Portfolio in title color
		   	$wp_customize->add_setting( 'designhubs_our_portfolio_title_color', 
		        array(
		            'default'    => '#333333', //Default setting/value to save
		            'type'       => 'theme_mod',
		            'transport'   => 'refresh',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'sanitize_hex_color',
		        ) 
		    ); 
	        $wp_customize->add_control( new WP_Customize_Color_Control( 
		        $wp_customize,'designhubs_our_portfolio_title_color', 
		        array(
		            'label'      => __( 'Title Color', 'designhubs' ), 
		            'settings'   => 'designhubs_our_portfolio_title_color', 
		            'priority'   => 10,
		            'section'    => 'designhubs_our_portfolio_section',
		            'active_callback' => 'designhubs_our_portfolio_design_callback',
		        ) 
	        ) ); 
	    //Our Portfolio in text color
		   	$wp_customize->add_setting( 'designhubs_our_portfolio_text_color', 
		        array(
		            'default'    => '#333', //Default setting/value to save
		            'type'       => 'theme_mod',
		            'transport'   => 'refresh',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'sanitize_hex_color',
		        ) 
		    ); 
	        $wp_customize->add_control( new WP_Customize_Color_Control( 
		        $wp_customize,'designhubs_our_portfolio_text_color', 
		        array(
		            'label'      => __( 'Text Color', 'designhubs' ), 
		            'settings'   => 'designhubs_our_portfolio_text_color', 
		            'priority'   => 10,
		            'section'    => 'designhubs_our_portfolio_section',
		            'active_callback' => 'designhubs_our_portfolio_design_callback',
		        ) 
	        ) );    
	    //Our Portfolio in Container text color
		   	$wp_customize->add_setting( 'designhubs_our_portfolio_container_text_color', 
		        array(
		            'default'    => '#333333', //Default setting/value to save
		            'type'       => 'theme_mod',
		            'transport'   => 'refresh',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'sanitize_hex_color',
		        ) 
		    ); 
	        $wp_customize->add_control( new WP_Customize_Color_Control( 
		        $wp_customize,'designhubs_our_portfolio_container_text_color', 
		        array(
		            'label'      => __( 'Container Text Color', 'designhubs' ), 
		            'settings'   => 'designhubs_our_portfolio_container_text_color', 
		            'priority'   => 10,
		            'section'    => 'designhubs_our_portfolio_section',
		            'active_callback' => 'designhubs_our_portfolio_design_callback',
		        ) 
	        ) );  
	    //Our Portfolio in Container background color
		   	$wp_customize->add_setting( 'designhubs_our_portfolio_container_bg_color', 
		        array(
		            'default'    => '#ffffff', //Default setting/value to save
		            'type'       => 'theme_mod',
		            'transport'   => 'refresh',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'sanitize_hex_color',
		        ) 
		    ); 
	        $wp_customize->add_control( new WP_Customize_Color_Control( 
		        $wp_customize,'designhubs_our_portfolio_container_bg_color', 
		        array(
		            'label'      => __( 'Container Background Color', 'designhubs' ), 
		            'settings'   => 'designhubs_our_portfolio_container_bg_color', 
		            'priority'   => 10,
		            'section'    => 'designhubs_our_portfolio_section',
		            'active_callback' => 'designhubs_our_portfolio_design_callback',
		        ) 
	        ) );   
	    //Our Portfolio in icon background color
		   	$wp_customize->add_setting( 'designhubs_our_portfolio_icon_bg_color', 
		        array(
		            'default'    => '#455d58', //Default setting/value to save
		            'type'       => 'theme_mod',
		            'transport'   => 'refresh',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'sanitize_hex_color',
		        ) 
		    ); 
	        $wp_customize->add_control( new WP_Customize_Color_Control( 
		        $wp_customize,'designhubs_our_portfolio_icon_bg_color', 
		        array(
		            'label'      => __( 'Icon Background Color', 'designhubs' ), 
		            'settings'   => 'designhubs_our_portfolio_icon_bg_color', 
		            'priority'   => 10,
		            'section'    => 'designhubs_our_portfolio_section',
		            'active_callback' => 'designhubs_our_portfolio_design_callback',
		        ) 
	        ) );   
	    //Our Portfolio in icon color
		   	$wp_customize->add_setting( 'designhubs_our_portfolio_icon_color', 
		        array(
		            'default'    => '#fff', //Default setting/value to save
		            'type'       => 'theme_mod',
		            'transport'   => 'refresh',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'sanitize_hex_color',
		        ) 
		    ); 
	        $wp_customize->add_control( new WP_Customize_Color_Control( 
		        $wp_customize,'designhubs_our_portfolio_icon_color', 
		        array(
		            'label'      => __( 'Icon Color', 'designhubs' ), 
		            'settings'   => 'designhubs_our_portfolio_icon_color', 
		            'priority'   => 10,
		            'section'    => 'designhubs_our_portfolio_section',
		            'active_callback' => 'designhubs_our_portfolio_design_callback',
		        ) 
	        ) );   
}
add_action( 'customize_register', 'designhubs_portfolio_setting' );