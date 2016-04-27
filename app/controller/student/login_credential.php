<?php  
if (initialize_token() === TRUE) {
  global $conn;
  $student_id = $_SESSION['student_id'];

  $select = "SELECT * from students where student_id = '$student_id'";
  $result = $conn->query($select);
  $stmt = $result->fetchAll();

    foreach ($stmt as $row) {
      $id = $row['id'];
      $first_name = $row['first_name'];
      $last_name = $row['last_name'];
      $department = $row['department'];
      $course = $row['course'];
      $picture = $row['id_picture'];
    }
}
?>