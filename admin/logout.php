<?php
include('./lib/dbcon.php'); 
dbcon(); 
include('session.php');

$oras = strtotime("now");
$ora = date("Y-m-d",$oras);										
mysqli_query($condb,"update user_log set
logout_Date = '$ora'												
where admin_id = '$session_id' ")or die(mysqli_error($condb));
$old_session_id = session_id();
session_id($old_session_id);
session_destroy();
unset($_SESSION["select_pro"]);
unset($_SESSION["s_elect2"]);
//header('location:../UserLogin.php');
header("location:".host()."Userlogin.php");

//	if (isset($_SESSION['id'])) {
	//	unset($_SESSION['id']);
		//session_unregister('hlbank_user');
//	}
//header('location:../UserLogin.php');
//	exit; 
?>