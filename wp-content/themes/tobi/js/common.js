jQuery(document).ready(function () {
    
    

    var $ = jQuery;
    
    // --- add-to-cart (start) ---
    
    $('.products .product .buy-btn, .goods-list .product .buy-btn').click(function() {
        $(this).siblings().width(191);
        $(this).hide();
        $(this).parent().siblings().hide();
    })
    
    // --- add-to-cart (end) ---
    
    // --- Btn-Up ---
    
    $('#bottom-header').hover(function() {
        $('header.site-header').css('height', '100vh');
    }, function() {
        $('header.site-header').css('height', 'auto');
    });

    function hideBtn() {
        var block = $('#button-up');
        if ($(window).scrollTop() > 200) {
            block.css({
                'display' : '-webkit-flex',
                'display' : '-moz-flex',
                'display' : '-ms-flex',
                'display' : '-o-flex',
                'display' : 'flex'
            });
        } else {
            block.hide();
        }
    }
    $(window).scroll(hideBtn);

    $('#button-up').click(function (event) {
        event.preventDefault();
        var id = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({
            scrollTop: top
        }, 1500);
    });

    $('.main-img').click(function () {
        var imgSrc = $(this).find('img').attr('src');
        $('#overlay-img').fadeIn();
        $('#img-slider-big').slideDown();
        $('#img-slider-big').addClass('display-flex');
        $('#img-slider-big').children('img').attr('src', imgSrc);
        $('#overlay-img').click(function () {
            $('#overlay-img').fadeOut();
            $('#img-slider-big').slideUp(0);
            $('#img-slider-big').removeClass('display-flex');
        });
    });

    $('.slider-img-list img').click(function () {
        $('.slider-img-list img').each(function () {
            $(this).removeClass('img-clicked');
        })
        $(this).addClass('img-clicked');
        $('.main-img > img').attr('src', $(this).attr('src'));
    })

    $('.menu li, .catalog-menu li').each(function (index, el) {
        if ($(this).hasClass('menu-item-has-children')) {
            $(this).children('a').append('<span class="arrow"></span>');
        }
    });

    // --- Адаптивная навигация и меню ---

    var btnClicked,
        btnClose;

    function slideDownMenu(btnClicked) {
        btnClicked.removeClass('nav-btn-clicked');
        btnClicked.siblings('ul').slideUp(400);
        btnClicked.find('.arrow').removeClass('arrow-transform');
    }

    function slideUpMenu(btnClose) {
        btnClose.addClass('nav-btn-clicked');
        btnClose.siblings('ul').slideDown(400);
        btnClose.children('.arrow').addClass('arrow-transform');
    }

    function closeAll() {
        $('.main-navigation').slideUp(400);
    }

    $('.c-hamburger').click(function () {
        $('#content').css('overflow', 'hidden');
        if ($(this).hasClass('is-active')) {
            closeAll();
            $(this).removeClass('is-active');
        } else {
            $('.main-navigation').slideDown(400);
            $(this).addClass('is-active');
        }
    });

    if ($(window).width() < 992) {
        $('nav a > span.arrow').click(function (event) {

            var menuBtn = $(this).parent(),
                isHaveSubmenu = $(this).parent().siblings().is('ul');

            if (isHaveSubmenu) {
                event.preventDefault();
                if (menuBtn.hasClass('nav-btn-clicked')) {
                    slideDownMenu(menuBtn);
                } else {
                    slideUpMenu(menuBtn);
                }
            } else {
                closeAll();
            }
        });
    }

    // --- Меню каталога ---

    $('.catalog-menu a > span').click(function (event) {

        var btnClickHide,
            btnClickShow;

        function hideSubmenu(btnClickHide) {
            btnClickHide.parent().removeClass('nav-btn-clicked');
            btnClickHide.siblings('ul').slideUp(400);
        }

        function showSubmenu(btnClickShow) {
            btnClickShow.parent().addClass('nav-btn-clicked');
            btnClickShow.siblings('ul').slideDown(400);
        }

        function hideMenu() {
            $('.catalog-menu > .sub-menu').slideUp(400);
        }

        var menuBtn = $(this).parent(),
            isHaveSubmenu = menuBtn.siblings().is('ul');

        if (isHaveSubmenu) {
            event.preventDefault();
            if (menuBtn.parent().hasClass('nav-btn-clicked')) {
                hideSubmenu(menuBtn);
            } else {
                showSubmenu(menuBtn);
            }
        } else {
            $('.catalog-menu li').each(function () {
                $(this).removeClass('chosen-category');
            });
            menuBtn.parent().addClass('chosen-category');
            hideMenu();
        }
    });

    $('.call-back, #content > div.main-baner > ul > li:nth-child(1) > a').click(function (event) {
        event.preventDefault();
        $('.contact-showmore-hidden').hide(400);
        $('.overlay').show(400);
        $('#callback-modal').show(400);
        $('#callback-modal .close, .overlay').click(function () {
            $('.overlay').hide(400);
            $('#callback-modal').hide(400);
        });
    });

    $('.category-information').each(function () {
        if (!(parseInt($(this).height()) > 0)) {
            $(this).css('display', 'none');
        }
    });

    $('.good-information').each(function () {
        if (!(parseInt($(this).height()) > 0)) {
            $(this).css('display', 'none');
            $(this).siblings('.description__title').css('display', 'none');
        }
    });

    //всплывающее меню каталога

    // закругленные углы при наведении

    // минимальная ширина выпадающего списка

    // выпадающая форма поиска

    $('.header-search-btn').on('click', function () {
        $('.search-textarea').removeClass('hidden');
        $('.overlay').css('display', 'block');
    });

    $('.srch-btn , .overlay').on('click', function () {
        $('.search-textarea').addClass('hidden');
        $('.overlay').css('display', 'none');
    });

    $('.header-search-btn').on('click', function () {
        $('.overlay').css('display', 'block');
        $('#top-search-wrap').css({
            'top': '0px',
            'filter': 'alpha(opacity=100)',
            'visibility': 'visible'
        });

        $('#top-search-close, .overlay').on('click', function () {
            $('#top-search-wrap').css({
                'top': '-80px',
                'filter': 'alpha(opacity=0)',
                'visibility': 'hidden'
            });
            $('.overlay').css('display', 'none');
        })
    });

    // --- отступы фотографий в блоке "О нас" ---


    // --- Кнопка "Связаться с нами и телефоны переключатель языка --- 

    var clickCheck = false;

    $('.contact-showmore-btn').on('click', function () {
        if (clickCheck == false) {
            $('.overlay').slideDown();
            $('.contact-showmore-btn span').css('color', '#FFCF4C');
            $('.contact-showmore-btn .arrow').removeClass('arrow-white').addClass('arrow-yellow');
            $('.contact-showmore-hidden').slideDown();
            clickCheck = true;
        } else {
            $('.overlay').slideUp();
            $('.contact-showmore-btn span').css('color', '#fefefe');
            $('.contact-showmore-btn .arrow').removeClass('arrow-yellow').addClass('arrow-white');
            $('.contact-showmore-hidden').slideUp();
            clickCheck = false;
        }
    });

    $('.overlay').click(function () {
        $('.overlay').slideUp();
        $('.contact-showmore-btn span').css('color', '#fefefe');
        $('.contact-showmore-btn .arrow').removeClass('arrow-yellow').addClass('arrow-white');
        $('.contact-showmore-hidden').slideUp();
        clickCheck = false;
        $('.lang-trigger').css('color', '#fefefe');
        $('.lang-trigger .arrow').removeClass('arrow-yellow').addClass('arrow-white');
        $('.lang-list').slideUp();
        clickLangTrg = false;
    });
    
    // --- Blog blocks (start) ---
    
    
    
    var postList = $('.mini-blog-block'),
        lastPost = postList.children().last(),
        postBlock = $('.mini-blog-block > li'),
        postsQuantity = $('.mini-blog-block > li').length;
    
    if ((postsQuantity % 2) == 1) {
        lastPost.css('width', 'calc(90% + 30px)');
    }
    
    // --- Blog blocks (end) ---

    // --- Слайдеры ---

    var windowWidth = $('.slick-slider-sales').width();

    function showAllSlides() {
        $('.slick-slider-sales').slick({
            slidesToShow: 4
        });
    }

    function showThreeSlides() {
        $('.slick-slider-sales').slick({
            slidesToShow: 3
        });
    }

    function showTwoSlides() {
        $('.slick-slider-sales').slick({
            slidesToShow: 2
        });
    }

    function showOneSlide() {
        $('.slick-slider-sales').slick({
            slidesToShow: 1
        });
    }

    if (windowWidth == 1152) {
        showAllSlides();
    } else if (windowWidth == 864) {
        showThreeSlides();
    } else if (windowWidth == 576) {
        showTwoSlides();
    } else if (windowWidth == 288) {
        showOneSlide();
    }

    $(window).on('resize', function () {

        function showAllSlides() {
            $('.slick-slider-sales').slick({
                slidesToShow: 4
            });
        }

        function showThreeSlides() {
            $('.slick-slider-sales').slick({
                slidesToShow: 3
            });
        }

        function showTwoSlides() {
            $('.slick-slider-sales').slick({
                slidesToShow: 2
            });
        }

        function showOneSlide() {
            $('.slick-slider-sales').slick({
                slidesToShow: 1
            });
        }

        var widthWindow = $(window).width();

        if (widthWindow >= 1215) {
            showAllSlides();
        } else if (1215 > widthWindow >= 880) {
            showThreeSlides();
        } else if (880 > widthWindow >= 590) {
            showTwoSlides();
        } else if (590 > widthWindow) {
            showOneSlide();
        }

    });

    $('.baner').slick({
        dots: true,
        arrows: true,
        // адаптация
        infinite: true,
        speed: 400,
        fade: true,
        cssEase: 'linear',
        // определяем скорость перелистывания
        slidesToShow: 1,
        // количество слайдов для показа
        centerMode: true,
        // текущий слайд по центру
        // установим переменную ширину
    });
});