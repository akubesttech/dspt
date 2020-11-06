 
<?php  include('header.php');  ?>
<?php include('session.php'); //unset($_SESSION["select_pro"]);

?>
	<?php 
	
	if (!isset($_SESSION["access3"])) {

    try {

        //$sql = "SELECT mod_modulegroupcode, mod_modulegroupname,mod_modulegroupicon,mod_moduleorder FROM module "
                //. " WHERE 1 GROUP BY mod_modulegroupcode "
                //. " ORDER BY mod_modulegrouporder ASC, mod_moduleorder ASC  ";
 $sql = "SELECT mod_modulegroupcode, mod_modulegroupname,mod_modulegroupicon,mod_moduleorder,mod_modulegrouporder FROM module "
                . "WHERE 1  GROUP BY mod_modulegroupcode , mod_modulegroupname,mod_modulegroupicon,mod_moduleorder,mod_modulegrouporder "
                . " ORDER BY mod_modulegrouporder ASC, mod_moduleorder ASC  ";

        $stmt = $DB2->prepare($sql);
     $stmt->execute();
        $commonModules = $stmt->fetchAll();

$sql = "SELECT mod_modulegroupcode, mod_modulegroupname,mod_modulegroupicon, mod_modulepagename,  mod_modulecode, mod_modulename,mod_moduleorder FROM module "
                . " WHERE 1 "
                . " ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";

        $stmt = $DB2->prepare($sql);
        $stmt->execute();
        $allModules = $stmt->fetchAll();

        $sql = "SELECT rr_modulecode, rr_create,  rr_edit, rr_delete, rr_view FROM role_rights "
                . " WHERE  rr_rolecode = :rc "
                . " ORDER BY `rr_modulecode` ASC  ";

        $stmt = $DB2->prepare($sql);
        $stmt->bindValue(":rc", $_SESSION["alevel1"]);
        
        
        $stmt->execute();
        $userRights = $stmt->fetchAll();

        $_SESSION["access3"] = set_rights($allModules, $userRights, $commonModules);//set_rights($allModules, $userRights, $commonModules);

    } catch (Exception $ex) {

        echo $ex->getMessage();
    }
}
//total student
$stud_rec = mysqli_query($condb,"select * from student_tb WHERE app_type ='".safee($condb,$class_ID)."'")or die(mysqli_error($condb)); $stud_count = mysqli_num_rows($stud_rec);
//total student delta 
$stud_rec2 = mysqli_query($condb,"select * from student_tb WHERE app_type ='".safee($condb,$class_ID)."' AND state = 'Delta' ")or die(mysqli_error($condb)); $stud_count2 = mysqli_num_rows($stud_rec2);   $nonIndigene = $stud_count - $stud_count2;
//no of level indigene
$nooflevel=mysqli_query($condb,"SELECT DISTINCT level FROM fee_db where  ft_cat = '1' and Cat_fee = '1' and status ='1' and program ='".safee($condb,$class_ID)."' "); $clind = mysqli_num_rows($nooflevel);
//no of level noindigene
$noofleveln=mysqli_query($condb,"SELECT DISTINCT level FROM fee_db where  ft_cat = '1' and Cat_fee = '0' and status ='1' and program ='".safee($condb,$class_ID)."' "); $clnind = mysqli_num_rows($noofleveln);

//Indigene
$qindigene=mysqli_query($condb,"SELECT  SUM(f_amount)as totalamounti  FROM fee_db where  ft_cat = '1' and Cat_fee = '1' and status ='1' and program ='".safee($condb,$class_ID)."' "); $get_amountin = mysqli_fetch_array($qindigene);  if($clind > 0 ){$amountin = $get_amountin['totalamounti']/$clind;}else{ $amountin = $get_amountin['totalamounti'];} 
$amountinet = $amountin * $stud_count2;
//Non Indigene
$qnon_indigene=mysqli_query($condb,"SELECT SUM(f_amount)as totalamountn FROM fee_db where  ft_cat = '1' and Cat_fee = '0' and status ='1' and program ='".safee($condb,$class_ID)."' "); $get_amountnon = mysqli_fetch_array($qnon_indigene);  
if($clnind > 0 ){$amountnon = $get_amountnon['totalamountn']/$clnind;}else{ $amountnon = $get_amountnon['totalamountn']; }
$amountnonnet = $amountnon * $nonIndigene; $expectedrevenue = $amountinet + $amountnonnet;
//Revenue Generated
$qgetrg = mysqli_query($condb,"select SUM(paid_amount)as totalamount from payment_tb where prog ='".safee($condb,$class_ID)."' and session ='".safee($condb,$default_session)."' and pay_status='1' and ft_cat = '1' ")or die(mysqli_error($condb)); $get_revgen = mysqli_fetch_array($qgetrg); 
$genrevenue = $get_revgen['totalamount'] ; $outstandingrev = $expectedrevenue - $genrevenue;
//echo $amountnon;
	?>
<?php include('admin_slidebar.php'); ?>
<?php include('navbar.php');?>
	    		
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3> <?php echo getstatus($checkstatus)." Dashboard";//if($admin_accesscheck == "1"){ echo "Admin Dashboard";}elseif($admin_accesscheck == "2"){ echo "Admin Dashboard ";}else{ echo "Bursary Dashboard";} ?></h3>
</div>

</div>



<div class="clearfix"></div>
<div class="col-lg-12">
                          <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                             <img  src="<?php  
//if ($staff_row['adminthumbnails']==NULL ){print "uploads/NO-IMAGE-AVAILABLE.jpg";}else{print $staff_row['adminthumbnails'];}
if ($exists > 0 ){print $staff_row['adminthumbnails'];}else{ print "uploads/NO-IMAGE-AVAILABLE.jpg";} ?>"   width="20" height="20">
<?php  $Hour = date('H');
//$ctextra = date('H')+5; if( $ctextra > 24){   $Hour = $ctextra - 24;}else{    $Hour = date('H')+5; }
 //$currentime = strtotime(date("Y-m-d H:i:s"));
  //$mines = strtotime(date("H"));
  //$remainder = $currentime % (60 * 60 * 24);
			//echo $hours = floor($remainder / (60 * 60));
			
if ( $Hour >= 5 && $Hour < 12 ) {
    echo " Good Morning";
} else if ( $Hour >= 12 && $Hour < 16 ) {
    echo " Good Afternoon";
} else if ( $Hour >= 16 && $Hour <= 18 ) {
    echo " Good Evening ";
}else if( $Hour >= 19 && $Hour <= 24 ) {
    echo " Good Night ";
}else if( $Hour >= 1 && $Hour <= 4 ) {
    echo " Good Morning ";
}  ?>!<strong> <?php echo $staff_row['firstname']." ".$staff_row['lastname'];  ?></strong> <?php //$Hour =date('H');


if ( $Hour >= 5 && $Hour < 12 ) {
    echo " How are You This Morning";
} else if ( $Hour >= 12 && $Hour < 16 ) {
    echo " I hope You Find It Fun Using Our Portal";
} else if ( $Hour >= 16 && $Hour <= 18 ) {
    echo " Have a wonderful Evening ";
}else if( $Hour >= 19 && $Hour <= 24 ) {
    echo " Remember To Say Your Prayer Before Going To Bed Shalom! ";
}else if( $Hour >= 1 && $Hour <= 4 ) {
    echo " How are You This Morning ";
}  ?>
                          </div>
    <?php if (authorize($_SESSION["access3"]["dboard"]["main"]["delete"])){ ?>                     
<div class="row top_tiles"><div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="tile-stats">
<div class="count" >&#8358;<span class="countn2"><?php if($expectedrevenue > 0){ echo number_format($expectedrevenue,2);}else{echo "0.00";} ?></span></div><p></p><h3>Expected Revenue</h3></div></div>
<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="tile-stats"><!--<div class="icon"><i class="fa fa-money"></i></div>--!><div class="count">&#8358;<span class="countn2"><?php if($genrevenue > 0){ echo number_format($genrevenue,2);}else{echo "0.00";} ?> </span></div><p></p><h3>Revenue Generated</h3></div></div>
<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="tile-stats"><!--<div class="icon"><i class="fa fa-money"></i></div>--!><div class="count">&#8358;<span class="countn2"><?php if($outstandingrev > 0){ echo number_format($outstandingrev,2);}else{echo "0.00";} ?> </span> </div><p></p><h3>Outstanding</h3></div> </div> </div>
     <?php }
//$con = mysql_connect("localhost","root","");
//if (!$con)
  //{
  //die('Could not connect: ' . mysql_error());
  //}

//mysql_select_db("smsdb", $con);
  //  date("Y/m/d");
    $year=date('Y');
	//$que_warning=mysqli_query($condb,"select * from session_tb where start_end='$date1' and Action='0'");

?>
                        </div>
                        

                  
                  
            <div class="row top_tiles">
            <?php
												/*	$user_query = mysqli_query($condb,"select * from packege_tb")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
													$id = $row['p_id'];
													$p_Category=$row['p_Category'];
													$amount=$row['p_Amount'];
														$matrice=$row['p_mnum'];
															$Return_investement=$row['Return_investement'];
															$MergeType=$row['assign_type'];
																$payoutType=$row['pay_type'];
																	$waletType=$row['walet_status'];
																	$cashoutType=$row['cashout_status '];
																	
																		$query_recordaku = mysqli_query($condb,"SELECT user_id FROM member_tb where p_Amount='$amount'  ")or die(mysql_error());
								$row_getaku = mysql_num_rows($query_recordaku);
									$query_recordaku2 = mysqli_query($condb,"SELECT user_id FROM member_tb where merge_status='Merged' and p_Amount='$amount'  ")or die(mysql_error());
								$row_getaku2 = mysql_num_rows($query_recordaku2);
									$query_recordaku3 = mysqli_query($condb,"SELECT user_id FROM member_tb where p_Amount='$amount' and merge_status=''  ")or die(mysql_error());
								$row_getaku3 = mysql_num_rows($query_recordaku3); */
													?>
              
              <?php// } ?>
              <?php   if (authorize($_SESSION["access3"]["dboard"]["main"]["create"])){ ?>
               <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                                                   	<?php 
	     $staff_rec = mysqli_query($condb,"select * from staff_details")or die(mysqli_error($condb));
		 $staff_count = mysqli_num_rows($staff_rec);
		 ?>	
                          <div class="icon"><i class="fa fa-group"></i>
                          </div>
                          <div class="count"><?php echo $staff_count; ?></div>
                           <h3>All Staff</h3>
                         <a href="add_Staff.php">							  
                                <div class="modal-footer">
                                    <span class="pull-left">Add Staff</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a></div></div><?php } ?>
                                                         	<?php 
	     
		 ?>	<?php   if (authorize($_SESSION["access3"]["dboard"]["main"]["view"])){ ?>
                       <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-graduation-cap"></i>
                          </div>
                          <div class="count"><?php echo $stud_count; ?></div>
                          <h3>All Students</h3>
                         <a href="Student_Record.php?view=v_s">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View Student Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div></a></div>
                      </div><?php } ?>
                      <?php  $pay_rec = mysqli_query($condb,"select * from payment_tb where pay_status = '0' and session = '".safee($condb,$default_session)."' AND prog = '".safee($condb,$class_ID)."' and  DATE(pay_date) > (CURDATE() - INTERVAL 7 DAY) order by pay_id DESC LIMIT 0,800")or die(mysqli_error($condb));
		 $pay_count = mysqli_num_rows($pay_rec); ?>
		 <?php   if (authorize($_SESSION["access3"]["dboard"]["main"]["edit"])){ ?>
                       <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-money"></i>
                          </div><div class="count"><?php echo $pay_count; ?></div>
                           <h3>New Payment</h3>
                          <a href="View_Payment.php">							  
                                <div class="modal-footer">
                                    <span class="pull-left">Approve Payments</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a></div></div><?php } ?>
              <?php   if (authorize($_SESSION["access3"]["dboard"]["main"]["create"])){ ?>
               <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                                      	<?php 
	     $hostedb = mysqli_query($condb,"select * from hostedb")or die(mysqli_error($condb));
		 $hostedb = mysqli_num_rows($hostedb);
		 ?>	
                          <div class="icon"><i class="fa fa-building"></i>
                          </div>
                          <div class="count"><?php echo $hostedb; ?></div>

                          <h3>All Hostel</h3>
                            
                         <a href="add_Hostel.php">							  
                                <div class="modal-footer">
                                    <span class="pull-left">Add Hostel</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                         
                        </div>
                      </div>
                       <?php }?>
                       <?php   if (authorize($_SESSION["access3"]["dboard"]["main"]["delete"])){ ?>
                      <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                        	<?php 
	     $log = mysqli_query($condb,"select * from activity_log")or die(mysqli_error($condb));
		 $log = mysqli_num_rows($log);
		 ?>	
                          <div class="icon"><i class="fa fa-tasks"></i>
                          </div>
                          <div class="count"><?php echo $log; ?></div>

                          <h3>Activity Logs</h3>
                          
                            <a href="activity_log.php">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View Past Activities</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                          </div>
                      </div> <?php }?>
                      		<?php
		// set default timezone
//date_default_timezone_set('Europe/London'); // CDT 
		//date_default_timezone_set('US/Canada');
        //date_default_timezone_set('America/Los_Angeles');
	     $log = mysqli_query($condb,"select * from session_tb where action='1' and prog = '".$class_ID."'")or die(mysqli_error($condb));
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
							//	echo $days;
										echo dateDiff($curdate,$academic3);
									}?></div>

                          <h3> No Of Days Remaning</h3>
                          <?php 
									if($log2<1){ ?>
                          
                        <a href="add_Yearofstudy.php"  rel="tooltip" id="addsession" title="Click To Setup Default Academic Session .">							  
                                <div class="modal-footer">
                                    <span class="pull-left">
								Set Default Session / Semester
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
								<a href="add_Yearofstudy.php">							  
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
	     $fac_query = mysqli_query($condb,"select * from faculty ")or die(mysqli_error($condb));
		 $fac_count = mysqli_num_rows($fac_query);
		 ?><?php   if (authorize($_SESSION["access3"]["dboard"]["main"]["create"])){ ?>
                      <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-university"></i>
                          </div>
                          <div class="count"><?php echo $fac_count;?></div>

                          <h3><?php echo $SCategory; ?></h3>  
                         <a href="add_Faculty.php">							  
                                <div class="modal-footer">
                                    <span class="pull-left">Add <?php echo $SCategory; ?></span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>	</a></div></div>  <?php } ?>
                       <?php 
	     $dept_query = mysqli_query($condb,"select * from dept ")or die(mysqli_error($condb));
		 $dept_count = mysqli_num_rows($dept_query);
		 ?>              <?php   if (authorize($_SESSION["access3"]["dboard"]["main"]["create"])){ ?>
                        <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-university"></i>
                          </div>
                          <div class="count"><?php echo $dept_count;?></div>
                        <h3><?php echo $SGdept1; ?></h3> 
                        <a href="add_Dept.php">							  
                                <div class="modal-footer">
                                    <span class="pull-left">Add <?php echo $SGdept1; ?></span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a></div></div>
                            <?php } ?>
<?php $utme_query = mysqli_query($condb,"select * from new_apply1 where  reg_status = '1' and Asession = '".safee($condb,$default_secadmin)."' and app_type = '".safee($condb,$class_ID)."' and application_r = '0' ")or die(mysqli_error($condb));
		 $utme_count = mysqli_num_rows($utme_query);
		 ?>
                           <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-user"></i>
                          </div>
                          <div class="count"><?php echo $utme_count;?></div>

                          <h3>UTME Student 

</h3></h3> <?php   if (authorize($_SESSION["access3"]["dboard"]["main"]["view"])){ ?>
                        <a href="new_apply.php">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View UTME Application - <?php echo $default_secadmin; ?></span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                             <?php }else{ ?>
                             <a href="#">							  
                                <div class="modal-footer">
                                    <span class="pull-left"><font color="red">View UTME Application Disabled</font></span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                             <?php } ?>
                        </div>
                      </div>
                          <?php $course_query = mysqli_query($condb,"select * from courses ")or die(mysqli_error($condb));
		 $course_count = mysqli_num_rows($course_query); ?>
                       <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-book"></i>
                          </div>
                          <div class="count"><?php echo $course_count;?></div>

                          <h3>Courses

</h3></h3> <?php   if (authorize($_SESSION["access3"]["dboard"]["main"]["view"])){ ?>
                        <a href="add_Courses.php?view=ViewCourses">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View Courses</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                             <?php }else{ ?>
                             <a href="#">							  
                                <div class="modal-footer">
                                    <span class="pull-left"><font color="red">View Courses Disabled</font></span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                             <?php } ?>
                        </div>
                      </div>
                      
                      
                                       <?php 
                                       $viewutme_querycon=mysqli_query($condb,"select * from course_allottb where assigned ='$session_id' and session ='$default_session'  and semester='$default_semester' ");
	             $count_courseallot = mysqli_num_rows($viewutme_querycon);
	    
		 ?><?php   if (authorize($_SESSION["access3"]["dboard"]["main"]["view"])){ ?>
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
                       <?php } ?>
                      
                      <?php 	$datetoday=date('Y-m-d');
	  $sqlattend = "SELECT EmpID,Prensent,AttDate, COUNT(*) FROM attendance where staff_id2='$session_id' and  Prensent = '1' and  AttDate = '$datetoday'  GROUP by EmpID "; $resultat = mysqli_query($condb, $sqlattend) or die (mysqli_error($condb)); 
 $num_rows =mysqli_num_rows ($resultat); ?>
                       <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-graduation-cap"></i>
                          </div>
                          <div class="count"><?php echo $num_rows;  ?></div>
                         <h3>Class Attendance Today</h3>
                         <a href="#">							  
                                <div class="modal-footer">
                                    <span class="pull-left">View Lecture Attendance For <?php echo $datetoday;  ?> </span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                        </div>
                      </div>
                      
                
              <!-- /bar charts --> 
                      
                      
                      
                
				
				
				      
            </div>
           
            
            
            
          </div>
        </div>
        <!-- /page content -->
        
     
         <?php include('footer.php'); ?>