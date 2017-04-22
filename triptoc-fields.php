<?php

function triptoc_add_custom_metabox() {

	add_meta_box(
		'triptoc_meta',
		'Trip Table of Contents',
		'triptoc_meta_callback',
		'post',
		'side'
		);

}

add_action( 'add_meta_boxes', 'triptoc_add_custom_metabox');

function triptoc_meta_callback( $post ) {
	wp_nonce_field( basename( _FILE_ ), 'triptoc_toc_nonce' );
	$triptoc_stored_meta = get_post_meta( $post->ID );
	?>
	<div class="meta-row">
		 <div class="meta-th">
	     	<label for="series-include" class="triptoc-row-title"><?php _e( 'Include in a series?', 'series-include' ) ?></label>
	     </div>
	     <div class="meta-td">
	       	<select name="series_include" id="series-include">
	        	<option value="No" <?php if ( ! empty ( $triptoc_stored_meta['series_include'] ) ) selected( $triptoc_stored_meta['series_include'][0], 'No' ); ?>><?php _e( 'No', 'series-include' )?></option>';
	        	<option value="Yes" <?php if ( ! empty ( $triptoc_stored_meta['series_include'] ) ) selected( $triptoc_stored_meta['series_include'][0], 'Yes' ); ?>><?php _e( 'Yes', 'series-include' )?></option>';
          	</select>
    	</div>
	</div> 
	<div>
		<label for="series-id">Series Tag:</label>
	</div>
	<div>
		<input type="text" name="series_id" id="series-id" value="<?php if ( ! empty ( $triptoc_stored_meta['series_id'] ) ) echo esc_attr( $triptoc_stored_meta['series_id'][0]); ?>"/>
	</div>
	<hr/>
	<div class="meta-row">
		 <div class="meta-th">
	     	<label for="toc-top-include" class="triptoc-row-title"><?php _e( 'Add to top of post?', 'toc-top-include' ) ?></label>
	     </div>
	     <div class="meta-td">
	       	<select name="toc_top_include" id="toc-top-include">
	        	<option value="Yes" <?php if ( ! empty ( $triptoc_stored_meta['toc_top_include'] ) ) selected( $triptoc_stored_meta['toc_top_include'][0], 'Yes' ); ?>><?php _e( 'Yes', 'toc-top-include' )?></option>';
	        	<option value="No" <?php if ( ! empty ( $triptoc_stored_meta['toc_top_include'] ) ) selected( $triptoc_stored_meta['toc_top_include'][0], 'No' ); ?>><?php _e( 'No', 'toc-top-include' )?></option>';	          	
	        </select>
	    </div>
	</div> 
	<div class="meta-row">
		 <div class="meta-th">
	     	<label for="toc-bottom-include" class="triptoc-row-title"><?php _e( 'Add to bottom of post?', 'toc-bottom-include' ) ?></label>
	     </div>
	     <div class="meta-td">
	       	<select name="toc_bottom_include" id="toc-bottom-include">
	        	<option value="No" <?php if ( ! empty ( $triptoc_stored_meta['toc_bottom_include'] ) ) selected( $triptoc_stored_meta['toc_bottom_include'][0], 'No' ); ?>><?php _e( 'No', 'toc-bottom-include' )?></option>';
	        	<option value="Yes" <?php if ( ! empty ( $triptoc_stored_meta['toc_bottom_include'] ) ) selected( $triptoc_stored_meta['toc_bottom_include'][0], 'Yes' ); ?>><?php _e( 'Yes', 'toc-bottom-include' )?></option>';	          	</select>
	    </div>
	</div> 
	<div class="meta-row">
		 <div class="meta-th">
	     	<label for="toc-nav-include" class="triptoc-row-title"><?php _e( 'Add previous & next buttons?', 'toc-nav-include' ) ?></label>
	     </div>
	     <div class="meta-td">
	       	<select name="toc_nav_include" id="toc-nav-include">
	        	<option value="Yes" <?php if ( ! empty ( $triptoc_stored_meta['toc_nav_include'] ) ) selected( $triptoc_stored_meta['toc_nav_include'][0], 'Yes' ); ?>><?php _e( 'Yes', 'toc-nav-include' )?></option>';
	        	<option value="No" <?php if ( ! empty ( $triptoc_stored_meta['toc_nav_include'] ) ) selected( $triptoc_stored_meta['toc_nav_include'][0], 'No' ); ?>><?php _e( 'No', 'toc-nav-include' )?></option>';	          	</select>
	    </div>
	</div> 
	<hr/>
	<div>
		<!-- generated triptoc shortcode will go here -->
		<p>Shortcode:<br/>[triptoc seriesTAG="777"]</p>
	</div>
	<?php
}

function triptoc_meta_save( $post_id ) {
	// Checks save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'triptoc_toc_nonce'] ) && wp_verify_nonce($POST[ 'triptoc_toc_nonce' ], basename( _FILE_) ) ) ? 'true' : 'false';

	// Exits script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}

	if ( isset( $_POST[ 'series_include' ] ) ) {
		update_post_meta( $post_id, 'series_include', sanitize_text_field( $_POST[ 'series_include' ] ) );
	}

	if ( isset( $_POST[ 'series_id' ] ) ) {
		update_post_meta( $post_id, 'series_id', sanitize_text_field( $_POST[ 'series_id' ] ) );
	}

	if ( isset( $_POST[ 'toc_top_include' ] ) ) {
		update_post_meta( $post_id, 'toc_top_include', sanitize_text_field( $_POST[ 'toc_top_include' ] ) );
	}

	if ( isset( $_POST[ 'toc_bottom_include' ] ) ) {
		update_post_meta( $post_id, 'toc_bottom_include', sanitize_text_field( $_POST[ 'toc_bottom_include' ] ) );
	}

	if ( isset( $_POST[ 'toc_nav_include' ] ) ) {
		update_post_meta( $post_id, 'toc_nav_include', sanitize_text_field( $_POST[ 'toc_nav_include' ] ) );
	}
}
add_action( 'save_post' , 'triptoc_meta_save');