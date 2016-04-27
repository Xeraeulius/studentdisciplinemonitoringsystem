<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/handler/redirection/_case_closed_notification.php';
if (isset($_POST['btn_reschedule'])) {
  $id = $_POST['btn_reschedule'];

  $select = "SELECT   message.message_type,
                      message.body
                            
                FROM    message_details

                LEFT JOIN message
                ON      message_details.message_id = message.id

                WHERE   message_details.id = $id"; 
  $result = $conn->query($select);

  while ($row = $result->fetch_object()) {
    $type = $row->message_type;
    $body = $row->body;
  }
}
require 'app/view/administrator/select2-message.php';
?>
<!-- === Insert Administrator Content === -->
<section class="content-header">
  <h1>
    Student Notification Mailbox
  </h1>
	<ol class="breadcrumb">
		<li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>	
</section>

        <section class="content">
          <div class="row">
            <div class="col-md-3">
              <a href="compose.php" class="btn btn-primary btn-block margin-bottom">Compose</a>
              <div class="box box-solid">
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="student_notification.php"><i class="fa fa-envelope-o"></i> Sent</a></li>
                    <li class="active"><a href="inbox.php"><i class="fa fa-inbox"></i> Archive</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
  <div class="col-md-9">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Reschedule Meeting</h3>
      </div><!-- /.box-header -->
      <form action="student_notification.php" method="POST">
        <div class="box-body">
          <div class="form-group">
            <label>Message Type:</label>
            <input class="form-control" disabled value="<?php echo $type; ?>">
          </div>
          <div class="form-group">
            <label>Content:</label>
            <textarea id="compose-textarea" class="form-control" style="height: 150px"><?php echo $body; ?></textarea>
          </div>
            <label>Schedule:</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input name="reschedule_date" type="text" class="form-control pull-right" id="reservationtime">
            </div><!-- /.input group -->
        </div><!-- /.box-body -->
        <div class="box-footer">
          <div class="pull-right">
            <button name="btn_reschedule" value="<?php echo $id; ?>" type="submit" class="btn btn-primary"> Reschedule</button>
          </div>
        </div><!-- /.box-footer -->
      </form>
    </div><!-- /. box -->
  </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/administrator/select2-footer.php';
?>