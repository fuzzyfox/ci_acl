<div class="row">
	<div class="span12">
		<h2>Access Control Management</h2>
		<ul class="nav nav-tabs">
			<li class="active"><?= anchor('acl', 'Dashboard'); ?></li>
			<li><?= anchor('acl/user', 'Users'); ?></li>
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
	<div class="span12">
		<p>This section has been left blank so that you can fill it with whatever makes the most sense on your system.</p>
	</div>
</div>

<script>
$(function(){
	
	$('#tab-panel').wrap('<div id="dynamic-tabs" />');
	
	$('.nav-tabs a').click(function() {
		var $that = $(this);
		
		$('#dynamic-tabs').load($that.attr('href') + ' #tab-panel', function(response, status, xhr) {
			if(status == 'success') {
				$('.nav-tabs .active').removeClass('active');
				
				$that.parent().addClass('active');
			}
		});
		
		return false;
	});
});
</script>