<?php
/**
 * The entry file for the Bulk Variation Price Editor for WooCommerce plugin.
 *
 * @since   1.0.0
 * @author  Willington Vega <wvega@wvega.com>
 *
 * Plugin Name: Bulk Variation Price Editor for WooCommerce
 * Description: Allows variations prices of a given product to be edited in bulk.
 * Version: 1.0.0
 * Requires PHP: 5.6.20
 * Author: Willington Vega <wvega@wvega.com>
 * Author URI: https://wvega.com
 * License: GPL-3.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-3.0-standalone.html
 * Text Domain: bulk-variation-price-editor-for-woocommerce
 * Domain Path: /languages
 */


if ( ! defined( 'BULK_VARIATION_PRICE_EDITOR_DIR' ) ) {
	define( 'BULK_VARIATION_PRICE_EDITOR_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
}


function bvpe_plugins_loaded() {

	add_action( 'admin_menu', 'bvpe_register_admin_page' );

	add_filter( 'post_row_actions', 'bvpe_register_row_actions', 10, 2 );
}
add_action( 'plugins_loaded', 'bvpe_plugins_loaded' );


function bvpe_register_admin_page() {

	add_submenu_page(
		'edit.php?post_type=product',
		__( 'Editor de precios para variaciones de productos', 'bulk-variation-price-editor-for-woocommerce' ),
		__( 'Precios', 'bulk-variation-price-editor-for-woocommerce' ),
		'manage_woocommerce',
		'bulk-variation-price-editor',
		'bvpe_render_admin_page'
	);
}


function bvpe_render_admin_page() {

	ob_start();

	include BULK_VARIATION_PRICE_EDITOR_DIR . '/templates/editor.tpl.php';

	echo ob_get_clean();
}


function bvpe_register_row_actions( $actions, $post ) {

	if ( 'product' === $post->post_type ) {

		$query_args = [
			'page'      => 'bulk-variation-price-editor',
			'post_type' => $post->post_type,
			'post'      => $post->ID,
		];

		$actions['edit-prices'] = sprintf(
			'<a href="%1$s" rel="bookmark" aria-label="%2$s">%3$s</a>',
			esc_url( add_query_arg( $query_args, admin_url( 'edit.php' ) ) ),
			/* translators: %s: post title */
			esc_attr( sprintf( __( 'Editar los precios de las variaciones de &#8220;%s&#8221;' ), get_the_title( $post ) ) ),
			__( 'Editar precios' )
		);
	}

	return $actions;
}
