<!-- This Page is/are for Students -->
<?php 
require 'app/controller/init.php';
protect_page_profile();
require 'app/controller/student/login_credential.php';
require 'app/view/student/overall-header.php';
?>
<!-- =========================================================== -->
<?php 
if (isset($_POST['view_notification'])) {
	global $conn;

	$notification_id = $_POST['view_notification'];
	$student_id = $id;

	$select = "SELECT		message.message_type,
							message.body,
				            message_details.scheduled_at,
				            message_details.id
				            
				FROM		message_details

				LEFT JOIN	message
				ON			message.id = message_details.message_id

				WHERE		student_id = '$student_id' AND message_details.id = '$notification_id'";

	$query = $conn->query($select);

	while($row = $query->fetch_object()) {
		$message_type = $row->message_type;
		$body = $row->body;
		$schedule = $row->scheduled_at;
		$message_id_details = $row->id;
	}
}
?>
<section class="content-header">
  <h1>
    Notification Mailbox
  </h1>
	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>	
</section>

<section class="content">

<div class="row">
  <div class="col-md-3">
  <div class="box box-solid">
    <div class="box-body no-padding">
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="notification.php?r=<?php echo base64_encode(encode_notification($id)); ?>"><i class="fa fa-inbox"></i> Inbox</a></li>
        <li><a href="inbox.php?inbox_details"><i class="fa fa-database"></i> Archive</a></li>
      </ul>
    </div><!-- /.box-body -->
  </div><!-- /. box -->
  </div><!-- /.col -->
  <div class="col-md-9">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Notification Message</h3>
      </div><!-- /.box-header -->
        <div class="box-body">
        <div class="form-group">
          <label>Message Type:</label>
          <input class="form-control" disabled value="<?php echo $message_type; ?>">
        </div>
        <div class="form-group">
          <label>Content:</label>
          <textarea id="compose-textarea" disabled class="form-control" style="height: 150px"><?php echo $body; ?></textarea>
        </div>
        <div class="form-group">
			<label>Schedule of Appointment:</label>
			<div class="input-group">
				<div class="input-group-addon">
				  <i class="fa fa-calendar"></i>
				</div>
				<input name="btn_date" type="text" disabled value="<?php echo $schedule; ?>" class="form-control pull-right" id="reservationtime">
	        </div>
		</div><!-- /.input group -->
		<form action="notification.php" method="POST">
			<div class="form-group">
				<label>Terms and Agreements:</label>
				<div class="input-group">
					<span class="input-group-addon">
						<input type="checkbox" value="Confirm" name="btn_confirm">
					</span>
					<input type="text" class="form-control" disabled vk_19cfc="subscribed" value="I accept and will therefore comply with the requirements stated in this message.">
				</div>
			</div>
     	</div><!-- /.box-body -->
	        <div class="box-footer">
		        <div class="pull-right">
		          <button name="btn_send" value="<?php echo $message_id_details; ?>" type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
		        </div>
	        </div>
        </form>
      </div><!-- /.box-footer -->
    </div><!-- /. box -->
  </div><!-- /.col -->
</div><!-- /.col -->

</section><!-- /.content -->
<!-- =========================================================== -->

<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/student/overall-footer.php'
?>