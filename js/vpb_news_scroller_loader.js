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


/* We have used window.load function to be sure that all required contents are loaded before the scroller begins to scroll the items */
$(window).load(function()
{
	$(document).ready(function() 
	{
		vpb_auto_display_news_scroller();
	});
});


//This function loads the news scroller
function vpb_auto_display_news_scroller()
{
	$.ajax({
		type: "POST",
		url: "vpb_auto_display_news_scroller.php",
		data: '',
		cache: false,
		beforeSend: function() 
		{
			$("#vpb_auto_display_news_scroller").html('<div style="height:150px;padding-top:120px;min-width:200px;width:auto;margin: 0 auto;font-family:Verdana, Geneva, sans-serif;font-size:12px;" align="center">Loading <img src="css/images/loadings.gif" align="absmiddle" alt="Loading..." /></div>');
		},
		success: function(response) 
		{
			$('#vpb_auto_display_news_scroller').fadeIn(400).html(response); 
		}
	});
}