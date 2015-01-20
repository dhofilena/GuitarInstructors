<?php
/*
Template Name: Login Page
*/

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
          
          <div class="main-cont" style="padding-top: 60px;">
            <h3>Instructors Login</h3>
            <div class="view-all" style="padding:5px 0; margin-bottom: 10px;"></div>
            <p style="padding-bottom:10px;">Thank You for returning to Guitar Instructors. Please login below.</p>
             
           <?php webcretix_login_main(); ?>
           
            <div class="clear" style="height:20px;"></div>
            <div class="sml-text">This is the login for GuitarInstructors members. Not a member? Visit <a href="<?php echo site_url(); ?>">GuitarInstructors.com</a> or <a href="<?php echo site_url(); ?>/?page_id=86">SIGNUP NOW!</a><br /><a href="">PASSWORD RETRIEVAL</a> is available if you are a registered GuitarInstructors.com subscriber.</div>
            <div class="clear" style="height:10px;"></div>
          </div>
          <div class="shadow-full"></div>                  
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>