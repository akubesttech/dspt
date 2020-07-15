 
<?php  include('header.php'); ?>

<?php include('session.php');	 if(isset($_SESSION['staff']) and ($staff_accesscheck == '0')) {
	//header("location:".host()."Userlogin.php");
		echo "<script>alert('Access Not Granted To This User Please Contact System Administrator! $_SESSION[staff]');</script>";
		redirect("../Userlogin.php");
	
    //exit();
} ?>
	
	    

 <?php include('student_slidebar.php'); ?>
    <?php include('navbar.php');$exists = imgExists("../admin/".$user_row['image']);
 ?>
	    		
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Staff Dashboard</h3>
</div>

</div>



<div class="clearfix"></div>

 
				         <div class="col-lg-12">
                          <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                             <img  src="<?php  
				  //if ($user_row['image']==NULL ){print "uploads/NO-IMAGE-AVAILABLE.jpg";}else{print $user_row['image'];}
				  if ($exists > 0 ){print "../admin/".$user_row['image']; }else{ print "../admin/uploads/NO-IMAGE-AVAILABLE.jpg";}
	 ?>"   width="20" height="20"><?php $Hour =date('H');


if ( $Hour >= 5 && $Hour <= 11 ) {
    echo " Good Morning";
} else if ( $Hour >= 12 && $Hour <= 16 ) {
    echo " Good Afternoon";
} else if ( $Hour >= 16 && $Hour <= 18 ) {
    echo " Good Evening ";
}else if( $Hour >= 19 && $Hour <= 24 ) {
    echo " Good Night ";
}else if( $Hour >= 1 && $Hour <= 4 ) {
    echo " Good Morning ";
}  ?>!<strong> <?php echo $user_row['sname']." ".$user_row['mname'];  ?></strong> <?php $Hour =date('H');


if ( $Hour >= 5 && $Hour <= 11 ) {
    echo " How are You This Morning";
} else if ( $Hour >= 12 && $Hour <= 16 ) {
    echo " I hope You Find It Fun Using Our Portal";
} else if ( $Hour >= 16 && $Hour <= 18 ) {
    echo " Have a wonderful Evening ";
}else if( $Hour >= 19 && $Hour <= 24 ) {
    echo " Remember To Say Your Prayer Before Going To Bed Shalom! ";
}else if( $Hour >= 1 && $Hour <= 4 ) {
    echo " How are You This Morning wish successful Day Ahead!";
}  ?>
                          </div>
                            <?php
    
 // $curdate=date("Y/m/d");
    	  $date1=date("Y/m/d");
//mysqli_query($condb,"UPDATE session_tb SET action='0' WHERE start_end='$date1'")
//or die(mysqli_error($condb));
//mysql_close(); ?>
<?php
//$con = mysql_connect("localhost","root","");
//if (!$con)
  //{
  //die('Could not connect: ' . mysqli_error($condb));
  //}

// 
?>
                        </div>
                        

                  
                  
            <div class="row top_tiles">
            <?php
												/*	$user_query = mysqli_query($condb,"select * from packege_tb")or die(mysqli_error($condb));
													while($row = mysqli_fetch_array($user_query)){
													$id = $row['p_id'];
													$p_Category=$row['p_Category'];
													$amount=$row['p_Amount'];
														$matrice=$row['p_mnum'];
															$Return_investement=$row['Return_investement'];
															$MergeType=$row['assign_type'];
																$payoutType=$row['pay_type'];
																	$waletType=$row['walet_status'];
																	$cashoutType=$row['cashout_status '];
																	
																		$query_recordaku = mysqli_query($condb,"SELECT user_id FROM member_tb where p_Amount='$amount'  ")or die(mysqli_error($condb));
								$row_getaku = mysqli_num_rows($query_recordaku);
									$query_recordaku2 = mysqli_query($condb,"SELECT user_id FROM member_tb where merge_status='Merged' and p_Amount='$amount'  ")or die(mysqli_error($condb));
								$row_getaku2 = mysqli_num_rows($query_recordaku2);
									$query_recordaku3 = mysqli_query($condb,"SELECT user_id FROM member_tb where p_Amount='$amount' and merge_status=''  ")or die(mysqli_error($condb));
								$row_getaku3 = mysqli_num_rows($query_recordaku3); */
													?>
              
              <?php// } ?>
               <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                                                   	<?php 
                                                   
        
function birthday($birthday){ 
    $age = strtotime($birthday);
    
    if($age === false){ 
        return false; 
    } 
    
    list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age)); 
    
    $now = strtotime("now"); 
    
    list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now)); 
    
    $age = $y2 - $y1; 
    
    if((int)($m2.$d2) < (int)($m1.$d1)) 
        $age -= 1; 
        
    return $age; 
} 

          //$result3=mysqli_query($condb,"SELECT * FROM student left join class_tb ON class_tb.class_id = student.class_id where RegNo='$_GET[id]'");
  //  $rs3=mysqli_fetch_array($result3);
	     $student = mysqli_query($condb,"select * from staff_details where staff_id  = '$session_id'")or die(mysqli_error($condb));
		 $student = mysqli_fetch_array($student);
		  $student= $student['dob'];
	
		 ?>	
                          <div class="icon"><i class="fa fa-user"></i>
                          </div>
                          <div class="count"><?php echo birthday($student); ?></div>

                          <h3>Staff Age This Year</h3>
                          <a href="staff_Private.php?view=SPRO">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View Profile</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                        </div>
                      </div>
                      <?php 	$datetoday=date('Y-m-d');
	  $sqlattend = "SELECT EmpID,Prensent,AttDate, COUNT(*) FROM attendance where staff_id2='$session_id' and  Prensent = '1' and  AttDate = '$datetoday'  GROUP by EmpID ";
 $resultat = mysqli_query($condb, $sqlattend) or die (mysqli_error($condb)); 
 $num_rows =mysqli_num_rows ($resultat); ?>
                       <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-graduation-cap"></i>
                          </div>
                          <div class="count"><?php echo $num_rows;  ?></div>

                          <h3>Class Attendance Today</h3>
                         <a href="Course_m.php">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View Lecture Attendance For <?php echo $datetoday;  ?> </span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                        </div>
                      </div>
                      <?php 
$showoutresult = mysqli_query($condb,"select * from results where student_id='".$student_RegNo."' and grade ='F'")or die(mysqli_error($condb));
		 $showoutresult20 = mysqli_num_rows($showoutresult);

	              ?>
                       <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-user"></i>
                          </div>
                          <div class="count"><?php echo $showoutresult20; ?></div>

                          <h3>Unaproved Courses</h3>
                          <a href="course_manage.php?view=l_out">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View Course Registration </span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                        </div>
                      </div>
              
               <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                                      	<?php 
	     $schoolevent = mysqli_query($condb,"select * from news where news_type='Events' and status='TRUE'")or die(mysqli_error($condb));
		 $eventson = mysqli_num_rows($schoolevent);
		 ?>	
                          <div class="icon"><i class="fa fa-calendar"></i>
                          </div>
                          <div class="count"><?php echo $eventson; ?></div>

                          <h3>Up Coming Event</h3>
                         <a href="add_Hostel.php">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View Events</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                        </div>
                      </div>
                      
                                       <?php 
                                       $viewutme_querycon=mysqli_query($condb,"select * from course_allottb where assigned ='$session_id' and session ='$default_session'  and semester='$default_semester' ");
	             $count_courseallot = mysqli_num_rows($viewutme_querycon);
	    
		 ?>
                      <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-file-text"></i>
                          </div>
                          <div class="count"><?php echo $count_courseallot;?></div>

                          <h3>No of Courses Allocated

</h3>
                         <a href="Course_m.php?view=v_allot">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View Course Allocation</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                        </div>
                      </div>
                      		<?php
		// set default timezone
//date_default_timezone_set('Europe/London'); // CDT 
		date_default_timezone_set('US/Canada');
	     $log = mysqli_query($condb,"select * from session_tb where action='1'")or die(mysqli_error($condb));
		 $log2 = mysqli_num_rows($log);
		 	 $log3 = mysqli_fetch_array($log);
		 	 $academic =$log3['session_name'];
		 	 $academic2 =$log3['start_date'];
		 	 	 $academic3 =$log3['start_end'];
		 	 	 $acasemester =$log3['term'];
		 	 //$curdate=  date("Y/m/d",$academic2)- date("Y/m/d",$academic3)- date("Y/m/d");
		 	
//$datetime1 = date('2009-10-11');
//$datetime2 = date('2009-10-17');
//$interval = dateDiff($datetime1, $datetime2);
//echo $interval;



$curdate=date("Y/m/d");
//$diff2 = strtotime($curdate);
//$diff3 = round(diff2/86400);
function dateDiff($start, $end) {

$start_ts = strtotime($start);

$end_ts = strtotime($end);


$diff = $end_ts - $start_ts;

return round($diff / 86400);

}

//echo dateDiff($academic2, $curdate);


		 ?>	
                      <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-clock-o"></i>
                          </div>
                          <div class="count"><?php 
										if($log2<1){
									echo '0';
									}else{
								//echo $days;
										echo dateDiff($curdate,$academic3);
									}?></div>

                          <h3> No Of Days Remaning</h3>
                          <?php 
									if($log2<1){ ?>
                          
                        <a href="#"  rel="tooltip" id="addsession" title="New Semester Loading .">							  
                                <div class="modal-footer">
                                    <span class="pull-left">
								The Semester Has Ended
								</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                            	<script type="text/javascript">
									 $(document).ready(function(){
									 $('#addsession').tooltip('show');
									 $('#addsession').tooltip('hide');
									 });
									</script>
                            <?php	}else{ ?>
								<a href="#">							  
                                <div class="modal-footer">
                                    <span class="pull-left">
									<?php 
									
									echo 'Academic Session :'. $academic . ',Semester '. $acasemester ; ?>
									
								</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>	
                            <?php } ?>
                        </div>
                      </div>
                       
            </div>
           </div>
            </div>
        <!-- /page content -->
        
  
         <?php include('../admin/footer.php'); ?>