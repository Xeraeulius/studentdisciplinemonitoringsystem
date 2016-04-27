<?php  
if (isset($_POST['btn_closed'])) {
  global $conn;
  $closed_id = $_POST['btn_closed'];
  $update = "UPDATE message_details SET status = 'Closed' where id = $closed_id";
  $result = $conn->query($update);
  header('Location: inbox.php?r=' . base64_encode('status_message_updated'));
}
?>