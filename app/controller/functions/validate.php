<?php 
	##################################### 
	#			STUDENT FUNCTION 		#
	#####################################

	# Check if the corresponding student is logged in
	function initialize_token() {
		return (isset($_SESSION['student_id'])) ? TRUE : FALSE;
	}

/*
	Login Function for Students
*/
	function user_id_from_username($username) {
		global $conn;

		$username = $username;
		$query = "SELECT id FROM students WHERE username = '$username'";
		$select = $conn->query($query);

		while($result = $select->fetch_object()) {
			$result->id;
		}
	}

	function login($username, $password) {
		global $conn;

		$user_id = user_id_from_username($username);
		$password = MD5($password);

		$query = "SELECT COUNT(id) as id FROM students where username = '$username' AND password = '$password'";
		$select = $conn->query($query);

		while($result = $select->fetch_object()) {
			$authenticate = $result->id;
		}

		$valid = ($authenticate == 1) ? $user_id : FALSE;

		return $valid;
	}

	function session_student_login($username) {
		global $conn;

		$query = "SELECT student_id from students where username = '$username'";
		$select = $conn->query($query);

		while ($result = $select->fetch_object()) {
			$student_id = $result->student_id;
		}
		return $student_id;
	}
/*
	--- [- NOTHING FOLLOWS -] ---
*/

	# Determine if the student has Violation
	function student_has_violation($student_id) {
		global $conn;

		$select = "SELECT COUNT(id) as id from violation_details where student_id = '$student_id'";
		$result = $conn->query($select);

		if ($result) {
			while ($row = $result->fetch_object()) {
				$student_violation = $row->id;
			}
		}
		return $student_violation;
	}

	# Determine the number of Appeal Ticket the student created
	function number_appeal_ticket($id) {
		global $conn;

		$select = "SELECT COUNT(id) as id from appeal_ticket WHERE vio_id = '$id'";

		$result = $conn->query($select);

		while ($row = $result->fetch_object()) {
			$count = $row->id;

		}
		return $count;
	}

	# Determine if the Appeal Ticket Was Updated
	function determine_update_ticket($id) {
		global $conn;
		
		$select = "SELECT COUNT(updated_at) as updated from appeal_ticket where vio_id = '$id'";

		$result = $conn->query($select);

		while ($row = $result->fetch_object()) {
			$update = $row->updated;
		}

		return $update;		
	}

	# Display Violation of Student
	function violation_of_student($id) {
		global $conn;
		$select_violations =     "SELECT			violation_code.name
								  FROM				violations
								  LEFT JOIN			violation_code
								  ON				violation_code.violation_code = violations.violation_code
								  WHERE				id = '$id'";
		$result_violations = $conn->query($select_violations);
		while ($row_violations = $result_violations->fetch_object()) {
			echo $violation_of_student = $row_violations->name . "<br/>";
		}
		return $violation_of_student;
	}

	# Submit the Appeal Ticket
	function appeal_ticket($vio_id, $comment) {
		global $conn;

		$insert = "INSERT into appeal_ticket(vio_id, appeal_statement, created_at) VALUES ('$vio_id', '$comment', NOW())";

		$result = $conn->query($insert);
	}

	function update_appeal_ticket($vio_id_update, $update_comment) {
		global $conn;

		$update = "UPDATE appeal_ticket SET appeal_statement = '$update_comment',
											updated_at = NOW()
										WHERE vio_id = '$vio_id_update'";
		$result = $conn->query($update);
	}

	function student_has_notification($student_id) {
		global $conn;

		$select = "SELECT COUNT(student_id) as student_id from message_details where student_id = '$student_id' AND status = 'Pending'";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$id = $row->student_id;
		}

		return $id != 0 ? TRUE : FALSE;
	}

	function number_of_notifications($student_id) {
		global $conn;

		$select = "SELECT COUNT(student_id) as student_id from message_details where student_id = '$student_id' AND status = 'Pending'";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$id = $row->student_id;
		}

		return $id;
	}

	function seen_zoned($student_id) {
		global $conn;

		$select = "SELECT COUNT(partial_seen) as partial_seen from message_details where student_id = '$student_id' AND partial_seen = 0";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$id = $row->partial_seen;
		}

		return $id;
	}

	function null_notification($id) {
		global $conn;

		$select ="SELECT COUNT(message_details.id) as id from message_details where student_id = '$id'";

		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$student_id = $row->id;
		}
		return $student_id;
	}

	function encode_notification($student_id) {
		global $conn;

		$select = "SELECT scheduled_at, id from message_details where student_id = '$student_id'";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$schedule = $row->scheduled_at;
		}

		if (null_notification($student_id)) {
			return $schedule;
		} else {
			return "student_notification";
		}
	}

	function null_violation($id) {
		global $conn;

		$select ="SELECT COUNT(violation_details.created_at) as created_at from violation_details where student_id = '$id' AND status = 'Pending'";

		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$students_id = $row->created_at;
		}
		return $students_id;
	}

	function encode_violation($student_id) {
		global $conn;

		$select = "SELECT created_at from violation_details where student_id = '$student_id'";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$schedule = $row->created_at;
		}

		if (null_violation($student_id)) {
			return $schedule;
		} else {
			return "student_notification";
		}
	}

	function seen_dresscode_pending($student_id) {
		global $conn;

		$select = "SELECT COUNT(status) as status from violation_details where (status = 'Pending') AND student_id = '$student_id'";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$status = $row->status;
		}

		return $status;
	}


	function seen_dresscode_violated($student_id) {
		global $conn;

		$select = "SELECT COUNT(status) as status from violation_details where (status = 'Violated') AND student_id = '$student_id'";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$status = $row->status;
		}

		return $status;
	}

	function seen_dresscode_excused($student_id) {
		global $conn;

		$select = "SELECT COUNT(status) as status from violation_details where (status = 'Excused') AND student_id = '$student_id'";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$status = $row->status;
		}

		return $status;
	}

	function received_notification($student_id) {
		global $conn;

		$select = "SELECT			administrator.last_name as last_name,
									administrator.first_name as first_name,
					                administrator.id_picture as id_picture,
					                message.message_type as subject,
					                DATE_FORMAT(message_details.created_at, '%b %d %Y - %h:%i %p') as created_at,
					               	message_details.id as id
					                
					FROM			message_details

					LEFT JOIN		administrator
					ON				message_details.created_by = administrator.id

					LEFT JOIN		message
					ON				message_details.message_id = message.id

					WHERE 			student_id = '$student_id' AND status = 'Pending'";

		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
	?>
			<tr>
			  <td><img src="<?php echo $row->id_picture; ?>" width="60" height="60"></td>
			  <td><?php echo $row->last_name . ", " . $row->first_name; ?></td>
			  <td><b><?php echo $row->subject; ?></b></td>
			  <td><?php echo $row->created_at; ?></td>
			  <td><button type="submit" name="view_notification" value="<?php echo $row->id ?>" class="btn btn-primary">View</button></td>
			</tr>
	<?php
		}
	}

	function status_violation_pending($student_id) {
		global $conn;

		$select = "SELECT status from violation_details where status = 'Pending' and student_id = '$student_id'";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$status = $row->status;
		}

		if (!empty($status)) {
			return $status;
		}
	}

	function status_violation_violated($student_id) {
		global $conn;

		$select = "SELECT status from violation_details where status = 'Violated' and student_id = '$student_id'";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$status = $row->status;
		}

		if (!empty($status)) {
			return $status;
		}
	}

	function status_violation_excused($student_id) {
		global $conn;

		$select = "SELECT status from violation_details where status = 'Excused' and student_id = '$student_id'";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$status = $row->status;
		}

		if (!empty($status)) {
			return $status;
		}
	}

	function partial_status_dresscode_pending($student_id) {
		global $conn;

		$select = "SELECT partial_seen from violation_details where student_id = '$student_id' AND status = 'Pending'";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$status = $row->partial_seen;
		}

		return $status;
	}

	function partial_status_dresscode_violated($student_id) {
		global $conn;

		$select = "SELECT partial_seen from violation_details where student_id = '$student_id' AND status = 'Violated'";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$status = $row->partial_seen;
		}

		return $status;
	}

	function partial_status_dresscode_excused($student_id) {
		global $conn;

		$select = "SELECT partial_seen from violation_details where student_id = '$student_id' AND status = 'Excused'";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$status = $row->partial_seen;
		}

		return $status;
	}

	##################################### 
	#	   ADMINISTRATOR FUNCTION 		#
	#####################################

	# Check if the administrator is logged in
	function initialize_token_admin() {
		return (isset($_SESSION['admin_id'])) ? TRUE : FALSE;
	}

	function initialize_token_root() {
		return (isset($_SESSION['root_id'])) ? TRUE : FALSE;
	}

/*
	Login Function for Administrator
*/
	function user_id_from_username_admin($username) {
		global $conn;

		$username = $username;
		$query = "SELECT id FROM administrator WHERE username = '$username'";
		$select = $conn->query($query);

		while($result = $select->fetch_object()) {
			$result->id;
		}
	}

	function login_admin($username, $password) {
		global $conn;

		$admin_id = user_id_from_username($username);
		$password = MD5($password);

		$query = "SELECT COUNT(id) as id FROM administrator where username = '$username' AND password = '$password'";
		$select = $conn->query($query);

		while($result = $select->fetch_object()) {
			$authenticate = $result->id;
		}

		$valid = ($authenticate == 1) ? $admin_id : FALSE;

		return $valid;
	}

	function level_access($username) {
		global $conn;

		$select = "SELECT level_access from administrator where username = '$username'";
		$query = $conn->query($select);

		while($row = $query->fetch_object()) {
			$level_access = $row->level_access;
		}
		return $level_access;
	}
	
	function session_admin_login($username) {
		global $conn;

		$query = "SELECT id from administrator where username = '$username'";
		$select = $conn->query($query);

		while ($result = $select->fetch_object()) {
			$admin_id = $result->id;
		}
		return $admin_id;
	}

	function session_root_login($username) {
		global $conn;

		$query = "SELECT id from administrator where username = '$username'";
		$select = $conn->query($query);

		while ($result = $select->fetch_object()) {
			$root_id = $result->id;
		}
		return $root_id;
	}

	function update_violation_list_male() {
		if (isset($_POST['submit_violation_list'])) {
			global $conn; 

			$violation_code = $_POST['submit_violation_list'];
			$optactive = $_POST['optactive'];
			$optgender = $_POST['optgender'];
			$optname = $_POST['optname'];

			$update = "UPDATE violation_code SET name =" . "\"$optname\"" . ", gender = '$optgender', active = '$optactive' 
					   WHERE violation_code = '$violation_code'";
			$result = $conn->query($update);
		}
	}

	function add_violation_list_male() {
		if (isset($_POST['add_violation_code_male'])) {
			global $conn;

			$optname = $_POST['optname'];
			$optactive = $_POST['optactive'];
			$optgender = $_POST['optgender'];

			$insert = "INSERT INTO violation_code(name, gender, active) VALUES(" . "\"$optname\"" . ", '$optgender', '$optactive')";
			$result = $conn->query($insert);
		}
	}

	function add_violation_list_female() {
		if (isset($_POST['add_violation_code_female'])) {
			global $conn;

			$optname = $_POST['optname'];
			$optactive = $_POST['optactive'];
			$optgender = $_POST['optgender'];

			$insert = "INSERT INTO violation_code(name, gender, active) VALUES(" . "\"$optname\"" . ", '$optgender', '$optactive')";
			$result = $conn->query($insert);
		}
	}

	function create_minor_offense() {
		if (isset($_POST['btn_add_minor_offense'])) {
			global $conn;

			$ref_number = $_POST['ref_number'];
			$title = $_POST['title'];
			$description = $_POST['description'];
			$status = $_POST['status'];
			$type = "Minor Offense";

			$insert = "INSERT INTO offense_details(reference_number, description, title, status, type) VALUES('$ref_number'," . "\"$description\"" . ", '$title', '$status', '$type')";
			$result = $conn->query($insert);
		}
	}

	function create_major_offense() {
		if (isset($_POST['btn_add_major_offense'])) {
			global $conn;

			$ref_number = $_POST['ref_number'];
			$title = $_POST['title'];
			$description = $_POST['description'];
			$status = $_POST['status'];
			$type = "Major Offense";

			$insert = "INSERT INTO offense_details(reference_number, description, title, status, type) VALUES('$ref_number'," . "\"$description\"" . ", '$title', '$status', '$type')";
			$result = $conn->query($insert);
		}
	}

	function update_major_offense() {
		if (isset($_POST['update_major_offense'])) {
			global $conn;

			$id = $_POST['update_major_offense'];
			$ref_number = $_POST['ref_number'];
			$title = $_POST['title'];
			$description = $_POST['description'];
			$status = $_POST['status'];

			$update = "UPDATE offense_details SET reference_number = '$ref_number', title = '$title', description = " . "\"$description\"" . ", status = '$status'
					   WHERE id = '$id'";
					   
			$result = $conn->query($update);
		}
	}

	function update_minor_offense() {
		if (isset($_POST['update_minor_offense'])) {
			global $conn;

			$id = $_POST['update_minor_offense'];
			$ref_number = $_POST['ref_number'];
			$title = $_POST['title'];
			$description = $_POST['description'];
			$status = $_POST['status'];

			$update = "UPDATE offense_details SET reference_number = '$ref_number', title = '$title', description = " . "\"$description\"" . ", status = '$status'
					   WHERE id = '$id'";
					   
			$result = $conn->query($update);
		}
	}

	function violation_reports() {
		global $conn;

		$query = "SELECT COUNT(id) as id from violation_details";
		$select = $conn->query($query);

		while ($result = $select->fetch_object()) {
			$violation_report_count = $result->id;
		}
		return $violation_report_count;
	}

	function admin_violation_details($violation_details_id, $radio_button) {
		global $conn;

		$partial_seen = 0;

		$update = "UPDATE violation_details SET status = '$radio_button', partial_seen = '$partial_seen' WHERE id = $violation_details_id";
		$result = $conn->query($update);

		if ($result) {
			header('Location: summary_dresscode_violation.php?p=' . base64_encode('success_update_of_ticket_$!T'));
		}
	}

	function add_message_details() {
		global $conn;

		if (isset($_POST['btn_add'])) {
			$notification_input = $_POST['notification_input'];
			$notification_content = $_POST['notification_content'];

			$insert = "INSERT INTO message(message_type, body) VALUES(" . " \"$notification_input\" " . ", \"$notification_content\")";
			$result = $conn->query($insert);
		}
	}

	function student_notification($admin_id) {
		global $conn;
		
		if (isset($_POST['send'])) {
		  $student_id = $_POST['message_id'];
		  $message_type_id = $_POST['send'];
		  $date = $_POST['btn_date'];
		  $status = 'Pending';
		  
		  $insert = "INSERT INTO message_details(created_by, student_id, message_id, status, scheduled_at, created_at) VALUES ('$admin_id', '$student_id', '$message_type_id', '$status', '$date', NOW())";

		  $result = $conn->query($insert);
		}
	}

	function notification_of_student() {
		global $conn; 

                  $select_notification = "SELECT     students.last_name   	    as last_name,
                                                     students.first_name  		as first_name,
                                                     students.middle_name 		as middle_name,
                                                     students.id          		as student_id,
                                                     students.id_picture   		as student_picture,
                                                     message.message_type  		as message_type,
                                                     message.body         		as content,
                                                     message.id            	    as message_id,
                                                     status,
                                                     DATE_FORMAT(message_details.created_at, '%b %d %Y - %h:%i %p') as created_at

                                          FROM       message_details

                                          LEFT JOIN  students
                                          ON         students.id = message_details.student_id

                                          LEFT JOIN  message
                                          ON         message_details.message_id = message.id

                                          WHERE      status = 'Pending'";

                  $query_notification = $conn->query($select_notification);

                  while ($row = $query_notification->fetch_object()) {
?>
                <tr>
                  <td><img src="<?php echo $row->student_picture; ?>" width="60" height="60"></td>
                  <td><?php echo $row->last_name . ", " . $row->first_name; ?></td>
                  <td><b><?php echo $row->message_type; ?></b></td>
                  <td><b><small class="label label-warning"><?php echo $row->status; ?></small></b></td>
                  <td class="mailbox-date"><?php echo $row->created_at; ?></td>
                </tr>
<?php
                  }
	}

	function archive_notification_of_student() {
		global $conn;

		$select = " SELECT 		students.last_name   	    as last_name,
                            	students.first_name  		as first_name,
                            	students.middle_name 		as middle_name,
                            	students.id          		as student_id,
                            	students.id_picture   		as student_picture,
                            	message.message_type  		as message_type,
                            	message.body         		as content,
                            	message.id            	    as message_id,
                            	message_details.id          as id

                    FROM       	message_details

                    LEFT JOIN  	students
                    ON         	students.id = message_details.student_id

                    LEFT JOIN  	message
                    ON         	message_details.message_id = message.id

                    WHERE      	status = 'Confirm'";
        $query = $conn->query($select);
        while ($row = $query->fetch_object()) {
?>
        <tr>
          <td><img src="<?php echo $row->student_picture; ?>" width="60" height="60"></td>
          <td><?php echo $row->last_name . ", " . $row->first_name; ?></td>
          <td><b><?php echo $row->message_type; ?></b></td>
          <td><button name="btn_reschedule" value="<?php echo $row->id; ?>" type="submit" class="btn btn-primary">Reschedule</button></td>
          <td><button name="btn_closed" value="<?php echo $row->id; ?>" type="submit" class="btn btn-primary">Case Closed</button></td>
        </tr>
<?php
        }
	}

	function update_student_notification($id, $confirmation, $message_id) {
		global $conn;

		$update = "UPDATE message_details SET status = '$confirmation' WHERE id = '$message_id' AND student_id = '$id'";
				   
		$result = $conn->query($update);
	}

	function update_reschedule_notification() {
		global $conn;

		if (isset($_POST['btn_reschedule'])) {
			$id = $_POST['btn_reschedule'];
			$date = $_POST['reschedule_date'];

			$update = "UPDATE message_details SET scheduled_at = '$date', partial_seen = 0, status = 'Pending' where id = $id";
			$result = $conn->query($update);
		}
	}

	function add_school_term() {
		global $conn;
		
		if (isset($_POST['add_term'])) {
		  $term = $_POST['name_term'];
		  $status = $_POST['optactive'];
		  $start_date = $_POST['start_date'];
		  $end_date = $_POST['end_date'];
		  
		  $insert = "INSERT INTO school_term(term, status, start_date, end_date) VALUES ('$term', '$status', '$start_date', '$end_date')";

		  $result = $conn->query($insert);
		}
	}

	function update_school_term() {
		if (isset($_POST['update_term'])) {
		  global $conn; 

		  $term = $_POST['name_term'];
		  $status = $_POST['optactive'];
		  $start_date = $_POST['start_date'];
		  $end_date = $_POST['end_date'];
		  $id = $_POST['update_term'];
		  
		  $insert = "UPDATE school_term SET term = '$term',
		  									status = '$status',
		  									start_date = '$start_date',
		  									end_date = '$end_date'
		  								WHERE id = '$id'";

		  $result = $conn->query($insert);
		}
	}

	function sanction_minor_exists($minor_sanction_id) {
		global $conn;

		$select = "SELECT offense_details_id from sanctions where offense_details_id = $minor_sanction_id";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$id = $row->offense_details_id;
		}

		if (!empty($id)) {
			return $id;
		}
	}

	function sanction_major_exists($major_sanction_id) {
		global $conn;

		$select = "SELECT offense_details_id from sanctions where offense_details_id = $major_sanction_id";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$id = $row->offense_details_id;
		}

		if (!empty($id)) {
			return $id;
		}
	}

	function add_sanction_minor() {
		if (isset($_POST['add_sanctions'])) {
			global $conn;

			$id = $_POST['add_sanctions'];
			$first_offense = $_POST['first_offense'];
			$second_offense = $_POST['second_offense'];
			$third_offense = $_POST['third_offense'];

			$insert = "INSERT INTO sanctions(offense_details_id, first_offense, second_offense, third_offense) VALUES ('$id'," . " \" $first_offense \", " . " \" $second_offense \" , " . " \" $third_offense \")";

			$result = $conn->query($insert);
		}
	}

	function add_sanction_major() {
		if (isset($_POST['add_sanctions'])) {
			global $conn;

			$id = $_POST['add_sanctions'];
			$first_offense = $_POST['first_offense'];
			$second_offense = $_POST['second_offense'];
			$third_offense = $_POST['third_offense'];

			$insert = "INSERT INTO sanctions(offense_details_id, first_offense, second_offense, third_offense) VALUES ('$id'," . " \" $first_offense \", " . " \" $second_offense \" , " . " \" $third_offense \")";

			$result = $conn->query($insert);
		}
	}

	function update_sanction_minor() {
		if (isset($_POST['update_sanctions'])) {
			global $conn;

			$id = $_POST['update_sanctions'];
			$first_offense = $_POST['first_offense'];
			$second_offense = $_POST['second_offense'];
			$third_offense = $_POST['third_offense'];	

		    $update = "UPDATE sanctions   SET   first_offense  = " . " \" $first_offense \" " . ",
		  									    second_offense = \" $second_offense \" " . ",
		  									    third_offense  = \" $third_offense \" " . "
		  								  WHERE offense_details_id = $id";	
		  	$conn->query($update);
		}
	}

	function update_sanction_major() {
		if (isset($_POST['update_sanctions'])) {
			global $conn;

			$id = $_POST['update_sanctions'];
			$first_offense = $_POST['first_offense'];
			$second_offense = $_POST['second_offense'];
			$third_offense = $_POST['third_offense'];	

		    $update = "UPDATE sanctions   SET   first_offense  = " . " \" $first_offense \" " . ",
		  									    second_offense = \" $second_offense \" " . ",
		  									    third_offense  = \" $third_offense \" " . "
		  								  WHERE offense_details_id = $id";	
		  	$conn->query($update);
		}
	}

	function minor_offense_exists($student_id, $sanctions_id) {
		global $conn;

		$select = "SELECT offense_count FROM offenses WHERE (students_id = $student_id AND offense_details_id = $sanctions_id) AND offense_count != '-'";
		$query = $conn->query($select);
		
		while ($row = $query->fetch_object()) {
			$count = $row->offense_count;
		}

		if (!empty($count)) {
			return $count;
		}
	}

	function major_offense_exists($student_id, $sanctions_id) {
		global $conn;

		$select = "SELECT offense_count FROM offenses WHERE (students_id = $student_id AND offense_details_id = $sanctions_id) AND offense_count != '-'";
		$query = $conn->query($select);
		
		while ($row = $query->fetch_object()) {
			$count = $row->offense_count;
		}

		if (!empty($count)) {
			return $count;
		}
	}
	
	##################################### 
	#	    SYSTEM EVENT FUNCTION 	    #
	#####################################

	function count_down() {
		date_default_timezone_set("Asia/Manila");
		$date = date('Y-m-d H:i:s');
		global $conn;

		$select = "SELECT valid_date from violation_details WHERE status = 'Pending'";
		$result = $conn->query($select);
		if ($result) {
			while ($row = $result->fetch_object()) {
				$violation_date = $row->valid_date;

				if ($date >= $violation_date) {
					$date = $violation_date;
					$update = "UPDATE violation_details SET status = 'Violated' where valid_date = '$date'";
					$result_update = $conn->query($update);
				} 
			}
		}
	}

	function seen_clicked($seen_status, $student_id) {
		global $conn;

		$update = "UPDATE message_details SET partial_seen = '$seen_status' WHERE student_id = '$student_id'";

		$result = $conn->query($update);		
	}

	function seen_clicked_violation_pending($seen_status, $student_id) {
		global $conn;

		$update = "UPDATE violation_details SET partial_seen = '$seen_status' WHERE student_id = '$student_id' AND status = 'Pending'";

		$result = $conn->query($update);		
	}

	function seen_clicked_violation_violated($seen_status, $student_id) {
		global $conn;

		$update = "UPDATE violation_details SET partial_seen = '$seen_status' WHERE student_id = '$student_id' AND status = 'Violated'";

		$result = $conn->query($update);		
	}

	function seen_clicked_violation_excused($seen_status, $student_id) {
		global $conn;

		$update = "UPDATE violation_details SET partial_seen = '$seen_status' WHERE student_id = '$student_id' AND status = 'Excused'";

		$result = $conn->query($update);		
	}

	function notification_today($student_id) {
		global $conn;

		$select = "SELECT 	status 
				   FROM 	violation_details 
				   WHERE    (student_id = '$student_id' and partial_seen = 0) AND DATE_FORMAT(created_at, '%d') = DATE_FORMAT(NOW(), '%d')";
		
		$result = $conn->query($select);

		while ($row = $result->fetch_object()) {
			$status = $row->status;
		}

		if (!empty($status)) {
			return $status;
		}
	}

	function two_violation_count($student_id) {
		global $conn;

		$select = "SELECT 	COUNT(violation_details.id) as violations 
				   FROM 	violation_details 
				   WHERE	violation_details.student_id = '$student_id' AND 
					    	(violation_details.status = 'Violated' AND violation_details.ticket = 'Clear')";
    	$result = $conn->query($select);

    	while ($row = $result->fetch_object()) {
    		$violations = $row->violations;
    	}

    	return $violations;
	}

	function update_ticket_flagged($student_id) {
		global $conn;

		$update = "UPDATE violation_details SET ticket = 'Flagged' WHERE student_id = '$student_id' AND status = 'Violated'";

		$result = $conn->query($update);
	}

	function school_year() {
		global $conn;

		$select = "SELECT DISTINCT(EXTRACT(YEAR FROM `end_date`)) as YEAR from school_term WHERE term = '1st'";

		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$year = $row->YEAR;
		}

		echo $year[0];
	}

	function school_term() {
		global $conn;

		$select = "SELECT term from school_term WHERE status = 'Active'";

		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$term = $row->term;
		}

		if (!empty($term)) {
			return $term;
		}
	}

	function school_term_id() {
		global $conn;

		$select = "SELECT id from school_term WHERE status = 'Active'";

		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$term = $row->id;
		}

		if (!empty($term)) {
			return $term;
		}
	}

	function create_minor_offense_report($student_id, $incident_date, $report, $offense_details_id, $sanctions_minor_id, $term, $offense_count, $status) {
		global $conn;

		$insert = "INSERT INTO offenses(
										offense_details_id, 
										students_id,
										sanctions_id,
										narrative_report,
										status,
										date_created,
										date_incident,
										school_term_id,
										offense_count
									   )
							    VALUES (
							   			'$offense_details_id',
							   			'$student_id',
							   			'$sanctions_minor_id',
							   			" . " \" $report \" " . ",
							   			'$status',
							   			 NOW(),
							   			'$incident_date',
							   			'$term',
							   			'$offense_count'
									   )";
		$query = $conn->query($insert);

		return header('Location: minor_offense_list.php?r=' . base64_encode('create_offense_success'));
	}

	function create_major_offense_report($student_id, $incident_date, $report, $offense_details_id, $sanctions_minor_id, $term, $offense_count, $status) {
		global $conn;

		$insert = "INSERT INTO offenses(
										offense_details_id, 
										students_id,
										sanctions_id,
										narrative_report,
										status,
										date_created,
										date_incident,
										school_term_id,
										offense_count
									   )
							    VALUES (
							   			'$offense_details_id',
							   			'$student_id',
							   			'$sanctions_minor_id',
							   			" . " \" $report \" " . ",
							   			'$status',
							   			 NOW(),
							   			'$incident_date',
							   			'$term',
							   			'$offense_count'
									   )";
		$query = $conn->query($insert);

		return header('Location: major_offense_list.php?r=' . base64_encode('create_offense_success'));
	}

	function student_has_major_offense() {
		global $conn;
		$term = school_term();

		$select = "SELECT DISTINCT	  students.last_name,
								  	  students.first_name,
					              	  students.middle_name,
					              	  students.id_picture,
					              	  students.id,
					              	  school_term.term
					              
					FROM		  offenses

					LEFT JOIN	  school_term
					ON			  offenses.school_term_id = school_term.id

					LEFT JOIN	  students
					ON			  offenses.students_id = students.id

					LEFT JOIN	  offense_details
					ON			  offenses.offense_details_id = offense_details.id

					WHERE		  offense_details.type = 'Major Offense' AND (school_term.term = '$term' AND school_term.status = 'Active')";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
?>
	       <tr>
	          <td><img src="<?php echo $row->id_picture; ?>" width="60" height="60"></td>
	          <td><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></td>
	          <td><a href="major_report_student.php?r=<?php echo base64_encode($row->id); ?>"<button type="submit" name="student_id" class="btn btn-primary">View</button></a></td>
	        </tr>
<?php
		}		
	}

	function student_has_major_offense_root() {
		global $conn;
		$term = school_term();

		$select = "SELECT DISTINCT	  students.last_name,
								  	  students.first_name,
					              	  students.middle_name,
					              	  students.id_picture,
					              	  students.id,
					              	  school_term.term
					              
					FROM		  offenses

					LEFT JOIN	  school_term
					ON			  offenses.school_term_id = school_term.id

					LEFT JOIN	  students
					ON			  offenses.students_id = students.id

					LEFT JOIN	  offense_details
					ON			  offenses.offense_details_id = offense_details.id

					WHERE		  offense_details.type = 'Major Offense' AND (school_term.term = '$term' AND school_term.status = 'Active')";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
?>
	       <tr>
	          <td><img src="<?php echo $row->id_picture; ?>" width="60" height="60"></td>
	          <td><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></td>
	          <td><a href="major_report_student_root.php?r=<?php echo base64_encode($row->id); ?>"<button type="submit" name="student_id" class="btn btn-primary">View</button></a></td>
	        </tr>
<?php
		}		
	}

	function student_has_minor_offense() {
		global $conn;
		$term = school_term();

		$select = "SELECT DISTINCT	  students.last_name,
								  	  students.first_name,
					              	  students.middle_name,
					              	  students.id_picture,
					              	  students.id,
					              	  school_term.term
					              
					FROM		  offenses

					LEFT JOIN	  school_term
					ON			  offenses.school_term_id = school_term.id

					LEFT JOIN	  students
					ON			  offenses.students_id = students.id

					LEFT JOIN	  offense_details
					ON			  offenses.offense_details_id = offense_details.id

					WHERE		  offense_details.type = 'Minor Offense' AND (school_term.term = '$term' AND school_term.status = 'Active')";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
?>
	       <tr>
	          <td><img src="<?php echo $row->id_picture; ?>" width="60" height="60"></td>
	          <td><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></td>
	          <td><a href="minor_report_student.php?r=<?php echo base64_encode($row->id); ?>"<button type="submit" name="student_id" class="btn btn-primary">View</button></a></td>
		        </tr>
	        </tr>
<?php
		}	
	}

	function student_has_minor_offense_root() {
		global $conn;
		$term = school_term();

		$select = "SELECT DISTINCT	  students.last_name,
								  	  students.first_name,
					              	  students.middle_name,
					              	  students.id_picture,
					              	  students.id,
					              	  school_term.term
					              
					FROM		  offenses

					LEFT JOIN	  school_term
					ON			  offenses.school_term_id = school_term.id

					LEFT JOIN	  students
					ON			  offenses.students_id = students.id

					LEFT JOIN	  offense_details
					ON			  offenses.offense_details_id = offense_details.id

					WHERE		  offense_details.type = 'Minor Offense' AND (school_term.term = '$term' AND school_term.status = 'Active')";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
?>
	       <tr>
	          <td><img src="<?php echo $row->id_picture; ?>" width="60" height="60"></td>
	          <td><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></td>
	          <td><a href="minor_report_student_root.php?r=<?php echo base64_encode($row->id); ?>"<button type="submit" name="student_id" class="btn btn-primary">View</button></a></td>
		        </tr>
	        </tr>
<?php
		}	
	}

	function student_summary_dresscode() {
		global $conn;
		$school_term = school_term_id();

		$select = "SELECT DISTINCT		students.student_id,
									    students.last_name,
							            students.first_name,
							            students.middle_name,
							            students.id_picture

					FROM		students


					INNER JOIN   violation_details
					ON           violation_details.student_id = students.student_id

					WHERE		violation_details.status = 'Violated' AND violation_details.school_term_id = $school_term

					ORDER BY 	students.last_name ASC";
		$query = $conn->query($select);

		if ($query) {
			while ($row = $query->fetch_object()) {
?>
		       <tr>
		          <td><img src="<?php echo $row->id_picture; ?>" width="60" height="60"></td>
		          <td><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></td>
		          <td><a href="student_dresscode_report.php?r=<?php echo base64_encode($row->student_id); ?>"<button type="submit" name="student_id" class="btn btn-primary">View</button></a></td>
		        </tr>
<?php
			}
		}
	}

	function student_summary_dresscode_root() {
		global $conn;
		$school_term = school_term_id();

		$select = "SELECT DISTINCT		students.student_id,
									    students.last_name,
							            students.first_name,
							            students.middle_name,
							            students.id_picture

					FROM		students


					INNER JOIN   violation_details
					ON           violation_details.student_id = students.student_id

					WHERE		(violation_details.status = 'Violated' || violation_details.status = 'Excused') AND violation_details.school_term_id = $school_term

					ORDER BY 	students.last_name ASC";
		$query = $conn->query($select);

		if ($query) {
			while ($row = $query->fetch_object()) {
?>
		       <tr>
		          <td><img src="<?php echo $row->id_picture; ?>" width="60" height="60"></td>
		          <td><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></td>
		          <td><a href="student_dresscode_report_root.php?r=<?php echo base64_encode($row->student_id); ?>"<button type="submit" name="student_id" class="btn btn-primary">View</button></a></td>
		        </tr>
<?php
			}
		}
	}

	function summary_student_dresscode($id) {
		global $conn;

		$school_term = school_term_id();
		$select = "SELECT          					   		    disciplinary_personnels.dp_id,
												                disciplinary_personnels.dp_picture,
												                disciplinary_personnels.last_name   AS dp_last_name,
												                disciplinary_personnels.first_name  AS dp_first_name,
												                disciplinary_personnels.middle_name AS dp_middle_name,
												                
												                DATE_FORMAT(violation_details.created_at, '%a - %b %d, %Y - %h:%i %p') AS created_at,
												                violation_details.status,
												                violation_details.id AS violation_id,
		                                                       
		                                                        violation_details.school_term_id,
												                
												                students.student_id,
												                students.id_picture,
												                students.last_name,
												                students.first_name,
												                students.middle_name
										                
										FROM                    violation_details

										INNER JOIN              disciplinary_personnels 
										ON disciplinary_personnels.dp_id = violation_details.dp_id

										INNER JOIN              students 
										ON students.student_id = violation_details.student_id
                                        
                                        LEFT JOIN				school_term
                                        ON						violation_details.school_term_id = school_term.id
                                        
										WHERE (violation_details.status = 'Violated' AND violation_details.school_term_id = $school_term) AND students.student_id = '$id'";

		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
?>
	       <tr>
				<td><img src="<?php echo $row->dp_picture; ?>" width="60" height="60"></td>
				<td><?php echo $row->dp_last_name . ", " . $row->dp_first_name . " " . $row->dp_middle_name; ?></td>
				<td><?php echo $row->created_at; ?></td>
	          	<td><a href="dresscode_report.php?r=<?php echo base64_encode($row->violation_id); ?>"<button type="submit" name="student_id" class="btn btn-primary">Update</button></a></td>
	        </tr>
<?php
		}
	}

	function summary_student_dresscode_root($id) {
		global $conn;

		$school_term = school_term_id();
		$select = "SELECT          					   		    disciplinary_personnels.dp_id,
												                disciplinary_personnels.dp_picture,
												                disciplinary_personnels.last_name   AS dp_last_name,
												                disciplinary_personnels.first_name  AS dp_first_name,
												                disciplinary_personnels.middle_name AS dp_middle_name,
												                
												                DATE_FORMAT(violation_details.created_at, '%a - %b %d, %Y - %h:%i %p') AS created_at,
												                violation_details.status,
												                violation_details.id AS violation_id,
		                                                       
		                                                        violation_details.school_term_id,
												                
												                students.student_id,
												                students.id_picture,
												                students.last_name,
												                students.first_name,
												                students.middle_name
										                
										FROM                    violation_details

										INNER JOIN              disciplinary_personnels 
										ON disciplinary_personnels.dp_id = violation_details.dp_id

										INNER JOIN              students 
										ON students.student_id = violation_details.student_id
                                        
                                        LEFT JOIN				school_term
                                        ON						violation_details.school_term_id = school_term.id
                                        
										WHERE (violation_details.status = 'Violated' || violation_details.status = 'Excused') AND (violation_details.school_term_id = $school_term AND students.student_id = '$id')";

		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
?>
	       <tr>
				<td><img src="<?php echo $row->dp_picture; ?>" width="60" height="60"></td>
				<td><?php echo $row->dp_last_name . ", " . $row->dp_first_name . " " . $row->dp_middle_name; ?></td>
				<td><?php echo $row->created_at; ?></td>
	          	<td><a href="dresscode_report_root.php?r=<?php echo base64_encode($row->violation_id); ?>"<button type="submit" name="student_id" class="btn btn-primary">View</button></a></td>
	        </tr>
<?php
		}
	}

	function relate_minor_offense($student_id) {
		global $conn;

		$select = "SELECT			offenses.id,
									offense_details.reference_number,
									offense_details.title,
									DATE_FORMAT(offenses.date_incident,'%b %d %Y - %h:%i %p') as date_incident,
					                offenses.offense_count

					FROM			offenses

					LEFT JOIN		offense_details
					ON				offenses.offense_details_id = offense_details.id

					LEFT JOIN		students
					ON				offenses.students_id = students.id

					WHERE			students.id = $student_id AND offense_details.type = 'Minor Offense'";

		$query = $conn->query($select);

		while($row = $query->fetch_object()) {
?>
	       <tr>
	          <td><?php echo $row->reference_number . " - " . $row->title; ?></td>
	          <td><?php echo $row->date_incident; ?></td>
	          <td><?php echo $row->offense_count; ?></td>
	          <td><a href="student_minor_report.php?r=<?php echo base64_encode($row->id); ?>"<button type="submit" name="student_id" class="btn btn-primary">View</button></a></td>
	        </tr>
<?php
		}
	}

	function relate_minor_offense_root($student_id) {
		global $conn;

		$select = "SELECT			offenses.id,
									offense_details.reference_number,
									offense_details.title,
									DATE_FORMAT(offenses.date_incident,'%b %d %Y - %h:%i %p') as date_incident,
					                offenses.offense_count

					FROM			offenses

					LEFT JOIN		offense_details
					ON				offenses.offense_details_id = offense_details.id

					LEFT JOIN		students
					ON				offenses.students_id = students.id

					WHERE			students.id = $student_id AND offense_details.type = 'Minor Offense'";

		$query = $conn->query($select);

		while($row = $query->fetch_object()) {
?>
	       <tr>
	          <td><?php echo $row->reference_number . " - " . $row->title; ?></td>
	          <td><?php echo $row->date_incident; ?></td>
	          <td><?php echo $row->offense_count; ?></td>
	          <td><a href="student_minor_report_root.php?r=<?php echo base64_encode($row->id); ?>"<button type="submit" name="student_id" class="btn btn-primary">View</button></a></td>
	        </tr>
<?php
		}
	}

	function relate_major_offense($student_id) {
		global $conn;

		$select = "SELECT			offenses.id,
									offense_details.reference_number,
									offense_details.title,
									DATE_FORMAT(offenses.date_incident,'%b %d %Y - %h:%i %p') as date_incident,
					                offenses.offense_count

					FROM			offenses

					LEFT JOIN		offense_details
					ON				offenses.offense_details_id = offense_details.id

					LEFT JOIN		students
					ON				offenses.students_id = students.id

					WHERE			students.id = $student_id AND offense_details.type = 'Major Offense'";

		$query = $conn->query($select);

		while($row = $query->fetch_object()) {
?>
	       <tr>
	          <td><?php echo $row->reference_number . " - " . $row->title; ?></td>
	          <td><?php echo $row->date_incident; ?></td>
	          <td><?php echo $row->offense_count; ?></td>
	          <td><a href="student_major_report.php?r=<?php echo base64_encode($row->id); ?>"<button type="submit" name="student_id" class="btn btn-primary">View</button></a></td>
	        </tr>
<?php
		}
	}

	function relate_major_offense_root($student_id) {
		global $conn;

		$select = "SELECT			offenses.id,
									offense_details.reference_number,
									offense_details.title,
									DATE_FORMAT(offenses.date_incident,'%b %d %Y - %h:%i %p') as date_incident,
					                offenses.offense_count

					FROM			offenses

					LEFT JOIN		offense_details
					ON				offenses.offense_details_id = offense_details.id

					LEFT JOIN		students
					ON				offenses.students_id = students.id

					WHERE			students.id = $student_id AND offense_details.type = 'Major Offense'";

		$query = $conn->query($select);

		while($row = $query->fetch_object()) {
?>
	       <tr>
	          <td><?php echo $row->reference_number . " - " . $row->title; ?></td>
	          <td><?php echo $row->date_incident; ?></td>
	          <td><?php echo $row->offense_count; ?></td>
	          <td><a href="student_major_report_root.php?r=<?php echo base64_encode($row->id); ?>"<button type="submit" name="student_id" class="btn btn-primary">View</button></a></td>
	        </tr>
<?php
		}
	}

	function getting_offense_count($id) {
		global $conn;

		$select = "SELECT offense_count from offenses where id = $id";
		$query = $conn->query($select);
		while ($row = $query->fetch_object()) {
			$offense = $row->offense_count;
		}
		return $offense;
	}

	function first_offense_minor($id) {
		global $conn;

		$select = "SELECT		offense_details.reference_number,
								offense_details.title,
								offense_details.description,
					            offenses.narrative_report,
					            offenses.date_incident,
					            sanctions.first_offense,
					            students.id_picture,
		                        students.last_name,
            					students.first_name,
            					students.middle_name

					FROM		offenses

					LEFT JOIN	offense_details
					ON			offenses.offense_details_id = offense_details.id

					LEFT JOIN	sanctions
					ON			offenses.sanctions_id = sanctions.id

					LEFT JOIN	students
					ON			offenses.students_id = students.id

					WHERE		(offenses.offense_count = 'First Offense' AND offense_details.type = 'Minor Offense') AND offenses.id = $id";

		$query = $conn->query($select);
		while ($row = $query->fetch_object()) {
?>
			<div class="col-md-9">
				<div class="box box-primary">
				<div class="box-header with-border">
					<img src="<?php echo $row->id_picture; ?>" width="90" height="90">
					<h3 class="box-title" style="margin-left: 2%;"><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></h3>
				</div><!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
							<label>Reference Number: </label>
							<input class="form-control" disabled value="<?php echo $row->reference_number . " - " . $row->title; ?>">
						</div>
				        <div class="form-group">
				          <label>Date of Incident</label>
				          <div class="input-group">
				            <div class="input-group-addon">
				              <i class="fa fa-calendar"></i>
				            </div>
				            <input type="text" class="form-control" disabled value="<?php echo $row->date_incident; ?>" name="incident_date" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="">
				          </div>
				        </div>
				        <div class="form-group">
				          <label>Description:</label>
				          <div class="callout callout-warning">
				            <p><?php echo $row->description; ?></p>
				          </div>
				        </div>
				        <div class="form-group">
				          <label>Sanctions:</label>
				          <input name="offense" class="form-control" disabled value="<?php echo $row->first_offense; ?>" autocomplete="off">
				        </div>
				        <div class="form-group">
				          <label>Narrative Report:</label>
				          <textarea name="description" disabled="" class="form-control" rows="10"><?php echo $row->narrative_report; ?></textarea>
				        </div>
					</div>
				</div>
			</div>
<?php
		}
	}

	function first_offense_major($id) {
		global $conn;

		$select = "SELECT		offense_details.reference_number,
								offense_details.title,
								offense_details.description,
					            offenses.narrative_report,
					            offenses.date_incident,
					            sanctions.first_offense,
		                        students.last_name,
            					students.first_name,
            					students.middle_name

					FROM		offenses

					LEFT JOIN	offense_details
					ON			offenses.offense_details_id = offense_details.id

					LEFT JOIN	sanctions
					ON			offenses.sanctions_id = sanctions.id

					LEFT JOIN	students
					ON			offenses.students_id = students.id

					WHERE		(offenses.offense_count = 'First Offense' AND offense_details.type = 'Major Offense') AND offenses.id = $id";

		$query = $conn->query($select);
		while ($row = $query->fetch_object()) {
?>
			<div class="col-md-9">
				<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></h3>
				</div><!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
							<label>Reference Number: </label>
							<input class="form-control" disabled value="<?php echo $row->reference_number . " - " . $row->title; ?>">
						</div>
				        <div class="form-group">
				          <label>Date of Incident</label>
				          <div class="input-group">
				            <div class="input-group-addon">
				              <i class="fa fa-calendar"></i>
				            </div>
				            <input type="text" class="form-control" disabled value="<?php echo $row->date_incident; ?>" name="incident_date" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="">
				          </div>
				        </div>
				        <div class="form-group">
				          <label>Description:</label>
				          <div class="callout callout-danger">
				            <p><?php echo $row->description; ?></p>
				          </div>
				        </div>
				        <div class="form-group">
				          <label>Sanctions:</label>
				          <input name="offense" class="form-control" disabled value="<?php echo $row->first_offense; ?>" autocomplete="off">
				        </div>
				        <div class="form-group">
				          <label>Narrative Report:</label>
				          <textarea name="description" disabled="" class="form-control" rows="10"><?php echo $row->narrative_report; ?></textarea>
				        </div>
					</div>
				</div>
			</div>
<?php
		}	
	}

	function second_offense_major($id) {
		global $conn;

		$select = "SELECT		offense_details.reference_number,
								offense_details.title,
								offense_details.description,
					            offenses.narrative_report,
					            offenses.date_incident,
					            sanctions.second_offense,
		                        students.last_name,
            					students.first_name,
            					students.middle_name

					FROM		offenses

					LEFT JOIN	offense_details
					ON			offenses.offense_details_id = offense_details.id

					LEFT JOIN	sanctions
					ON			offenses.sanctions_id = sanctions.id

					LEFT JOIN	students
					ON			offenses.students_id = students.id

					WHERE		(offenses.offense_count = 'Second Offense' AND offense_details.type = 'Major Offense') AND offenses.id = $id";

		$query = $conn->query($select);
		while ($row = $query->fetch_object()) {
?>
			<div class="col-md-9">
				<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></h3>
				</div><!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
							<label>Reference Number: </label>
							<input class="form-control" disabled value="<?php echo $row->reference_number . " - " . $row->title; ?>">
						</div>
				        <div class="form-group">
				          <label>Date of Incident</label>
				          <div class="input-group">
				            <div class="input-group-addon">
				              <i class="fa fa-calendar"></i>
				            </div>
				            <input type="text" class="form-control" disabled value="<?php echo $row->date_incident; ?>" name="incident_date" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="">
				          </div>
				        </div>
				        <div class="form-group">
				          <label>Description:</label>
				          <div class="callout callout-danger">
				            <p><?php echo $row->description; ?></p>
				          </div>
				        </div>
				        <div class="form-group">
				          <label>Sanctions:</label>
				          <input name="offense" class="form-control" disabled value="<?php echo $row->second_offense; ?>" autocomplete="off">
				        </div>
				        <div class="form-group">
				          <label>Narrative Report:</label>
				          <textarea name="description" disabled="" class="form-control" rows="10"><?php echo $row->narrative_report; ?></textarea>
				        </div>
					</div>
				</div>
			</div>
<?php
		}
	}

	function second_offense_minor($id) {
		global $conn;

		$select = "SELECT		offense_details.reference_number,
								offense_details.title,
								offense_details.description,
					            offenses.narrative_report,
					            offenses.date_incident,
					            sanctions.second_offense,
		                        students.last_name,
            					students.first_name,
            					students.middle_name

					FROM		offenses

					LEFT JOIN	offense_details
					ON			offenses.offense_details_id = offense_details.id

					LEFT JOIN	sanctions
					ON			offenses.sanctions_id = sanctions.id

					LEFT JOIN	students
					ON			offenses.students_id = students.id

					WHERE		(offenses.offense_count = 'Second Offense' AND offense_details.type = 'Minor Offense') AND offenses.id = $id";

		$query = $conn->query($select);
		while ($row = $query->fetch_object()) {
?>
			<div class="col-md-9">
				<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></h3>
				</div><!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
							<label>Reference Number: </label>
							<input class="form-control" disabled value="<?php echo $row->reference_number . " - " . $row->title; ?>">
						</div>
				        <div class="form-group">
				          <label>Date of Incident</label>
				          <div class="input-group">
				            <div class="input-group-addon">
				              <i class="fa fa-calendar"></i>
				            </div>
				            <input type="text" class="form-control" disabled value="<?php echo $row->date_incident; ?>" name="incident_date" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="">
				          </div>
				        </div>
				        <div class="form-group">
				          <label>Description:</label>
				          <div class="callout callout-warning">
				            <p><?php echo $row->description; ?></p>
				          </div>
				        </div>
				        <div class="form-group">
				          <label>Sanctions:</label>
				          <input name="offense" class="form-control" disabled value="<?php echo $row->second_offense; ?>" autocomplete="off">
				        </div>
				        <div class="form-group">
				          <label>Narrative Report:</label>
				          <textarea name="description" disabled="" class="form-control" rows="10"><?php echo $row->narrative_report; ?></textarea>
				        </div>
					</div>
				</div>
			</div>
<?php
		}
	}

	function third_offense_major($id) {
		global $conn;

		$select = "SELECT		offense_details.reference_number,
								offense_details.title,
								offense_details.description,
					            offenses.narrative_report,
					            offenses.date_incident,
					            sanctions.third_offense,
		                        students.last_name,
            					students.first_name,
            					students.middle_name

					FROM		offenses

					LEFT JOIN	offense_details
					ON			offenses.offense_details_id = offense_details.id

					LEFT JOIN	sanctions
					ON			offenses.sanctions_id = sanctions.id

					LEFT JOIN	students
					ON			offenses.students_id = students.id

					WHERE		(offenses.offense_count = 'Third Offense' AND offense_details.type = 'Major Offense') AND offenses.id = $id";

		$query = $conn->query($select);
		while ($row = $query->fetch_object()) {
?>
			<div class="col-md-9">
				<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></h3>
				</div><!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
							<label>Reference Number: </label>
							<input class="form-control" disabled value="<?php echo $row->reference_number . " - " . $row->title; ?>">
						</div>
				        <div class="form-group">
				          <label>Date of Incident</label>
				          <div class="input-group">
				            <div class="input-group-addon">
				              <i class="fa fa-calendar"></i>
				            </div>
				            <input type="text" class="form-control" disabled value="<?php echo $row->date_incident; ?>" name="incident_date" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="">
				          </div>
				        </div>
				        <div class="form-group">
				          <label>Description:</label>
				          <div class="callout callout-danger">
				            <p><?php echo $row->description; ?></p>
				          </div>
				        </div>
				        <div class="form-group">
				          <label>Sanctions:</label>
				          <input name="offense" class="form-control" disabled value="<?php echo $row->third_offense; ?>" autocomplete="off">
				        </div>
				        <div class="form-group">
				          <label>Narrative Report:</label>
				          <textarea name="description" disabled="" class="form-control" rows="10"><?php echo $row->narrative_report; ?></textarea>
				        </div>
					</div>
				</div>
			</div>
<?php
		}
	}

	function third_offense_minor($id) {
		global $conn;

		$select = "SELECT		offense_details.reference_number,
								offense_details.title,
								offense_details.description,
					            offenses.narrative_report,
					            offenses.date_incident,
					            sanctions.third_offense,
		                        students.last_name,
            					students.first_name,
            					students.middle_name

					FROM		offenses

					LEFT JOIN	offense_details
					ON			offenses.offense_details_id = offense_details.id

					LEFT JOIN	sanctions
					ON			offenses.sanctions_id = sanctions.id

					LEFT JOIN	students
					ON			offenses.students_id = students.id

					WHERE		(offenses.offense_count = 'Third Offense' AND offense_details.type = 'Minor Offense') AND offenses.id = $id";

		$query = $conn->query($select);
		while ($row = $query->fetch_object()) {
?>
			<div class="col-md-9">
				<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></h3>
				</div><!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
							<label>Reference Number: </label>
							<input class="form-control" disabled value="<?php echo $row->reference_number . " - " . $row->title; ?>">
						</div>
				        <div class="form-group">
				          <label>Date of Incident</label>
				          <div class="input-group">
				            <div class="input-group-addon">
				              <i class="fa fa-calendar"></i>
				            </div>
				            <input type="text" class="form-control" disabled value="<?php echo $row->date_incident; ?>" name="incident_date" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="">
				          </div>
				        </div>
				        <div class="form-group">
				          <label>Description:</label>
				          <div class="callout callout-warning">
				            <p><?php echo $row->description; ?></p>
				          </div>
				        </div>
				        <div class="form-group">
				          <label>Sanctions:</label>
				          <input name="offense" class="form-control" disabled value="<?php echo $row->third_offense; ?>" autocomplete="off">
				        </div>
				        <div class="form-group">
				          <label>Narrative Report:</label>
				          <textarea name="description" disabled="" class="form-control" rows="10"><?php echo $row->narrative_report; ?></textarea>
				        </div>
					</div>
				</div>
			</div>
<?php
		}
	}

	function case_report_major($id) {
		global $conn;

		$select = "SELECT		offense_details.reference_number,
								offense_details.title,
								offense_details.description,
					            offenses.narrative_report,
					            offenses.date_incident,
					            sanctions.third_offense,
		                        students.last_name,
            					students.first_name,
            					students.middle_name

					FROM		offenses

					LEFT JOIN	offense_details
					ON			offenses.offense_details_id = offense_details.id

					LEFT JOIN	sanctions
					ON			offenses.sanctions_id = sanctions.id

					LEFT JOIN	students
					ON			offenses.students_id = students.id

					WHERE		(offenses.offense_count = '-' AND offense_details.type = 'Major Offense') AND offenses.id = $id";

		$query = $conn->query($select);
		while ($row = $query->fetch_object()) {	
?>
			<div class="col-md-9">
				<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></h3>
				</div><!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
							<label>Reference Number: </label>
							<input class="form-control" disabled value="<?php echo $row->reference_number . " - " . $row->title; ?>">
						</div>
				        <div class="form-group">
				          <label>Date of Incident</label>
				          <div class="input-group">
				            <div class="input-group-addon">
				              <i class="fa fa-calendar"></i>
				            </div>
				            <input type="text" class="form-control" disabled value="<?php echo $row->date_incident; ?>" name="incident_date" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="">
				          </div>
				        </div>
				        <div class="form-group">
				          <label>Description:</label>
				          <div class="callout callout-danger">
				            <p><?php echo $row->description; ?></p>
				          </div>
				        </div>
				        <div class="form-group">
				          <label>Narrative Report:</label>
				          <textarea name="description" disabled="" class="form-control" rows="10"><?php echo $row->narrative_report; ?></textarea>
				        </div>
					</div>
				</div>
			</div>
<?php
		}
	}

	function case_report_minor($id) {
		global $conn;

		$select = "SELECT		offense_details.reference_number,
								offense_details.title,
								offense_details.description,
					            offenses.narrative_report,
					            offenses.date_incident,
					            sanctions.third_offense,
		                        students.last_name,
            					students.first_name,
            					students.middle_name

					FROM		offenses

					LEFT JOIN	offense_details
					ON			offenses.offense_details_id = offense_details.id

					LEFT JOIN	sanctions
					ON			offenses.sanctions_id = sanctions.id

					LEFT JOIN	students
					ON			offenses.students_id = students.id

					WHERE		(offenses.offense_count = '-' AND offense_details.type = 'Minor Offense') AND offenses.id = $id";

		$query = $conn->query($select);
		while ($row = $query->fetch_object()) {
?>
			<div class="col-md-9">
				<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></h3>
				</div><!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
							<label>Reference Number: </label>
							<input class="form-control" disabled value="<?php echo $row->reference_number . " - " . $row->title; ?>">
						</div>
				        <div class="form-group">
				          <label>Date of Incident</label>
				          <div class="input-group">
				            <div class="input-group-addon">
				              <i class="fa fa-calendar"></i>
				            </div>
				            <input type="text" class="form-control" disabled value="<?php echo $row->date_incident; ?>" name="incident_date" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="">
				          </div>
				        </div>
				        <div class="form-group">
				          <label>Description:</label>
				          <div class="callout callout-warning">
				            <p><?php echo $row->description; ?></p>
				          </div>
				        </div>
				        <div class="form-group">
				          <label>Narrative Report:</label>
				          <textarea name="description" disabled="" class="form-control" rows="10"><?php echo $row->narrative_report; ?></textarea>
				        </div>
					</div>
				</div>
			</div>
<?php
		}
	}

	function status($violation_id) {
		global $conn;

		$select = "SELECT violation_details.status from violation_details where id = $violation_id";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$status = $row->status;
		}

		if ($status == 'Excused') {
			header('Location: summary_dresscode_violation.php');
		}
	}

	function status_root($violation_id) {
		global $conn;

		$select = "SELECT violation_details.status from violation_details where id = $violation_id";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
			$status = $row->status;
		}
	}

	function dresscode_violation_today_male() {
		global $conn;
		$school_term = school_term_id();

		$select = "SELECT				COUNT(DISTINCT violation_details.student_id) AS student_id

					FROM				violation_details

					LEFT JOIN			students
					ON					violation_details.student_id = students.student_id

                    LEFT JOIN			school_term
                    ON					violation_details.school_term_id = school_term.id

					WHERE				(students.gender = 'Male' AND DATE_FORMAT(violation_details.created_at, '%d') = DATE_FORMAT(NOW(), '%d')) AND (violation_details.status = 'Violated' AND school_term.id = '$school_term')";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
?>
			<td><?php echo $row->student_id; ?></td>
<?php
		}
	}

	function dresscode_violation_today_female() {
		global $conn;
		$school_term = school_term_id();

		$select = "SELECT				COUNT(DISTINCT violation_details.student_id) AS student_id

					FROM				violation_details

					LEFT JOIN			students
					ON					violation_details.student_id = students.student_id

                    LEFT JOIN			school_term
                    ON					violation_details.school_term_id = school_term.id

					WHERE				(students.gender = 'Female' AND DATE_FORMAT(violation_details.created_at, '%d') = DATE_FORMAT(NOW(), '%d')) AND (violation_details.status = 'Violated' AND school_term.id = '$school_term')";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
?>
			<td><?php echo $row->student_id; ?></td>
<?php
		}
	}

	function dresscode_violation_term_male() {
		global $conn;
		$school_term = school_term_id();

		$select = "SELECT				COUNT(DISTINCT violation_details.student_id) AS student_id

					FROM				violation_details

					LEFT JOIN			students
					ON					violation_details.student_id = students.student_id

                    LEFT JOIN			school_term
                    ON					violation_details.school_term_id = school_term.id

					WHERE				(students.gender = 'Male' AND school_term.id = '$school_term') AND violation_details.status = 'Violated'";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
?>
			<td><?php echo $row->student_id; ?></td>
<?php
		}
	}

	function dresscode_violation_term_female() {
		global $conn;
		$school_term = school_term_id();

		$select = "SELECT				COUNT(DISTINCT violation_details.student_id) AS student_id

					FROM				violation_details

					LEFT JOIN			students
					ON					violation_details.student_id = students.student_id
                    
                    LEFT JOIN			school_term
                    ON					violation_details.school_term_id = school_term.id

					WHERE				(students.gender = 'Female' AND school_term.id = '$school_term') AND violation_details.status = 'Violated'";
		$query = $conn->query($select);
		
		while ($row = $query->fetch_object()) {
?>
			<td><?php echo $row->student_id; ?></td>
<?php
		}
	}

	function minor_offense_term_male() {
		global $conn;
		$school_term = school_term_id();

		$select = "SELECT				COUNT(DISTINCT offenses.students_id) AS student_id

					FROM				offenses

					LEFT JOIN			students
					ON					offenses.students_id = students.id
                    
                    LEFT JOIN			school_term
                    ON					offenses.school_term_id = school_term.id

                    LEFT JOIN			offense_details
                    ON					offenses.offense_details_id = offense_details.id
    
                  	WHERE				(students.gender = 'Male' AND offenses.school_term_id = $school_term) AND (offenses.status = 'Issue' AND offense_details.type = 'Minor Offense')";
		$query = $conn->query($select);
		
		while ($row = $query->fetch_object()) {
?>
			<td><?php echo $row->student_id; ?></td>
<?php
		}
	}

	function minor_offense_term_female() {
		global $conn;
		$school_term = school_term_id();

		$select = "SELECT				COUNT(DISTINCT offenses.students_id) AS student_id

					FROM				offenses

					LEFT JOIN			students
					ON					offenses.students_id = students.id
                    
                    LEFT JOIN			school_term
                    ON					offenses.school_term_id = school_term.id

                    LEFT JOIN			offense_details
                    ON					offenses.offense_details_id = offense_details.id
                  
                  	WHERE				(students.gender = 'Female' AND offenses.school_term_id = $school_term) AND (offenses.status = 'Issue' AND offense_details.type = 'Minor Offense')";
		$query = $conn->query($select);
		
		while ($row = $query->fetch_object()) {
?>
			<td><?php echo $row->student_id; ?></td>
<?php
		}
	}

	function major_offense_term_male() {
		global $conn;
		$school_term = school_term_id();

		$select = "SELECT				COUNT(DISTINCT offenses.students_id) AS student_id

					FROM				offenses

					LEFT JOIN			students
					ON					offenses.students_id = students.id
                    
                    LEFT JOIN			school_term
                    ON					offenses.school_term_id = school_term.id

                    LEFT JOIN			offense_details
                    ON					offenses.offense_details_id = offense_details.id
                  
                  	WHERE				(students.gender = 'Male' AND offenses.school_term_id = $school_term) AND (offenses.status = 'Issue' AND offense_details.type = 'Major Offense')";
		$query = $conn->query($select);
		
		while ($row = $query->fetch_object()) {
?>
			<td><?php echo $row->student_id; ?></td>
<?php
		}
	}

	function major_offense_term_female() {
		global $conn;
		$school_term = school_term_id();

		$select = "SELECT				COUNT(DISTINCT offenses.students_id) AS student_id

					FROM				offenses

					LEFT JOIN			students
					ON					offenses.students_id = students.id
                    
                    LEFT JOIN			school_term
                    ON					offenses.school_term_id = school_term.id

                    LEFT JOIN			offense_details
                    ON					offenses.offense_details_id = offense_details.id
                  
                  	WHERE				(students.gender = 'Female' AND offenses.school_term_id = $school_term) AND (offenses.status = 'Issue' AND offense_details.type = 'Major Offense')";
      	$query = $conn->query($select);

      	while ($row = $query->fetch_object()) {
?>
		<td><?php echo $row->student_id; ?></td>
<?php
      	}
	}

	function dresscode_socit() {
		global $conn;
		$school_term = school_term_id();

		$select = "SELECT				COUNT(DISTINCT violation_details.student_id) AS student_id

					FROM				violation_details

					LEFT JOIN			students
					ON					violation_details.student_id = students.student_id

                    LEFT JOIN			school_term
                    ON					violation_details.school_term_id = school_term.id

					WHERE				school_term.id = 5 AND (violation_details.status = 'Violated' AND students.department = 'School of Computing and Information Technologies')";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
?>
		<td><?php echo $row->student_id; ?></td>
<?php
		}	
	}

	function dresscode_som() {
		global $conn;
		$school_term = school_term_id();

		$select = "SELECT				COUNT(DISTINCT violation_details.student_id) AS student_id

					FROM				violation_details

					LEFT JOIN			students
					ON					violation_details.student_id = students.student_id

                    LEFT JOIN			school_term
                    ON					violation_details.school_term_id = school_term.id

					WHERE				school_term.id = 5 AND (violation_details.status = 'Violated' AND students.department = 'School of Management')";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
?>
		<td><?php echo $row->student_id; ?></td>
<?php
		}	
	}

	function dresscode_soe() {
		global $conn;
		$school_term = school_term_id();

		$select = "SELECT				COUNT(DISTINCT violation_details.student_id) AS student_id

					FROM				violation_details

					LEFT JOIN			students
					ON					violation_details.student_id = students.student_id

                    LEFT JOIN			school_term
                    ON					violation_details.school_term_id = school_term.id

					WHERE				school_term.id = 5 AND (violation_details.status = 'Violated' AND students.department = 'School of Engineering')";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
?>
		<td><?php echo $row->student_id; ?></td>
<?php
		}	
	}

	function dresscode_soma() {
		global $conn;
		$school_term = school_term_id();

		$select = "SELECT				COUNT(DISTINCT violation_details.student_id) AS student_id

					FROM				violation_details

					LEFT JOIN			students
					ON					violation_details.student_id = students.student_id

                    LEFT JOIN			school_term
                    ON					violation_details.school_term_id = school_term.id

					WHERE				school_term.id = 5 AND (violation_details.status = 'Violated' AND students.department = 'School of Multimedia and Arts')";
		$query = $conn->query($select);

		while ($row = $query->fetch_object()) {
?>
		<td><?php echo $row->student_id; ?></td>
<?php
		}	
	}
?>