<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
            
            <div class="footer-wrap">

			<div class="site-info">
            <img src="<?php echo get_template_directory_uri(); ?>/images/bnw-logo.png" title="<?php bloginfo( 'name' ); ?>" /><br />
            <span class="copy">Copyright &copy; <?php echo date('Y'); ?> Powered by GuitarControl.com	</span>			
			</div><!-- .site-info -->
            
            <div class="bottom-links">
              <?php wp_nav_menu( array( 'theme_location' => 'bottom', 'menu_class' => 'bot-menu' ) ); ?>
              <?php wp_nav_menu( array( 'theme_location' => 'bottom2', 'menu_class' => 'bot-menu' ) ); ?>
            </div>
            
            </div>
            
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>