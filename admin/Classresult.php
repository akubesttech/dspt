  <?php
include("../Student/header1.php");
//include("dbconnection.php")
include('session.php'); 
  $existl = imgExists("../admin/".$row['Logo']);
  $saddress = $row['Address']; $state = $row['State'];$city = $row['City']; $Motto = $row['Motto'];
 $resultview = showfullresult ;
 
$queryallot = mysqli_query($condb,"select * from course_allottb where a_lotid ='". safee($condb,$_GET['userId']) ."'  ");
$row_an = mysqli_fetch_assoc($queryallot); $ccode = $row_an['course'];  $lecd = $row_an['level']; $sessd = $row_an['session'];
$semd = $row_an['semester']; $depart =  $row_an['dept']; $lecs =  $row_an['assigned'];  $prog =  $row_an['prog'];
$sql_gradeset = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$prog)."' and grade_group ='01' Order by b_min ASC ")or die(mysqli_error($condb));
$queryrapp = "select * from resultapproval_tb WHERE prog = '".safee($condb,$prog)."' AND dept = '".safee($condb,$depart)."' AND session = '".safee($condb,$sessd)."' AND level = '".safee($condb,$lecd)."' AND apstatus = '1' ";
if($semd != null){ $queryrapp .= " AND semester='$semd'";}
$queryresultapp = mysqli_query($condb,$queryrapp)or die(mysqli_error($condb));
$rowapp = mysqli_fetch_array($queryresultapp); $aptatus = mysqli_num_rows($queryresultapp); 
 if($aptatus > 0){  $col = "green"; $pbcstatus= "Result Successfully Published for Student to access"; }else{ $col = "red";$pbcstatus="Result Has not been Published for Student to access";} 

?>
<?php if($Rorder == "10"){ $gback = "Course_m.php?view=clist&userId=".$_GET['userId']; }else{ $gback = "allot_Courses.php?view=clist&userId=".$_GET['userId'];} ?>
<body style="padding: 5px; height: 800px;">
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
	}else{ echo "css/images/logo.png";} ?>'); background-repeat: no-repeat;background-position: center;  background-size: 550px 500px;display: block; -webkit-print-color-adjust: exact; ">
								
								 <!--------------------form------------------->
								<form method="post" enctype="multipart/form-data">
					<div class="control-group">
                             <div class="controls">
                             
 <table  align="center" style="margin:5px; font-size:15px;  font-weight:bold; width:900px; background-color: transparent;" class="tble2"  border="0">
    <style type="text/css" media="print"> @media print { a[href]:after {content: none !important;} }
.row1 {background-color: #EFEFEF;border: 1px solid #98C1D1;
		height: 30px;	font-family:Verdana, Geneva, sans-serif; font-size:12px; }
.row2 {background-color: #DEDEDE;border: 1px solid #98C1D1;height: 30px; font-family:Verdana, Geneva, sans-serif; 
	font-size:12px; }  @page {size: auto;margin: 0;}
					  </style>
	<tr style="background-color:#FFC">
            <td height="30" colspan="4"> 
  <center><font size="+2">  SEMESTER RESULTS   </font></center>
   </td></tr>

<tr  style="display: none;"><td style="position: absolute;font-size:13px;font-family:Verdana, Geneva, sans-serif;" colspan="1" height="32"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Matric Number: <?php //echo  $regen; ?><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $SCategory; ?> :   <?php //echo getfacultyc($rsprint['Faculty']) ; ?><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $SGdept1; ?>:&nbsp;<?php echo getdeptc($depart);?><br><br>&nbsp;&nbsp;&nbsp;&nbsp;
Level: <?php echo getlevel($lecd,$prog); ?></td>
            <td height="32" colspan="1"> <div class="rounded" align="center">
   <img id="admin_avatar" class="img-circle" src="<?php 
  // $sql = "SELECT * FROM new_apply1 left join olevel_tb ON olevel_tb.oPin = new_apply1.Pin WHERE md5(new_apply1.appNo)='$_GET[applyid]' or md5(new_apply1.JambNo)='$_GET[applyid]'";

		  $existn = imgExists($rsprint['images']);
		  		  if ($existn > 0 ){ echo $rsprint['images'];
	}else{ echo "uploads/NO-IMAGE-AVAILABLE.jpg";} ?>" width="180" height="130" style=" border-radius: 50%;" >
  </div></td><td style="margin-left: 30px;" colspan="1"></td>
     
          </tr>
          
          <tr ><td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;width: 355px;text-align: justify;" colspan="1" height="30">
<p><?php echo $SGdept1; ?>:&nbsp; <?php echo getdeptc($depart); ?></p>
<p style="color: black;">Session :&nbsp; <?php echo $sessd; ?></p>
<p style="color:black;">Semester :&nbsp; <?php echo $semd; ?></p>
</td>
            <td height="30" colspan="1" style="text-align: center;width: 190px;">
   
  </td><td height="30"  colspan="1" style="text-align: center;font-family:Verdana, Geneva, sans-serif;355px;">
  <?php echo strtoupper(getprog($prog)); ?><p style="font-size:15px;font-weight: bold;color: black; font-family:Verdana;"><font color="black"><?php echo  getlevel($lecd,$prog); ?></font></p></td>
     
          </tr>

<tr style="display: none;" >
            <td height="32" colspan="2" style="font-size:19px;font-weight: bold;color: black; font-family:vandana;text-shadow: 1px 1px gray;"> <div class="rounded" align="center"><br><br>
  <?php //echo strtoupper(getname($regen)); ?>
  </div></td>
     
          </tr>
<div class="rounded">
       
       <table border="1" style="margin:5px; font-size:15px;  font-weight:bold; width:900px;background-color: transparent;" >
       
        <thead>
      <!--  <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="9" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong> <strong> Courses Registered for First Semester <?php echo $default_session; ?> Academic Session .</strong></td>
        </tr>--!>
		 <tr><td height="36" colspan="9" style="font-size:19px;font-weight: bold;color: black; font-family:vandana;text-shadow: 1px 1px gray;text-align: center;"> <?php echo strtoupper(getcourse($ccode))." ( ".$ccode." ) "; ?> </td> </tr>
                        <tr style="background-color: gray; color: white;font-family:Verdana, Geneva, sans-serif;font-size:12px;" >
                         
                         <th>S/N</th>
						 <th>Mat No</th>
                         <th>Student Name</th>
                          <th>Credit Unit</th>
                        <!--<th>Assessment(40%)</th>
                         <th>Exam(60%)</th> --!><?php if($resultview == "yes"){?>
                          <th>C A Score <?php //echo " ".getamax($student_prog)." %"; ?></th>
                          <th>Exam Score <?php //echo " ".getemax($student_prog)." %"; ?></th><?php }?>
                         <th>Total</th>
                         <th>Grade</th>
                         <th>Grade Point</th>
                        </tr>
                      </thead>
                      
                       <tbody>
                       
                 <?php 
$viewutme_query = mysqli_query($condb,"select * from results where  course_code ='". safee($condb,$ccode) ."' and dept ='".safee($condb,$depart)."' and session ='".safee($condb,$sessd)."' and semester='".safee($condb,$semd)."' and level ='".safee($condb,$lecd)."'  order by session DESC ")or die(mysqli_error($condb));

//$sessionGP = getcgpa($regen,$student_prog,$sessd,$lecd);
//$getsecgpstatus = getAcagpstatus($sessionGP,$student_prog);

if(mysqli_num_rows($viewutme_query)<1){  ?>
<tr class='row2' style="background-color:#CFF;text-align:centre;"><td colspan='10' height="30" style='text-align:centre;'><strong>No result found in the database For This <?php echo $semd." Semester" ;   ?>. </strong></td></tr>   <?php }
$serial=1; $i= 0;
while($row_utme = mysqli_fetch_array($viewutme_query)){
$escore = $row_utme['exam'];
if($resultview == "yes"){ $cell = 5; $cell2 = 4; }else{ $cell = 3; $cell2 = 2;}
$matno = $row_utme['student_id'];
 $stprogram = getstudentpro($row_utme['student_id']);
if ($i%2) {$class = 'row1';} else {$class = 'row2';}
	$i += 1;

?> 

                        <tr class="<?php echo $class; ?>">
                        	<td  align='center'><?php echo $serial++; ?>	</td>
<td><?php echo  $matno ;  ?></td>
					 <td><?php echo strtoupper(getname($matno));?></td>
                          <td align='center'><?php echo $row_utme['c_unit']; ?></td>
                        
<?php if(empty($escore)){ ?>
                            <td colspan="<?php echo $cell; ?>" style="text-align: center;font-size: medium;color: red;"> Absent </td>
                          <?php }else{?>
<?php if($resultview == "yes"){?>
<td style="text-align:center;"><?php echo $row_utme['assessment']; ?></td>
							<td style="text-align:center;"><?php echo $row_utme['exam']; ?></td><?php }?>	
							<td style="text-align:center;"><?php echo $row_utme['total']; ?></td>	
							<td style="text-align:center;"><?php echo grading($row_utme['total'],$stprogram); ?></td>
							<td style="text-align:center;"><?php echo gradpoint($row_utme['total'],$stprogram); //* $row_utme['c_unit']; ?></td> 	</tr>
                    <?php }} ?>
                    <?php  if($semd == "Annual"){ $sumnet="select SUM(c_unit) from results where  course_code ='". safee($condb,$ccode) ."' and dept ='".safee($condb,$depart)."' and session ='".safee($condb,$sessd)."' and level ='".safee($condb,$lecd)."' and exam > 0"; }else{ 
$sumnet="select SUM(c_unit) from results where course_code ='". safee($condb,$ccode) ."' and dept ='".safee($condb,$depart)."' and session ='".safee($condb,$sessd)."' and semester='".safee($condb,$semd)."' and level ='".safee($condb,$lecd)."' and exam > 0 ";
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
    <td style="text-align:center;" colspan="1"><strong><?php if($semd == "Annual"){ $resultgP = mysqli_query($condb,"select SUM(gpoint) as totalgpoint from results where course_code ='". safee($condb,$ccode) ."' and dept ='$depart' and session ='".safee($condb,$sessd)."' and level='".safee($condb,$lecd)."' and exam > 0");
    $resultQP = mysqli_query($condb,"select SUM(gpoint * c_unit) as totalqpoint from results where course_code ='". safee($condb,$ccode) ."' and dept ='$depart' and session ='".safee($condb,$sessd)."'  and level='".safee($condb,$lecd)."' and exam > 0");
   }else{ $resultgP = mysqli_query($condb,"select SUM(gpoint) as totalgpoint from results where course_code ='". safee($condb,$ccode) ."' and dept ='$depart' and session ='".safee($condb,$sessd)."' and semester='".safee($condb,$semd)."' and level='".safee($condb,$lecd)."' and exam > 0");
   $resultQP = mysqli_query($condb,"select SUM(gpoint * c_unit)as totalqpoint from results where course_code ='". safee($condb,$ccode) ."' and dept ='$depart' and session ='".safee($condb,$sessd)."' and semester='".safee($condb,$semd)."' and level='".safee($condb,$lecd)."' and exam > 0");
   } $num_rows2 =mysqli_num_rows($resultgP); $get_gp = mysqli_fetch_array($resultgP); $get_qp = mysqli_fetch_array($resultQP);  if($get_gp['totalgpoint'] > 0){ echo $get_gp['totalgpoint'];}else{echo "0";} 
   $sumqp = $get_qp['totalqpoint'];
   ?></strong></td>
    </tr>
    
    <tr><td colspan="11" style="text-align:center;color:<?php echo $col; ?>;font-size:15px;" ><div id="ccc1">&nbsp;<?php echo $pbcstatus; ?></div></td></tr>
<tr><td style="text-align:center;color:black;font-size:20px;" colspan="11" ><b>&nbsp; Result Prepared By : <?php echo strtoupper(getlect($lecs)); ?></b></td></tr>    
                                
                                
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
         <td colspan="1"><strong>Lecturer Signature and Date</strong></td>
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

 <button data-placement="right" title="Click Here To Exit Page" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='<?php echo $gback; ?>';" type="reset"><i class="icon-signin icon-large"></i> Go Back </button>

  <button data-placement="right" title="Click to Print " id="reset2" name="B2" class="btn btn-info" onClick="myFunction()" type="reset"><i class="icon-file icon-large"></i> Print </button></div>	

												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#reset').tooltip('show');$('#reset2').tooltip('show');
	                                            $('#reset').tooltip('hide');$('#reset2').tooltip('hide');
	                                            });
	                                            </script>
	                                          

<script>
function myFunction() {document.all.ccc2.style.visibility = 'hidden';
document.all.ccc1.style.visibility = 'hidden';
window.print();
    document.all.ccc2.style.visibility = 'visible';
    document.all.ccc1.style.visibility = 'visible';
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