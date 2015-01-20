<?php
/*
Template Name: Instructor Page
*/

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
          <?php 
		  
		   $guitar_instructors =  get_userdata($_GET["prof_id"]);
		   $gi_meta = array_map( function( $a ){ return $a[0]; },get_user_meta($_GET["prof_id"]));
		  ?>
          
          <div class="main-cont" style="padding-top: 40px;" id="instructor-page">
            <table cellpadding="0" cellspacing="0" style="width:100%; min-height:250px;">
              <tr>
                <td width="250" style="vertical-align:top;" rowspan="2"><center><? echo get_avatar( $_GET["prof_id"] , $size = '250'); ?></center></td>
                <td style="padding-left:15px;vertical-align:bottom; height:70px;"><h3><?= $guitar_instructors->first_name . " " . $guitar_instructors->last_name; ?></h3>
            <div class="view-all" style="padding:5px 0; margin-bottom: 20px;"></div>
            </td>
              </tr>
              <tr>
                <td style="padding-left:15px">
                
                  <span class="giLabel">Guitar Style:</span><span class="giInput" style="text-transform:capitalize;"><?= $gi_meta["guitarstyle"] ; ?></span><div class="clear"></div>
                  <span class="giLabel">Location:</span><span class="giInput"><?= $gi_meta["city"] . " " . $gi_meta["province"] ; ?></span>
                  <div class="clear"></div>
                  <span class="giLabel">Contact No:</span><span class="giInput"><?= $gi_meta["phone"] ; ?></span>
                  <div class="clear"></div>
                  <span class="giLabel">Email Address:</span><span class="giInput"><?= $guitar_instructors->user_email ?></span>
                  <div class="clear"></div>
                  <span class="giLabel">Website:</span><span class="giInput"><a href="<?= $guitar_instructors->user_url ?>"><?= $guitar_instructors->user_url ?></a></span>
                  
                </td>
              </tr>
            </table>
            
            <div class="view-all" style="overflow:visible;"><div class="clear" style="height:10px;"></div><span>Biography</span></div>
            <div class="clear" style="height:25px;"></div>
           <?= $gi_meta["description"] ?>
           <div class="clear" style="height:20px;"></div>
            <div class="view-all" style="overflow:visible;"><div class="clear" style="height:10px;"></div><span>Fees</span></div>
            <div class="clear" style="height:25px;"></div>
            <?= $gi_meta["fees_info"] ?>
            <div class="clear" style="height:20px;"></div>
            <div class="view-all" style="overflow:visible;"><div class="clear" style="height:10px;"></div><span><?= $guitar_instructors->first_name ?>'s Posts</span></div><div class="clear" style="height:25px;"></div>

          <?php 
            $args = array(  'author' => $_GET["prof_id"] // I could also use $user_ID, right
                     );
			
			$myposts = get_posts( $args );
			
			if(count($myposts) == 0){
				echo "No available posts.";
			}
			else{
			foreach ( $myposts as $post ) : setup_postdata( $post );?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach;		 
			}
				
          ?>
            <div class="clear" style="height:20px;"></div>
          </div>
          <div class="shadow-full"></div>
          
		</div><!-- #content -->
	</div><!-- #primary -->
    
   

<?php get_footer(); ?>