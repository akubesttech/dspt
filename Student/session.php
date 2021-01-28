<?php
//Start session
session_start();

//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['student_id']) ||(trim ($_SESSION['student_id']) == '')) {
	//header("location:".host()."Userlogin.php");
	redirect(host()."Userlogin.php");
    exit();
}
/*$sessionlock = $_SESSION['loggedAt2'];
if(isset($_SESSION['loggedAt2']) && (time() - $sessionlock > 1800)) {
   //if(time() - $_SESSION['loggedAt'] > 60) { 
    ?>
    <script>
	alert('Your are Logged out,Because Of Long Time of No Activity!'); </script> 
     <?php
    unset($_SESSION['student_id'], $sessionlock);
     redirect(host()."Userlogin.php");
    //header("location:".host()."Userlogin.php");
    exit;
}else{
$_SESSION['loggedAt2'] = time();
}
*/
$session_id=$_SESSION['student_id'];

$user_query = mysqli_query($condb,"select * from student_tb where stud_id = '".safee($condb,$session_id)."'")or die(mysqli_error($condb));
$user_row = mysqli_fetch_array($user_query);
$student_RegNo = $user_row['RegNo'];
$student_appNo = $user_row['appNo']; $student_facut = $user_row['Faculty'];
$student_dept = $user_row['Department'];$student_prog = $user_row['app_type']; $student_state = $user_row['state'];
$student_level = $user_row['p_level']; $sprog_dura = $user_row['prog_dura'];$s_session = $user_row['Asession'];
$regSession   =	substr($user_row['Asession'],5,10);  $acastatus = $user_row['acads'];
$syog = $user_row['yog'];
$c_year = date("Y");
$sender_counts = "1";
$p_dro = $sprog_dura * 100;
$difflevel = $p_dro - $student_level;
$resultview = showfullresult ;
//$queryupdatelevel = mysqli_query($condb,"UPDATE student_tb SET p_level +='100' WHERE stud_id='".mysql_real_escape_string($session_id)."'");
//$output2=mysqli_query($condb,$queryupdate);
//}
//$admin_id = $user_row['admin_id'];
//$admin_accesscheck = $user_row['access_level'];
//$_SESSION['access'] = $admin_accesscheck;
$newl = $student_level + 100;
$user_query1 = mysqli_query($condb,"select * from session_tb where action='1' and prog = '".safee($condb,$student_prog)."'")or die(mysqli_error($condb));
$user_row2 = mysqli_fetch_array($user_query1);
$default_session=$user_row2['session_name']; $esetSession   =	substr($user_row2['session_name'],5,10);
$acasemestertag =$user_row2['term']; $setendst=$user_row2['start_end'];
$_SESSION['regno'] = $student_RegNo;
$diffsession = $esetSession - $regSession;
$sessionGP = getcgpa($student_RegNo,$student_prog,$s_session,$student_level);
$getsecgpstatus = getAcagpstatus($sessionGP,$student_prog);
if($getsecgpstatus == 8){  $flevel = $student_level; $fsec = $s_session; $fs_status = 8;
}elseif($getsecgpstatus == 7){ $flevel = $student_level; $fsec = $s_session; $fs_status = 7;
}else{ $flevel = $newl; $fsec = $default_session; $fs_status = 1; }
if(($default_session !== $s_session) and ($esetSession > $regSession) and ($student_level < $p_dro) and ($diffsession == 1) ){
//$queryupdatelevel = mysqli_query($condb,"UPDATE student_tb SET p_level ='".safee($condb,$newl)."',Asession='".safee($condb,$default_session)."',acads = '".safee($condb,$default_session)."' WHERE stud_id='".safee($condb,$session_id)."'")or die(mysqli_error($condb));
$queryupdatelevel = mysqli_query($condb,"UPDATE student_tb SET p_level ='".safee($condb,$flevel)."',Asession='".safee($condb,$fsec)."',acads = '".safee($condb,$fs_status)."' WHERE stud_id='".safee($condb,$session_id)."'")or die(mysqli_error($condb));
}
$date_now = new DateTime();
 $date2    = new DateTime($setendst);
$date1=date("Y/m/d");
if ($date_now > $date2) {
mysqli_query($condb,"UPDATE session_tb SET action='0' WHERE session_name='".safee($condb,$default_session)."' and prog = '".safee($condb,$student_prog)."'")
or die(mysqli_error($condb));
    }
    

    
function check_malert(){
	
		if(isset($_SESSION['message'])){
			if(isset($_SESSION['msgtype'])){
				if ($_SESSION['msgtype']=="info"){ ?>
	 				<div class="alertm info" style="text-align:center;"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>'<?php echo $_SESSION['message']; ?></div>
	 			<?php	 
				}elseif($_SESSION['msgtype']=="error"){ ?>
					<div class="alertm danger" style="text-align:center;"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> <?php echo $_SESSION['message'] ; ?></div>
				<?php					
				}elseif($_SESSION['msgtype']=="success"){ ?>
				<div class="alertm success" style="text-align:center;"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> ' <?php echo $_SESSION['message']; ?></div>
			<?php	}	
				unset($_SESSION['message']);
	 			unset($_SESSION['msgtype']);
	   		}
  
		}	

	} 
	
 	if(isset($_SESSION["s_elect1"]))
    { foreach ($_SESSION["s_elect1"] as $cart_itm){
    $elect_ID  = $cart_itm["e_id"];$ecateg =  $cart_itm["e_ecate"]; $efaculty =  $cart_itm["e_fac"]; $electdept =  $cart_itm["e_dept"];
    }}
?>