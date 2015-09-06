<?php if ( empty( $items ) ) : ?>
    <p class="alert alert-info"><?php _e( 'You have not purchased any downloadable products yet.', PIXELART ); ?></p>
<?php else : ?>
	<table class="logdisplay table">
		<thead>
			<tr>
				<th class="wpsc-user-log-file-name" scope="col"><?php _e( 'File Names', PIXELART ); ?> </th>
				<th class="wpsc-user-log-downloads-left" scope="col"><?php _e( 'Downloads Left', PIXELART ); ?> </th>
				<th class="wpsc-user-log-file-date" scope="col"><?php _e( 'Date', PIXELART ); ?> </th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $items as $key => $item ): ?>
				<tr class="wpsc-user-log-file<?php echo ( $key %2 == 1 ) ? '' : ' alt'; ?>">
					<td class="wpsc-user-log-file-name">
						<?php echo $item->title; ?>
					</td>
					<td class="wpsc-user-log-downloads-left">
						<?php echo esc_html( $item->downloads ); ?>
					</td>
					<td class="wpsc-user-log-file-date">
						<?php echo esc_html( $item->datetime ); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>