<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';

require 'app/view/administrator/select2-message.php';

if (isset($_POST['sanctions_major'])) {
	global $conn;
	$id = $_POST['sanctions_major'];

	$select = "SELECT reference_number, title from offense_details where (status = 'Active' AND type = 'Major Offense') AND id = '$id'";
	$query = $conn->query($select);

	while ($row = $query->fetch_object()) {
		$ref_number = $row->reference_number;
		$title = $row->title;
	}

  $select_join = "SELECT      offense_details.description
                  FROM        offense_details
                  LEFT JOIN   sanctions
                  ON          sanctions.offense_details_id = offense_details.id
                  WHERE       offense_details.id = $id AND type = 'Major Offense'";

  $query_join = $conn->query($select_join);

  while ($row_join = $query_join->fetch_object()) {
    $description = $row_join->description;
  }
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Sanctions
    <small>Major Offense</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
  </ol> 
</section>

<!-- Main content -->
<section class="content">

<div class="row">
    <div class="col-md-3">
      <div class="box box-solid">
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="sanctions.php"> Minor Offense</a></li>
            <li class="active"><a href="sanctions_major_offense.php"> Major Offense</a></li>
          </ul>
        </div><!-- /.box-body -->
      </div><!-- /. box -->
    </div><!-- /.col -->
  <div class="col-md-9">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Major Offense Sanctions</h3>
      </div><!-- /.box-header -->
      <form action="sanctions_major_offense.php" method="POST">
      <div class="box-body">
        <div class="form-group">
        <label>Reference Number:</label>

        <input class="form-control" disabled value="<?php echo $ref_number . " - " . $title; ?>">
        </div>
        <div class="form-group">
          <label>Description:</label>
          <div class="callout callout-danger">
            <p><?php echo $description; ?></p>
          </div>
        </div>
          <?php  
            if (sanction_major_exists($id)) {
            $select_update = "SELECT first_offense, second_offense, third_offense from sanctions where offense_details_id = $id";
            $query_update = $conn->query($select_update);
            while ($row_update = $query_update->fetch_object()) {
              $first_offense = $row_update->first_offense;
              $second_offense = $row_update->second_offense;
              $third_offense = $row_update->third_offense;
            }
          ?>
          <div class="form-group">
            <label>First Offense:</label>
            <input name="first_offense" class="form-control" value="<?php echo $first_offense; ?>" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Second Offense:</label>
            <input name="second_offense" class="form-control" value="<?php echo $second_offense; ?>" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Third Offense:</label>
            <input name="third_offense" class="form-control" value="<?php echo $third_offense; ?>" autocomplete="off">
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
          <div class="pull-right">
            <button name="update_sanctions" value="<?php echo $id; ?>" type="submit" class="btn btn-primary"> Update</button>
          </div>
        </div><!-- /.box-footer -->
          <?php
            } else {
          ?>
          <div class="form-group">
            <label>First Offense:</label>
            <input name="first_offense" class="form-control" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Second Offense:</label>
            <input name="second_offense" class="form-control" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Third Offense:</label>
            <input name="third_offense" class="form-control" autocomplete="off">
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
          <div class="pull-right">
            <button name="add_sanctions" value="<?php echo $id; ?>" type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
          </div>
        </div><!-- /.box-footer -->
          <?php
            }
          ?>
      </form>
    </div><!-- /. box -->
  </div><!-- /.col -->
</div><!-- /.col -->

</section><!-- /.content -->
<?php  
require 'app/view/administrator/select2-footer.php';
?>