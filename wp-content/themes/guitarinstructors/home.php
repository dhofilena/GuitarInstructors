<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="home">
        <div id="search-list">
          <div style="height:40px;"></div>
          <div class="pre-head">No more head bangin' on the wall...</div>
          <div class="headline">Find Your Guitar Instructor Now!</div>
          <?php dynamic_sidebar( 'geo-search' ); ?>
        </div>
        <div class="gi-cont">
        <!-- Add Featured Post script here-->
        <div class="cont-wrap">
        <div class="gi-feat post">
        </div>
        <!-- end of Featured Post -->
		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
        
        <?php get_sidebar( 'home' ); ?>
        </div>
        <div class="gi-fshadow"></div>
        </div>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>