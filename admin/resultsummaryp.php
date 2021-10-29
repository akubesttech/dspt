<?php
/**
 * Created by PhpStorm.
 * User: Habib
 * Date: 7/14/2019
 * Time: 8:16 PM   #result-table th, #result-table td {
border: solid;
}
 */
//include_once "header.php";
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
$bs_sem = isset($_GET['sem']) ? $_GET['sem'] : '';
//substr($warning_data2['session_name'],5,10);
 $lsec = substr($_GET['sec'],0,4) - 1;
 $lright = substr($_GET['sec'],5,8) - 1;
$lastsec = $lsec."/".$lright;
$sql_gradeset = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$class_ID)."' and grade_group ='01' Order by b_max ASC limit 1 ")or die(mysqli_error($condb)); $getmg = mysqli_fetch_array($sql_gradeset); $getpass = $getmg['b_max'];
?>
<link rel="stylesheet" href="../assets/css/base.css" type="text/css">
<script src="../assets/js/jquery.js"></script>
<style>
   main {
        margin-top: 50px;
    }
    .table-no-border{
        vertical-align: bottom;
        border-collapse: collapse;
        
    }
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
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
    }
    p {
        text-align: center;
        font-size: large;
    }
.container {
/*background-color: #d9ffd9;*/
/*background-image: url(<?php //echo $logob; ?>);*/
background-repeat: no-repeat;
background-position: center;
 background-size: 200px 200px;
 background-position: center center;
/*opacity: 0.5;
  filter: alpha(opacity=50); /* For IE8 and earlier */
   
}

</style>

<?php
$viewprintco = mysqli_query(Database::$conn,"SELECT DISTINCT student_id FROM  results  WHERE session='".safee($condb,$bs_sec)."' and level='".safee($condb,$bs_lev)."'  and dept ='".safee($condb,$bs_dept)."' ")or die(mysqli_error($condb));
	 $serial = 1 ;
?>
<center>

<main>
<div>
    <div class="container">
    <section id="result-table">

<div class="container-fluid">
    <div class="row">
      <!-- <div class="m-b-3"> 08146452134 --!>
        <div class="col-lg-12">
        <div class="col-lg-1">
            <img class="img-circle" src="<?php echo $logob; ?>" width="100" />
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-5">
            <p><strong><font size="4" color="blue" ><?php echo $title; ?></font></strong><br />
                <?php echo $motto ;//$saddress." .".$city." ".$state." State ."; ?></p>
            <p><strong>RESULT SUMMARY</strong></p>
        </div>
        <div class="col-lg-4">
            <table>
                <thead>
                <tr>
                    <th><?php echo $SGdept2; ?>: &nbsp;</th>
                    <th>&nbsp;<?php echo " ".getdeptc($bs_dept)." "; ?>&nbsp;</th>
                </tr>
                <tr>
                    <th>YEAR: </th>
                    <th>&nbsp;<?php echo " ".$bs_sec." "; ?>&nbsp;</th>
                </tr>
                 <tr>
                    <th>LEVEL: </th>
                    <th>&nbsp;<?php echo " ".getlevel($bs_lev,$class_ID)." "; ?>&nbsp;</th>
                </tr>
                </thead>
              <!--  <tbody><tr><td>YEAR:</td><td>Three</td></tr></tbody> --!>
            </table>
        </div>
        </div>
        </div>
        <hr>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <thead>
                <tr>
                    <th colspan="2" class="table-no-border" style="border:0;"></th>
                    <th colspan="4">SUMMARY OF <br />PREVIOUS<br /> SEMESTERS</th>
                    <th colspan="4">SUMMARY OF <br /> FIRST<br /> SEMESTER</th>
                    <th colspan="4">SUMMARY OF <br />SECOND <br />SEMESTER</th>
                    <th colspan="5">SUMMARY OF <br /> SESSION</th>
                    <th colspan="1" class="table-no-border" style="border:0;" ></th>
                </tr>
                </thead>
                <tbody>
                <tr class="test">
                    <td class="table-no-border"  ><h5><strong>MATRIC. NO.</strong></h5></td>
                    <td class="table-no-border"><h5><strong>NAMES (SURNAME FIRST)</strong></h5></td>
                    <td><h4>TOTAL UNITS TAKEN SO FAR</h4></td>
                    <td ><h4>TOTAL UNITS PASSED SO FAR</h4></td>
                    <td ><h4>CUMM. GRADE POINT</h4></td>
                    <td><h4>CUMM. GRADE POINT AVERAGE</h4></td>
                    <td><h4>TOTAL UNITS TAKEN</h4></td>
                    <td><h4>TOTAL UNITS PASSED</h4></td>
                    <td><h4>TOTAL GRADE POINTS</h4></td>
                    <td><h4> POINTS AVERAGE</h4></td>
                    <td><h4>TOTAL UNITS TAKEN</h4></td>
                    <td><h4>TOTAL UNITS PASSED</h4></td>
                    <td><h4>TOTAL GRADE POINTS</h4></td>
                    <td><h4>GRADE POINTS AVERAGE</h4></td>
                    <td><h4>TOTAL UNITS TAKEN</h4></td>
                    <td><h4>TOTAL UNITS PASSED</h4></td>
                    <td><h4>TOTAL UNITS FAILED</h4></td>
                    <td><h4>CUMM. GRADE POINT</h4></td>
                    <td><h4>CUMM. GRADE POINT AVERAGE</h4></td>
                    <td class="table-no-border"><h5><strong>OUTSTANDING COURSES</strong></h5></td>
                </tr>
                <?php $firstsem = "First"; $Secondsem = "Second"; //and course_code = '".safee($condb,$coursecode)."' 
					  while($row = mysqli_fetch_array($viewprintco)){
					  //summary first Semester
        $sregno = $row['student_id'];
					   $vregcourese1 = mysqli_query(Database::$conn,"SELECT SUM(c_unit) as cregu FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."'  and session='".safee($condb,$bs_sec)."' and dept ='".safee($condb,$bs_dept)."' and semester='".safee($condb,$firstsem)."'  Order by course_code ASC ")or die(mysqli_error($condb)); $creditreg1 = mysqli_fetch_array($vregcourese1);
					   
					   $vcousepass1 = mysqli_query(Database::$conn,"SELECT SUM(c_unit) as cregu FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."' and  session='".safee($condb,$bs_sec)."' and dept ='".safee($condb,$bs_dept)."' and total > '".safee($condb,$getpass)."' and semester='".safee($condb,$firstsem)."' Order by course_code ASC ")or die(mysqli_error($condb)); $creditpass1 = mysqli_fetch_array($vcousepass1);

$vcousegrade1 = mysqli_query(Database::$conn,"SELECT SUM(gpoint * c_unit) as totalgpoint FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."'  and session='".safee($condb,$bs_sec)."' and semester='".safee($condb,$firstsem)."' and dept ='".safee($condb,$bs_dept)."'  Order by course_code ASC ")or die(mysqli_error($condb)); $tgpoint1 = mysqli_fetch_array($vcousegrade1);

//summary second Semester
$vregcourese20 = mysqli_query(Database::$conn,"SELECT SUM(c_unit) as cregu FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."'  and session='".safee($condb,$bs_sec)."' and dept ='".safee($condb,$bs_dept)."' and semester='".safee($condb,$Secondsem)."'  Order by course_code ASC ")or die(mysqli_error($condb)); $creditreg20 = mysqli_fetch_array($vregcourese20);
					   
					   $vcousepass20 = mysqli_query(Database::$conn,"SELECT SUM(c_unit) as cregu FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."' and  session='".safee($condb,$bs_sec)."' and dept ='".safee($condb,$bs_dept)."' and total > '".safee($condb,$getpass)."' and semester='".safee($condb,$Secondsem)."' Order by course_code ASC ")or die(mysqli_error($condb)); $creditpass20 = mysqli_fetch_array($vcousepass20);

$vcousegrade20 = mysqli_query(Database::$conn,"SELECT SUM(gpoint * c_unit) as totalgpoint FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."'  and session='".safee($condb,$bs_sec)."' and semester='".safee($condb,$Secondsem)."' and dept ='".safee($condb,$bs_dept)."'  Order by course_code ASC ")or die(mysqli_error($condb)); $tgpoint20 = mysqli_fetch_array($vcousegrade20);

//summary previous Semesters
$vregcourese30 = mysqli_query(Database::$conn,"SELECT SUM(c_unit) as cregu FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."'  and session='".safee($condb,$lastsec)."' and dept ='".safee($condb,$bs_dept)."' Order by course_code ASC ")or die(mysqli_error($condb)); $creditreg30 = mysqli_fetch_array($vregcourese30);
					   
$vcousepass30 = mysqli_query(Database::$conn,"SELECT SUM(c_unit) as cregu FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."' and  session='".safee($condb,$lastsec)."' and dept ='".safee($condb,$bs_dept)."' and total > '".safee($condb,$getpass)."'  Order by course_code ASC ")or die(mysqli_error($condb)); $creditpass30 = mysqli_fetch_array($vcousepass30);

$vcousegrade30 = mysqli_query(Database::$conn,"SELECT SUM(gpoint * c_unit) as totalgpoint FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."'  and session='".safee($condb,$lastsec)."'  and dept ='".safee($condb,$bs_dept)."'  Order by course_code ASC ")or die(mysqli_error($condb)); $tgpoint30 = mysqli_fetch_array($vcousegrade30);

//result summary
					  $viewtcousefail2 = mysqli_query(Database::$conn,"SELECT course_code FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."' and  session='".safee($condb,$bs_sec)."' and dept ='".safee($condb,$bs_dept)."' and total <= '".safee($condb,$getpass)."' Order by course_code ASC ")or die(mysqli_error($condb)); $countfail = mysqli_num_rows($viewtcousefail2);
					   //$sregno = $row['student_id'];
					   $viewtregcourese = mysqli_query(Database::$conn,"SELECT SUM(c_unit) as cregu FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."'  and session='".safee($condb,$bs_sec)."' and dept ='".safee($condb,$bs_dept)."'  Order by course_code ASC ")or die(mysqli_error($condb)); $creditreg = mysqli_fetch_array($viewtregcourese);
					   $viewtcousepass = mysqli_query(Database::$conn,"SELECT SUM(c_unit) as cregu FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."' and  session='".safee($condb,$bs_sec)."' and dept ='".safee($condb,$bs_dept)."' and total > '".safee($condb,$getpass)."' Order by course_code ASC ")or die(mysqli_error($condb)); $creditpass = mysqli_fetch_array($viewtcousepass);
					   
$viewtcousefail = mysqli_query(Database::$conn,"SELECT SUM(c_unit) as cregu FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."' and  session='".safee($condb,$bs_sec)."' and dept ='".safee($condb,$bs_dept)."' and total <= '".safee($condb,$getpass)."' Order by course_code ASC ")or die(mysqli_error($condb)); $creditfail = mysqli_fetch_array($viewtcousefail);

$viewtcousegrade = mysqli_query(Database::$conn,"SELECT SUM(gpoint * c_unit) as totalgpoint FROM results  WHERE  student_id ='".safee($condb,$sregno)."' and level='".safee($condb,$bs_lev)."'  and session='".safee($condb,$bs_sec)."' and dept ='".safee($condb,$bs_dept)."'  Order by course_code ASC ")or die(mysqli_error($condb)); $tgpoint = mysqli_fetch_array($viewtcousegrade);
					    ?>
                <tr>
                    <td><?php echo $sregno; ?></td>
                    <td><?php echo getsname($sregno); ?></td>
                    <td><?php echo $creditreg30['cregu']; ?></td>
                    <td ><?php echo $creditpass30['cregu']; ?></td>
                    <td ><?php echo $tgpoint30['totalgpoint']; ?></td>
                  <?php if($tgpoint30['totalgpoint'] > 0){ $gpa30 = $tgpoint30['totalgpoint'] / $creditreg30['cregu'];}else{ $gpa30 = "0"; } ?>
                            <td><?php echo  round($gpa30,2); ?></td>
                    <td><?php echo $creditreg1['cregu']; ?></td>
                    <td><?php echo $creditpass1['cregu']; ?></td>
                    <td><?php echo $tgpoint1['totalgpoint']; ?></td>
                    <?php if($tgpoint1['totalgpoint'] > 0){ $gpa1 = $tgpoint30['totalgpoint'] / $creditreg1['cregu'];}else{ $gpa1 = "0"; } ?>
                            <td><?php echo  round($gpa1,2); ?></td>
                    <td><?php echo $creditreg20['cregu']; ?></td>
                    <td><?php echo $creditpass20['cregu']; ?></td>
                    <td><?php echo $tgpoint20['totalgpoint']; ?></td>
                    <?php if($tgpoint20['totalgpoint'] > 0){ $gpa20 = $tgpoint20['totalgpoint'] / $creditreg20['cregu'];}else{ $gpa20 = "0"; } ?>
                            <td><?php echo  round($gpa20,2); ?></td>
                    <td><?php echo $creditreg['cregu']; ?></td>
                    <td><?php echo $creditpass['cregu']; ?></td>
                    <td><?php echo $creditfail['cregu']; ?></td>
                    <td><?php echo $tgpoint['totalgpoint']; ?></td>
                   <?php if($tgpoint['totalgpoint'] > 0){ $gpa = $tgpoint['totalgpoint'] / $creditreg['cregu'];}else{ $gpa = "0"; } ?>
                            <td><?php echo  round($gpa,2); ?></td>
                      <td><?php while($get_failc = mysqli_fetch_array($viewtcousefail2)){ $coursefailed = $get_failc['course_code']; ?>
                            <?php echo $coursefailed." "; ?>
                           <?php }  ?>&nbsp;<?php if($countfail < 1 ){ ?>
                            <?php echo " - "; } ?>&nbsp;</td>
                </tr><?php } ?>
                </tbody>
               
            </table>
<table > <tr ><br>
				<td colspan="20" class="table-no-border" style="border:0;"> <div id="ccc2"> <button data-placement="right" title="Click to Print " id="reset" name="B2" class="btn btn-info" onClick="myFunction()" type="reset"><i class="icon-file icon-large"></i> Print </button>&nbsp;
<a href="javascript:void(0);" onclick="window.open('Result_am.php?view=ras','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-backward icon-large"></i> Close </a>
				</div></td>
				</tr></table>
        </div>
    </div>
</div>
<script>       function myFunction() {document.all.ccc2.style.visibility = 'hidden';
window.print();
    document.all.ccc2.style.visibility = 'visible';
}
        $(document).ready(function () {
            setTimeout(border,50);
        });
        function border() {
            $('#result-table td').css('border','solid');
        }
 
    </script>

    </section>
    </div>
</main>
</center>