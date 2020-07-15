<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_pro'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM Prog_tb where pro_id='$id[$i]'");
}
header("location: add_Program.php");
}
?>