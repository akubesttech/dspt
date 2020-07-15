<?php

include('../admin/lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_rc'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
$result = mysqli_query($condb,"DELETE FROM coursereg_tb where creg_id='".safee($condb,$id[$i])."' and lect_approve ='0'");
}
//header("location: course_manage.php?view=r_co");
redirect('course_manage.php?view=r_co');

}
?>