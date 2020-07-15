<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_ft'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM ftype_db where id='$id[$i]'");
}
header("location:user_Private.php?view=Aftype");
}
?>