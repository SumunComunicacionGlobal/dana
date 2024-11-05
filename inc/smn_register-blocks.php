<?php
/**
 * Register Blocks
 *
 * @link https://www.advancedcustomfields.com/resources/acf_register_block_type/
 *
 * @return void
 */


function smn_register_blocks() {
    register_block_type( get_stylesheet_directory() . '/custom-blocks/popover-block' );
    
    register_block_type( get_stylesheet_directory() . '/custom-blocks/carousel', [
        'render_callback' => ['Carousel_Slider_Block', 'render_carousel']
    ]);
    register_block_type( get_stylesheet_directory() . '/custom-blocks/slide' );
}

add_action( 'init', 'smn_register_blocks' );


