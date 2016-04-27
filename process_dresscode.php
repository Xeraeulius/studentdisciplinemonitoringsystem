<?php  
require 'app/controller/init.php';
protect_page_profile_admin();

if (isset($_POST['btn_submit'])) {
	$status = $_POST['optradio'];
	$violation_id = $_POST['btn_submit'];

	admin_violation_details($violation_id, $status);
}
?>