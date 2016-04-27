<?php  
if (initialize_token_root() === TRUE) {
  global $conn;
  $admin_id = $_SESSION['root_id'];

  $select = "SELECT * from administrator where id = '$admin_id'";
  $result = $conn->query($select);

  if ($result) {
    while ($row = $result->fetch_object()) {
      $first_name = $row->first_name;
      $last_name = $row->last_name;
      $picture = $row->id_picture;
    }
  }
  $role = "ROOT";
}
?>