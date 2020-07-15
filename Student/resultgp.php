   
   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php 
$asession = $_POST['session'];
$level=$_POST['level'];
$semester= $_POST['semester'];
$qres = "select * from resultapproval_tb WHERE prog = '".safee($condb,$student_prog)."' AND dept = '".safee($condb,$student_dept)."' AND session = '".safee($condb,$asession)."' AND level = '".safee($condb,$level)."' AND apstatus = '1' ";
 if($semester != "Annual"){  $qres .= " AND semester='$semester'";  }
 $queryresultapp =  mysqli_query($condb,$qres)or die(mysqli_error($condb));
 $aptatus = mysqli_num_rows($queryresultapp);
 if($semester != "Annual"){ $semn = $semester." Semester ";}else{ $semn ="Annual";} 

$query= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row_C = mysqli_fetch_array($query);
							  $s_utme = $row_C['p_utme'];
						?>
                    <h2>Student GPA Details </h2>
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
                       <font color="red" size="6" face="bold"><?php echo $asession." Session ".$semn." Results for ".getlevel($level,$student_prog)." level  is not Yet Published  please Check Back Later ";  ?><strong><a href="javascript:void(0);" onClick="window.location.href='result_manage.php?view=S_re2';">Click Here to Go back </a></strong> </font></center>
                          </td></tr><?php }else{  ?>
                    <p class="text-muted font-13 m-b-30">
                  
                    </p>
                 
                  
                    <form action="Delete_regcourse.php" method="post">
                    	<?php include('modal_delete.php'); ?>
                    	 <span id="printout">
                    	  <table ><tr >
                    	 <div   id="divTitle" name="divTitle">
                        <div class="col-xs-12 invoice-header" >
                          <h1 >
                            <i class="fa fa-graduation-cap" ></i><FONT COLOR = "BLUE" style="text-shadow:-1px 1px 1px gray;" ><?php echo $row_C['SchoolName'];  ?>    </FONT><br>
                                          <small class="pull-right">STUDENT RESULT SLIP</small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                    	 <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col" style="text-align:left;" >
                         
                          <address>
                                          <strong>Student Name:</strong> <?php echo $stud_row['FirstName']." ".$stud_row['SecondName']." ".$stud_row['Othername'];?>
                                          <br><b>Registration No:</b> <?php echo $stud_row['RegNo'];?>
                                          <br><b>Year of Study:</b> <?php echo $default_session;?>
                                          <br><b><?php echo $SCategory; ?>:</b><?php echo getfacultyc($stud_row['Faculty']);?>
                                          <br><b><?php echo $SGdept1; ?> :</b> <?php echo getdeptc($stud_row['Department']);?>
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col" >
                         
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                         <address>
                          <div class="rounded" align="right">
   <img id="admin_avatar" class="img-rectangle" width="120px" height="100px" src="<?php 
  if ($exists > 0 ){ print $stud_row['images'];
	}else{ print "uploads/NO-IMAGE-AVAILABLE.jpg";}
//if ($stud_row['images']==NULL ){print "uploads/NO-IMAGE-AVAILABLE.jpg";}else{print $stud_row['images'];}
				  
				  
				 // echo $row['adminthumbnails']; ?>">
  </div> </address>
                        </div>
                        <hr>
                        <!-- /.col -->
                      </div> </tr></table>
                      <!-- /.row -->
                    	 <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <?php  if($semester == "Annual"){?>
          <strong> Listed Below is Your <?php echo $semester;  ?>  CGPA </strong><?php }else{ ?>
          <strong> Listed Below is Your <?php echo $semester;  ?> Semester CGPA </strong>
          <?php } ?>
                  </div>
                    
                  <table  border="1" style="table, th, td {border: 1px solid white;}">
                    	<a data-placement="top" title="Click to Delete Selected Courses"    data-toggle="modal" href="#delete_rcourse" id="delete"  class="btn btn-danger" name="delete_course" style="display:none;"><i class="fa fa-trash icon-large"> Delete Course</i></a>
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
                          <!--<th>Semester</th>
                          <th>Level</th>
                         <th>Session</th>--!>
                         <th>Grade</th>
                         <th>Grade Point</th>
                         <th>Quality Points</th>
                        
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php

//$mado = mysqli_query($condb,"SELECT * FROM details  INNER JOIN payment ON details.regno = payment.regno  and details.level  = payment.level where details.regno like '%$typein%'   AND payment.regno like '%$typein%'  ");
if($semester == "Annual"){
$viewutme_query = mysqli_query($condb,"select * from results where student_id='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$asession)."'  and level='".safee($condb,$level)."'  order by semester ASC ")or die(mysqli_error($condb));}else{
$viewutme_query = mysqli_query($condb,"select * from results where student_id='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$asession)."' and semester='".safee($condb,$semester)."' and level='".safee($condb,$level)."'  order by session DESC ")or die(mysqli_error($condb));} ?>
 <?php	if(mysqli_num_rows($viewutme_query)<1){ if($semester == "Annual"){ 
echo "<tr><td colspan='11' style='text-align:centre;'><strong>No result found in the database For This $semester  Result CGPA. </strong></td></tr>";}else{
echo "<tr><td colspan='11' style='text-align:centre;'><strong>No result found in the database For This $semester   Semester. </strong></td></tr>";	
	}
 }else{?>
 						

<?php
$serial=1;
while($row_utme = mysqli_fetch_array($viewutme_query)){
//$id = $row_utme['appNo'];
$new_a_id = $row_utme['student_id'];
$stprogram = getstudentpro($row_utme['student_id']);
//$viewreg_query = mysqli_query($condb,"select DISTINCT creg_status  from coursereg_tb WHERE sregno = '$student_RegNo' AND c_code = '$row_utme[course_code]' AND creg_status = '1'")or die(mysqli_error($condb));
?>     
                        <tr >
                        
														<td width="30" style="text-align:center;">
           	<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox"  value="<?php echo $row_utme['creg_id']; ?>">
													</td>
												
														<td  align='center'>
<?php echo $serial++; ?>
												</td>
						  <td><?php 
				
						echo "<font color='green'>$row_utme[course_code]</font>";
					
					 ?></td>
					 <td><?php echo getcourse($row_utme['course_code']); ?></td>
                          <td align='center'><?php echo $row_utme['c_unit']; ?></td>
                          <!--<td><?php echo $row_utme['semester']; ?></td>
                          <td><?php echo getlevel($row_utme['level'],$student_prog); ?></td>
                         <td width="120">
<?php echo $row_utme['session']; ?>	</td> --!>
<td style="text-align:justify;"><?php echo grading($row_utme['total'],$stprogram); ?></td>
							<td style="text-align:center;"><?php echo gradpoint($row_utme['total'],$student_prog); ?></td>	
							<td style="text-align:center;"><?php echo $row_utme['qpoint']; ?></td>	
								
											
												
												
										
                        </tr>
                    <?php } ?>
                   
								<?php if($semester == "Annual"){
$query2_gp = mysqli_query($condb,"select SUM(gpoint) from results where student_id ='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$asession)."'  and level='".safee($condb,$level)."'")or die(mysqli_error($condb));

$resultsumnet = mysqli_query($condb,"select SUM(c_unit) from results where student_id ='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$asession)."'  and level='".safee($condb,$level)."'");

$resultGP = mysqli_query($condb,"select SUM(gpoint) from results where student_id ='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$asession)."'  and level='".safee($condb,$level)."'");

$resultQP = mysqli_query($condb,"select SUM(qpoint) from results where student_id ='$student_RegNo' and session ='".safee($condb,$asession)."'  and level='".safee($condb,$level)."'");
}else{
$query2_gp = mysqli_query($condb,"select SUM(gpoint) from results where student_id ='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$asession)."' and semester='".safee($condb,$semester)."' and level='".safee($condb,$level)."'")or die(mysqli_error($condb));

$resultsumnet = mysqli_query($condb,"select SUM(c_unit) from results where student_id ='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$asession)."' and semester='".safee($condb,$semester)."' and level='".safee($condb,$level)."'");

$resultGP = mysqli_query($condb,"select SUM(gpoint) from results where student_id ='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$asession)."' and semester='".safee($condb,$semester)."' and level='".safee($condb,$level)."'");

$resultQP = mysqli_query($condb,"select SUM(qpoint) from results where student_id ='$student_RegNo' and session ='".safee($condb,$asession)."' and semester='".safee($condb,$semester)."' and level='".safee($condb,$level)."'");

}
  //$resultQP = mysqli_query($condb,$query2_qp); 
$count_gp = mysqli_fetch_array($query2_gp);	
								 

								?>				
											
								<tfoot  >
    <tr class="text-offset">
      <td colspan="4"><strong>Total Credit Unit:</strong></td>
<td align='center'><strong> <?php 
  //$resultsumnet = mysqli_query($condb,$sumnet); 
  $num_rows2 =mysqli_num_rows($resultsumnet);
 
 while($get_infc = mysqli_fetch_row($resultsumnet))
 {
	  foreach ($get_infc as $sumcredit) if($sumcredit > 0){ echo $sumcredit;}else{echo "0";}} ?></strong></td><td align='center'><strong>Total GP / QP</strong></td>
	  <td style="text-align:center;">
	<strong><?php 
  //$resultGP = mysqli_query($condb,$query2_gp); 
  $num_rows2 =mysqli_num_rows($resultGP);
 
 while($get_gp = mysqli_fetch_row($resultGP))
 {
	  foreach ($get_gp as $sumgp) if($sumgp > 0){ echo $sumgp;}else{echo "0";}} ?></strong></td>
	  <td style="text-align:center;">
	  
	  	<strong><?php 
  $num_rows2 =mysqli_num_rows($resultQP);
 
 while($get_qp = mysqli_fetch_row($resultQP))
 {
	  foreach ($get_qp as $sumqp) if($sumqp > 0){ echo $sumqp;}else{echo "0";}} ?></strong>
	  </td>
    </tr><tr><td colspan="11" >&nbsp;</td></tr>
    
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
   </tfoot> 	<?php } ?>			
												
										
                     
                    
                      
                      
                      <div class="btn-group" id="divButtons" name="divButtons">
                      <a href="#" onclick="window.open('result_manage.php?view=S_re2','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-backward icon-large"></i> Go back</a>
                 <!--     <input type="button" value="Print" onclick="tablePrint();" class="btn btn-default"> --!>
                      <a href="#" onclick="window.open('aresultslip.php?sec=<?php echo $asession; ?>&lev=<?php echo $level; ?>&sem=<?php echo $semester ;?>','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-print icon-large"></i> Print</a>
                      	 </div>
                        <!-- /.col -->
                        
                        <!-- /.col -->
                          </tbody>
                    </table>
                    	 <?php }  ?> 
                    
                    
                    
                  </div>
                </div>
              </div>
              
                 
  