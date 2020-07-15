/***********************************************************************************************************
* Auto News Scroller using Ajax, Jquery and PHP
* Written by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: info@vasplus.info

**********************************Copyright Information*****************************************************
* This script has been released with the aim that it will be useful.
* Please, do not remove this copyright information from the top of this page.
* If you want the copyright info to be removed from the script then you have to buy this script.
* This script must not be used for commercial purpose without the consent of Vasplus Programming Blog.
* This script must not be sold.
* All Copy Rights Reserved by Vasplus Programming Blog
*************************************************************************************************************/


$(document).ready(function() {
	$.fn.vpb_news_scroller = function(vasplus_programming_blog_info) {
		var vpb_information = {
			vpb_scroller_speed: 450, //This is the speed at which the system scrolls its items
			vpb_scroller_pause: 2800, //Allocated time for the scroller to pause and continue scrolling
			vpb_items_to_display: 1, //This is the number of items to display to the user on the screen while scrolling
			vpb_playing_or_pause: false, //Assign false to whether the system is scrolling or not which will later be used in the script
			height: 0, //Set initial scroller box height to zero
		};
	
		var vasplus_programming_blog_info = $.extend(vpb_information, vasplus_programming_blog_info),vpbscroller = $(this),vpb_max_scroller_height = 44;
		
		//Set the position of the scroller box
		vpbscroller.css({overflow: 'hidden', position: 'relative'}).children('ul').css({margin: "0", padding: "0", position: "relative", "list-style-type": "none", "z-index": "100"}).children('li').css({margin: "0", padding: "0", position: "relative", "list-style-type": "none", "z-index": "100"});
		
		// Set the height of the scroller
		vpbscroller.height(vpb_max_scroller_height * vasplus_programming_blog_info.vpb_items_to_display);
		
		// This is the main function that does the scrolling up event
		setInterval(function(){
			vpb_scroll_items_up(vpbscroller, vpb_max_scroller_height, vasplus_programming_blog_info); 
		}, vasplus_programming_blog_info.vpb_scroller_pause);
		
		// Pause the scroller when a user's mouse enters the scrolling content
		vpbscroller.mouseenter(function() {
			vasplus_programming_blog_info.vpb_playing_or_pause = true;
		}).mouseleave(function(){
			vasplus_programming_blog_info.vpb_playing_or_pause = false;
		});
			
		vpb_scroll_items_up = function(vpb_scroller_box, height, vasplus_programming_blog_info){
			if(vasplus_programming_blog_info.vpb_playing_or_pause)
				return;
			
			var vpbscroller_ul = vpb_scroller_box.children('ul');
			
			var vpb_start_scrolling_with_first_item = vpbscroller_ul.children('li:first').clone(true);
		
			vpbscroller_ul.animate({left: '-=' + height + 'px'}, vasplus_programming_blog_info.vpb_scroller_speed, function() {
				$(this).children('li:first').remove();
				$(this).css('left', '0px');
			});
			
			vpbscroller_ul.children('li:first').fadeOut(vasplus_programming_blog_info.vpb_scroller_speed);
			if(vasplus_programming_blog_info.height == 0){
				vpbscroller_ul.children('li:eq(' + vasplus_programming_blog_info.vpb_items_to_display + ')').hide().fadeout(vasplus_programming_blog_info.vpb_scroller_speed).slideleft(); }
				
			//Start with the first item again at the end of the scrolling
			vpb_start_scrolling_with_first_item.appendTo(vpbscroller_ul);
		};
	};
	$('.vpb_news_scroller').vpb_news_scroller(); //Call the scroller function via a class
});