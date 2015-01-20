<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
<div>
<input class="text" type="text" value="<?php if(trim(wp_specialchars($s,1))!='') echo trim(wp_specialchars($s,1));else echo 'Search...';?>" name="s" id="s" placeholder="Search..." />
<input type="submit" class="submit" name="Submit" value="" />
</div>
</form>