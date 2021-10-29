
<?php 
include('../admin/lib/dbcon.php'); 
dbcon();
$file=$_GET['file'];
$coursecode=trim($_GET['reco']);
$course_name2 = getccode2($coursecode);
$semester=$_GET['c_seme'];
$session=trim($_GET['session']);
$lectura_id=$_GET['staffID'];
$level=$_GET['level'];
$depatment =$_GET['dep'];
$upstate = setresultuptype ;
//getccode2
include('session.php'); 
$pmaxn = getpmax($course_name2,$depatment);
require_once 'Excel/reader.php';
// initialize reader object
$excel = new Spreadsheet_Excel_Reader();

// read spreadsheet data
$excel->read($file);
//echo $excel->sheets[0]['cells'][3][1]."<br/>";
echo $excel->sheets[0]['numRows']-1;
echo "<br/>";
echo $excel->sheets[0]['numCols']."<br/>";
// insert into database
for($x=2;$x<=$excel->sheets[0]['numRows'];$x++)
{ echo $excel->sheets[0]['cells'][$x][1]." ";
echo $excel->sheets[0]['cells'][$x][6]." ";
//if(!empty($pmaxn)){
	///Now time to assign grades and gradepoints and quanlity points
		$grade = "";
        $studentpro = getstudentpro($excel->sheets[0]['cells'][$x][1]);
        $creditunit = ($excel->sheets[0]['cells'][$x][4]);
        
        if(!empty($pmaxn)){
    $recordData =($excel->sheets[0]['cells'][$x][5]) + ($excel->sheets[0]['cells'][$x][6]) + ($excel->sheets[0]['cells'][$x][7]);
}else{  $recordData =($excel->sheets[0]['cells'][$x][5]) + ($excel->sheets[0]['cells'][$x][6]);
}
$gradepoint  =  gradpoint($recordData,$studentpro);
//echo	$recordData ;
if(!empty($upstate)){
$sql20="select * from coursereg_tb where course_id ='".$coursecode."' AND sregno= '".trim($excel->sheets[0]['cells'][$x][1])."' AND session ='".$session."' AND dept = '".$depatment."' ";
}else{$sql20="select * from student_tb where  RegNo= '".trim($excel->sheets[0]['cells'][$x][1])."' AND Department = '".$depatment."' AND verify_Data = 'TRUE' "; }
				
                $resultcheck = mysqli_query($condb,$sql20) or die(mysqli_error($condb));
				if(mysqli_num_rows($resultcheck)>0)
				{
				    if(!empty($pmaxn)){
   $import = "REPLACE INTO results (student_id,course_id,course_code,dept,level,session,semester,c_unit,assessment,passessment,exam,total,grade,gpoint,qpoint) VALUES ('".trim($excel->sheets[0]['cells'][$x][1])."','".$coursecode."','".$course_name2."','".$depatment."','".$level."','".$session."','".$semester."', ".$excel->sheets[0]['cells'][$x][4].",".$excel->sheets[0]['cells'][$x][5].",".$excel->sheets[0]['cells'][$x][6].",'".$excel->sheets[0]['cells'][$x][7]."','".$recordData."','".grading($recordData,$studentpro)."','".gradpoint($recordData,$studentpro)."','".($gradepoint * $creditunit)."')";
}else{$import = "REPLACE INTO results (student_id,course_id,course_code,dept,level,session,semester,c_unit,assessment,exam,total,grade,gpoint,qpoint) VALUES ('".trim($excel->sheets[0]['cells'][$x][1])."','".$coursecode."','".$course_name2."','".$depatment."','".$level."','".$session."','".$semester."', ".$excel->sheets[0]['cells'][$x][4].",".$excel->sheets[0]['cells'][$x][5].",'".$excel->sheets[0]['cells'][$x][6]."','".$recordData."','".grading($recordData,$studentpro)."','".gradpoint($recordData,$studentpro)."','".($gradepoint * $creditunit)."')";
}
$result =		mysqli_query ($condb,$import) or die (mysqli_error($condb));
				//$import = "UPDATE result set post_uscore ='".$excel->sheets[0]['cells'][$x][6]."',average_score='".$recordData."',adminstatus = '".$grade."',course_choice = '".$course1_choice."' where JambNo ='".$excel->sheets[0]['cells'][$x][1]."' and adminstatus != '1' ";
				//mysqli_query ($condb,$import) or die (mysqli_error($condb));
				}}
				if($result){
$resultsec = mysqli_query($condb,"INSERT INTO uploadrecord (staff_id,course,session,semester,level,date_up,scat,dept,prog)
VALUES('$lectura_id','$course_name2','$session','$semester','$level',Now(),'$admin_valid','$depatment','$class_ID')")or die (mysqli_error($condb));}
if(file_exists("temp/".$file))
{  unlink("temp/".$file);}
//header("location:Result_am.php?view=v_so&s2_msg=107&co=".$coursecode." ");
redirect("Result_am.php?view=v_so&s2_msg=107&co=".$course_name2);
exit;
?>