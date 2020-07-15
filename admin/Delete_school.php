<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_school'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM schoolsetuptd where id='$id[$i]'");
}
header("location: Create_New_Org.php");
}
?>