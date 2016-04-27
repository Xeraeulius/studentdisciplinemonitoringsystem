<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';

// require 'app/view/handler/gateway/_offense_minor.php';
if (isset($_POST['btn_minor'])) {
  $student_id = $_POST['btn_minor'];        
  $incident_date = $_POST['incident_date']; 
  $report = $_POST['description'];   
  $status = $_POST['status'];      

  if (empty($incident_date) && empty($report) && empty($status)) {
    header('Location: offense_report_minor.php?r=' . base64_encode('incomplete_date_incident_and_report'));
  } elseif (empty($incident_date)) {
    header('Location: offense_report_minor.php?r=' . base64_encode('incomplete_date_incident'));
  } elseif (empty($report)) {
    header('Location: offense_report_minor.php?r=' . base64_encode('incomplete_report'));
  }  elseif (empty($status)) {
    header('Location: offense_report_minor.php?r=' . base64_encode('incomplete_status'));
  } else {
    $offense_details_id = $_SESSION['offense_details_id'];
    $sanctions_minor_id = $_SESSION['sanctions_minor_id'];
    $term = school_term_id();
    $count = minor_offense_exists($student_id, $offense_details_id);

    if ($count == '' && $status == 'Case Record') {
      $offense_count = "-";
    } elseif ($count == 'First Offense' && $status == 'Case Record') {
      $offense_count = "-";
    } elseif ($count == 'Second Offense' && $status == 'Case Record') {
      $offense_count = "-";
    }

    if ($count == '' && $status == 'Issue') {
      $offense_count = "First Offense";
    } elseif ($count == 'First Offense' && $status == 'Issue') {
      $offense_count = "Second Offense";
    } elseif ($count == "Second Offense" && $status == 'Issue') {
      $offense_count = "Third Offense";
    }

    create_minor_offense_report($student_id, $incident_date, $report, $offense_details_id, $sanctions_minor_id, $term, $offense_count, $status);
  }
}

require 'app/view/administrator/overall-header.php';
?>
<!-- === Insert Administrator Content === -->
<section class="content-header">
  <h1>
    Student Offenses
    <small>Minor Offense: <?php echo school_term() . " Term"; ?></small>
  </h1>
	<ol class="breadcrumb">
		<li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>	
</section>
<section class="content">
<?php  
  // require 'app/view/handler/redirection/_minor_notification.php';
if (isset($_GET['r'])) {
  $decode = base64_decode($_GET['r']);
?>
<?php
  if ($decode == 'create_offense_success') {
?>
<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <p><i class="icon fa fa-check"></i> Minor Offense Report has been recorded.</p>
</div>
<?php
    unset($_SESSION['student_name']);
  }
}

if (isset($_GET['m'])) {
  $decode = base64_decode($_GET['m']);
  unset($_SESSION['student_name']);
  if ($decode == 'maximum_capacity') {
?>
<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <p><i class="icon fa fa-warning"></i> The Student has already accumulated Three Minor Offenses.</p>
</div>
<?php
  }
}
?>

  <div class="row">
    <div class="col-md-3">
      <a href="minor_offense_report.php" class="btn btn-primary btn-block margin-bottom">Minor Offense Report</a>
      <div class="box box-solid">
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="minor_offense_list.php"> Minor Offense</a></li>
            <li><a href="major_offense_list.php"> Major Offense</a></li>
          </ul>
        </div><!-- /.box-body -->
      </div><!-- /. box -->
    </div><!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List of Students</h3>
          <div class="box-tools pull-right">
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tr>
                <th></th>
                <th>Name</th>
                <th></th>
              </tr>
              <tbody>
                <?php student_has_minor_offense(); ?>
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