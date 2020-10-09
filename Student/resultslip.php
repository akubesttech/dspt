  <?php
include("header1.php");
//include("dbconnection.php")
include('session.php'); 
  $existl = imgExists("../admin/".$row['Logo']);
  $saddress = $row['Address']; $state = $row['State'];$city = $row['City']; $Motto = $row['Motto'];
  $sessd = $_REQUEST['sec'];$lecd = $_REQUEST['lev']; $semd = $_REQUEST['sem'];
  //$checkreg_query = mysqli_query($condb,"select * from coursereg_tb where sregno='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' ")or die(mysqli_error($condb));
//$dform_checkexist20 = mysqli_num_rows($checkreg_query);
//if($dform_checkexist20 < 1){ message("No Course has been Registered for.".$default_session, "error");
//redirect('course_manage.php?view=S_CO'); }
//$rsprint = mysqli_fetch_array($sql_tranid1);
//$applcation_id = $rsprint['app_no'];
//$student_reg = $rsprint['stud_reg'];
 $qsql = mysqli_query($condb,"SELECT * FROM student_tb  WHERE  stud_id ='".safee($condb,$session_id)."' ")or die(mysqli_error($condb));
$rsprint = mysqli_fetch_array($qsql); $regen = $rsprint['RegNo'];
$sql_gradeset = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$student_prog)."' and grade_group ='01' Order by b_min ASC ")or die(mysqli_error($condb));
?>

<body style="background-color: rgb(59, 59, 59); padding: 5px; height: 800px;">
  <div class="row-fluid">
                        <!-- block -->
 <div class="block1"  >
  <div id= "print_content">
 <div class="navbar navbar-inner block-header">

<div class="muted pull-center"><i class="icon-plus-sign2 icon-large" >	
<img src=" <?php if ($existl > 0 ){ echo "../admin/".$row['Logo'];}else{ echo "css/images/logo.png";} ?>  " class="muted pull-left" style=" width:90px; height:60;"> <span style="color: #3277bc; font-size:26px;  font-family:vandana;text-shadow: 1px 1px gray; "><br><?php echo strtoupper($row['SchoolName']);  ?></span><br><span style="color: #e3132c; font-size:22px;  font-family:vandana;text-shadow: 1px 1px gray; "> <?php echo $Motto; //$saddress." ,".$city." ".$state." State ."; ?></span><?php //echo $Motto; ?> </i></div>
</div>
<div class="block-content2 collapse in"  >
                                <div class="span121" style="background-image: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7)), url('<?php if ($existl > 0 ){ echo "../admin/".$row['Logo'];
	}else{ echo "css/images/logo.png";} ?>'); background-repeat: no-repeat;background-position: center;  background-size: 550px 500px;display: inline; -webkit-print-color-adjust: exact; ">
								
								 <!--------------------form------------------->
								<form method="post" enctype="multipart/form-data">
					<div class="control-group">
                             <div class="controls">
                             
                                <table  align="center" style="margin:5px; font-size:15px;  font-weight:bold; width:900px;"  border="0">
    <style type="text/css" media="print"> @media print { a[href]:after {content: none !important;} }
.row1 {background-color: #EFEFEF;border: 1px solid #98C1D1;
		height: 30px;	font-family:Verdana, Geneva, sans-serif; font-size:12px; }
.row2 {background-color: #DEDEDE;border: 1px solid #98C1D1;height: 30px; font-family:Verdana, Geneva, sans-serif; 
	font-size:12px; }  @page {size: auto;margin: 0;}
					  </style>
	<tr style="background-color:#FFC">
            <td height="30" colspan="2"> <div class="rounded">
    <main class="container clear"> 
      <!-- main body --> 
      <!-- ################################################################################################ -->
      <?php if($semd == "Annual"){?>
     <center><font size="+2"><?php echo strtoupper($semd); ?>  STATEMENT OF RESULT <?php echo $sessd." SESSION" ;?></font></center>
     <?php }else{?>
      <center><font size="+2"><?php echo strtoupper($semd); ?> SEMESTER STATEMENT OF RESULT <?php echo $sessd." SESSION" ;?></font></center>
     <?php }?>
     <p></p><!--
     <p align="center"></p>
     <p align="left"> .</p>
      <p><?php echo $SGdept1; ?>:&nbsp;<?php echo getdeptc($rsprint['Department']);?></p> 
      <p>Level: <?php echo getlevel($student_level,$student_prog); ?></p> --!>
      <!-- ################################################################################################ --> 
      <!-- / main body -->
      <div class="clear"><hr></div>
    </main>
  </div></td>
     
          </tr>

<tr ><td style="position: absolute;font-size:13px;font-family:Verdana, Geneva, sans-serif;" colspan="1" height="32"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Matric Number: <?php echo  $regen; ?><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $SCategory; ?> :   <?php echo getfacultyc($rsprint['Faculty']) ; ?><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $SGdept1; ?>:&nbsp;<?php echo getdeptc($rsprint['Department']);?><br><br>&nbsp;&nbsp;&nbsp;&nbsp;
Level: <?php echo getlevel($lecd,$student_prog); ?></td>
            <td height="32" colspan="1"> <div class="rounded" align="center">
   <img id="admin_avatar" class="img-circle" src="<?php 
  // $sql = "SELECT * FROM new_apply1 left join olevel_tb ON olevel_tb.oPin = new_apply1.Pin WHERE md5(new_apply1.appNo)='$_GET[applyid]' or md5(new_apply1.JambNo)='$_GET[applyid]'";

		  $existn = imgExists($rsprint['images']);
		  		  if ($existn > 0 ){ echo $rsprint['images'];
	}else{ echo "uploads/NO-IMAGE-AVAILABLE.jpg";} ?>" width="180" height="130" style=" border-radius: 50%;" >
  </div></td><td style="margin-left: 30px;" colspan="1"></td>
     
          </tr>

<tr >
            <td height="32" colspan="2" style="font-size:19px;font-weight: bold;color: black; font-family:vandana;text-shadow: 1px 1px gray;"> <div class="rounded" align="center"><br><br>
  <?php echo strtoupper(getname($regen)); ?>
  </div></td>
     
          </tr>
<div class="rounded">
       
       <table border="1" style="margin:5px; font-size:15px;  font-weight:bold; width:900px;" >
       
        <thead>
      <!--  <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="9" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong> <strong> Courses Registered for First Semester <?php echo $default_session; ?> Academic Session .</strong></td>
        </tr>--!>
		 <tr><td height="36" colspan="9"></td> </tr>
                        <tr style="background-color: gray; color: white;font-family:Verdana, Geneva, sans-serif;font-size:12px;" >
                         
                         <th>S/N</th>
						 <th>Course Code</th>
                         <th>Course Title</th>
                          <th>Credit Unit</th>
                        <!--<th>Assessment(40%)</th>
                         <th>Exam(60%)</th> --!><?php if($resultview == "yes"){?>
                          <th>C A Score <?php //echo " ".getamax($student_prog)." %"; ?></th>
                          <th>Exam Score <?php //echo " ".getemax($student_prog)." %"; ?></th>
                         <th>Total</th><?php }?>
                         <th>Grade</th>
                         <th>Grade Point</th>
                        </tr>
                      </thead>
                      
                       <tbody>
                       
                 <?php if($semd == "Annual"){
$viewutme_query = mysqli_query($condb,"select * from results where student_id = '".safee($condb,$regen)."' and session ='".safee($condb,$sessd)."'  and level ='".safee($condb,$lecd)."'  order by semester ASC ")or die(mysqli_error($condb));}else{
$viewutme_query = mysqli_query($condb,"select * from results where student_id = '".safee($condb,$regen)."' and session ='".safee($condb,$sessd)."' and semester='".safee($condb,$semd)."' and level ='".safee($condb,$lecd)."'  order by session DESC ")or die(mysqli_error($condb));
}
$sessionGP = getcgpa($regen,$student_prog,$sessd,$lecd);
$getsecgpstatus = getAcagpstatus($sessionGP,$student_prog);

if(mysqli_num_rows($viewutme_query)<1){  if($semd == "Annual"){?>
<tr class='row2' style="background-color:#CFF;text-align:centre;"><td colspan='10' height="30" style='text-align:centre;'><strong>No result found in the database For This <?php echo $semd ." Result"  ; ?>. </strong></td></tr><?php }else{ ?>
<tr class='row2' style="background-color:#CFF;text-align:centre;"><td colspan='10' height="30" style='text-align:centre;'><strong>No result found in the database For This <?php echo $semd." Semester" ;   ?>. </strong></td></tr>   <?php }}
$serial=1; $i= 0;
while($row_utme = mysqli_fetch_array($viewutme_query)){
$escore = $row_utme['exam'];
if($resultview == "yes"){ $cell = 5; $cell2 = 4; }else{ $cell = 2; $cell2 = 1;}
$new_a_id = $row_utme['student_id'];
 $stprogram = getstudentpro($row_utme['student_id']);
if ($i%2) {$class = 'row1';} else {$class = 'row2';}
	$i += 1;

?> 

                        <tr class="<?php echo $class; ?>">
                        	<td  align='center'>
<?php echo $serial++; ?>
												</td>
						  <td><?php 
				
						echo "<font color='green'>$row_utme[course_code]</font>";
					
					 ?></td>
					 <td><?php echo getcourse($row_utme['course_code']); ?></td>
                          <td align='center'><?php echo $row_utme['c_unit']; ?></td>
                        <!--  <td><?php //echo $row_utme['semester']; ?></td>
                          <td><?php //echo getlevel($row_utme['level'],$student_prog); ?></td>
                         <td width="120">
<?php //echo $row_utme['session']; ?>	</td> --!>
<?php if(empty($escore)){ ?>
                            <td colspan="<?php echo $cell; ?>" style="text-align: center;font-size: medium;color: red;"> Absent </td>
                          <?php }else{?>
<?php if($resultview == "yes"){?>
<td style="text-align:center;"><?php echo $row_utme['assessment']; ?></td>
							<td style="text-align:center;"><?php echo $row_utme['exam']; ?></td>	
							<td style="text-align:center;"><?php echo $row_utme['total']; ?></td>	<?php }?>
							<td style="text-align:center;"><?php echo grading($row_utme['total'],$student_prog); ?></td>
							<td style="text-align:center;"><?php echo gradpoint($row_utme['total'],$student_prog); //* $row_utme['c_unit']; ?></td> 	</tr>
                    <?php }} ?>
                    <?php  if($semd == "Annual"){ $sumnet="select SUM(c_unit) from results where student_id ='".safee($condb,$regen)."' and session ='".safee($condb,$sessd)."' and level ='".safee($condb,$lecd)."' and exam > 0"; }else{ 
$sumnet="select SUM(c_unit) from results where student_id ='".safee($condb,$regen)."' and session ='".safee($condb,$sessd)."' and semester='".safee($condb,$semd)."' and level ='".safee($condb,$lecd)."' and exam > 0 ";
}
  $resultsumnet = mysqli_query($condb,$sumnet); 
  $num_rows2 =mysqli_num_rows($resultsumnet);
 while($get_infc = mysqli_fetch_row($resultsumnet))
 { foreach ($get_infc as $sumcredit)
								?>				
											
								<tfoot  >
    <tr class="text-offset">
      <td colspan="3"><strong>Total Credit Unit:</strong></td>
    <td style="text-align:center;" colspan="1"><strong> <?php if($sumcredit > 0){ echo $sumcredit;}else{echo "0";}} ?></strong></td>
    <td  colspan="<?php echo $cell2; ?>"><strong>Total Grade Points:</strong></td>
    <td style="text-align:center;" colspan="1"><strong><?php if($semd == "Annual"){ $resultgP = mysqli_query($condb,"select SUM(gpoint) as totalgpoint from results where student_id ='$regen' and session ='".safee($condb,$sessd)."' and level='".safee($condb,$lecd)."' and exam > 0");
    $resultQP = mysqli_query($condb,"select SUM(gpoint * c_unit) as totalqpoint from results where student_id ='$regen' and session ='".safee($condb,$sessd)."'  and level='".safee($condb,$lecd)."' and exam > 0");
   }else{ $resultgP = mysqli_query($condb,"select SUM(gpoint) as totalgpoint from results where student_id ='$regen' and session ='".safee($condb,$sessd)."' and semester='".safee($condb,$semd)."' and level='".safee($condb,$lecd)."' and exam > 0");
   $resultQP = mysqli_query($condb,"select SUM(gpoint * c_unit)as totalqpoint from results where student_id ='$regen' and session ='".safee($condb,$sessd)."' and semester='".safee($condb,$semd)."' and level='".safee($condb,$lecd)."' and exam > 0");
   } $num_rows2 =mysqli_num_rows($resultgP); $get_gp = mysqli_fetch_array($resultgP); $get_qp = mysqli_fetch_array($resultQP);  if($get_gp['totalgpoint'] > 0){ echo $get_gp['totalgpoint'];}else{echo "0";} 
   $sumqp = $get_qp['totalqpoint'];
   ?></strong></td>
    </tr>
    
    <tr><td colspan="11" >&nbsp;</td></tr>
    
     <tr >
                                
                                  <td colspan="4" ><strong>Sum of Credit Units:</strong></td>
                                  <td align='center'><?php if($sumcredit > 0){ echo $sumcredit;}else{echo "0";}?></td>
                                 
                                </tr>
                                <tr >
                                  <td colspan="4"><strong>Sum of Quality Points:</strong></td>
                                  <td align='center'><?php if($sumqp > 0){ if($sumqp == "1"){ echo $sumqp." "; }else{echo $sumqp." ";} }else{echo "0.00";} ?></td>
                                </tr>
                                <tr >
                                  <td colspan="4"><strong>CGPA:</strong></td>
                                  <td align='center'><?php $gpa =$sumqp/$sumcredit; if($gpa > 0){ echo round($gpa,2)." ";}else{echo "0.00 ";} ?></td>
                                </tr>
                                
                            <tr><td style="text-align:center;color:green;" colspan="11" >&nbsp; ACADEMIC STATUS : <?php echo getAcastatus($getsecgpstatus); ?></td></tr>    
                                
                                
    </tfoot  >
                </tbody></table>
  
 <table border='1' style='margin:4px; font-size:13px;  font-weight:bold; width:900px;'><tr class='row2' style="background-color:#CFF;text-align:centre;"><td colspan='10'><h4>Key to Grades:</h4></td></tr>
							 
                              <tr style='text-align:left;' >
							<td colspan='10'><h5>
						<?php	while($get_proc=mysqli_fetch_array($sql_gradeset)){ 
  $grade_name = $get_proc['grade']; $gstart = $get_proc['b_min'];	$gend = $get_proc['b_max']; $remark = $get_proc['gradename'];
echo $grade_name ."  &nbsp;( ". ($remark)."  ) = ".  $gstart."%". "-".   $gend."%"."  ,&nbsp;";
   }?></h5></td></tr></table>
  
   <table>
 <tr>
         <td colspan="4">&nbsp;</td>
       </tr>
        <tr >
         <td colspan="4">&nbsp;</td>
       </tr>
        <tr >
         <td colspan="4">&nbsp;</td>
       </tr>
         <tr >
         <td colspan="4">&nbsp;</td>
       </tr>
       <tr>
         <td colspan="4">&nbsp;</td>
       </tr>
        <tr>
         <td colspan="1">_________________________________&nbsp;&nbsp;</td>
         <td colspan="1">&nbsp;&nbsp; _________________________________&nbsp;&nbsp; </td>
         <td colspan="1"> _________________________________ </td>
       </tr>
       
       <tr style="font-size:8;text-align: center;">
         <td colspan="1"><strong>Student Signature and Date</strong></td>
         <td colspan="1"><strong>Course Advisor Signature and Date</strong> </td>
          <td colspan="1"><strong>HOD Signature and Date</strong> </td>
       </tr>
      
       <tr>
         <td colspan="4">&nbsp;</td>
       </tr>
       <!--
       <tr>
         <td colspan="4">_______________________________________&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;             _________________________________________</td>
       </tr>
       <tr>
         <td colspan="2"><strong>FORM TEACHER SIGNATURE </strong></td>
         <td colspan="4"><strong>DATE</strong></td>
       </tr>--!>
       <tr>
         <td colspan="4"><strong><font color="red"></font> </strong></td>
       </tr>
     
      <?php //}?>
</table>
      </div>

<br>
<tr><td colspan="2" align="left" height="40"><div id="ccc2">	

 <button data-placement="right" title="Click Here To Exit Page" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='result_manage.php?view=S_re';" type="reset"><i class="icon-signin icon-large"></i> Go Back </button>

  <button data-placement="right" title="Click to Print " id="reset2" name="B2" class="btn btn-info" onClick="myFunction()" type="reset"><i class="icon-file icon-large"></i> Print </button></div>	

												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#reset').tooltip('show');$('#reset2').tooltip('show');
	                                            $('#reset').tooltip('hide');$('#reset2').tooltip('hide');
	                                            });
	                                            </script>
	                                          

<script>
function myFunction() {document.all.ccc2.style.visibility = 'hidden';
window.print();
    document.all.ccc2.style.visibility = 'visible';
}
</script>
</td></tr>

</table>
                                
                                 </div>
                                 
                                 
                                  </div>
										
						
										<div class="control-group">
                                          <div class="controls">

                                          </div>
                                        </div>
                                </form>
								
								</div>
								
								
                            </div></div>
                        </div>
                        <!-- /block -->
                    </div>
                    </body>
                      </center>
                      <script>
					  
					  </script>