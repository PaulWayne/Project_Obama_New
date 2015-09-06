<?php global $col_count; ?>

<h1></h1>

<?php if ( wpsc_has_purchases() ) : ?>

	<table class="table">

	<?php if ( wpsc_has_purchases_this_month() ) : ?>

			<tr class="toprow">
				<th class="status"><?php _e( 'Statut', PIXELART ); ?></th>
				<th class="date"><?php _e( 'Date', PIXELART ); ?></th>
				<th class="price"><?php _e( 'Prix', PIXELART ); ?></th>

				<?php if ( get_option( 'payment_method' ) == 2 ) : ?>

					<th class="payment_method"><?php _e( 'Methode de paiement', PIXELART ); ?></th>

				<?php endif; ?>

			</tr>

			<?php wpsc_user_purchases(); ?>

	<?php else : ?>

			<tr>
				<td colspan="<?php echo $col_count; ?>">

					<?php _e( 'Pas de transaction pour ce mois.', PIXELART ); ?>

				</td>
			</tr>

	<?php endif; ?>

	</table>

<?php else : ?>

	<p class="alert alert-info"><?php _e( 'Aucun achat pour le moment.', PIXELART ); ?></p>

<?php endif; ?>