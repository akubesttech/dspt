  <?php //include('../member/user_pop_ups.php');
  	$que_warnings=mysqli_query($condb,"select * from session_tb where  Action='1'");
	$warning_counts=mysqli_num_rows($que_warnings);
   ?>	
 <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span><?php echo $row['initial'];  ?>!</span></a>
            </div>

            <div class="clearfix"></div>
	<?php $query= mysqli_query($condb,"select * from admin where admin_id = '$session_id'")or die(mysqli_error($condb));
							  $row = mysqli_fetch_array($query);
							  $checkstatus = $row['access_level']; $exists6 = imgExists($row['adminthumbnails']);
						?>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="./<?php  
				 // if ($row['adminthumbnails']==NULL ){print "./uploads/NO-IMAGE-AVAILABLE.jpg";}else{print $row['adminthumbnails'];}
				  if ($exists6 > 0 ){print $row['adminthumbnails'];}else{ echo "uploads/NO-IMAGE-AVAILABLE.jpg";}
				  
				 // echo $row['adminthumbnails']; ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome Back.</span>
                <h2>&nbsp;<?php echo $row['firstname']." ".$row['lastname'];  ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br>

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
              
                <h3>User Status :<?php echo getstatus2($checkstatus);  ?></h3>
                <h3> <a  href="#" onclick="window.open('new_apply.php?view=spro','_self')"><font color="yellow"> <?php if($class_ID > 0){ echo "<i class='fa fa-check'></i>"." [".getprog($class_ID)."]"; }else{ echo "<i class='fa fa-close'></i>"."No Programme Selected";} 
	//$accno = rand(9999999999, 99999999999);
	//echo $accno = strlen($accno) != 10 ? substr($accno, 0, 10) : $accno;
 ?></font></a></h3>
             
                <ul class="nav side-menu">
                <li class="current-page"><a href="index.php"><i class="fa fa-home"></i> Dashboard</a>
</li>    <?php if($warning_counts>0)
	{ 

	?>

                  <?php if($admin_accesscheck == "1" or $admin_accesscheck =="2" ){ ?>
				  <li><a><i class="fa fa-wrench"></i>System Configuration <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="Create_New_Org.php">Add School Information</a></li>
                      <li><a href="add_Courses.php?view=addc">Add / View Courses</a></li>
                      <li><a href="add_Dept.php">Add Department</a></li>
                      <li><a href="add_Faculty.php">Add <?php echo $SCategory; ?></a></li>
                      <li><a href="add_Bank.php">Add Bank</a></li>
                        <li><a href="add_level.php">Add Level</a></li>
                        <li><a href="user_Private.php?view=Aftype">Add Fee Type</a></li>
                        <li><a href="add_form.php">Add Forms</a></li>
                     <li><a href="add_Yearofstudy.php">Add Year Of Study</a></li>
                       <li><a href="add_Program.php">Add Program Type</a></li>
                         <li><a href="add_Courses.php?view=addMode">Add Entry Mode</a></li>
                          <li><a href="add_grade.php">Add Grade</a></li>
                          <li><a href="add_role.php">Add / Edit role</a></li>
                    </ul>
                  </li>
                  <?php } ?><!-- <pre><?php //print_r($_SESSION["access3"]); ?></pre> --!>
                  
                  
                  
                  
                  <?php foreach ($_SESSION["access3"] as $key => $access) { ?>
                        <li>
<?php if($access["top_menu_order"] > 0){ ?>

<a><i class="<?php echo $access["top_menu_icon"]; ?>"></i> <?php echo $access["top_menu_name"]; ?> <span class="fa fa-chevron-down"></span></a>
<!--        <a href="#">
                    <i class="<?php //echo $access["top_menu_icon"]; ?>"></i> <span>    <?php //echo $access["top_menu_name"]; ?></span> <i class="fa fa-angle-left pull-right"></i></a> --!>
                    
                    
                <?php }else{ foreach ($access as $k1 => $val2) { if ($k1 != "top_menu_name" and $k1 != "top_menu_icon" and $k1 != "top_menu_order") { ?>
                    
			 <li><a class="" href="<?php echo ($val2["page_name"]); ?>"><i class="<?php echo $access["top_menu_icon"]; ?>"></i><span class="text"><?php echo $access["top_menu_name"]; ?></span></a></li>		
					
				<!--	<li id="requests">
                  <a href="<?php //echo ($val2["page_name"]); ?>">
                      <i class="<?php //echo $access["top_menu_icon"]; ?>"></i> <span><?php //echo $access["top_menu_name"]; ?></span>
                  </a>
              </li> --!>
                 
                <?php }}} ?>
<?php
                        echo ' <ul class="nav child_menu">';
                        foreach ($access as $k => $val) {
                            if ($k != "top_menu_name" and $k != "top_menu_icon" and $k != "top_menu_order") {
                                echo '<li><a href="' . ($val["page_name"]) . '"> ' . $val["menu_name"] . '</a></li>';
                              ?>
                                <?php
                            }
                        }
                        echo '</ul>';
                        ?>



            </li>
        
                  <?php } ?> 
                  
                  
                  
                  
                  
                  <?php if($admin_accesscheck == "1"){ ?>
                  <li><a><i class="fa fa-users"></i>Staff Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="add_Users.php">Add System Users</a></li>
                      <li><a href="add_Staff.php">Add/Edit Staff</a></li>
                    <li><a href="allot_Courses.php">Allocate Course</a></li>
                    </ul>
                  </li>
                  <?php } ?>
                    <?php if($admin_accesscheck == "2"){ ?>
                  <li><a><i class="fa fa-users"></i>Staff Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="add_Users.php">Add System Users</a></li>
                      <li><a href="add_Staff.php">Add/Edit Staff</a></li>
                    <li><a href="allot_Courses.php">Allocate Course</a></li>
                    </ul>
                  </li>
                  <?php } ?>
                    <?php if($admin_accesscheck == "1" or $admin_accesscheck =="2" ){ ?>
                  <li><a><i class="fa fa-user"></i>Student Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a href="Student_Record.php">Student Record Verification</a></li>
                      <li><a href="Student_Record.php?view=v_s">View Students List</a></li>
                      <li><a href="Student_Record.php?view=l_s">View / Edit Student</a></li>
                      <li><a href="Student_Record.php?view=s_tra">Transcript</a></li>
                
                     
                    </ul>
                  </li>
                   <li><a><i class="fa fa-graduation-cap"></i>Admission <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="new_apply.php?view=nlist">New Student Application</a></li>
                        <li><a href="new_apply.php?view=sech_r">Search Admission Record</a></li>
                      <li><a href="new_apply.php?view=export_s">Export Students Record</a></li>
                       <li><a href="new_apply.php?view=imp_a">Import Result</a></li>
                    </ul>
                  </li>
                    <li><a><i class="fa fa-file-text"></i>Result Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="Result_am.php?view=aimp_re">Result Upload</a></li>
                      <li><a href="Result_am.php?view=v_upa">View Uploaded Result</a></li>
                      <li><a href="Result_am.php?view=e_rec">Export Course List</a></li>
                      
                
                     
                    </ul>
                  </li>
                     <?php } ?>
                  <?php if($admin_accesscheck == "1"){ ?>
				<li><a><i class="fa fa-money"></i>Finance <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     <li><a href="add_Fees.php">Add Fees</a></li>
                      <li><a href="View_Payment.php">Confirm Payments</a></li>
                      <li><a href="View_Payment.php?view=v_p">View Payments</a></li>
                      <li><a href="formSales.php?view=formOrder">Form Sales</a></li>
                    </ul>
                  </li>
			<?php 	} ?>
			  <?php if($admin_accesscheck == "6"){ ?>
				<li><a><i class="fa fa-money"></i>Finance <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     <li><a href="add_Fees.php">Add Fees</a></li>
                      <li><a href="View_Payment.php">Confirm Payments</a></li>
                      <li><a href="View_Payment.php?view=v_p">View Payments</a></li>
                    </ul>
                  </li>
			<?php 	} ?>
                  
                  <?php if($admin_accesscheck == "1" or $admin_accesscheck =="2" ){ ?>
                  <li><a><i class="fa fa-building"></i>Hostel Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     <!-- <li><a href="add_Hostel.php">Add Hostel</a></li> --!>
                      <li><a href="add_Hostel.php?view=addH">Add / View Hostel</a></li> 
                      <li><a href="view_Rooms.php">View Rooms</a></li>
                     <li><a href="add_Hostel.php?view=roomR">View Room Request</a></li>
                     <li><a href="add_Hostel.php?view=allotR">Alloted Room(s) </a></li>
                      
                    </ul>
                  </li>
                  <!--
                   <li><a><i class="fa fa-book"></i>Library  Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     
                      <li><a href="#">Add Books</a></li>
                     
                    </ul>
                  </li> --!>
                  
                  <li><a><i class="fa fa-clock-o"></i>Set Time Table<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">Exam Table</a></li>
                      <li><a href="lecture_time.php?view=l_add">Lecture Time</a></li>
                     
                    </ul>
                  </li>
                  	<?php 	} ?>
                  <li><a><i class="fa fa-comment"></i>Notification<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="News_events.php">Add News and Events</a></li>
                       <li><a href="message_m.php">Messages</a></li>
                     </ul>
                  </li>
                  <?php if($admin_accesscheck == "1"){ ?>
                  <li><a><i class="fa fa-book"></i>System Logs <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="activity_log.php">Activity Logs</a></li>
                      <li><a href="user_logs.php">User Logs</a></li>
                    </ul>
                  </li>
                   <?php } ?>
                   <li><a class="" href="#"><i class="fa fa-camera"></i><span class="text">Gallery Management</span></a></li>
                       <?php if($admin_accesscheck == "1"){ ?>
                  <li><a class="" href="Backup.php"><i class="fa fa-database"></i><span class="text">Backup Database</span></a></li>
                  <?php } ?>
                  <?php }else{ }?>
                  <li><a class="" href="logout.php"><i class="fa fa-sign-out"></i><span class="text">Log Out</span></a></li>
                
				</ul> 
                
              </div>
              
             

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
          