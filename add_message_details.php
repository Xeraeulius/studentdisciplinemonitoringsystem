<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/administrator/overall-header.php';
?>
<!-- === Insert Administrator Content === -->
<section class="content-header">
	<h1>
		Compose New Notification Detail
	</h1>
	<ol class="breadcrumb">
		<li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>
</section>

<section class="content">
<form action="notification_details.php" method="POST">
	<div class="box box-primary">
	<div class="box-body">
	  <div class="form-group">
	    <input class="form-control" name="notification_input" placeholder="Notification Type:" autocomplete="off">
	  </div>
	  <div class="form-group">
	    <textarea id="compose-textarea" name="notification_content" class="form-control" autocomplete="off" style="height: 300px"></textarea>
	  </div>
	</div><!-- /.box-body -->
	<div class="box-footer">
	  <div class="pull-right">
	    <button type="submit" name="btn_add" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
	  </div>
	</div><!-- /.box-footer -->
	</div><!-- /. box -->
</form>
</section>
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/administrator/overall-footer.php';
?>