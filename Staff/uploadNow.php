
<?php 
$file=$_GET['file'];
$coursecode=$_GET['reco'];
$semester=$_GET['c_seme'];
$session=$_GET['session'];
$lectura_id=$_GET['staffID'];
$level=$_GET['level'];

 include('../admin/lib/dbcon.php'); 
dbcon();
// include class file
 //$query = "SELECT * FROM staff left join class_tb ON class_tb.assigned = staff.staff_id WHERE class_tb.assigned='$teacherid'";
 //$query = "SELECT * FROM staff_details left join admin ON admin.username = staff_details.staff_id WHERE admin.admin_ed='$teacherid'";
 //$result = mysqli_query($condb,$query); 
 //$teacher = mysql_fetch_array($result, MYSQL_ASSOC);
// $teachername= $teacher['staff_fname']." ". $teacher['staff_sname'];
require_once 'Excel/reader.php';
// initialize reader object
$excel = new Spreadsheet_Excel_Reader();

// read spreadsheet data
$excel->read($file);
echo $excel->sheets[0]['cells'][3][1]."<br/>";
echo $excel->sheets[0]['numRows']-1;
echo "<br/>";
echo $excel->sheets[0]['numCols']."<br/>";
// insert into database
for($x=2;$x<=$excel->sheets[0]['numRows'];$x++)
{ echo $excel->sheets[0]['cells'][$x][1]." ";
echo $excel->sheets[0]['cells'][$x][5]." ";

	///Now time to assign grades and gradepoints and quanlity points
		$grade = "";
    $recordData =($excel->sheets[0]['cells'][$x][4]) + ($excel->sheets[0]['cells'][$x][5]); //+ ($excel->sheets[0]['cells'][$x][4]) + ($excel->sheets[0]['cells'][$x][5]);
		//echo	$recordData ;
		$studentpro = getstudentpro($excel->sheets[0]['cells'][$x][1]);
$creditunit = ($excel->sheets[0]['cells'][$x][3]);
//$recordSum  = ($excel->sheets[0]['cells'][$x][6])* 4;
//$recordData  = (($record1 + $recordSum) / 2);
 $gradepoint  =  gradpoint($recordData,$studentpro);
	//	echo	$recordData ;
/*	if ($recordData >= 70 AND $recordData <=101) 
		{$grade = "A";$gradepoint = "5";}	elseif ($recordData >= 60 AND $recordData <=69) 
		{	$grade = "B";$gradepoint = "4";}elseif ($recordData >= 50 AND $recordData <=59) {
				$grade =  "C";$gradepoint = "3";}elseif ($recordData >= 45 AND $recordData <=49) {
				$grade = "D";$gradepoint = "2";}elseif ($recordData >= 40 AND $recordData <=44) {
				$grade = "E";$gradepoint = "1";}	elseif ($recordData >= 0 AND $recordData <=39) {
				$grade = "F";$gradepoint = "0";} */



$import = "REPLACE INTO results (student_id,course_code,level,session,semester,c_unit,assessment,exam,total,grade,gpoint,qpoint) VALUES ('".$excel->sheets[0]['cells'][$x][1]."','".$coursecode."','".$level."','".$session."','".$semester."', ".$excel->sheets[0]['cells'][$x][3].",".$excel->sheets[0]['cells'][$x][4].",'".$excel->sheets[0]['cells'][$x][5]."','".$recordData."','".grading($recordData,$studentpro)."','".gradpoint($recordData,$studentpro)."','".($gradepoint * $creditunit)."')";
				mysqli_query($condb,$import) or die (mysqli_error($condb));
				//$import = "UPDATE result set post_uscore ='".$excel->sheets[0]['cells'][$x][6]."',average_score='".$recordData."',adminstatus = '".$grade."',course_choice = '".$course1_choice."' where JambNo ='".$excel->sheets[0]['cells'][$x][1]."' and adminstatus != '1' ";
				//mysql_query ($import) or die (mysqli_error($condb));
			$resultsec = mysqli_query($condb,"INSERT INTO uploadRecord (staff_id,course,session,semester,level,date_up)
VALUES('$lectura_id','$coursecode','$session','$semester','$level',Now())")or die (mysqli_error($condb));
		
}
if(file_exists("temp/".$file))
{
	unlink("temp/".$file);
}
header("location:Result_m.php?view=v_so&s_msg=107&co='".$coursecode."'");
exit;
?>