//Document-level functionality
$(document).ready(function () {
    setPageHeight();
    $(window).on('resize', function () {
        setPageHeight();
    });

    $('a.search-submit').on('click', function () {
        document.getElementById('top_search').submit();
    });
    buildTopMenu();
});

function buildTopMenu() {
    $('.topics-buttons').append('<a href="#" class="btn btn-lg btn-info margin-md-top open-search-button hidden-md hidden-lg"><span class="fa fa-search"></span></a><a class="btn btn-lg btn-info expand-md margin-md-top top-nav-topics hidden-md hidden-lg" href="javascript:{}"><span class="fa fa-bars"></span></a>');
    $('.topics-menu').append($('<nav>').append($('<ul>').addClass('margin-md padding-md menu topics-items')));

    $('#nav-local > ul.menu > li').each(function (e, o) {
        var ht = $(o).clone();
        $('.topics-items').append(ht);
    });
   
    $(window).on('resize', function () {
        $('.topics-menu').removeClass('opened');
        $('body').removeClass('pushed');
    });

    //$('.topics-menu nav > ul').append('<li class="nav-header-break"><h3>Quick Links</h3></li>');
    //$('.topics-menu nav > ul').append($('.quick-links ul').html());

    $('.top-nav-topics').on('click', function (event) {
        event.stopPropagation();
        $('.topics-menu').toggleClass('opened');

        $('body').toggleClass('pushed');
        positionTopicNavWindow();
    });

    $(document).on('click', function () {
        $('.topics-menu').removeClass('opened');
        $('body').removeClass('pushed');
    });

    $('.open-search-button').click(function (e) {
        $('.search-holder').toggleClass('open');
        if ($('.search-holder').hasClass('open')) {
            $('.open-search-button .fa').removeClass('fa-search');
            $('.open-search-button .fa').addClass('fa-angle-double-up');
        } else {
            $('.open-search-button .fa').addClass('fa-search');
            $('.open-search-button .fa').removeClass('fa-angle-double-up');
        }
    });
}

function addSubItems(domContainer, topic) {
    var newContainer = $('<li>').append('<a href="' + topic.url + '">' + topic.title + '</a>');
    $(domContainer).append(newContainer);
    if (topic.pages) {
        newContainer.append('<a href="#" class="expander" aria-label="Expand ' + topic.title + '"></a>');

        var subtopicContainer = $(newContainer).append('<ul class="subtopics" aria-expanded="false">').find('ul');
        for (var t in topic.pages) {
            var subtopic = topic.pages[t];
            addSubItems(subtopicContainer, subtopic);
        }
    }
}

function positionTopicNavWindow() {
    var rightPos = $(window).innerWidth() - ($('.top-nav-topics').offset().left + $('.top-nav-topics').outerWidth());
    var topAdj = 36;
    if ($(window).innerWidth() < 768) {
        topAdj = 24;
    }
    $('.topics-menu').css({
        'right': rightPos,
        'top': $('.top-nav-topics').position().top + $('.top-nav-topics').height() + topAdj
    });
}

function setPageHeight() {
    var mainmin = $(window).innerHeight() - elemHeight('.site-header') - elemHeight('#breadcrumbs-share') - elemHeight('.page-footer') - elemHeight('.footer-contact') - elemHeight('.footer-social') - elemHeight('.footer-fluid') - 3;
    $('main').css({ 'min-height': mainmin + 'px' });
}

function setHeaderHeight() {
    if ($('.site-header').hasClass('floating-header')) {
        $(".site-header").removeClass("floating-footer");
    }
    var headermin = elemHeight('.site-header');
    $('#header').css('min-height', headermin + 'px');

}

function elemHeight(elem) {
    var eheight = 0;
    if ($(elem).outerHeight() == null) {
        eheight = 0;
    } else {
        eheight = $(elem).outerHeight();
    }
    return eheight;
}

//Right hand side mobile menu functions
//function prepareSideMenu() {
//    $('.open-search-button').click(function (e) {
//        $('.search-holder').toggleClass('open');
//        if ($('.search-holder').hasClass('open')) {
//            $('.open-search-button .fa').removeClass('fa-search');
//            $('.open-search-button .fa').addClass('fa-angle-double-up');
//        } else {
//            $('.open-search-button .fa').addClass('fa-search');
//            $('.open-search-button .fa').removeClass('fa-angle-double-up');
//        }
//    });
//    $('#menuOpenButton').click(function (e) {
//        $('.local-nav-top').toggleClass('open');
//        $('body').toggleClass('pushed');
//    });
//    $('.close-tab').click(function (e) {
//        $('.local-nav-top').removeClass('open');
//        $('body').removeClass('pushed');
//    });
//    $('.menu-tab').addClass('active');
//    $('#nav-alberta').addClass('hidden');
//    $('.menu-tab').click(function (e) {
//        $('#nav-alberta').addClass('hidden');
//        $('.alberta-tab').removeClass('active');
//        $('#nav-local').removeClass('hidden');
//        $('.menu-tab').addClass('active');
//    });
//    $('.alberta-tab').click(function (e) {
//        $('#nav-alberta').removeClass('hidden');
//        $('.alberta-tab').addClass('active');
//        $('#nav-local').addClass('hidden');
//        $('.menu-tab').removeClass('active');
//    });

//}

/* ============================== STEPS CAROUSEL SETUP ================================= */

$(window).on('resize', function () {
    carouselSetup();
    setLiSizes();
    setTimeout(setStepWidths, 250);
});

$(document).ready(function () {
    carouselSetup();
    setLiSizes();
    setupAutosteppers();
    checkForLinkedItems();
    setTimeout(setStepWidths, 250);
});

function setStepWidths() {
    //Position step content
    $('.summary-step p').each(function (e) {
        $(this).css({ 'margin-top': '-' + ($(this).outerHeight() / 2) + 'px' });
    });
}

function checkForLinkedItems() {
    $('.steps-carousel .item').each(function () {
        if ($(this).attr('data-url')) {
            $(this).click(function () {
                window.open($(this).attr('data-url'), '_self');
            });
            $(this).keypress(function () {
                if (event.which == 13 || event.which == 32) {
                    window.open($(this).attr('data-url'), '_self');
                }
            });
            $(this).attr('role', 'button');
            $(this).attr('tabindex', '0');
            $(this).addClass('has-link');
        }
        if ($(this).attr('onclick')) {
            $(this).attr('role', 'button');
            $(this).attr('tabindex', '0');
            $(this).addClass('has-link');
        }
    });
}

function setCarouselPage(targetCarousel, pageNum) {
    targetCarousel = '.' + targetCarousel;
    var totalPages = Number($(targetCarousel).attr('data-total-pages'));
    var perPage = Number($(targetCarousel).attr('data-per-page'));
    if (pageNum > totalPages) {
        pageNum = 1;
    } else if (pageNum < 1) {
        pageNum = totalPages;
    }

    var liMargin = 3;
    if ($(targetCarousel).attr('data-li-margin') && $(targetCarousel).attr('data-per-page') != "1") {
        liMargin = Number($(targetCarousel).attr('data-li-margin'));
    }

    $(targetCarousel + ' .item').each(function (i, e) {
        $(this).attr('data-on-page', Math.floor(i / perPage) + 1 == pageNum);
    });

    var carouselInner = $(targetCarousel).outerWidth() + liMargin;
    if (perPage > 1) {
        $(targetCarousel + ' .item').animate({ 'left': (0 - ((pageNum - 1) * carouselInner)) + 'px' }, 750);
    }

    $(targetCarousel + ' .item[data-on-page=true]').removeClass('item-offscreen').removeClass('hidden').removeClass('zUp');
    $(targetCarousel + ' .item[data-on-page=false]').addClass('item-offscreen');
    if (perPage == 1) {
        $(targetCarousel + ' .item[data-on-page=false]').addClass('zUp');
    }


    if (perPage > 1) {

        if (pageNum == 1) {
            $(targetCarousel).addClass('steps-prev-disabled');
        } else {
            $(targetCarousel).removeClass('steps-prev-disabled');
        }

        if (pageNum == totalPages) {
            $(targetCarousel).addClass('steps-next-disabled');
        } else {
            $(targetCarousel).removeClass('steps-next-disabled');
        }
    } else {
        setTimeout(function () {
            $(targetCarousel + ' .item[data-on-page=false]').addClass('hidden');
        }, 750);
        $(targetCarousel).removeClass('steps-next-disabled');
        $(targetCarousel).removeClass('steps-prev-disabled');
    }

    var maxPage = Math.ceil(pageNum);
    $(targetCarousel).find('li[data-page="' + maxPage + '"]').addClass('active').siblings().removeClass('active');
    $(targetCarousel).attr('data-current-page', maxPage);

    if ($(targetCarousel).attr('data-carousel-sync') && $(targetCarousel).attr('data-per-page') == "1") {
        setCarouselPage($(targetCarousel).attr('data-carousel-sync'), pageNum);
        $(targetCarousel).find('.item:nth-child(' + pageNum + ')').addClass('active');
        $(targetCarousel).find('.item:nth-child(' + pageNum + ')').siblings().removeClass('active');
    }

}

function carouselSetup() {
    var carouselNum = 0;

    $('.steps-carousel').each(function (e) {

        $(this).addClass('scarousel' + carouselNum);

        var perPage = 4; //default number of items per page
        if ($(this).attr('data-per-page')) { //check if there is a defined number of items per page
            if ($(this).attr('data-orig-per-page')) {
                perPage = Number($(this).attr('data-orig-per-page'));
            } else {
                perPage = Number($(this).attr('data-per-page'));
                $(this).attr('data-orig-per-page', perPage);
            }

            if ($(window).innerWidth() <= 600) {
                perPage = 1;

            } else if ($(window).innerWidth() <= 1024 && Number($(this).attr('data-per-page')) != 1) {
                perPage = 2;
            }

        }

        $(this).attr('data-per-page', perPage);

        if (perPage == 1) {
            $(this).addClass('single-page');
        } else {
            $(this).removeClass('single-page');
        }

        var pages = Math.ceil($(this).find('.item').length / perPage);

        //set up page data
        $(this).attr('data-current-page', "1");
        $(this).attr('data-total-pages', pages);
        $(this).find('.nav-dots').remove();

        if ($(this).attr('data-show-dots') == "true" || !$(this).attr('data-show-dots')) {
            if (pages > 1) {
                var navDots = '<ul class="nav-dots" data-carousel="' + ('scarousel' + carouselNum) + '">';
                for (var i = 0; i < pages; i++) {
                    navDots += '<li class="dot" data-page="' + (i + 1) + '"></li>';
                }
                navDots += '</ul>';
                $(this).append(navDots);
            }
        } else {
            $(this).addClass('dots-disabled');
        }

        if ($(this).attr('data-show-arrows') == "true" || !$(this).attr('data-show-arrows')) {
            if ($(this).find('.prev').length == 0) {
                $(this).append('<div class="prev" data-carousel="' + ('scarousel' + carouselNum) + '"></div><div class="next" data-carousel="' + ('scarousel' + carouselNum) + '"></div>');
                $(this).find('div.prev').click(function (e) {
                    var pg = Number($(this).parent('.steps-carousel').attr('data-current-page')) - 1;
                    setCarouselPage($(this).attr('data-carousel'), pg);
                    $(this).parent('.steps-carousel').attr('data-scrolling', 'false');
                });
                $(this).find('div.next').click(function (e) {
                    var pg = Number($(this).parent('.steps-carousel').attr('data-current-page')) + 1;
                    setCarouselPage($(this).attr('data-carousel'), pg);
                    $(this).parent('.steps-carousel').attr('data-scrolling', 'false');
                });
            }
        }

        $(this).attr('data-carousel', 'scarousel' + carouselNum);
        setCarouselPage('scarousel' + carouselNum, 1);

        carouselNum++;
    });

    $('ul.nav-dots').each(function (e) {
        $(this).find('li:first').addClass('active');
    });
    $('ul.nav-dots li').click(function (e) {
        var pg = Number($(this).attr('data-page'));
        var targetCarousel = $(this).parent('.nav-dots').attr('data-carousel');
        setCarouselPage(targetCarousel, pg);
        $('.' + targetCarousel).attr('data-scrolling', 'false');
    });
}

function setupAutosteppers() {
    var autoSteppers = 0;
    $('.steps-carousel').each(function (e) {
        if ($(this).attr('data-auto-scroll') > 0) {
            $(this).attr('data-scrolling', 'true');
            $(this).attr('data-time-left', Number($(this).attr('data-auto-scroll')));
            $(this).click(function (e) {
                $(this).attr('data-scrolling', 'false');
            });
            autoSteppers++;
        }
    });
    if (autoSteppers > 0) {
        setInterval(nextCarouselPage, 250);
    }
}

function navToCarouselItem(targetCarousel, itemNum) {
    var sCarousel = '.' + targetCarousel;
    if ($(sCarousel).length > 0) {
        var whichPage = Math.ceil(itemNum / Number($(sCarousel).attr('data-per-page')));
        setCarouselPage(targetCarousel, whichPage);
        $(sCarousel).find('.item:nth-child(' + itemNum + ')').addClass('active');
        $(sCarousel).find('.item:nth-child(' + itemNum + ')').siblings().removeClass('active');

        if ($(sCarousel).attr('data-carousel-sync')) {
            navToCarouselItem($(sCarousel).attr('data-carousel-sync'), itemNum);
        }

        if ($(sCarousel).attr('data-item-height') == "auto") {
            $(sCarousel).css({ "height": $(sCarousel).find('.item:nth-child(' + itemNum + ')').innerHeight() + "px" });
        }

    }
}

function nextCarouselPage() {
    $('.steps-carousel').each(function (e) {
        if ($(this).attr('data-auto-scroll') > 0 && $(this).attr('data-scrolling') == 'true') {
            var tl = Number($(this).attr('data-time-left'));
            tl -= 250;
            if (tl < 0) {
                tl = Number($(this).attr('data-auto-scroll'));
                var pg = Number($(this).attr('data-current-page')) + 1;
                setCarouselPage($(this).attr('data-carousel'), pg);
            }
            $(this).attr('data-time-left', tl);
        }
    });
}


function setLiSizes() {
    $('.steps-carousel').each(function (e) {

        var perPage = 4;
        if ($(this).attr('data-per-page')) {
            perPage = Number($(this).attr('data-per-page'));
        }
        $(this).attr('data-per-page', perPage);
        var pages = $(this).find('.item').length / perPage;

        var liMargin = 3;
        if ($(this).attr('data-li-margin')) {
            liMargin = Number($(this).attr('data-li-margin'));
        }

        //Establish LI widths
        var liWidth = (($(this).innerWidth() / perPage) - ((liMargin * (perPage - 1) / perPage)));
        $(this).attr('data-li-width', liWidth);
        $(this).find('.item').css({ 'width': liWidth + 'px', 'margin-right': liMargin + 'px' });

        //check for defined item-height
        if ($(this).attr("data-item-height") == "auto") {

        } else {
            if ($(this).attr("data-item-height") > 0) {
            } else {
                $(this).attr("data-item-height", "0");
            }

            //Establish li heights
            $(this).find('.item').each(function (e) {
                var maxHeight = Number($(this).parent('.steps-carousel').attr("data-item-height"));
                if ($(this).outerHeight() > maxHeight) {
                    $(this).parent().attr("data-item-height", $(this).outerHeight());
                }
            });

            $(this).find('.item').css({ "height": $(this).attr("data-item-height") + "px", "overflow": "hidden" });

            if (perPage == 1) {
                $(this).css({ "height": $(this).attr("data-item-height") + "px" })
            }
        }

        $(this).addClass('loaded');
    });
}

function thisActive(targetObj) {
    $(targetObj).addClass('active');
    $(targetObj).siblings().removeClass('active');
}

function setStep(step) {

    thisActive(step);
    setTimeout(function () {
        navToCarouselItem('scarousel0', Number(step.attr("data-item-id")));
    }, 500);

}

$(document).ready(function () {

    var activeStep = 0;

    $('.summary-step').attr('role', 'button');
    $('.summary-step').attr('tabindex', '0');
    $('.summary-step').addClass('has-link');

    var url = document.location.toString();
    if (url.match('#')) {
        var stepNumber = url.split('#')[1];
        var steptab = $('.item[data-item-id=' + stepNumber + ']');
        if (steptab.length === 0) {
            steptab = $('#1');
        }
        activeStep = steptab.attr("data-step-number");
        setStep(steptab);
    }
    else {
        setStep($("li[data-step-number='1']"));
    }

    $('.summary-step').on("click", function () {
        setStep($(this));
        if ($(this).attr("data-step-number") != activeStep) {
            activeStep = $(this).attr("data-step-number").trim();
            activeTitle = $(this).find("p").text().trim();
        }
    });
});