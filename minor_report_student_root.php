<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_root();
require 'app/controller/root/login-credential-root.php';
require 'app/view/handler/gateway/_offense_minor.php';
require 'app/view/root/overall-header.php';
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
  require 'app/view/handler/redirection/_minor_notification.php';
?>
  <div class="row">
    <div class="col-md-3">
      <div class="box box-solid">
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="minor_offense_list_root.php"> Minor Offense</a></li>
            <li><a href="major_offense_list_root.php"> Major Offense</a></li>
          </ul>
        </div><!-- /.box-body -->
      </div><!-- /. box -->
    </div><!-- /.col -->
    <?php  
      if (isset($_GET['r'])) {
        global $conn;
        $id = base64_decode($_GET['r']);

        $select = "SELECT id_picture, last_name, first_name, middle_name From students where id = $id";
        $query = $conn->query($select);
        while ($row = $query->fetch_object()) {
          $id_picture = $row->id_picture;
          $last_name = $row->last_name;
          $first_name = $row->first_name;
          $middle_name = $row->middle_name;
        }
      }
    ?>
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <img src="<?php echo $id_picture; ?>" width="90" height="90">
          <h3 class="box-title" style="margin-left: 2%;"><?php echo $last_name . ", " . $first_name . " " . $middle_name; ?></h3>
          <div class="box-tools pull-right">
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tr>
                <th>Minor Offense Reference</th>
                <th>Date of Incident</th>
                <th>Number of Offense Committed</th>
                <th></th>
              </tr>
              <tbody>
                <?php relate_minor_offense_root($id); ?>
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