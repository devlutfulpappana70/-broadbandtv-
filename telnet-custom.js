(function ($) {
	"use strict";



	// insert quote icon on blockquote first p tag
	if($('blockquote p:first-child').length) {
		$('blockquote p:first-child').prepend('<i class="fa-sharp fa-solid fa-quote-left"></i>');
	};

	// add class #respond id
	if($('#respond').length) {
		$('#respond').addClass('tx-pd-40 pt-30 bg-white tx-boxshadow tx-radious-30 mt-40');
	}

	// take last 3 list item from the id of menu-quick-links menus and wrap it with a <ul> and append it after the menu
	if($('#menu-quick-links').length == 0) return;
	var $menuPopularTags = $('#menu-quick-links');
	var $menuPopularTagsItems = $menuPopularTags.find('li');
	var $menuPopularTagsItemsLength = $menuPopularTagsItems.length;
	var $menuPopularTagsItemsLastThree = $menuPopularTagsItems.slice($menuPopularTagsItemsLength - 3, $menuPopularTagsItemsLength);
	var $menuPopularTagsItemsLastThreeUl = $('<ul class="menu"></ul>');
	$menuPopularTagsItemsLastThreeUl.append($menuPopularTagsItemsLastThree);
	$menuPopularTags.after($menuPopularTagsItemsLastThreeUl);

})(jQuery);
