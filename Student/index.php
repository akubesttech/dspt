 
<?php  include('header.php'); ?>
<?php include('session.php'); ?>
	
	    

 <?php include('student_slidebar.php'); ?>
    <?php include('navbar.php');?>
	    		
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Student Dashboard <?php  //$scom =  getcomm("2","0","SAS/20/21/42069","2020/2021"); 
 //$scom2 = getcomm("2","2","SAS/20/21/42069","2020/2021");
 //$work = getsplit(18500,1.5,1.5,15,$scom,$scom2,3);
//echo $bassamount = getsplit($work,1.5,1.5,15,$scom,$scom2,0);
 ?></h3>
</div>

</div>



<div class="clearfix"></div>

 
				         <div class="col-lg-12">
                          <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                             <img  src="<?php    $existsop = imgExists($stud_row['images']);
	if($existsop > 0 ){ print $user_row['images']; }else{ print "uploads/NO-IMAGE-AVAILABLE.jpg";} ?>"   width="20" height="20"><?php 
	//date_default_timezone_set("America/New_York");
//echo "The time is " . date("h:i:sa");
//$ctextra = date('H')+5; if( $ctextra > 24){   $Hour = $ctextra - 24;}else{    $Hour = date('H')+5; }
	$Hour =date('H');


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
}  ?>!<strong> <?php echo $stud_row['FirstName']." ".$stud_row['SecondName'];  ?></strong> <?php $Hour =date('H');


if ( $Hour >= 5 && $Hour <= 11 ) {
    echo " How are You This Morning";
} else if ( $Hour >= 12 && $Hour <= 16 ) {
    echo " I hope You Find It Fun Using Our Portal";
} else if ( $Hour >= 16 && $Hour <= 18 ) {
    echo " Have a wonderful Evening ";
}else if( $Hour >= 19 && $Hour <= 24 ) {
    echo " Remember To Say Your Prayer Before Going To Bed Shalom! ";
}else if( $Hour >= 1 && $Hour <= 4 ) {
    echo " How are You This Morning ";
}  ?>
                          </div>
                            <?php
    
 // $curdate=date("Y/m/d");
    	  //$date1=date("Y/m/d");
    	    $date2=date("Y-m-d");
//mysqli_query($condb,"UPDATE session_tb SET action='0' WHERE start_end='$date1'")or die(mysqli_error($condb));

	$que_warning=mysqli_query($condb,"select * from session_tb where  Action='1' AND prog = '".safee($condb,$student_prog)."'");
	$warning_count=mysqli_num_rows($que_warning);
?>
  <?php	if($warning_count>0){}else{   ?> 
<script>
 $(document).ready(function(){
$('#myModalat2').modal({
	backdrop: 'static'
		});
 $('#myModalat2').draggable({
    handle: "#modal-header"
  });
    });
         
</script>
                  <?php } ?>
<?php
$sql_gset = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$student_prog)."' and grade_group ='01' Order by b_max ASC limit 1 ")or die(mysqli_error($condb)); $getmg = mysqli_fetch_array($sql_gset);  $getpass2 = $getmg['b_max']; 
$year=date('Y');  
    	$que_warning1=mysqli_query($condb,"select * from schoolsetuptd ");
	$warning_count1=mysqli_fetch_array($que_warning1);
	$Snoti = $warning_count1['Snoti']; 
	
//	$que_warning2=mysqli_query($condb,"select * from payment_tb where stud_reg ='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' and ft_cat='1' and level='".safee($condb,$student_level)."' OR app_no = '".safee($condb,$student_appNo)."' and session ='".safee($condb,$default_session)."' and ft_cat='1' and level='".safee($condb,$student_level)."'");
	//$warning_count2=mysqli_num_rows($que_warning2);
	if(empty($student_RegNo)){ $que_checkpay=mysqli_query($condb,"select SUM(paid_amount) as samount from payment_tb where app_no = '".safee($condb,$student_appNo)."' and session ='".safee($condb,$default_session)."' and pay_status='1' and ft_cat='1' and level = '".safee($condb,$student_level)."' ");}else{
$que_checkpay=mysqli_query($condb,"select SUM(paid_amount) as samount from payment_tb where stud_reg ='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' and pay_status='1' and ft_cat='1' and level = '".safee($condb,$student_level)."'  ");}
	$warning_count2=mysqli_num_rows($que_checkpay);	      
	$warning_data=mysqli_fetch_array($que_checkpay);   $sumpay = $warning_data['samount'];
	//$pay_status = $warning_data['pay_status'];
//$newSession   =	substr($warning_data['session'],5,10);
//$que_warning2=mysqli_query($condb,"select * from payment_tb where reg_id='$regNo' and session ='$default_session'");
	//$warning_count2=mysqli_num_rows($que_warning2);
	if($Snoti == 1)  
	{if(empty($epenable)){  }else{
	//if ($pay_status < 1 ){
	if($sumpay >= $com_amount and $sumpay > 0 and $nocomp >= $nocompm){  }else{
		//$warning_data=mysqli_fetch_array($que_warning);
		$warning_txt = $warning_data[0];
		
	
?>
<script>
 $(document).ready(function(){
$('#myModalat3').modal('show');
 $('#myModalat3').draggable({
    handle: "#modal-header"
  });
    });
         
</script>
 <?php	}}}//else{}}  ?> </div>
                   
                  
            <div class="row top_tiles">
            <?php 
//$que_warning2=mysqli_query($condb,"select * from payment_tb where stud_reg ='$student_RegNo' OR app_no = '$student_appNo' and session ='$default_session' and pay_status='1'");
	//$warning_count2=mysqli_num_rows($que_warning2);
													?>
              
             
               <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                                                   	<?php //$dt = new DateTime(); echo $dt->format('Y-m-d H:i:s');
                                                   
        
function birthday($birthday){ 
    $age = strtotime($birthday);
    if($age === false){ return false; } list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age)); 
    $now = strtotime("now"); 
    list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now)); 
    $age = $y2 - $y1; if((int)($m2.$d2) < (int)($m1.$d1)) $age -= 1; 
    return $age; } 

    
 $student2 = mysqli_query($condb,"select * from student_tb where stud_id  = '".safee($condb,$session_id)."'")or die(mysqli_error($condb));
		 $student3 = mysqli_fetch_array($student2);
		  $student4 = $student3['dob']; 
$date = str_replace('/', '-', $student4);
 $newDate = date("Y-m-d", strtotime($date));
  $studentdob   = substr($newDate,5,10);
	   $todaydate   =   substr($date2,5,10); 
		 ?>	<?php if($studentdob == $todaydate ){ ?>
                          <div class="icon"><i class="fa fa-gift"></i>
                          </div>
<div class="count" id="bday"><font color="green" size="4" >&nbsp;&nbsp;&nbsp;Happy  <span class="badge bg-green"><?php if(birthday($newDate) < 1){echo "0";}else{ echo birthday($newDate);}?></span> Birthday!</font></div>

                          <h3>Your Birthday is Today !</h3>
                          <a href="student_Private.php?view=SPRO">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View Profile</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                            <?php }else{?>
                            <div class="icon"><i class="fa fa-user"></i>
                          </div>
                          <div class="count"><?php if(birthday($newDate) < 1){echo "0";}else{ echo birthday($newDate);}
						  ?></div>

                          <h3>Student Age This Year</h3>
                          <a href="student_Private.php?view=SPRO">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View Profile<?php //echo $com_payamt."   ".$sumpay ; ?></span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                            
                           <?php }?>  
                        </div>
                      </div>
                      	<?php
		$dateat=date('M');
		$date2at=date('F'); 
	  	  $sqlat = "SELECT EmpID, month, session, prensent, COUNT(*) FROM attendance where EmpID ='$student_RegNo' and month ='$dateat'and session ='$default_session' and  prensent = '1' GROUP by month ";
	  $resultat = mysqli_query($condb,$sqlat) or die (mysqli_error($condb)); 
 $num_rows =mysqli_num_rows($resultat);
   $viewutme_queryconreg = mysqli_query($condb,"select * from coursereg_tb where sregno='$student_RegNo' and session ='$default_session' and semester='$acasemestertag' and creg_status='1' order by creg_id DESC ")or die(mysqli_error($condb));
		 $viewcourseregnewreg = mysqli_num_rows($viewutme_queryconreg);
		 
		 ?>
                       <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-graduation-cap"></i>
                          </div>
                          <div class="count"><?php if($num_rows == 0){ echo "0";}else{$attentc = floor($num_rows / $viewcourseregnewreg); 
						  echo $attentc;
						  }
						//$attentc = floor($num_rows / $viewcourseregnewreg); if($attentc < 1){ echo "0";}else{ echo $attentc;
						 // }
					
						?></div>

                          <h3>Class Attendance <?php echo $date2at;?></h3>
                         <a href="#">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View Lecture Attendance</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                        </div>
                      </div>
                      <?php 
$showoutresult = mysqli_query($condb,"select * from results where student_id='".$student_RegNo."' and total <= '".safee($condb,$getpass2)."'")or die(mysqli_error($condb));
		 $showoutresult20 = mysqli_num_rows($showoutresult);

	              ?>
                       <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-user"></i>
                          </div>
                          <div class="count"><?php echo $showoutresult20; ?></div>

                          <h3>Carryover Courses</h3>
                          <a href="course_manage.php?view=l_out">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View Carryover Courses </span>
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
                         <a href="student_Private.php?view=Evt">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View Events</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                            
                        </div>
                      </div>
                      
                      <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                        <?php  //$totalfee=0;
	//$resultf=mysqli_query($condb,"SELECT feetype,f_amount,f_dept FROM fee_db where f_dept='$student_dept' and program ='$student_prog'");
				 //$student_s = "Delta"; if($student_state == $student_s){
//$resultf=mysqli_query($condb,"SELECT feetype,f_amount,f_dept FROM fee_db where    Cat_fee = '1' and program ='$student_prog' and level = '".safee($condb,$student_level)."' "); }else{
//$resultf=mysqli_query($condb,"SELECT feetype,f_amount,f_dept FROM fee_db where    Cat_fee = '0' and program ='$student_prog' and level = '".safee($condb,$student_level)."'");} while($rsfee=mysqli_fetch_array($resultf)){ $totalfee = $totalfee + $rsfee['f_amount']; }
if($sumpay >= $com_amount and $sumpay > 0 and $nocomp >= $nocompm){ ?>
                    <div class="icon"><i class="fa fa-money"></i>
                          </div>
                          <div class="count"><font color="green">PAID </font></div>

                          <h3>You Have Paid </h3>
                            <a href="Spay_manage.php">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View Payment</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
			<?php  }else{  //$amtpaid ." ".$getDuepay;  ?>
			<div class="icon"><i class="fa fa-money"></i>
                          </div>
                          <div class="count"><strong> &#8358; <?php $fin = 0.00;	if(empty($amtpaid)){ echo number_format($com_payamt,2) + $penaltyamt; }else{ $fin = ($getDuepay + $penaltyamt) - $amtpaid; echo number_format($fin,2);}   ?></div>
						  <h3><?php if(empty($penaltyamt)){ ?>School Fee For The Session<?php }else{echo " Late Payment Panalty Added"; } ?></h3>
						  <a href="Spay_manage.php?view=a_p">							  
                                <div class="modal-footer">
                                    <span class="pull-left">Make Payment</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                           <?php } ?>
                        </div>
                      </div>
                      		<?php
		// set default timezone
//date_default_timezone_set('Europe/London'); // CDT 
		//date_default_timezone_set('USA/Canada');
	     $log = mysqli_query($condb,"select * from session_tb where action='1' and prog = '".$student_prog."'")or die(mysqli_error($condb));
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
/*function dateDiff($start, $end) {

$start_ts = strtotime($start);

$end_ts = strtotime($end);


$diff = $end_ts - $start_ts;

return round($diff / 86400);

}*/



/*function get_month_diff($start, $end = FALSE)
{
	$end OR $end = time();
	$start = new DateTime("@$start");
	$end   = new DateTime("@$end");
	$diff  = $start->diff($end);
	return $diff->format('%y') * 12 + $diff->format('%m');
}
*/

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
                             <?php 
	     $viewutme_querycon = mysqli_query($condb,"select * from coursereg_tb where sregno='$student_RegNo' and session ='$default_session'  and creg_status='1' order by creg_id DESC ")or die(mysqli_error($condb));
		 $viewcourseregnew = mysqli_num_rows($viewutme_querycon);
		 ?>
                      <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-file-text"></i>
                          </div>
                          <div class="count"><?php echo $viewcourseregnew;?></div>

                          <h3>Courses Registered

</h3>  <?php if(!empty($epenable)){  if($sumpay >= $com_amount and $sumpay > 0 and $nocomp >= $nocompm){  //if ($pay_status < 1 ){ ?>
<a href="course_manage.php?view=S_CO">							  
                                <div class="modal-footer">
                                    <span class="pull-left">Course Registration</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a><?php  }else{ ?>
                              <a href="#">							  
                                <div class="modal-footer">
                                    <span class="pull-left"><font color="red">Course Registration Not Active</font></span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                            <?php  }}else{ ?>
                            <a href="course_manage.php?view=S_CO">							  
                                <div class="modal-footer">
                                    <span class="pull-left">Course Registration</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                            <?php  } ?>
                        </div>
                      </div>
                       <?php 
	     $dept_query = mysqli_query($condb,"select * from dept ")or die(mysqli_error($condb));
		 $dept_count = mysqli_num_rows($dept_query);
		 ?>
                        <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-book"></i>
                          </div>
                          <div class="count"><?php //echo $dept_count;?>0</div>

                          <h3>No of Assignment

</h3>
                        <a href="#">							  
                                <div class="modal-footer">
                                    <span class="pull-left">Download Assignment</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                        </div>
                      </div>
                                    <?php 
	     $utme_query = mysqli_query($condb,"select * from new_apply1 where  reg_status = '1'")or die(mysqli_error($condb));
		 $utme_count = mysqli_num_rows($utme_query);
		 ?>
                           <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-book"></i>
                          </div>
                          <div class="count"><?php //echo $utme_count;?> 0</div>

                          <h3>No of Books

</h3>
                        <a href="#">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View Borrowed Books</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                        </div>
                      </div>
            </div>
          
           
        <!-- /page content -->
        
  
         <?php include('footer.php'); ?>