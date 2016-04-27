<?php
if (isset($_GET['r'])) {
  $decode = base64_decode($_GET['r']);
  if ($decode == "missing_fields") {
?>
<div class="alert alert-danger">
  <i class="icon fa fa-warning"></i>
  Please do not leave <strong><u>Name of Student</u></strong> and <strong><u>Reference Number</u></strong> field blank.
</div>
<?php
  } elseif ($decode == "missing_name") {
?>
<div class="alert alert-danger">
  <i class="icon fa fa-warning"></i>
  Please do not leave <strong><u>Name of Student</u></strong> field blank.
</div>
<?php
  } elseif ($decode == "missing_minor_sanctions") {
?>
<div class="alert alert-danger">
  <i class="icon fa fa-warning"></i>
  Please do not leave <strong><u>Reference Number</u></strong> field blank.
</div>
<?php
  }
}
?>
