<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/administrator/overall-header.php';
?>
<!-- === Insert Administrator Content === -->
<?php  
if (isset($_POST['btn_add_male'])) {
?>
<section class="content-header">
	<h1>
		Add Dress Code Violation Detail
		<small>Male</small>
	</h1>
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
					<form action="male_dresscode_violation.php" method="POST">
						<tbody>
							<tr>
								<td><input type="text" class="form-control" name="optname" autocomplete="off" /></td>
								<td>
									<div class="radio">
										<label style="margin-left: 30px;"><input type="radio" name="optactive" value="YES">YES</label>
										<label style="margin-left: 30px;"><input type="radio" name="optactive" value="NO" >NO</label>
									</div>
								</td>
								<td>
									<div class="radio">
										<label style="margin-left: 30px;"><input type="radio" name="optgender" value="EVERYONE">EVERYONE</label>
										<label style="margin-left: 30px;"><input type="radio" name="optgender" value="MALE" >MALE</label>
									</div>
								</td>
								<td><button type="submit" name="add_violation_code_male" class="btn btn-primary">Submit</button></td>
							</tr>
						</tbody>
					</form>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
} elseif (isset($_POST['btn_add_female'])) {
?>
<section class="content-header">
	<h1>
		Add Dress Code Violation Detail
		<small>Female</small>
	</h1>
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
					<form action="female_dresscode_violation.php" method="POST">
						<tbody>
							<tr>
								<td><input type="text" class="form-control" name="optname" autocomplete="off" /></td>
								<td>
									<div class="radio">
										<label style="margin-left: 30px;"><input type="radio" name="optactive" value="YES">YES</label>
										<label style="margin-left: 30px;"><input type="radio" name="optactive" value="NO" >NO</label>
									</div>
								</td>
								<td>
									<div class="radio">
										<label style="margin-left: 30px;"><input type="radio" name="optgender" value="EVERYONE">EVERYONE</label>
										<label style="margin-left: 30px;"><input type="radio" name="optgender" value="FEMALE" >FEMALE</label>
									</div>
								</td>
								<td><button type="submit" name="add_violation_code_male" class="btn btn-primary">Submit</button></td>
							</tr>
						</tbody>
					</form>
					</table>
				</div>
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