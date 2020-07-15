<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_hostel'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM hostedb where h_code='".safee($condb,$id[$i])."'");
		$result2 = mysqli_query($condb,"DELETE FROM roomdb where  h_coder='".safee($condb,$id[$i])."'");
}
header("location: add_Hostel.php");
}
?>