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
		Update Notification Detail
	</h1>
	<ol class="breadcrumb">
		<li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>
</section>

<section class="content">
<?php  
if (isset($_POST['update_notification_detail'])) {
	$select = "SELECT id, message_type, body from message";
	$result = $conn->query($select);

	while ($row = $result->fetch_object()) {
		$body = $row->body;
		$message = $row->message_type;
		$id = $row->id;
	}
}
?>
<form action="notification_details.php" method="POST">
	<div class="box box-primary">
	<div class="box-body">
	  <div class="form-group">
	    <input class="form-control" name="notification_input" placeholder="Notification Type:" autocomplete="off" value="<?php echo $message; ?>">
	  </div>
	  <div class="form-group">
	    <textarea id="compose-textarea" name="notification_content" class="form-control" autocomplete="off" style="height: 300px"><?php echo $body; ?></textarea>
	  </div>
	</div><!-- /.box-body -->
	<div class="box-footer">
	  <div class="pull-right">
	    <button type="submit" name="btn_update" value="<?php echo $id; ?>" class="btn btn-primary">Submit</button>
	  </div>
	</div><!-- /.box-footer -->
	</div><!-- /. box -->
</form>
</section>
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/administrator/overall-footer.php';
?>