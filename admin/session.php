<?php
//Start session
session_start();

//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
	//header("location:".host()."Userlogin.php");
	redirect(host()."Userlogin.php");
    exit();
}
$session_id=$_SESSION['id'];
$sessionlock = $_SESSION['loggedAt2'];
$class_ID = 0;
$user_query = mysqli_query($condb,"select * from admin where admin_id = '".safee($condb,$session_id)."'")or die(mysqli_error($condb));
$user_row = mysqli_fetch_array($user_query);
$admin_username = $user_row['username'];
$admin_id = $user_row['admin_id'];
$admin_accesscheck = $user_row['access_level'];
$Rorder = getrorder($admin_accesscheck);
$_SESSION['alevel1'] = $user_row['access_level'];
$admin_valid = $user_row['validate'];
$sender_count = "0";
 $userdept = getsdept($admin_username);
//$_SESSION['access'] = $admin_accesscheck;

  
/*
session time out code
*/



function getlevelnce($statnum2)
{
  if ($statnum==100)
  {
     return "NCE 1";
  }
  else if($statnum==200)
  {
     return "NCE 2";
  }
  else if($statnum==300)
  {
    return "NCE 3";
  }
 
}

 function getfcate($statnum20 ="",$n = "")
{  if(empty($n)){
if ($statnum20==1){ return "Fee";} else if($statnum20==2){
return "Dues";}else if($statnum20==3){ return "Form";}else if($statnum20==4){ return "Acceptance";}else if($statnum20==5){ return "Hostel";
}else if($statnum20==0){ return "Others"; }
}else{ $output = '';  
	$arr = array("Fee" =>"1","Dues" =>"2","Form" =>"3","Acceptance" =>"4","Hostel" =>"5","Others" =>"0"); 
foreach($arr as $val => $nvalue)
	{$output .= '<option value="'.$nvalue.'">'.$val.'</option>';}
 return $output;}
  }

$p_query2 = mysqli_query($condb,"select * from prog_tb where status='1'")or die(mysqli_error($condb));
$pr_count=mysqli_num_rows($p_query2);
/*function message($msg="", $msgtype="") {
	  if(!empty($msg)) {
	    // then this is "set message"
	    // make sure you understand why $this->message=$msg wouldn't work
	    $_SESSION['message'] = $msg;
	    $_SESSION['msgtype'] = $msgtype;
	  } else {
	    // then this is "get message"
			return $message;
			//return "";
	  }
	} */
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

	if(isset($_SESSION["select_pro"]))
    { foreach ($_SESSION["select_pro"] as $cart_itm){ 
    $class_ID  = $cart_itm["pg_id"];$cnames =  $cart_itm["pro_name"]; $p_duration =  $cart_itm["p_dura"];
    $amax =  $cart_itm["amax"]; $emax =  $cart_itm["emax"];
    }}
    	if(isset($_SESSION["s_elect2"]))
    { foreach ($_SESSION["s_elect2"] as $cart_itv){
    $elect_ID2  = $cart_itv["e_id"];$ecat =  $cart_itv["e_ecate"]; $elefacu =  $cart_itv["e_fac"]; $eleDept =  $cart_itv["e_dept"];
    }}
    
    $user_query1 = mysqli_query($condb,"select * from session_tb where action='1' and prog = '".$class_ID."'")or die(mysqli_error($condb));
$user_row2 = mysqli_fetch_array($user_query1);
$default_session=$user_row2['session_name']; $setend=$user_row2['start_end'];
$default_semester=$user_row2['term'];
$date_now = new DateTime();
 $date2    = new DateTime($setend);
$date1=date("Y/m/d"); 
$nback   =	(int)substr($default_session,5,10) + 1;
$nfront   =	(int)substr($default_session,0,4) + 1;
$default_secadmin = $nfront ."/".$nback;

if ($date_now >= $date2){
mysqli_query($condb,"UPDATE session_tb SET action='0' WHERE session_name='".safee($condb,$default_session)."' and prog = '".$class_ID."'")
or die(mysqli_error($condb));
    }
   $queryshoolp= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $rowp = mysqli_fetch_array($queryshoolp);
							  $ev_actives = $rowp['emailver']; $schoolNe = $rowp['SchoolName'];
                            
?>

 

