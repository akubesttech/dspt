  <?php //include('../member/user_pop_ups.php'); ?>	
 <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="../Student/" class="site_title"><i class="fa fa-paw"></i> <span><?php echo $row['initial'];   ?>!</span></a>
            </div>

            <div class="clearfix"></div>
	<?php $smato = $row['smat']; $query= mysqli_query($condb,"select * from student_tb where stud_id = '$session_id'")or die(mysqli_error($condb));
							  $row = mysqli_fetch_array($query); $existx = imgExists($row['images']);
							  //$checkstatus = $acastatus;
						 $enableinst = setinstallment;  $sshow = $row['istatus'];  $semailo = $row['e_address'];
							  if($student_state == "Delta"){ $scan = "1";}else{ $scan = "0";}
                              if($acastatus == 8){ $ftcat = "6";}else{$ftcat = "1";}$ft = "8";
$getDuepay = getDueamt($ftcat,$student_prog,$student_level,$scan);
$amtpaid = getpayamt($student_RegNo,$ftcat,$student_prog,$student_level,$default_session); 
 if(empty($amtpaid)){ $tn = "8";  }else{ $tn = "1"; }
$laspdate = getlpdate($student_RegNo,$ft,$student_prog,$student_level,$default_session,$scan);
$sumpay1 = getpayamt($student_RegNo,$ft,$student_prog,$student_level,$default_session); //$warning_data['samount']; 
$duep1 = getDueamt($ft,$student_prog,$student_level,$scan);
if($laspdate < 1 ){ $catp = "1";}else{ if($sumpay1 >= $duep1){ $catp = "1"; }else{  $catp = $tn; } }                           
 $qcompamt = "select * from fee_db where  level= '".safee($condb,$student_level)."' and program='".safee($condb,$student_prog)."'  and Cat_fee = '".safee($condb,$scan)."'  ";            
if($acastatus == 8){ $qcompamt.= " and ft_cat ='6' ";}else{
     if($laspdate < 1 ){$qcompamt.= " and ft_cat ='1' "; $penaltyamt = 0.00;}else{ $qcompamt.= " and ft_cat ='".safee($condb,$catp)."' "; $penaltyamt = $duep1;}}
if(($amtpaid < $getDuepay) AND ($enableinst > 1 ) AND ($acasemestertag == "First")){ $qcompamt.= " and status = '1' "; }
$qcompamtd = mysqli_query($condb,$qcompamt) or die(mysqli_error($condb)); $sumcreditm=0;
while($row_camt = mysqli_fetch_array($qcompamtd)){ 
$paysidm = $row_camt['fee_id']; $dpercm = $row_camt['pper']; 
$psdatem = $row_camt['psdate'];  $famountm =$row_camt['f_amount'];
$setend21 = $row_camt['edate'];$edate201 = str_replace('/', '-', $setend21 );
$date20m = str_replace('/', '-', $psdatem );  $newDate20m = date("d-m-Y", strtotime($date20m));  $date_nowm =  date("d-m-Y");
$penaltysumm = FeesCalc($famountm,$dpercm,$newDate20m); $difpm = $penaltysumm - $famountm ;

$nedate = date("d-m-Y", strtotime($edate201)); $timestamp2 = strtotime($nedate);
$date_now2 = new DateTime($date_nowm); $enddate    = new DateTime($nedate);

if($dpercm > 0 and $date_now2 < $enddate){  $namountm = $penaltysumm ; }else{  $namountm = $famountm; }
$sumcreditm += $namountm;  } $nocompm = mysqli_num_rows($qcompamtd);
if($sumcreditm > 0){   $com_payamt = $sumcreditm; }else{ $com_payamt = 0; } 

$qamt = "select * from feecomp_tb where level= '".safee($condb,$student_level)."' and prog='".safee($condb,$student_prog)."' and pstatus = '1' and session = '".safee($condb,$default_session)."' ";
if(empty($student_RegNo)){ $qamt.= " and regno = '".safee($condb,$student_appNo)."' ";}else{$qamt.= " and regno = '".safee($condb,$student_RegNo)."' ";}
if($acastatus == 8){ $qamt.= " and fcat ='6' ";}else{   if($laspdate < 1 ){ $qamt.= " and fcat ='1' ";}else{$qamt.= " and fcat ='".safee($condb,$catp)."' ";}}
$querycompamount = mysqli_query($condb,$qamt) or die(mysqli_error($condb));
//$querycompamount = mysqli_query($condb,"select * from feecomp_tb where fcat ='1' and level= '".safee($condb,$student_level)."' and prog='".safee($condb,$student_prog)."' and pstatus = '1' and session = '".safee($condb,$default_session)."' and regno = '".safee($condb,$student_appNo)."' ") or die(mysqli_error($condb));}else{
//$querycompamount = mysqli_query($condb,"select * from feecomp_tb where fcat ='1' and level= '".safee($condb,$student_level)."' and prog='".safee($condb,$student_prog)."' and pstatus = '1' and session = '".safee($condb,$default_session)."' and regno = '".safee($condb,$student_RegNo)."'") or die(mysqli_error($condb));} 
$sumcredito=0;
$nocomp = mysqli_num_rows($querycompamount); while($row_camount = mysqli_fetch_array($querycompamount)){ $famountc =$row_camount['f_amount'];
$sumcredito += $famountc;   }
if($sumcredito > 0){   $com_amount = $sumcredito; }else{ $com_amount = 0; }
						?>
						      <?php
						      //$que_checkpay=mysqli_query($condb,"select * from payment_tb where stud_reg ='".safee($condb,$student_RegNo)."' and session ='$default_session' and pay_status='1' and ft_cat='1' and level = '".safee($condb,$student_level)."' and paid_amount = '".safee($condb,$com_amount)."' ");
//$que_checkpay=mysqli_query($condb,"select * from payment_tb where stud_reg ='$student_RegNo' and session ='$default_session' and pay_status='1' OR app_no = '$student_appNo'");
	//$checkpay=mysqli_num_rows($que_checkpay);
	
	if(empty($student_RegNo)){ $que_checkpay=mysqli_query($condb,"select SUM(paid_amount) as samount from payment_tb where app_no = '".safee($condb,$student_appNo)."' and session ='".safee($condb,$default_session)."' and pay_status='".safee($condb,"1")."' and ft_cat='".safee($condb,$catp)."' and level = '".safee($condb,$student_level)."' ");
    }else{
$que_checkpay=mysqli_query($condb,"select SUM(paid_amount) as samount from payment_tb where stud_reg ='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' and pay_status='1' and ft_cat='".safee($condb,$catp)."' and level = '".safee($condb,$student_level)."'  ");}
	$warning_count2=mysqli_num_rows($que_checkpay);	      
	$warning_data=mysqli_fetch_array($que_checkpay);   $sumpay = $warning_data['samount'];
	
		?>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="./<?php  if ($existx > 0 ){print $row['images'];}else{print "uploads/NO-IMAGE-AVAILABLE.jpg";}
				  
				  
				 // echo $row['adminthumbnails']; ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome Back.</span>
                <h2>&nbsp;<?php echo $row['FirstName']." ".$row['SecondName'];  ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br>

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
              <?php if(!empty($smato)){ if(empty($sshow)){  ?>
                <h3> Username :<?php echo $semailo;  ?></h3><?php }else{ ?>
                <h3>Matric No :<?php echo $row['RegNo'];  ?></h3>
             <?php } }else{ ?>
                <h3>Matric No :<?php echo $row['RegNo'];  ?></h3> <?php } ?>
                <h3>Academic Status :<b><?php echo getAcastatus($row['acads']);  ?></b></h3>
                <ul class="nav side-menu">
                <li class="current-page"><a href="../Student/"><i class="fa fa-home"></i> Dashboard</a>
</li>
               
                  <li><a><i class="fa fa-user"></i>Student Records <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="student_Private.php?view=SPRO">Student Profile</a></li>
                    <li><a href="student_Private.php?view=Nclearance">New Student Clearance</a></li>
                    <li><a href="changeofcourse_m.php?view=capply">Change of Course</a></li> 
                    
                    </ul>
                  </li>
                  <?php  if(!empty($epenable)){
                   if($sumpay >= $com_amount and $sumpay > 0 and $nocomp >= $nocompm ){ //if($checkpay > 0){ ?>
                  <li><a><i class="fa fa-file-text"></i>View Results  <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="result_manage.php?view=S_re">Check Semester Results</a></li>
                      <li><a href="result_manage.php?view=S_re2">Calculate GPA</a></li>
                  <!--    <li><a href="new_apply.php">Calculate CGPA</a></li> --!>
                     </ul>
                  </li>
                  <li><a><i class="fa fa-book"></i>Course Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="course_manage.php?view=S_CO">Course Registration</a></li>
                      <li><a href="course_manage.php?view=r_co">Registered Courses</a></li>
                      <li><a href="course_manage.php?view=l_out">Oustanding Courses</a></li>
                  <!--    <li><a href="#">Courses Allocation</a></li> --!>
                
                     
                    </ul>
                  </li>
                  <?php }}else{ ?>
                  <li><a><i class="fa fa-file-text"></i>View Results  <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="result_manage.php?view=S_re">Check Semester Results</a></li>
                      <li><a href="result_manage.php?view=S_re2">Calculate GPA</a></li>
                  <!--    <li><a href="new_apply.php">Calculate CGPA</a></li> --!>
                     </ul>
                  </li>
                  <li><a><i class="fa fa-book"></i>Course Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="course_manage.php?view=S_CO">Course Registration</a></li>
                      <li><a href="course_manage.php?view=r_co">Registered Courses</a></li>
                      <li><a href="course_manage.php?view=l_out">Oustanding Courses</a></li>
                  <!--    <li><a href="#">Courses Allocation</a></li> --!>
                
                     
                    </ul>
                  </li>
                  <?php } ?>
                  <li><a><i class="fa fa-money"></i>School Fee Payment <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="Spay_manage.php">View Payments</a></li>
                      <li><a href="Spay_manage.php?view=a_p">Make Payments</a></li>
                    <!--  <li><a href="#">Print Payments</a></li> --!>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-building"></i>Hostel Record<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="shostel_manage.php?view=H_info">Hostel Information</a></li>
                      <li><a href="shostel_manage.php?view=Hrequest">Hostel Request</a></li>
                      <li><a href="shostel_manage.php?view=Hrenew">Hostel Renewal</a></li>
                      
                    </ul>
                  </li>
                  <?php if(!empty($epenable)){ if($sumpay >= $com_amount and $sumpay > 0 and $nocomp >= $nocompm ){ //if($checkpay > 0){ ?>
                   <li><a><i class="fa fa-ticket"></i>Election<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="select.php?view=s_e">Vote / Election Result (s)</a></li>
                    <!--  <li><a href="#">Election Result</a></li> --!>
                      
                      
                    </ul>
                  </li> <?php } }else{ ?>
                  <li><a><i class="fa fa-ticket"></i>Election<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="select.php?view=s_e">Vote / Election Result (s)</a></li>
                   </ul>
                  </li>
                  <?php } ?>
                  <!--
                   <li><a><i class="fa fa-book"></i>Library  Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     
                      <li><a href="#">Add Books</a></li>
                     
                    </ul>
                  </li> --!>
                  
                  <li><a><i class="fa fa-clock-o"></i>School Time Table<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="Time_manage.php">Exam Table</a></li>
                      <li><a href="Time_manage.php?view=s_time">Lecture Time</a></li>
                     
                    </ul>
                  </li>
                  
                  <li><a><i class="fa fa-comment"></i>Notification<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="student_Private.php?view=News">View News</a></li>
                        <li><a href="student_Private.php?view=Evt">View Events</a></li>
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
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
           <?php 
       