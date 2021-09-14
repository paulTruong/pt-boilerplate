<?php

/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <header class="l-header">

            <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'ptboilerplate'); ?></a>

            <?php
            /**
             * Displays header site branding
             *
             * @package WordPress
             * @subpackage Twenty_Twenty_One
             * @since Twenty Twenty-One 1.0
             */

            $site_title   = get_bloginfo('name');
            $description  = get_bloginfo('description', 'display');
            $show_title   = (true === get_theme_mod('display_title_and_tagline', true));
            $header_class = $show_title ? 'c-site-title' : 'screen-reader-text';

            ?>

            <?php if (has_custom_logo() && $show_title) : ?>
                <div class="site-logo"><?php the_custom_logo(); ?></div>
            <?php endif; ?>
            <?php if (has_custom_logo() && !$show_title) : ?>
                <div class="site-logo"><?php the_custom_logo(); ?></div>
            <?php endif; ?>

            <?php if ($site_title) : ?>
                <?php if (is_front_page() && !is_paged()) : ?>
                    <h1 class="<?php echo esc_attr($header_class); ?>"><?php echo esc_html($site_title); ?></h1>
                <?php elseif (is_front_page() && !is_home()) : ?>
                    <h1 class="<?php echo esc_attr($header_class); ?>"><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($site_title); ?></a></h1>
                <?php else : ?>
                    <p class="<?php echo esc_attr($header_class); ?>"><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($site_title); ?></a></p>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (has_nav_menu('primary')) : ?>
                <nav id="site-navigation" class="l-navigation" role="navigation" aria-label="<?php esc_attr_e('Primary menu', 'ptboilerplate'); ?>">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'primary',
                            'menu_class'      => 'c-mainmenu',
                            'container' => '',
                            'fallback_cb'     => false,
                        )
                    );
                    ?>
                </nav>
            <?php endif; ?>
        </header>
    </div>


    <main id="main" class="site-main" role="main">
