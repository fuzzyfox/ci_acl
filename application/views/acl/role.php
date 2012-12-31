<div class="row">
	<div class="span12">
		<h2>Access Control Management</h2>
		<ul class="nav nav-tabs">
			<li><?= anchor('acl', 'Dashboard'); ?></li>
			<li><?= anchor('acl/user', 'Users'); ?></li>
			<li class="active"><?= anchor('acl/role', 'Roles'); ?></li>
			<li><?= anchor('acl/perm', 'Permissions'); ?></li>
		</ul>
		
		<!--<ul class="breadcrumb">
			<li><a href="#">ACL</a> <span class="divider">/</span></li>
			<li class="active">Users<li>
		</ul>-->
	</div>
</div>

<div class="row" id="tab-panel">
	<div class="span8">
		<table class="table table-striped table-condensed">
			<thead>
				<tr>
					<th>slug</th>
					<th>name</th>
					<th>description</th>
					<th>permissions</th>
					<th>action</th>
				</tr>
			</thead>
			<tbody>
				<? if(is_array($role_list)) foreach($role_list as $role): ?>
				<tr>
					<td><?= $role->slug; ?></td>
					<td><?= $role->name; ?></td>
					<td><?= $role->description; ?></td>
					<td>
						<? if(is_array($role->perms)) foreach($role->perms as $perm): ?>
						<?= $perm->name; ?>
						<? endforeach; ?>
					</td>
					<td>
						<?= anchor('acl/role/edit', '<i class="icon-edit"></i> Edit', array('class' => 'btn btn-small')); ?>
						<?= anchor('acl/role/del/' . $role->role_id, '<i class="icon-remove icon-white"></i> Delete', array('class' => 'btn btn-danger btn-small')); ?>
					</td>
				</tr>
				<? endforeach; ?>
			</tbody>
		</table>
		
		<? if(!is_array($role_list)): ?>
		<p class="alert alert-info">No roles to find here...</p>
		<? endif; ?>
	</div>
	<div class="span4">
		<?= str_replace('form-horizontal', '', $this->load->view('acl/form/add_role', NULL, TRUE)); ?>
	</div>
</div>