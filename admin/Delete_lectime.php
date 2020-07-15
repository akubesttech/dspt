<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_lectime'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM lecttime_tb where time_id='$id[$i]'");
}
header("location: lecture_time.php?view=load01");
}
?>