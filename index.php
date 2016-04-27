<!-- This Page is/are for Students -->
<?php 
require 'app/controller/init.php';
protect_page_profile();
require 'app/controller/student/login_credential.php';
require 'app/view/student/overall-header.php';


?>
<!-- === Insert Student Content === -->
<style>
#myBtn {
    width: 300px;
    padding: 10px;
    font-size:20px;
    position: absolute;
    margin: 0 auto;
    right: 0;
    left: 0;
    bottom: 50px;
    z-index: 9999;
}
</style>
<!-- =========================================================== -->
<section class="content-header">
<?php
if (two_violation_count($student_id) == 2) {
  update_ticket_flagged($student_id);
?>
<div class="callout callout-danger">
  <h4><i class="icon fa fa-warning"></i>  &nbsp Alert</h4>
  <p>Please be advised that you have commited 2 Dress Code Violation. Commiting another Violation can mean a suspension.</p>
</div>
<?php
}
?>
</section>

<section class="content">
<div class="row">
<?php  
if (student_has_notification($id)) {
?>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3 style="font-size: 32px;">Notice</h3>
        <p>Disciplinary Officer</p>
      </div>
      <div class="icon">
        <i class="fa fa-envelope-o"></i>
      </div>
      <a href="notification.php?r=<?php echo base64_encode(encode_notification($id)); ?>" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

<div class="modal fade modal-warning" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-info"></i> Notice from the Disciplinary Officer</h4>
      </div>
      <div class="modal-body">
        <i class="fa fa-warning"></i> You have <?php echo number_of_notifications($id); echo number_of_notifications($id) > 1 ? " messages" : " message"; ?> that needs to be reviewed upon on.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php  
}

if (status_violation_pending($student_id) == 'Pending' && partial_status_dresscode_pending($student_id) == 0) {
?>
<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-primary">
    <div class="inner">
      <h3 style="font-size: 32px;">Violation</h3>
      <p>Dress Code: Pending</p>
    </div>
    <div class="icon">
      <i class="fa fa-sticky-note-o"></i>
    </div>
    <a href="details.php?r=<?php echo base64_encode(notification_today($student_id)); ?>" class="small-box-footer">
      More info <i class="fa fa-arrow-circle-right"></i>
    </a>
  </div>
</div>
<?php
}

if (status_violation_violated($student_id) == 'Violated' && partial_status_dresscode_violated($student_id) == 0) {
?>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
      <div class="inner">
        <h3 style="font-size: 32px;">Violation</h3>
        <p>Dress Code: Issued</p>
      </div>
      <div class="icon">
        <i class="fa fa-sticky-note-o"></i>
      </div>
      <a href="dresscode_violation.php?r=<?php echo base64_encode(notification_today($student_id)); ?>" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
<?php
}

if (status_violation_excused($student_id) == 'Excused' && partial_status_dresscode_excused($student_id) == 0) {
?>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
        <h3 style="font-size: 32px;">Violation</h3>
        <p>Dress Code: Excused</p>
      </div>
      <div class="icon">
        <i class="fa fa-sticky-note-o"></i>
      </div>
      <a href="excused.php?r=<?php echo base64_encode(notification_today($student_id)); ?>" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
<?php
}
?>
</div>
</div>
</section>
<!-- =========================================================== -->

<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/student/overall-footer.php'
?>