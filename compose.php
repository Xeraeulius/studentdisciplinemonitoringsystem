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
      <a href="student_notification.php" class="btn btn-primary btn-block margin-bottom">Back to Notification Mailbox</a>
      <div class="box box-solid">
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="student_notification.php"><i class="fa fa-envelope-o"></i> Sent</a></li>
            <li><a href="inbox.php?r=inbox_details"><i class="fa fa-inbox"></i> Archieve</a></li>
          </ul>
        </div><!-- /.box-body -->
      </div><!-- /. box -->
    </div><!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Compose New Message</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
        <label>Subject:</label>
        <form action="compose_details.php" method="POST">
        <div class="input-group input-group">
          <select name="message_type" class="form-control">
            <option></option>
            <?php
              global $conn;
              $select = "SELECT id, message_type from message";
              $result = $conn->query($select);
              while ($row = $result->fetch_object()) {
            ?>
                <option value="<?php echo $row->id; ?>"><?php echo $row->message_type; ?></option>
            <?php
              }
            ?>
          </select>
            <span class="input-group-btn">
              <button name="btn_submit" class="btn btn-primary btn-flat" type="submit">Submit</button>
            </span>
        </div>
        </form>
        </div><!-- /.box-body -->
      </div><!-- /.col -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/administrator/overall-footer.php';
?>
<?php  
if (isset($_POST['send'])) {
  $id = $_POST['message_id'];
  $date = $_POST['btn_date'];
}
?>