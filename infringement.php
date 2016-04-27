<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/administrator/overall-header.php';
?>
<!-- === Insert Administrator Content === -->
<section class="content-header">
	<h1>
		Dress Code Violation Report
		<small>Infringement of Dress Code: <?php echo school_term() . " Term"; ?></small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>
</section>

<section class="content">
<?php  
if (isset($_POST['btn_submit'])) {
	$violation_details_id = $_POST['btn_submit'];
	$radio_button = $_POST['optradio'];

	admin_violation_details($violation_details_id, $radio_button);
?>
<div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<p><i class="icon fa fa-check"></i> Changes were made to the Dress Code Violation Ticket.</p>
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
	    <?php  
	    	if (initialize_token_admin() === TRUE) {
	    		global $conn;

	    		$admin_id = $_SESSION['admin_id'];
	    	}
	    ?>
	    	<form action="infringement_details.php" method="POST">
			    <div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tr>
							<th></th>
							<th>Disciplinary in Charge</th>
							<th></th>
							<th>Name of Student</th>
							<th>Date of Violation</th>
							<th></th>
						</tr>
						<?php  
						if (violation_reports()) {
							$id = school_term_id();
							$select = "SELECT          disciplinary_personnels.dp_id,
										               disciplinary_personnels.dp_picture,
										               disciplinary_personnels.last_name   AS dp_last_name,
										               disciplinary_personnels.first_name  AS dp_first_name,
										               disciplinary_personnels.middle_name AS dp_middle_name,
										                
										               DATE_FORMAT(violation_details.created_at, '%a - %b %d, %Y - %h:%i %p') AS created_at,
										               violation_details.status,
										               violation_details.id,
                                                       
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
                                        
										WHERE violation_details.status = 'Violated' AND
                                        	  violation_details.school_term_id = '$id'";
							$result = $conn->query($select);				
						?>
					    <tbody>
							<tr>
							<?php  
								$result = $conn->query($select);
								while ($row = $result->fetch_object()) {
							?>
							<td><img src="<?php echo $row->dp_picture; ?>" width="60" height="60"></td>
							<td><?php echo $row->dp_last_name . ", " . $row->dp_first_name . " " . $row->dp_middle_name; ?></td>
							<td><img src="<?php echo $row->id_picture; ?>" width="60" height="60"></td>
							<td><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></td>
							<td><?php echo $row->created_at; ?></td>
							<td><button name="btn_view" type="submit" value="<?php echo $row->id ?>" class="btn btn-primary">View</button></td>
					      </tr>
					      	<?php  
					      		}
					      	}
					      	?>
				    	</tbody>
					</table>
				</div>
			</form>
		</div>
	</div>
</div>
</section>
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/administrator/overall-footer.php';
?>