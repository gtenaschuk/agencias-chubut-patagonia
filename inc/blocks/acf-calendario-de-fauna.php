<?php
/**
 * Example block.
 *
 * @package WordPress
 * @subpackage Dinkum_Gutenberg_V2
 * @since 1.0.0
 */

$block_id      = $block['id'];
// Check rows existexists.
if( have_rows('calendario_fauna_por_mes') ):
	?>
	<section class="shop shop-cart bg-white <?php echo esc_attr( 'align' . $block['align'] ); ?>" id="shopcart">
        <div class="container">
          <div class="table-wrap">
            <div class="row">
              <div class="col-12">

	<div class="cart-table table-responsive">
	<table class="table">
	  <thead>
		<tr class="cart-product">
		  <th class="cart-product-item">Calendario de Fauna</th>
		  <th class="cart-product-price">Enero</th>
		  <th class="cart-product-price">Febrero</th>
		  <th class="cart-product-price">Marzo</th>
		  <th class="cart-product-price">Abril</th>
		  <th class="cart-product-price">Mayo</th>
		  <th class="cart-product-price">Junio</th>
		  <th class="cart-product-price">Julio</th>
		  <th class="cart-product-price">Agosto</th>
		  <th class="cart-product-price">Septiembre</th>
		  <th class="cart-product-price">Octubre</th>
		  <th class="cart-product-price">Noviembre</th>
		  <th class="cart-product-price">Diciembre</th>
		</tr>
	  </thead>
	  <tbody>

	<?php

    // Loop through rows.
    while( have_rows('calendario_fauna_por_mes') ) : the_row();

        // Load sub field value.
        $icono_id_fauna       = get_sub_field('icono_fauna');
        $post_id_fauna        = get_sub_field('item_de_fauna');
		$post_title_fauna	 = get_the_title( $post_id_fauna );
        $meses_avistage_fauna = get_sub_field('meses_de_avistage_fauna');
        // Do something...
		?>

                      <tr class="cart-product">
                        <td class="cart-product-item">
							<?php if( $icono_id_fauna ) : ?>
                          		<div class="cart-product-img"><img src="<?php echo esc_url( wp_get_attachment_url( $icono_id_fauna ) ); ?>"  style="width: 60px; height: 60px;" alt="<?php echo esc_html( $post_title_fauna ); ?>"></div>
						  	<?php endif; ?>
							<?php if( $post_id_fauna ): ?>
								<div class="cart-product-name">
									<h6><?php echo esc_html( $post_title_fauna ); ?></h6>
									<p><?php echo esc_html( get_field( 'nombre_en_ingles', $post_id_fauna ) ); ?></p>
								</div>
							<?php endif; ?>
                        </td>
                        <td class="cart-product-price"><?php echo wp_kses_post( es_mes_de_avistaje( $meses_avistage_fauna, 'Enero' ) ? '<span class="avistage-si">SI</span>' : '<span class="avistage-no">NO</span>', wp_kses_allowed_html() ); ?></td>
                        <td class="cart-product-price"><?php echo wp_kses_post( es_mes_de_avistaje( $meses_avistage_fauna, 'Febrero' ) ? '<span class="avistage-si">SI</span>' : '<span class="avistage-no">NO</span>', wp_kses_allowed_html() ); ?></td>
                        <td class="cart-product-price"><?php echo wp_kses_post( es_mes_de_avistaje( $meses_avistage_fauna, 'Marzo' ) ? '<span class="avistage-si">SI</span>' : '<span class="avistage-no">NO</span>', wp_kses_allowed_html() ); ?></td>
                        <td class="cart-product-price"><?php echo wp_kses_post( es_mes_de_avistaje( $meses_avistage_fauna, 'Abril' ) ? '<span class="avistage-si">SI</span>' : '<span class="avistage-no">NO</span>', wp_kses_allowed_html() ); ?></td>
                        <td class="cart-product-price"><?php echo wp_kses_post( es_mes_de_avistaje( $meses_avistage_fauna, 'Mayo' ) ? '<span class="avistage-si">SI</span>' : '<span class="avistage-no">NO</span>', wp_kses_allowed_html() ); ?></td>
                        <td class="cart-product-price"><?php echo wp_kses_post( es_mes_de_avistaje( $meses_avistage_fauna, 'Junio' ) ? '<span class="avistage-si">SI</span>' : '<span class="avistage-no">NO</span>', wp_kses_allowed_html() ); ?></td>
                        <td class="cart-product-price"><?php echo wp_kses_post( es_mes_de_avistaje( $meses_avistage_fauna, 'Julio' ) ? '<span class="avistage-si">SI</span>' : '<span class="avistage-no">NO</span>', wp_kses_allowed_html() ); ?></td>
                        <td class="cart-product-price"><?php echo wp_kses_post( es_mes_de_avistaje( $meses_avistage_fauna, 'Agosto' ) ? '<span class="avistage-si">SI</span>' : '<span class="avistage-no">NO</span>', wp_kses_allowed_html() ); ?></td>
                        <td class="cart-product-price"><?php echo wp_kses_post( es_mes_de_avistaje( $meses_avistage_fauna, 'Septiembre' ) ? '<span class="avistage-si">SI</span>' : '<span class="avistage-no">NO</span>', wp_kses_allowed_html() ); ?></td>
                        <td class="cart-product-price"><?php echo wp_kses_post( es_mes_de_avistaje( $meses_avistage_fauna, 'Octubre' ) ? '<span class="avistage-si">SI</span>' : '<span class="avistage-no">NO</span>', wp_kses_allowed_html() ); ?></td>
                        <td class="cart-product-price"><?php echo wp_kses_post( es_mes_de_avistaje( $meses_avistage_fauna, 'Noviembre' ) ? '<span class="avistage-si">SI</span>' : '<span class="avistage-no">NO</span>', wp_kses_allowed_html() ); ?></td>
                        <td class="cart-product-price"><?php echo wp_kses_post( es_mes_de_avistaje( $meses_avistage_fauna, 'Diciembre' ) ? '<span class="avistage-si">SI</span>' : '<span class="avistage-no">NO</span>', wp_kses_allowed_html() ); ?></td>
                      </tr>
	<?php

    // End loop.
    endwhile;
?>
	  </tbody></table></div>
	  </div>
			</div>
		  </div>
		</div>
	</section>
<?php
// No value.
elseif (is_admin()) :
    echo esc_html( 'Calendario de fauna por mes.' );
endif;

