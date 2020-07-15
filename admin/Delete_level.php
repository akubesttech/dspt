<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_lform'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM level_db where id='$id[$i]'");
}
header("location: add_level.php");
}
?>