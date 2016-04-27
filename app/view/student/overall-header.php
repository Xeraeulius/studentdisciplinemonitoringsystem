<!DOCTYPE html>
<html>
  <head>
  	<?php include 'app/view/configuration-widgets/head.php'; ?> <!-- Result: Fixed -->
    <style>
      .color-palette {
        height: 35px;
        line-height: 35px;
        text-align: center;
      }
      .color-palette-set {
        margin-bottom: 15px;
      }
      .color-palette span {
        display: none;
        font-size: 12px;
      }
      .color-palette:hover span {
        display: block;
      }
      .color-palette-box h4 {
        position: absolute;
        top: 100%;
        left: 25px;
        margin-top: -40px;
        color: rgba(255, 255, 255, 0.8);
        font-size: 12px;
        display: block;
        z-index: 7;
      }
      
      .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
      }
      .example-modal .modal {
        background: transparent !important;
      }
    </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
    <header class="main-header">

      <!-- Logo - Directory: user-widgets -->
        <?php include 'app/view/user-widgets/a-logo.php'; ?>
      <!-- End of Logo Widget -->

      <nav class="navbar navbar-static-top" role="navigation">

        <!-- Sidebar Toggle Button - Directory: user-widgets -->
          <?php include 'app/view/user-widgets/sidebar-toggle.php'; ?>
        <!-- End of Sidebar Toggle Button -->

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

              <!-- User Dropdown Signout - Directory: user-widgets -->
            <li class="dropdown user user-menu" draggable="false">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" draggable="false">
                <img src="<?php echo $picture; ?>" class="user-image" alt="User Image" draggable="false">
                <span class="hidden-xs"><?php echo $first_name . ' ' . $last_name; ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header" draggable="false">
                  <img src="<?php echo $picture; ?>" class="img-circle" alt="User Image" draggable="false">
                  <p>
                    <?php echo $first_name . ' ' . $last_name; ?>
                    <small><?php echo $department . ' - ' . $course; ?></small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="index.php" class="btn btn-default btn-flat" draggable="false">Home</a>
                  </div>
                  <div class="pull-right">
                    <a href="login/index.php" class="btn btn-default btn-flat" draggable="false">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
              <!-- End of User Dropdown Signout -->
            
              <!-- Right-hand most Gear - Directory: configuration-widgets -->
                <li>
                  <a href="#" data-toggle="control-sidebar" draggable="false"><i class="fa fa-gears"></i></a>
                </li>
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
            <li class="header" style="color: white;"><center>STUDENT</center></li>
            <li class="treeview">

              <!-- Dresscode Violation List -->
              <a href="#">
                <i class="fa fa-edit"></i><span>Dress Code Violation</span>
                <?php  
                  if ((seen_dresscode_pending($student_id) > 0 && status_violation_pending($student_id) == 'Pending') && partial_status_dresscode_pending($student_id) == 0) {
                ?>
                  <small class="label pull-right bg-yellow">new</small>
                <?php
                  } elseif ((seen_dresscode_violated($student_id) > 0 && status_violation_violated($student_id) == 'Violated') && partial_status_dresscode_violated($student_id) == 0) {
                ?>
                  <small class="label pull-right bg-red">new</small>
                <?php
                  } elseif ((seen_dresscode_excused($student_id) > 0 && status_violation_excused($student_id) == 'Excused') && partial_status_dresscode_excused($student_id) == 0) {
                ?>
                  <small class="label pull-right bg-green">new</small>
                <?php
                  } else {
                ?>
                  <i class="fa fa-angle-left pull-right"></i>
                <?php
                  }
                ?>
              </a>
              <ul class="treeview-menu">
                <li><a href="../apcviolation/details.php?r=<?php echo base64_encode(notification_today($student_id)); ?>"><i class="fa fa-circle-o text-yellow"></i> Pending</a></li>
                <li><a href="../apcviolation/dresscode_violation.php?r=<?php echo base64_encode(notification_today($student_id)); ?>"><i class="fa fa-circle-o text-red"></i> Infringement</a></li>
                <li><a href="../apcviolation/excused.php?r=<?php echo base64_encode(notification_today($student_id)); ?>"><i class="fa fa-circle-o text-green"></i> Excused</a></li>
              </ul>
              <!-- End of Dresscode Violation List -->

            </li>
            <li>
              <a href="notification.php?r=<?php echo base64_encode(encode_notification($id)); ?>">
                <i class="fa fa-envelope"></i> <span>Notification Inbox</span>
                <?php 
                if (seen_zoned($id) > 0) {
                ?>
                  <small class="label pull-right bg-red"><?php echo seen_zoned($id); ?></small>
                <?php
                } elseif (seen_zoned($id) == 0) {
                ?>
                  
                <?php
                }
                ?>
              </a>
            </li>
          </ul>
        </section>
      </aside>
      <div class="content-wrapper">
