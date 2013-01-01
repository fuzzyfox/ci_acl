<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<?php echo anchor('acl', 'ci_acl', array('class' => 'brand')); ?>
			<div class="nav-collapse collapse">
				<? if($this->session->userdata('signed_in')): ?>
				<ul class="nav pull-right">
					<li class="dropdown" id="current-user">
						<a href="#current-user" data-toggle="dropdown" class="dropdown-toggle">
							<?= $this->session->userdata('email'); ?>
							<b class="caret"></b>
						</a>
						
						<ul class="dropdown-menu">
							<li><?php echo anchor('acl/user/sign_out', 'Sign out'); ?></li>
						</ul>
					</li>
				</ul>
				<? else: ?>
				<?php echo anchor('acl/user/sign_in', 'Sign in', array('class' => 'btn btn-primary pull-right')); ?>
				<? endif; ?>
			</div>
		</div>
	</div>
</div>