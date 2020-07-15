  <?php //include('../member/user_pop_ups.php'); ?>	
 <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span><?php echo $row['initial'];  ?>!</span></a>
            </div>

            <div class="clearfix"></div>
	<?php $query= mysqli_query($condb,"select * from staff_details where staff_id = '$session_id'")or die(mysqli_error($condb));
							  $row = mysqli_fetch_array($query);
							  $checkstatus = $row['access_level2'];
							  $existo = imgExists("../admin/".$row['image']);
						?>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php  //if ($row['image']==NULL ){print "uploads/NO-IMAGE-AVAILABLE.jpg";}else{print $row['image'];}
			if ($existo > 0 ){print "../admin/".$row['image']; }else{ print "../admin/uploads/NO-IMAGE-AVAILABLE.jpg";}	  
				  
				 // echo $row['adminthumbnails']; ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome Back.</span>
                <h2>&nbsp;<?php echo $row['sname']." ".$row['mname'];  ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br>

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
              
                <h3>User Status :<?php echo getstatus2($checkstatus);  ?></h3>
                <ul class="nav side-menu">
                <li class="current-page"><a href="index.php"><i class="fa fa-home"></i> Dashboard</a>
</li>
               
                  <li><a><i class="fa fa-file-text"></i>Result Managment <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="Result_m.php?view=imp_re">Result Upload</a></li>
                      <li><a href="#">View Student Result</a></li>
                      <li><a href="Result_m.php?view=v_up">View Uploaded Result</a></li>
                     </ul>
                  </li>
                  
                    <li><a><i class="fa fa-book"></i>Course Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     <li><a href="Course_m.php?view=v_allot">View Course Allocation</a></li>
                   <li><a href="Course_m.php?view=e_co">Export Course List</a></li>
                  
                    </ul>
                  </li>
                  <!--
                  <li><a><i class="fa fa-money"></i>School Fee Payment <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">View Payments</a></li>
                      <li><a href="#">Make Payments</a></li>
                      <li><a href="#">Print Payments</a></li>
                    </ul>
                  </li> --!>
                  <li><a><i class="fa fa-building"></i>Hostel Record<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="add_Hostel.php">Hostel Information</a></li>
                      <li><a href="view_Rooms.php">Hostel Request</a></li>
                      <li><a href="#">Hostel Payment</a></li>
                      
                    </ul>
                  </li>
                  
                   <li><a><i class="fa fa-book"></i>Library  Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     
                      <li><a href="#">Add Books</a></li>
                     
                    </ul>
                  </li>
                  
                  <li><a><i class="fa fa-clock-o"></i>School Time Table<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">Exam Table</a></li>
                      <li><a href="Time_manage.php?view=s_time">Lecture Time</a></li>
                     
                    </ul>
                  </li>
                  
                  <li><a><i class="fa fa-comment"></i>Notification<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="#">View News and Events</a></li>
                        <li><a href="message_m.php">Messages</a></li>
                     </ul>
                  </li>
                 
                   
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
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
           <?php 

        ?>