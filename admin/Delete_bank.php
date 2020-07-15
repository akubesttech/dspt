<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_bank'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM bank where b_id='$id[$i]'");
}
header("location: add_Bank.php");
}
?>