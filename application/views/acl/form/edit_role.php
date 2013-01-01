<?= form_open('acl/role/edit/' . $role->role_id, array('class' => 'form-horizontal well')); ?>
	<fieldset>
		<legend>Edit Role</legend>
		
		<? if(validation_errors()): ?>
		<div class="alert alert-error">
			<?= validation_errors(); ?>
		</div>
		<? endif; ?>
		
		<div class="control-group">
			<label for="name" class="control-label">Name</label>
			<div class="controls">
				<input type="text" name="name" max-length="70" value="<?= set_value('name') ? set_value('name') : $role->name; ?>" required>
			</div>
		</div>
	
		<div class="control-group">
			<label for="slug" class="control-label">Slug</label>
			<div class="controls">
				<div class="input-append">
					<input type="text" name="slug" max-length="35" value="<?= set_value('slug') ? set_value('slug') : $role->slug; ?>" required>
					<span class="add-on autofill" data-source="name" data-output="slug">auto<noscript> off</noscript></span>
				</div>
				<span class="help-block">This field automagically fills itself with a suitable value.</span>
			</div>
		</div>
		
		<div class="control-group">
			<label for="description" class="control-label">Description</label>
			<div class="controls">
				<textarea name="description" class="input-large" rows="3" required><?= set_value('description') ? set_value('description') : $role->description; ?></textarea>
			</div>
		</div>

		<div class="control-group">
			<label for="perms[]" class="control-label">Permissions</label>
			<div class="controls">
				<select name="perms[]" multiple="multiple" class="input-large">
					<? foreach($perm_list as $perm): ?>
					<option value="<?= $perm->perm_id; ?>" <?= ($perm->set == TRUE) ? 'selected="selected"' : NULL; ?>><?= $perm->name; ?></option>
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

<script>
$(function() {
	var $autofills = $('.autofill');
	
	$autofills.each(function(key, value) {
		var source = $(value).attr('data-source'),
		output = $(value).attr('data-output');
		
		$('input[name=' + source + ']').keyup(function() {
			$('input[name=' + output + ']').val(this.value.toLowerCase().replace(/\s/g, '_').replace(/[^a-z0-9_\-]/g, ''));
			console.log(this.value.toLowerCase().replace(/\s/g, '_').replace(/[^a-z0-9_\-]/g, ''));
		});
	});
});
</script>