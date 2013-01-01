<div class="row">
	<div class="offset3 span6">
		<p class="lead">
			Sorry... but right now this feature is deemed to be beyond the scope of the ACL, it could easily be added and integrated however. 
		</p>
		<p>This feature has been deemed beyond the scope most likely due to it being something that can vary a lot based on what type of project the ACL is used with. If you have a nice generic, and robust implimentation that would fit well with this ACL then <a href="https://github.com/fuzzyfox/ci_acl">fork me</a> over at github or submit a <a href="https://github.com/fuzzyfox/ci_acl/pull/new">pull request</a>!</p>
		<p>The code that triggered this message can be found in:</p>
		<pre><code>// file
./application/controllers/acl/<?= strtolower($this->router->fetch_class()); ?>.php

// class
<?= strtolower($this->router->fetch_class()); ?> 

// method
<?= strtolower($this->router->fetch_method()); ?>()</code></pre>

<a href="javascript:history.go(-1);void(0);" class="btn btn-primary">Go back<a>
	</div>
</div>