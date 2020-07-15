<?php

include('lib/dbcon.php'); 
dbcon(); 
//if(isset($_POST['Addcourse'])){
$Ctitle= $_POST['Ctitle'];
$Ccode = $_POST['Ccode'];
$Cunit = $_POST['Cunit'];
$semester = $_POST['semester'];
$level = $_POST['level'];
$other2 = $_POST['other2'];


$query = mysqli_query($condb,"select * from courses where C_code = '$Ccode' and C_title  = '$Ctitle' ")or die(mysqli_error($condb));
//$row = mysql_fetch_array($query);
$row_course = mysqli_num_rows($query);
if ($row_course>0){
$res="<font color='red'><strong>The Course Entered  Already Exist Try Again..</strong></font><br>";
				$resi=1;
				//echo "<script>alert('Applicationform record inserted sucessfully..');</script>";
				}elseif(!ctype_digit($Cunit)){
				$res="<font color='red'><strong>Incorrect Input it, should be a Digit.</strong></font><br>";
				$resi=1;
				
}else{
if($level=="Others"){
mysqli_query($condb,"insert into courses (C_title,C_code,C_unit,semester,C_level) values('$Ctitle','$Ccode','$Cunit','$semester','$other2')")or die(mysqli_error());

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Course Titled $Ctitle was Add')")or die(mysqli_error()); 
 ob_start();
$res="<font color='green'><strong>New Course was Successfully Added</strong></font><br>";
				$resi=1;
				}else{

mysqli_query($condb,"insert into courses (C_title,C_code,C_unit,semester,C_level) values('$Ctitle','$Ccode','$Cunit','$semester','$level')")or die(mysqli_error());

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Course Titled $Ctitle was Add')")or die(mysqli_error());
$res="<font color='green'><strong>New Course was Successfully Added</strong></font><br>";
				$resi=1;
}

}
//}
?>