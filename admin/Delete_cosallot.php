<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_callot'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM course_allottb where a_lotid='$id[$i]'");
}
//header("location: allot_Courses.php");
redirect('allot_Courses.php');
}
?>