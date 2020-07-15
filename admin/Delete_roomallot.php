<?php
include('lib/dbcon.php'); 
dbcon();
include('session.php');  
if (isset($_POST['delete_allotroom'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{$row = mysqli_fetch_array(mysqli_query($condb,"select * from hostelallot_tb where allot_id ='".safee($condb,$id[$i])."' AND allotexpire < (CURDATE()) "));
	extract($row);
	mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'".safee($condb,$admin_username)."','
	Hostel Room allotment info of $studentreg  with Hostel name :".gethostel($h_code)."  Room No: " .getroomno($roomno)." was Deleted by ". $admin_username.". ')")or die(mysqli_error($condb));
	$sql2   = mysqli_query($condb,"UPDATE  roomdb SET room_status = '1' WHERE room_id = '".safee($condb,$roomno)."'");
	$result = mysqli_query($condb,"DELETE FROM hostelallot_tb where allot_id='".safee($condb,$id[$i])."' AND allotexpire < (CURDATE())");
header("location: add_Hostel.php?view=allotR");
}
}
?>