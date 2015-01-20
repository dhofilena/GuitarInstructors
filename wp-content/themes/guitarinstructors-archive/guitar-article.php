<?php
/*
Template Name: Guitar Articles
*/

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
          
          <div class="main-cont" style="padding-top: 60px;">
            <h3><?php the_title(); ?></h3>
            <div class="view-all" style="padding:5px 0; margin-bottom: 10px;"></div>
            <div class="clear" style="height:30px;"></div>
			<?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            query_posts('posts_per_page=3&cat=2&paged=$paged'); /*1, 2*/
              if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                  <div class="alignleft">
                  <span class="cont-title"><a href="<?php the_permalink(); ?>"><?php the_title(); /*3*/ ?></a></span>
                  <?php
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
					the_post_thumbnail();
					} 
				  ?>
                  <?php the_excerpt(); ?>
                  </div>
              <?php endwhile; ?> <?php wp_reset_query(); /*4*/ ?>

          </div>
          <div class="shadow-full"></div>
          
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>