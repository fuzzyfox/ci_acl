<div class="row">
	<div class="span12">
		<h2>Access Control Management</h2>
		<ul class="nav nav-tabs">
			<li><?= anchor('acl', 'Dashboard'); ?></li>
			<li class="active"><?= anchor('acl/user', 'Users'); ?></li>
			<li><?= anchor('acl/role', 'Roles'); ?></li>
			<li><?= anchor('acl/perm', 'Permissions'); ?></li>
		</ul>
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
						<?= ($this->acl_model->user_has_perm($this->session->userdata('user_id'), 'assign_role')) ? anchor('acl/user/assign/' . $user->user_id, '<i class="icon-group"></i> Assign', array('class' => 'btn btn-small')) : NULL; ?>
						<?= ($this->acl_model->user_has_perm($this->session->userdata('user_id'), 'edit_user')) ? anchor('acl/user/edit/' . $user->user_id, '<i class="icon-edit"></i> Edit', array('class' => 'btn btn-small')) : NULL; ?>
						<?= ($this->acl_model->user_has_perm($this->session->userdata('user_id'), 'delete_user')) ? anchor('acl/user/del/' . $user->user_id, '<i class="icon-remove icon-white"></i> Delete', array('class' => 'btn btn-danger btn-small')) : NULL; ?>
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
		<?= ($this->acl_model->user_has_perm($this->session->userdata('user_id'), 'add_user')) ? str_replace('form-horizontal', '', $this->load->view('acl/form/add_user', NULL, TRUE)) : NULL; ?>
		
		<? if(!$this->acl_model->user_has_perm($this->session->userdata('user_id'), 'add_user')): ?>
		<div class="well">
			<h4>Add User</h4>
			<p>You do not have permission to view this form</p>
		</div>
		<? endif; ?>
	</div>
</div>