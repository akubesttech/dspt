<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_student'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM student_tb where stud_id='$id[$i]'");
}
//header("location: Student_Record.php");
redirect("Student_Record.php");
}
?>