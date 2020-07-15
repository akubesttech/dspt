<html>
<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 14 (filtered)">
<?php include('print_header.php'); ?>
<?php include('session.php'); ?>
<style>

 /* Font Definitions */
 @font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:8.0pt;
	margin-left:0in;
	line-height:107%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-link:"Balloon Text Char";
	margin:0in;
	margin-bottom:.0001pt;
	font-size:8.0pt;
	font-family:"Tahoma","sans-serif";}
span.BalloonTextChar
	{mso-style-name:"Balloon Text Char";
	mso-style-link:"Balloon Text";
	font-family:"Tahoma","sans-serif";}
.MsoChpDefault
	{font-family:"Calibri","sans-serif";}
.MsoPapDefault
	{margin-bottom:8.0pt;
	line-height:107%;}
@page WordSection1
	{size:landscape ;/*13.0in 8.5in;
	margin:48.25pt .5in .5in .75in;*/}
div.WordSection1
	{page:WordSection1;}
.rotate div {
     -moz-transform: rotate(-90.0deg);  /* FF3.5+ */
       -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
  -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
             filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
         -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; /* IE8 */
         margin-left: -10em;
         margin-right: -10em;
        /* transform: rotate(90deg); */
}
.rotate {
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  width: 1.5em;
}
@media print{@page{size: landscape;}
.break {page-break-after: always;}
}
.row1 {background-color: transparent;border: 1px solid #98C1D1;
		height: 30px;	font-family:Verdana, Geneva, sans-serif; font-size:12px; }
.row2 {background-color: transparent;border: 1px solid #98C1D1;height: 30px; font-family:Verdana, Geneva, sans-serif;
</style>

<?php 
//$sess=$_GET['sec'];
//$clevel=$_GET['lev'];
//$bs_dept =$_GET['Schd'];
//$gsem =$_GET['sem'];

$dept = $_GET['Schd'];
$sems = $_GET['sem'];

$sess= $_GET['sec'];
$lev = $_GET['lev'];
//$get_RegNo = isset($_GET['userId']) ? $_GET['userId'] : '';
if(!empty($p_duration)){ $nlev = $p_duration * 100;}
if($nlev == $lev){ $dshow = "FCGPA";}else{$dshow = "CGPA";}
//$z=$_GET['date1']; ?>
		<?php
	
		$con = new Database();
		function fetch_course_result($c_code,$sess ){
    $con = new Database();
    $r_q = "Select * from results WHERE course_code = '$c_code' AND session = '$sess'";
    $results = $con->getData($r_q);
    return $results;
}
function fetch_courses($dept,$sems= null,$lev = null){
    $con = new Database();
    $c_q ="Select distinct C_code,C_title,C_unit from courses WHERE dept_c ='$dept'";
    if($sems != null){
        $c_q .= " AND semester='$sems'";
    }
    if($lev != null){
        $c_q .= " AND C_level = '$lev'";
    }
    $courses = $con->getData($c_q);
    return $courses;
}
function compute_grade_numbers_frm_result($gradelist,$results){
    $grade_anal = array();
    foreach ($gradelist as $grade){
        $num = 0;
        foreach ($results as $result){
            if($result['grade'] == $grade['grade']){
                $num += 1;
            }
        }
        $grade_anal[$grade['grade']]= $num;
    }
    return $grade_anal;
}
function get_highest_cgpa($res,$studs){
    $highest_cgpa = 0;
    $lowest_cgpa = 0;
    $less1 = 0;
    $bet15_17 = 0;
    $bet17_19 = 0;
    $abv2 = 0;
    $nmpass = 0;
    $carr = 0;
    foreach ($studs as $stud){
        $cgp = 0;
        $gpa = 0;
        $cu = 0;
        $fail = false;
        foreach ($res as $re){
            if($re['student_id'] == $stud['student_id']){
                $qp = $re['gpoint']*$re['c_unit'];
                $gpa += $qp;
                $cu += $re['c_unit'];
                if($qp == 0){
               //$gpa += $re['qpoint'];
                //$cu += $re['c_unit'];
                //if($re['qpoint'] == 0){
                    $fail = true;
                }
            }
        }
       
        if($cu !== 0){
            $cgp = round($gpa/$cu,2);
        }
        if($cgp < 1.5){
            $less1 += 1;
        }elseif ($cgp >= 1.5 && $cgp<=1.74){
            $bet15_17 +=1;
        }elseif($cgp  >= 1.75 && $cgp <= 1.99){
            $bet17_19 +=1;
        }elseif ($cgp >= 2){
            $abv2 += 1;
        }
        if($highest_cgpa < $cgp){
            $highest_cgpa = $cgp;
        }
        if($lowest_cgpa > $cgp){
            $lowest_cgpa = $cgp;
        }
        if($fail == false){
            $nmpass += 1;
        }else{
            $carr +=1;
        }
    }
    return array('highest'=>$highest_cgpa,'lowest'=>$lowest_cgpa,'bel1'=>$less1,'bet157'=>$bet15_17,'bet179'=>$bet17_19,'abv2'=>$abv2,
        'nm_pass'=>$nmpass,'carr'=>$carr);
}
$sql_minscore = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$class_ID)."' and grade_group ='01' Order by b_max ASC limit 1 ")or die(mysqli_error($condb)); $getmg = mysqli_fetch_array($sql_minscore); $getpass = $getmg['b_max'];
$d_q = "Select d_name from dept WHERE dept_id = '$dept'";
$gr_q = "Select distinct grade,gradename,gp,b_max,b_min from grade_tb WHERE grade_group = '01' and prog ='".safee($condb,$class_ID)."' Order by grade ASC ";
$st_q = "Select distinct student_id from results WHERE session= '$sess' AND dept ='$dept'";
if($sems != null){ $st_q .= " AND semester='".safee($condb,$sems)."'"; }
    if($lev != null){ $st_q .= " AND level='".safee($condb,$lev)."'"; } 
$a_re = "Select * from results WHERE session= '$sess' AND dept ='$dept'";
if($sems != null){ $a_re .= " AND semester='".safee($condb,$sems)."'"; } if($lev != null){ $a_re .= " AND level='".safee($condb,$lev)."'"; }  
$crs_re = array();
$all_result = $con->getData($a_re);
//$dept_name = $con->getSingleData($d_q)['d_name'];
$courses = fetch_courses($dept,$sems,$lev);
$grades = $con->getData($gr_q);
$students = $con->getData($st_q);
$cgrade_nums = array();
foreach ($courses as $course){
    //var_dump($course);
    $res = fetch_course_result($course['C_code'],$sess);
    $crs_re[$course['C_code']] = $res;
    $cgrade_nums[$course['C_code']]= compute_grade_numbers_frm_result($grades,$res);
}
		
//$viewcourse1 = mysqli_query(Database::$conn,"SELECT DISTINCT course_code,c_unit FROM results  WHERE  level='".safee($condb,$clevel)."' and semester='".safee($condb,$gsem)."' and session='".safee($condb,$sess)."' and dept ='".safee($condb,$bs_dept)."' Order by course_code ASC ")or die(mysqli_error($condb));  $numofcos = mysqli_num_rows($viewcourse1);
		
		//get pass
//$sql_gradeset = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$class_ID)."' and grade_group ='01' Order by b_max ASC limit 1 ")or die(mysqli_error($condb)); $getmg = mysqli_fetch_array($sql_gradeset);  $getpass = $getmg['b_max'];

//no of student in the level
//$querynostudent = mysqli_query(Database::$conn,"SELECT * FROM results  WHERE  level='".safee($condb,$clevel)."' and semester='".safee($condb,$gsem)."' and session='".safee($condb,$sess)."' and dept ='".safee($condb,$bs_dept)."' group by student_id")or die(mysqli_error($condb)); $numofstudent = mysqli_num_rows($querynostudent);
//no of student in that fail
//$querynostudentfail = mysqli_query(Database::$conn,"SELECT * FROM results  WHERE  level='".safee($condb,$clevel)."' and semester='".safee($condb,$gsem)."' and session='".safee($condb,$sess)."' and dept ='".safee($condb,$bs_dept)."' and total <='".safee($condb,$getpass)."' group by student_id")or die(mysqli_error($condb)); $sumstudentfail = mysqli_num_rows($querynostudentfail);
//no of student in that pass
   //$sumstudentpass = $numofstudent - $sumstudentfail;
//$sql_gradetype = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$class_ID)."' and grade_group ='01' Order by grade ASC ")or die(mysqli_error($condb));
 //maxCGPA
 //$resultQP = mysqli_query($condb,"select (SUM(gpoint * c_unit) / SUM(c_unit))as totalqpoint from results where level='".safee($condb,$clevel)."' and semester='".safee($condb,$gsem)."' and session='".safee($condb,$sess)."' and dept ='".safee($condb,$bs_dept)."' GROUP BY student_id Order by totalqpoint DESC LIMIT 1");  $get_cgpa = mysqli_fetch_array($resultQP);$maxCGPA = $get_cgpa['totalqpoint']; 
 //minCGPA
 //$resultmQP = mysqli_query($condb,"SELECT (SUM(gpoint * c_unit) / SUM(c_unit))as totalqpoint from results  where level='".safee($condb,$clevel)."' and semester='".safee($condb,$gsem)."' and session='".safee($condb,$sess)."' and dept ='".safee($condb,$bs_dept)."' GROUP BY student_id Order by totalqpoint ASC LIMIT 1"); $get_mcgpa = mysqli_fetch_array($resultmQP);  $minCGPA = $get_mcgpa['totalqpoint'] ; 
  
 
                 ?>													
</head>

<body lang=EN-US>
<div class="empty">
<?php  //include('navbar.php'); ?>
<!--<div class="container">
  <div class="row-fluid">
      <div class="col-lg-12">
            <div class="alert alert-success alert-dismissable">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <i class="icon-check"></i><strong> <?php echo $classsnp."".$c_typep; ?> Student Termlly Result Broad Sheet For <?php echo $sess; ?> Academic Session.</strong>
            </div>
       </div>
    </div>
  </div>--!>
 </div>
</div>

 <div class="container">
 <div class="row-fluid">
 <div class="block">
<div class="row-fluid">
<?php $exists02 = imgExists($row1['Logo']);?>
<div class=WordSection1>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span style='font-size:14.0pt;
font-family:"Times New Roman","serif"'><br><img width="100" height="70" id="Picture 1"
src="   <?php  if ($exists02 > 0 ){print $row1['Logo'];}else{ print "uploads/NO-IMAGE-AVAILABLE.jpg";} ?>  "  ></span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span style='font-size:14.0pt;
font-family:"Times New Roman","serif"'><?php echo $row1['SchoolName']; ?></span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
font-family:"Times New Roman","serif"'><?php echo $row1['Motto']; ?></span></b></p>

<br>
<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;text-align:center;line-height:normal'><b><span style='font-size:17.0pt;font-family:"Times New Roman","serif",font color:blue;'><?php  echo $sess." " ; ?>PERFORMANCE ANALYSIS</span></b></p>
<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;text-align:center;line-height:normal'><b><span style='font-size:15.0pt;font-family:"Times New Roman","serif"'><?php if($sems != null){ echo strtoupper(" ".$sems." SEMESTER RESULT");} ?></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:10.0pt;font-family:"Times New Roman","serif"'>&nbsp;</span></b></p>

<div class="container">
<div class="container-fluid">
<div class="row-fluid">
<div class="pull-left"> 
<p class=MsoNormal style='margin-bottom:0in;margin-bottom:2pt;line-height:normal'><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:Verdana, Geneva, sans-serif;'><strong><?php echo $SCategory; ?> :   </strong><?php echo getfacultyc($_SESSION['bfac']) ; ?> .<o:p></o:p></span></p>
<p class=MsoNormal style='margin-bottom:0in;margin-bottom:2pt;line-height:normal'><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:Verdana, Geneva, sans-serif;'><strong><?php echo $SGdept1; ?> :   </strong><?php echo getdeptc($dept) ; ?><o:p></o:p></span></p>
<p class=MsoNormal style='margin-bottom:0in;margin-bottom:2pt;line-height:normal'><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:Verdana, Geneva, sans-serif;'><strong>Programme :   </strong><?php echo $cnames ; ?><strong>  Level :   </strong><?php echo getlevel($lev,$class_ID) ; ?><o:p></o:p></span></p>
<p class=MsoNormal style='margin-bottom:0in;margin-bottom:2pt;line-height:normal'><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:Verdana, Geneva, sans-serif;'><strong>DATE Printed: </strong><?php
 $date = new DateTime();
 echo $date->format('l, F jS, Y');
 ?><o:p></o:p></span></p>

<div class="pull-right">
   <div class="empty" id="ccc2">
<p class=MsoNormal style='margin-bottom:0in; margin-left:-110px; margin-top:-30px; margin-bottom:.0001pt;line-height:
           normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>
		   <a href="#" onClick="myFunction()" class="btn btn-info" id="print" data-placement="top" title="Click to Print"><i class="icon-print icon-large"></i> Print</a></p>		      
<script type="text/javascript"> $(document).ready(function(){ $('#print').tooltip('show'); $('#print').tooltip('hide'); }); </script> 
<p class=MsoNormal style='margin-bottom:0in; margin-top:-30px; margin-bottom:.0001pt;line-height:normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>
			<a id="return" data-placement="top" class="btn btn-success" title="Click to Return" href="Result_am.php?view=pan"><i class="icon-arrow-left"></i> Back</a></p>		
			<script type="text/javascript">
			$(document).ready(function(){ $('#return').tooltip('show');$('#return').tooltip('hide');}); </script>       	   
    </div>
</div>
    
<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
"Times New Roman","serif"'><o:p>&nbsp;</o:p></span></p>

<!-- Report Analysis --!>
<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;'>
 
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:15.25pt;font-family:Verdana, Geneva, sans-serif;'>
  <td width=188 style='width:60.9pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .5pt;background:#BFBFBF;mso-background-themecolor:background1;
  mso-background-themeshade:191;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-family:"Times New Roman","serif"'>S/N<o:p></o:p></span></b></p>
  </td>
 
  <td width=188 style='width:200.9pt;border:solid windowtext 1.0pt;mso-border-alt:solid windowtext .5pt;background:#BFBFBF;mso-background-themecolor:background1;mso-background-themeshade:191;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:normal'><b style='mso-bidi-font-weight:normal'><span style='font-family:"Times New Roman","serif"'>Course Code<o:p></o:p></span></b></p>
  </td>
  <td width=188 style='width:500.9pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#BFBFBF;mso-background-themecolor:background1;mso-background-themeshade:
  191;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-family:"Times New Roman","serif"'>Course Title<o:p></o:p></span></b></p>
  </td>
  <td width=188 style='width:80.9pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#BFBFBF;mso-background-themecolor:background1;mso-background-themeshade:
  191;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-family:"Times New Roman","serif"'>Credit Unit<o:p></o:p></span></b></p>
  </td>
  
   <?php
 if(count($grades)>0){
                foreach ($grades as $grade){
 //while($get_proc=mysqli_fetch_array($sql_gradetype)){ 
  //$headersubject = $get_proc['grade']; 
   ?>
  <td width="8" style='width:8.9pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#BFBFBF;mso-background-themecolor:background1;mso-background-themeshade:
  191;padding:0in 2.4pt 0in 2.4pt;height:10.25pt;' class="rotate2"><div>
  <p  class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal;'><b style='mso-bidi-font-weight:normal;'><span style='font-family:"Times New Roman","serif"'><?php  echo $grade['grade']?><?php //echo $headersubject;?><o:p></o:p></span></b></p></div>
  </td>
  <?php //} ?>
 <?php }} ?>
   <td width=188 style='width:60.95pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#BFBFBF;mso-background-themecolor:background1;mso-background-themeshade:
  191;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-family:"Times New Roman","serif"'>TOTAL<o:p></o:p></span></b></p>
  </td>
   <td width=188 style='width:50.95pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#BFBFBF;mso-background-themecolor:background1;mso-background-themeshade:
  191;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-family:"Times New Roman","serif"'>%PASS<o:p></o:p></span></b></p>
  </td>
   <td width=188 style='width:50.95pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#BFBFBF;mso-background-themecolor:background1;mso-background-themeshade:
  191;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-family:"Times New Roman","serif"'>%FAIL<o:p></o:p></span></b></p>
  </td>
 

 </tr>
   <!-- MYSQL FETCH ARRAY-->
   <?php
        if(count($courses) > 0){
            $serial = 1;
            foreach ($courses as $course){
             $tmp = $cgrade_nums[$course['C_code']];
                $nf = 0;
                $p_pass = 0;
             
                ?>
                
<?php //$serial=1;    //while($row = mysqli_fetch_assoc($viewcourse1)){ 
//$ccode = $row['course_code'];
//$sql_gradetype2 = mysqli_query($condb,"select grade,b_min,b_max from grade_tb where prog ='".safee($condb,$class_ID)."' and grade_group ='01' Order by grade ASC ")or die(mysqli_error($condb));
$querynopercoursep = "SELECT * FROM results  WHERE   session='".safee($condb,$sess)."' and dept ='".safee($condb,$dept)."' and course_code = '".safee($condb,$course['C_code'])."'"; 
if($sems != null){ $querynopercoursep .= " AND semester='".safee($condb,$sems)."'"; } if($lev != null){ $querynopercoursep .= " AND level='".safee($condb,$lev)."'"; }
    $querynopercoursep.= " Order by course_code ASC "; $querynopercourse = mysqli_query(Database::$conn,$querynopercoursep);
$numofpercos = mysqli_num_rows($querynopercourse);
//no of student that pass per course
$querypasspercoursep = "SELECT * FROM results  WHERE   session='".safee($condb,$sess)."' and dept ='".safee($condb,$dept)."' and course_code = '".safee($condb,$course['C_code'])."' and total > '".safee($condb,$getpass)."'"; 
if($sems != null){ $querypasspercoursep .= " AND semester='".safee($condb,$sems)."'"; } if($lev != null){ $querypasspercoursep .= " AND level='".safee($condb,$lev)."'"; }
    $querypasspercoursep.= " Order by course_code ASC "; $querypasspercourse = mysqli_query(Database::$conn,$querypasspercoursep);
$numofpasspercos = mysqli_num_rows($querypasspercourse);
if($numofpasspercos < 1){ $percpasscourse = 0;}else{ $percpasscourse = $numofpasspercos / $numofpercos * 100; }
//no of student that fail per course
$queryfailpercoursep = "SELECT * FROM results  WHERE   session='".safee($condb,$sess)."' and dept ='".safee($condb,$dept)."' and course_code = '".safee($condb,$course['C_code'])."' and total <= '".safee($condb,$getpass)."' ";
if($sems != null){ $queryfailpercoursep .= " AND semester='".safee($condb,$sems)."'"; } if($lev != null){ $queryfailpercoursep .= " AND level='".safee($condb,$lev)."'"; }
    $queryfailpercoursep.= " Order by course_code ASC "; $queryfailpercourse = mysqli_query(Database::$conn,$queryfailpercoursep);
$numoffailpercos = mysqli_num_rows($queryfailpercourse);
 if($numoffailpercos < 1){ $percfailcourse = 0; }else{ $percfailcourse = $numoffailpercos / $numofpercos * 100; }
?>
 <tr style='mso-yfti-irow:1'>
 
 <td width=10 valign=top style='width:30.95pt;border-top:none;border-left:
  1;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Times New Roman","serif"'><?php echo $serial++ ?><o:p></o:p></span></p>
  </td>
  <td width=188 valign=top style='width:140.9pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Times New Roman","serif"'><?php //echo $ccode; ?><?php echo $course['C_code']?><o:p></o:p></span></p>
  </td>
  <td width=188 valign=top style='width:140.9pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Times New Roman","serif"'><?php echo $course['C_title'];//getcourse($ccode); ?><o:p></o:p></span></p>
  </td>
  <td width=188 valign=top style='width:140.9pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Times New Roman","serif"'><?php echo $course['C_unit']; ?><o:p></o:p></span></p>
  </td><?php //while($get_proc=mysqli_fetch_array($sql_gradetype2)){ $min =  $get_proc['b_min'];  $max =  $get_proc['b_max'];
  //$qnumstudent = mysqli_query(Database::$conn,"SELECT COUNT(*) AS SUM FROM results  WHERE  level='".safee($condb,$clevel)."' and semester='".safee($condb,$gsem)."' and session='".safee($condb,$sess)."' and dept ='".safee($condb,$bs_dept)."' and course_code = '".safee($condb,$ccode)."' and  total  BETWEEN '".safee($condb,round($min))."' and '".safee($condb,round($max))."' Order by total  ASC ")or die(mysqli_error($condb));
    //while($get_nocont=mysqli_fetch_array($qnumstudent)){  $sumnospergrade = $get_nocont['SUM'];
    foreach ($grades as $grade){ ?>
    <td width=188 valign=top style='width:140.9pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:normal'><span style='font-family:"Times New Roman","serif"'>
  <?php echo $tmp[$grade['grade']]; 
  if(($grade['grade']) == 'F'){ $nf = $tmp[$grade['grade']];}
  //if(strtolower($grade['gradename']) == 'fail'){ $nf = $tmp[$grade['grade']];}
  //if($sumnospergrade < 1){ echo " 0 ";}else{ echo $sumnospergrade; }  ?><o:p></o:p></span></p></td><?php } ?>
  
  <td width=188 valign=top style='width:140.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Times New Roman","serif"'><?php echo count($crs_re[$course['C_code']])?><?php //if($numofpercos < 1){ echo " 0 "; }else{ echo $numofpercos ; }  ?><o:p></o:p></span></p>
  </td>
  <td width=188 valign=top style='width:140.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Times New Roman","serif"'><?php
                    $total = count($crs_re[$course['C_code']]);
                    //if($total == 0){echo $total;}elseif($nf == 0){echo $nf;}else{$p_pass = round(($total-$nf)/$total,4)*100;}
                        ?><?php if($percpasscourse < 1){ echo " 0 ";}else{ echo round($percpasscourse,0);} ?><o:p></o:p></span></p>
  </td>
 
   <td width=188 valign=top style='width:140.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Times New Roman","serif"'>
   <?php //if($nf == 0){ echo $nf;}else{ echo (100 -$p_pass);}?>
  <?php if($percfailcourse < 1){ echo " 0 ";}else{ echo round($percfailcourse,0);} ?><o:p></o:p></span></p>
  </td>
  </td>
<?php  //$totalstudent += $numofpasspercos + $numoffailpercos; $sumstudentpass += $numofpasspercos; $sumstudentfail  += $numoffailpercos;
    //}
        }} ?> 
  <!--MYSQL FETCH ARRAY-->
 </tr>

</table>
<!--Report Analysis end Here --!>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-yfti-tbllook:1184;mso-border-insideh:none;mso-border-insidev:none'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:44.85pt'>
   <td width=376 valign=top style='width:281.8pt;height:17.85pt'>
<div class="pull-left"> 
<?php $anal = get_highest_cgpa($all_result,$students);
$sql_gradmain = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$class_ID)."' and grade_group ='01' Order by grade ASC ")or die(mysqli_error($condb)); ?>
<table border="1" style="margin:10px; font-size:12px;  font-weight:bold; width:400px;" >
<tbody>
<tr style="background-color:#BFBFBF;box-shadow: 2px 2px gray;color: #000080; font-size:12px;  font-family:  vandana;text-shadow: 1px 1px gray;"><th colspan="2">&nbsp;</th></tr><?php	$rb_count = 6;$i = 0; if ($i%2) {$class2c = 'row2';} else {$class2c = 'row1';}$i += 1; ?>
    <tr class="<?php echo $class2c; ?>"><td>Total Number Of Student That Sat For The Exams</td><td style="width: 25px;text-align:center;"><?php echo count($students)?><?php //if($numofstudent < 1){ echo " 0 "; }else{ echo $numofstudent ; }  ?> </td></tr>
    <tr class="<?php echo $class2c; ?>"><td>HIGHEST <?php echo $dshow; ?></td><td style="width: 25px;text-align:center;"><?php echo $anal['highest'];?><?php //if($maxCGPA < 1){ echo " 0 "; }else{ echo  round($maxCGPA,2); } ?> </td></tr>
    <tr class="<?php echo $class2c; ?>"><td>LOWEST <?php echo $dshow; ?></td><td style="width: 25px;text-align:center;"><?php echo $anal['lowest'];?><?php //if($minCGPA < 1){ echo " 0 "; }else{ echo round($minCGPA,2) ; } ?> </td></tr>
    <tr class="<?php echo $class2c; ?>"><td>Number of Students With <?php echo $dshow; ?> Less Than 1.5</td><td style="width: 25px;text-align:center;"> <?php echo $anal['bel1'];?></td></tr>
<tr class="<?php echo $class2c; ?>"><td>Number of Students With <?php echo $dshow; ?> Between 1.5 - 1.74</td><td style="width: 25px;text-align:center;"> <?php echo $anal['bet157'];?> </td></tr>
<tr class="<?php echo $class2c; ?>"><td>Number of Students With <?php echo $dshow; ?> Between 1.75 - 1.99</td><td style="width: 25px;text-align:center;"><?php echo $anal['bet179'];?></td></tr>
    <tr class="<?php echo $class2c; ?>"><td>Number of Students With <?php echo $dshow; ?> 2.00 above</td><td style="width: 25px;text-align:center;"> <?php echo $anal['abv2'];?> </td></tr>
    <tr class="<?php echo $class2c; ?>"><td>Number of Students With Pass</td><td style="width: 25px;text-align:center;"><?php echo $anal['nm_pass'];?><?php //if($sumstudentpass < 1){ echo " 0 "; }else{ echo $sumstudentpass ; } ?> </td></tr>
    <tr class="<?php echo $class2c; ?>"><td>Number of Students With carryover</td><td style="width: 25px;text-align:center;"> <?php echo $anal['carr'];?> <?php //if($sumstudentfail < 1){ echo " 0 "; }else{ echo $sumstudentfail ; } ?></td></tr>
    <tr class="<?php echo $class2c; ?>"><td>Number of Students With Malpractice Cases</td><td style="width: 25px;text-align:center;"> 0 </td></tr>
</tbody></table>
</div> </td>
<td>&nbsp;</td>
<td width=376 valign=top style='width:281.8pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
<div class="pull-left"> 
<table border="1" style="margin:10px; font-size:12px;  font-weight:bold; width:220px;" >
 <tbody><tr style="background-color:#BFBFBF;box-shadow: 2px 2px gray;color: #000000; font-size:12px;  font-family:  vandana;text-shadow: 1px 1px gray;"><th>GRADE</th><th>RANGE</th><th>POINT</th></tr>
 <?php while($getgdetails = mysqli_fetch_array($sql_gradmain)){if ($i%2) {$class2c0 = 'row2';} else {$class2c0 = 'row1';}$i += 1;  ?>
        <tr class="<?php echo $class2c0; ?>" style="text-align:center;"><td><?php echo $getgdetails['grade']; ?></td>
     <td > <?php echo $getgdetails['b_min']." - ".$getgdetails['b_max']; ?> </td>
	 <td><?php echo round($getgdetails['gp'],2); ?></td></tr><?php } ?>
</tbody>
    </table>
</div></td> </tr></table>


<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
"Times New Roman","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
"Times New Roman","serif"'><o:p>&nbsp;</o:p></span></p>




<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-yfti-tbllook:1184;mso-padding-alt:
 0in 5.4pt 0in 5.4pt;mso-border-insideh:none;mso-border-insidev:none'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:22.85pt'>
  <td width=376 valign=top style='width:281.8pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
  "Times New Roman","serif"'>HOD'S SIGNATURE<o:p></o:p></span></p>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
  "Times New Roman","serif"'>RECTOR'S SIGNATURE<o:p></o:p></span></p>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
  "Times New Roman","serif"'>DEAN'S SIGNATURE<o:p></o:p></span></p>
  </td>
  
 </tr>
 
 <?php $query= mysqli_query($condb,"select * from admin where admin_id = '$session_id'")or die(mysqli_error($condb));
  $row3 = mysqli_fetch_array($query);
?>
 <tr style='mso-yfti-irow:1;height:17.85pt'>
  <td width=376 valign=top style='width:281.8pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><u><span
  style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>_____________________<?php //echo $row3['firstname']." ".$row3['lastname'];  ?><o:p></o:p></span></u></b></p>
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
 </tr><!--
 <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=376 valign=top style='width:281.8pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>HOD'S SIGNATURE<o:p></o:p></span></p>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>RECTOR'S SIGNATURE<o:p></o:p></span></p>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>DEAN'S SIGNATURE<o:p></o:p></span></p>
  </td>
 </tr> --!>
 
</table>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
"Times New Roman","serif"'><o:p>&nbsp;</o:p></span></p>

</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>
<script>function myFunction() {document.all.ccc2.style.visibility = 'hidden';
window.print();
    document.all.ccc2.style.visibility = 'visible';
}</script>	
<?php //include('footer.php'); ?>
</div>
<?php //include('script.php'); ?>
 </body>
</html>