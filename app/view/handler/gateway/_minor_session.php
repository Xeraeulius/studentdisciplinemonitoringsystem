<?php  
if (isset($_SESSION['student_name'])) {
  $student_id = $_SESSION['student_name'];
  $sanctions_id = $_SESSION['sanctions_minor'];
  $result = minor_offense_exists($student_id, $sanctions_id);
}

if ($result == "Third Offense") {
  header('Location: minor_offense_list.php?m=' . base64_encode('maximum_capacity'));
}
?>