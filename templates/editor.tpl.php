<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

	<?php if ( ! $product ) : ?>

		<p><?php echo esc_html( __( '¿Sabes?, esta página se ve mucho mejor cuando haces clic en la acción Editar precios que está debajo del nombre de cada producto en la tabla de todos los productos.', 'bulk-variation-price-editor-for-woocommerce' ) ); ?>

	<?php else: ?>

		<h2><?php echo esc_html( sprintf( __( 'A continuación encontrarás los precios para diferentes tallas de &#8220;%s&#8221;', 'bulk-variation-price-editor-for-woocommerce' ), $product->get_name() ) ); ?></h2>

		<p><?php echo esc_html( __( 'Puedes cambiar el precio para todos los colores de una misma talla modificando los valores en los campos que aparecen más abajo.', 'wss-edit-variations-prices-for-woocommerce', 'bulk-variation-price-editor-for-woocommerce' ) ); ?></p>

		<form method="post">

			<div class="bulk-variation-price-editor__row">

			<?php foreach ( $price_fields as $field ) : ?>

				<div class="bulk-variation-price-editor__column">
					<label for="<?php echo esc_attr( $field['id'] ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
					<input id="<?php echo esc_attr( $field['id'] ); ?>" name="<?php echo esc_attr( $field['name'] ); ?>" type="number" value="<?php echo esc_attr( $field['value'] ); ?>" step="0.01" />
				</div>

			<?php endforeach; ?>

			</div>

			<p class="submit">
				<input class="button button-primary" type="submit" value="<?php echo esc_attr( 'Actualizar' ); ?>" />
			</p>

		</form>

	<?php endif; ?>
</div>
