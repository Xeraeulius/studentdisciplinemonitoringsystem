<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/administrator/overall-header.php';

update_violation_list_male();
add_violation_list_male();
?>
<!-- === Insert Administrator Content === -->
<section class="content-header">
	<h1>
		List of Dress Code Violation
		<small>Female</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>
</section>

<section class="content">
<?php  
if (isset($_POST['submit_violation_list'])) {
	$vio_name = $_POST['optname'];
?>
<div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<p><i class="icon fa fa-check"></i> The Dress Code Violation detail has been updated.</p>
</div>
<?php	
} else if (isset($_POST['add_violation_code_male'])) {
	$vio_name = $_POST['optname'];
?>
<div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<p><i class="icon fa fa-list-alt"></i> <?php echo $vio_name; ?> has been added to the Lists of Dress Code Violation.</p>
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
	    	<form action="update_dresscode_violation.php" method="POST">
			    <div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tr>
							<th>List of Dress Code Violations</th>
							<th>Active</th>
							<th>Target Audience</th>
							<th></th>
						</tr>
					    <tbody>
						<?php 
							global $conn;
							$select = "SELECT name, active, gender, violation_code from violation_code where gender = 'FEMALE' or gender = 'EVERYONE' order by active asc, gender asc";
							$result = $conn->query($select);

							while ($row = $result->fetch_object()) {
								if ($row->gender === 'FEMALE' or $row->gender === 'EVERYONE') {
						?><tr>
						        <td><label><?php echo $violation_name = $row->name; ?></label></td>
						        <td><p><?php echo $row->active; ?></p></td>
				    			<td><?php echo $row->gender; ?></td>
			    				<td><button type="submit" name="update_violation_list_female" value="<?php echo $row->violation_code ?>" class="btn btn-primary">Update</button></td>
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
			<form action="add_dresscode_violation.php" method="POST">
		        <div class="box-footer clearfix">
		      		<button type="submit" name="btn_add_female" class="btn btn-default pull-left"><i class="fa fa-plus"></i> Add</button>
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