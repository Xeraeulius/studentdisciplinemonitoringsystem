<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/administrator/overall-header.php';

student_notification($admin_id);
update_reschedule_notification();
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
<?php  
if (isset($_POST['send'])) {
  global $conn;

  $student_id = $_POST['message_id'];
  $query = "SELECT last_name, first_name, middle_name from students where id = '$student_id'";
  $select = $conn->query($query);

    while ($result = $select->fetch_object()) {
?>
<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <p><i class="icon fa fa-check"></i> The Notification Message has been sent to - <strong><?php echo $result->last_name . ", " . $result->first_name . " " . $result->middle_name?>.</strong></p>
</div>
<?php
    }
}
?>
  <div class="row">
    <div class="col-md-3">
      <a href="compose.php" class="btn btn-primary btn-block margin-bottom">Compose</a>
      <div class="box box-solid">
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
            <li><a href="inbox.php"><i class="fa fa-inbox"></i> Archive</a></li>
          </ul>
        </div><!-- /.box-body -->
      </div><!-- /. box -->
    </div><!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Sent</h3>
          <div class="box-tools pull-right">
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tr>
                <th></th>
                <th>Name</th>
                <th>Subject</th>
                <th></th>
                <th>Sent Date</th>
              </tr>
              <tbody>
                <?php notification_of_student(); ?>
              </tbody>
            </table><!-- /.table -->
          </div><!-- /.mail-box-messages -->
        </div><!-- /.box-body -->
        <div class="box-footer no-padding">
        </div>
      </div><!-- /. box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/administrator/overall-footer.php';
?>