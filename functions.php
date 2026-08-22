<?php
/**
 * CONFIGURATEUR LIFT - Enregistrement du shortcode
 */

// 1. Enregistrer le shortcode [lift_configurator]
function lift_configurator_shortcode($atts) {
    $atts = shortcode_atts(array(
        'model' => 'lift-x'
    ), $atts);

    $cfg_dir = get_stylesheet_directory() . '/configurator/';
    wp_enqueue_style('lift-configurator-css', get_stylesheet_directory_uri() . '/configurator/configurator.css', array(), filemtime($cfg_dir . 'configurator.css'));

    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), '3.12.2', true);
    wp_enqueue_script('gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', array('gsap'), '3.12.2', true);

    wp_enqueue_script('lift-config-js', get_stylesheet_directory_uri() . '/configurator/config.js', array(), filemtime($cfg_dir . 'config.js'), true);
    wp_enqueue_script('lift-configurator-js', get_stylesheet_directory_uri() . '/configurator/configurator.js', array('jquery', 'gsap', 'gsap-scrolltrigger', 'lift-config-js'), filemtime($cfg_dir . 'configurator.js'), true);

    wp_localize_script('lift-configurator-js', 'liftConfig', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('lift_quote_nonce'),
        'model'   => $atts['model']
    ));

    ob_start();
    include get_stylesheet_directory() . '/configurator/template.php';
    return ob_get_clean();
}
add_shortcode('lift_configurator', 'lift_configurator_shortcode');
// Alias [lift5_configurateur] — meme comportement que [lift_configurator]
add_shortcode('lift5_configurateur', 'lift_configurator_shortcode');

// 2. Shortcode [liftx_configurateur] - configurateur LIFTX
function liftx_configurateur_shortcode($atts) {
    $cfg_dir = get_stylesheet_directory() . '/configurator/';
    wp_enqueue_style('lift-configurator-css', get_stylesheet_directory_uri() . '/configurator/configurator.css', array(), filemtime($cfg_dir . 'configurator.css'));

    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), '3.12.2', true);
    wp_enqueue_script('gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', array('gsap'), '3.12.2', true);

    wp_enqueue_script('lift-config-js', get_stylesheet_directory_uri() . '/configurator/config.js', array(), filemtime($cfg_dir . 'config.js'), true);
    wp_enqueue_script('lift-configurator-js', get_stylesheet_directory_uri() . '/configurator/configurator.js', array('jquery', 'gsap', 'gsap-scrolltrigger', 'lift-config-js'), filemtime($cfg_dir . 'configurator.js'), true);

    wp_localize_script('lift-configurator-js', 'liftConfig', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('lift_quote_nonce'),
        'model'   => 'lift-x'
    ));

    ob_start();
    include get_stylesheet_directory() . '/configurator/template-liftx.php';
    return ob_get_clean();
}
add_shortcode('liftx_configurateur', 'liftx_configurateur_shortcode');

// 3. Shortcode [lift5f_configurateur] - configurateur LIFT5 F
function lift5f_configurateur_shortcode($atts) {
    $cfg_dir = get_stylesheet_directory() . '/configurator/';
    wp_enqueue_style('lift-configurator-css', get_stylesheet_directory_uri() . '/configurator/configurator.css', array(), filemtime($cfg_dir . 'configurator.css'));

    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), '3.12.2', true);
    wp_enqueue_script('gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', array('gsap'), '3.12.2', true);

    wp_enqueue_script('lift-config-js', get_stylesheet_directory_uri() . '/configurator/config.js', array(), filemtime($cfg_dir . 'config.js'), true);
    wp_enqueue_script('lift-configurator-js', get_stylesheet_directory_uri() . '/configurator/configurator.js', array('jquery', 'gsap', 'gsap-scrolltrigger', 'lift-config-js'), filemtime($cfg_dir . 'configurator.js'), true);

    wp_localize_script('lift-configurator-js', 'liftConfig', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('lift_quote_nonce'),
        'model'   => 'lift-5-f'
    ));

    ob_start();
    include get_stylesheet_directory() . '/configurator/template-lift5f.php';
    return ob_get_clean();
}
add_shortcode('lift5f_configurateur', 'lift5f_configurateur_shortcode');

// 4. Inclure le handler AJAX
require_once get_stylesheet_directory() . '/configurator/ajax-handler.php';
