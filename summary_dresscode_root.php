<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_root();
require 'app/controller/root/login-credential-root.php';
require 'app/view/handler/gateway/_dresscode.php';
require 'app/view/root/overall-header.php';
?>
<!-- === Insert Administrator Content === -->
<section class="content-header">
  <h1>
    Dress Code Violation Report
    <small>Infringement of Dress Code Violation: <?php echo school_term() . " Term"; ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
  </ol> 
</section>
<section class="content">
<?php  
if (isset($_GET['p'])) {
  $success = base64_decode($_GET['p']);
  if ($success == $s) {
?>
<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <p><i class="icon fa fa-check"></i> Dress Code Violation Ticket Updated</p>
</div>  
<?php
  }
}
?>
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
          <div class="box-tools pull-right">

          </div><!-- /.box-tools -->
        <div class="box-body no-padding">
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tr>
                <th></th>
                <th>Name</th>
                <th></th>
              </tr>
              <tbody>
                <?php student_summary_dresscode_root(); ?>
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