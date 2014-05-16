<?php
	
	/*	
	Plugin Name: ACF Tabbing
	Author: Adrian Lambertz
	Description: Wordpress Tabbing Plugin. This Plugin needs ACF (Repeater Field) and the Foundation Framework to do its magic. So be sure to install them first!
	Plugin URI: https://github.com/PixelbarEupen/Tabbing
	Version: 0.1.15
	GitHub Plugin URI: https://github.com/PixelbarEupen/Tabbing
	GitHub Access Token: 6ca583973da0e33ee1a6c90c3e4920e6143369ca
	*/
	
	/******************************************************************************************/
	/************************* DO NOT CHANGE ANYTHING AFTER THIS LINE *************************/
	
	include('includes/register-acf.php');
	
	
	/**** ADD TABS TO PAGE.PHP ****/
	if(!function_exists(add_tabs)):
		function add_tabs(){
			if(get_field('tabs')):
				
				$content = get_the_content(); //retrieve the original content
				$content .= '<div class="tabs">';
					$content .= '<dl class="tabs" data-tab="">';
						$i = 1;
						while(has_sub_field('tabs')):
							$class = ($i == 1) ? $class = 'active' : $class = '';
							$content .= '<dd class="'.$class.'"><a  href="#'.sanitize_title(get_sub_field('titel')).'">'.get_sub_field('titel').'</a></dd>';
							$i++;
						endwhile;
					$content .= '</dl>';
					
					$content .= '<div class="tabs-content">';
						$content_i = 1;
						while(has_sub_field('tabs')):
							$content_class = ($content_i == 1) ? $content_class = 'active' : $content_class = '';
							$content .= '<div class="content '.$content_class.'" id="'.sanitize_title(get_sub_field('titel')).'">';
								$content .= '<h2 class="large-12 column tab-title"><span>'.get_sub_field('titel').'</span></h2>';
								if(get_sub_field('img_ausrichtung') == 'left'):
									$class = 'left';
								elseif(get_sub_field('img_ausrichtung') == 'right'):
									$class = 'right';
								else:
									$class = 'left';
								endif;
								
								if(get_sub_field('50_50') == 'ja'):
									$width = 'large-6 medium-6';
									$firstwidth = '';
									$secondwidth = '';
								else:
									$firstwidth = 'large-4 medium-4';
									$secondwidth = 'large-8 medium-8';
									$width = '';
								endif;
								
								$fimg = wp_get_attachment_image_src(get_sub_field('first_img'),'large');
								$simg = wp_get_attachment_image_src(get_sub_field('second_img'),'large');
								
								$content .= '<div class="images '.$width.' '.$firstwidth.' column '.$class.'">';
									$content .= '<a href="'.$fimg[0].'" title="">';
										$size = 'large';
										$content .= wp_get_attachment_image(get_sub_field('first_img'),apply_filters( 'tabbing_img_size', $size ));
									$content .= '</a>';
									$content .= '<a href="'.$simg[0].'" title="">';
										$content .= wp_get_attachment_image(get_sub_field('second_img'),apply_filters( 'tabbing_img_size', $size ));
									$content .= '</a>';
								$content .= '</div>';
								$content .= '<div class="'.$width.' '.$secondwidth.' column">'.get_sub_field('inhalt').'</div>';
							$content .= '</div>';
							$content_i++;
						endwhile;
					$content .= '</div>';
				$content .= '</div>';
			endif;	
			return $content;
		}
	endif;
	add_filter('the_content','add_tabs');