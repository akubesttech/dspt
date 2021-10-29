<?php //session_start();
include('lib/dbcon.php'); 
dbcon(); 
include('session.php');
$resultsec4 = mysqli_query(Database::$conn,"SELECT level_order,level_name FROM level_db where prog = '$class_ID'  ORDER BY level_order DESC limit 1");
$getmaxl = mysqli_fetch_array($resultsec4); $getmaxlevel = $getmaxl['level_order'];
$dept = $_GET['Schd'];
$sems = $_GET['sem'];
$sess= $_GET['sec'];
$sformn = $_GET['rform'];
if($sformn == 5){$lev = $getmaxlevel;}else{ $lev = $_GET['lev'];}
//$lev = $_GET['lev'];
$cgsem = strlen($sems); 

 if(!empty($sems)){$nlevel = $sems;}else{$nlevel = $default_semester;} 
 if($sformn == 1){$formname = "FORM A"; $subtitle = "Department Result Sheet";
 $nsubtitle = ucwords($sems." Semester ".$sess." Session Examination");}
 elseif($sformn == 2){ $formname = "FORM B"; $subtitle = "Department Result Sheet";
 $nsubtitle = ucwords($sems." Semester ".$sess." Session Examination");}
    elseif($sformn == 3){$formname = "FORM C";$subtitle = "Semester Result Analysis Sheet";
    $nsubtitle = ucwords($sems." Semester ".$sess." Session Examination");}
 elseif($sformn == 4){$formname = "FORM D";$subtitle = "Sessional Result Analysis Sheet";
 $nsubtitle = ucwords("First & Second Semester ".$sess." Session Examination");}
 elseif($sformn == 5){$formname = "FORM F";$subtitle = "Result Sheet Analysis";$nsubtitle = ucwords($nlevel." Semester ".$sess." Session Examination");}else{ $formname = "No FORM Selected"; $subtitle = "Result Sheet";$nsubtitle = "Session Examination";}
$ndgroup = getdpgroup($dept);
$query3 = mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));$rowdd = mysqli_fetch_array($query3);
$title20 = $rowdd['SchoolName'];$motto = $rowdd['Motto'];$logoback = $rowdd['Logo'];$exists = imgExists($logoback);
$saddress = $rowdd['Address']; $state = $rowdd['State'];$city = $rowdd['City'];
$queryrapp = "select * from resultapproval_tb WHERE prog = '".safee($condb,$class_ID)."' AND dept = '".safee($condb,$dept)."' AND session = '".safee($condb,$sess)."' AND level = '".safee($condb,$lev)."' AND apstatus = '1' ";
if($sems != null){ $queryrapp .= " AND semester='$sems'";}
$queryresultapp = mysqli_query($condb,$queryrapp)or die(mysqli_error($condb));
$rowapp = mysqli_fetch_array($queryresultapp); $aptatus = mysqli_num_rows($queryresultapp); 
 if($aptatus > 0){ $course_approve = 1; $bst = "Approved"; $pbcstatus= "Result Successfully Published for Students to access"; }else{ $course_approve = 0; $bst = "";$pbcstatus="Result Has not been Published for Student to access";} 
$instidr = getinstitution($class_ID);
$institu_nr = getincate($instidr);
if($instidr == "1"){$mastersname = "Vice Chancelor"; 
}elseif($instidr == "2"){$mastersname = "RECTOR'S"; 
}else{$mastersname = "Provost";} 					
 ?>
<!DOCTYPE html>
<html>
<head>
<title>Print View | <?php echo $title20;  ?></title>	
<style type="text/css" media="print">
  @media print{@page{size: landscape;}
.break {page-break-after: always;}
}
</style>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
.button1 {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}
</style>
</head>
<body>
<style type="text/css">
.tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #a9a9a9;border-collapse: collapse;}
.tftable th {font-size:12px;background-color:#b8b8b8;border-width: 1px;padding: 8px;border-style: solid;border-color: #a9a9a9;text-align:left;}
.tftable tr {background-color:#ffffff;}
.tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #a9a9a9;}
.tftable tr:hover {background-color:#ffff99;}
.bgtext {
  position: relative;
}

.bgtext:after {
  content: "<?php echo $bst; ?>";
  position: absolute;
  top: 70px;
  left: 0;
  z-index: -1;
 transform: rotate(-45deg);
  color: green;
  font-size: 62px;
    
  background-position: center;
  /* Safari */
  -webkit-transform: rotate(-45deg);

  /* Firefox */
  -moz-transform: rotate(-45deg);

  /* IE */
  -ms-transform: rotate(-45deg);

  /* Opera */
  -o-transform: rotate(-45deg);

  /* Internet Explorer */
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}
#locator { position: absolute; visibility: visible; right: 100px; top: 150px; z-index: 100;font-size:20px;font-family: verdana; } 
</style>


<div class="bgtext">
<div id="locator">
<?php echo $formname."<br><br> Level: ".getlevel($lev,$class_ID); ?>
</div>
<header >
<div style="text-align: center"><span style='font-size:14.0pt;
font-family:"Times New Roman","serif"'><br><img width="100" height="70" id="Picture 1"
src="   <?php if ($exists > 0 ){ echo $logob =  $rowdd['Logo'];}else{ echo $logob = "uploads/NO-IMAGE-AVAILABLE.jpg";} ?>  "  ></span></div>
    <div style="text-align: center;font-family: arial black;font-size: 28px;"><?php echo $title20?></div>
    <div style="text-align: center;font-family: verdana;"><b><?php echo $SCategory." Of ".getfacultyc($_SESSION['bfac']); ?></b></div>
    <?php if(!empty($ndgroup)){ ?><div style="text-align: center;font-family: verdana;"><b><?php echo "Department Of ".getdpgroup($dept);?></b></div><?php } ?>
    <div style="text-align: center;font-family: verdana;"><b><?php echo $subtitle; ?></b></div>
    <div style="text-align: center;font-family: verdana;"><b><?php echo $nsubtitle; //getprog($class_ID)?></b></div>
    <div style="text-align: center;font-family: verdana;"><b><?php $subc = getdeptc($dept); if(!empty($subc)){echo $SGdept1.": ".$subc;}?> </b></div>
</header>
<?php 
$con = new Database();

function cat($cn){ if($cn == 1){ return "C";}else{ return "E";}}
function fetch_course_result($c_code,$sess,$dept,$sformn){
    $con = new Database();
    if($sformn == 5){ 
        $r_q = "Select distinct SUBSTRING(course_code, 1,3) AS ccode,SUM(total) as totaln,SUM(c_unit) as c_unitn,student_id  from results WHERE SUBSTRING(course_code,1,3) = '$c_code' AND dept = '$dept'";
    }else{
    $r_q = "Select * from results WHERE course_code = '$c_code' AND session = '$sess' AND dept = '$dept'";}
    if($sformn == 5){$r_q .= " GROUP BY ccode ";}
    $results = $con->getData($r_q);
    return $results;
}
function fetch_courses($dept,$sems= null,$lev,$sformn){
    $con = new Database();if($sformn == 5){ $c_q ="Select distinct SUBSTRING(C_code, 1,3) AS ccode from courses WHERE dept_c ='$dept'";
    }else{ $c_q ="Select distinct C_code,C_title,C_unit,c_cat from courses WHERE dept_c ='$dept'  AND C_level = '$lev'";}
    if($sems != null){  $c_q .= " AND semester='$sems'";}
    if($sformn == 5){$c_q .= " GROUP BY ccode ";}
   $courses = $con->getData($c_q);
    return $courses;}
    //function fetch_groupcourses($dept,$sems= null,$lev){
    //$con = new Database();
    //$c_q ="Select distinct SUBSTRING(C_code, 1,3) AS ccode from courses WHERE dept_c ='$dept'";
    //if($sems != null){  $c_q .= " AND semester='$sems'";}
    //$c_q .= " GROUP BY ccode ";
   //$courses = $con->getData($c_q);
    //return $courses;}
    		function firstsemcga($dept,$msec,$reg,$lev,$sem ){
    $con = new Database(); $gpn = 0;  $sunit = 0; //$nth = 0;
    $r_q = "Select SUM(gpoint * c_unit) as totalgpoint,SUM(c_unit) as cunit from results WHERE dept ='$dept' AND
    session='".$msec."' AND  level ='".$lev."' AND student_id='". $reg ."' AND semester = '".$sem."' ";
    $results = $con->getSingleData($r_q); $gpn = $results['totalgpoint']; $sunit = $results['cunit'];
    if($gpn > 0){$nth = round($gpn/$sunit,2);}else{ $nth = 0;}
    return $nth;
}
		function subggp($dept,$reg,$c_code ){
    $con = new Database(); $gpn = 0;  $sunit = 0; //$nth = 0;distinct
    $r_q = "Select  distinct SUBSTRING(course_code, 1,3) AS ccode,SUM(gpoint * c_unit) as totalgpoint,SUM(c_unit) as cunit from results WHERE dept ='$dept'  AND student_id='". $reg ."' AND SUBSTRING(course_code,1,3) = '$c_code' ";
    $results = $con->getSingleData($r_q); $gpn = $results['totalgpoint']; $sunit = $results['cunit'];
    if($gpn > 0){$nth = round($gpn/$sunit,2);}else{ $nth = 0;} 
    return $nth;
}

		function gettotalcredit($dept,$reg,$st,$c_code=null){
    $con = new Database(); $gpn = 0;  $sunit = 0; //$st = 0;
    $r_q = "Select distinct SUBSTRING(course_code, 1,3) AS ccode,SUM(gpoint * c_unit) as totalgpoint,SUM(c_unit) as cunit  from results WHERE dept ='$dept'  AND student_id='". $reg ."' ";
    //if($st > 0){$r_q .="AND SUBSTRING(course_code,1,3) = '$c_code' ";}
    $results = $con->getSingleData($r_q); $gpn = $results['totalgpoint']; $sunit = $results['cunit']; 
    if($gpn > 0){$nth = round($gpn/$sunit,2);}else{ $nth = 0;} 
   if($st > 0){ return $gpn;}else{ return $sunit; }
}
function FailedCourses($dept,$msec,$reg,$lev,$gpass ){
    $con = new Database(); $fail = "";  
    $r_q = "Select * from results WHERE dept ='$dept' AND
    session='".$msec."' AND  level ='".$lev."' AND student_id='". $reg ."' AND total < '".$gpass."' ";
    $results = $con->getSingleData($r_q); $fail = ",".$results['course_code'];
    return $fail;
}
	function FailedCourses2($dept,$reg,$gpass ){
    $con = new Database(); $fail = "";  
    $r_q = "Select * from results WHERE dept ='$dept'  AND student_id='". $reg ."' AND total < '".$gpass."' ";
    $results = $con->getSingleData($r_q); $fail = ",".$results['course_code'];
    return $fail;
}
function getdpgroup($dept){
    $con = new Database(); $dgroup = "";  $r_q = "Select d_group from dept WHERE dept_id ='$dept' ";
    $results = $con->getSingleData($r_q); $dgroup = $results['d_group'];
    return $dgroup;}
function fetchGrade($cgpa,$class_ID){ $con = new Database();
    $q = "Select grade from grade_tb WHERE b_min <= '$cgpa' and b_max >= '$cgpa' AND grade_group  ='01' AND prog = '".safee($con,$class_ID)."'";
    $gclass = $con->getData($q); if(count($gclass) > 0){ return $gclass[0]['grade'];}
    return '';}
function fetchGradeClass($cgpa,$class_ID){ $con = new Database();
    $q = "Select gradename from grade_tb WHERE gpmin <= '$cgpa' and gpmax >= '$cgpa' AND grade_group  ='01' AND prog = '".safee($con,$class_ID)."'";
    $gclass = $con->getData($q); if(count($gclass) > 0){ return $gclass[0]['gradename'];}
    return '';}
$first_sem_courses = fetch_courses($dept,$sems,$lev,$sformn);//fetch_courses($dept,$sems);
//$group_courses = fetch_groupcourses($dept,$sems,$lev);
    $first_sem_courses_res = array();
    foreach ($first_sem_courses as $course){
        if($sformn == 5){$res = fetch_course_result($course['ccode'],$sess,$dept,$sformn);
        $first_sem_courses_res[$course['ccode']] = $res; }else{
        $res = fetch_course_result($course['C_code'],$sess,$dept,$sformn);
        $first_sem_courses_res[$course['C_code']] = $res;}
    }
    
 	function gpassunit($dept,$reg,$gpass ){
    $con = new Database(); $fail = 0;  
    $r_q = "Select course_code from results WHERE dept ='$dept'  AND student_id='". $reg ."' AND total >= '".$gpass."' ";
    $results = $con->getData($r_q); $fail = count($results);
    return $fail;
}
 	function gfailunit($dept,$reg,$gpass ){
    $con = new Database(); $fail = 0;  
    $r_q = "Select course_code from results WHERE dept ='$dept'  AND student_id='". $reg ."' AND total < '".$gpass."' ";
    $results = $con->getData($r_q); $fail = count($results);
    return $fail;
} 
 		function getfinalcgpa($dept,$reg){
    $con = new Database(); $gpn = 0;  $sunit = 0; //$nth = 0;
    $r_q = "Select SUM(gpoint * c_unit) as totalgpoint,SUM(c_unit) as cunit from results WHERE dept ='$dept' AND student_id='". $reg ."'";
    $results = $con->getSingleData($r_q); $gpn = $results['totalgpoint']; $sunit = $results['cunit'];
    if($gpn > 0){$nth = round($gpn/$sunit,2);}else{ $nth = 0;}
    return $nth;
}  
    $sql_minscore = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$class_ID)."' and grade_group ='01' Order by b_max ASC limit 1 ")or die(mysqli_error($condb)); $getmg = mysqli_fetch_array($sql_minscore); $getpass = $getmg['b_max'];

$gr_q = "Select distinct grade,gradename,gp,b_max,b_min from grade_tb WHERE grade_group = '01' and prog ='".safee($condb,$class_ID)."' Order by grade ASC ";
//if($sformn == 5 ){
//$st_q = "Select distinct student_id from results WHERE  dept ='$dept' AND level='".safee($condb,$getmaxlevel)."' "; }else{
$st_q = "Select distinct student_id from results WHERE  dept ='$dept' AND level='".safee($condb,$lev)."' AND session= '$sess'";
if($sems != null){ $st_q .= " AND semester='".safee($condb,$sems)."'"; }//}
if($sformn == 5){ $a_re = "Select * from results WHERE dept ='$dept'";}else{
     $a_re = "Select * from results WHERE dept ='$dept' AND level='".safee($condb,$lev)."' AND session= '$sess' ";   }
$all_result = $con->getData($a_re);

$grades = $con->getData($gr_q);
$students = $con->getData($st_q);

if($cgsem <= 5){ $fn = " <th>TCU</th><th>TPS</th><th>GPA</th><th>SEM PERF</th><th>REMARK</th>";
     $fn2 = "<td colspan='5'></td> ";
}else{  
  $fn = " <th>TCU</th> <th>TPS</th> <th>GPA</th> <th>PREV TCU</th> <th>PREV TPS</th> <th>PREV GPA</th><th>CGPA</th> <th>SEM PERF</th> <th>PREV PERF</th> <th>REMARK</th>";  
$fn2 = "<td colspan='10'></td> ";
}
 ?>
<table class="tftable" border="1" > 
<?php if($sformn == 1 ){?>
     <tr><th colspan='3'>COURSE CODE</th><?php if(count($first_sem_courses)>0){ $tu = 0;
foreach ($first_sem_courses as $course){ $tu += $course['C_unit']; ?> <th colspan='2'><?php echo $course['C_code']?></th> <?php }} //echo $fn; ?>   </tr>

<tr><td>S/N</td><td>Name</td><td>MAT. NO</td> <?php if(count($first_sem_courses)>0){ $tu = 0;
foreach ($first_sem_courses as $course){ $tu += $course['C_unit']; ?> <td>MK</td><td>GR</td> <?php }} //echo $fn; ?>   </tr>

<?php }elseif($sformn == 2){?>
 <tr><th colspan='3'>COURSE CODE</th><th colspan='2'></th><?php if(count($first_sem_courses)>0){ $tu = 0;
foreach ($first_sem_courses as $course){ $tu += $course['C_unit']; ?> <th colspan='2'><?php echo $course['C_code']?></th> <?php }} //echo $fn; ?>   </tr>
<tr><td colspan='3'>UNITS</td><td colspan='2'></td><?php if(count($first_sem_courses)>0){ $tu = 0;
foreach ($first_sem_courses as $course){ $tu += $course['C_unit']; ?> <td colspan='2'><?php echo $course['C_unit']." ".cat($course['c_cat'])?></td> <?php }} //echo $fn; ?>   </tr>

<tr><td>S/N</td><td>Name</td><td>MAT. NO</td><td colspan="2"></td> <?php if(count($first_sem_courses)>0){ $tu = 0;
foreach ($first_sem_courses as $course){ $tu += $course['C_unit']; ?> <td colspan='2'></td> <?php }} //echo $fn; ?>   </tr>
<?php }elseif($sformn == 3){?>
      <tr><th>S/N</th><th>Name</th><th>MAT. NO</th> <th>CREDIT HOURS REG.</th> <th>CREDIT HOURS PASSED</th> <th>CREDIT HOURS FAILED</th> <th>TOTAL GRADE POINT</th> <th>GRADE POINT AVERAGE</th> <th>DETAILS OF FAILED COURSES
(CORE COURSES UNDERLINED)
</th>  </tr>
<?php }elseif($sformn == 4){?>
      <tr><th>S/N</th><th>Name</th><th>MAT. NO</th> <th>FIRST SEMESTER GPA</th><th>SECOND SEMESTER GPA</th><th>TGPA</th><th>CGPA</th> <th>DETAILS OF FAILED COURSES
(CORE COURSES UNDERLINED)
</th>  </tr>
<?php }elseif($sformn == 5){?>
      <tr><th>S/N</th><th>Name</th><th>MAT. NO</th> <?php if(count($first_sem_courses)>0){ $tu = 0;
foreach ($first_sem_courses as $course){ //$tu += $course['C_unit']; ?> <th><?php echo $course['ccode']?></th> <?php }}  ?>   
<th>TP</th><th>CGPA</th><th>GPA</th><th>TCHR</th><th>TCHP</th><th>TCHF</th><th>OVERALL</th><th>REMARK</th><th>Details of failed courses
(core courses underlined)
</th>
</tr>
<?php } ?>


<!--<tr><td></td><td ></td>  <?php
            if(count($first_sem_courses)>0){ foreach ($first_sem_courses as $course){?><td><?php echo$course['C_unit']?></td><?php
                }}echo $fn2; ?>  </tr>--!>
           
              <?php $no = 1;
        if(count($students)> 0){
            foreach ($students as $student){
                 $s_id = $student['student_id'];
        $all_courses = "Select Distinct course_code,c_unit,qpoint,grade,session,semester,total,gpoint from results WHERE student_id = '$s_id' AND dept ='$dept' ORDER BY session";
        //$all_courses = "SELECT Distinct rs.course_code,rs.c_unit,rs.qpoint,rs.grade,rs.session,rs.semester,rs.total,rs.gpoint,cr.c_cat FROM results rs LEFT JOIN courses cr ON  rs.dept = cr.dept_c  WHERE student_id = '$s_id' ORDER BY session";
        
$st_all = $con->getData($all_courses);
                $stu = 0;
                $stp = 0;
                $tp  = 0;
                $stgp = 0;
                $pgp = 0;
                $ptp = 0;
                $qp = 0;
                $stf = 0;
                
                $prev_tu = 0;
                $prev_tp = 0;
                $prev_cgpa = 0;
                $fcgpa = 0;
                $cgpa = 0;
                $outstanding_c = '';
                ?>
<tr>  <td><?php echo $no++;?></td><td><?php echo getsname($student['student_id']);?></td>
                    <td><?php echo $student['student_id']?></td>
                    <?php  if($sformn == 1 ){}elseif($sformn == 2){ echo "<td>MK</td><td>GR (GP)</td>"; }  ?>
                    <?php
                    foreach ($first_sem_courses as $course){
                        $scr = 0;
                        $ccoden = "";
                        
                        if($sformn == 5){ $ccoden = $course['ccode'];  }else{ $ccoden = $course['C_code']; }
                        ?>
                        
                            <?php
                            if(array_key_exists($ccoden,$first_sem_courses_res)){
                                if($sformn == 5){ $res = $first_sem_courses_res[$course['ccode']]; }else{ $res = $first_sem_courses_res[$course['C_code']]; }
                                //$res = $first_sem_courses_res[$course['C_code']];
                                if(count($res) >0){
                                    foreach ($res as $re){
                                        if($re['student_id'] == $student['student_id']){
                                           if($sformn == 5){ 
                                            $stu = $re['c_unitn'];
                                            }else{
                                            $scr = $re['total'];
                                            $stu += $re['c_unit'];
                                            $qp = $re['gpoint']*$re['c_unit'];
                                            $tp += $qp ;
                                            $stgp += $re['qpoint'];
                                            //if($re['grade'] != 'F'){
                                              if($re['total'] >= $getpass){
                                                $stp += $re['c_unit']; 
                                                }
                                              if($re['total'] < $getpass){
                                                $stf += $re['c_unit'];
                                              $outstanding_c=$outstanding_c . ",".$re['course_code'];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            
                            //student id and summary of the previous course unit
        $cu = 0;
        $tgpn = 0;
        $qpn = 0;
        $npoint = 0;
        foreach ($st_all as $re){
            $cu += $re['c_unit'];
            $tgpn += $re['gpoint'];
          $qpn = $tgpn * $cu;
         }
        if($cu != 0){
            $npoint = round($qpn / $cu,2);
            }
//$tpearn = gettotalcredit($dept,$student['student_id'],1,"");
$tcreg = gettotalcredit($dept,$student['student_id'],0,"");
                            //echo $scr." ".fetchGrade($scr,$class_ID);
                           $ns = getscorest($student['student_id'],$dept,$ccoden,$scr);
                           $gvalue = fetchGrade($scr,$class_ID)." (".$qp.")";
                           $nvalue = getscorest($student['student_id'],$dept,$ccoden,$gvalue);
                          if($sformn == 1 ){ ?>
                            <td colspan="1"><?php echo $ns ;?></td> <td colspan="1"><?php echo $nvalue ;?></td>
                            <?php }elseif($sformn == 2){?>
                                <td colspan="1"><?php echo $ns ;?></td> <td colspan="1"><?php echo $nvalue ;?></td>
                               <?php }elseif($sformn == 3){  ?>
                        <?php }elseif($sformn == 4){}elseif($sformn == 5){?>
                              <td colspan="1"><?php echo subggp($dept,$student['student_id'],$ccoden)  ;?></td>
                                               <?php     }
                    }
                    if($stu != 0){  $gpa = round($tp/$stu,2); }else{ $gpa = $stu;}
                    $gpaf = 0;
                    $gpas = 0;
                    $p_cu = 0;
                    $p_cu2 = 0;
                    $p_gp2 = 0;
        $tgp1 = 0;
        $scgp = 0;
        $p_gp = 0;
       $pmygpa = 0;
        $p_failed = '';
   
        $gpaf = firstsemcga($dept,$sess,$student['student_id'],$lev,"First");
        $gpas = firstsemcga($dept,$sess,$student['student_id'],$lev,"Second");
        $tgpa = $gpaf + $gpas;
        if($sformn == 5 ){
             $p_failed = FailedCourses2($dept,$student['student_id'],$getpass);
             $nofail =  gfailunit($dept,$student['student_id'],$getpass);
        }else{$nofail = 0;
             $p_failed = FailedCourses($dept,$sess,$student['student_id'],$lev,$getpass);}
       
       if($tgpa != 0){  $pmygpa = round($tgpa/2,2); }else{ $pmygpa = 0;}
       $cgpan =  getfinalcgpa($dept,$student['student_id']);
       if($nofail > 0 ){$status = "Not Graguating";}else{$status = "Graduating";}
          if($sformn == 1 ){}elseif($sformn == 2){ }elseif($sformn == 3){echo "<td>" . $stu . "</td>";
          echo "<td>" . $stp . "</td>";echo "<td>" . $stf . "</td>";
          echo "<td>" . $tp . "</td>";
          echo "<td>" . $gpa . "</td>";
echo "<td>" . $outstanding_c . "</td>";
          }elseif($sformn == 4){echo "<td>" . $gpaf .   "</td>";echo "<td>" . $gpas .  "</td>";echo "<td>" . $tgpa. "</td>";
          echo "<td>" . $pmygpa . "</td>";echo "<td>" . $p_failed . "</td>";}elseif($sformn == 5){  
            echo "<td>" . $npoint . "</td>";echo "<td>" .$cgpan. "</td>";echo "<td>" . firstsemcga($dept,$sess,$student['student_id'],$lev,$nlevel). "</td>";echo "<td>" . $tcreg. "</td>";echo "<td>" . gpassunit($dept,$student['student_id'],$getpass). "</td>";
            echo "<td>" . gfailunit($dept,$student['student_id'],$getpass). "</td>";echo "<td>" . fetchGradeClass($cgpan,$class_ID). "</td>";echo "<td>" . $status. "</td>";echo "<td>" . $p_failed. "</td>";
          }  ?>     
</tr>
<?php } }
   function get_highest_cgpa($res,$studs,$gpass){
    $nmpass = 0;$carr = 0; foreach ($studs as $stud){
        $cgp = 0;
        $gpa = 0;
        $cu = 0;
        $tp = 0;
        $fail = false;
        foreach ($res as $re){ if($re['student_id'] == $stud['student_id']){
                $gpa += $re['qpoint'];
                $cu += $re['c_unit'];
                $qp = $re['gpoint']*$re['c_unit'];
                $tp += $qp ;
                if($re['total'] <= $gpass){ $fail = true;  }}}
       if($fail == false){ $nmpass += 1;}else{ $carr +=1;}}
    return array('nm_pass'=>$nmpass,'carr'=>$carr);}
 $anal = get_highest_cgpa($all_result,$students,$getpass);
                    ?>
</table>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-yfti-tbllook:1184;mso-padding-alt:
 0in 5.4pt 0in 5.4pt;mso-border-insideh:none;mso-border-insidev:none'>
 <?php if($sformn == 5){ ?>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:22.85pt'>
  <td width=376 valign=top style='width:281.8pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
  "Times New Roman","serif";text-align:center;'><strong>CERTIFICATION</strong><o:p></o:p></span></p><div style="font-size:11.0pt">
 					<?php	$sql_gradeset = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$class_ID)."' and grade_group ='01' Order by b_min desc ")or die(mysqli_error($condb));
 while($get_proc=mysqli_fetch_array($sql_gradeset)){ 
  $grade_name = $get_proc['grade']; $gstart = $get_proc['gpmin'];	$gend = $get_proc['gpmax']; $remark = $get_proc['gradename'];
echo $gstart."  -  ".$gend." "."  -  ".strtoupper($remark)."<br>";
   }?></div>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
  "Times New Roman","serif"'><!--PROVOST SIGNATURE--!><o:p></o:p></span></p>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:ARIEL BLACK;'><strong>RESULT STATISTICS</strong><o:p></o:p></span></p>
  <div style="font-size:11.0pt;">
  NUMBER OF GRADUATING STUDENTS	- <?php echo $anal['nm_pass'];?><br>
  NUMBER OF NON-GRADUATING STUDENTS	- <?php echo $anal['carr'];?><br>
  NUMBER OF WITHDRAWALS			- <?php echo 0;?><br>
  TOTAL NUMBER OF STUDENTS		- <?php echo count($students)?><br>
  </div></td></tr> <?php } ?>
 
 <form method="post" class="form-horizontal"  action="ffff" >
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
  "Times New Roman","serif"'><!--<?php echo strtoupper($mastersname." SIGNATURE"); ?> --!><o:p></o:p></span></p>
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
  style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'><!--_____________________--!><o:p></o:p></span></u></b></p>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><u><span
  style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>_______________________<o:p></o:p></span></u></b></p>
  </td>
 </tr>
 
 
  <tr style='mso-yfti-irow:1;height:17.85pt'>
  <td width=376 valign=top style='width:281.8pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt;text-align:center;'><div id="ccc2"><b style='mso-bidi-font-weight:normal'><centre>

<?php  if (authorize($_SESSION["access3"]["rMan"]["rbs"]["edit"])){ ?> 
  <a rel="tooltip"  class="button button1" title="Click to approve Result" id="delete1" href="javascript:Resultapproval('<?php echo $dept; ?>','<?php echo $sess; ?>','<?php echo $lev; ?>','<?php echo $sems; ?>','<?php echo $class_ID; ?>','<?php echo $sformn; ?>','<?php echo $course_approve; ?>');" class="btn btn-info" ><i class="fa fa-check  <?php echo $course_approve == '0'? 'fa fa-check' : 'fa fa-remove'; ?>"></i>&nbsp;<?php echo $course_approve == '0'? 'Approve' : 'Decline'; ?></a>
  <?php } ?>
  <button class="button button1" onclick="window.open('Result_am.php?view=rbs','_self')" type="button">Close</button><button class="button button1" type="button" onClick="myFunction()">Print</button></centre></b>
  </div></td>
  <td width=376 valign=center style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt;color: green;text-align:center;'>
  <?php echo $pbcstatus;?>
  </td>
 </tr>
 </form>
</table>
</div>

</body>
</html>
<script type="text/javascript">
function Resultapproval(dep,sess,lev,sem,pro,fm,status)
{var st = status == '0' ? 'Approve' : 'Decline'
	if (confirm('Your About to ' + st+' this Result Sheet Make Sure All Information are Correct?')) {
window.location.href = 'process.php?action=status12&Schd='+ dep +'&sec='+ sess +'&lev='+ lev +'&sem='+ sem +'&pro='+ pro +'&rform='+ fm +'&nst=' + st;
}}
//function myFunction() { window.print();}
function myFunction() {document.all.ccc2.style.visibility = 'hidden';
window.print();
    document.all.ccc2.style.visibility = 'visible';}
        $(document).ready(function () { setTimeout(border,50);});
        function border() { $('#result-table td').css('border','solid');}
</script>
