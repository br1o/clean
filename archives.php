<?php
/* Template Name: Archives */
/*
@package WordPress
@subpackage Basics
@author Bruno Bichet <bruno.bichet@gmail.com>
@version 1
@since Version 1
@todo Check the markup http://validator.w3.org/
For Those About to Rock. Fire!
*/
?>
<?php get_header(); ?>
    <div id="main">
			<section role="main">
        <header class="">
					<div class="section-hgroup section-hgroup-archives">
						<?php $section = basics_section_heading(); ?>
						<h1 class="section-title h4-like"><?php echo $section['section_title']; ?></h1>
						<div class="section-description big"><?php echo $section['section_description']; ?></div>
					</div>
				</header>
        <?php
          $paged = ( get_query_var('paged') ) ? get_query_var( 'paged' ) : 1;  query_posts( "posts_per_page=10&paged=$paged" );
          $args = array(
            'paged' => $paged,
          );
          $archives_query = new WP_Query( $args );
        ?>
        <?php while ( $archives_query->have_posts() ) : $archives_query->the_post(); ?>
          <?php get_template_part( 'content', get_post_format() ); ?>
        <?php endwhile; ?>
        <?php basics_content_nav( 'nav-below', 'menu' ); ?>
      </section>
    </div> <!-- eo #main -->
		<div id="sidebar">
			<?php get_sidebar(); ?>
		</div> <!-- eo #sidebar -->
<?php get_footer(); ?>
