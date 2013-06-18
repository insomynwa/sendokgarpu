<?php echo form_open('crud/del'); ?>
	<p>Are you sure?</p>
	<input type="radio" name="confirm" value="yes">YES<br>
	<input type="radio" name="confirm" value="no" checked="checked">No<br>
	<input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
	<input type="submit" value="Proses">
<?php echo form_close(); ?>