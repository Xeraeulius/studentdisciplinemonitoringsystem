<?php
if ($result == null) {
  $offense = "First Offense";
  $sql_offense = "first_offense";
} elseif ($result == "First Offense") {
  $offense = "Second Offense";
  $sql_offense = "second_offense";
} elseif ($result == "Second Offense") {
  $offense = "Third Offense";
  $sql_offense = "third_offense";
}

if (isset($_GET['r'])) {
  $decode = base64_decode($_GET['r']);

  if ($decode == 'incomplete_date_incident_and_report') {
?>
<div class="alert alert-danger">
  <i class="icon fa fa-warning"></i>
  Please do not leave <strong><u>Date of Incident</u></strong> and <strong><u>Narrative Report</u></strong> and <strong><u>Status</u></strong> field blank.
</div>
<?php
  } elseif ($decode == 'incomplete_date_incident') {
?>
<div class="alert alert-danger">
  <i class="icon fa fa-warning"></i>
  Please do not leave the <strong><u>Date of Incident</u></strong> field blank.
</div>
<?php
  } elseif ($decode == 'incomplete_report') {
?>
<div class="alert alert-danger">
  <i class="icon fa fa-warning"></i>
  Please do not leave the <strong><u>Narrative Report</u></strong> field blank.
</div>
<?php
  } elseif ($decode == 'incomplete_status') {
?>
<div class="alert alert-danger">
  <i class="icon fa fa-warning"></i>
  Please do not leave the <strong><u>Status</u></strong> field blank.
</div>
<?php
  }
}
?>