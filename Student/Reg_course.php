<?php
//session_start();
include('../admin/lib/dbcon.php'); 
dbcon(); 
 include('session.php'); 
if (isset($_POST['add_course'])){
$id=$_POST['selector'];
$sem = $_POST['sem'];
$lev = $_POST['level'];
$N = count($id);
for($i=0; $i < $N; $i++)
{

	//$result = mysqli_query($condb,"DELETE FROM courses where C_id='$id[$i]'");
		$sql="select * from courses where C_id='".$id[$i]."' ";
			$result=mysqli_query($condb,$sql) or die(mysqli_error($condb));
			$count=mysqli_num_rows($result);
		$row=mysqli_fetch_array($result);
	extract($row);
$sql2="select * from coursereg_tb where course_id ='".$id[$i]."' AND sregno= '".$_SESSION['regno']."' AND dept = '".safee($condb,$student_dept)."'";
				$result2=mysqli_query($condb,$sql2) or die(mysqli_error($condb));
				if(mysqli_num_rows($result2)>0)
				{
					//continue;
					mysqli_query($condb,"update coursereg_tb  set creg_status='1',session = '".safee($condb,$default_session)."',semester='".safee($condb,$sem[$i])."',level='".safee($condb,$lev[$i])."',c_unit='".safee($condb,$C_unit)."',lect_approve ='0' , dept = '".safee($condb,$student_dept)."' where sregno='".$_SESSION['regno']."' AND course_id ='".$id[$i]."'  ")or die(mysqli_error($condb));
				}
				else
				{
				$query="insert into coursereg_tb(sregno,course_id,c_code,level,semester,c_unit,session,dept,creg_status,lect_approve)values('".$_SESSION['regno']."','".$C_id."','".$C_code."','".$lev[$i]."','".$sem[$i]."','".$C_unit."','".$default_session."','".safee($condb,$student_dept)."','1','0')";
					$result2=mysqli_query($condb,$query) or die(mysqli_error($condb));
				}
					
					
}
//header("location: course_manage.php");
//redirect('course_manage.php?view=S_CO');
redirect('course_manage.php?view=r_co');

}
//insert into amounttbl (amount_paid,level,deltan_nondeltan,session)values('43500','NCE 1','Deltan','2021/2022')

?>