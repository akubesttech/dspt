<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_result'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
$sql="select * from uploadrecord where up_id='".$id[$i]."' ";
			$result=mysqli_query($condb,$sql) or die(mysql_error($condb));
			$count=mysqli_num_rows($result);
		$row=mysqli_fetch_array($result);
	extract($row);
	$result = mysqli_query($condb,"DELETE FROM uploadrecord where up_id ='$id[$i]'");
$result2 = mysqli_query($condb,"DELETE FROM results where course_code ='".$course."' and session ='".$session."' and semester ='".$semester."' and level ='".$level."'");
}
//header("location: ../Staff/Result_m.php");
redirect("../Staff/Result_m.php");
}
?>