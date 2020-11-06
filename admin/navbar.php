  <!-- top navigation -->
<?php check_malert(); ?>
  <?php


    

   $query= mysqli_query($condb,"select * from admin where admin_id  = '$session_id'")or die(mysqli_error($condb));
						   $staff_row = mysqli_fetch_array($query);
						   $thedate=date("U");
		$checktime=$thedate-200;
	if(strlen($staff_row['username'])>1)
  { 
$uprecords="Update admin set lasttime='$thedate' where admin_id='$row[admin_id]'";
        mysqli_query($condb,$uprecords) or die("Could not update records");
         if($row['tsgone']<$checktime)
  {
    $updatetime="Update admin set tsgone='$thedate', oldtime='$row[tsgone]' where admin_id='$row[admin_id]'";
    mysqli_query($condb,$updatetime) or die("Could not update time");
  }

   }
   $exists = imgExists($row['adminthumbnails']);
 
						 ?>
        <div class="top_nav">
          <div class="nav_menu">
       <?php   if($pr_count > 0){
	if($class_ID > 0){}else{ ?>
                <script>
 $(document).ready(function(){
      $('#myModalat6').modal({
			backdrop: 'static'
		});
		            $('#myModalat6').draggable({
    handle: "#modal-header"
  });
    });
      
            
</script>
					<?php	}}else{ ?><script>
$(document).ready(function(){
      $('#myModalat7').modal({
			backdrop: 'static'
		});
		            $('#myModalat7').draggable({
    handle: "#modal-header"
  });
 }); 
      

</script>
 <?php
}
	$que_warning=mysqli_query($condb,"select * from session_tb where  Action='1' and prog = '".$class_ID."'");
	$warning_count=mysqli_num_rows($que_warning);
	
	$que_warning2=mysqli_query($condb,"select * from session_tb where Action='0' and prog = '".$class_ID."' ");
	$warning_count2=mysqli_num_rows($que_warning2);
	$warning_data2=mysqli_fetch_array($que_warning2);
	$numactive= $warning_data2['action'];
	
	//$warning_data=mysqli_fetch_array($que_warning);
$newSession   =	substr($warning_data2['session_name'],5,10);
$fSession   =	$warning_data2['session_name'];
//if($fSession === $year){ $que_warning3=mysqli_query($condb,"select * from session_tb where session_name = '$fSession' and Action='0' ");
//$warning_data3=mysqli_fetch_array($que_warning3);}
if($warning_count>0){}else{
?>

<script>
 $(document).ready(function(){
        //$('#myModal234').fadeIn('fast');
          $('#myModalat').modal({
			backdrop: 'static'
		});
  		          $('#myModalat').draggable({
    handle: "#modal-header"
  });
    });
 </script>
<?php	
	}    $sessionlock = $_SESSION['loggedAt2'];
     if(isset($_SESSION['loggedAt2']) && (time() - $sessionlock > 1800)) {
               ?>
                <script>
            $(window).load(function(){
        $('#myModalat4').modal({
	backdrop: 'static'
		});
		$('#myModalat4').draggable({
    handle: "#modal-header"
  });
      });
   </script>
 <?php
 //redirect(host()."Userlogin.php");
 unset($_SESSION['id'], $sessionlock);
//exit;
}else{
$_SESSION['loggedAt2'] = time();
}
?>
<?php	//}
//$current_url6 	= "";//base64_decode($_GET["return_urlx"]);
?>

            <nav>
              <div class="nav toggle" >
                <a id="menu_toggle"><i class="fa fa-bars"> </i></a>
                
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php  if ($exists > 0 ){print $row['adminthumbnails'];
	}else{ print "uploads/NO-IMAGE-AVAILABLE.jpg";}
				  
				  
				  
				 // echo $row['adminthumbnails']; ?>" alt="">&nbsp;<?php echo $row['firstname']." ".$row['lastname'];  ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="user_Private.php?view=UPRO"><i class="fa fa-user pull-right"></i>User Profile</a></li>
                    <li><a href="new_apply.php?view=spro"><i class="fa fa-briefcase pull-right"></i>Switch Program</a></li>
                    <li>
                      <!--<a href="#myModal3" data-toggle="modal">
                       <span><i class="fa fa-image pull-right"></i>Change Picture</span>
                      </a> --!>
                      <a href="user_Private.php?view=UIm" >
                       <span><i class="fa fa-image pull-right"></i>Change Picture</span>
                      </a>
                    </li>
                    <li><a href="user_Private.php?view=UP"><i class="fa fa-lock pull-right"></i>Change Password</a></li>
                    						  
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
                <?php 
			$recent=date("U")-600;
$getusersonline="SELECT admin_id,username from admin where lasttime>'$recent'"; //grab from sql users on in last 15 minutes
$getusersonline2=mysqli_query($condb,$getusersonline) or die("Could not get users");
$num=mysqli_num_rows($getusersonline2);
$getusersonline1="SELECT stud_id,RegNo from student_tb where lasttime>'$recent'"; //grab from sql users on in last 15 minutes
$getusersonline21=mysqli_query($condb,$getusersonline1) or die("Could not get users");
$num1=mysqli_num_rows($getusersonline21);
$getusersonline4="SELECT staff_id,usern_id,email from staff_details where lasttime>'$recent'"; //grab from sql users on in last 15 minutes
$getusersonline24=mysqli_query($condb,$getusersonline4) or die("Could not get users");
$num2=mysqli_num_rows($getusersonline24);

				?>
		
<li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user"></i>
                    <span class="badge bg-green"><?php echo $num + $num1 + $num2; ?></span>Users Online 
                  </a></li>
                <li role="presentation" class="dropdown">
                
                <?php $getnewpms="SELECT * from b_pms where receiver='$session_id' and hasread='0' ";
        $getnewpms2=mysqli_query($condb,$getnewpms) or die("Could not get new PMs"); 
        $allpms=0; 
        $newpms=0;  
        while($getnewpms3=mysqli_fetch_array($getnewpms2))
        {
          $allpms++;
          if($getnewpms3['hasread']==0)
          {
            $newpms++;
          }
        }  ?>
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green"><?php echo $newpms; ?></span>
                  </a>
                  
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  	<?php
$listsql=mysqli_query($condb,"select *,UNIX_TIMESTAMP() - therealtime AS TimeSpent2 from b_pms where receiver='$session_id' and hasread='0' order by therealtime DESC limit 0,6 ");
				$num_load0 = mysqli_num_rows($listsql);
				
				while($rowsmall=mysqli_fetch_array($listsql))
				{ 
				$c1_id=$rowsmall['pmID'];
				$comment= ucfirst(substr($rowsmall['subject'],0,60));
				$timesennd=$rowsmall['vartime'];
				$sender=$rowsmall['sender'];
				$studentimage = mysqli_fetch_array(mysqli_query($condb,"SELECT * from student_tb where RegNo = '$sender'"));
					$staffimagev = mysqli_fetch_array(mysqli_query($condb,"SELECT * from staff_details where usern_id = '$sender'"));
					  $exists2 = imgExists("../Student/".$studentimage['images']);
   $exist3 = imgExists($staffimagev['images']);
				?>
                    <li>
                      <a href='message_m.php?view=sendM&ID=<?php echo $rowsmall['pmID']; ?>'>
                        <span class="image"> 
						<?php  if($rowsmall['r_status']=='1'){ ?>
						<img src="<?php if ($exists2 > 0 ){print "../Student/".$studentimage['images'];
	}else{ print "uploads/NO-IMAGE-AVAILABLE.jpg";}
						
						// if($studentimage['images']==NULL ){
	//print "./uploads/NO-IMAGE-AVAILABLE.jpg";
//	}else{
	//print $studentimage['images'];} ?>" alt="Profile Image" />
						<?php	}elseif($rowsmall['r_status']=='2'){ ?>
						<img src="<?php 
						if ($exists3 > 0 ){	print $staffimagev['image']; }else{ print "./uploads/NO-IMAGE-AVAILABLE.jpg"; }
						//if($staffimagev['image']==NULL ){
	//print "./uploads/NO-IMAGE-AVAILABLE.jpg";
//	}else{
	//print $staffimagev['image'];} ?>" alt="Profile Image" />
					<?php }else{ ?>
				<img src="<?php if($row['adminthumbnails']==NULL ){
	print "./uploads/NO-IMAGE-AVAILABLE.jpg";
	}else{
	print $row['adminthumbnails'];
	
} ?>" alt="Profile Image" />
				<?php	}  ?>
						</span>
                        <span>
                          <span><b><?php  if($rowsmall['r_status']=='1'){
							echo ucfirst(getstudent2($rowsmall['sender'])) ." (Student)";
							}elseif($rowsmall['r_status']=='2'){
						echo ucfirst(getstaff2($rowsmall['sender']))  ." (Staff)";
						}else{ 
					echo ucfirst(getadmin2($rowsmall['sender']))  ." (Admin)";
					}  ?> </b> </span>
                         
                        </span>
                        <span class="message">
                          <?php echo $comment; ?>
                        </span>
                         <span class="time"><?php $days = floor($rowsmall['TimeSpent2'] / (60 * 60 * 24));
			$remainder = $rowsmall['TimeSpent2'] % (60 * 60 * 24);
			$hours = floor($remainder / (60 * 60));
			$remainder = $remainder % (60 * 60);
			$minutes = floor($remainder / 60);
			$seconds = $remainder % 60;
	        if($days > 0)
			echo date('F d Y', $rowsmall['therealtime']);
			elseif($days == 0 && $hours == 0 && $minutes == 0)
			echo "few seconds ago";		
			elseif($days == 0 && $hours == 0)
			echo $minutes.' minutes ago';
			elseif($days == 0 )
			echo $hours.' hours ago';
			else
			echo date('F d Y', $rowsmall['therealtime']); ?></span>
                      </a>
                    </li>
                    <?php }?>
                    
                    <li>
                      <div class="text-center">
                      <?php if($num_load0 > 0){ ?>
                        <a href='message_m.php?unread=236'>
                          <strong>View All New Notification </strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                         <?php }else{ ?>
                         <a>
                          <strong>No New Messages</strong>
                          <!--<i class="fa fa-angle-right"></i> --!>
                        </a>
                          <?php } 
						  ?>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
              
              
            </nav>
         
          </div>
        </div>
        	<?php include('user_pop_ups.php'); ?>
        <!-- /top navigation -->