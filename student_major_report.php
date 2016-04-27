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
    Student Offenses
    <small>Major Offense: <?php echo school_term() . " Term"; ?></small>
  </h1>
	<ol class="breadcrumb">
		<li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>	
</section>
<section class="content">
<?php  
  require 'app/view/handler/redirection/_minor_notification.php';
?>
  <div class="row">
    <div class="col-md-3">
      <a href="major_offense_report.php" class="btn btn-primary btn-block margin-bottom">Major Offense Report</a>
      <div class="box box-solid">
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="minor_offense_list.php"> Minor Offense</a></li>
            <li class="active"><a href="major_offense_list.php"> Major Offense</a></li>
          </ul>
        </div><!-- /.box-body -->
      </div><!-- /. box -->
    </div><!-- /.col -->
    <?php  
      if (isset($_GET['r'])) {
        $id = base64_decode($_GET['r']);

        $count = getting_offense_count($id);
        if ($count == "-") {
          case_report_major($id);
        } elseif ($count == "First Offense") {
          first_offense_major($id);
        } elseif ($count == "Second Offense") {
          second_offense_major($id);
        } elseif ($count == "Third Offense") {
          third_offense_major($id);
        }
      }
    ?>
  </div><!-- /.row -->
</section><!-- /.content -->
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/administrator/overall-footer.php';
?>