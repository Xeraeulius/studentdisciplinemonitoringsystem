<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/administrator/overall-header.php';

add_message_details()
?>
<!-- === Insert Administrator Content === -->
<section class="content-header">
	<h1>
		Notification Details
	</h1>
	<ol class="breadcrumb">
		<li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>
</section>

<section class="content">
<?php  
if (isset($_POST['btn_add'])) {
	$notification_input = $_POST['notification_input'];
?>
<div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<p><i class="icon fa fa-check"></i> Notification Detail Added:</p>
	<ul>
		<li>Notification Type: <?php echo $notification_input; ?></li>
	</ul>
</div>
<?php	
}

if (isset($_POST['btn_update'])) {
	global $conn;

	$id = $_POST['btn_update'];
	$notification_input = $_POST['notification_input'];
	$notification_content = $_POST['notification_content'];

	$update = "UPDATE message SET message_type =" . " \"$notification_input\" " . ", body = \"$notification_content\"
			   WHERE id = '$id'";
			   
	$result = $conn->query($update);
?>
<div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<p><i class="icon fa fa-check"></i> Notification Detail Updated</p>
</div>
<?php	
}
?>
<div class="row">
	<div class="col-xs-12">
	 	<div class="box">
	  	<!--
	    <div class="box-header">
	      <h3 class="box-title">Insert Title Here</h3>
	      <div class="box-tools">
	        <div class="input-group" style="width: 150px;">
	          <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
	          <div class="input-group-btn">
	            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
	          </div>
	        </div>
	      </div>
	    </div>
	    -->
	    	<form action="update_notification_detail.php" method="POST">
			    <div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tr>
							<th>Message Type</th>
							<th>Content</th>
							<th></th>
						</tr>
					    <tbody>
						<?php 
							global $conn;
							$select = "SELECT id, message_type, body from message";
							$result = $conn->query($select);

							while ($row = $result->fetch_object()) {
						?><tr>
								<td style="width: 300px;"><label><?php echo $row->message_type; ?></label></td>
						        <td style="width: 600px;"><p><?php echo $row->body; ?></p></td>
			    				<td><button type="submit" name="update_notification_detail" value="<?php echo $row->id ?>" class="btn btn-primary">Update</button></td>
					      </tr>
					    <?php  
							}
					    ?>
				    	</tbody>
					</table>
				</div>
			</form>
			<form action="add_message_details.php" method="POST">
		        <div class="box-footer clearfix">
		      		<button type="submit" name="btn_add_message_details" class="btn btn-default pull-left"><i class="fa fa-plus"></i> Add</button>
		        </div>
			</form>
		</div>
	</div>
</div>
</section>
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/administrator/overall-footer.php';
?>