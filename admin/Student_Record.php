
<?php  include('header.php'); ?>
<?php include('session.php');
/*	$status = FALSE;
if ( authorize($_SESSION["access3"]["stMan"]["srv"]["create"]) || 
authorize($_SESSION["access3"]["stMan"]["srv"]["edit"]) || 
authorize($_SESSION["access3"]["stMan"]["srv"]["view"]) || 
authorize($_SESSION["access3"]["stMan"]["srv"]["delete"]) ) {
 $status = TRUE;
}*/
//
$depart = isset($_GET['dept1_find']) ? $_GET['dept1_find'] : '';
$session = isset($_GET['session2']) ? $_GET['session2'] : '';
$pro_level =  isset($_GET['los']) ? $_GET['los'] : '';
$return_url = isset($_GET['return_urlx']) ? $_GET['return_urlx'] : '';
 if(empty($depart)){ $links = "Student_Record.php"; $return_url = "";}else{ $return_url 	= base64_decode($return_url);
    $links = "Student_Record.php?dept1_find=".$depart."&session2=".$session."&los=".$pro_level;}
    //$links = "Student_Record.php?dept1_find=".$dep1."&session2=".$sec1."&los=".$los;
 ?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php'); 
   $queryapp = "SELECT DISTINCT matric_no FROM clearance_files WHERE status <> 1 AND prog = '".safee($condb,$class_ID)."'";
	if($Rorder > 2){ $queryapp .= " AND dept = '$userdept'";}
   $qeryno = mysqli_query($condb,$queryapp)or die(mysqli_error($condb));
    $clearno = mysqli_num_rows($qeryno);
    /*	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} */ ?>
  <?php $get_RegNo = isset($_GET['userId']) ? $_GET['userId'] : ''; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>
<?php  if($class_ID > 0){ echo " Student Information Management [".getprog($class_ID)."]"; }else{ echo " Student Information Management";} 
	//$accno = rand(9999999999, 99999999999);
	//echo $accno = strlen($accno) != 10 ? substr($accno, 0, 10) : $accno;
 ?>
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
				
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>
<?php 	if (isset($_POST['delete_student'])){
	 if(empty($class_ID)){
				message("No Programme Record Selected Yet,please select to continue", "error");
				redirect($links);
			}elseif(empty($_POST['selector'])){
				message("Select at least One Student Record to proceed !", "error");
		       redirect($links);
				}else{ $id=$_POST['selector'];  $N = count($id);
for($i=0; $i < $N; $i++){$row = mysqli_query($condb,"select * from student_tb where stud_id ='".safee($condb,$id[$i])."' AND verify_Data ='FALSE' ");
	$checkdelete = "Unable to Delete Student(s) Record is already verified."; $dcolor = "error";
    $count=mysqli_num_rows($row);$rown=mysqli_fetch_array($row); 
    if($count > 0){ extract($rown); $checkdelete = "Student(s) Record Successfully Deleted ";$dcolor = "success";
    	mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'".safee($condb,$admin_username)."','
	Student Records of ".getname($appNo)." with Application No ".$appNo." in ".$SGdept1." of ".getdeptc($Department)." (".getprog($app_type).") was Deleted by ". $admin_username.". ')")or die(mysqli_error($condb));
	$resultd = mysqli_query($condb,"DELETE FROM student_tb where stud_id='$id[$i]'");
    }}
	message("".$checkdelete." .", $dcolor);
	redirect($links); }}
    
    if (isset($_POST['vegrecord'])){
	 if(empty($class_ID)){
				message("No Programme Record Selected Yet,please select to continue", "error");
				redirect($links);
			}elseif(empty($_POST['selector'])){
				message("Select at least one Student to proceed !", "error");
		        redirect($links);
				}else{ $id=$_POST['selector'];  $N = count($id);
for($i=0; $i < $N; $i++){$status = "TRUE";  $urllogin = host();
    $getsup=mysqli_query(Database ::$conn,"SELECT * FROM student_tb WHERE  stud_id ='".safee($condb,$id[$i])."' AND reg_status = '1'");
  $countv=mysqli_num_rows($getsup);$rown=mysqli_fetch_array($getsup);
  if($countv > 0){ extract($rown); 
  $sessionad  = $Asession; $department  = $Department; $pro = $app_type;
    $studentRegno = getmatno($sessionad,$department,$pro); $regcount = "1".getlstr($studentRegno,3);  $p_email = $e_address;
  $regNo1 = $RegNo; if(strlen($password < 1)){ $pass_word = substr(md5($regNo1.SUDO_M),14); $pshow = $studentRegno; }else{$pass_word = $password; $pshow = " Use password created during Registration "; }
$yearofgrag = $yoe + $prog_dura;
$msg = nl2br("Dear $FirstName $SecondName $Othername,.\n
	
	Your Academic Record was Successfully Verified .\n
	Find below your Matric Number and your CMS Password \n
	Matric Number :".$studentRegno.   "\n
	Password :".$pshow.   "\n
	..................................................................\n
    Please Login and reset your Password!\n
    
    This Message was Sent From " .$schoolNe ." @ ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
    For inquiry and complaint please email info@smartdelta.com.ng \n
	
	Thank You Admin!\n\n");

$subject="Student Record Verification CMS";
if(strlen($RegNo < 1)){
    //define the body of the message.
ob_start(); //Turn on output buffering
$mail_data = array('to' => $e_address, 'sub' => $subject, 'msg' => 'Notify','body' => $msg, 'srname' => $comn);
	send_email($mail_data);
$sql = mysqli_query(Database ::$conn,"UPDATE student_tb SET RegNo='".safee($condb,$studentRegno)."',verify_Data = '".safee($condb,$status)."',reg_count='".safee($condb,$regcount)."',password = '".safee($condb,$pass_word)."',yog = '".safee($condb,$yearofgrag)."' WHERE stud_id = '".safee($condb,$id[$i])."'"); //redirect("Student_Record.php?details&userId=");
}else{
$sql = mysqli_query(Database ::$conn,"UPDATE student_tb SET verify_Data = '".safee($condb,$status)."',password = '".safee($condb,$pass_word)."',yog = '".safee($condb,$yearofgrag)."' WHERE stud_id = '".safee($condb,$id[$i])."'"); //redirect("Student_Record.php?details&userId=");
}}}
	message(" Student(s) information  Successfully Verified .", "success");
	redirect($links); }}
    
    //change of Course validation
    if(isset($_POST['caccept'])){
	 if(empty($class_ID)){
				message("No Programme Record Selected Yet,please select to continue", "error");
				redirect("Student_Record.php?view=coc");
			}elseif(empty($_POST['selector'])){
				message("Select at least one Record to proceed !", "error");
		        redirect("Student_Record.php?view=coc");
				}else{ $id=$_POST['selector'];  $N = count($id);
for($i=0; $i < $N; $i++){$status = "TRUE";  $urllogin = host(); $staff = getstaff($session_id);
    $getsup=mysqli_query(Database ::$conn,"SELECT * FROM student_tb WHERE  stud_id ='".safee($condb,$id[$i])."' AND reg_status = '1'");
    $getccourse=mysqli_query(Database ::$conn,"SELECT * FROM coc_tb WHERE  sid ='".safee($condb,$id[$i])."' AND chod_app ='1' AND nhod_app ='1' AND pay_status = '1'");
  $countv=mysqli_num_rows($getsup);$rown=mysqli_fetch_array($getsup); $rowi=mysqli_fetch_array($getccourse);
  if($countv > 0){ extract($rown); extract($rowi); $cf = $n_fac; 
  $sessionad  = $Asession; $department  = $Department; $pro = $app_type; $cd = strtoupper(getdeptc($c_dept)); $nd = strtoupper(getdeptc($n_dept));
    $studentRegno = getmatno($sessionad,$department,$pro); $p_email = $e_address;
   if(empty($a_app)){ $regcount = "1".getlstr($studentRegno,3); }else{$regcount = $reg_count ;} 
  $regNo1 = $RegNo; $pass_word = substr(md5($studentRegno.SUDO_M),14);
  //if(empty($a_app)){ $pass_word = substr(md5($regNo1.SUDO_M),14); $pshow = $studentRegno; }else{$pass_word = $password; $pshow = " Use password created during Registration "; }
$std = getsnameid($sid);
$msg = nl2br("Dear $FirstName $SecondName $Othername,.\n
	Your Change of Course From ".$cd." to ".$nd." was Successfully Validated .\n
	Find below your New Matric Number and your CMS Password \n
	Matric Number :".$studentRegno.   "\n
	Password :".$studentRegno.   "\n
	..................................................................\n
    Please Login and reset your Password!\n
    
    This Message was Sent From " .$schoolNe ." @ ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
    For inquiry and complaint please email info@smartdelta.com.ng \n
	
	Thank You Admin!\n\n");
$subject="Change Of Course Validation CMS";
//define the body of the message.
ob_start(); //Turn on output buffering
$mail_data = array('to' => $e_address, 'sub' => $subject, 'msg' => 'Notify','body' => $msg, 'srname' => $comn);
	send_email($mail_data);
$sql = mysqli_query(Database ::$conn,"UPDATE student_tb SET RegNo='".safee(Database ::$conn,$studentRegno)."',Faculty = '".safee(Database ::$conn,$cf)."',Department = '".safee(Database ::$conn,$n_dept)."',reg_count='".safee(Database ::$conn,$regcount)."',password = '".safee(Database ::$conn,$pass_word)."' WHERE stud_id = '".safee(Database ::$conn,$id[$i])."'"); //redirect("Student_Record.php?details&userId=");
$sql2 = mysqli_query(Database ::$conn,"UPDATE coc_tb SET a_app = '1' WHERE sid ='".safee(Database ::$conn,$id[$i])."'");
mysqli_query(Database ::$conn,"insert into activity_log (date,username,action) values(NOW(),'".$admin_username."','$std Change of Course into $nd , validated by $staff ')")or die(mysqli_error(Database ::$conn)); 

}}
message("Student(s) Change of Course was Successfully Validated .", "success");
	redirect("Student_Record.php?view=coc"); }}
 ?>
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2><?php if($class_ID > 0){ ?> <a href='javascript:void(0);' onclick="window.open('Student_Record.php?view=opro','_self')" style='color:blue;'>[Goto Select Programme] </a>   <?php echo " Selected Programme - "; }else{ echo " No Programme Selected ";}  ?><strong><?php echo getprog($class_ID); ?></strong></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <!-- <p class="text-muted font-13 m-b-30"></p> --!>

             	<?php 
						$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'G_Reg' :
		            $content    = 'generate_reg.php';		
		            break;

	                case 'e_stud' :
		            $content    = 'Edit_stud.php';		
		            break;
                    
                     case 'l_s' :
		            $content    = 'searchStud.php';		
		            break;
		            
                     case 'v_s' :
		            $content    = 'searchDeptlist.php';		
		            break;
		            
		            case 's_tra' :
		            $content    = 'searchTrans.php';		
		            break;
		            
		            case 'opro' :
		            $content    = 'selectprog.php';		
		            break;
                    
                    case 'p_book' :
		            $content    = 'selectpbook.php';		
		            break;
                    
		            case 'Clearance' :
		            $content    = 'app_clearance_file.php';		
		            break;
                    
                    case 'coc' :
		            $content    = 'cocourse.php';		
		            break;
                    
                    case 'sas' :
		            $content    = 'academicstatus.php';		
		            break;
                    
	                default :
		            //$content    = 'searchStud.php';
					$content    = 'olist.php';
                            }
                     require_once $content;
					//$num=$get_RegNo;
				//if ($num!==null){
			//include('editStaff.php');
			//}else{
			
			//	include('addStaff.php'); }?>


             </div>
                </div>
              </div>
              
            
          </div>
        </div>
        <!-- /page content -->
        
        
        <?php 
if(isset($_GET['details'])){
//statusUser2();
?>

<script>
    $(document).ready(function(){
        $('#myModal5').fadeIn('fast');
    });
    
    $(document).ready(function(){
        $('#close').click(function(){
            $('#myModal5').fadeOut('fast');
            windows.location = "Student_Record.php";
        })
    })

</script>

<?php }?>
        <!-- start  Staff details Pop up -->
<?php //if(isset($_GET['choose_patient'])){ ?>
 
    <?php
//$user_query = mysqli_query($condb,"select * from student_tb left join olevel_tb ON olevel_tb.oapp_No = student_tb.appNo where stud_id='$_GET[userId]' ORDER BY Faculty ASC")or die(mysqli_error());
$user_query = mysqli_query($condb,"select * from student_tb  where stud_id='".safee($condb,$get_RegNo)."'")or die(mysqli_error());
													$row_b = mysqli_fetch_array($user_query);
												    $is_active = $row_b['verify_Data'];   $exists = imgExists("../Student/".$row_b['images']);
$sql_oresult1=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$row_b['appNo'])."' AND oNo_re = '1'");
$sql_oresult2=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$row_b['appNo'])."' AND oNo_re = '2'");
$count_olresult1 = mysqli_num_rows($sql_oresult1);
$count_olresult2 = mysqli_num_rows($sql_oresult2);
$sql_oresult10=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$row_b['appNo'])."' AND oNo_re = '1' limit 1");
$sql_oresult20=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$row_b['appNo'])."' AND oNo_re = '2' limit 1");
$countnosub = mysqli_num_rows($sql_oresult20);							
													?>	

<div id="myModal5" class="modal dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
<style>div.sticky {
  position: -webkit-sticky; /* Safari */
  position: sticky;
  top: 6px;
  background-color: white;
  border: 0px solid #4CAF50;
  opacity:0.6;
  }</style>

                      <div class="modal-content"  >
<div class="modal-header">
 <a href="javascript:void(0);" 	onclick="window.open('<?php echo $links; ?>','_self')" class="close"><span aria-hidden="true"></i>x</span> </a>
<!--<a href="Student_Record.php" class="close"><span aria-hidden="true"></i>x</span> </a>--!>
                        
                          <h4 class="modal-title" id="myModalLabel">Student Information </h4>
                        </div>
                        
    
		<div>
	 



<?php
//$find_choicead = mysqli_fetch_array(mysqli_query($condb," SELECT * FROM new_apply1 where appNo='".safee($condb,$row_b['appNo'])."'"));
//$num_fchoice =$find_choicead['course_choice'] ;
?>
<div class="col-sm-12" style="overflow:auto;height:450px;" >
<div class="left col-xs-10">
	 
	<form method="post"  action="" enctype="multipart/form-data" >
	<input type="hidden" name="insidmove" value="<?php echo $_SESSION['insidmove'];?> " />
	<input type='hidden' name='fee_str_id[]' value='$rs[id]' >
	<?php if($row_b['verify_Data']=='TRUE'){
echo "<div class='sticky'><center><font size=45 color=green >Verified</font></center></div>";}else{echo "";} ;?>

	<h4 class="brief" style="text-shadow:-1px 1px 1px #000;"> <font color='darkblue'><?php
	if($row_b['RegNo']==Null){echo "Application No : " .ucfirst($row_b['appNo']);}else{
	 echo "Registration Number : " .ucfirst($row_b['RegNo']) ;}?>  </font></h4>
<h2 style="text-shadow:-1px 1px 1px #000; color:blue;">Student Name in Full: <b><?php echo ucwords($row_b['FirstName']).'  '.ucwords($row_b['SecondName']).' '.ucwords($row_b['Othername']); ?></b> </h2>
<p><strong>Gender: </strong> <?php echo $row_b['Gender'] ;?> <strong>&nbsp;&nbsp;&nbsp;Hobbies: </strong> <?php echo $row_b['hobbies'] ;?> <strong>&nbsp;&nbsp;&nbsp;Date Of Birth: </strong> <?php echo $row_b['dob'] ;?> </p>
<p><strong>Email Address: </strong> <?php echo $row_b['e_address'] ;?><strong>&nbsp;&nbsp;&nbsp;Moble Number: </strong> <?php echo $row_b['phone'] ;?></p>

<p><strong>Contact Address: </strong> <?php echo $row_b['address'] ;?><strong>&nbsp;&nbsp;&nbsp;Postal Address: </strong> <?php echo $row_b['postal_address'] ;?></p>
<p><strong>State: </strong> <?php echo $row_b['state'] ;?><strong>&nbsp;&nbsp;&nbsp;Local Government: </strong> <?php echo $row_b['lga'] ;?><strong>&nbsp;&nbsp;&nbsp;Nationality: </strong> <?php echo $row_b['nation'] ;?></p>
<h2 style="text-shadow:-1px 1px 1px #000;">Programme Information:  </h2>
<p><strong><?php echo $SCategory; ?>: </strong> <?php echo getfacultyc($row_b['Faculty']) ;?><strong>&nbsp;&nbsp;&nbsp;<?php echo $SGdept1; ?>: </strong> <?php echo getdeptc($row_b['Department']) ;?><strong>&nbsp;&nbsp;&nbsp;Programme Type: </strong> <?php echo getprog($row_b['app_type']) ;?></p>
<p><strong>Mode of Entry: </strong> <?php echo getamoe($row_b['Moe']) ;?><strong>&nbsp;&nbsp;&nbsp;Year of Entry: </strong> <?php echo $row_b['yoe'] ;?><strong>&nbsp;&nbsp;&nbsp;Year of Graduation: </strong> <?php echo $row_b['yog'] ;?><strong>&nbsp;&nbsp;&nbsp;Programme Duration: </strong> <?php echo $row_b['prog_dura'] ;?></p>
<h2 style="text-shadow:-1px 1px 1px #000;">Post Primary School Qualification ('O' Level Record) </h2>
<?php  $orow_01 = mysqli_fetch_array($sql_oresult10); $orow_1 = mysqli_fetch_array($sql_oresult20); if($countnosub > 0){$subcont = $orow_1['oNo_re'];}else{ $subcont = $orow_01['oNo_re']; } if($count_olresult1 > 0 ){ ?>
<p><strong>Number of Certificates used : </strong> <?php echo $subcont ;?><strong>&nbsp;&nbsp;&nbsp;Exam Type: </strong> <?php echo getexamtype($orow_01['oExam_t1']);?><strong>&nbsp;&nbsp;&nbsp;First Exam No/Year: </strong> <?php echo $orow_01['oExam_no1']." - "  ;?><?php echo ($orow_01['oExam_y1']); ?></p>
<p><strong>Subject / Grade: </strong> <?php $sn1=1; while($orow1 = mysqli_fetch_array($sql_oresult1)){ echo "<i class='fa fa-file'></i> ". getf_sub($orow1['oSub1']);?> -&nbsp;<?php echo getfgrade($orow1['oGrade_1']) ." ,&nbsp;"; }?></p>
<p><strong>Second Exam Type: </strong><?php echo getexamtype($orow_1['oExam_t1']);?>&nbsp;&nbsp;&nbsp;<strong>Second Exam No/Year: </strong> <?php echo $orow_1['oExam_no1']."  - " ;?><?php echo ($orow_1['oExam_y1']); ?></p><?php $sn2=1; if($count_olresult2 > 0){ ?>
<p><strong>Subject / Grade: </strong> <?php while($orow12 = mysqli_fetch_array($sql_oresult2)){ echo "<i class='fa fa-file'></i> ". getf_sub($orow12['oSub1']);?> -&nbsp;<?php echo getfgrade($orow12['oGrade_1']) ." ,&nbsp;"; }?></p><?php } ?>

<?php }else{  echo "No Certificate information Added Yet For This Student."; } ?>

<h2 style="text-shadow:-1px 1px 1px #000;">Other Remarks:  </h2>

<p> <strong>Registration Remark: </strong> <?php if($row_b['verify_Data']=='TRUE'){
echo "Verified";}else{echo "Not Verified";} ;?> <strong>&nbsp;&nbsp;&nbsp;Date of Registration: </strong> <?php echo $row_b['dateofreg'];?></p>

</div>
<div class="right col-xs-2 text-center" >
<img src="<?php  if ($exists > 0 ){
	echo "../Student/".$row_b['images'];
	}else{ print "./uploads/NO-IMAGE-AVAILABLE.jpg";}

				 
?>" alt="" class="img-circle img-responsive" height="190" width="190" >
</div>
</div>
	<div class="modal-footer">
				<!--	<a href="Student_Record.php" class="btn btn-info" ><i class="fa fa-remove"></i>&nbsp;Close</a>--!>
                    <a href="javascript:void(0);" 	onclick="window.open('<?php echo $links; ?>','_self')" class="btn btn-info" ><i class="fa fa-remove"></i>&nbsp;Close</a>
					<a href="javascript:changeUserStatus2(<?php echo $get_RegNo; ?>, '<?php echo $is_active; ?>');" class="btn btn-info" ><i class=" <?php echo $is_active == 'FALSE'? 'fa fa-check' : 'fa fa-remove'; ?>"></i>&nbsp;<?php echo $is_active == 'FALSE'? 'Verify' : 'Cancel Verification'; ?></a>
<script type="text/javascript">
		              $(document).ready(function(){
		              $('#com').tooltip('show');
		              $('#com').tooltip('hide');
		              });
		             </script>
					</div>
					
					</form>
				
					
		</div>
					 </div>
                 
				    </div>
</div><?php //} ?>
<!-- end  Modal -->


   <?php 



        ?>
      
         <?php include('footer.php'); ?>