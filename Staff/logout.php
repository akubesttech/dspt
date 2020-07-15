<?php
include('../admin/lib/dbcon.php'); 
dbcon(); 
include('session.php');

$oras = strtotime("now");
$ora = date("Y-m-d",$oras);										
mysqli_query($condb,"update user_log set
logout_Date = '$ora'												
where staff_id = '$session_id' ")or die(mysqli_error($condb));

session_destroy();
//header('location:../UserLogin.php');
header("location:".host()."Userlogin.php");

//	if (isset($_SESSION['id'])) {
	//	unset($_SESSION['id']);
		//session_unregister('hlbank_user');
//	}
//header('location:../UserLogin.php');
//	exit; 
?>