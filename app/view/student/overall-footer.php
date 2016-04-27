      </div>
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <div class="tab-content">
          <div class="tab-pane" id="control-sidebar-home-tab">
          </div>
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        </div>
      </aside>
      <div class="control-sidebar-bg"></div>
    <!--
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.0
      </div>
      <strong>Copyright &copy; 2015-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
    </footer>
    -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        // Show the Modal on load
        $("#myModal").modal({backdrop: "static"});
        
        // Hide the Modal
        $("#myBtn").click(function(){
            $("#myModal").modal("hide");
        });
    });
    </script>

    <script>
    $(document).ready(function(){
        // Show the Modal on load
        $("#myModal2").modal({backdrop: "static"});
        
        // Hide the Modal
        $("#myBtn").click(function(){
            $("#myModal2").modal("hide");
        });
    });
    </script>
    <?php include 'app/view/configuration-widgets/jquery-js.php'; ?>
  </body>
</html>