<!-- This Page is/are for Administrator -->
<?php
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
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
// require 'app/view/handler/gateway/_minor.php';
if (isset($_GET['r'])) {
  $decode = base64_decode($_GET['r']);
  if ($decode == "missing_fields") {
?>
<div class="alert alert-danger">
  <i class="icon fa fa-warning"></i>
  Please do not leave <strong><u>Name of Student</u></strong> and <strong><u>Reference Number</u></strong> field blank.
</div>
<?php
  } elseif ($decode == "missing_name") {
?>
<div class="alert alert-danger">
  <i class="icon fa fa-warning"></i>
  Please do not leave <strong><u>Name of Student</u></strong> field blank.
</div>
<?php
  } elseif ($decode == "missing_minor_sanctions") {
?>
<div class="alert alert-danger">
  <i class="icon fa fa-warning"></i>
  Please do not leave <strong><u>Reference Number</u></strong> field blank.
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
        <form action="offense_report_minor.php" method="POST">
        <div class="form-group">
        <label>Name of Student:</label>
          <select name="student_name" class="form-control select2" style="width: 100%;">
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
          <label>Reference Number: </label>
            <select name="sanctions_minor" class="form-control">
              <option></option>
              <?php
                global $conn;
                $select = "SELECT id, reference_number, title FROM offense_details WHERE status = 'Active' AND type = 'Minor Offense'";
                $result = $conn->query($select);
                while ($row = $result->fetch_object()) {
              ?>
                  <option value="<?php echo $row->id; ?>"><?php echo $row->reference_number . " - " . $row->title; ?></option>
              <?php
                }
              ?>
            </select>
        </div>
        <div class="box-footer">
          <button type="submit" name="minor_submit" class="btn btn-primary pull-right">Submit</button>
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