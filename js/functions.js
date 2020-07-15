function mycarousel_initCallback(carousel) {
    $('.slide-link .img a').bind('click', function() {
        carousel.scroll($.jcarousel.intval($(this).attr('rel')));
        return false;
    });	        
};
	
	
function mycarousel_itemFirstInCallback(carousel, item, idx, state) {
	$('.slide-link .img').animate({
		marginTop: '14px'
	} ,200);
	$('.slide-link').removeClass('active');
	$('.slide-link').eq(idx-1).addClass('active');
	$('.slide-link .img').eq(idx-1).animate({
		marginTop: '0'
	});
};


$(function() {
    $("#mycarousel").jcarousel({
        auto: 3,
        scroll: 1,
        wrap:"both",
        visible: 1,
        itemFirstInCallback: {
        	onBeforeAnimation: mycarousel_itemFirstInCallback
        },
        initCallback: mycarousel_initCallback,
        // This tells jCarousel NOT to autobuild prev/next buttons
        buttonNextHTML: null,
        buttonPrevHTML: null
    });
    $('#product-slider').jcarousel({
		'scroll': 1,
		'auto': 3,
		'wrap': 'both'
	});
    if($.browser.msie && $.browser.version=="6.0")
	{
		DD_belatedPNG.fix('.info-shadow, .shadow');
		DD_belatedPNG.fix('h1.shadowed');
		DD_belatedPNG.fix('.entry');
		DD_belatedPNG.fix('.footer-cols .shell');
	}
   
	$('.blink').focus(function () {
		if ($(this).val() == $(this).attr('title')) {
			$(this).val('');
		}
	});
	
	$('.blink').blur(function () {
		if ($(this).val() == '') {
			$(this).val($(this).attr('title'));
		}
	}); 
});