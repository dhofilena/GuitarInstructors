<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
        <div class="gi-cont">
        <div class="cont-wrap">
        <div class="main-cont">
		<?php if ( have_posts() ) : ?>
			<!-- header class="archive-header">
				<h1 class="archive-title"><?php //printf( __( 'Category Archives: %s', 'twentythirteen' ), single_cat_title( '', false ) ); ?></h1>

				<?php //if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php //echo category_description(); ?></div>
				<?php //endif; ?>
			</header --><!-- .archive-header -->

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
        </div>
        
        <?php if ( is_active_sidebar( 'side-home' ) ) : ?>
            <?php dynamic_sidebar( 'side-home' ); ?>
        <?php endif; ?>
        
        </div>
        <div class="gi-fshadow"></div>
        </div>
        

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>