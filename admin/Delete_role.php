<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_role'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM role where role_rolecode ='$id[$i]'");
}
header("location: add_role.php");
}
?>