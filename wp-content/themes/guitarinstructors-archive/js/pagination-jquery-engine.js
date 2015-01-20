// This file demonstrates the different options of the pagination plugin
// It also demonstrates how to use a JavaScript data structure to
// generate the paginated content and how to display more than one
// item per page with items_per_page.

/**
 * Callback function that displays the content.
 *
 * Gets called every time the user clicks on a pagination link.
 *
 * @param {int}page_index New Page index
 * @param {jQuery} jq the container with the pagination links as a jQuery object
 */
function pageselectCallback(page_index, jq){
	// Get number of elements per pagionation page from form
	var items_per_page = 2;
	var max_elem = Math.min((page_index+1) * items_per_page, members.length);
	var newcontent = '';

	// Iterate through a selection of the content and build an HTML string
	for(var i=page_index*items_per_page;i<max_elem;i++)
	{
		newcontent += 
		  '<div class="post container" id="news">'+
            '<div class="post-style">'+
            '<a href="' + members[i][0] + '" class="newsTitle">' + members[i][1] + '</a>' +
		     members[i][2] + 
			 '</div>' +
          '</div>';
	}

	// Replace old content with new content
	jQuery('#Searchresult').html(newcontent);

	// Prevent click eventpropagation
	return false;
}


function getOptionsFromForm(){
	var opt = {callback: pageselectCallback};
	// Collect options from the text fields - the fields are named like their option counterparts
	jQuery("input:text").each(function(){
		opt[this.name] = this.className.match(/numeric/) ? parseInt(this.value) : this.value;
	});
	// Avoid html injections in this demo
		
	return opt;
}

// When document has loaded, initialize pagination and form
jQuery(document).ready(function(){
	// Create pagination element with options from form
	var optInit = getOptionsFromForm();
	jQuery("#Pagination").pagination(members.length, optInit);

	// Event Handler for for button
	jQuery("#setoptions").click(function(){
		var opt = getOptionsFromForm();
		// Re-create pagination content with new parameters
		jQuery("#Pagination").pagination(members.length, opt);
	});

});