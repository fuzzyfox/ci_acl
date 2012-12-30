<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<?php echo anchor('', 'ci_acl', array('class' => 'brand')); ?>
			<div class="nav-collapse collapse">
				<ul class="nav pull-right">
					<li class="dropdown" id="current-user">
						<a href="#current-user" data-toggle="dropdown" class="dropdown-toggle">
							Doe, John
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><?php echo anchor('', 'Profile'); ?></li>
							<li><?php echo anchor('', 'Settings'); ?></li>
							<li class="divider"></li>
							<li><?php echo anchor('', 'Sign Out'); ?></li>
						</ul>
					</li>
				</ul>
				<ul class="nav">
					
				</ul>
			</div>
		</div>
	</div>
</div>