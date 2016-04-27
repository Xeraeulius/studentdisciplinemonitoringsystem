<!DOCTYPE html>
<html>
  <head>
    <?php include 'app/view/configuration-widgets/head.php'; ?>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
    <header class="main-header">

      <!-- Logo - Directory: user-widgets Result: Fixed-->
        <a href="root.php" class="logo" draggable="false">
          <span class="logo-mini"><b>A</b>PC</span>
          <span class="logo-lg"><b>APC</b>Violation</span>
        </a>
      <!-- End of Logo Widget -->

      <nav class="navbar navbar-static-top" role="navigation">

        <!-- Sidebar Toggle Button - Directory: user-widgets -->
          <?php include 'app/view/user-widgets/sidebar-toggle.php'; ?>
        <!-- End of Sidebar Toggle Button -->

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

              <!-- User Dropdown Signout - Directory: user-widgets -->
              <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" draggable="false">
                <img src="<?php echo $picture; ?>" class="user-image" alt="User Image" draggable="false">
                <span class="hidden-xs"><?php echo $first_name . ' ' . $last_name; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo $picture; ?>" class="img-circle" alt="User Image" draggable="false">
                  <p>
                    <?php echo $first_name . ' ' . $last_name; ?>
                    <small>Root</small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="root.php" class="btn btn-default btn-flat" draggable="false">Home</a>
                  </div>
                  <div class="pull-right">
                    <a href="admin/index.php" class="btn btn-default btn-flat" draggable="false">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
              <!-- End of User Dropdown Signout -->
            
              <!-- Right-hand most Gear - Directory: configuration-widgets -->
                <?php include 'app/view/configuration-widgets/gear.php' ?>
              <!-- End of Right-hand most Gear -->

          </ul>
        </div>
      </nav>
    </header>
      <aside class="main-sidebar">
        <section class="sidebar">

          <!-- Sidebar User Panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $picture; ?>" class="img-circle" alt="User Image" draggable="false">
            </div>
            <div class="pull-left info">
              <p><?php echo $first_name . ' ' . $last_name; ?></p>
            </div>
          </div>
          <!-- End of Sidebar User Panel -->

          <ul class="sidebar-menu">
            <li class="header" style="color: white;"><center><?php echo $role; ?></center></li>
            <li class="treeview">

              <!-- Enter The Sidebar Links Here -->

              <!-- ENTER SOLO LINK -->
                <li>
                  <a href="summary_dresscode_root.php">
                    <i class="fa fa-list"></i> <span>Dress Code Violation Report</span>
                  </a>
                </li>

                <li>
                  <a href="minor_offense_list_root.php">
                    <i class="fa fa-warning"></i> <span>Student Offenses</span>
                  </a>
                </li>
              
                <li>
                  <!-- <a href="summary_root.php"> -->
                    <!-- <i class="fa fa-book"></i> <span>Summary</span> -->
                  <a href="summary_dress_code_root.php">
                    <i class="fa fa-book"></i> <span>Summary</span>
                  </a>
                </li>
              <!-- NOTHING FOLLOWS -->

            </li>
          </ul>
        </section>
      </aside>
      <div class="content-wrapper">
