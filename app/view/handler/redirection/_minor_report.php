<?php  
if (isset($_POST['minor_submit'])) {
  if (empty($_POST['student_name']) && empty($_POST['sanctions_minor'])) {
    header('Location: student_minor_offense_report.php?r=' . base64_encode('missing_fields'));
  } elseif (empty($_POST['student_name'])) {
    header('Location: student_minor_offense_report.php?r=' . base64_encode('missing_name'));
  } elseif (empty($_POST['sanctions_minor'])) {
    header('Location: student_minor_offense_report.php?r=' . base64_encode('missing_minor_sanctions'));
  } else {
	  $_SESSION['student_name'] = $_POST['student_name'];
	  $_SESSION['sanctions_minor'] = $_POST['sanctions_minor'];

	  $student_id = $_SESSION['student_name'];
	  $sanctions_id = $_SESSION['sanctions_minor'];
  }
}
?>