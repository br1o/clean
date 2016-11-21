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
				<aside id="sidebar-2" class="sidebar sidebars" role="complementary">

					<h1 class="visuallyhidden section-title"><?php _e('Aside Sidebar 2', 'basics' ); ?></h1>
					
				<?php if ( is_active_sidebar( 'war-7' ) ) : ?>
					<section id="widget-area-7" class="widget">
						<h2 class="section-title"><?php _e('Section widget area 7', 'basics' ); ?></h2>
						<?php dynamic_sidebar( 'war-7' ); ?>
					</section> <!-- eo #widget-area-7 .widget -->
				<?php endif; ?>

					<section id="widget-area-8" class="widget">
						<h2 class="visuallyhidden section-title"><?php _e('Section widget area 8', 'basics' ); ?></h2>
				<?php if ( ! dynamic_sidebar( 'war-8' ) ) : ?>
						<div id="basics-archives">
							<h3><?php _e( 'Archives', 'basics' ); ?></h3>
							<ul><?php wp_get_archives( array( 'type' => 'monthly' ) ); ?></ul>
						</div>
				<?php endif; ?>
					</section> <!-- eo #widget-area-8 .widget -->
					
				</aside> <!-- eo #sidebar-2 .sidebars -->