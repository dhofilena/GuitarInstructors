<?php
/*
Template Name: Instructor List
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
            <?php
				     $guitar_instructors = get_users('role=contributor&orderby=registered&order=DESC&fields=all_with_meta&number=3');
					  
					  $row_count = 0;
					  foreach ($guitar_instructors as $user) {
					  	
						if($row_count < 1){	
						  echo '<div class="gi-list">'; 
						  $row_count++;
						}else{ 
						  echo '<div class="gi-list last">'; 
						  $row_count = 0;
						}				  
					  ?>
                       
                                             
                          <span class="prof-pic"><? echo get_avatar( $user->ID , $size = '100'); ?></span>
                          <ul>
                          
						  <?php echo '<li class="gi-name"><a href="'. get_site_url() . '/?page_id=29&prof_id=' . $user->ID .'">' . $user->display_name . '</a></li>'; ?>
                          <?php echo '<li class="gi-style"><span style="text-transform:capitalize; color:#FF0">' . $user->guitarstyle . '</span></li>'; ?> 
                          <?php echo '<li class="gi-loc">' . $user->address . " " . $user->city . " " . 
		                              $user->province . " " . $user->postalcode . '</li>'; ?>
                          <?php echo '<li class="gi-num">' . $user->phone . '</li>'; ?>         
                          </ul>
                       </div>
                      <?php
					  }				 
				 ?>
            
          </div>
          <div class="shadow-full"></div>
          
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>