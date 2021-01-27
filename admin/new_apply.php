<?php  include('header.php'); ?>
<?php include('session.php');
//if(($admin_accesscheck == "1") or ($admin_accesscheck == "2")) {
	//}else{echo "<script>alert('Access Not Granted To This User Please Contact System Administrator!');</script>";
		//redirect("index.php");}
		$status = FALSE;
if ( authorize($_SESSION["access3"]["adm"]["nsp"]["create"]) || 
authorize($_SESSION["access3"]["adm"]["nsp"]["edit"]) || 
authorize($_SESSION["access3"]["adm"]["nsp"]["view"]) || 
authorize($_SESSION["access3"]["adm"]["nsp"]["delete"]) ) {
 $status = TRUE;
}
$facn1 = isset($_GET['fac1']) ? $_GET['fac1'] : '';
$dep1 = isset($_GET['dept1_find']) ? $_GET['dept1_find'] : '';
$sec1 = isset($_GET['session2']) ? $_GET['session2'] : '';
$los =  isset($_GET['c_choice']) ? $_GET['c_choice'] : '';
 //$dep1 = $_GET['dept1_find']; $sec1 = $_GET['session2']; $los 	= $_GET['c_choice'];
 if(empty($dep1)){ $links = "new_apply.php"; $np = $default_secadmin;}else{ $links = "new_apply.php?dept1_find=".$dep1."&session2=".$sec1."&c_choice=".$los; $np = $sec1;}
 ?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');
$queryapp = "SELECT * FROM new_apply1 WHERE adminstatus = '1' AND application_r = '0' AND Asession = '".safee($condb,$np)."' AND app_type = '".safee($condb,$class_ID)."' AND verify_apply = 'TRUE'";
if($Rorder > 2){ $queryapp .= " AND Department = '$userdept'";}
 $queryapp .= "order by stud_id DESC "; $qeryno = mysqli_query($condb,$queryapp)or die(mysqli_error($condb));
    $clearno = mysqli_num_rows($qeryno);
     $querydirect = "SELECT * FROM new_apply1 WHERE adminstatus = '0' AND application_r = '0' AND Asession = '".safee($condb,$np)."' AND app_type = '".safee($condb,$class_ID)."' AND verify_apply = 'TRUE'";
if($Rorder > 2){ $querydirect .= " AND Department = '$userdept'";}
 $querydirect .= "order by stud_id DESC "; $qerydirect = mysqli_query($condb,$querydirect)or die(mysqli_error($condb));
 $directno = mysqli_num_rows($qerydirect);
 $queryNO = "SELECT * FROM new_apply1 WHERE reg_status = '1' AND application_r = '0' AND Asession = '".safee($condb,$np)."' AND app_type = '".safee($condb,$class_ID)."' AND verify_apply = 'FALSE'";
if($Rorder > 2){ $queryNO .= " AND Department = '$userdept'";}
 $queryNO .= "order by stud_id DESC "; $queryNO1 = mysqli_query($condb,$queryNO)or die(mysqli_error($condb));
 $countappno = mysqli_num_rows($queryNO1);
 
 $qedate = "SELECT * FROM utmedate WHERE prog = '".safee($condb,$class_ID)."'";
if($dep1 > 0){ $qedate .= " AND dept = '$dep1'";}
if($facn1 > 0){ $qedate .= " AND fac = '$facn1'";}
$qerydate = mysqli_query($condb,$qedate)or die(mysqli_error($condb));
$countd = mysqli_num_rows($qerydate);

	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} ?>
  <?php $get_RegNo = isset($_GET['userId']) ? $_GET['userId'] : '';  ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title" style="max-width:1400px;">
<div class="title_left">
<h3> <?php if($class_ID > 0){ echo " Admission Management [".getprog($class_ID)."]"; }else{ echo " New Student Management";} 
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
<?php 
//batch student comfirmation 

		if (isset($_POST['bComfirm_record'])){
	 
	if(empty($class_ID)){
				message("No Programme Record Selected Yet,please select to continue", "error");
				redirect($links);
			}elseif(empty($_POST['selector'])){
				message("Select at least one applicant to proceed !", "error");
		        redirect($links);
				}else{
				
					$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{ $sqlstud1=mysqli_query($condb,"select * from new_apply1 where stud_id ='".safee($condb,$id[$i])."' and app_type = '".safee($condb,$class_ID)."' and Asession = '".safee($condb,$default_secadmin)."' and adminstatus = '1' and reg_status = '1' and application_r = '0' ")or die(mysqli_error($condb));
$row_b = mysqli_fetch_array($sqlstud1);  extract($row_b);
$num_fchoice2 =$row_b['course_choice'] ; $entryyear   =	substr($default_secadmin,0,4);   $yog_t =  $entryyear + $p_duration; $modeentry = $row_b['moe']; $entrylev = getelevel($modeentry); $noapp = $row_b['appNo'];
if($num_fchoice2 == '1'){ $facnew =  $row_b['fact_1']; $depnew =  $row_b['first_Choice']; }else{  $facnew =  $row_b['fact_2']; $depnew =  $row_b['Second_Choice'];}
	$sql_cstudent=mysqli_query($condb,"SELECT * FROM student_tb WHERE stud_id = '".safee($condb,$id[$i])."'");
				if(mysqli_num_rows($sql_cstudent)>0) 
				{ 
				$sql_ME=mysqli_query($condb,"UPDATE student_tb SET FirstName='".safee($condb,$row_b['FirstName'])."',SecondName='".safee($condb,$row_b['SecondName'])."',Othername='".safee($condb,$row_b['Othername'])."',Gender='".safee($condb,$row_b['Gender'])."',dob='".safee($condb,$row_b['dob'])."',hobbies='".safee($condb,$row_b['hobbies'])."',state='".safee($condb,$row_b['state'])."',lga='".safee($condb,$row_b['lga'])."',nation='".safee($condb,$row_b['nation'])."',religion='".safee($condb,$row_b['religion'])."',address='".safee($condb,$row_b['address'])."',e_address='".safee($condb,$row_b['e_address'])."',phone='".safee($condb,$row_b['phone'])."',postal_address='".safee($condb,$row_b['postal_address'])."',any_fchalenge='".safee($condb,$row_b['any_fchalenge'])."',State_chalenge='".safee($condb,$row_b['State_chalenge'])."',Faculty='".safee($condb,$facnew)."',Department='".safee($condb,$depnew)."',Age='".safee($condb,$row_b['Age'])."',bloodgroup='".safee($condb,$row_b['bloodgroup'])."',gtype='".safee($condb,$row_b['gtype'])."',RegNo='',app_type='".safee($condb,$row_b['app_type'])."',Asession='".safee($condb,$row_b['Asession'])."',Moe='".safee($condb,$modeentry)."',yoe='".safee($condb,$entryyear)."',yog='".safee($condb,$yog_t)."',prog_dura='".safee($condb,$p_duration)."',p_level='".safee($condb,$entrylev)."',images = '".safee($condb,$row_b['images'])."',appNo = '".safee($condb,$noapp)."',dateofreg=Now(),reg_status='1',verify_Data='FALSE',Cert_inview = '".safee($condb,$row_b['app_type'])."' WHERE stud_id = '".safee($condb,$id[$i])."'");
				//	if($course_choice == '1'){
	//mysqli_query($condb,"update student_tb set Department='".safee($condb,$row_b['first_Choice'])."',Faculty='".safee($condb,$row_b['fact_1'])."' where stud_id = '".safee($condb,$id[$i])."'");
	//}elseif($course_choice == '2'){
//mysqli_query($condb,"update student_tb set Department='".safee($condb,$row_b['Second_Choice'])."',Faculty='".safee($condb,$row_b['fact_2'])."' where stud_id = '".safee($condb,$id[$i])."'");
//}
$comfirmadd2 =mysqli_query($condb,"UPDATE new_apply1 SET application_r = '1' WHERE stud_id ='".safee($condb,$id[$i])."' ");
			message("The Admitted Applicant(s) was Successfully Transfered To Students Register .", "success");
		       redirect($links);
		        exit(); 
			}else{
			$sql=mysqli_query($condb,"INSERT INTO student_tb (appNo,FirstName,SecondName,Othername,Gender,dob,hobbies,state,lga,nation,religion,address,e_address,phone,postal_address,any_fchalenge,State_chalenge,Faculty,Department,Age,bloodgroup,gtype,RegNo,app_type,Asession,Moe,yoe,yog,prog_dura,p_level,images,dateofreg,reg_status,verify_Data,Cert_inview)VALUES('".safee($condb,$noapp)."','".safee($condb,$row_b['FirstName'])."','".safee($condb,$row_b['SecondName'])."','".safee($condb,$row_b['Othername'])."','".safee($condb,$row_b['Gender'])."','".safee($condb,$row_b['dob'])."','".safee($condb,$row_b['hobbies'])."','".safee($condb,$row_b['state'])."','".safee($condb,$row_b['lga'])."','".safee($condb,$row_b['nation'])."','".safee($condb,$row_b['religion'])."','".safee($condb,$row_b['address'])."','".safee($condb,$row_b['e_address'])."','".safee($condb,$row_b['phone'])."','".safee($condb,$row_b['postal_address'])."','".safee($condb,$row_b['any_fchalenge'])."','".safee($condb,$row_b['State_chalenge'])."','".safee($condb,$facnew)."','".safee($condb,$depnew)."','".safee($condb,$row_b['Age'])."','".safee($condb,$row_b['bloodgroup'])."','".safee($condb,$row_b['gtype'])."','','".safee($condb,$row_b['app_type'])."','".safee($condb,$row_b['Asession'])."','".safee($condb,$modeentry)."','".safee($condb,$entryyear)."','".safee($condb,$yog_t)."','".safee($condb,$p_duration)."','".safee($condb,$entrylev)."','".safee($condb,$row_b['images'])."',Now(),'1','FALSE','".safee($condb,$row_b['app_type'])."')");
				//if($course_choice == '1'){
	//mysqli_query($condb,"update student_tb set Department='".safee($condb,$row_b['first_Choice'])."',Faculty='".safee($condb,$row_b['fact_1'])."' where stud_id = '".safee($condb,$id[$i])."'");
//	}elseif($course_choice == '2'){
//mysqli_query($condb,"update student_tb set Department='".safee($condb,$row_b['Second_Choice'])."',Faculty='".safee($condb,$row_b['fact_2'])."' where stud_id = '".safee($condb,$id[$i])."'");
//}
$comfirmadd2 =mysqli_query($condb,"UPDATE new_apply1 SET application_r = '1' WHERE stud_id ='".safee($condb,$id[$i])."' ");
	message("The Admitted Applicant(s) was Successfully Transfered To Students Register .", "success");
	//unset($_SESSION['cr_session']);
		        redirect($links);}
		}
}}

	if (isset($_POST['delete_newapp'])){
	 if(empty($class_ID)){
				message("No Programme Record Selected Yet,please select to continue", "error");
				redirect($links);
			}elseif(empty($_POST['selector'])){
				message("Select at least one applicant to proceed !", "error");
		       redirect($links);
				}else{ $id=$_POST['selector'];  $N = count($id);
for($i=0; $i < $N; $i++){$row = mysqli_query($condb,"select * from new_apply1 where stud_id ='".safee($condb,$id[$i])."' AND application_r ='1' AND dateofreg  <  DATE_SUB(CURDATE(), INTERVAL 5 YEAR)");
		$checkdelete = "Unable to Delete Applicant(s) Record because already Admitted and not upto Five years of Admission."; $dcolor = "error";
    $count=mysqli_num_rows($row);$rown=mysqli_fetch_array($row);
    if($count > 0){ extract($rown); $checkdelete = "Applicant(s) information was Successfully Deleted ";$dcolor = "success";
     	mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'".safee($condb,$admin_username)."','
	Application Records of ".getname($appNo)." with Application No ".$appNo." admitted into ".$SGdept1." of ".getdeptc($adept)." (".getprog($app_type).") was Deleted by ". $admin_username.". ')")or die(mysqli_error($condb));
	$resultd = mysqli_query($condb,"DELETE FROM new_apply1 where stud_id='$id[$i]'");}
    message("".$checkdelete." .", $dcolor);
	redirect($links); }}}
  
	if (isset($_POST['approveapp'])){
	 if(empty($class_ID)){
				message("No Programme Record Selected Yet,please select to continue", "error");
				redirect('new_apply.php');
			}elseif(empty($_POST['selector'])){
				message("Select at least one applicant to proceed !", "error");
		        redirect($links);
				}else{ $id=$_POST['selector'];  $N = count($id);
for($i=0; $i < $N; $i++){
$sql2="select * from new_apply1 where stud_id ='".$id[$i]."'";
				$result2=mysqli_query($condb,$sql2) or die(mysqli_error($condb));
				$row=mysqli_fetch_array($result2); extract($row); $urllogin = host();
$msg = nl2br("Dear $FirstName $SecondName $Othername,.\n
	
	Following your Application to pursue ".getprog($app_type)." Program in ".$schoolNe.",\n
	you are hereby invited for a Screening Examination into The Institution \n
	Application Number :".$appNo.   "\n
	Kindly Login to: ".$urllogin."apply_b.php?view=Return"." with you Application Number and password to Reprint your Application Slip \n
	..................................................................\n
    Please Come with A Copy of your Application Slip!\n
    
    This Message was Sent From " .$schoolNe ." @ ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
    For inquiry and complaint please email inquiry@deltasmartcity.ng \n
	
	Thank You Admin!\n\n");

$subject= getprog($app_type)." Entrance Exam Invitation"; 
//define the body of the message.
ob_start(); //Turn on output buffering
$mail_data = array('to' => $e_address, 'sub' => $subject, 'msg' => 'Notify','body' => $msg, 'srname' => $comn);
if($countd > 0 ){	send_email($mail_data);  $mesg = " Applicant(s) information  Successfully Verified and Screening invite mailed.";}
$mesg = " Applicant(s) information  Successfully Verified. ";
$resultapp = mysqli_query($condb,"UPDATE new_apply1 SET verify_apply ='TRUE' where stud_id = '$id[$i]'");}
	message(" ".$mesg." ", "success");
	redirect($links); }}
    
    //Direct Admission processing
    if (isset($_POST['Directadd'])){
	 if(empty($class_ID)){
				message("No Programme Record Selected Yet,please select to continue", "error");
				redirect('new_apply.php');
			}elseif(empty($_POST['selector'])){
				message("Select at least one applicant to proceed !", "error");
		        redirect($links);
				}else{ $id=$_POST['selector'];  $N = count($id);
for($i=0; $i < $N; $i++){
$sql2="select * from new_apply1 where stud_id ='".$id[$i]."' AND verify_apply ='TRUE' ";
				$result2=mysqli_query($condb,$sql2) or die(mysqli_error($condb));
                $account = mysqli_num_rows($result2);
				$row=mysqli_fetch_array($result2); extract($row); $urllogin = host(); $los = 1;
                $e_address = $e_address; $app_type = $app_type; $adminstatus = $adminstatus;
$subject= getprog($app_type)." Admission Notification"; $fulname = $FirstName." ". $SecondName." ".$Othername;
if($los == "1"){ $adfac = $fact_1; $addept = $first_Choice; $cho = 1; }else{ $adfac = $fact_2; $addept = $Second_Choice; $cho = 2; } 
$import = "UPDATE new_apply1 set post_uscore ='0',average_score='0',adminstatus = '1',course_choice = '".$cho."',afac = '".safee($condb,$adfac)."' ,adept='".safee($condb,$addept)."' where stud_id ='".$id[$i]."' ";
				mysqli_query($condb,$import) or die (mysqli_error($condb));
$msg = nl2br("Congratulations! ".$fulname.",.\n
	
	This is To Inform you that you have been giving Admission into ".getdeptc($addept)." in ".$schoolNe.",\n
	Kindly Login to: ".$urllogin."apply_b.php?view=C_R"." with you Application Number and password to Comfirm \n
    To Comfirm your Admission your required to Pay Acceptance Fee @: ".$urllogin."apply_b.php?view=M_P"." with you Application Number \n
	.............................................................................................................................\n
    Note That This Admission will be withdrawn if you Violate The Terms and Condition of your Admission!\n
    
    This Message was Sent From " .$schoolNe ." @ ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
    For inquiry and complaint please email inquiry@deltasmartcity.ng \n
	
	Thank You Admin!\n\n");
 
//define the body of the message.
ob_start(); //Turn on output buffering
$mail_data = array('to' => $e_address, 'sub' => $subject, 'msg' => 'Notify','body' => $msg, 'srname' => $comn);
	send_email($mail_data);
    }
	message($account." Applicant(s) was Successfully Admitted .", "success");
	redirect($links); }}
?>
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2><?php if($class_ID > 0){ ?> <a href='javascript:void(0);' onclick="window.open('new_apply.php?view=spro','_self')" style='color:blue;'>[Goto Select Programme] </a>   <?php echo " Selected Programme - "; }else{ echo " No Programme Selected ";}  ?><strong><?php echo getprog($class_ID); ?></strong></h2>
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
<?php $view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'P_admin' :
		            $content    = 'Pro_admission.php';		
		            break;
		            
		            case 'lapp' :
		            $content    = 'loadapp.php';		
		            break;

	                case 'spro' :
		            $content    = 'selectprog.php';		
		            break;
		            
		            case 'nlist' :
		            $content    = 'nlist.php';
					$pageTitle = 'List of New Application';
     //if($countd < 1 && $countappno > 0 ){message("Please Note that You Have not Schedule Entance/PUTME Date and invite would not be mailed to applicant (s) once verification Button is clicked!", "error");} 		
		            break;
                    
                     case 'imp_a' :
		            $content    = 'utmeResult.php';		
		            break;
		            
		            case 'v_r' :
		            $content    = 'viewaResult.php';	
		            break;
		            
		            case 'sech_r' :
		            $content    = 'searchnewstudent.php';
					//$pageTitle = 'List of New Application';		
		            break;
		            
		            case 'export_s' :
		            $content    = 'loadapp.php';		
		            break;
		            
		            case 'v_s' :
		            $content    = 'MessageAlert.php';		
		            break;
		            
	                default :
		            //$content    = 'selectprog.php';
				$content    = 'nlist.php';
				//$pageTitle = 'List of New Application';
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
 
 
?>

<script>
    $(document).ready(function(){
        $('#myModal5').fadeIn('fast');
    });
    
    $(document).ready(function(){
        $('#close').click(function(){
            $('#myModal5').fadeOut('fast');
            windows.location = "new_apply.php";
        })
    })

</script>

<?php }?>
        <!-- start  Staff details Pop up -->
<?php //if(isset($_GET['choose_patient'])){ ?>
 
    <?php  //and verify_apply='$_GET[nst]'
//$user_query = mysqli_query($condb,"select * from new_apply1 left join olevel_tb ON olevel_tb.oapp_No = new_apply1.appno where stud_id='$_GET[userId]' ORDER BY stud_id ASC")or die(mysql_error());
$user_query = mysqli_query($condb,"select * from new_apply1  where stud_id='$get_RegNo' ORDER BY stud_id ASC")or die(mysqli_error($condb));
													$row_b = mysqli_fetch_array($user_query);
												    $is_active2 = $row_b['verify_apply'];
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
                      <div class="modal-content">

 <div class="modal-header">
                          
        <a href="javascript:void(0);" 	onclick="window.open('<?php echo $links; ?>','_self')" class="close"><span aria-hidden="true"></i>x</span> </a>
                        
                          <h4 class="modal-title" id="myModalLabel">Student Application Information </h4>
                        </div>
                        
    
		<div>
		   
	


<?php
//$modeentry2 = "";
$find_choicead = mysqli_fetch_array(mysqli_query($condb," SELECT * FROM new_apply1 where appNo='".safee($condb,$row_b['appNo'])."'"));
$num_fchoice =$find_choicead['course_choice'] ;$verif  =$find_choicead['verify_apply']; $modeentry2 = $find_choicead['moe']; $entrylev2 = getelevel($modeentry2);
//if($_SESSION['insidmove']==$_POST['insidmove'])
//{
if(isset($_POST['Comfirm_record'])){
 $regnumber = $_POST["regnumber"];

	$sql_pin="SELECT * FROM student_tb WHERE appNo='".safee($condb,$row_b['appNo'])."'";
$result_pin = mysqli_query($condb,$sql_pin);
$num_pin = mysqli_num_rows($result_pin); $entryyear   =	substr($default_secadmin,0,4);   $yog_t =  $entryyear + $p_duration;

				if($num_pin > 0){
				$sql_ME="UPDATE student_tb SET FirstName='".safee($condb,$row_b['FirstName'])."',SecondName='".safee($condb,$row_b['SecondName'])."',Othername='".safee($condb,$row_b['Othername'])."',Gender='".safee($condb,$row_b['Gender'])."',dob='".safee($condb,$row_b['dob'])."',hobbies='".safee($condb,$row_b['hobbies'])."',state='".safee($condb,$row_b['state'])."',lga='".safee($condb,$row_b['lga'])."',nation='".safee($condb,$row_b['nation'])."',religion='".safee($condb,$row_b['religion'])."',address='".safee($condb,$row_b['address'])."',e_address='".safee($condb,$row_b['e_address'])."',phone='".safee($condb,$row_b['phone'])."',postal_address='".safee($condb,$row_b['postal_address'])."',any_fchalenge='".safee($condb,$row_b['any_fchalenge'])."',State_chalenge='".safee($condb,$row_b['State_chalenge'])."',Faculty='".safee($condb,$row_b['Faculty'])."',Age='".safee($condb,$row_b['Age'])."',bloodgroup='".safee($condb,$row_b['bloodgroup'])."',gtype='".safee($condb,$row_b['gtype'])."',RegNo='',app_type='".safee($condb,$row_b['app_type'])."',Asession='".safee($condb,$row_b['Asession'])."',Moe='".safee($condb,$modeentry2)."',yoe='".safee($condb,$entryyear)."',yog='".safee($condb,$yog_t)."',prog_dura='".safee($condb,$p_duration)."',p_level='".safee($condb,$entrylev2)."',images = '".safee($condb,$row_b['images'])."',dateofreg=Now(),reg_status='1',verify_Data='FALSE',Cert_inview = '".safee($condb,$row_b['app_type'])."' WHERE  appNo= '".safee($condb,$row_b['appNo'])."'";
					$result_qsql2 = mysqli_query($condb,$sql_ME);
					$comfirmadd =mysqli_query($condb,"UPDATE new_apply1 SET application_r = '1' WHERE appNo='".safee($condb,$row_b['appNo'])."' ");
if($num_fchoice == '1'){
	mysqli_query($condb,"update student_tb set Department='$find_choicead[first_Choice]',Faculty='$find_choicead[fact_1]' where appNo= '".safee($condb,$row_b['appNo'])."'");
	}elseif($num_fchoice == '2'){
mysqli_query($condb,"update student_tb set Department='$find_choicead[Second_Choice]',Faculty='$find_choicead[fact_2]' where appNo= '".safee($condb,$row_b['appNo'])."'");
}
//$res="<font color='green'><strong>Student Record Successfully Comfirmed and Updated on the student Register</strong></font><br>";
				//$resi=1;
                  message("Student Record Successfully Comfirmed and Updated on the student Register.", "error");
	redirect($links);
				}else{
$sql="INSERT INTO student_tb (appNo,FirstName,SecondName,Othername,Gender,dob,hobbies,state,lga,nation,religion,address,e_address,phone,postal_address,any_fchalenge,State_chalenge,Faculty,Age,bloodgroup,gtype,RegNo,app_type,Asession,Moe,yoe,yog,prog_dura,p_level,images,dateofreg,reg_status,verify_Data,Cert_inview )VALUES('".safee($condb,$row_b['appNo'])."','".safee($condb,$row_b['FirstName'])."','".safee($condb,$row_b['SecondName'])."','".safee($condb,$row_b['Othername'])."','".safee($condb,$row_b['Gender'])."','".safee($condb,$row_b['dob'])."','".safee($condb,$row_b['hobbies'])."','".safee($condb,$row_b['state'])."','".safee($condb,$row_b['lga'])."','".safee($condb,$row_b['nation'])."','".safee($condb,$row_b['religion'])."','".safee($condb,$row_b['address'])."','".safee($condb,$row_b['e_address'])."','".safee($condb,$row_b['phone'])."','".safee($condb,$row_b['postal_address'])."','".safee($condb,$row_b['any_fchalenge'])."','".safee($condb,$row_b['State_chalenge'])."','".safee($condb,$row_b['Faculty'])."','".safee($condb,$row_b['Age'])."','".safee($condb,$row_b['bloodgroup'])."','".safee($condb,$row_b['gtype'])."','','".safee($condb,$row_b['app_type'])."','".safee($condb,$row_b['Asession'])."','".safee($condb,$modeentry2)."','".safee($condb,$entryyear)."','".safee($condb,$yog_t)."','".safee($condb,$p_duration)."','".safee($condb,$entrylev2)."','".safee($condb,$row_b['images'])."',Now(),'1','FALSE','".safee($condb,$row_b['app_type'])."')";
	if(!$qsql= mysqli_query($condb,$sql))

	{
		echo mysqli_error($condb);
		//echo "<script>alert('Unable to Complete Student Registration Please Try Again..');</script>";
		//	echo "<script>window.location.assign('studentReg.php');</script>";
			//$res="<font color='Red'><strong>Unable to Comfirm Student Registration Please Try Again...</strong></font><br>";
				//$resi=1;
			//exit();
             message("Unable to Comfirm Student Registration Please Try Again.", "error");
	redirect($links);
	 }
	$comfirmadd2 =mysqli_query($condb,"UPDATE new_apply1 SET application_r = '1' WHERE appNo='".safee($condb,$row_b['appNo'])."' ");
	if($num_fchoice == '1'){
	mysqli_query($condb,"update student_tb set Department='$find_choicead[first_Choice]',Faculty='$find_choicead[fact_1]' where appNo= '".safee($condb,$row_b['appNo'])."'");
	}elseif($num_fchoice == '2'){
mysqli_query($condb,"update student_tb set Department='$find_choicead[Second_Choice]',Faculty='$find_choicead[fact_2]' where appNo= '".safee($condb,$row_b['appNo'])."'");
}
	//$res="<font color='green'><strong>Student Record Successfully Comfirmed and Updated on the student Register</strong></font><br>";
				//$resi=1;
                message("Student Record Successfully Comfirmed and Updated on the student Register", "success");
	redirect($links);
	
}

	}

//}$_SESSION['insidmove'] = rand();


?>
<div class="col-sm-12"   style="overflow:auto;height:450px;"  >
<div class="left col-xs-10">
	<form method="post"  action="" enctype="multipart/form-data" >
	<input type="hidden" name="insidmove" value="<?php echo $_SESSION['insidmove'];?> " />
	<input type='hidden' name='fee_str_id[]' value='$rs[id]' >
	<center><?php
//if($resi == 1){echo "<label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res</font></label>";}
					//echo " $res";
?>

</center>
	<h4 class="brief" style="text-shadow:-1px 1px 1px #000;"> <font color='darkblue'>Application No : <?php echo ucfirst($row_b['appNo']) ;?>  </font></h4>
<h2 style="text-shadow:-1px 1px 1px #000; color:blue;">Full Name: <b><?php echo ucwords($row_b['FirstName']).'  '.ucwords($row_b['SecondName']).' '.ucwords($row_b['Othername']); ?></b> </h2>
<p><strong>Gender: </strong> <?php echo $row_b['Gender'] ;?> <strong>&nbsp;&nbsp;&nbsp;Hobbies: </strong> <?php echo $row_b['hobbies'] ;?> <strong>&nbsp;&nbsp;&nbsp;Date Of Birth: </strong> <?php echo $row_b['dob'] ;?> </p>
<p><strong>Email Address: </strong> <?php echo $row_b['e_address'] ;?><strong>&nbsp;&nbsp;&nbsp;Moble Number: </strong> <?php echo $row_b['phone'] ;?></p>

<p><strong>Contact Address: </strong> <?php echo $row_b['address'] ;?><strong>&nbsp;&nbsp;&nbsp;Postal Address: </strong> <?php echo $row_b['postal_address'] ;?></p>
<p><strong>State: </strong> <?php echo $row_b['state'] ;?><strong>&nbsp;&nbsp;&nbsp;Local Government: </strong> <?php echo $row_b['lga'] ;?><strong>&nbsp;&nbsp;&nbsp;Nationality: </strong> <?php echo $row_b['nation'] ;?></p>
<h2 style="text-shadow:-1px 1px 1px #000;">Choice of Course/Programm:  </h2>
<p><strong>First Choice: </strong> <?php echo getdeptc($row_b['first_Choice']) ;?><strong>&nbsp;&nbsp;&nbsp;Second Choice: </strong> <?php echo getdeptc($row_b['Second_Choice']) ;?></p>
<h2 style="text-shadow:-1px 1px 1px #000;">Post Primary School Qualification ('O' Level Record) </h2>
<?php  $orow_01 = mysqli_fetch_array($sql_oresult10); $orow_1 = mysqli_fetch_array($sql_oresult20); if($countnosub > 0){$subcont = $orow_1['oNo_re'];}else{ $subcont = $orow_01['oNo_re']; } if($count_olresult1 > 0 ){ ?>
<p><strong>Number of Certificates used : </strong> <?php echo $subcont ;?><strong>&nbsp;&nbsp;&nbsp;Exam Type: </strong> <?php echo getexamtype($orow_01['oExam_t1']);?><strong>&nbsp;&nbsp;&nbsp;First Exam No/Year: </strong> <?php echo $orow_01['oExam_no1']." - "  ;?><?php echo ($orow_01['oExam_y1']); ?></p>
<p><strong>Subject / Grade: </strong> <?php $sn1=1; while($orow1 = mysqli_fetch_array($sql_oresult1)){ echo "<i class='fa fa-file'></i> ". getf_sub($orow1['oSub1']);?> -&nbsp;<?php echo getfgrade($orow1['oGrade_1']) ." ,&nbsp;"; }?></p>
<p><strong>Second Exam Type: </strong><?php echo getexamtype($orow_1['oExam_t1']);?>&nbsp;&nbsp;&nbsp;<strong>Second Exam No/Year: </strong> <?php echo $orow_1['oExam_no1']."  - " ;?><?php echo ($orow_1['oExam_y1']); ?></p><?php $sn2=1; if($count_olresult2 > 0){ ?>
<p><strong>Subject / Grade: </strong> <?php while($orow12 = mysqli_fetch_array($sql_oresult2)){ echo "<i class='fa fa-file'></i> ". getf_sub($orow12['oSub1']);?> -&nbsp;<?php echo getfgrade($orow12['oGrade_1']) ." ,&nbsp;"; }?></p><?php } ?>

<?php }else{  echo "No Certificate information Added Yet For This Student."; } ?>

<h2 style="text-shadow:-1px 1px 1px #000;">POST UTME EXAM RESULT:  </h2>
<p><strong>Jamb Reg No: </strong> <?php echo $row_b['JambNo'] ;?><strong>&nbsp;&nbsp;&nbsp;Jamb Score: </strong> <?php echo $row_b['J_score'] ;?><strong>&nbsp;&nbsp;&nbsp;Post UME Score: </strong> <?php echo $row_b['post_uscore'] ;?></p>
<p> <strong>Application Remark: </strong> <?php if($row_b['verify_apply']=='TRUE'){
echo "Verified";}else{echo "Not Verified";} ;?> <strong>&nbsp;&nbsp;&nbsp;Admission Status: </strong> <?php echo getappstatus($row_b['adminstatus']);
   $exists30 = imgExists("../Student/".$row_b['images']);
?></p>
</div>
<div class="right col-xs-2 text-center" >
<img src="<?php  
				  //if($row_b['images']==NULL){
	//print "NO-IMAGE-AVAILABLE.jpg";
	//}else{
//	print $row_b['images']; }
	if ($exists30 > 0 ){ print "../Student/".$row_b['images'];
	}else{ print "../Student/uploads/NO-IMAGE-AVAILABLE.jpg";}
?>" alt="" style="float: right;" class="img-squre img-responsive" height="190" width="190" >
</div>
</div>
	<div class="modal-footer">
					<a href="javascript:void(0);" 	onclick="window.open('<?php echo $links; ?>','_self')" class="btn btn-info" ><i class="fa fa-remove"></i>&nbsp;Close</a>
					<?php   if (authorize($_SESSION["access3"]["adm"]["nsp"]["create"])){ ?>
					<a href="javascript:changeUserStatus(<?php echo $get_RegNo; ?>, '<?php echo $verif; ?>');" class="btn btn-info" ><i class="fa fa-check"></i>&nbsp;<?php echo $verif == 'FALSE'? 'Approve' : 'Cancel Approval'; //$is_active == 'FALSE'? 'Cancel Verification' : 'Verified'; ?></a>
						<?php //if($row_b['adminstatus']=='1'){?>
				 	<!--	<button class="btn btn-info" name="Comfirm_record" title="Click to move record to Student Register" id="com"><i class="icon-save icon-large"></i> Comfirm </button>--!>
						 <?php }//} ?>
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


function updatestatus($statnum2)
{
  if ($statnum2 >= 250 AND $statnum2 <=401)
  {
     return "1";
  }
  else if($statnum2 >= 200 AND $statnum2 <=249)
  {
     return "2";
  }
  else if($statnum2 == 0 )
  {
    return "0";
  }
  
}


        ?>
        <script>  </script>
         <?php include('footer.php'); ?>