<?php

function get_manifest_file($filename)
{
    $manifestPath = __DIR__ . './dist/manifest.json';

    // Check the file exists before we try to load it.
    if (!file_exists($manifestPath)) {
        return new \WP_Error('manifest', 'The Manifest file can not be found. you might need to run a build command first', $manifestPath);
    }

    $manifest = json_decode(file_get_contents($manifestPath), true);

    // Attempt to match the requested file.
    if (!array_key_exists($filename, $manifest)) {
        return new \WP_Error('manifest', 'The requested file could not be matched.', $filename);
    }

    $filepath = get_template_directory_uri() . '/dist/' . $manifest[$filename];

    return $filepath;
}

function ptboilerplate_init()
{
    // Post thumbnails.
    add_theme_support('post-thumbnails');

    //Editor styles.
    add_theme_support('editor-styles');
    add_editor_style('editor-styles.css');

    // Title tag.
    add_theme_support('title-tag');

    // HTML5 semantic markup.
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

    // Alignwide and alignfull classes in the block editor.
    add_theme_support('align-wide');

}



function ptboilerplate_enqueue_scripts()
{
    wp_enqueue_style('main', get_manifest_file('main.css'), array());
    wp_enqueue_script('index', get_manifest_file('index.js'), array('jquery'), true);
}
add_action('wp_enqueue_scripts', 'ptboilerplate_enqueue_scripts');

function ptboilerplate_enqueue_admin_scripts()
{
    wp_enqueue_script('admin', get_manifest_file('admin.js'), array('jquery'), true);
}

function ptboilerplate_enqueue_editor_styles()
{
    wp_enqueue_style('editor-styles', get_manifest_file('editor-styles.css'), array());
}
add_action('enqueue_block_editor_assets', 'ptboilerplate_enqueue_editor_styles');

function ptboilerplate_setup()
{
    register_nav_menu('primary', __('Primary Menu', 'ptboilerplate'));
}

add_action('after_setup_theme', 'ptboilerplate_setup');
