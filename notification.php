<!-- This Page is/are for Students -->
<?php 
require 'app/controller/init.php';
protect_page_profile();
require 'app/controller/student/login_credential.php';
require 'app/view/student/overall-header.php';
?>
<!-- =========================================================== -->
<?php  
if (isset($_GET['r'])) {
  $r = base64_decode($_GET['r']);
  $seen = 1;
  seen_clicked($seen, $id);
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
<?php  
if (isset($_POST['btn_send'])) {
	if (empty($_POST['btn_confirm'])) {
?>
<div class="alert alert-danger alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<p><i class="icon fa fa-warning"></i> The message was not delivered because the Terms and Agreements was left blank.</p>
</div>
<?php
	} else {
?>
<div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<p><i class="icon fa fa-check"></i> The message was delivered.</p>
</div>
<?php
	$btn_id = $_POST['btn_send'];
	$confirm = $_POST['btn_confirm'];

	update_student_notification($id, $confirm, $btn_id);
	}
}
?>
<div class="row">
<div class="col-md-3">
  <div class="box box-solid">
    <div class="box-body no-padding">
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="notification.php?r=<?php echo base64_encode(encode_notification($id)); ?>"><i class="fa fa-inbox"></i> Inbox</a></li>
        <li><a href="#"><i class="fa fa-database"></i> Archive</a></li>
      </ul>
    </div><!-- /.box-body -->
  </div><!-- /. box -->
</div><!-- /.col -->
<div class="col-md-9">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Inbox</h3>
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
                <th>Sent Date</th>
                <th></th>
              </tr>
              <form action="notification_message.php" method="POST">
	              <tbody>
	                <?php received_notification($id); ?>
	              </tbody>
              </form>
            </table><!-- /.table -->
          </div><!-- /.mail-box-messages -->
        </div><!-- /.box-body -->
    <div class="box-footer no-padding">
    </div>
  </div><!-- /. box -->
</div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
<!-- =========================================================== -->

<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/student/overall-footer.php'
?>