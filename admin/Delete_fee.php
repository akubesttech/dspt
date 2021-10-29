<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_fee'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM fee_db where fee_id='$id[$i]'");
}
//header("location: add_Fees.php");
redirect("add_Fees.php");
}
?>