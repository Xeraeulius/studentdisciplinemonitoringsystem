<?php  
if (isset($_POST['btn_minor'])) {
  $student_id = $_POST['btn_minor'];        
  $incident_date = $_POST['incident_date']; 
  $report = $_POST['description'];         

  if (empty($incident_date) && empty($report)) {
    header('Location: offense_report_minor.php?r=' . base64_encode('incomplete_date_incident_and_report'));
  } elseif (empty($incident_date)) {
    header('Location: offense_report_minor.php?r=' . base64_encode('incomplete_date_incident'));
  } elseif (empty($report)) {
    header('Location: offense_report_minor.php?r=' . base64_encode('incomplete_report'));
  } else {

    $offense_details_id = $_SESSION['offense_details_id'];
    $sanctions_minor_id = $_SESSION['sanctions_minor_id'];
    $term = school_term_id();
    $count = minor_offense_exists($student_id, $offense_details_id);

    if ($count == '') {
      $offense_count = "First Offense";
    } elseif ($count == 'First Offense') {
      $offense_count = "Second Offense";
    } elseif ($count == "Second Offense") {
      $offense_count = "Third Offense";
    }

    create_minor_offense_report($student_id, $incident_date, $report, $offense_details_id, $sanctions_minor_id, $term, $offense_count);
  }
}
?>