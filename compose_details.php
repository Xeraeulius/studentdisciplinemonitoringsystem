<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';

if (isset($_POST['btn_submit'])) {
  $id = $_POST['message_type'];

  $select = "SELECT message_type, body from message where id = '$id'"; 
  $result = $conn->query($select);

  while ($row = $result->fetch_object()) {
    $type = $row->message_type;
    $body = $row->body;
  }
}

require 'app/view/administrator/select2-message.php';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Student Notification Mailbox
  </h1>
  <ol class="breadcrumb">
    <li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
  </ol> 
</section>

<!-- Main content -->
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
      <form action="student_notification.php" method="POST">
      <div class="box-body">
        <div class="form-group">
        <label>To:</label>
        <select name="message_id" class="form-control select2" style="width: 100%;">
          <option></option>
          <?php
            global $conn;
            $select = "SELECT id, last_name, first_name, middle_name from students";
            $result = $conn->query($select);
            while ($row = $result->fetch_object()) {
          ?>
              <option value="<?php echo $row->id; ?>"><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></option>
          <?php
            }
          ?>
        </select>
        </div>
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
            <input name="btn_date" type="text" class="form-control pull-right" id="reservationtime">
          </div><!-- /.input group -->
      </div><!-- /.box-body -->
      <div class="box-footer">
        <div class="pull-right">
          <button name="send" value="<?php echo $id; ?>" type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
        </div>
      </div><!-- /.box-footer -->
      </form>
    </div><!-- /. box -->
  </div><!-- /.col -->
</div><!-- /.col -->

</section><!-- /.content -->
<?php  
require 'app/view/administrator/select2-footer.php';
?>