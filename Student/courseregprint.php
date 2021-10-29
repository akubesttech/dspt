  <?php
include("header1.php");
//include("dbconnection.php")
include('session.php'); 
  $existl = imgExists("../admin/".$row['Logo']);
  $saddress = $row['Address']; $state = $row['State'];$city = $row['City']; $smotto = $row['Motto']; $smato = $row['smat'];
  //$checkreg_query = mysqli_query($condb,"select * from coursereg_tb where sregno='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' ")or die(mysqli_error($condb));
//$dform_checkexist20 = mysqli_num_rows($checkreg_query);
//if($dform_checkexist20 < 1){ message("No Course has been Registered for.".$default_session, "error");
//redirect('course_manage.php?view=S_CO'); }
//$rsprint = mysqli_fetch_array($sql_tranid1);
//$applcation_id = $rsprint['app_no'];
//$student_reg = $rsprint['stud_reg'];
 $qsql = mysqli_query($condb,"SELECT * FROM student_tb  WHERE  stud_id ='".safee($condb,$session_id)."' ")or die(mysqli_error($condb));
$rsprint = mysqli_fetch_array($qsql); $regen = $rsprint['RegNo']; $sshow = $rsprint['istatus'];  $semailo = $rsprint['e_address'];
?>

<body style=" padding: 5px; height: 800px;"  >
  <div class="row-fluid">
                        <!-- block -->
 <div class="block1"  >
  <div id= "print_content" >
 <div class="navbar navbar-inner block-header">

<div class="muted pull-center"><i class="icon-plus-sign2 icon-large" >	
                    <img src=" <?php 
					if ($existl > 0 ){ echo "../admin/".$row['Logo'];
	}else{ echo "css/images/logo.png";}
	// if ($row['Logo']==NULL or $row['Logo']=='uploads/' ){echo "css/images/logo.png";}else{echo "admin/".$row['Logo'];} ?>  " class="muted pull-left" style=" width:90px; height:60;"> <span style="color: #3277bc; font-size:26px;  font-family:vandana;text-shadow: 1px 1px gray; "><br><?php echo strtoupper($row['SchoolName']);  ?></span><br><span style="color: #e3132c; font-size:22px;  font-family:vandana;text-shadow: 1px 1px gray; "> <?php echo $smotto; //$saddress." ,".$city." ".$state." State ."; ?></span> </i></div>
</div>
<div class="block-content2 collapse in"  >
                                <div class="span121" style="background-image: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7)), url('<?php if ($existl > 0 ){ echo "../admin/".$row['Logo'];
	}else{ echo "css/images/logo.png";} ?>'); background-repeat: no-repeat;background-position: center;  background-size: 550px 500px;display: block; -webkit-print-color-adjust: exact; ">
								
								 <!--------------------form------------------->
								<form method="post" enctype="multipart/form-data">
					<div class="control-group">
                             <div class="controls">
                             
                                <table  align="center" style="margin:5px; font-size:15px;  font-weight:bold; width:900px;background-color: transparent;"  border="0">
    <style type="text/css" media="print"> @media print { a[href]:after  {content: url('<?php if ($existl > 0 ){ echo "../admin/".$row['Logo'];
	}else{ echo "css/images/logo.png";} ?>') !important; visibility: hidden; } }
.row1 {background-color: transparent;border: 1px solid #98C1D1;/* #EFEFEF */
		height: 30px;	font-family:Verdana, Geneva, sans-serif; font-size:12px; }
.row2 {background-color: transparent;border: 1px solid #98C1D1;height: 30px; font-family:Verdana, Geneva, sans-serif; /*#DEDEDE*/
	font-size:12px; } @page {margin: 0;size: portrait;}  /*@page {size: auto;margin: 0;}*/
					  </style>
	<tr style="background-color:#FFC">
            <td height="30" colspan="4"> <!-- <div class="rounded">
    <main class="container clear"> 
      main body --> 
      <!-- ################################################################################################ -->
     <center><font size="+2">COURSE REGISTRATION FORM</font></center>
     <p></p><!--
     <p align="center"></p>
     <p align="left"> .</p>
      <p><?php echo $SGdept1; ?>:&nbsp;<?php echo getdeptc($rsprint['Department']);?></p> 
      <p>Level: <?php echo getlevel($student_level,$student_prog); ?></p> --!>
      <!-- ################################################################################################ --> 
      <!-- / main body 
      <div class="clear"><hr></div>
    </main>
  </div>--></td>
     
          </tr>

<tr >
<td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;width: 355px;text-align: justify;" colspan="1" height="32">
<p><?php if(!empty($smato)){ if(empty($sshow)){ ?>Username: <?php echo $semailo; }else{ ?> Matric Number: <?php echo  $regen; } }else{ ?> Matric Number: <?php echo  $regen; } ?></p>
<p><?php echo $SCategory; ?> :   <?php echo getfacultyc($rsprint['Faculty']) ; ?></p>
<p><?php echo $SGdept1; ?>:&nbsp;<?php echo getdeptc($rsprint['Department']);?></p>
Level: <?php echo getlevel($student_level,$student_prog); ?></td>

            <td height="32" colspan="1" style="text-align: center;width: 190px;" >    
            <img  src="<?php 
  // $sql = "SELECT * FROM new_apply1 left join olevel_tb ON olevel_tb.oPin = new_apply1.Pin WHERE md5(new_apply1.appNo)='$_GET[applyid]' or md5(new_apply1.JambNo)='$_GET[applyid]'";

		  $existn = imgExists($rsprint['images']);
		  		  if ($existn > 0 ){ echo $rsprint['images'];
	}else{ echo "uploads/NO-IMAGE-AVAILABLE.jpg";} ?>" width="150" height="120" style=" border-radius: 50%;" >
  </td>
  <td colspan="1" style="margin-left: 30px;text-align: center;font-family:Verdana, Geneva, sans-serif;width: 355px;" ><?php echo strtoupper(getprog($student_prog)); ?></td>
     
          </tr>

<tr >
<td height="32" colspan="4" style="font-size:17px;font-weight: bold;color: blue; font-family:vandana;text-shadow: 1px 1px gray;text-align: center;">
  <?php echo strtoupper(getname($regen)); ?>
  </td>
     
          </tr>
<div class="rounded">
       
       <table border="1" style="margin:5px; font-size:15px;  font-weight:bold; width:900px;" >
       
        <thead>
        <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="9" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong> <strong> Courses Registered for First Semester <?php echo $default_session; ?> Academic Session .</strong></td>
        </tr> <tr><td height="36" colspan="9"></td> </tr>
                        <tr style="background-color: gray; color: white;font-family:Verdana, Geneva, sans-serif;font-size:12px;" >
                        <!-- <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>--!>
                         <th>S/N</th>
						 <th>Course Code</th>
                         <th>Course Title</th>
                          <th>Credit Unit</th>
                        <th>Status</th>
                         <!--   <th>Level</th>
                         <th>Session</th> --!>
                         <th>Course Lecturer Approve</th>
                         
                        </tr>
                      </thead>
                       <tbody>
                      <?php
                      $getfirst_query = mysqli_query($condb,"select ctb.c_code,ctb.semester,ctb.c_unit,ctb.lect_approve,ctb.creg_id,ctb.course_id,cn.c_cat,cn.C_title from coursereg_tb ctb LEFT JOIN courses cn ON ctb.course_id = cn.C_id where sregno='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' and ctb.semester='First'and creg_status='1' ORDER BY C_code,C_title  DESC ")or die(mysqli_error($condb));
                      //collega of education
                     /* $getfirst_query  = mysqli_query($condb,"select SUBSTRING(cn.C_code, 1,3) AS ccode,ctb.c_code,ctb.semester,ctb.c_unit,ctb.lect_approve,ctb.creg_id,ctb.course_id,cn.c_cat,cn.C_title from coursereg_tb ctb LEFT JOIN courses cn ON ctb.course_id = cn.C_id where sregno='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' and ctb.semester='First'and creg_status='1' ORDER BY FIELD(ccode, 'GSE', 'EDU') DESC, C_code, C_title ")or die(mysqli_error($condb)); */
                      						 if(mysqli_num_rows($getfirst_query)<1){
	  echo "<tr class='row2' style=\"background-color:#CFF;text-align:centre;\">
          <td colspan='9' height=\"30\"><strong>No Course has been Registered in this First Semester.</strong></td></tr>";
 }
$serial=1;
$i = "0";
while($row_utme = mysqli_fetch_array($getfirst_query)){
$coursstatus = $row_utme['c_cat']; if($coursstatus > 0){  $cstat = "Compulsory";}else{  $cstat = "Elective";}
if ($i%2) {$classo1 = 'row1';} else {$classo1 = 'row2';}$i += 1;
//$new_a_id = $row_utme['stud_id'];
$viewreg_query = mysqli_query($condb,"select DISTINCT lect_approve  from coursereg_tb WHERE sregno = '".safee($condb,$regen)."' AND c_code = '".safee($condb,$row_utme['c_code'])."' and lect_approve = '1' ")or die(mysqli_error($condb));
?>     
                        <tr class="<?php echo $classo1; ?>">
                        	<?php if(mysqli_num_rows($viewreg_query)>0){
							$status = 'Approved';
							 ?>
						<!--	<td width="30" align="center">
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" disabled CHECKED="CHECKED" value="<?php echo $row_utme['creg_id']; ?>"> 
                        
													</td> --!> <?php }else{
													$status = 'Not Approved';
													 ?>
													<!--		<td width="30" align="center">
           <input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox"  value="<?php echo $row_utme['creg_id']; ?>">
													</td> --!>
													<?php } ?>
														<td  align='center'>
<?php echo $serial++; ?>
												</td>
						  <td><?php 
					
						echo "<font color='green'>$row_utme[c_code]</font>";
					 ?></td>
					 <td><?php echo getcourseid($row_utme['course_id']); ?></td>
                          <td align='center'><?php echo $row_utme['c_unit']; ?></td>
                          <td><?php echo $cstat; ?></td>
                          <!--<td><?php //echo getlevel($row_utme['level'],$student_prog); ?></td>
                         <td width="120">
<?php //echo $row_utme['session']; ?>	</td> --!>
<td style="text-align:justify;"><?php echo $status; ?></td>

                        </tr>
                    <?php } ?>
                    
								<?php 
$sumnet="select SUM(c_unit) from coursereg_tb where sregno='".safee($condb,$regen)."' and session ='".safee($condb,$default_session)."' and semester='First'";
  $resultsumnet = mysqli_query($condb,$sumnet); 
  $num_rows2 =mysqli_num_rows($resultsumnet);
 
 while($get_infc = mysqli_fetch_row($resultsumnet))
 {
	  foreach ($get_infc as $sumcredit)
								?>				
											
								<tfoot>
    <tr class="text-offset">
      <td colspan="3"><strong>Total Credit Unit:</strong></td>
  <!--  <td align='center'></td><td align='center'></td> --!><td align='center'><strong> <?php if($sumcredit > 0){ echo $sumcredit;}else{echo "0";} ?></strong></td>
    </tr>
   </tfoot> 	<?php } ?>
                     </tbody>
      
       
    </table>
    
    
    <table border="1" style="margin:5px; font-size:15px;  font-weight:bold; width:900px;" >
       
        <thead>
        <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="9" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong> Courses Registered for Second Semester <?php echo $default_session; ?> Academic Session .</strong></td>
        </tr> <tr><td height="36" colspan="9"></td> </tr>
                        <tr style="background-color: gray; color: white;font-family:Verdana, Geneva, sans-serif;font-size:12px;" >
                        <!-- <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>--!>
                         <th>S/N</th>
						 <th>Course Code</th>
                         <th>Course Title</th>
                          <th>Credit Unit</th>
                        <th>Status</th>
                          <!--  <th>Level</th>
                         <th>Session</th> --!>
                         <th>Course Lecturer Approve</th>
                         
                        </tr>
                      </thead>
                       <tbody>
                      <?php
                    $viewutme_query2  = mysqli_query($condb,"select ctb.c_code,ctb.semester,ctb.c_unit,ctb.lect_approve,ctb.creg_id,ctb.course_id,cn.c_cat,cn.C_title from coursereg_tb ctb LEFT JOIN courses cn ON ctb.course_id = cn.C_id where sregno='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' and ctb.semester='Second'and creg_status='1' ORDER BY C_code,C_title  DESC ")or die(mysqli_error($condb));
//college of education
/* $viewutme_query2 = mysqli_query($condb,"select SUBSTRING(cn.C_code, 1,3) AS ccode,ctb.c_code,ctb.semester,ctb.c_unit,ctb.lect_approve,ctb.creg_id,ctb.course_id,cn.c_cat,cn.C_title from coursereg_tb ctb LEFT JOIN courses cn ON ctb.course_id = cn.C_id where sregno='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' and ctb.semester='Second'and creg_status='1' ORDER BY FIELD(ccode, 'GSE', 'EDU') DESC, C_code, C_title ")or die(mysqli_error($condb)); */
                      						 if(mysqli_num_rows($viewutme_query2)<1){
	  echo "<tr class='row2' style=\"background-color:#CFF;text-align:centre;\">
          <td colspan='9' height=\"30\"><strong>No Course has been Registered in this Second Semester.</strong></td></tr>";
 }
$serial=1;
$i = "0";
while($row_utme = mysqli_fetch_array($viewutme_query2)){
if ($i%2) {$classo = 'row1';} else {$classo = 'row2';}$i += 1;
$coursstatus2 = $row_utme['c_cat']; if($coursstatus2 > 0){  $cstat = "Compulsory";}else{  $cstat = "Elective";}
//$new_a_id = $row_utme['stud_id'];
$viewreg_query = mysqli_query($condb,"select DISTINCT lect_approve  from coursereg_tb WHERE sregno = '".safee($condb,$regen)."' AND c_code = '".safee($condb,$row_utme['c_code'])."' and lect_approve = '1' ")or die(mysqli_error($condb));
?>     
                        <tr class="<?php echo $classo1; ?>">
                        	<?php if(mysqli_num_rows($viewreg_query)>0){
							$status = 'Approved';
							 ?>
						<!--	<td width="30" align="center">
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" disabled CHECKED="CHECKED" value="<?php echo $row_utme['creg_id']; ?>">  </td> --!> <?php }else{
													$status = 'Not Approved';
													 ?>
													<!--	<td width="30"align="center">
           	<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox"  value="<?php echo $row_utme['creg_id']; ?>">
													</td> --!>
													<?php } ?>
														<td  align='center'>
<?php echo $serial++; ?>
												</td>
						  <td><?php 
					
						echo "<font color='green'>$row_utme[c_code]</font>";
					 ?></td>
					 <td><?php echo getcourseid($row_utme['course_id']); ?></td>
                          <td align='center'><?php echo $row_utme['c_unit']; ?></td>
                         <td><?php echo $cstat; ?></td>
                          <!-- <td><?php //echo getlevel($row_utme['level'],$student_prog); ?></td>
                         <td width="120">
<?php //echo $row_utme['session']; ?>	</td> --!>
<td style="text-align:justify;"><?php echo $status; ?></td>
									 		
											
												
												
										
                        </tr>
                    <?php } ?>
                     
	<?php 
$sumnet2="select SUM(c_unit) from coursereg_tb where sregno='".safee($condb,$regen)."' and session ='".safee($condb,$default_session)."' and semester='Second'";
  $resultsumnet2 = mysqli_query($condb,$sumnet2); 
  $num_rows2 =mysqli_num_rows($resultsumnet2);
 
 while($get_infc = mysqli_fetch_row($resultsumnet2))
 {
	  foreach ($get_infc as $sumcredit2)
								?>				
											
								<tfoot>
    <tr class="text-offset">
      <td colspan="3"><strong>Total Credit Unit:</strong></td>
   <!-- <td align='center'></td><td align='center'></td>--!> <td align='center'><strong><?php if($sumcredit2 > 0){ echo $sumcredit2;}else{echo "0";} ?></strong></td>
    </tr>
   </tfoot> 	<?php } ?>
                     </tbody>
      
       
    </table>
     <?php
                    $grand = $sumcredit2 + $sumcredit;
 echo "<table border='1' style='margin:5px; font-size:15px;  font-weight:bold; width:900px;'><tr class='row2' style=\"background-color:#CFF;text-align:centre;\"><td colspan='9' height=\"30\"><strong>The Grand total of course units for both semesters is $grand. Credit Unit</strong></td>";
 print "</table>\n"; ?>
   <table>
 <tr >
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
         <tr >
         <td colspan="4">&nbsp;</td>
       </tr>
       <tr>
         <td colspan="1">_________________________________&nbsp;&nbsp;</td>
         <td colspan="1">&nbsp;&nbsp;<!-- _________________________________--!>&nbsp;&nbsp; </td>
         <td colspan="1"> _________________________________ </td>
       </tr>
       
       <tr style="font-size:8;text-align: center;">
         <td colspan="1"><strong>Student's Signature and Date</strong></td>
         <td colspan="1"><strong><!--Course Advisor Signature and Date--!></strong> </td>
          <td colspan="1"><strong><!--HOD Signature and Date --!>Course Advisor Signature and Date</strong> </td>
       </tr>
      
       <tr>
         <td colspan="4">&nbsp;</td>
       </tr>
       
    <!--    <tr>
         <td colspan="1">&nbsp;&nbsp;</td>
         <td colspan="1">&nbsp;&nbsp; _________________________________&nbsp;&nbsp; </td>
         <td colspan="1"> </td>
       </tr>
       
       <tr style="font-size:8;text-align: center;">
         <td colspan="1"><strong></strong></td>
         <td colspan="1"><strong>Dean of Studies Signature and Date</strong> </td>
          <td colspan="1"><strong></strong> </td>
       </tr> --!>
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
<?php

?>
<br>
<tr><td colspan="2" align="left" height="40"><div id="ccc2">	

 <button data-placement="right" title="Click Here To Exit Payment Receipt" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='course_manage.php?view=r_co';" type="reset"><i class="icon-signin icon-large"></i> Go Back </button>

  <button data-placement="right" title="Click to Print " id="reset" name="B2" class="btn btn-info" onClick="myFunction()" type="reset"><i class="icon-file icon-large"></i> Print </button></div>	

												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#reset').tooltip('show');
	                                            $('#reset').tooltip('hide');
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