<!-- This Page is/are for Students -->
<?php 
require 'app/controller/init.php';
protect_page_profile();
require 'app/controller/student/login_credential.php';
require 'app/view/student/overall-header.php';
?>
<!-- === Insert Student Content === -->
<section class="content-header">
	<h1>Appeal Ticket</h1>
	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>
</section>
<?php 
if (isset($_POST['btn_appeal'])) {
	global $conn;
	$id = $_POST['btn_appeal'];
	
	$select = "SELECT 		violation_details.id, 
							violation_details.remarks, 
							DATE_FORMAT(violation_details.valid_date, '%a - %b %d, %Y - %h:%i %p') AS valid_date,
				            violation_details.violation_picture

				FROM 		violation_details

				WHERE violation_details.id = '$id'";
	$result = $conn->query($select);
	while ($row = $result->fetch_object()) {
		$violation_details_remarks = $row->remarks;
		$violation_details_valid_date = $row->valid_date;
		$violation_details_id = $row->id;
	}
?>
<section class="content">
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
				<form method="POST" action="details.php">
				    <div class="box-body table-responsive no-padding">
				      <table class="table table-hover">
				        <tr>
							<th>List of Violation</th>
							<th>Remarks</th>
							<th>Valid Thru</th>
							<th>Appeal Statement</th>
							<th></th>
				        </tr>
						<tbody>
							<tr>
							<td><?php violation_of_student($id); ?></td>
							<td><?php echo $violation_details_remarks ?></td>
							<td><?php echo $violation_details_valid_date ?></td>
							<td><textarea name="txt_area" rows="5" cols="40" style="resize: none"></textarea></td>
							<td><button name="btn_submit" type="submit" value="<?php echo $violation_details_id; ?>" class="btn btn-primary">Submit</button></td>
					        </tr>
				        </tbody>
				      </table>
				    </div>
			    </form>
		    </div><!-- /.box-body -->
			<?php 
			} 
			if (isset($_POST['btn_update'])) {
				global $conn;
				$update_ticket = $_POST['btn_update'];
				
					$select =  "SELECT 		 violation_details.id AS vio_id,
								       		 violation_details.remarks,
								       		 DATE_FORMAT  (violation_details.valid_date, '%a - %b %d, %Y - %h:%i %p') AS valid_date,
								       		 appeal_ticket.appeal_statement,
								       		 DATE_FORMAT (appeal_ticket.created_at, '%a - %b %d, %Y - %h:%i %p') AS created_at
								FROM 	     violation_details
								LEFT JOIN 	 appeal_ticket ON appeal_ticket.vio_id = violation_details.id
								WHERE		 appeal_ticket.vio_id = '$update_ticket'";
				$result = $conn->query($select);
				while ($row = $result->fetch_object()) {
					$id = $row->vio_id;
			?>
		 	<div class="box">
				<form method="POST" action="details.php">
				    <div class="box-body table-responsive no-padding">
						<table class="table">
							<thead>
								<tr>
									<th>List of Violation</th>
									<th>Remarks</th>
									<th>Appeal Ticket Created</th>
									<th>Valid Thru</th>
									<th>Appeal Statement</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php violation_of_student($id); ?></td>
									<td style="width: 200px;"><?php echo $row->remarks ?></td>
									<td><?php echo $row->created_at ?></td>
									<td><?php echo $row->valid_date ?></td>
									<td><textarea name="txt_area" rows="5" cols="40" style="resize: none"><?php echo $row->appeal_statement; ?></textarea></td>
									<td><button name="btn_update_ticket" type="submit" value="<?php echo $row->vio_id; ?>" class="btn btn-primary">Submit</button></td>
								</tr>
							</tbody>
						</table>
					</div>
				</form>
		    </div><!-- /.box-body -->
<?php  
				}
			}
?>
		    </div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div>
	</div>
</section>
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/student/overall-footer.php';
?>