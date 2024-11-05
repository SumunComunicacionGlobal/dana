<?php 

/**
 * Add slick count to carousel block plugin
 */

add_filter( 'render_block', 'smn_carousel_count', 10, 2 );
function smn_carousel_count( $block_content, $block ) {

    if ( $block['blockName'] != 'cb/carouselOFF' ) return $block_content;

    $carousel_count = '<div class="slick-count">';

    foreach ( $block['innerBlocks'] as $key => $inner_block ) {
        if ($inner_block['blockName'] == 'cb/slide') {
            $numero = str_pad($key+1, 2, '0', STR_PAD_LEFT) . '.';
            $active_class = '';
            if ( 0 == $key ) $active_class = 'slick-active';
            $carousel_count .= '<a href="#" class="slick-count-item h4 ' . $active_class . '" data-slide-index="'. $key .'">' . $numero . '</a>';
        }
    }

    $carousel_count .= '</div>';

    $block_content = '<div class="slick-slider-wrapper">' . $carousel_count . $block_content . '</div>';

    return $block_content;
}

// Añade un wrap con clase "wp-block-details--content" al bloque core/details. Ver estilos en details.scss
function wrap_details_content($block_content, $block) {
    
    if ($block['blockName'] === 'core/details') {
        // Usa DOMDocument para manipular el HTML
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $block_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Encuentra el elemento <details>
        $details = $dom->getElementsByTagName('details')->item(0);

        if ($details) {
            $div = $dom->createElement('div');
            $div->setAttribute('class', 'wp-block-details--content');

            // Mueve todos los hijos de <details> (excepto <summary>) al nuevo div
            while ($details->childNodes->length > 1) {
                $div->appendChild($details->childNodes->item(1));
            }

            // Añade el nuevo div al <details>
            $details->appendChild($div);
        }

        // Guarda el HTML modificado
        $block_content = $dom->saveHTML($details);
    }

    return $block_content;
}
add_filter('render_block', 'wrap_details_content', 10, 2);