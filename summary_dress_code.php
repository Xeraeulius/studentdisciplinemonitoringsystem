<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/administrator/overall-header.php';

student_notification($admin_id);
?>
<!-- === Insert Administrator Content === -->
<section class="content-header">
  <h1>
    Violation Report
    <small>Summary: <?php echo school_term() . " Term"; ?></small>
  </h1>
	<ol class="breadcrumb">
		<li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>	
</section>

<section class="content">
  <div class="row">

  <!-- RIGHT NAV BAR LINK -->
    <div class="col-md-3">
      <div class="box box-solid">
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="summary_dress_code.php"><i class="fa fa-users"></i> Summary of Violation Reports</a></li>
          </ul>
        </div><!-- /.box-body -->
      </div><!-- /. box -->
    </div>
  <!-- END OF RIGHT NAV BAR LINK -->

  <!-- REPORT DETAILS -->
    <div class="col-md-9">
      <div class="box">
        <div class="box-header with-border">
          <center><img src="images/apclogo.png" width="90" height="90"></center>
        </div>

        <br>

        <div class="box-body table-responsive no-padding">
          <!-- DRESS CODE VIOLATORS - TODAY -->
          <div class="col-md-4">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Dress Code Violators - Today</h3>
                <div class="box-tools pull-right">
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="table-responsive mailbox-messages">
                  <table class="table table-hover table-striped">
                    <tr>
                      <th>Male</th>
                      <th>Female</th>
                    </tr>
                    <tbody>
                      <?php 
                        dresscode_violation_today_male(); 
                        dresscode_violation_today_female(); 
                      ?>
                    </tbody>
                  </table><!-- /.table -->
                </div><!-- /.mail-box-messages -->
              </div><!-- /.box-body -->
              <div class="box-footer no-padding">
              </div>
            </div><!-- /.box -->
          </div>
          <!-- END OF DRESS CODE VIOLATORS - TODAY -->

          <!-- DRESS CODE VIOLATORS -->
          <div class="col-md-4">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Dress Code Violators</h3>
                <div class="box-tools pull-right">
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="table-responsive mailbox-messages">
                  <table class="table table-hover table-striped">
                    <tr>
                      <th>Male</th>
                      <th>Female</th>
                    </tr>
                    <tbody>
                      <?php 
                        dresscode_violation_term_male(); 
                        dresscode_violation_term_female(); 
                      ?>
                    </tbody>
                  </table><!-- /.table -->
                </div><!-- /.mail-box-messages -->
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div>
          <!-- END OF DRESS CODE VIOLATORS -->

          <!-- MINOR OFFENSE -->
          <div class="col-md-4">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Minor Offense Violators</h3>
                <div class="box-tools pull-right">
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="table-responsive mailbox-messages">
                  <table class="table table-hover table-striped">
                    <tr>
                      <th>Male</th>
                      <th>Female</th>
                    </tr>
                    <tbody>
                      <?php 
                        minor_offense_term_male(); 
                        minor_offense_term_female(); 
                      ?>
                    </tbody>
                  </table><!-- /.table -->
                </div><!-- /.mail-box-messages -->
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div>
          <!-- END OF MINOR OFFENSE -->
        </div>

        <div class="box-body table-responsive no-padding">

          <!-- MAJOR OFFENSE -->
          <div class="col-md-4">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Major Offense Violators</h3>
                <div class="box-tools pull-right">
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="table-responsive mailbox-messages">
                  <table class="table table-hover table-striped">
                    <tr>
                      <th>Male</th>
                      <th>Female</th>
                    </tr>
                    <tbody>
                      <?php 
                        major_offense_term_male(); 
                        major_offense_term_female(); 
                      ?>
                    </tbody>
                  </table><!-- /.table -->
                </div><!-- /.mail-box-messages -->
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div>
          <!-- END OF MAJOR OFFENSE -->

          <!-- SCHOOLS -->
          <div class="col-md-4">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">School Dress Code Violators</h3>
                <div class="box-tools pull-right">
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="table-responsive mailbox-messages">
                  <table class="table table-hover table-striped">
                    <tr>
                      <th>SOCIT</th>
                      <th>SOM</th>
                      <th>SOE</th>
                      <th>SOMA</th>
                    </tr>
                    <tbody>
                      <?php 
                        dresscode_socit();
                        dresscode_som(); 
                        dresscode_soe(); 
                        dresscode_soma(); 
                      ?>
                    </tbody>
                  </table><!-- /.table -->
                </div><!-- /.mail-box-messages -->
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div>
          <!-- END OF SCHOOLS-->

        </div>

      </div>
    </div>
  <!-- END OF REPORT DETAILS -->

  </div>
</section>
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/administrator/overall-footer.php';
?>