<div class="row">
	<div class="span12">
		<h2>Access Control Management</h2>
		<ul class="nav nav-tabs">
			<li><?= anchor('acl', 'Dashboard'); ?></li>
			<li class="active"><?= anchor('acl/user', 'Users'); ?></li>
			<li><?= anchor('acl/role', 'Roles'); ?></li>
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
					<th>id</th>
					<th>name</th>
					<th>email</th>
					<th>role(s)</th>
					<th>action</th>
				</tr>
			</thead>
			<tbody>
				<? if(is_array($user_list)) foreach($user_list as $user): ?>
				<tr>
					<td><?= $user->user_id; ?></td>
					<td><?= $user->name; ?></td>
					<td><?= $user->email; ?></td>
					<td>
						<ul>
							<? if(is_array($user->roles)) foreach($user->roles as $role): ?>
							<li><?= $role->name; ?></li>
							<? endforeach; ?>
						</ul>
					</td>
					<td>
						<?= anchor('acl/user/edit', '<i class="icon-edit"></i> Edit', array('class' => 'btn btn-small')); ?>
						<?= anchor('acl/user/del/' . $user->user_id, '<i class="icon-remove icon-white"></i> Delete', array('class' => 'btn btn-danger btn-small')); ?>
					</td>
				</tr>
				<? endforeach; ?>
			</tbody>
		</table>
		
		<? if(!is_array($user_list)): ?>
		<p class="alert alert-info">No users to find here...</p>
		<? endif; ?>
	</div>
	<div class="span4">
		<?= str_replace('form-horizontal', '', $this->load->view('acl/form/add_user', NULL, TRUE)); ?>
	</div>
</div>