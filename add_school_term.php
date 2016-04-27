<!-- This Page is/are for Administrator -->
<?php 
require 'app/controller/init.php';
protect_page_profile_admin();
require 'app/controller/administrator/login-credential.php';
require 'app/view/administrator/select2-message.php';
?>
<!-- === Insert Administrator Content === -->
<section class="content-header">
  <h1>
    School Term
    <small></small>
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
              <th>Term</th>
              <th>Status</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th></th>
            </tr>
          <form action="school_term.php" method="POST">
            <tbody>
              <tr>
                <td><input type="text" class="form-control" name="name_term" autocomplete="off" /></td>
                <td>
                  <div class="radio">
                    <label style="margin-left: 30px;"><input type="radio" name="optactive" value="Active">Active</label>
                    <label style="margin-left: 30px;"><input type="radio" name="optactive" value="Inactive" >Inactive</label>
                  </div>
                </td>
                <td class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="start_date" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                  </div><!-- /.input group -->
                </td>
                <td class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="end_date" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                  </div><!-- /.input group -->
                </td>
                <td><button type="submit" name="add_term" class="btn btn-primary">Submit</button></td>
              </tr>
            </tbody>
          </form>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- === [= NOTHING FOLLOWS =] === -->
<?php  
require 'app/view/administrator/select2-footer.php';
?>