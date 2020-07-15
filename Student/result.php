    <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php 
$asession = $_GET['session'];
$level=$_GET['level'];
$semester= $_GET['semester'];
$qres = "select * from resultapproval_tb WHERE prog = '".safee($condb,$student_prog)."' AND dept = '".safee($condb,$student_dept)."' AND session = '".safee($condb,$asession)."' AND level = '".safee($condb,$level)."' AND apstatus = '1' ";
 if($semester != "Annual"){  $qres .= " AND semester='$semester'";  }
 $queryresultapp =  mysqli_query($condb,$qres)or die(mysqli_error($condb));
  $aptatus = mysqli_num_rows($queryresultapp);
 if($semester != "Annual"){ $semn = $semester." Semester ";}else{ $semn ="Annual";} 
$query= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row_nb = mysqli_fetch_array($query);
							  $s_utme = $row_nb['p_utme'];
						?>
                    <h2>Student Result Details </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <?php if($aptatus < 1){  ?>
                             <tr class="row1" >
<td colspan="6" class="text-muted well well-sm no-shadow" style="margin-top: 10px;"><center>
                       <font color="red" size="6" face="bold"><?php echo $asession." Session ".$semn." Results for ".getlevel($level,$student_prog)." level  is not Yet Published  please Check Back Later ";  ?><strong><a href="javascript:void(0);" onClick="window.location.href='result_manage.php?view=S_re';">Click Here to Go back </a></strong> </font></center>
                          </td></tr><?php }else{  ?>
                    <p class="text-muted font-13 m-b-30">
                  
                    </p>
                 
                  
                    <form action="Delete_regcourse.php" method="post">
                    	<?php include('modal_delete.php'); ?>
                    <span id="printout"> <div id= "print_content">
                    	  <table ><tr >
                    	 <div   id="divTitle" name="divTitle">
                        <div class="col-xs-12 invoice-header" >
                          <h1 >
<i class="fa fa-graduation-cap" ></i><font color = "blue" style="text-shadow:-1px 1px 1px gray;" ><center><?php echo $row_nb['SchoolName'];  ?></center>    </font><br><?php  if($semester == "Annual"){?> <small class="pull-right" ><center>ANNUAL RESULT SLIP</center></small><?php }else{ ?>
<small class="pull-right" ><center>STUDENT RESULT SLIP</center></small><?php } ?>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                    	 <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col" style="text-align:left;font-size:14px;" >
                         
                          <address>
                                          <strong>Student Name:</strong> <?php echo $stud_row['FirstName']." ".$stud_row['SecondName']." ".$stud_row['Othername'];?>
                                          <br><b>Reg / Matric No:</b> <?php echo $stud_row['RegNo'];?>
                                          <br><b>Year of Study:</b> <?php echo $default_session;?>
                                          <br><b><?php echo $SCategory; ?> :</b><?php echo getfacultyc($stud_row['Faculty']);?>
                                          <br><b><?php echo $SGdept1; ?>:</b> <?php echo getdeptc($stud_row['Department']);?>
                                            <br><b>Level:</b> <?php echo getlevel($level,$student_prog);?>
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col" >
                         
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        
                          <div class="rounded" style="text-align:right;">
   <img id="admin_avatar" class="img-rectangle" width="120px" height="100px" src="<?php 
  $exists2 = imgExists($stud_row['images']);
				  if ($exists2 > 0 ){print $stud_row['images'];	}else{ print "uploads/NO-IMAGE-AVAILABLE.jpg";}
				  
				  
				 // echo $row['adminthumbnails']; ?>">
  </div> 
                        </div>
                        <hr>
                        <!-- /.col -->
                      </div> </tr></table>
                      <!-- /.row -->
                    	 <div class="alert alert-info alert-dismissible fade in" role="alert">
<?php  if($semester == "Annual"){?><strong style="font-size:14px;" > Listed Below is Your <?php echo $semester;  ?>  Result </strong>
<?php }else{?> <strong style="font-size:14px;" > Listed Below is Your <?php echo $semester;  ?> Semester Result (s)</strong> <?php } ?>
                  </div>
                     <div id="ccc2">	 </div>
    <table  border="1" style="table, th, td {border: 1px solid white;}">
         <!-- <table  class="table table-striped jambo_table bulk_action" border="1" style="table, th, td {border: 1px solid gray;}color:white;">  --!>       
                 					<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
									
                      <thead>
                        <tr style="background-color: gray; color: white;font-family:Verdana, Geneva, sans-serif;font-size:12px">
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                         <th>S/N</th>
						 <th>Course Code</th>
                         <th>Course Title</th>
                          <th>Credit Unit</th>
                       <!-- <th>C A Score <?php echo " ".getamax($student_prog)." %"; ?></th>
                          <th>Exam Score <?php echo " ".getemax($student_prog)." %"; ?></th>
                         <th>Total</th>--!>
                         <th>Grade</th>
                          <th>Grade Point</th>
                        </tr>
                      </thead>
                      
                      
 <tbody><?php if($semester == "Annual"){
$viewutme_query = mysqli_query($condb,"select * from results where student_id = '".safee($condb,$student_RegNo)."' and session ='".safee($condb,$asession)."'  and level ='".safee($condb,$level)."'  order by semester ASC ")or die(mysqli_error($condb)); }else{ $viewutme_query = mysqli_query($condb,"select * from results where student_id = '".safee($condb,$student_RegNo)."' and session ='".safee($condb,$asession)."' and semester='".safee($condb,$semester)."' and level ='".safee($condb,$level)."'  order by session DESC ")or die(mysqli_error($condb));
 }?><?php if(mysqli_num_rows($viewutme_query)<1){ if($semester == "Annual"){ echo "<tr class='row1'><td colspan='10' style='text-align:centre;'><strong>No result found in the database For This $semester   Result. </strong></td></tr>"; }else{ echo "<tr class='row1'><td colspan='10' style='text-align:centre;'><strong>No result found in the database For This $semester   Semester. </strong></td></tr>"; } }?>
<?php
$serial=1; $i= 0;
while($row_utme = mysqli_fetch_array($viewutme_query)){
//$id = $row_utme['appNo'];
$new_a_id = $row_utme['student_id'];
 $stprogram = getstudentpro($row_utme['student_id']);
if ($i%2) {$class = 'row1';} 
	else {$class = 'row2';}
	$i += 1;
//$viewreg_query = mysqli_query($condb,"select DISTINCT creg_status  from coursereg_tb WHERE sregno = '$student_RegNo' AND c_code = '$row_utme[course_code]' AND creg_status = '1'")or die(mysqli_error($condb));
?>     
                        <tr class="<?php echo $class; ?>" >
                        
														<td width="30" style="text-align:center;">
           	<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox"  value="<?php echo $row_utme['student_id']; ?>">
													</td>
												
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
<!--<td style="text-align:justify;"><?php echo $row_utme['assessment']; ?></td>
							<td style="text-align:justify;"><?php echo $row_utme['exam']; ?></td>	
							<td style="text-align:justify;"><?php echo $row_utme['total']; ?></td>	--!>
							<td style="text-align:justify;"><?php echo grading($row_utme['total'],$student_prog); ?></td> 
							<td style="text-align:justify;"><?php echo gradpoint($row_utme['total'],$student_prog); ?></td>		</tr>
                        
                    <?php } ?><?php  if($semester == "Annual"){ $sumnet="select SUM(c_unit) from results where student_id ='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$asession)."' and level ='".safee($condb,$level)."' "; }else{ 
$sumnet="select SUM(c_unit) from results where student_id ='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$asession)."' and semester='".safee($condb,$semester)."' and level ='".safee($condb,$level)."' ";
}
  $resultsumnet = mysqli_query($condb,$sumnet); 
  $num_rows2 =mysqli_num_rows($resultsumnet);
 
 while($get_infc = mysqli_fetch_row($resultsumnet))
 {
	  foreach ($get_infc as $sumcredit)
								?>				
											
								<tfoot  >
    <tr class="text-offset">
      <td colspan="4"><strong>Total Credit Unit:</strong></td>
    <td align='center' colspan="1"><strong> <?php if($sumcredit > 0){ echo $sumcredit;}else{echo "0";}} ?></strong></td>
    <td colspan="1"><strong>Total Grade Points:</strong></td>
    <td colspan="1"><strong><?php if($semester == "Annual"){ $resultgP = mysqli_query($condb,"select SUM(gpoint) as totalgpoint from results where student_id ='$student_RegNo' and session ='".safee($condb,$asession)."'  and level='".safee($condb,$level)."'");
    $resultQP = mysqli_query($condb,"select SUM(gpoint * c_unit) as totalqpoint from results where student_id ='$student_RegNo' and session ='".safee($condb,$asession)."'  and level='".safee($condb,$level)."'");
   }else{ $resultgP = mysqli_query($condb,"select SUM(gpoint) as totalgpoint from results where student_id ='$student_RegNo' and session ='".safee($condb,$asession)."' and semester='".safee($condb,$semester)."' and level='".safee($condb,$level)."'");
    $resultQP = mysqli_query($condb,"select SUM(gpoint * c_unit)as totalqpoint from results where student_id ='$student_RegNo' and session ='".safee($condb,$asession)."' and semester='".safee($condb,$semester)."' and level='".safee($condb,$level)."'");
   } $num_rows2 =mysqli_num_rows($resultgP); $get_gp = mysqli_fetch_array($resultgP);$get_qp = mysqli_fetch_array($resultQP);  if($get_gp['totalgpoint'] > 0){ echo $get_gp['totalgpoint'];}else{echo "0";} $sumqp = $get_qp['totalqpoint']; ?></strong></td>
    </tr>
    
    <tr><td colspan="10" >&nbsp;</td></tr>
    <tr >
                                
                                  <td colspan="4" ><strong>Sum of Credit Units:</strong></td>
                                  <td align='center'><?php if($sumcredit > 0){ echo $sumcredit;}else{echo "0";}?></td>
                                  
                                </tr>
                                <tr >
                                  <td colspan="4"><strong>Sum of Quality Points:</strong></td>
                                  <td align='center'><?php if($sumqp > 0){ if($sumqp == "1"){ echo $sumqp." Point"; }else{echo $sumqp." Point (s)";} }else{echo "0 Point";} ?></td>
                                </tr>
                                <tr >
                                  <td colspan="4"><strong>CGPA:</strong></td>
                                  <td align='center'><?php $gpa =$sumqp/$sumcredit; if($gpa > 0){ echo round($gpa,2)." Point (s)";}else{echo "0 Point";} ?></td>
                                </tr>
   <!-- 
    <tr  style="background-color: gray; color: white;font-family:Verdana, Geneva, sans-serif;font-size:12px"><td colspan="4" ><strong>Previous:</strong></td><td colspan="3" ><strong>Present:</strong></td><td colspan="3" ><strong>Cumulative:</strong></td></tr>
    <tr><td colspan="4" >TOTAL CREDIT UNITS REGISTERED:</td><td colspan="3" >TOTAL CREDIT UNITS REGISTERED:</td><td colspan="3" >TOTAL CREDIT UNITS REGISTERED:</td></tr>
    
       <tr><td colspan="4" >TOTAL GRADE POINTS:</td><td colspan="3" >TOTAL GRADE POINTS:</td><td colspan="3" >TOTAL GRADE POINTS:</td></tr>

<tr><td colspan="4" >TOTAL CREDIT UNITS EARNED:</td><td colspan="3" >TOTAL CREDIT UNITS EARNED:</td><td colspan="3" >TOTAL CREDIT UNITS EARNED:</td></tr>
   <tr><td colspan="4" >CUMMULATIVE GRADE POINTS:</td><td colspan="3" >CUMMULATIVE GRADE POINTS:</td><td colspan="3" >CUMMULATIVE GRADE POINTS:</td></tr>  --!>
                              
   </tfoot> 	<?php //}?>			
												
										
                     
                      </tbody>
                      
                      
                      <div class="btn-group" id="cccv" name="divButtons">
                     <!-- <div class="btn-group" id="divButtons" name="divButtons">
					  <input type="button" value="Print" onclick="tablePrint();" class="btn btn-default"> --!>
					  <a href="#" onclick="window.open('result_manage.php?view=S_re','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-backward icon-large"></i> Go back</a>&nbsp;&nbsp;
<!--<input type="button" value="Print" onclick="Clickheretoprint();" class="btn btn-default"> --!>
<a href="#" onclick="window.open('resultslip.php?sec=<?php echo $asession; ?>&lev=<?php echo $level; ?>&sem=<?php echo $semester ;?>','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-print icon-large"></i> Print</a> 
                      
                      	 </div>
                    </table>
                    
                    
                    </div>
                    <?php }  ?>
                  </div>
                </div>
              </div>
              
                 
  