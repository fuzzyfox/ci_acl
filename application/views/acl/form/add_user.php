<?= form_open('acl/user/add', array('class' => 'form-horizontal well')); ?>
	<fieldset>
		<legend>Add User</legend>
		
		<? if(validation_errors()): ?>
		<div class="alert alert-error">
			<?= validation_errors(); ?>
		</div>
		<? endif; ?>
		
		<div class="control-group">
			<label for="name" class="control-label">Name</label>
			<div class="controls">
				<input type="text" name="name" max-length="70" value="<?= set_value('name'); ?>" required>
			</div>
		</div>
	
		<div class="control-group">
			<label for="email" class="control-label">Email</label>
			<div class="controls">
				<input type="text" name="email" max-length="254" value="<?= set_value('email'); ?>" required>
			</div>
		</div>
		
		<div class="control-group">
			<label for="password" class="control-label">Password</label>
			<div class="controls">
				<input type="password" name="password" min-length="8" required>
				<span class="help-block">Must be at least <strong>8</strong> characters long</span>
			</div>
		</div>
		
		<div class="control-group">
			<label for="confirm-password" class="control-label">Confirm Password</label>
			<div class="controls">
				<input type="password" name="confirm-password" min-length="8" required>
			</div>
		</div>
	
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save</button>
			<?= anchor('acl/user', 'Cancel', array('class' => 'btn')); ?>
		</div>
	</fieldset>
</form>