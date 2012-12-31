<div class="row">
	<div class="span12">
		<h2>Access Control Management</h2>
		<ul class="nav nav-tabs">
			<li><?= anchor('acl', 'Dashboard'); ?></li>
			<li><?= anchor('acl/user', 'Users'); ?></li>
			<li><?= anchor('acl/role', 'Roles'); ?></li>
			<li class="active"><?= anchor('acl/perm', 'Permissions'); ?></li>
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
					<th>action</th>
				</tr>
			</thead>
			<tbody>
				<? if(is_array($perm_list)) foreach($perm_list as $perm): ?>
				<tr>
					<td><?= $perm->slug; ?></td>
					<td><?= $perm->name; ?></td>
					<td><?= $perm->description; ?></td>
					<td>
						<?= anchor('acl/perm/edit/' . $perm->perm_id, '<i class="icon-edit"></i> Edit', array('class' => 'btn btn-small')); ?>
						<?= anchor('acl/perm/del/' . $perm->perm_id, '<i class="icon-remove icon-white"></i> Delete', array('class' => 'btn btn-danger btn-small')); ?>
					</td>
				</tr>
				<? endforeach; ?>
			</tbody>
		</table>
		
		<? if(!is_array($perm_list)): ?>
		<p class="alert alert-info">No permissions to find here...</p>
		<? endif; ?>
	</div>
	<div class="span4">
		<?= str_replace('form-horizontal', '', $this->load->view('acl/form/add_perm', NULL, TRUE)); ?>
	</div>
</div>