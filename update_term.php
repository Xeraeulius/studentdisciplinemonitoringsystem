<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/administrator/select2-message.php';

if(isset($_GET['r'])) {
	$id = base64_decode($_GET['r']);
}

$select_list = "SELECT * from school_term where id = '$id'";
$query_list = $conn->query($select_list);

	while ($row_list = $query_list->fetch_object()) {
		$term = $row_list->term;
		$status = $row_list->status;
		$start_date = $row_list->start_date;
		$end_date = $row_list->end_date;
	}
?>

<!-- === Insert Administrator Content === -->
<section class="content-header">
  <h1>
    School Term
    <small></small>
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!--
        <div class="box-header">
          <h3 class="box-title">Insert Title Here</h3>
          <div class="box-tools">
            <div class="input-group" style="width: 150px;">
              <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
              <div class="input-group-btn">
                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>Term</th>
              <th>Status</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th></th>
            </tr>
          <form action="school_term.php" method="POST">
            <tbody>
              <tr>
                <td><input type="text" class="form-control" name="name_term" autocomplete="off" value="<?php echo $term; ?>" /></td>
                <td>
                  <div class="radio">
                  <?php if ($status == 'Inactive') {
                  ?>
                    <label style="margin-left: 30px;"><input type="radio" name="optactive" value="Active">Active</label>
                    <label style="margin-left: 30px;"><input type="radio" name="optactive" value="Inactive" checked>Inactive</label>
                  <?php
                  		} 
                  ?>
                  <?php if ($status == 'Active') {
                  ?>
                    <label style="margin-left: 30px;"><input type="radio" name="optactive" value="Active" checked>Active</label>
                    <label style="margin-left: 30px;"><input type="radio" name="optactive" value="Inactive">Inactive</label>
                  <?php
                  		} 
                  ?>
                  </div>
                </td>
                <td class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" value="<?php echo $start_date; ?>" name="start_date" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                  </div><!-- /.input group -->
                </td>
                <td class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" value="<?php echo $end_date; ?>" name="end_date" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                  </div><!-- /.input group -->
                </td>
                <td><button type="submit" name="update_term" class="btn btn-primary" value="<?php echo $id; ?>">Submit</button></td>
              </tr>
            </tbody>
          </form>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/administrator/select2-footer.php';
?>