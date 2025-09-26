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
if (have_rows('pv_calendario_de_mareas')) :
?>
	<section class="shop shop-cart bg-white <?php echo esc_attr('align' . $block['align']); ?>" id="shopcart">
		<div class="container">
			<div class="table-wrap">
				<div class="row">
					<div class="col-12">
						<div class="cart-table table-responsive">
							<table class="table">
								<tbody>
									<tr class="cart-product">
									<?php
									// Loop through rows.
									$i = 0;
									while (have_rows('pv_calendario_de_mareas')) : the_row();
										// Load sub field value.
										$label   = get_sub_field('label');
										$archivo = get_sub_field('archivo');
										// Do something...
									?>
										<?php echo ( 0 === $i % 4 ) ? '</tr><tr class="cart-product">' : ''; ?>
											<td>
												<?php if ($label) : ?>
													<div class="cart-product-img">
														<?php if ( $archivo ) : ?>
														<a href="<?php echo esc_url($archivo); ?>" target="_blank" title="<?php echo esc_html($label); ?>"><?php echo esc_html($label); ?></a>
														<?php else: ?>
															<?php echo esc_html($label); ?>
														<?php endif; ?>
													</div>
												<?php endif; ?>
											</td>
									<?php
									// End loop.
									$i++;
									endwhile;
									?>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php
// No value.
elseif (is_admin()) :
	echo esc_html('Calendario de mareas.');
endif;
