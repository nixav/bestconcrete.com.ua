<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Tobi
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="shortcut icon" href="<?php echo TEMPLATE_DIRECTORY_URI; ?>/img/favicon/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo TEMPLATE_DIRECTORY_URI; ?>/img/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php TEMPLATE_DIRECTORY_URI; ?>/img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php TEMPLATE_DIRECTORY_URI; ?>/img/favicon/apple-touch-icon-114x114.png">
    <?php wp_head(); ?>
    <style>

        html {
        margin-top: 0 !important;
    }

    </style>
</head>

<script>
    var $ = jQuery;
    
    $(window).on('load', function () {
        $preloader = $('.loader'),
        $loader = $preloader.find('.l_main');
        $loader.fadeOut();
        $preloader.delay(350).fadeOut('slow');
    });
</script>

<body <?php body_class(); ?>>

    <div class="loader">
        <div class="l_main">
            <div class="l_square"><span></span><span></span><span></span></div>
            <div class="l_square"><span></span><span></span><span></span></div>
            <div class="l_square"><span></span><span></span><span></span></div>
            <div class="l_square"><span></span><span></span><span></span></div>
        </div>
    </div>

    <a href="html" id="button-up"><span>Вверх</span></a>

    <div id="img-slider-big">
        <div id="overlay-img"></div>
        <img src="img/slider1.png" alt="">
    </div>

    <div class="overlay"></div>

    <div id="img-slider-big">
        <div id="overlay-img"></div>
        <img src="img/slider1.png" alt="">
    </div>

    <div class="overlay"></div>
    
    <div id="top-search-wrap">
        <div class="container">
            <form class="form-inline" action="<?php echo wc_get_page_permalink( 'shop' ); ?>">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-search"></i>
                        </div>
                        <input name="s" type="text" placeholder="Что ищем?">
                        <button class="search-activate"></button>
                    </div>
                </div>
                <i id="top-search-close">×</i>
            </form>
        </div>
    </div>

    <div id="callback-modal">
        <h2>Форма обратной связи</h2>
        <button class="close"></button>
        <!---------- Тут я поменял в строчке id="750" на id="1564" ---------->
        <?php echo do_shortcode( '[contact-form-7 id="750" title="Обратная связь"]' ); ?>
    </div>

    <ul class="contact-showmore-hidden">
        <li><a href="tel:+380950068963">+38 (095) 006 - 89 - 63</a></li>
        <li><a href="tel:+380988533387">+38 (098) 853 - 33 - 87</a></li>
        <li class="or">или</li>
        <li>
            <div class="call-back">
                <span class="call-icon"></span>
                <span>Обратный звонок</span>
            </div>
        </li>
    </ul>

    <div id="page" class="site">
        <header id="masthead" class="site-header">
            <div id="top-header">
                <div class="header-wrapper">
                    <p class="contact-showmore-btn"><span>Связь с нами</span><span class="arrow-white arrow"></span></p>
                    <h4 class="header-title"><strong>
                            <?php bloginfo( 'name' ); ?> - </strong>
                        <?php bloginfo( 'description' ); ?>
                    </h4>
                    <a href="tel:+380950068963">+38 (095) 006 - 89 - 63</a>
                    <a href="tel:+380988533387">+38 (098) 853 - 33 - 87</a>
                    <div class="call-back">
                        <span class="call-icon"></span>
                        <span>Обратный звонок</span>
                    </div>

                    <?php echo do_shortcode( '[language-switcher]' ); ?>


                </div>
            </div>


            <div id="bottom-header">
                <div class="header-wrapper">
                    <div class="adaptive-menu-btn">
                        <button class="c-hamburger c-hamburger--htx">
                            <span>toggle menu</span>
                            <span class="adaptive-menu-title">Меню</span>
                        </button>
                        <span class="adaptive-menu-title">Меню</span>
                    </div>
                    <a class="logo" href="<?php echo bloginfo( 'url' ); ?>">
                        <img src="<?php echo TEMPLATE_DIRECTORY_URI; ?>/img/bestconcrete-logo.png" alt="">
                    </a>
                    <nav id="site-navigation" class="main-navigation">
                        <!--					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'tobi' ); ?></button>-->
                        <?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						
					) );
					?>
                    </nav><!-- #site-navigation -->
                    <div class="right-menu">
                        <div class="header-search-btn"><span></span></div>
                        <div class="busket"><span></span></div>
                    </div>
                </div>
            </div>



        </header><!-- #masthead -->

        <div id="content" class="site-content">