<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_sec'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM session_tb where session_id='$id[$i]'");
}
header("location: add_Yearofstudy.php");
}
?>