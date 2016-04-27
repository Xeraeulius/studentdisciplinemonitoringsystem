<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/handler/gateway/_offense_minor.php';
require 'app/view/administrator/overall-header.php';
?>
<!-- === Insert Administrator Content === -->
<section class="content-header">
  <h1>
    Dress Code Violation Report
    <small>Summary: <?php echo school_term() . " Term"; ?></small>
  </h1>
	<ol class="breadcrumb">
		<li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>	
</section>

<?php  
if (isset($_GET['r'])) {
  $student_id = base64_decode($_GET['r']);

  global $conn;
  $select = "SELECT students.first_name,
                    students.last_name,
                    students.middle_name,
                    students.student_id,
                    students.id_picture
             FROM   students
             WHERE  students.student_id = '$student_id'";
  $query = $conn->query($select);
  if ($select) {
    while ($row = $query->fetch_object()) {
      $student_picture = $row->id_picture;
      $id_number = $row->student_id;
      $first_name = $row->first_name;
      $last_name = $row->last_name;
      $middle_name = $row->middle_name;
?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
          <div class="box-header">
            <img src="<?php echo $student_picture; ?>" width="90" height="90">
            <h3 class="box-title" style="margin-left: 2%;"><?php echo $last_name . ', ' . $first_name . ' ' . $middle_name; ?></h3>
          </div>
        <div class="box-body no-padding">
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover">
              <tr>
                <th></th>
                <th>Name</th>
                <th>Date of Violation</th>
                <th></th>
              </tr>
              <tbody>
                <?php summary_student_dresscode($student_id); ?>
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
    }
  }
}
require 'app/view/administrator/overall-footer.php';
?>