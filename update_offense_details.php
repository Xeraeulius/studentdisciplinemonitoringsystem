<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/administrator/overall-header.php';
?>
<!-- === Insert Administrator Content === -->
<?php  
if (isset($_POST['update_majors_offense'])) {
  $id = $_POST['update_majors_offense'];
  $select_list = "SELECT * from offense_details where id = '$id' and type = 'Major Offense'";
  $query_list = $conn->query($select_list);

    while ($row_list = $query_list->fetch_object()) {
      $ref_number = $row_list->reference_number;
      $description = $row_list->description;
      $title = $row_list->title;
      $status = $row_list->status;
    }
?>
<section class="content-header">
  <h1>
    Update Offense Detail
    <small>Major Offense</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
  </ol>
</section>

<form action="major_offense.php" method="POST">
  <section class="content">
  <div class="box box-default">
  <div class="box-body">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Reference Number</label>
          <input name="ref_number" type="text" value="<?php echo $ref_number; ?>" class="form-control" autocomplete="off">
        </div><!-- /.form-group -->
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Title</label>
          <input name="title" type="text" value="<?php echo $title; ?>" class="form-control" autocomplete="off">
        </div><!-- /.form-group -->
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Description</label>
          <textarea name="description" class="form-control" rows="5"><?php echo $description; ?></textarea>
        </div><!-- /.form-group -->
      <div class="form-group">
        <label>Status</label>
        <?php  
          if ($status == "Active") {
        ?>
          <select name="status" class="form-control">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
          </select>
        <?php
          } elseif ($status == "Inactive") {
        ?>
          <select name="status" class="form-control">
            <option value="Inactive">Inactive</option>
            <option value="Active">Active</option>
          </select>
      <?php
          }
        ?>
      </div>
      </div>
    </div>
  </div>
      <div class="box-footer clearfix">
        <button value="<?php echo $id; ?>" type="submit" name="update_major_offense" class="btn btn-primary pull-left"> Update</button>
      </div>
  </div>
  </section>
</form> 
<?php
}

if (isset($_POST['update_minor_offense'])) {
  $id = $_POST['update_minor_offense'];
  $select_list = "SELECT * from offense_details where id = '$id' and type = 'Minor Offense'";
  $query_list = $conn->query($select_list);

    while ($row_list = $query_list->fetch_object()) {
      $ref_number = $row_list->reference_number;
      $description = $row_list->description;
      $title = $row_list->title;
      $status = $row_list->status;
    }
?>
<section class="content-header">
  <h1>
    Update Offense Detail
    <small>Minor Offense</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
  </ol>
</section>

<form action="minor_offense.php" method="POST">
  <section class="content">
  <div class="box box-default">
  <div class="box-body">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Reference Number</label>
          <input name="ref_number" type="text" value="<?php echo $ref_number; ?>" class="form-control" autocomplete="off">
        </div><!-- /.form-group -->
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Title</label>
          <input name="title" type="text" value="<?php echo $title; ?>" class="form-control" autocomplete="off">
        </div><!-- /.form-group -->
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Description</label>
          <textarea name="description" class="form-control" rows="5"><?php echo $description; ?></textarea>
        </div><!-- /.form-group -->
      <div class="form-group">
        <label>Status</label>
        <?php  
          if ($status == "Active") {
        ?>
          <select name="status" class="form-control">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
          </select>
        <?php
          } elseif ($status == "Inactive") {
        ?>
          <select name="status" class="form-control">
            <option value="Inactive">Inactive</option>
            <option value="Active">Active</option>
          </select>
      <?php
          }
}
        ?>
      </div>
      </div>
    </div>
  </div>
      <div class="box-footer clearfix">
        <button value="<?php echo $id; ?>" type="submit" name="update_minor_offense" class="btn btn-primary pull-left"> Update</button>
      </div>
  </div>
  </section>
</form> 
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/administrator/overall-footer.php';
?>