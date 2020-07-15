<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_grade2'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM grade_tb where id='$id[$i]'");
}
header("location: add_grade.php");
}
?>