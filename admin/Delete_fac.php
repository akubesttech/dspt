<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_fac'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM faculty where fac_id='$id[$i]'");
	$result2 = mysqli_query($condb,"DELETE FROM dept  where fac_did='$id[$i]'");
	$result3 = mysqli_query($condb,"DELETE FROM courses  where fac_id='$id[$i]'");
}
header("location: add_Faculty.php");
}
/* function getfaculty($get_fac)
{
$query2_hod = @mysqli_query($condb,"select fac_name from faculty where fac_id = '$get_fac' ")or die(mysql_error());
$count_hod = mysql_fetch_array($query2_hod);
 $nameclass22=$count_hod['fac_name'];
return $nameclass22;
} */
?>