<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_dept'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM dept where dept_id='$id[$i]'");
}
header("location: add_Dept.php");
}
?>