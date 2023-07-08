<?php

if ( ! function_exists( 'featured_slider_activate' ) ) :

	function featured_slider_activate(){
		$sliders = array();
		$featured_slider = apply_filters('bizemla_section', $sliders);
		$quantity  = get_theme_mod( 'featuredimage_slider_number', 1 );
		?>
		<div class="featured_slider_image">
			<div id="owl-demo" class="owl-carousel owl-theme featuredimage_slider">
				<?php
				for ( $i = 1; $i <= $quantity; $i++ ) {
						$featured_post_title = get_theme_mod( 'featuredimage_slider_title_' . $i,$featured_slider['slider']['title'][$i-1]);
						$featured_image_slider_description = get_theme_mod( 'featuredimage_slider_description_' . $i,$featured_slider['slider']['description'][$i-1]);
						$featured_image_sliders= get_theme_mod( 'featured_image_sliders_' . $i );
						?>	
						<div class="item">
						  	<div class="hentry-inner">
								<div class="post-thumbnail">
									<?php if(get_theme_mod( 'featured_image_sliders_' . $i )){ ?>
										<img src="<?php echo esc_attr($featured_image_sliders); ?>" alt="The Last of us">

									<?php }else{
										?>
										<img src="<?php echo esc_attr(get_template_directory_uri()); ?>/assets/images/no-thumb.jpg" alt="The Last of us">
										<?php
									} ?> 
								</div>				
							  	<div class="entry-container">
							  		<?php if($featured_post_title){
							  			?>
							  			<header class=" featured_slider_title entry-header">					
										<h1 class="entry-title">
									  		<?php echo esc_attr($featured_post_title); ?>
									  	</h1>
									</header>
							  			<?php
							  		} ?>						
								  	<div class="featured_slider_disc entry-summary"><?php echo esc_html($featured_image_slider_description); ?></div>
								  	<?php if(get_theme_mod( 'featuredimage_slider_button_' . $i,$featured_slider['slider']['button'][$i-1]) != ''){ ?>
									  	<div class="image_btn button">
											<a href="<?php echo esc_attr(get_theme_mod( 'featuredimage_slider_button_link_'. $i,$featured_slider['slider']['button_link'][$i-1])); ?>" class="buttons"><?php echo esc_html(get_theme_mod( 'featuredimage_slider_button_' . $i,$featured_slider['slider']['button'][$i-1])); ?></a>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
				<?php } ?>
			</div>
		</div>
		<?php
	}
endif;