
<?php 
$file=$_GET['file'];
$Depart_v=$_GET['dept1'];
$com_choice=$_GET['c_choice'];
$session=$_GET['session'];
$teacherid=$_GET['staffID'];
$course1_choice=$_GET['c_choice'];

 include('../admin/lib/dbcon.php'); 
dbcon();
include('session.php'); 
// include class file
 //$query = "SELECT * FROM staff left join class_tb ON class_tb.assigned = staff.staff_id WHERE class_tb.assigned='$teacherid'";
 //$query = "SELECT * FROM staff_details left join admin ON admin.username = staff_details.staff_id WHERE admin.admin_ed='$teacherid'";
 //$result = mysql_query($query); 
 //$teacher = mysql_fetch_array($result, MYSQL_ASSOC);
// $teachername= $teacher['staff_fname']." ". $teacher['staff_sname'];
require_once 'Excel/reader.php';
// initialize reader object
$excel = new Spreadsheet_Excel_Reader();
$urllogin = host();
// read spreadsheet data
$excel->read($file);
echo $excel->sheets[0]['cells'][3][1]."<br/>";
echo $excel->sheets[0]['numRows']-1;
echo "<br/>";
echo $excel->sheets[0]['numCols']."<br/>";
// insert into database
for($x=2;$x<=$excel->sheets[0]['numRows'];$x++)
{ $record3 = 0; $record3 = 0;$candpro = 0;
    echo $excel->sheets[0]['cells'][$x][1]." ";
echo $excel->sheets[0]['cells'][$x][6]." ";

	///Now time to assign grades and gradepoints and quanlity points
		$grade = "";
	
$record1 =($excel->sheets[0]['cells'][$x][5]);
$record2 =($excel->sheets[0]['cells'][$x][6]);
$record3 =($excel->sheets[0]['cells'][$x][6]) / 2;
//$recordSum  = ($excel->sheets[0]['cells'][$x][6])* 4;
//$recordData  = (($record1 + $recordSum) / 2);
$recordSum  = ($excel->sheets[0]['cells'][$x][5]) / 8;

if($record1 < 1){ $recordData = $record2;  }else{ $recordData  = ($record3 + $recordSum); }
$candpro = getcandpro($excel->sheets[0]['cells'][$x][1]);
$gradepoint  =  entranceStatus($recordData,$candpro);
		echo	$recordData ;
	
	
//if ($recordData >= 250 AND $recordData <=401){$grade = "1";}elseif ($recordData >= 200 AND $recordData <=249) {$grade = "2";}elseif ($recordData == 0) {$grade =  "0";}
	
//$import = "REPLACE INTO result (student_id,subject,session,mid_term,resumption_test,project,continous,score,class_name, class_type,term,teacher_id, date,grade,totalscore) VALUES ('".$excel->sheets[0]['cells'][$x][1]."','".$subject."','".$session."',".$excel->sheets[0]['cells'][$x][2].", ".$excel->sheets[0]['cells'][$x][3].",".$excel->sheets[0]['cells'][$x][4].",'".$excel->sheets[0]['cells'][$x][5]."','".$excel->sheets[0]['cells'][$x][6]."','".$class_name."','".$class_type."','".$term."','".$teachername."', CURDATE(),'".$grade."', '".$recordData."')";
				//mysql_query ($import) or die (mysql_error());
$sql20="select * from new_apply1 where appNo ='".$excel->sheets[0]['cells'][$x][1]."' ";
$resultcheck = mysqli_query($condb,$sql20) or die(mysqli_error($condb)); $recd = mysqli_fetch_array($resultcheck);
$e_address = $recd['e_address']; $app_type = $recd['app_type']; $adminstatus = $recd['adminstatus'];
$subject= getprog($app_type)." Admission Notification"; $fulname = $recd['FirstName']." ". $recd['SecondName']." ".$recd['Othername'];
if($course1_choice == "1"){ $adfac = $recd['fact_1']; $addept = $recd['first_Choice']; }else{ $adfac = $recd['fact_2']; $addept = $recd['Second_Choice']; } 
		if(mysqli_num_rows($resultcheck)>0){
$import = "UPDATE new_apply1 set post_uscore ='".$excel->sheets[0]['cells'][$x][6]."',average_score='".$recordData."',adminstatus = '".$gradepoint."',course_choice = '".$course1_choice."',afac = '".safee($condb,$adfac)."' ,adept='".safee($condb,$addept)."' where appNo ='".$excel->sheets[0]['cells'][$x][1]."' and adminstatus != '1' ";
				mysqli_query($condb,$import) or die (mysqli_error($condb));
if($adminstatus == '1'){
$msg = nl2br("Congratulations! ".$fulname.",.\n
    This is To Inform you that you have been giving admission into ".getdeptc($addept)." in ".$schoolNe.",\n
	Kindly Login to: ".$urllogin."apply_b.php?view=C_R"." with you Application Number and password to Comfirm \n
    To Comfirm your Admission your required to make payment @: ".$urllogin."apply_b.php?view=M_P"." with you Application Number \n
	.............................................................................................................................\n
    Note That This Admission will be withdrawn if you Violate The Terms and Condition of your Admission!\n
    
    This Message was Sent From " .$schoolNe ." @ ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
    For inquiry and complaint please email info@smartdelta.com.ng \n
	
	Thank You Admin!\n\n");
    ob_start(); //Turn on output buffering
$mail_data = array('to' => $e_address, 'sub' => $subject, 'msg' => 'Notify','body' => $msg, 'srname' => $comn);
	send_email($mail_data);}
}

}
if(file_exists("temp/".$file))
{
	unlink("temp/".$file);
}
header("location:new_apply.php?view=v_s&s2_msg=104");
exit;
?>