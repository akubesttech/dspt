  <?php
include("../Student/header1.php");
//include("dbconnection.php")
include('session.php'); 
$sec = $_GET["sec"]; $depm = $_GET["dep"]; $coursed = $_GET["cos"];$clevel = $_GET["lev"]; $sem =  $_GET["sem"];
  $existl = imgExists("../admin/".$row['Logo']);
  $saddress = $row['Address']; $state = $row['State'];$city = $row['City']; $smotto = $row['Motto'];
  //$checkreg_query = mysqli_query($condb,"select * from coursereg_tb where sregno='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' ")or die(mysqli_error($condb));
//$dform_checkexist20 = mysqli_num_rows($checkreg_query);
//if($dform_checkexist20 < 1){ message("No Course has been Registered for.".$default_session, "error");
//redirect('course_manage.php?view=S_CO'); }
//$rsprint = mysqli_fetch_array($sql_tranid1);
//$applcation_id = $rsprint['app_no'];
//$student_reg = $rsprint['stud_reg'];
 $qsql = mysqli_query($condb,"SELECT * FROM student_tb  WHERE  stud_id ='".safee($condb,$session_id)."' ")or die(mysqli_error($condb));
$rsprint = mysqli_fetch_array($qsql); $regen = $rsprint['RegNo'];
$getfirst_query2 = mysqli_query($condb,"select ctb.c_code,ctb.semester,ctb.c_unit,ctb.lect_approve,ctb.creg_id,ctb.course_id,cn.c_cat,cn.C_title,ctb.sregno from coursereg_tb ctb LEFT JOIN courses cn ON ctb.course_id = cn.C_id where  ctb.dept = '".safee($condb,$depm)."' and ctb.c_code='".safee($condb,$coursed)."' and session ='".safee($condb,$sec)."' and ctb.semester='".safee($condb,$sem)."' and ctb.creg_status='1' ORDER BY C_code,C_title  DESC ")or die(mysqli_error($condb));
$getfirst_query = mysqli_query($condb,"select ctb.c_code,ctb.semester,ctb.c_unit,ctb.lect_approve,ctb.creg_id,ctb.course_id,cn.c_cat,cn.C_title,ctb.sregno from coursereg_tb ctb LEFT JOIN courses cn ON ctb.course_id = cn.C_id where  ctb.dept = '".safee($condb,$depm)."' and ctb.c_code='".safee($condb,$coursed)."' and session ='".safee($condb,$sec)."' and ctb.semester='".safee($condb,$sem)."' and ctb.creg_status='1' ORDER BY C_code,C_title  DESC ")or die(mysqli_error($condb));
$rsprintd  = mysqli_fetch_array($getfirst_query2); $coursstatus = $rsprintd['c_cat'];
if($coursstatus > 0){  $courses_status = "Compulsory";}else{  $courses_status = "Elective";}
?>

<body style="background-color: rgb(59, 59, 59); padding: 5px; height: 800px;"  >
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
	}else{ echo "css/images/logo.png";} ?>'); background-repeat: no-repeat;background-position: center;  background-size: 550px 500px;display: inline; -webkit-print-color-adjust: exact; ">
								
								 <!--------------------form------------------->
								<form method="post" enctype="multipart/form-data">
					<div class="control-group">
                             <div class="controls">
                             
                                <table  align="center" style="margin:5px; font-size:15px;  font-weight:bold; width:900px;"  border="0">
    <style type="text/css" media="print"> @media print { a[href]:after {content: url('<?php if ($existl > 0 ){ echo "../admin/".$row['Logo'];
	}else{ echo "css/images/logo.png";} ?>') !important;} }
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
     <center><font size="+2">MARK AND ATTENDANCE SHEET</font></center>
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


<div class="rounded">
<table border="1" style="font-size:15px;  font-weight:bold; width:900px;border-spacing: 5px; border-collapse: separate;" >
       <tr style="font-size:13px;font-family:Verdana, Geneva, sans-serif;"><td height="36" colspan="3"><?php echo $SGdept1; ?>:&nbsp;<?php echo getdeptc($depm);?></td><td height="36" colspan="3">SEMESTER :<?php echo " ".$sem; ?> </td><td height="36" colspan="3">SESSION :<?php echo " ".$sec; ?> </td> </tr>
        <tr style="font-size:13px;font-family:Verdana, Geneva, sans-serif;"><td height="36" colspan="3">LEVEL : <?php echo " ".getlevel($clevel,$class_ID); ?> </td><td height="36" colspan="3">COURSE STATUS: <?php echo " ".$courses_status; ?> </td><td height="36" colspan="3">COURSE CODE :<?php echo " ".$coursed; ?> </td> </tr>
        <tr style="font-size:13px;font-family:Verdana, Geneva, sans-serif;">
          <td height="36" colspan="9" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;text-align:center"><strong>  <?php echo getcourse($coursed)." (".$coursed.")"; ?></strong></td>
        </tr>
       </table>
       <table border="1" style="margin:5px; font-size:15px;  font-weight:bold; width:900px;" >
       <thead>
        <tr><td height="36" colspan="9"></td> </tr>
                        <tr style="background-color: gray; color: white;font-family:Verdana, Geneva, sans-serif;font-size:12px;" >
                      
                         <th>S/N</th>
						 <th>MATRIC NO</th>
                         <th>NAME OF STUDENTS</th>
                          <th>SCRIPT NUMBER</th>
                        <th>SIGN</th>
                          <th>EXAM SCORE</th>
                         <th>C.A</th> 
                         <th>TOTAL </th>
                         <th>GRADE </th>
                        </tr>
                      </thead>
                       <tbody>
                      <?php
if($cont = mysqli_num_rows($getfirst_query)<1){
	  echo "<tr class='row2' style=\"background-color:#CFF;text-align:centre;\">
          <td colspan='9' height=\"30\"><strong>No Student has Registered this Course in First Semester.</strong></td></tr>";}
$serial=1;
$i = "0";
while($row_utme = mysqli_fetch_array($getfirst_query)){

if ($i%2) {$classo1 = 'row1';} else {$classo1 = 'row2';}$i += 1;
$new_a_id = $row_utme['stud_id'];
$viewreg_query = mysqli_query($condb,"select DISTINCT lect_approve  from coursereg_tb WHERE sregno = '".safee($condb,$regen)."' AND c_code = '".safee($condb,$row_utme['c_code'])."' and lect_approve = '1' ")or die(mysqli_error($condb));
?>     
                        <tr class="<?php echo $classo1; ?>">
                        	
					
														<td  align='center'>
<?php echo $serial++; ?>
												</td>
						  <td><?php echo $row_utme['sregno'] ;?></td>
					 <td><?php echo getsname($row_utme['sregno']); ?></td>
                          <td align='center'> </td>
                          <td></td>
                         <td><?php //echo getlevel($row_utme['level'],$student_prog); ?></td>
                         <td width="120">
<?php //echo $row_utme['session']; ?>	</td>
<td style="text-align:justify;"><?php echo $status; ?></td>
<td style="text-align:justify;"><?php echo $status; ?></td>
                        </tr>
                    <?php } ?>
 
                     </tbody>
      
       
    </table>

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
         <td colspan="1">&nbsp;&nbsp; _________________________________&nbsp;&nbsp; </td>
         <td colspan="1"> _________________________________ </td>
       </tr>
       
       <tr style="font-size:8;text-align: center;">
         <td colspan="1"><strong>Course Lecturer Name Signature and Date</strong></td>
         <td colspan="1"><strong>Int .Moderator Name Signature and Date</strong> </td>
          <td colspan="1"><strong>Ext .Moderator Name Signature and Date</strong> </td>
       </tr>
      
       <tr>
         <td colspan="4">&nbsp;</td>
       </tr>
       
        
    
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

 <button data-placement="right" title="Click Here To Exit Payment Receipt" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='Result_am.php?view=asheet';" type="reset"><i class="icon-signin icon-large"></i> Go Back </button>

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