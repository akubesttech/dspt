<?php
 ob_start();
//session_start();
include('lib/dbcon.php'); 
dbcon();
include('session.php');
require_once 'Excel/reader.php'; 
//$session_id = $_GET['userid'];
$session = $_GET['session'];
$course_e = $_GET['cos'];
$dept = $_GET['dept1'];
//$depart2 =  substr($depart,0,8);
$c_choice = $_GET['semester'];
$level = $_GET['level'];
$table = 'coursereg_tb';
$pmaxn = getpmax($course_e,$dept);


//$query = "SELECT sregno,c_code,c_unit,assesment,exam FROM $table where c_code = '$course_e' && session = '$session' && level = '$level'&& semester = '$c_choice' && creg_status='1'";  

//$query = "select DISTINCT sregno as 'Registration number',c_code as 'Course Code',c_unit as 'Credit Unit', assesment as 'Continous Accessment',exam as 'Exam Score' from $table where c_code = '$course_e' && session = '$session' && level = '$level'&& semester = '$c_choice' && creg_status='1'";  
//$setRec = mysqli_query($condb, $query);  
//$columnHeader = '';  
//$columnHeader = "Registration number" . "\t" . "Course Code" . "\t" . "Credit Unit" . "\t"."Continous Accessment" . "\t" . "Exam Score" . "\t" ;  
//$setData = '';  
  //while ($rec = mysqli_fetch_array($setRec)) {  
    //$rowData = '';  
    //foreach ($rec as $value) {  
       // $value = '"' . $value . '"' . "\t";  
       // $rowData .= $value;  
    //}  
   // $setData .= trim($rowData) . "\n";  
//}  
 
 //	header("Content-Type: application/xls");    
//header("Content-Disposition: attachment; filename='$session'_'".$course_e."'_Student_Exam_Template.xls");   
	//header("Pragma: no-cache"); 
	//header("Expires: 0"); 
//header("Content-type: application/octet-stream"); 
//header("Content-Disposition: attachment; filename=User_Detail.xlsx");   
//header("Content-Disposition: attachment; filename='$session'_'".$course_e."'_Student_Exam_Template.xls"); 
//header("Pragma: no-cache");  
//header("Expires: 0");  

  //echo ucwords($columnHeader) . "\n" . $setData . "\n";  

?>



    <?php
    	$option = trim($course_e);
$option = str_replace(' ', '_', $option); $assessment = "Continous Assessment ".getamax($course_e,$amax,$dept)." %"; $examscore = "Exam Score ".getemax($course_e,$emax,$dept)." %";
$p_assess = $CA2." ".$pmaxn." %";
    	header("Content-Type: application/xls"); 
		//header("Content-Disposition: attachment; filename='$session'_'".$course_e."'_Student_Exam_Template.xls");
		header("Content-Disposition: attachment; filename=".$session."_".$option."_Student_Exam_Template.xls");     
    	//header("Content-Disposition: attachment; filename=download.xls");  
    	header("Pragma: no-cache"); 
    	header("Expires: 0");
     //str_replace()
    	//include('../admin/lib/dbcon.php'); 
//dbcon();
     
    	$output = "";
     
    	//if(ISSET($_POST['export'])){
    		$output .="
    			<table border='1'>
    				<thead>
    					<tr>
    						<th>Matric No</th>
    						<th>Name</th>
    						<th>Course Code</th>
    						<th>Credit Unit</th>
    						<th>" .$assessment."</th>";
                           if(!empty($pmaxn)){
                            $output .="	<th>".$p_assess."</th>"; }
   					$output .="	<th>".$examscore."</th>
    					</tr>
    				<tbody>
    		";
     
    		$query = mysqli_query($condb,"SELECT sregno,c_code,c_unit,assesment,exam,p_assess,dept  FROM coursereg_tb where dept = '$dept' AND c_code = '$course_e' AND session = '$session' AND level = '$level' AND semester = '$c_choice' AND creg_status='1' ") or die(mysqli_errno($condb));
    		$countt = mysqli_num_rows($query);
			while($fetch = mysqli_fetch_array($query)){
     $output .= "
    					<tr>
    						<td>".$fetch['sregno']."</td>
    						<td>".getsname($fetch['sregno'])."</td>
    						<td>".$fetch['c_code']."</td>
    						<td>".$fetch['c_unit']."</td>
    						<td>".$fetch['assesment']."</td>";
                             if(!empty($pmaxn)){
                      $output .= "      <td>".$fetch['p_assess']."</td>"; }
    					$output .= "	<td>".$fetch['exam']."</td>
    					</tr>
    		";
    		}
     
    		$output .="";
    		if ($countt < 1)
{
    $output .= "<tr><td colspan='5'>No Record(s) Found!</td></tr>
    		"; }
    			$output .= "	</tbody>
     
    			</table>
    		";
     
    		echo $output;
    //	}
       ob_end_flush();
    ?>