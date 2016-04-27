<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>APC Violation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="app/assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="app/assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="app/assets/plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="app/assets/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="app/assets/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="app/assets/plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="app/assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="app/assets/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">
      <header class="main-header">

        <!-- Logo - Directory: user-widgets Result: Fixed-->
          <a href="admin.php" class="logo" draggable="false">
            <span class="logo-mini"><b>A</b>PC</span>
            <span class="logo-lg"><b>APC</b>Violation</span>
          </a>
        <!-- End of Logo Widget -->

        <!-- Header Navbar: style can be found in header.less -->
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
                    <small>Administrator</small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="admin.php" class="btn btn-default btn-flat" draggable="false">Home</a>
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

      <!-- Left side column. contains the logo and sidebar -->
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

              <!-- DRESS CODE VIOLATION REPORT -->
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-list"></i> <span>Dress Code Violation Report</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="report_details.php"><i class="fa fa-circle-o text-yellow"></i> Pending</a>
                    <a href="infringement.php"><i class="fa fa-circle-o text-red"></i> Infringement</a>
                  </li>
                </ul>
              </li>
              <!-- NOTHING FOLLOWS -->

              <!-- ENTER SOLO LINK -->
                <li>
                  <a href="minor_offense_list.php">
                    <i class="fa fa-warning"></i> <span>Student Offenses</span>
                  </a>
                </li>

              <!-- STUDENT NOTIFICATION -->
              <li class="treeview">
                <a href="student_notification.php">
                  <i class="fa fa-envelope"></i> <span>Student Notification</span>
                </a>
              </li>
              <!-- NOTHING FOLLOWS -->
              
                <li>
                  <a href="summary.php">
                    <i class="fa fa-book"></i> <span>Summary</span>
                  </a>
                </li>
              <!-- NOTHING FOLLOWS -->

              <!-- SETTINGS -->
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-gear"></i> <span>Settings</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                  <!-- Dress Code Module -->
                  <li>
                    <a href="#"><i class="fa fa-list-alt"></i> Dress Code Violation List <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                      <li><a href="../apcviolation/male_dresscode_violation.php"><i class="fa fa-male"></i> Male</a></li>
                      <li><a href="../apcviolation/female_dresscode_violation.php"><i class="fa fa-female"></i> Female</a></li>
                    </ul>
                  </li>
                  <!-- End of Dress Code Module -->

                  <!-- <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li> Template for Links-->

                  <!-- Offense Module -->
                  <li>
                    <a href="#"><i class="fa fa-warning"></i> Offense Details <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                      <li><a href="../apcviolation/major_offense.php"><i class="fa fa-circle-o text-red"></i> Major Offense</a></li>
                      <li><a href="../apcviolation/minor_offense.php"><i class="fa fa-circle-o text-yellow"></i> Minor Offense</a></li>
                    </ul>
                  </li>
                  <!-- End of Offense Module -->
                  <li><a href="notification_details.php"><i class="fa fa-envelope"></i> Notification Details</a></li>
                  <li><a href="school_term.php"><i class="fa fa-calendar"></i> School Term</a></li>
                  <li><a href="sanctions.php"><i class="fa fa-times-circle"></i> Sanctions</a></li>
                </ul>
              </li>
              <!-- End of Sidebar Link -->
            </li>
          </ul>
        </section>
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">