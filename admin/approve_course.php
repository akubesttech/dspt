<?php
//session_start();
include('lib/dbcon.php'); 
dbcon(); 
 include('session.php'); 
if (isset($_POST['appcourse'])){
$id=$_POST['selector3'];
$N = count($id);
 $deptcp = $_POST['deptcp'];
          $sessions = $_POST['sessions'];
             $cosd = $_POST['cosd'];
for($i=0; $i < $N; $i++)
{ $sql2="select * from coursereg_tb where creg_id ='".$id[$i]."' and session = '".$sessions[$i]."' and dept = '".$deptcp[$i]."'";
				$result2=mysqli_query($condb,$sql2) or die(mysqli_error($condb));
				$row=mysqli_fetch_array($result2);
	extract($row);
				if(mysqli_num_rows($result2)>0)
				{ //continue;
mysqli_query($condb,"UPDATE coursereg_tb  SET lect_approve = '1' where creg_id ='".$id[$i]."' and session ='".$sessions[$i]."' and dept = '".$deptcp[$i]."' ")or die(mysqli_error($condb));
				}else{
			mysqli_query($condb,"UPDATE coursereg_tb  SET lect_approve = '0' where creg_id ='".$id[$i]."' and session ='".$sessions[$i]."' and dept = '".$deptcp[$i]."' ")or die(mysqli_error($condb));
				}}
redirect('Result_am.php?view=caprove&Schd='.($dept).'&sec='.($session).'&scos='.getccode2($course_id));

}


?>