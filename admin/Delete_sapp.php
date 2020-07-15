<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_app'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM new_apply1 where stud_id='$id[$i]'");
}
header("location: new_apply.php");
}
?>