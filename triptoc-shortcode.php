<?php
function triptoc1_shortcode () {
		
		return '<div class="triptoc">
					<ul><h4>Table of Contents For This Trip:</h4>
						<li>1. My Great Adventure 1</li>
						<li>2. My Great Adventure 2</li>
						<li>3. My Great Adventure 3</li>
					</ul>
				</div>';

}

add_shortcode( 'triptoc1', 'triptoc1_shortcode' );

// ////////////////////////////////////////////////////////TRIPTOC 2 TEST

function triptoc2_shortcode() {

	if (post_meta) {
		# code...
	}
	return '<h2>Hello, my name is Anigo Montoya</h2>';

}

add_shortcode( 'triptoc2', 'triptoc2_shortcode' );

// ////////////////////////////////////////////////////////TRIPTOC 3 TEST

function triptoc3_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'cat' => '',
    ), $atts );

    if ( empty( $atts['cat'] ) ) {
        // If category provided, exit early
        return;
    }

    $args = array(
        'category' => $atts['cat'],
        // Disable pagination
        'posts_per_page' => -1
    );

    $posts_list = get_posts( $args );

    if ( empty( $posts_list) ) {
        // If no posts, exit early
        return;
    }

    $opening_tag = '<ul>';
    $closing_tag = '</ul>';
    $post_content = '';

    foreach ( $posts_list as $post_cat ) {
        $post_content .= '<li><a href="' . esc_url( get_permalink( $post_cat->ID ) )  . '">' . esc_html( get_the_title( $post_cat->ID ) ) . '</a></li>';
    }

    return $opening_tag . $post_content . $closing_tag;
}

add_shortcode( 'triptoc3', 'triptoc3_shortcode' );

