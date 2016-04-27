<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/administrator/overall-header.php';

add_sanction_minor();
update_sanction_minor();
?>
<!-- === Insert Administrator Content === -->
<section class="content-header">
  <h1>
    Sanctions
    <small>Minor Offense</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
  </ol> 
</section>

<section class="content">
<?php  
if (isset($_POST['add_sanctions'])) {
?>
<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <p><i class="icon fa fa-check"></i> Sanction Details for Minor Offense has been added.</p>
</div>
<?php
}

if (isset($_POST['update_sanctions'])) {
?>
<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <p><i class="icon fa fa-check"></i> Sanction Details for Minor Offense has been updated.</p>
</div>
<?php
}
?>
  <div class="row">
    <div class="col-md-3">
      <div class="box box-solid">
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="sanctions.php"> Minor Offense</a></li>
            <li><a href="sanctions_major_offense.php"> Major Offense</a></li>
          </ul>
        </div><!-- /.box-body -->
      </div><!-- /. box -->
    </div><!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Minor Offense Sanctions</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
        <label>Reference Number:</label>
        <form action="sanctions_offense.php" method="POST">
        <div class="input-group input-group">
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