<?php  
if (isset($_GET['r'])) {
  $decode = base64_decode($_GET['r']);
  if ($decode == 'create_offense_success') {
?>
<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <p><i class="icon fa fa-check"></i> Minor Offense Report has been recorded.</p>
</div>
<?php
    unset($_SESSION['student_name']);
  }
}

if (isset($_GET['m'])) {
  $decode = base64_decode($_GET['m']);
  unset($_SESSION['student_name']);
  if ($decode == 'maximum_capacity') {
?>
<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <p><i class="icon fa fa-warning"></i> The Student has already accumulated Three Minor Offenses.</p>
</div>
<?php
  }
}
?>