<?php
	
	/*	
	Plugin Name: ACF Tabbing
	Author: Adrian Lambertz
	Description: Wordpress Tabbing Plugin. This Plugin needs ACF (Repeater Field) and the Foundation Framework to do its magic. So be sure to install them first!
	Plugin URI: https://github.com/PixelbarEupen/Tabbing
	Version: 0.1.13
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
								$content .= '<div class="images large-4 medium-4 column '.$class.'">';
									$content .= wp_get_attachment_image(get_sub_field('first_img'),'large');
									$content .= wp_get_attachment_image(get_sub_field('second_img'),'large');
								$content .= '</div>';
								$content .= '<div class="large-8 medium-8 column">'.get_sub_field('inhalt').'</div>';
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