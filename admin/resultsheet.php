<?php
include('lib/dbcon.php'); 
dbcon();
$query3 = mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));$rowdd = mysqli_fetch_array($query3);
$title = $rowdd['SchoolName'];$motto = $rowdd['Motto'];$logoback = $rowdd['Logo'];$exists = imgExists($logoback);
$saddress = $rowdd['Address']; $state = $rowdd['State'];$city = $rowdd['City'];
					if ($exists > 0 ){ $logob =  $rowdd['Logo'];}else{ $logob = "uploads/NO-IMAGE-AVAILABLE.jpg";}
include('session.php');
$bs_dept=$_GET['Schd'];
$bs_sec=$_GET['sec'];
$bs_lev =$_GET['lev'];
$bs_sem =$_GET['sem'];
$instidr = getinstitution($class_ID);
$institu_nr = getincate($instidr);
if($instidr == "1"){$mastersname = "Vice Chancelor"; 
}elseif($instidr == "2"){$mastersname = "RECTOR'S"; 
}else{$mastersname = "Provost";} 
?>
<!DOCTYPE html>
<html>
<head>
<title>Print View | <?php echo $title;  ?></title>
<style type="text/css" media="screen"></style>
<style type="text/css" media="print">
  @media print{ html,body{height:100%;width:100%;padding:0;margin: 1cm 2cm; overflow:visible; a[href]:after {content: none !important;}} @page{size: landscape; margin: 0;}
.break {page-break-after: always;}

body{width:100%;
    height:100%;
margin: 0px;
padding:0;
   /* -webkit-transform: rotate(-90deg) scale(.68,.68); 
    -moz-transform:rotate(-90deg) scale(.58,.58) } */   }
</style>
</head>
<body >

<link rel="stylesheet" href="../assets/css/base.css" type="text/css">

<script src="../assets/js/jquery.js"></script>
<style type="text/css" media="print">/* @media print { a[href]:after {content: none !important;}} @page { size: A4 landscape; margin: 0; */
.row1 {background-color: #EFEFEF;border: 1px solid #98C1D1; height: 30px;	font-family:Verdana, Geneva, sans-serif; 
	font-size:12px; }
.row2 {background-color: #DEDEDE; border: 1px solid #98C1D1; height: 30px; font-family:Verdana, Geneva, sans-serif; 
	font-size:12px; }</style>
<font size="2" face="ariel black" >
<style>
main {
        margin-top: 50px;

    }
    
    
  /*  #result-table th,#result-table td {
        border: solid;
        /*border:1px solid #434340; 
    } */

  /*  td:first-child, th:first-child {
        border: dotted;
    } */
     #result-table th {
        border: solid;
    }
    #result-table td {
        border: none;
       
    }

    .test h4{
        display: inline-flex;
        height: 16em;
        writing-mode: vertical-rl;
        margin-bottom: 15px;
        margin-top: 8px;
       word-break: keep-all !important;
        font-size: small !important;
        transform: rotate(180deg);
        font-family: inherit;
        font-weight: 500;
        line-height: 1.1;
        color: inherit;
        padding-left: 10px;
       
    }
       table {
        border-collapse: collapse;
        border-spacing: 0;
    }
    p {
        text-align: center;
        font-size: large;
    }
 /*   
table , td, th {
	border: 2px solid #595959;
	border-collapse: collapse;
}
td, th {
	padding: 2px;
	width: 10px;
	height: 60px;
 } */

.text-center-row>th,
.text-center-row>td {
  text-align:center;
height: 65px;
padding: 2px;
width: 6px;
}
.text-centerm-row>th,
.text-centerm-row>td {
  text-align: ceneter;
  height: 30px;
  background-color: #DEDEDE; border: 1px solid #98C1D1;  font-family:Verdana, Geneva, sans-serif; 
	font-size:12px;
}
         #rotate { 
      white-space: nowrap;
         -moz-transform: rotate(-90.0deg);  /* FF3.5+ */
       -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
  -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
    -moz-transform: translateX(2%) translateY(43%) rotate(-90deg);
  -webkit-transform: translateX(2%) translateY(43%) rotate(-90deg);
  transform:  translateX(2%) translateY(43%) rotate(-90deg);
  filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
         -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; /* IE8 */
   max-width: 1px; 
   text-align: center;
   background: red;
          z-index: -1;
          writing-mode: vertical-rl;
          
        padding: 2px 5px 0px 7px ; 
}
.rotate {
  /* FF3.5+ */
  -moz-transform: rotate(-90.0deg);
  /* Opera 10.5 */
  -o-transform: rotate(-90.0deg);
  /* Saf3.1+, Chrome */
  -webkit-transform: rotate(-90.0deg);
  /* IE6,IE7 */
  filter: progid: DXImageTransform.Microsoft.BasicImage(rotation=0.083);
  /* IE8 */
  -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)";
  /* Standard */
  transform: rotate(-90.0deg);
  margin-left: -10em;
         margin-right: -10em;
         text-align: center;
}
table.borderless td {
border-width: 0px;
padding: 5px;

}
</style>


<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$con = new Database();

function fetch_course_result($c_code,$sess,$dept){
    $con = new Database();
    $r_q = "Select * from results WHERE course_code = '$c_code' AND session = '$sess' AND dept = '$dept'";
    $results = $con->getData($r_q);
    return $results;
}
function fetch_courses($dept,$sems= null,$lev){
    $con = new Database();
    $c_q ="Select distinct C_code,C_title,C_unit,c_cat from courses WHERE dept_c ='$dept'  AND C_level = '$lev'";
    if($sems != null){
        $c_q .= " AND semester='$sems'";
    }
   
    $courses = $con->getData($c_q);
    return $courses;
}
$first_sem_courses = fetch_courses($bs_dept,$bs_sem,$bs_lev);//fetch_courses($dept,$sems);
    $first_sem_courses_res = array();
    foreach ($first_sem_courses as $course){
        $res = fetch_course_result($course['C_code'],$bs_sec,$bs_dept);
        $first_sem_courses_res[$course['C_code']] = $res;
    }

$sql_gradeset = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$class_ID)."' and grade_group ='01' Order by b_max ASC limit 1 ")or die(mysqli_error($condb)); $getmg = mysqli_fetch_array($sql_gradeset); $getpass = $getmg['b_max'];

$viewcourse1 = mysqli_query(Database::$conn,"SELECT DISTINCT C_code FROM courses  WHERE  C_level='".safee($condb,$bs_lev)."' and semester='".safee($condb,$bs_sem)."'  and dept_c ='".safee($condb,$bs_dept)."' Order by C_code ASC ")or die(mysqli_error($condb)); $numofcos = mysqli_num_rows($viewcourse1);
$viewcourse2 = mysqli_query(Database::$conn,"SELECT DISTINCT C_code FROM courses  WHERE  C_level='".safee($condb,$bs_lev)."' and semester='".safee($condb,$bs_sem)."'  and dept_c ='".safee($condb,$bs_dept)."' Order by C_code ASC ")or die(mysqli_error($condb)); 

$viewstatus = mysqli_query(Database::$conn,"SELECT  c_cat FROM courses  WHERE  C_level='".safee($condb,$bs_lev)."' and semester='".safee($condb,$bs_sem)."'  and dept_c ='".safee($condb,$bs_dept)."' Order by C_code ASC ")or die(mysqli_error($condb));
$viewunit = mysqli_query(Database::$conn,"SELECT  C_unit FROM courses  WHERE  C_level='".safee($condb,$bs_lev)."' and semester='".safee($condb,$bs_sem)."'  and dept_c ='".safee($condb,$bs_dept)."' Order by C_code ASC ")or die(mysqli_error($condb));

$viewcourseunit = mysqli_query(Database::$conn,"SELECT DISTINCT course_code,c_unit FROM results  WHERE  level='".safee($condb,$bs_lev)."' and semester='".safee($condb,$bs_sem)."' and session='".safee($condb,$bs_sec)."' and dept ='".safee($condb,$bs_dept)."'  Order by course_code ASC ")or die(mysqli_error($condb)); $all_property = array();

$querypco = "SELECT DISTINCT student_id FROM  results  WHERE session='".safee($condb,$bs_sec)."' and level='".safee($condb,$bs_lev)."' and dept ='".safee($condb,$bs_dept)."' ";
if($bs_sem != null){ $querypco .= " AND semester='".safee($condb,$bs_sem)."'"; } 
$viewprintco = mysqli_query(Database::$conn,$querypco)or die(mysqli_error($condb));	 
     $serial = 1 ;
$queryrapp = "select * from resultapproval_tb WHERE prog = '".safee($condb,$class_ID)."' AND dept = '".safee($condb,$bs_dept)."' AND session = '".safee($condb,$bs_sec)."' AND level = '".safee($condb,$bs_lev)."' AND apstatus = '1' ";
if($bs_sem != null){ $queryrapp .= " AND semester='$bs_sem'";}
$queryresultapp = mysqli_query($condb,$queryrapp)or die(mysqli_error($condb));
$rowapp = mysqli_fetch_array($queryresultapp); $aptatus = mysqli_num_rows($queryresultapp); 
 if($aptatus > 0){ $course_approve = 1; $bst = "Approved"; $pbcstatus= "Result Successfully Published for Student to access"; }else{ $course_approve = 0; $bst = "";$pbcstatus="Result Has not been Published for Student to access";} 
	
?>
<div >
<center>
    <div class="container" >
    <section id="result-table">

<div class="container-fluid">
<br><br>
    <div class="row">
       <!-- <div class="m-b-3"> --!>
       <div class="col-lg-12">
        <div class="col-lg-1">
            <img class="img-circle" src="<?php echo $logob; ?>" width="100" />
        </div>
        <div class="col-lg-2"></div>
          <div class="col-lg-5">
            <p><strong><font size="5" color="blue"><?php echo $title; ?></font></strong><br />
                <?php echo $motto;//$saddress." .".$city." ".$state." State ."; ?></p>
            <p><strong><?php echo strtoupper($bs_sem); ?> SEMESTER EXAMINATION RESULTS </strong></p>
        </div>
        <div class="col-lg-4">
            <table>
                <thead>
                <tr>
                    <th><?php echo $SCategory; ?>:&nbsp; </th>
                    <th><?php echo getfacultyc($_SESSION['bfac']) ; ?></th>
                    
                </tr>
                <tr>
                    <th><?php echo $SGdept1; ?>:&nbsp; </th>
                    <th><?php echo getdeptc($bs_dept); ?></th>
                    
                </tr>
                <tr>
                    <th>YEAR: </th>
                    <th><?php echo ($bs_sec); ?></th>
                    
                </tr>
                <tr>
                    <th>LEVEL: </th>
                    <th><?php echo getlevel($bs_lev,$class_ID); ?></th>
                    
                </tr>
                </thead>
            
            </table>
        </div>
        </div>
        </div>
        <hr>
    </div>
    
            <div class="row">
                <div class="col-lg-12">

<table cellpadding="0" cellspacing="0"  class="table"  >
	<tbody>
		<tr class="text-center-row">
			<th colspan="4" rowspan="4" style="border:0;"></th>
			<td colspan="5">SUMMARY OF PREVIOUS SEMESTERS </td>
		    <td rowspan="2"><!--Course Title --!></td>
		     <?php //while($get_proc2 = mysqli_fetch_array($viewcourse2)){ 
   //$coursecode = $get_proc2['C_code']; //$coursetitle = getcourse($get_proc['course_code']);
  //array_push($all_property, $get_proc2->course_code);?> <td rowspan="2" colspan="<?php echo $numofcos; ?>" style="color:green;text-size:15px;"><?php //echo $coursecode; ?><strong><?php echo $bst; ?></strong></td><?php //}  ?>
		
			<td colspan="5" >SUMMARY OF CURRENT SEMESTER</td>
			<td colspan="5">SUMMARY OF ALL SEMESTERS</td>
			<td rowspan="5">COMPULSORY COURSES OUTSTANDING</td>
			<td rowspan="5">ACADEMIC STANDING</td>
		</tr>
		<tr >
		<td rowspan="4"  > <div class="rotate">TOTAL UNITS TAKEN SO FAR </div></td>
			<td rowspan="4" > <div class="rotate">TOTAL UNITS PASS SO FAR </div></td>
			<td rowspan="4" ><div class="rotate">CUM GRADE POINT </div></td>
			<td rowspan="4"  ><div class="rotate">CGPA </div></td>
			<td rowspan="4" ><div class="rotate">UNITS OF COMP COURSES O/S </div></td>
			<td rowspan="4"  ><div class="rotate">TOTAL UNITS REGISTERED  </div></td>
			<td rowspan="4" ><div class="rotate">TOTAL UNITS PASSED </div></td>
			<td rowspan="4" ><div class="rotate">TOTAL GRADE POINT  </div></td>
			<td rowspan="4"  ><div class="rotate">GRADE POINT AVERAGE </div></td>
			<td rowspan="4"  ><div class="rotate">UNITS OF COMP COURSES O/S </div></td>
			<td rowspan="4"  ><div class="rotate">TOTAL UNITS TAKEN </div></td>
			<td rowspan="4"  ><div class="rotate">TOTAL UNITS PASSED </div></td>
			<td rowspan="4"  ><div class="rotate">CUMULATIVE GRADE POINT </div></td>
			<td rowspan="4" > <div class="rotate">CUM GRADE POINT AVERAGE </div></td>
			<td rowspan="4" ><div class="rotate">UNITS OF COMP COURSES  </div></td>
			
		</tr>
		<tr class="text-center-row">
			<td>Course Code</td> 
			 <?php //while($get_proc = mysqli_fetch_array($viewcourse1)){ 
  //$headersubject = $get_proc['c_unit']; 
  //$coursecode = $get_proc['C_code']; //$coursetitle = getcourse($get_proc['course_code']);
  //array_push($all_property, $get_proc->course_code);?><!-- <td><?php //echo $coursecode; ?></td> --!><?php //}  ?>
		<?php if(count($first_sem_courses)>0){
                foreach ($first_sem_courses as $course){ ?>
                    <td><?php echo $course['C_code']?></td> <?php } } ?>
		</tr>
		<tr class="text-center-row">
		<td>Status</td>
			<?php //while($get_pros = mysqli_fetch_array($viewstatus)){ 
    ?> <!--<td><?php //if($coursecat > 0){ echo $catn = "C"; }else{ echo $catn = "E"; } ?></td>--!><?php //}  ?>
   <?php if(count($first_sem_courses)>0){
                foreach ($first_sem_courses as $course){  $coursecat = $course['c_cat'];?>
                    <td><?php if($coursecat > 0){ echo $catn = "C"; }else{ echo $catn = "E"; } ?></td> <?php } } ?>
</tr>
<tr class="text-center-row">
			<td>S/N</td>
			<td>MATRIC NO</td>
			<td colspan="2">NAME (SURNAME FIRST)</td>
			<td>Units</td>
				<?php //while($get_unit = mysqli_fetch_array($viewunit)){ 
   //$courseunit = $get_unit['C_unit'];?> <!--<td><?php //echo $courseunit;  ?></td>--!><?php //}  ?>
   
			 <?php if(count($first_sem_courses)>0){
                foreach ($first_sem_courses as $course){  $courseunit = $course['C_unit'];?>
                    <td><?php echo $courseunit;  ?></td> <?php } } ?>
		</tr>
		<?php  $i=1;//and course_code = '".safee($condb,$coursecode)."' 
					  while($row = mysqli_fetch_array($viewprintco)){
					  if ($i%2) {$classo = 'row1';} else {$classo = 'row2';}$i += 1;
					   $sregno = $row['student_id'];
                       $stu = 0; $stp = 0; $tp  = 0; $stgp = 0; $pgp = 0 ;
$viewgetotal = mysqli_query(Database::$conn,"SELECT total,course_code,student_id FROM results  WHERE student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."' and semester = '".safee($condb,$bs_sem)."' and session = '".safee($condb,$bs_sec)."' and dept = '".safee($condb,$bs_dept)."'   Order by course_code ASC ")or die(mysqli_error($condb)); //$numtotal = mysqli_num_rows($viewgetotal);
//total grade point current semester
$viewtcousegrade = mysqli_query(Database::$conn,"SELECT SUM(gpoint * c_unit) as totalgpoint FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."' and semester='".safee($condb,$bs_sem)."' and session='".safee($condb,$bs_sec)."' and dept ='".safee($condb,$bs_dept)."' and exam > 0  Order by course_code ASC ")or die(mysqli_error($condb)); $tgpoint = mysqli_fetch_array($viewtcousegrade); 
//credit registered for corent sem
  $viewtregcourese = mysqli_query(Database::$conn,"SELECT SUM(c_unit) as cregu FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."'  and session='".safee($condb,$bs_sec)."' and dept ='".safee($condb,$bs_dept)."'  Order by course_code ASC ")or die(mysqli_error($condb)); $creditregc = mysqli_fetch_array($viewtregcourese);
  // total unit passed
   $viewtcousepass = mysqli_query(Database::$conn,"SELECT SUM(c_unit) as cregu FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."' and  session='".safee($condb,$bs_sec)."' and dept ='".safee($condb,$bs_dept)."' and total > '".safee($condb,$getpass)."' and exam > 0 Order by course_code ASC ")or die(mysqli_error($condb)); $creditpass = mysqli_fetch_array($viewtcousepass);
 
//unit cum failed
$viewtcufail = mysqli_query($condb,"select SUM(rtb.c_unit) as cufail from results rtb LEFT JOIN courses cn ON  rtb.course_code = cn.C_code where student_id='".safee($condb,$sregno)."' and session ='".safee($condb,$bs_sec)."' and rtb.semester ='".safee($condb,$bs_sem)."' and level='".safee($condb,$bs_lev)."' and dept = '".safee($condb,$bs_dept)."' and c_cat ='1'  and total <= '".safee($condb,$getpass)."'  Order by course_code ASC ")or die(mysqli_error($condb)); $get_cnfail = mysqli_fetch_assoc($viewtcufail);
$cunitfail = $get_cnfail['cufail'];

//summary of all semester
//total grade point all semester
$viewtcousegradeall = mysqli_query(Database::$conn,"SELECT SUM(gpoint * c_unit) as totalgpoint FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and dept ='".safee($condb,$bs_dept)."' and exam > 0  Order by course_code ASC ")or die(mysqli_error($condb)); $tgpointall = mysqli_fetch_array($viewtcousegradeall); 
//credit registered for all sem
  $viewtregcoureseall = mysqli_query(Database::$conn,"SELECT SUM(c_unit) as cregu FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and  dept ='".safee($condb,$bs_dept)."' and exam > 0 Order by course_code ASC ")or die(mysqli_error($condb)); $creditregall = mysqli_fetch_array($viewtregcoureseall);
  //all total unit passed
   $viewtcousepassall = mysqli_query(Database::$conn,"SELECT SUM(c_unit) as cregu FROM results  WHERE  student_id ='".safee($condb,$sregno)."'  and dept ='".safee($condb,$bs_dept)."' and total > '".safee($condb,$getpass)."' Order by course_code ASC ")or die(mysqli_error($condb)); $creditpassall = mysqli_fetch_array($viewtcousepassall);
  //all total course failed
$viewtcousefailall = mysqli_query($condb,"select DISTINCT rtb.course_code,rtb.semester,rtb.c_unit,cn.c_cat,cn.C_title,cn.C_code from results rtb LEFT JOIN courses cn ON  rtb.course_code = cn.C_code where student_id='".safee($condb,$sregno)."' and dept = '".safee($condb,$bs_dept)."' and c_cat ='1'  and total <= '".safee($condb,$getpass)."'  Order by course_code ASC ")or die(mysqli_error($condb));
$countfailall = mysqli_num_rows($viewtcousefailall);
//all unit cum failed
$viewtcufailall = mysqli_query($condb,"select SUM(rtb.c_unit) as cufail from results rtb LEFT JOIN courses cn ON  rtb.course_code = cn.C_code where student_id='".safee($condb,$sregno)."' and dept = '".safee($condb,$bs_dept)."' and c_cat ='1'  and total <= '".safee($condb,$getpass)."'  Order by course_code ASC ")or die(mysqli_error($condb)); $get_cnfailall = mysqli_fetch_assoc($viewtcufailall);
$cunitfailall = $get_cnfailall['cufail'];
//summery previous Semester
if($tgpointall['totalgpoint'] > 0){  $gpalln = round($tgpointall['totalgpoint'] / $creditregall['cregu'],2);}else{  $gpalln = "0";}
if($tgpoint['totalgpoint'] > 0){ $gpanow1 = round($tgpoint['totalgpoint'] / $creditregc['cregu'],2);}else{  $gpanow1 = "0"; }
if($creditregall['cregu'] > 0){ $totalupast = $creditregall['cregu'] - $creditregc['cregu']; }else{ $totalupast = "0"; }
if($creditpassall['cregu'] > 0){ $totalupassbf = $creditpassall['cregu'] - $creditpass['cregu'];}else{  $totalupassbf = 0 ;}
if($tgpointall['totalgpoint'] > 0){ $cumgp_pastbf = $tgpointall['totalgpoint'] - $tgpoint['totalgpoint'];}else{ $cumgp_pastbf = 0 ; }
$cgpapast = $gpalln - $gpanow1 ; //if($gpalln >= 1.00){ $estatus = "PROCEED";}else{$estatus = "PROBATE";}
$estatus = getAcastatus(getAcagpstatus($gpalln,$class_ID));
$unitcfail =  $cunitfailall - $cunitfail ;
?>
		<tr class="text-centerm-row" >
			<td><?php echo $serial ++ ;?></td>
			<td><?php echo $sregno; ?></td>
			<td colspan="2"><?php echo getsname($sregno); ?></td>
		     <td>&nbsp;<?php echo $totalupast; ?>&nbsp;</td>
			<td>&nbsp;<?php echo $totalupassbf ; ?>&nbsp;</td>
			<td>&nbsp;<?php echo $cumgp_pastbf; ?>&nbsp;</td>
			
			<td>&nbsp;<?php if($cgpapast > 0){ echo $cgpabf = round($cgpapast,2);}else{ echo $cgpabf = "0.00"; } ?>&nbsp;</td>
			<td>&nbsp;<?php echo $unitcfail; ?>&nbsp;</td>
			<td> </td>
			
			<?php   $numtotal = mysqli_num_rows($viewgetotal);   $rowdif  = $numofcos - $numtotal;  //while($get_proc2 = mysqli_fetch_assoc($viewcourse2)){ 
 	$s= $rowdif;    ?>
<?php  //while($s>0){ echo $cell2 = "<td>  </td>"; $s-=1;} } ?>
<?php foreach ($first_sem_courses as $course){ $scr = 0; ?>
                        <td>
                            <?php
                            if(array_key_exists($course['C_code'],$first_sem_courses_res)){
                                $res = $first_sem_courses_res[$course['C_code']];
                                if(count($res) >0){
                                    foreach ($res as $re){
                                        if($re['student_id'] == $sregno){
                                            $scr = $re['total'];
                                            $stu += $re['c_unit'];
                                            $qp = $re['gpoint']*$re['c_unit'];
                                            $tp += $qp ;
                                            $stgp += $re['qpoint'];
                                            if($re['total'] <= $getpass){
                                                $stp += 1;
                                            }}}}}
                            $nscore = $scr." ".grading($scr,$class_ID);
                            echo getscorest($sregno,$bs_dept,$course['C_code'],$nscore);
                            ?>
                        </td>
                        <?php } ?>
                    
	
		
			<td>&nbsp;<?php if($creditregc['cregu'] > 0){ echo $creditregc['cregu'];}else{ echo "0";} ?>&nbsp;</td>
			<td>&nbsp;<?php if($creditpass['cregu'] > 0){ echo $creditpass['cregu'];}else{ echo "0"; } ?>&nbsp; </td>
			<td>&nbsp;<?php if($tgpoint['totalgpoint'] > 0){ echo $tgpoint['totalgpoint'];}else{ echo "0.00";} ?>&nbsp;</td>
			<td>&nbsp;<?php if($tgpoint['totalgpoint'] > 0){ echo $gpa = round($tgpoint['totalgpoint'] / $creditregc['cregu'],2);}else{ echo $gpa = "0"; } ?>&nbsp;</td>
			<td>&nbsp;<?php if($cunitfail > 0){echo $cunitfail;}else{ echo 0; } ?>&nbsp;</td>
			<td>&nbsp;<?php if($creditpassall['cregu'] > 0){ echo $creditregall['cregu'];}else{ echo "0";} ?>&nbsp;</td>
			<td>&nbsp;<?php if($creditpassall['cregu'] > 0){ echo $creditpassall['cregu'];}else{ echo "0";} ?>&nbsp;</td>
			<td>&nbsp;<?php if($tgpointall['totalgpoint'] > 0){ echo $tgpointall['totalgpoint'];}else{ echo "0.00";} ?>&nbsp;</td>
<td>&nbsp;<?php if($tgpointall['totalgpoint'] > 0){ echo $gpall = round($tgpointall['totalgpoint'] / $creditregall['cregu'],2);}else{ echo $gpall = "0.00";} ?></td>
			<td>&nbsp;<?php if($cunitfailall > 0){ echo $cunitfailall;}else{ echo "0";} ?>&nbsp;</td>
			
			
			 <td><?php while($get_failcall = mysqli_fetch_array($viewtcousefailall)){ $coursefailedall = $get_failcall['course_code']; ?>
                            <?php echo $coursefailedall.", "; ?>
                           <?php }  ?>&nbsp;<?php if($countfailall < 1 ){ ?>
                            <?php echo " - "; } ?>&nbsp;</td>
			<td><?php echo $estatus; ?></td>
			
		</tr> <?php }  ?>
	</tbody>
</table>
 
    </div>
            </div>
            <hr>
        </div>

<table  cellpadding="1" cellspacing="1" align="center" > 
<tr style='mso-yfti-irow:1;height:17.85pt'>
  <td width=376 valign=top style='width:281.8pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><u><span
  style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>_____________________<o:p></o:p></span></u></b></p>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><u><span
  style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>_____________________<o:p></o:p></span></u></b></p>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><u><span
  style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>_______________________<o:p></o:p></span></u></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=376 valign=top style='width:281.8pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'><?php echo strtoupper($mastersname." SIGNATURE"); ?><o:p></o:p></span></p>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>DEAN<o:p></o:p></span></p>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>HOD<o:p></o:p></span></p>
  </td>
 </tr>

</table >



<table > 
<tr ><br>
				<td colspan="20" class="table-no-border" style="border:0;"> <div id="ccc2">
<?php  if (authorize($_SESSION["access3"]["rMan"]["rbs"]["edit"])){

?> 
  <a rel="tooltip"  class="btn btn-info" title="Click to approve Result" id="delete1" href="javascript:Resultapproval('<?php echo $bs_dept; ?>','<?php echo $bs_sec; ?>','<?php echo $bs_lev; ?>','<?php echo $bs_sem; ?>','<?php echo $class_ID; ?>','<?php echo $course_approve; ?>');"  ><i class="fa fa-check  <?php echo $course_approve == '0'? 'fa fa-check' : 'fa fa-remove'; ?>"></i>&nbsp;<?php echo $course_approve == '0'? 'Approve' : 'Decline'; ?></a>
  <?php } ?>
<button data-placement="right" title="Click to Print " id="reset" name="B2" class="btn btn-info" onClick="myFunction()" type="reset"><i class="icon-file icon-large"></i> Print </button>&nbsp;
<a href="javascript:void(0);" onclick="window.open('Result_am.php?view=rbs','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-backward icon-large"></i> Close </a>
				</div></td>
				</tr></table>
            

    <script>       
function Resultapproval(dep,sess,lev,sem,pro,status)
{var st = status == '0' ? 'Approve' : 'Decline'
	if (confirm('Your About to ' + st+' this Result Sheet Make Sure All Information are Correct?')) {
window.location.href = 'process.php?action=status11&Schd='+ dep +'&sec='+ sess +'&lev='+ lev +'&sem='+ sem +'&pro='+ pro +'&nst=' + st;
}}
function myFunction() {document.all.ccc2.style.visibility = 'hidden';
window.print();
    document.all.ccc2.style.visibility = 'visible';}
        $(document).ready(function () { setTimeout(border,50);});
        function border() { $('#result-table td').css('border','solid');}
 </script>
</section>
</center>
    </div>
</main>

</body>
</html>