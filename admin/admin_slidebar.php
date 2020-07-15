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
              
                <h3>User Status :<?php echo getstatus($checkstatus);  ?></h3>
                <h3> <a  href="#" onclick="window.open('new_apply.php?view=spro','_self')"><font color="yellow"> <?php if($class_ID > 0){ echo "<i class='fa fa-check'></i>"." [".getprog($class_ID)."]"; }else{ echo "<i class='fa fa-close'></i>"."No Programme Selected";} 
	//$accno = rand(9999999999, 99999999999);
	//echo $accno = strlen($accno) != 10 ? substr($accno, 0, 10) : $accno;
 ?></font></a></h3>
             
                <ul class="nav side-menu">
   <!-- <li class="current-page"><a href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>    --!>
	<?php if($warning_counts>0)
	{ 

	?>

                  <?php //if($admin_accesscheck == "1" or $admin_accesscheck =="2" ){ ?>
				 
                  <?php //} ?><!-- <pre><?php //print_r($_SESSION["access3"]); ?></pre> --!>
                  
                  
                  
                  
                  <?php foreach ($_SESSION["access3"] as $key => $access) { ?>
                        <li>
<?php if($access["top_menu_order"] > 0){ ?>

<a><i class="<?php echo $access["top_menu_icon"]; ?>"></i> <?php echo $access["top_menu_name"] ; ?> <span class="fa fa-chevron-down"></span></a>
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
                  
                  
                  
                  
                  
                  <?php //if($admin_accesscheck == "1"){ ?><?php //} ?>
                    <?php //if($admin_accesscheck == "2"){ ?><?php //} ?>
                    <?php //if($admin_accesscheck == "1" or $admin_accesscheck =="2" ){ ?>
                 
                     <?php //} ?>
                  <?php //if($admin_accesscheck == "1"){ ?>	<?php //	} ?>
			  <?php //if($admin_accesscheck == "6"){ ?><?php //	} ?>
                  
                  <?php //if($admin_accesscheck == "1" or $admin_accesscheck =="2" ){ ?>
                  
                  <!--
                   <li><a><i class="fa fa-book"></i>Library  Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     
                      <li><a href="#">Add Books</a></li>
                     
                    </ul>
                  </li> --!>
                  
                  	<?php //	} ?>
                 
                  <?php //if($admin_accesscheck == "1"){ ?><?php //} ?>
                   <li><a class="" href="#"><i class="fa fa-camera"></i><span class="text">Gallery Management</span></a></li>
                       <?php //if($admin_accesscheck == "1"){ ?><?php //} ?><?php }else{ }?>
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
          