<?php //session_start();
include('lib/dbcon.php'); 
dbcon(); 
include('session.php');
$dept = $_GET['Schd'];
$sems = $_GET['sem'];
$sess= $_GET['sec'];
$lev = $_GET['lev'];

 $cgsem = strlen($sems);
$query3 = mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));$rowdd = mysqli_fetch_array($query3);
$title20 = $rowdd['SchoolName'];$motto = $rowdd['Motto'];$logoback = $rowdd['Logo'];$exists = imgExists($logoback);
$saddress = $rowdd['Address']; $state = $rowdd['State'];$city = $rowdd['City'];
$queryrapp = "select * from resultapproval_tb WHERE prog = '".safee($condb,$class_ID)."' AND dept = '".safee($condb,$dept)."' AND session = '".safee($condb,$sess)."' AND level = '".safee($condb,$lev)."' AND apstatus = '1' ";
if($sems != null){ $queryrapp .= " AND semester='$sems'";}
$queryresultapp = mysqli_query($condb,$queryrapp)or die(mysqli_error($condb));
$rowapp = mysqli_fetch_array($queryresultapp); $aptatus = mysqli_num_rows($queryresultapp); 
 if($aptatus > 0){ $course_approve = 1; $bst = "Approved"; $pbcstatus= "Result Successfully Published for Student to access"; }else{ $course_approve = 0; $bst = "";$pbcstatus="Result Has not been Published for Student to access";} 
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
</style>

<header >
<div class="bgtext">
<div style="text-align: center"><span style='font-size:14.0pt;
font-family:"Times New Roman","serif"'><br><img width="100" height="70" id="Picture 1"
src="   <?php if ($exists > 0 ){ echo $logob =  $rowdd['Logo'];}else{ echo $logob = "uploads/NO-IMAGE-AVAILABLE.jpg";} ?>  "  ></span></div>
    <div style="text-align: center;font-size: 28px;"><?php echo $title20?></div>
    <div style="text-align: center"><b>School: </b><?php echo getfacultyc($_SESSION['bfac']); ?></div>
    <div style="text-align: center"><b>Department: </b><?php echo getdeptc($dept);?></div>
    <div style="text-align: center"><b>Examination: </b><?php echo ucwords(getlevel($lev,$class_ID)." ".$sems." Semester Result"); ?></div>
    <div style="text-align: center"><b>Programme: </b><?php echo getprog($class_ID)?></div>
    <div style="text-align: center"><b>Session: </b><?php echo $sess?></div>
</header>
<?php 
$con = new Database();

function fetch_course_result($c_code,$sess,$dept){
    $con = new Database();
    $r_q = "Select * from results WHERE course_code = '$c_code' AND session = '$sess' AND dept = '$dept'";
    $results = $con->getData($r_q);
    return $results;
}
function fetch_courses($dept,$sems= null,$lev){
    $con = new Database();
    $c_q ="Select distinct C_code,C_title,C_unit from courses WHERE dept_c ='$dept'  AND C_level = '$lev'";
    if($sems != null){
        $c_q .= " AND semester='$sems'";
    }
   
    $courses = $con->getData($c_q);
    return $courses;
}
function fetchGrade($cgpa,$class_ID){ $con = new Database();
    $q = "Select grade from grade_tb WHERE b_min <= '$cgpa' and b_max >= '$cgpa' AND grade_group  ='01' AND prog = '".safee($con,$class_ID)."'";
    $gclass = $con->getData($q); if(count($gclass) > 0){ return $gclass[0]['grade'];}
    return '';}

$first_sem_courses = fetch_courses($dept,$sems,$lev);//fetch_courses($dept,$sems);
    $first_sem_courses_res = array();
    foreach ($first_sem_courses as $course){
        $res = fetch_course_result($course['C_code'],$sess,$dept);
        $first_sem_courses_res[$course['C_code']] = $res;
    }
    
    
    $sql_minscore = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$class_ID)."' and grade_group ='01' Order by b_max ASC limit 1 ")or die(mysqli_error($condb)); $getmg = mysqli_fetch_array($sql_minscore); $getpass = $getmg['b_max'];

$gr_q = "Select distinct grade,gradename,gp,b_max,b_min from grade_tb WHERE grade_group = '01' and prog ='".safee($condb,$class_ID)."' Order by grade ASC ";
$st_q = "Select distinct student_id from results WHERE session= '$sess' AND dept ='$dept' AND level='".safee($condb,$lev)."'";
if($sems != null){ $st_q .= " AND semester='".safee($condb,$sems)."'"; }
    //if($lev != null){ $st_q .= " AND level='".safee($condb,$lev)."'"; } 
//$a_re = "Select * from results WHERE session= '$sess' AND dept ='$dept'";
//if($sems != null){ $a_re .= " AND semester='".safee($condb,$sems)."'"; } if($lev != null){ $a_re .= " AND level='".safee($condb,$lev)."'"; }  
//$crs_re = array();
//$all_result = $con->getData($a_re);
//$dept_name = $con->getSingleData($d_q)['d_name'];
//$courses = fetch_courses($dept,$sems,$lev);
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
<tr><th>Name</th><th>Matriculation Number</th> <?php if(count($first_sem_courses)>0){ $tu = 0;
foreach ($first_sem_courses as $course){ $tu += $course['C_unit']; ?> <th><?php echo $course['C_code']?></th> <?php }} echo $fn; ?>   </tr> 

<tr><td></td><td ></td>  <?php
            if(count($first_sem_courses)>0){
                foreach ($first_sem_courses as $course){
                    ?>
                    <td><?php echo $course['C_unit']?></td>
                    <?php
                }
            }
           echo $fn2; ?>  </tr>
              <?php
        if(count($students)> 0){
            foreach ($students as $student){
                 $s_id = $student['student_id'];
        $all_courses = "Select Distinct course_code,c_unit,qpoint,grade,session,semester,total,gpoint from results WHERE student_id = '$s_id' ORDER BY session";
        $st_all = $con->getData($all_courses);
                $stu = 0;
                $stp = 0;
                $tp  = 0;
                $stgp = 0;
                $pgp = 0;
                $ptp = 0;
                $prev_tu = 0;
                $prev_tp = 0;
                $prev_cgpa = 0;
                $fcgpa = 0;
                $cgpa = 0;
                $outstanding_c = '';
                ?>
<tr>  <td><?php echo getsname($student['student_id']);?></td>
                    <td><?php echo $student['student_id']?></td>
                    <?php
                    foreach ($first_sem_courses as $course){
                        $scr = 0;
                        ?>
                        <td>
                            <?php
                            if(array_key_exists($course['C_code'],$first_sem_courses_res)){
                                $res = $first_sem_courses_res[$course['C_code']];
                                if(count($res) >0){
                                    foreach ($res as $re){
                                        if($re['student_id'] == $student['student_id']){
                                            $scr = $re['total'];
                                            $stu += $re['c_unit'];
                                            $qp = $re['gpoint']*$re['c_unit'];
                                            $tp += $qp ;
                                            $stgp += $re['qpoint'];
                                            //if($re['grade'] != 'F'){
                                              if($re['total'] <= $getpass){
                                                $stp += 1;
                                            }
  
                                        }
                                    }
                                }
                            }
                            $nscore = $scr." ".fetchGrade($scr,$class_ID);
                            echo getscorest($s_id,$dept,$course['C_code'],$nscore);
                            ?>
                        </td>
                        <?php
                    }
                    $p_cu = 0;
        $tgp1 = 0;
        $scgp = 0;
        $p_gp = 0;
       $pmygpa = 0;
        $p_failed = '';
                        foreach ($st_all as $re){
           if($re['total'] <= $getpass){
           $outstanding_c .= $re['course_code'].',';
            }
            if($re['session'] == $sess && $re['semester'] != $sems){
          $p_cu += $re['c_unit'];
               $tgp2 = $re['gpoint']*$re['c_unit'];
                $p_gp += $tgp2;//$re['qpoint'];
                //if($re['grade'] == 'F'){
                    if($re['total'] <= $getpass){
                    $p_failed .= $re['course_code'].',';
                }
            }
        }
                  
                    if($cgsem <= 5){ 
                    ?> 
                   <td><?php echo $stu ?></td>
                    <td><?php echo $tp ?></td>
                    <td><?php
                        if($stu != 0){ echo $mygpa = round($tp/$stu,2); }else{ echo $mygpa = 0.00;}?></td>
                        <td><?php echo Resultremark($mygpa,$class_ID); ?></td>
                        <td> <?php if($mygpa < 2.00){ echo $stat = 'NIGS';}else{
                echo $stat = 'IGS';} ?> </td> <?php }else{ ?>
                
                 <td><?php echo $stu ?></td>
                    <td><?php echo $tp ?></td>
                    <td><?php
                        if($stu != 0){ echo $mygpa = round($tp/$stu,2); }else{ echo $mygpa = 0.00;}?></td>
                        <td><?php echo $p_cu; ?></td>
                         <td><?php echo $p_gp; ?></td>
                           <td><?php
                        if($p_cu != 0){ echo $pmygpa = round($p_gp/$p_cu,2); }else{ echo $p_cu;}?></td>
                 <td><?php $scgp = $mygpa + $pmygpa ; if($scgp != 0){ echo $cgpa = round($scgp / 2,2); }else{ echo $scgp;} ?></td>
                        <td><?php echo Resultremark($mygpa,$class_ID); ?></td>
                        <td> <?php echo Resultremark($pmygpa,$class_ID); ?> </td>
                <td> <?php if($cgpa < 2.00){ echo $stat = 'NIGS';}else{
                echo $stat = 'IGS';} ?> </td>
                <?php }?>
                </tr>
                    <?php } } ?>
</table>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-yfti-tbllook:1184;mso-padding-alt:
 0in 5.4pt 0in 5.4pt;mso-border-insideh:none;mso-border-insidev:none'>
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
  "Times New Roman","serif"'><?php echo strtoupper($mastersname."  SIGNATURE"); ?><o:p></o:p></span></p>
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
 </tr>
 
 
  <tr style='mso-yfti-irow:1;height:17.85pt'>
  <td width=376 valign=top style='width:281.8pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt;text-align:center;'><div id="ccc2"><b style='mso-bidi-font-weight:normal'><centre>

<?php  if (authorize($_SESSION["access3"]["rMan"]["rbs"]["edit"])){ ?> 
  <a rel="tooltip"  class="button button1" title="Click to approve Result" id="delete1" href="javascript:Resultapproval('<?php echo $dept; ?>','<?php echo $sess; ?>','<?php echo $lev; ?>','<?php echo $sems; ?>','<?php echo $class_ID; ?>','<?php echo $course_approve; ?>');" class="btn btn-info" ><i class="fa fa-check  <?php echo $course_approve == '0'? 'fa fa-check' : 'fa fa-remove'; ?>"></i>&nbsp;<?php echo $course_approve == '0'? 'Approve' : 'Decline'; ?></a>
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
function Resultapproval(dep,sess,lev,sem,pro,status)
{var st = status == '0' ? 'Approve' : 'Decline'
	if (confirm('Your About to ' + st+' this Result Sheet Make Sure All Information are Correct?')) {
window.location.href = 'process.php?action=status11&Schd='+ dep +'&sec='+ sess +'&lev='+ lev +'&sem='+ sem +'&pro='+ pro +'&nst=' + st;
}}
//function myFunction() { window.print();}
function myFunction() {document.all.ccc2.style.visibility = 'hidden';
window.print();
    document.all.ccc2.style.visibility = 'visible';}
        $(document).ready(function () { setTimeout(border,50);});
        function border() { $('#result-table td').css('border','solid');}
</script>
