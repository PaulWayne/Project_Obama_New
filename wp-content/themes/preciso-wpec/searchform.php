<form method="get" id="searchform" action="<?php echo home_url(); ?>">
    <p><input type="text" class="field" name="s" id="s"  value="<?php _e('RECHERCHE', PIXELART); ?>" onfocus="if (this.value == '<?php _e('RECHERCHE', PIXELART); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('RECHERCHE', PIXELART); ?>';}" />
    <input type="submit" class="submit" name="submit" value="search" /></p>
</form>
