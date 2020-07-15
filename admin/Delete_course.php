<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_courses'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM courses where C_id='$id[$i]'");
}
header("location: add_Courses.php");
}
?>