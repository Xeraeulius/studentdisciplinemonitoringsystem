<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/administrator/overall-header.php';
?>
<!-- === Insert Administrator Content === -->
<?php  
if (isset($_POST['btn_add_minor'])) {
?>
<section class="content-header">
	<h1>
		Add Minor Offense Details
	</h1>
	<ol class="breadcrumb">
    <li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
  </ol>
</section>

<form action="minor_offense.php" method="POST">
  <section class="content">
  <div class="box box-default">
  <div class="box-body">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Reference Number</label>
          <input name="ref_number" type="text" class="form-control" autocomplete="off">
        </div><!-- /.form-group -->
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Title</label>
          <input name="title" type="text" class="form-control" autocomplete="off">
        </div><!-- /.form-group -->
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Description</label>
          <textarea name="description" class="form-control" rows="5"></textarea>
        </div><!-- /.form-group -->
      <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
          <option value=""></option>
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
      </div>
      </div>
    </div>
  </div>
      <div class="box-footer clearfix">
    		<button type="submit" name="btn_add_minor_offense" class="btn btn-default pull-left"><i class="fa fa-plus"></i> Add</button>
      </div>
  </div>
  </section>
</form>	
<?php  
}

if (isset($_POST['btn_add_major'])) {
?>
<section class="content-header">
	<h1>
		Add Major Offense Details
	</h1>
	<ol class="breadcrumb">
		<li><a href="admin.php"><i class="fa fa-home"></i>Home</a></li>
	</ol>
</section>

<form action="major_offense.php" method="POST">
  <section class="content">
  <div class="box box-default">
  <div class="box-body">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Reference Number</label>
          <input name="ref_number" type="text" class="form-control" autocomplete="off">
        </div><!-- /.form-group -->
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Title</label>
          <input name="title" type="text" class="form-control" autocomplete="off">
        </div><!-- /.form-group -->
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Description</label>
          <textarea name="description" class="form-control" rows="5"></textarea>
        </div><!-- /.form-group -->
      <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
          <option value=""></option>
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
      </div>
      </div>
    </div>
  </div>
      <div class="box-footer clearfix">
        <button type="submit" name="btn_add_major_offense" class="btn btn-default pull-left"><i class="fa fa-plus"></i> Add</button>
      </div>
  </div>
  </section>
</form>	

<?php
}
?>
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/administrator/overall-footer.php';
?>