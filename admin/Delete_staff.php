<?php
include('lib/dbcon.php'); 
dbcon();
include('session.php');  
if (isset($_POST['delete_staff'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{$row = mysqli_fetch_array(mysqli_query($condb,"select * from staff_details where staff_id ='".$id[$i]."' "));
	extract($row);
	mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'".safee($condb,$admin_username)."','Staff Details of $sname $oname with staff username ".$usern_id."  was Deleted by ". $admin_username.". ')")or die(mysqli_error($condb));
	$result = mysqli_query($condb,"DELETE FROM staff_details where staff_id='$id[$i]'");
	if($image!=Null){
	unlink("$image");}
}
header("location: add_Staff.php");
}
?>