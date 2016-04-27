<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
	if (isset($_GET['r'])) {
		global $conn;
		$violation_id = base64_decode($_GET['r']);
		status($violation_id);
require 'app/view/administrator/overall-header.php';
?>
<!-- === Insert Administrator Content === -->
<section class="content-header">
	<h1>
		Dress Code Violation Report
		<small>Infringement of Dress Code</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>
</section>

<section class="content">
<?php 
		$select = "SELECT		violation_details.id,
					            violation_details.remarks,
					            violation_details.status,
					            violation_details.violation_picture,
					            
					            students.student_id,
					            students.last_name,
					            students.first_name,
					            students.middle_name,
					            students.id_picture,
					            
					            appeal_ticket.appeal_statement

					FROM		violation_details

					INNER JOIN	students
					ON			students.student_id = violation_details.student_id

					LEFT JOIN	appeal_ticket
					ON			violation_details.id = appeal_ticket.vio_id

					WHERE		violation_details.id = $violation_id";

		$result = $conn->query($select);
		if ($result) {
			while ($row = $result->fetch_object()) {
				$id = $row->id;
				$violation_picture = $row->violation_picture;
?>
<section class="content">
<div class="row">
    <div class="box-body table-responsive no-padding">
    	<div class="box box-danger">
    		<div class="box-header">
    			<img src="<?php echo $row->id_picture; ?>" width="90" height="90">
    			<h3 class="box-title" style="margin-left: 2%;"><?php echo $row->last_name . ', ' . $row->first_name . ' ' . $row->middle_name; ?></h3>
    		</div>
    		<div class="box-body">
    			<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tr>
							<th>List of Violations</th>
							<th>Remarks</th>
							<th>Appeal Statement</th>
							<th>Status</th>
							<th></th>
						</tr>
					    <tbody>
							<tr>
								<td>
									<?php
										error_reporting(0);
										violation_of_student($id);
									?>
								</td>
								<td style="width: 400px;"><?php echo $row->remarks ?></td>
								<td style="width: 200px;"><?php echo $row->appeal_statement ?></td>
								<form action="process_dresscode.php?p=<?php echo base64_encode($row->first_name); ?>" method="POST">
									<td>
										<div class="radio">
										  <label><input type="radio" name="optradio" value="Violated" checked>Issue Dress Code Violation</label>
										</div>
										<div class="radio">
										  <label><input type="radio" name="optradio" value="Excused">Excused</label>
										</div>
									</td>
									<td><button name="btn_submit" type="submit" value="<?php echo $row->id ?>" class="btn btn-primary">Submit</button></td>
								</form>
					     	</tr>
				    	</tbody>
					</table>
				</div>
				<?php  
					if ($violation_picture == Null) {
						
					} else {
				?>
				<div class="panel panel-primary">
		 		 	<!-- Default panel contents -->
		 			<div class="panel-heading">Screenshot Violation</div>
			 		<div class="panel-body">
			 			<center>
		 					<img src="<?php echo $violation_picture; ?>" height="250px" width="270px">
			 			</center>
				  	</div>
				</div>
				<?php  
					}
				?>
    		</div>
    	</div>
	</div>
</div>
<?php
			}
		}
	}
?>
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/administrator/overall-footer.php';
?>