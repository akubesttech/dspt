<?php
ob_start();
/**
 * @author lolkittens
 * @copyright 2020
 */
include('lib/dbcon.php'); 
dbcon(); 
include('session.php');
$querysch= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
$rowsch = mysqli_fetch_array($querysch);$schoolName = $rowsch['SchoolName']." <br> ".getprog($class_ID);
//function for getting member status
$fac = isset($_GET['fac1']) ? $_GET['fac1'] : '';
$depart = isset($_GET['Schd']) ? $_GET['Schd'] : '';
$session = isset($_GET['session2']) ? $_GET['session2'] : '';
$pro_level =  isset($_GET['lev']) ? $_GET['lev'] : '';
$salot_status =  isset($_GET['sta']) ? $_GET['sta'] : '';
$depget = getdeptc($depart);
$replacedept    = str_replace(" ","_",  $depget);
    header("Content-Type: application/xls"); 
	header("Content-Disposition: attachment; filename='$session'_'".$replacedept."'_Student_Details.xls");  
    	//header("Content-Disposition: attachment; filename=download.xls");  
    	header("Pragma: no-cache"); 
    	header("Expires: 0");
        if($depart < 1){ $valuecheck = "";}else{ $valuecheck = "in ";}
 if(empty($pro_level)){$ntitle = "All Students ". $valuecheck .getdeptc($depart);}else{$ntitle = "All ".getlevel($pro_level,$class_ID)." Level Students ".$valuecheck.getdeptc($depart);
}
$noi = 1; 
    	$output = "";
$output .="<center>
<table border='1'>";
//$output .= "<tr ><td colspan='11' style='background-color: #4CAF50;font-size: 22px;text-align: center;color:white;'>".$ntitle."</td></tr>";

$output .= "<tr ><td colspan='13' style='background-color: white;text-align: center;color:black;'><div style='font-size: 25px;'>".$schoolName."</div>
<div style='font-size: 20px;color:green;'>".$session." ACADEMIC SESSION</div>
<div style='font-size: 20px;'>".$ntitle."<div></td></tr>";

$output .= "<thead><tr><th>S/N</th><th>Application Number</th><th>Matric No</th><th>Surname</th><th>First Name</th><th>Middle Name</th> <th>Gender</th>
                <th>Mobile No</th><th>State</th><th>LGA</th>";
$output .= "<th>".$SCategory."</th>";
$output .= "<th>".$SGdept1. "</th>";
$output .= " <th>Status</th></tr><tbody>";
//if(empty($depart) AND empty($session)){
//$viewutme_query = mysqli_query($condb,"select * from student_tb WHERE Asession = '".safee($condb,$default_session)."' and app_type='".safee($condb,$class_ID)."' and verify_Data = 'FALSE'  order by stud_id DESC limit 0,500")or die(mysqli_error($condb));
//}else{
//$viewutme_query = mysqli_query($condb,"select * from student_tb WHERE Department = '".safee($condb,$depart)."' AND Asession = '".safee($condb,$session)."' and app_type='".safee($condb,$class_ID)."' OR Department = '".safee($condb,$depart)."' AND Asession = '".safee($condb,$session)."' and p_level = '".safee($condb,$pro_level)."' and app_type='".safee($condb,$class_ID)."' order by stud_id DESC ")or die(mysqli_error($condb));
//}

 $student_q = "SELECT * FROM student_tb WHERE Asession ='".safee($condb,$session)."' AND app_type='".safee($condb,$class_ID)."' and verify_Data='TRUE'";
if(!empty($fac)){$student_q .= " AND Faculty ='".safee($condb,$fac)."'";}
if(!empty($depart)){$student_q .= " AND Department ='".safee($condb,$depart)."'";}
if(!empty($pro_level)){$student_q .= " AND p_level ='".safee($condb,$pro_level)."'";}
if($salot_status == "TRUE"){$student_q .= " AND verify_Data='TRUE'";}
if($salot_status == "FALSE"){$student_q .= " AND verify_Data='FALSE'";}
$student_q .= " ORDER BY FirstName ASC ";
$viewutme_query=mysqli_query($condb,$student_q)or die(mysqli_error($condb));

$countt = mysqli_num_rows($viewutme_query);
			while($fetch = mysqli_fetch_array($viewutme_query)){
     $fullname = $fetch['FirstName']." ".$fetch['SecondName']." ".$fetch['Othername']; $matno1 = $fetch['RegNo']; $appno1 = $fetch['appNo']; 
     $facn = getfacultyc($fetch['Faculty']);$depn = getdeptc($fetch['Department']);$is_active = getadminstatus($fetch['verify_Data']);
     if(empty($matno1)){ $matn = "No Matric Number";}else{$matn = $matno1; }
    		$output .= "<tr style='text-align: left;'><td>".$noi++."</td>	<td>".$appno1."</td>
    						<td>".$matn."</td><td>".$fetch['FirstName']."</td> <td>".$fetch['SecondName']."</td><td>".$fetch['Othername']."</td><td>".$fetch['Gender']."</td><td>".strval($fetch['phone'])."</td>
                            <td>".$fetch['state']."</td><td>".$fetch['lga']."</td><td>".$facn."</td><td>".$depn."</td>
                            <td>".$is_active."</td></tr>"; }
     	$output .= "";
    		if ($countt < 1){
    $output .= "<tr><td colspan='13'>No Record(s) Found!</td></tr>"; }
    			$output .= "	</tbody></table></center>";
     echo $output;
    //}
	
 ob_end_flush();
?>