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
        <?php
            $lastposts = get_posts(array('category_name' => 'featured-post'));
			
			if(count($lastposts) >= 1){
        ?>
        <div class="cont-wrap">
          <div id="gi-feat">
			
			<?php
            foreach ( $lastposts as $post ) :
              setup_postdata( $post ); ?>
              
            <div class="feat-img">        
              <?php the_post_thumbnail( 'full' ); ?>
            </div>             
            
            <div class="feat-cont">               
              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <?php get_the_post_thumbnail( $post->ID ); ?>
              <p><?php echo substr(get_the_excerpt(), 0,150); ?><a href="<?php the_permalink(); ?>">[...]</a></p>
              <a href="<?php the_permalink(); ?>" class="feat-btn">Read More &rarr;</a>
              <?php endforeach; ?>
            </div>

          </div>
        </div>
                
        <!-- end of Featured Post -->
        <div class="gi-fshadow"></div>
        <?php 
		}
		?>
        
        <div style="height:10px;"></div>
        <div class="cont-wrap">
          <div class="main-cont">
			<?php if ( have_posts() ) : ?>
    
                <?php /* The loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
                
                    <?php
					  
					  $cat = get_the_category();
					  
					 if($cat[0]->object_id != 97){
					 	get_template_part( 'content-home', get_post_format() ); 
					 }
					 ?>
                <?php endwhile; ?>
    
                <?php twentythirteen_paging_nav(); ?>
    
            <?php 
				else : 					
		             get_template_part( 'content', 'none' ); ?>
            <?php 
					
			endif; ?>
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