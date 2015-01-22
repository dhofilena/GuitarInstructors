<?php
/**
 * The sidebar for homepage
 *
 */
?>
<div class="gi-home-sidebar">
  <!-- Login Section -->
  <div class="gi-login">
  
    <?php if(!is_user_logged_in()){ ?>
    <div class="fb-login-button" id="loginBtn" data-max-rows="1" data-size="medium"></div>
  	<button onclick="FB_Login_popup()"> Design My FB Login </button>
    <?php } ?>
    <div id="status">
	</div>
  </div>
  <!-- end Login Section -->
  
  <!-- Popular Post -->
  <div class="gi-popular">
  </div>
  <!-- end Popular Post-->
</div>