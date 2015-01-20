<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
</div><!-- #page -->

<div id="gi-footer-wrap">
  <div id="gi-footer">
    <div class="alignleft" id="newsBox">
      <div class="articleTitle">Recent News</div>
      
	  <?php
      $args = array( 'posts_per_page' => 10);      
      $myposts = get_posts( $args );
	  
	  if (count($myposts) > 0 ){
      foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
          <div class="post container" id="news">
            <div class="post-style">
            <a href="<?php the_permalink(); ?>" class="newsTitle"><?php the_title(); ?></a>
			<?php echo substr(get_the_excerpt(), 0,140) . "..."; ?>
            </div>
          </div>
      <?php endforeach; 
      wp_reset_postdata();
      }else{?>
	     <p>Sorry, no posts matched your criteria.</p>
	  <?php } ?>
       
    </div>
    <div class="alignright" id="siteMap">
      <div class="articleTitle">Site Map</div>
      <?php wp_nav_menu( array('menu' => 'Featured Links' )); ?>
      <div class="clear" style="height:20px;"></div>
      <?php wp_nav_menu( array('menu' => 'Main Menu' )); ?>
      <div class="clear" style="height:20px;"></div>
      <?php wp_nav_menu( array('menu' => 'Company Info' )); ?>
      <div class="clear" style="height:50px;"></div>
      <div class="logo-small">
        <img src="<?php echo get_bloginfo('template_url') ?>/images/logo2.png" />
        <div class="copy">Copyright &copy; GuitarInstructors.com  -  All Rights Reserved.</div>
      </div>
    </div>
  </div>
</div>

<?php wp_footer(); ?>
</body>
</html>