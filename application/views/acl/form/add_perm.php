<?= form_open('acl/perm/add', array('class' => 'form-horizontal well')); ?>
	<fieldset>
		<legend>Add Permission</legend>
	
		<div class="control-group">
			<label for="name" class="control-label">Name</label>
			<div class="controls">
				<input type="text" name="name" max-length="70" required>
			</div>
		</div>
	
		<div class="control-group">
			<label for="slug" class="control-label">Slug</label>
			<div class="controls">
				<div class="input-append">
					<input type="text" name="slug" max-length="35" required>
					<span class="add-on autofill" data-source="name">auto<noscript> off</noscript></span>
				</div>
				<span class="help-block">This field automagically fills itself with a suitable value.</span>
			</div>
		</div>
		
		<div class="control-group">
			<label for="description" class="control-label">Description</label>
			<div class="controls">
				<textarea name="description" max-length="140" class="input-large" rows="3" required></textarea>
			</div>
		</div>
	
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save</button>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
</form>