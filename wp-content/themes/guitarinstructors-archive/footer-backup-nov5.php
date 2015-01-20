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
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	    <?php if (in_category('6')) continue; ?>
          <div class="post">
            <a href="<?php the_permalink(); ?>" class="newsTitle"><?php the_title(); ?></a>
			<?php echo substr(get_the_excerpt(), 0,140) . "..."; ?>
          </div>
		<?php endwhile; else: ?>
        <p>Sorry, no posts matched your criteria.</p>
	  <?php endif; ?>
    </div>
  </div>
</div>

<?php wp_footer(); ?>
</body>
</html>