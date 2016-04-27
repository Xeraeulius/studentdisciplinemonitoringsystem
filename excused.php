<!-- This Page is/are for Students -->
<?php 
require 'app/controller/init.php';
protect_page_profile();
require 'app/controller/student/login_credential.php';
require 'app/view/student/overall-header.php';

if (isset($_GET['r'])) {
	$seen = 1;
	seen_clicked_violation_excused($seen, $student_id);
}
?>
<!-- === Insert Student Content === -->
<section class="content-header">
	<h1>Dresscode Violation Details</h1>
	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>
</section>
<!-- === Dresscode Violation Detail Content === -->
<section class="content">
<?php 
if (isset($_POST['btn_submit'])) {
	$comment = $_POST['txt_area'];
	$vio_id = $_POST['btn_submit'];

	appeal_ticket($vio_id, $comment);
?>	
<div class="alert alert-warning alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h4><i class="icon fa fa-warning"></i> Appeal Ticket Created</h4>
	<p>Your concerns will be further reviewed upon on by the Disciplinary Officer and please take note that you can only update this ticket <strong>once</strong>.</p>
</div>			
<?php
} else if (isset($_POST['btn_update_ticket'])) {
	$vio_id_update = $_POST['btn_update_ticket'];
	$update_comment = $_POST['txt_area'];

	update_appeal_ticket($vio_id_update, $update_comment);
?>
<div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h4><i class="icon fa fa-check"></i> Appeal Ticket Updated</h4>
	<p>Please wait for any further notification imposed by the Disciplinary Officer.</p>
</div>	
<?php
}
?>
	<div class="row">
		<div class="col-xs-12">
		  <div class="box">
		  	<!--
		    <div class="box-header">
		      <h3 class="box-title">Insert Title Here</h3>
		      <div class="box-tools">
		        <div class="input-group" style="width: 150px;">
		          <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
		          <div class="input-group-btn">
		            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
		          </div>
		        </div>
		      </div>
		    </div>
		    -->
			<form method="POST" action="appeal.php">
		    <div class="box-body table-responsive no-padding">
			<?php  
				if (initialize_token() === TRUE) {
					global $conn;

					$student_id = $_SESSION['student_id'];
			?>
		      <table class="table table-hover">
		        <tr>
					<th></th>
					<th>Disciplinary in Charge</th>
					<th>Status</th>
					<th>Date of Incident</th>
					<th>Valid Thru</th>
					<th></th>
		        </tr>
			<?php  
				if (student_has_violation($student_id)) {
					$select = "SELECT disciplinary_personnels.dp_id, 
									  DATE_FORMAT(violation_details.valid_date, '%a - %b %d, %Y - %h:%i %p') AS valid_date, 
									  violation_details.status, 
									  violation_details.id,
									  DATE_FORMAT(violation_details.created_at, '%a - %b %d, %Y - %h:%i %p') AS created_at, 
									  disciplinary_personnels.last_name, 
									  disciplinary_personnels.first_name, 
									  disciplinary_personnels.middle_name, 
									  disciplinary_personnels.dp_picture 
							   FROM disciplinary_personnels 
							   LEFT JOIN violation_details 
							   ON disciplinary_personnels.dp_id = violation_details.dp_id 
							   WHERE violation_details.student_id = '$student_id' and status = 'Excused'";
					$result = $conn->query($select);
					while ($row = $result->fetch_object()) {
						$id = $row->id;
						$status = $row->status;
			?>	
				<tbody>
					<tr>
			          <td><img src="<?php echo $row->dp_picture; ?>" width="60" height="60"></td>
			          <td><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></td>
						<?php 
							if ($status == 'Violated') {
						?>
								<td><span class="label label-danger"><?php echo $status; ?></span></td>
						<?php
							} else if ($status == 'Excused') {
						?>
								<td><span class="label label-success"><?php echo $status; ?></span></td>
						<?php
							} else {
						?>
								<td><span class="label label-warning"><?php echo $status; ?></span></td>
						<?php
							}
						?>
						<td><?php echo $row->created_at; ?></td>
						<td><?php echo $row->valid_date; ?></td>
						<?php
							$count = number_appeal_ticket($id);
							$update_count = determine_update_ticket($id);
							
							if ($count == 0 && $status == 'Pending') {
								include 'app/view/widgets/buttons/button_appeal_ticket.php';
							} else if ($count && $update_count) {
								include 'app/view/widgets/buttons/danger_appeal_ticket.php';
							} else if ($count == 1 && $status == 'Pending') {
								include 'app/view/widgets/buttons/update_appeal_ticket.php';
							} else if ($status == 'Excused' || $status == 'Violated') {
								include 'app/view/widgets/buttons/danger_appeal_ticket.php';
							}
						?>
			        </tr>
		        </tbody>
	<?php  
				}
			}
		}
	?>
		      </table>
		    </form>
		    </div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div>
	</div>
</section>
<!-- === Dresscode Violation Detail Content === -->

<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/student/overall-footer.php'
?>