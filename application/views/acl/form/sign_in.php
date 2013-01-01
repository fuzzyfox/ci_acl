<?= form_open('acl/user/sign_in', array('form-horizontal well')); ?>
	<fieldset>
		<legend>Login</legend>
		
		<div class="control-group">
			<label class="control-label" for="email">Email</label>
			<div class="controls">
				<input type="text" name="email" class="input-xlarge" required>
			</div>
		</div>
     	
		<div class="control-group">
			<label class="control-label" for="password">Password</label>
				<div class="controls">
					<input type="password" name="password" class="input-xlarge" required>
				</div>
		</div>
     	
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Sign in</button>
		</div>
	</fieldset>
</form>