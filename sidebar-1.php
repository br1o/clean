<?php
/*
@package WordPress
@subpackage Clean
@author Bruno Bichet <bruno.bichet@gmail.com>
@version 0.2
@since Version 0.2
@todo Check the markup http://validator.w3.org/
For Those About to Rock. Fire!
*/
?>
				<aside id="sidebar-1" class="sidebar sidebars" role="complementary">

					<h1 class="visuallyhidden section-title"><?php _e('Aside Sidebar 1', 'basics' ); ?></h1>
					
				<?php if ( is_active_sidebar( 'war-5' ) ) : ?>
					<section id="widget-area-5" class="widget">
						<h2 class="visuallyhidden section-title"><?php _e('Section widget area 5', 'basics' ); ?></h2>
						<?php dynamic_sidebar( 'war-5' ); ?>
					</section> <!-- eo #widget-area-5 .widget -->
				<?php endif; ?>

					<section id="widget-area-6" class="widget">
						<h2 class="visuallyhidden section-title"><?php _e('Section widget area 6', 'basics' ); ?></h2>
				<?php if ( ! dynamic_sidebar( 'war-6' ) ) : ?>
						<div id="meta">
							<h3><?php _e( 'Meta', 'basics' ); ?></h3>
							<ul>
								<?php wp_register(); ?>
								<li><?php wp_loginout(); ?></li>
								<?php wp_meta(); ?>
							</ul>
						</div>
				<?php endif; ?>
					</section> <!-- eo #widget-area-6 .widget -->
					
				</aside> <!-- eo #sidebar-1 .sidebars -->