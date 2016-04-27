<?php  
if (isset($_SESSION['student_name'])) {
  $student_id = $_SESSION['student_name'];
  $sanctions_id = $_SESSION['sanctions_minor'];
  $result = major_offense_exists($student_id, $sanctions_id);
}

if ($result == "Third Offense") {
  header('Location: major_offense_list.php?m=' . base64_encode('maximum_capacity'));
}
?>