<?php  
if (initialize_token_admin() === TRUE) {
  global $conn;
  $admin_id = $_SESSION['admin_id'];

  $select = "SELECT * from administrator where id = '$admin_id'";
  $result = $conn->query($select);

  if ($result) {
    while ($row = $result->fetch_object()) {
      $first_name = $row->first_name;
      $last_name = $row->last_name;
      $picture = $row->id_picture;
    }
  }
  $role = "ADMINISTRATOR";
}
?>