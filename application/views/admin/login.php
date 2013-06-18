<?php echo form_open('login/validation') ?>
	<label>username:</label>
	<input type="text" name="username" /><br>
	<label>password:</label>
	<input type="password" name="password" /><br>
	<label>email:</label>
	<input type="text" name="email" /><br>
	<input type="submit" value="Login" />

<?php echo form_close(); ?>