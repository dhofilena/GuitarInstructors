<?php
/*
Template Name: GI Page Template
*/

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
          
          <div class="main-cont" style="padding-top: 60px;">
            <h3><?php the_title(); ?></h3>
            <div class="view-all" style="padding:5px 0; margin-bottom: 10px;"></div>
            <div class="clear" style="height:30px;"></div>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; // end of the loop. ?>
          </div>
          <div class="shadow-full"></div>
          
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>