
<form method="post">

	<?php echo validate_form_data(); ?>

	<table class="table account-edit-table">

		<?php wpsc_display_form_fields(); ?>

		<tr>
			<td></td>
			<td>
				<input type="hidden" value="true" name="submitwpcheckout_profile" />
				<input type="submit" value="<?php _e( 'Enregistrer votre profil', 'wpsc' ); ?>" name="submit" />
			</td>
		</tr>
	</table>

</form>