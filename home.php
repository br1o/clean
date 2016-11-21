<?php
/*
@package WordPress
@subpackage Clean
@author Bruno Bichet <bruno.bichet@gmail.com>
@version 0.3.2
@since Version 0.2
@todo Check the markup http://validator.w3.org/
For Those About to Rock. Fire!
*/
?>
<?php get_header(); ?>
        <div id="main">
			<section role="main">
				<header class="hidden">
					<div class="section-hgroup section-hgroup-home">
						<?php $section = basics_section_heading(); ?>
						<h1 class="section-title h4-like"><?php echo $section['section_title']; ?></h1>
						<div class="section-description h2-like"><?php echo $section['section_description']; ?></div>
					</div>
				</header>
				<!-- First loop:
          display the last Sticky Post or the last post published if none
        -->
				<?php
					$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					$sticky = get_option( 'sticky_posts' );
					$args = array(
						'post__in'  => $sticky,
						'ignore_sticky_posts' => 1,
						'posts_per_page' => 1,
						'paged'          => $paged
					);
					$featured_query = new WP_Query( $args );
				?>
				<?php if ( ! $featured_query->have_posts() ) : ?>
					<p class="info error"><?php _e( 'Posts not found. Tell the administrator that the category requested not exists.', 'basics' ); ?></p>
				<?php endif; ?>
				<?php while ( $featured_query->have_posts() ) : $featured_query->the_post();
					if ( ! isset ( $do_not_duplicate ) ) { $do_not_duplicate[] = $post->ID; }
				?>
					<!-- Fetch the current category and store it for the second loop -->
					<?php
						$current_category = get_the_category();
						$current_category = $current_category[0]->term_id;
					?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; wp_reset_postdata(); ?>
			</section>
			<section role="region">
				<header>
					<div class="section-hgroup section-hgroup-home">
						<h1 class="section-title h4-like"><?php _e( 'Do you want to know more?', 'basics' ); ?></h1>
						<div class="section-description h5-like">
								<?php printf( __( '%1$s <strong>%2$s</strong>', 'basics' ),
									__( 'Find here all the latest news about Basics', 'basics' ),
									basics_more_current_category() );
								?>
						</div>
					</div>
				</header>
				<!-- Second loop:
          display the posts from the category of the last post published.
        -->
				<?php
					$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					$args = array(
						/* Change either "category_name" or "cat" to match your needs. */
						/*'category_name'  => 'news',*/
						'cat' => $current_category,
						'posts_per_page' => 3,
						'paged' => $paged,
						'post__not_in' => $do_not_duplicate
					);
					$featured_query = new WP_Query( $args );
				?>
				<?php while ( $featured_query->have_posts() ) : $featured_query->the_post();
					//Supprimer ce if (cf. post__not_in avec déjà $do_not_duplicate)
					//if( $post->ID == $do_not_duplicate ) continue;
						update_post_caches($posts);
				?>
					<?php get_template_part( 'content', 'news' ); ?>
				<?php endwhile; wp_reset_postdata(); ?>
				<div id="category-link" class="big-link">
					<?php echo basics_current_category_link(); ?>
				</div>
        <div id="archives-link" class="big-link">
          <?php echo basics_archives_link(); ?>
        </div>
			</section>
    </div> <!-- eo #main -->
		<div id="sidebar">

		<?php echo basics_searchform(); ?>

		<!-- Display a design-graphisme post randomly -->
		<aside id="rand-1" class="sidebar featured-sidebar">
			<section class="widget">
				<h1 class="visuallyhidden section-title"><?php _e('Aside tutorial', 'basics' ); ?></h1>
	      <?php
	      	$args = array(
	      		'category_name' => 'design-graphisme',
	      		'showposts' => 1,
	      		'orderby' => 'rand',
	      	);
	      	?>
	      <?php $my_query = new WP_Query( $args );
	      while ($my_query->have_posts()) : $my_query->the_post(); ?>
	        <!-- begin article -->
	        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Article">
	        	<header>
		          <!-- Fetch the current category and store it for the second loop -->
							<?php
								$current_category = get_the_category();
								$current_category_cat_name = $current_category[0]->cat_name;
							?>
	            <div class="featured-category">
								<?php _e( 'A random post in', 'basics' ); ?> <strong><?php echo $current_category_cat_name; ?></strong>
							</div>
	          	<h3 class="entry-title h4-like"><a href="<?php the_permalink(); ?>?from=random_post" rel="bookmark" title="Lien permanent vers <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
	          </header>
	          <div class="entry">
	              <?php the_content('→'); ?>
	          </div>
	        </article>
	        <!-- end article -->
	      <?php endwhile; ?>
      </section>
    </aside> <!-- eo #rand-1 -->

		<!-- Display a Portfolio post randomly -->
		<aside id="rand-2" class="sidebar featured-sidebar">
			<section class="widget">
				<h1 class="visuallyhidden section-title"><?php _e('Aside tutorial', 'basics' ); ?></h1>
	      <?php
	      	$args = array(
	      		'tag' => 'Portfolio',
	      		'showposts' => 1,
	      		'orderby' => 'rand',
	      	);
	      	?>
	      <?php $my_query = new WP_Query( $args );
	      while ($my_query->have_posts()) : $my_query->the_post(); ?>
	        <!-- begin article -->
	        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Article">
	        	<header>
		          <!-- Fetch the current category and store it for the second loop -->
							<?php
								$current_category = get_the_category();
								$current_category_cat_name = $current_category[0]->cat_name;
							?>
	            <div class="featured-category">
								<?php _e( 'A random post in', 'basics' ); ?> <strong><?php echo $current_category_cat_name; ?></strong>
							</div>
	          	<h3 class="entry-title h4-like"><a href="<?php the_permalink(); ?>?from=random_post" rel="bookmark" title="Lien permanent vers <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
	          </header>
	          <div class="entry">
	              <?php the_content('→'); ?>
	          </div>
	        </article>
	        <!-- end article -->
	      <?php endwhile; ?>
      </section>
    </aside> <!-- eo #rand-2 -->

		<?php if ( is_active_sidebar( 'war-3' ) ) : ?>
			<aside id="sidebar-0" class="sidebar" role="complementary">
				<section id="widget-area-3" class="widget">
					<?php dynamic_sidebar( 'war-3' ); ?>
				</section> <!-- eo #widget-area-3 .widget -->
			</aside>
		<?php endif; ?>

            <?php //get_sidebar( '1' ); ?>

            <?php //get_sidebar( '2' ); ?>

		<?php if ( is_active_sidebar( 'war-4' ) ) : ?>
			<aside id="sidebar-4" class="sidebar" role="complementary">
				<section id="widget-area-4" class="widget">
					<?php dynamic_sidebar( 'war-4' ); ?>
				</section> <!-- eo #widget-area-4 .widget -->
			</aside>
		<?php endif; ?>

		</div> <!-- eo #sidebar -->
<?php get_footer(); ?>
