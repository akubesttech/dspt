<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_acup'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM courses where dept_c ='$id[$i]'");
}
header("location: add_Courses.php?view=impc");
}
?>