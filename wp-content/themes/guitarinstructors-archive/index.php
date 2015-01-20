<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<div id="searchMap" style="clear:both; position:relative;">
  <div class="alignleft" style="font-size:18px; color:#fff; display:table; padding: 20px 0 0 110px;">No more head bangin' on the wall...</div>
  <div class="clear"></div>
  <div class="alignright">
    <h1 class="text1" style="margin: 5px 150px 0 0; font-size: 38px;">Find Your Guitar Instructor NOW!</h1>
  </div>
  <div class="clear" style="height:17px;"></div>
  <?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
    <div id="gmap" class="gmap" role="complementary">
	  <?php dynamic_sidebar( 'sidebar-5' ); ?>
    </div>
  <?php endif; ?>
</div>
<div class="clear"></div>
	<div id="primary" class="site-content">
		<div id="content" role="main">
		  <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
          
          <div class="main-cont">
            <div id="featured">
            <?php
            query_posts('posts_per_page=1&category_name=featured-post'); /*1, 2*/
              if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <div class="alignleft featured-cont">
                  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); /*3*/ ?></a></h2>
                  <div class="clear" style="height:60px;"></div>
                  <?php
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
					the_post_thumbnail();
					} 
				  ?>
                  
                  <?php the_content(); ?>
                </div>
              <?php endwhile; ?> <?php wp_reset_query(); /*4*/ ?>
            </div>
            
            <div id="guitinstBox">
              <div class="articleTitle">Recently Joined Guitar Instructors</div>
              <!-- Display the list of users here -->
                 <?php
				     $guitar_instructors = get_users('role=contributor&orderby=registered&order=DESC&fields=all_with_meta&number=3');
					  
					  $row_count = 0;
					  foreach ($guitar_instructors as $user) {
					  	
						if($row_count < 2){	
						  echo '<div class="gi-infobox">'; 
						  $row_count++;
						}else{ 
						  echo '<div class="gi-infobox last">'; 
						  $row_count = 0;
						}				  
					  ?>
 
                          <span style="width:100px; display:inline-block; margin-right:5px;"><? echo get_avatar( $user->ID , $size = '100'); ?></span>
                          <ul style="float:right;">
						  <?php echo '<li class="gi-name">' . $user->display_name . '</li>'; ?>
                          <?php echo '<li class="gi-loc">' . $user->address . " " . $user->city . " " . 
		                              $user->province . " " . $user->postalcode . '</li>'; ?>
                          <?php echo '<li class="gi-num">' . $user->phone . '</li>'; ?>         
                          </ul>
                       </div>
                      <?php
					  }				 
				 ?>
               
              <!-- end -->
                <div class="clear"></div>
                <div class="view-all"><a href="<?php echo get_site_url(); ?>/?page_id=63">View All Instructor</a></div>
            </div>
          </div>
          <div class="shadow-full"></div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>