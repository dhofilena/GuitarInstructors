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
      $args = array( 'posts_per_page' => 10, 'category' => 2);      
      $myposts = get_posts( $args );
	  
	  if (count($myposts) > 0 ){
		?>
		
		  <script>
		  var members = [		
		  <?php
		  foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
			  ["<?php the_permalink() ?>","<?php the_title(); ?>","<?php echo substr(get_the_excerpt(), 0,140) . "..."; ?>"],
		  <?php endforeach; 
		  wp_reset_postdata();      
		  ?>	
		  ];
		  </script>
          <form name="paginationoptions">
           <input type="hidden" value="2" name="items_per_page" id="items_per_page" class="numeric"/>
           <input type="hidden" value="0" name="num_display_entries" id="num_display_entries" class="numeric"/>
           <input type="hidden" value="0" name="num_edge_entries" id="num_edge_entries" class="numeric"/>
          </form>
          
          <div id="Searchresult"></div>
          <div id="Pagination" class="pagination"></div>
	   
		<?php
	  }else{ 
	    ?>
       <p>Sorry, no posts matched your criteria.</p>
       <?php
	  }
	?>  
	  
      
       
    </div>
    <div class="alignright" id="siteMap">
      <div class="articleTitle">Site Map</div>
      <?php wp_nav_menu( array('menu' => 'Featured Links' )); ?>
      <div class="clear" style="height:20px;"></div>
      <?php wp_nav_menu( array('menu' => 'Bottom Menu' )); ?>
      <div class="clear" style="height:20px;"></div>
      <?php
      	if (get_user_role() == 'contributor' || get_user_role() == 'administrator' ){
			
			wp_nav_menu( array('menu' => 'On Login' ));}
		else {
            wp_nav_menu( array('menu' => 'Company Info' ));}
		?>
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