<!-- This Page is/are for Administrator -->
<?php
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';

// require 'app/view/handler/redirection/_minor_report.php';
if (isset($_POST['minor_submit'])) {
  if (empty($_POST['student_name']) && empty($_POST['sanctions_minor'])) {
    header('Location: minor_offense_report.php?r=' . base64_encode('missing_fields'));
  } elseif (empty($_POST['student_name'])) {
    header('Location: minor_offense_report.php?r=' . base64_encode('missing_name'));
  } elseif (empty($_POST['sanctions_minor'])) {
    header('Location: minor_offense_report.php?r=' . base64_encode('missing_minor_sanctions'));
  } else {
    $_SESSION['student_name'] = $_POST['student_name'];
    $_SESSION['sanctions_minor'] = $_POST['sanctions_minor'];

    $student_id = $_SESSION['student_name'];
    $sanctions_id = $_SESSION['sanctions_minor'];
  }
}

// require 'app/view/handler/gateway/_minor_session.php';
if (isset($_SESSION['student_name'])) {
  $student_id = $_SESSION['student_name'];
  $sanctions_id = $_SESSION['sanctions_minor'];
  $result = minor_offense_exists($student_id, $sanctions_id);
}

if ($result == "Third Offense") {
  header('Location: minor_offense_list.php?m=' . base64_encode('maximum_capacity'));
}

require 'app/view/administrator/select2-message.php';
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
  // require 'app/view/handler/redirection/_major_count.php'; 
if ($result == null || $result == '-') {
  $offense = "First Offense";
  $sql_offense = "first_offense";
} elseif ($result == "First Offense") {
  $offense = "Second Offense ";
  $sql_offense = "second_offense";
} elseif ($result == "Second Offense") {
  $offense = "Third Offense";
  $sql_offense = "third_offense";
}

if (isset($_GET['r'])) {
  $decode = base64_decode($_GET['r']);

  if ($decode == 'incomplete_date_incident_and_report') {
?>
<div class="alert alert-danger">
  <i class="icon fa fa-warning"></i>
   Please do not leave <strong><u>Date of Incident</u></strong> and <strong><u>Narrative Report</u></strong> and <strong><u>Status</u></strong> field blank.
</div>
<?php
  } elseif ($decode == 'incomplete_date_incident') {
?>
<div class="alert alert-danger">
  <i class="icon fa fa-warning"></i>
  Please do not leave the <strong><u>Date of Incident</u></strong> field blank.
</div>
<?php
  } elseif ($decode == 'incomplete_report') {
?>
<div class="alert alert-danger">
  <i class="icon fa fa-warning"></i>
  Please do not leave the <strong><u>Narrative Report</u></strong> field blank.
</div>
<?php
  } elseif ($decode == 'incomplete_status') {
?>
<div class="alert alert-danger">
  <i class="icon fa fa-warning"></i>
  Please do not leave the <strong><u>Status</u></strong> field blank.
</div>
<?php
  }
}
?>

  <div class="row">
    <div class="col-md-3">
      <a href="minor_offense_list.php" class="btn btn-primary btn-block margin-bottom">Back</a>
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
          <h3 class="box-title">Minor Offense Report</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
        <form action="minor_offense_list.php" method="POST">
        <div class="form-group">
        <label>Name of Student:</label>
          <?php
            global $conn;
            $select = "SELECT id, last_name, first_name, middle_name from students where id = '$student_id'";
            $result = $conn->query($select);
            while ($row = $result->fetch_object()) {
              $student_id = $row->id;
          ?>
              <input class="form-control" name="student_name" disabled value="<?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?>">
          <?php
            }
          ?>
        </div>
        <div class="form-group">
          <label>Date of Incident</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control" name="incident_date" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="">
          </div>
        </div>
        <div class="form-group">
          <label>Number of Offense Incurred: </label>
            <input class="form-control" disabled value="<?php echo $offense; ?>">
        </div>
        <div class="form-group">
          <label>Reference Number: </label>
              <?php
                global $conn;
                $select = "SELECT id, reference_number, description, title FROM offense_details WHERE (status = 'Active' AND type = 'Minor Offense') AND id = '$sanctions_id'";
                $result = $conn->query($select);
                while ($row = $result->fetch_object()) {
                  $description = $row->description;
                  $_SESSION['offense_details_id'] = $row->id;
              ?>
                  <input class="form-control" disabled value="<?php echo $row->reference_number . " - " . $row->title; ?>">
              <?php
                }
              ?>
        </div>
        <div class="form-group">
          <label>Description:</label>
          <div class="callout callout-warning">
            <p><?php echo $description; ?></p>
          </div>
        </div>
        <div class="form-group">
        <?php  
          $select_join = "SELECT      sanctions." . "$sql_offense" . ",
                                      sanctions.id
                          FROM        sanctions
                          LEFT JOIN   offense_details
                          ON          sanctions.offense_details_id = offense_details.reference_number
                          WHERE       sanctions.offense_details_id = $sanctions_id";
          $result_join = $conn->query($select_join);
          while ($row = $result_join->fetch_object()) {
            $first_offense = $row->$sql_offense;
            $_SESSION['sanctions_minor_id'] = $row->id;
          }
        ?>
          <label>Sanctions:</label>
          <input name="offense" class="form-control" disabled value="<?php echo $first_offense; ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label>Status:</label>
          <select name="status" class="form-control">
            <option value=""></option>
            <option value="Case Record">Minor Offense Case Record</option>
            <option value="Issue">Issue Minor Offense</option>
          </select>
        </div>
        <div class="form-group">
          <label>Narrative Report:</label>
          <textarea name="description" class="form-control" rows="10"></textarea>
        </div>
        <div class="box-footer">
          <button type="submit" name="btn_minor" value="<?php echo $student_id ?>" class="btn btn-primary pull-right">Submit</button>
        </div>
        </form>
        </div><!-- /.box-body -->
      </div><!-- /.col -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
<!-- === [= NOTHING FOLLOWS =] === -->
<?php
require 'app/view/administrator/select2-footer.php';
?>