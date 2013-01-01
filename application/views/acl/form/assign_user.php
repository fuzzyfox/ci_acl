<?= form_open('acl/user/assign/' . $user->user_id, array('class' => 'form-horizontal well')); ?>
	<fieldset>
		<legend>Assign User - <?= $user->name; ?></legend>
		
		<? if(validation_errors()): ?>
		<div class="alert alert-error">
			<?= validation_errors(); ?>
		</div>
		<? endif; ?>
		
		<div class="control-group">
			<label for="roles[]" class="control-label">Roles</label>
			<div class="controls">
				<select name="roles[]" multiple="multiple" class="input-large" required>
					<? foreach($role_list as $role): ?>
					<option value="<?= $role->role_id; ?>" <?= ($role->set) ? 'selected="selected"' : NULL; ?>><?= $role->name; ?></option>
					<? endforeach; ?>
				</select>
			</div>
		</div>
			
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save</button>
			<?= anchor('acl/role', 'Cancel', array('class' => 'btn')); ?>
		</div>
	</fieldset>
</form>