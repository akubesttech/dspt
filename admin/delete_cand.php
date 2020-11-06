<?php

include('lib/dbcon.php'); 
dbcon();

$date_now =  date("Y-m-d");
if (isset($_POST['delete_cand'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{ //$sql="select * from electiontb where id='".$id[$i]."'  and eend >'".$date_now."' ";
			//$result=mysqli_query($condb,$sql) or die(mysql_error($condb));
			//$count=mysqli_num_rows($result);
		//$row=mysqli_fetch_array($result);
	//extract($row);
	//$result = mysqli_query($condb,"DELETE FROM electiontb where id='$id[$i]' ")or die(mysql_error($condb));
$result2 = mysqli_query($condb,"DELETE FROM candidate_tb where candid  ='".$id[$i]."'")or die(mysql_error($condb));
}
//header("location: election.php?view=velection");
redirect("election.php?view=candidates");
}
/* function getfaculty($get_fac)
{
$query2_hod = @mysqli_query($condb,"select fac_name from faculty where fac_id = '$get_fac' ")or die(mysql_error());
$count_hod = mysql_fetch_array($query2_hod);
 $nameclass22=$count_hod['fac_name'];
return $nameclass22;
} */
?>