<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/administrator/overall-header.php';

create_major_offense();
update_major_offense();
?>
<!-- === Insert Administrator Content === -->
<section class="content-header">
	<h1>
		List of Offense
		<small>Major Offense</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>
</section>

<section class="content">
<?php  
if (isset($_POST['update_major_offense'])) {
?>
<div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<p><i class="icon fa fa-check"></i> Major Offense Detail Updated</p>
</div>
<?php	
}
?>

<?php  
if (isset($_POST['btn_add_major_offense'])) {
	$ref_number = $_POST['ref_number'];
	$title = $_POST['title'];
?>
<div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<p><i class="icon fa fa-check"></i> Major Offense Detail Added:</p>
	<ul>
		<li>Reference Number: <?php echo $ref_number; ?></li>
		<li>Title: <?php echo $title; ?></li>
	</ul>
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
	    	<form action="update_offense_details.php" method="POST">
			    <div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tr>
							<th>Reference Number</th>
							<th>Title</th>
							<th>Description</th>
							<th>Status</th>
							<th></th>
						</tr>
					    <tbody>
						<?php 
							global $conn;
							$select = "SELECT id, reference_number, description, title, status from offense_details where type = 'Major Offense'";
							$result = $conn->query($select);

							while ($row = $result->fetch_object()) {
								if ($row->type = "Major Offense") {
						?><tr>
						        <td style="width: 200px;"><label><?php echo $row->reference_number; ?></label></td>
						        <td style="width: 200px;"><p><?php echo $row->title; ?></p></td>
				    			<td style="width: 500px;"><?php echo $row->description; ?></td>
				    			<td style="width: 100px;"><?php echo $row->status; ?></td>
			    				<td style="width: 150px;"><button type="submit" name="update_majors_offense" value="<?php echo $row->id ?>" class="btn btn-primary">Update</button></td>
				    		<?php
				    			}
				    		?>
					      </tr>
					    <?php  
							}
					    ?>
				    	</tbody>
					</table>
				</div>
			</form>
			<form action="add_offense_details.php" method="POST">
		        <div class="box-footer clearfix">
		      		<button type="submit" name="btn_add_major" class="btn btn-default pull-left"><i class="fa fa-plus"></i> Add</button>
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