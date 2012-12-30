<form action="#" class="form-horizontal well">
	<fieldset>
		<legend>Add User</legend>
	
		<div class="control-group">
			<label for="name" class="control-label">Name</label>
			<div class="controls">
				<input type="text" name="name" max-length="70" required>
			</div>
		</div>
	
		<div class="control-group">
			<label for="email" class="control-label">Email</label>
			<div class="controls">
				<input type="text" name="slug" max-length="254" required>
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
			<button type="submit" class="btn btn-primary">save</button>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
</form>