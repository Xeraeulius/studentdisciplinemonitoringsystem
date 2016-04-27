<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/administrator/overall-header.php';
?>
<!-- === Insert Administrator Content === -->
<?php  
	if (isset($_POST['update_violation_list_male'])) {
		$violation_code_list = $_POST['update_violation_list_male'];
		$select_list = "SELECT * from violation_code where violation_code = '$violation_code_list'";
		$query_list = $conn->query($select_list);

			while ($row_list = $query_list->fetch_object()) {
				$violation_name = $row_list->name;
				$violation_active = $row_list->active;
				$violation_gender = $row_list->gender;
				$violation_code = $row_list->violation_code;
			}
?>
<section class="content-header">
	<h1>
		Update Dress Code Violation
		<small>Male</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>
</section>

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
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<tr>
						<th>List of Dress Code Violation</th>
				        <th>Active</th>
				        <th>Target Audience</th>
				        <th></th>
					</tr>
			</div>
			<form action="male_dresscode_violation.php" method="POST">
				<tbody>
					<tr>
						<td><input type="text" class="form-control" name="optname" value="<?php echo $violation_name; ?>" autocomplete="off" /></td>
						<td>
							<div class="radio">
							<?php  
								if ($violation_active === 'YES') {
							?>		<label style="margin-left: 30px;"><input type="radio" name="optactive" value="YES" checked>YES</label>
									<label style="margin-left: 30px;"><input type="radio" name="optactive" value="NO" >NO</label>
							<?php
								} else if ($violation_active === 'NO') {
							?>
									<label style="margin-left: 30px;"><input type="radio" name="optactive" value="YES" >YES</label>
									<label style="margin-left: 30px;"><input type="radio" name="optactive" value="NO" checked>NO</label>
							<?php
								}
							?>
							</div>
						</td>
						<td style="width: 370px;">
							<div class="radio">
							<?php  
								if ($violation_gender === 'EVERYONE') {
							?>		<label style="margin-left: 30px;"><input type="radio" name="optgender" value="EVERYONE" checked>EVERYONE</label>
									<label style="margin-left: 30px;"><input type="radio" name="optgender" value="MALE" >MALE</label>
									<label style="margin-left: 30px;"><input type="radio" name="optgender" value="FEMALE" >FEMALE</label>
							<?php
								} else if ($violation_gender === 'MALE') {
							?>
									<label style="margin-left: 30px;"><input type="radio" name="optgender" value="EVERYONE" >EVERYONE</label>
									<label style="margin-left: 30px;"><input type="radio" name="optgender" value="MALE" checked>MALE</label>
							<?php
								} else if ($violation_gender === 'FEMALE') {
							?>
									<label><input type="radio" name="optgender" value="EVERYONE" >EVERYONE</label>
									<label><input type="radio" name="optgender" value="FEMALE" checked>FEMALE</label>
							<?php		
								}
							?>

							</div>
						</td>
						<td><button type="submit" name="submit_violation_list" value="<?php echo $violation_code ?>" class="btn btn-primary">Submit</button></td>
					</tr>
				</tbody>
			</form>
			</table>
		</div>
	</div>
</div>
</section>
<?php  
	}
?>

<?php  
	if (isset($_POST['update_violation_list_female'])) {
		$violation_code_list = $_POST['update_violation_list_female'];
		$select_list = "SELECT * from violation_code where violation_code = '$violation_code_list'";
		$query_list = $conn->query($select_list);

			while ($row_list = $query_list->fetch_object()) {
				$violation_name = $row_list->name;
				$violation_active = $row_list->active;
				$violation_gender = $row_list->gender;
				$violation_code = $row_list->violation_code;
			}
?>
<section class="content-header">
	<h1>
		Update Dress Code Violation
		<small>Female</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>
</section>

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
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<tr>
						<th>List of Dress Code Violation</th>
				        <th>Active</th>
				        <th>Target Audience</th>
				        <th></th>
					</tr>
			</div>
			<form action="female_dresscode_violation.php" method="POST">
				<tbody>
					<tr>
						<td><input type="text" class="form-control" name="optname" value="<?php echo $violation_name; ?>" autocomplete="off" /></td>
						<td>
							<div class="radio">
							<?php  
								if ($violation_active === 'YES') {
							?>		<label style="margin-left: 30px;"><input type="radio" name="optactive" value="YES" checked>YES</label>
									<label style="margin-left: 30px;"><input type="radio" name="optactive" value="NO" >NO</label>
							<?php
								} else if ($violation_active === 'NO') {
							?>
									<label style="margin-left: 30px;"><input type="radio" name="optactive" value="YES" >YES</label>
									<label style="margin-left: 30px;"><input type="radio" name="optactive" value="NO" checked>NO</label>
							<?php
								}
							?>
							</div>
						</td>
						<td style="width: 370px;">
							<div class="radio">
							<?php  
								if ($violation_gender === 'EVERYONE') {
							?>		<label style="margin-left: 30px;"><input type="radio" name="optgender" value="EVERYONE" checked>EVERYONE</label>
									<label style="margin-left: 30px;"><input type="radio" name="optgender" value="MALE" >MALE</label>
									<label style="margin-left: 30px;"><input type="radio" name="optgender" value="FEMALE" >FEMALE</label>
							<?php
								} else if ($violation_gender === 'MALE') {
							?>
									<label style="margin-left: 30px;"><input type="radio" name="optgender" value="EVERYONE" >EVERYONE</label>
									<label style="margin-left: 30px;"><input type="radio" name="optgender" value="MALE" checked>MALE</label>
							<?php
								} else if ($violation_gender === 'FEMALE') {
							?>
									<label><input type="radio" name="optgender" value="EVERYONE" >EVERYONE</label>
									<label><input type="radio" name="optgender" value="FEMALE" checked>FEMALE</label>
							<?php		
								}
							?>

							</div>
						</td>
						<td><button type="submit" name="submit_violation_list" value="<?php echo $violation_code ?>" class="btn btn-primary">Submit</button></td>
					</tr>
				</tbody>
			</form>
			</table>
		</div>
	</div>
</div>

</section>
<?php  
	}
?>
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/administrator/overall-footer.php';
?>