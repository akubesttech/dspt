<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_posi'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($condb,"DELETE FROM post_tb where postid='$id[$i]'");

}
header("location: election.php?view=viewpost");
}
/* function getfaculty($get_fac)
{
$query2_hod = @mysqli_query($condb,"select fac_name from faculty where fac_id = '$get_fac' ")or die(mysql_error());
$count_hod = mysql_fetch_array($query2_hod);
 $nameclass22=$count_hod['fac_name'];
return $nameclass22;
} */
?>