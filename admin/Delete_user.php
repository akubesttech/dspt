<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_user'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM user_log where user_log_id='$id[$i]'");
}
//header("location: user_logs.php");
redirect("user_logs.php");
}
?>