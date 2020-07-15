<?php
//Start session
session_start();

//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['staff']) ||(trim ($_SESSION['staff']) == '')) {
	//header("location:".host()."Userlogin.php");
		redirect(host()."Userlogin.php");
    exit();
}

$session_id=$_SESSION['staff'];

$user_query = mysqli_query($condb,"select * from staff_details where staff_id = '".safee($condb,$session_id)."'")or die(mysqli_error($condb));
$user_row = mysqli_fetch_array($user_query);
$staff_id = $user_row['usern_id'];
$staff_email = $user_row['email'];
$staff_accesscheck = $user_row['access_level2'];
$sender_counts = "2";
$defaultaccess = "0";
//$_SESSION['access'] = $admin_accesscheck;
$user_query1 = mysqli_query($condb,"select * from session_tb where action='1'")or die(mysqli_error($condb));
$user_row2 = mysqli_fetch_array($user_query1);
$default_session=$user_row2['session_name'];
$default_semester=$user_row2['term'];
//$_SESSION['regno'] = $student_RegNo;
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

?>