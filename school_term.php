<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/administrator/overall-header.php';

add_school_term();
update_school_term();
?>

<!-- === Insert Administrator Content === -->
<section class="content-header">
	<h1>
		School Term
		<small></small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>
</section>

<section class="content">
<?php
if (isset($_POST['update_term'])) {
?>
<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <p><i class="icon fa fa-check"></i> Changes were made to the school term you have committed.</p>
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
		    <div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<tr>
						<th>Term</th>
						<th>Status</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th></th>
					</tr>
				    <tbody>
				    <?php  
						global $conn;
						$select = "SELECT * from school_term";
						$result = $conn->query($select);

						while ($row = $result->fetch_object()) {
				    ?>
						<tr>
							<td><?php echo $row->term; ?></td>
							<td><?php echo $row->status; ?></td>
							<td><?php echo $row->start_date; ?></td>
							<td><?php echo $row->end_date; ?></td>
							<td class="col-md-1"><a href="update_term.php?r=<?php echo base64_encode($row->id); ?>" class="btn btn-primary btn-block margin-bottom">Update</a></td>
						</tr>
					<?php
						}
					?>
			    	</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</section>
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/administrator/overall-footer.php';
?>