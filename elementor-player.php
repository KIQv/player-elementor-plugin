<?php
/*
    Plugin Name: Player Plugin
    Description: Um widget personalizado para exibir episódios/musicas com player de áudio.
    Version: 1
    Author: Kaique Oliveira de Paula
*/

if (!defined('ABSPATH')) {
    exit;
}

function register_player_widget($widgets_manager) {
    require_once(__DIR__ . '/widgets/player-widget.php');
    $widgets_manager->register(new \Elementor_Player_Widget());
}

function enqueue_player_scripts() {
    wp_enqueue_style(
        'player-css',
        plugins_url('assets/css/player.css', __FILE__),
        array(),
        '1.0'
    );

    wp_enqueue_script(
        'wavesurfer-js',
        'https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/6.6.3/wavesurfer.min.js',
        array(),
        '6.6.3',
        true
    );

    wp_enqueue_script(
        'player-js',
        plugins_url('assets/js/player.js', __FILE__),
        array('wavesurfer-js'),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_player_scripts');

add_action('elementor/widgets/register', 'register_player_widget');