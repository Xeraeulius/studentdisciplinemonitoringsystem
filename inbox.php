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
          <h3 class="box-title">Archive</h3>
          <div class="box-tools pull-right">
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body no-padding">
          <form action="inbox_resend.php" method="POST">
            <div class="table-responsive mailbox-messages">
              <table class="table table-hover table-striped">
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Subject</th>
                  <th></th>
                  <th></th>
                </tr>
                <tbody>
                  <?php archive_notification_of_student(); ?>
                </tbody>
              </table><!-- /.table -->
            </div><!-- /.mail-box-messages -->
          </form>
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