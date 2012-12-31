<?= form_open('acl/perm/add', array('class' => 'form-horizontal well')); ?>
	<fieldset>
		<legend>Add Permission</legend>
		
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
			<label for="slug" class="control-label">Slug</label>
			<div class="controls">
				<div class="input-append">
					<input type="text" name="slug" max-length="35" value="<?= set_value('slug'); ?>" required>
					<span class="add-on autofill" data-source="name" data-output="slug">auto<noscript> off</noscript></span>
				</div>
				<span class="help-block">This field automagically fills itself with a suitable value.</span>
			</div>
		</div>
		
		<div class="control-group">
			<label for="description" class="control-label">Description</label>
			<div class="controls">
				<textarea name="description" max-length="140" class="input-large" rows="3" required><?= set_value('description'); ?></textarea>
			</div>
		</div>
	
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save</button>
			<?= anchor('acl/perm', 'Cancel', array('class' => 'btn')); ?>
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
		});
	});
});
</script>