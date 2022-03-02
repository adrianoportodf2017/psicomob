//multistep modal
sendEvent = function(step) {
    $('#EditRatingModal').trigger('next.m.' + step);
}

// mobile menu


moveElements();

function moveElements(){
    var desktop = checkWindowWidth(768);
    var signInBox = $('.sign-in-box');
    var userDMenu = $('li.user-dropdown-menu-item');
    var userdBox = $('.dropdown-user-info');

    if ( desktop ) {
        signInBox.detach();
        userDMenu.detach();
        userdBox.detach();

        signInBox.insertAfter('.signin-box-move-desktop-helper');
        $('ul.user-dropdown-menu').append(userDMenu);
        $('ul.user-dropdown-menu').prepend(userdBox);

    } else {
        signInBox.detach();
        userDMenu.detach();
        userdBox.detach();

        signInBox.insertBefore('.mobile-menu-helper-bottom');
        userDMenu.insertBefore('.mobile-menu-helper-bottom');
        userdBox.insertAfter('.mobile-menu-helper-top');
    }
}

function checkWindowWidth(MqL) {
//check window width (scrollbar included)
    var e = window,
        a = 'inner';
    if (!('innerWidth' in window )) {
        a = 'client';
        e = document.documentElement || document.body;
    }
    if ( e[ a+'Width' ] >= MqL ) {
        return true;
    } else {
        return false;
    }
}

function viewMore(element,visibility){
    if(visibility=='hide'){
        $(element).parent('.view-more-parent').addClass('expanded');
        $(element).remove();
    }
    else if($(element).hasClass('view-more')){
        $(element).parent('.view-more-parent').addClass('expanded has-hide');
        $(element).removeClass('view-more').addClass('view-less').html('- View Less');
    }
    else if($(element).hasClass('view-less')){
        $(element).parent('.view-more-parent').removeClass('expanded has-hide');
        $(element).removeClass('view-less').addClass('view-more').html('+ View More');
    }
}


$(window).resize(function(){
    moveElements();
});




var planosidebar = $('.planos-sidebar');
var footer = $('.footer-area');
var planosHeader = $('.planos-header-area');
var margin = 10;

if($('div').hasClass('planos-sidebar')){
    var offsetTop = planosidebar.offset().top + ( 193 - margin);
}




$(window).scroll(function () {

    if(checkWindowWidth(1200)){
        var scrollTop = $(window).scrollTop();
        var offsetBottom = footer.offset().top - ( margin*2 + planosidebar.height());
        if (scrollTop > offsetTop && planosidebar.hasClass('natural')) {
            planosidebar.removeClass('natural').addClass('fixed').css('top', margin);
            planosHeader.clone().addClass('duplicated').insertAfter(".planos-header-area");
        }
        if (offsetTop > scrollTop && planosidebar.hasClass('fixed')) {
            planosidebar.removeClass('fixed').addClass('natural').css('top', 'auto');
            $(".planos-header-area.duplicated").remove();
        }
        if (scrollTop > offsetBottom && planosidebar.hasClass('fixed')) {
            planosidebar.removeClass('fixed').addClass('bottom').css('top', (offsetBottom+margin) - 400);
        }
        if (offsetBottom > scrollTop && planosidebar.hasClass('bottom')) {
            planosidebar.removeClass('bottom').addClass('fixed').css('top', margin);
        }
    }

});



$(document).ready(function(){




    //open search form
	$('.mobile-search-trigger').on('click', function(event){
		event.preventDefault();
		toggleSearch();
	});

    //mobile - open lateral menu clicking on the menu icon
	$('.mobile-nav-trigger').on('click', function(event){
		if(!checkWindowWidth(768)) event.preventDefault();
		$('.mobile-main-nav').addClass('nav-is-visible');
		toggleSearch('close');
		$('.mobile-overlay').addClass('is-visible');
	});

    //submenu items - go back link
    $('.go-back').on('click', function(event){
        event.preventDefault();
        $(this).parent('ul').addClass('is-hidden').parent('.has-children').parent('ul').removeClass('moves-out');
    });
    $('.go-back-menu').on('click', function(event){
        event.preventDefault();
        $(this).parent('ul').addClass('is-hidden').parent('.has-children').parent('ul').removeClass('moves-out').addClass('is-hidden').parent('.has-children').parent('ul').removeClass('moves-out');
    });

    //open submenu
    $('.has-children').children('a').on('click', function(event){
        event.preventDefault();
        var selected = $(this);
        if( selected.next('ul').hasClass('is-hidden') ) {
            //desktop version only
            selected.addClass('selected').next('ul').removeClass('is-hidden').end().parent('.has-children').parent('ul').addClass('moves-out');
            selected.parent('.has-children').siblings('.has-children').children('ul').addClass('is-hidden').end().children('a').removeClass('selected');
            $('.mobile-overlay').addClass('is-visible');
        } else {
            selected.removeClass('selected').next('ul').addClass('is-hidden').end().parent('.has-children').parent('ul').removeClass('moves-out');
            $('.mobile-overlay').removeClass('is-visible');
        }
        toggleSearch('close');
    });

    //close lateral menu on mobile
    $('.mobile-overlay').on('click', function(){
        closeNav();
        $('.mobile-overlay').removeClass('is-visible');
    });


    //prevent default clicking on direct children of .mobile-main-nav
    $('.mobile-main-nav').children('.has-children').children('a').on('click', function(event){
        event.preventDefault();
    });

    function toggleSearch(type) {
        if(type=="close") {
            //close serach
            $('.mobile-search').removeClass('is-visible');
            $('.mobile-search-trigger').removeClass('search-is-visible');
        } else {
            //toggle search visibility
            $('.mobile-search').toggleClass('is-visible');
            $('.mobile-search-trigger').toggleClass('search-is-visible');
        }
    }

    function closeNav() {
        // $('.mobile-nav-trigger').removeClass('nav-is-visible');
        $('.mobile-main-nav').removeClass('nav-is-visible');
        setTimeout(function(){$('.has-children ul').addClass('is-hidden');},600);
        $('.has-children a').removeClass('selected');
        $('.moves-out').removeClass('moves-out');
    }





    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })




    // planos carousel

    $('.planos-carousel').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 6,
        slidesToScroll: 6,
        swipe: false,
        touchMove: false,
        responsive: [
            {
                breakpoint: 1300,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                }
            },
            {
                breakpoint: 1100,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            },
            {
                breakpoint: 840,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 620,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });


    //tinymce editor
    tinymce.init({
        selector: '.author-biography-editor',
        menubar: false,
        statusbar: false,
        branding: false,
        toolbar: 'bold  italic'
    });





    $('.select2').select2({
        width: 'resolve',
        placeholder: "Type a user's name",
    });

    $('a.has-popover').webuiPopover({
        trigger:'hover',
        placement:'horizontal',
        delay: {
            show: 300,
            hide: null
        },
        width: 335
    });

    if($('div').hasClass('planos-preview-video')){
        jwplayer("planos-preview-video").setup({
            "file": "http://www.sample-videos.com/video/mp4/720/big_buck_bunny_720p_1mb.mp4",
            "image": "http://mrfatta.com/wp-content/uploads/2015/05/CarWrap_Sample.jpg",
            "width": "100%",
            aspectratio: "16:9",
            listbar: {
                position: 'right',
                size: 260
            },
        });
    }



});