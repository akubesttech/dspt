   
   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php 
                  $sql_gradeset = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$student_prog)."' and grade_group ='01' Order by b_max ASC limit 1 ")or die(mysqli_error($condb)); $getmg = mysqli_fetch_array($sql_gradeset);  $getpass = $getmg['b_max'];
                  
$que_warning23=mysqli_query($condb,"select * from payment_tb where stud_reg ='$student_RegNo' and session ='$default_session' and level='".safee($condb,$student_level)."' OR app_no = '$student_appNo' and session ='$default_session'  and level='".safee($condb,$student_level)."'")or die(mysqli_error($condb));
	$warning_count2=mysqli_num_rows($que_warning23);
$warning_data=mysqli_fetch_array($que_warning23);
	$pay_status = $warning_data['pay_status'];
		if ($pay_status > 0 ){ 
	}else{//echo "<script>alert('Access Not Granted ,Payment Information not verified!');</script>";
		message("Access Not Granted ,Payment Information not verified!", "error");
		        redirect("index.php");}
$query= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row_C = mysqli_fetch_array($query);
							  $s_utme = $row_C['p_utme'];
						?>
                    <h2>Outstanding / Carryover Course (s):</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
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
                                          <small class="pull-right">COURSE REGISTRATION FORM</small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                    	 <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col" >
                         
                          <address>
                                          <strong>Student Name:</strong> <?php echo $stud_row['FirstName']." ".$stud_row['SecondName']." ".$stud_row['Othername'];?>
                                          <br><b>Registration No:</b> <?php echo $stud_row['RegNo'];?>
                                          <br><b>Year of Study:</b> <?php echo $default_session;?>
                                          <br><b><?php echo $SCategory; ?>:</b><?php echo getfacultyc($stud_row['Faculty']);?>
                                          <br><b>Department:</b> <?php echo getdeptc($stud_row['Department']);?>
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
                    
          <strong> Listed Below are Your Carryover Course (s).</strong>
                  </div>
                    
                    <table  class="table table-striped jambo_table bulk_action" border="1">
                    	<a data-placement="top" title="Click to Delete Selected Courses"    data-toggle="modal" href="#delete_rcourse" id="delete"  class="btn btn-danger" name="delete_course" style="display:none;"><i class="fa fa-trash icon-large"> Delete Course</i></a>
                    
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
									
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                         <th>S/N</th>
						 <th>Course Code</th>
                         <th>Course Title</th>
                          <th>Credit Unit</th>
                          <th>Semester</th>
                          <th>Level</th>
                         <th>Session</th>
                         <th>C A Score <?php echo " ".getamax($student_prog)." %"; ?></th>
                          <th>Exam Score <?php echo " ".getemax($student_prog)." %"; ?></th>
                         <th>Total</th>
                         <th>Grade</th>
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php
$depart = $_GET['dept1_find'];
$level=$_GET['level'];
$semester= $_GET['semester'];


//$mado = mysqli_query($condb,"SELECT * FROM details  INNER JOIN payment ON details.regno = payment.regno  and details.level  = payment.level where details.regno like '%$typein%'   AND payment.regno like '%$typein%'  ");

$viewutme_query = mysqli_query($condb,"select * from results where student_id='".safee($condb,$student_RegNo)."' and total <= '".safee($condb,$getpass)."'  order by session DESC ")or die(mysqli_error($condb)); ?>
 <tr>

	<?php		 		
											
							 if(mysqli_num_rows($viewutme_query)<1){
	  echo "<td colspan='12' style='text-align:centre;'><strong>No Outstanding course (s) Found.</strong></td>";
 }?>
 						
</tr>
<?php
$serial=1;
while($row_utme = mysqli_fetch_array($viewutme_query)){
//$id = $row_utme['appNo'];
$new_a_id = $row_utme['stud_id'];
$stprogram = getstudentpro($row_utme['student_id']);
$viewreg_query = mysqli_query($condb,"select DISTINCT creg_status  from coursereg_tb WHERE sregno = '".safee($condb,$student_RegNo)."' AND c_code = '".safee($condb,$row_utme['course_code'])."' AND creg_status = '1'")or die(mysqli_error($condb));
?>     
                        <tr>
                        	<?php if(mysqli_num_rows($viewreg_query)>0){
							$status = 'style"color:green;"';
							 ?>
							<td width="30" style="text-align:centre;">
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" disabled CHECKED="CHECKED" value="<?php echo $row_utme['creg_id']; ?>">  
                        
													</td> <?php }else{
													//$status = 'style"color:red;"';
													 ?>
														<td width="30" style="text-align:center;">
           	<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox"  value="<?php echo $row_utme['creg_id']; ?>">
													</td>
													<?php } ?>
														<td  align='center'>
<?php echo $serial++; ?>
												</td>
						  <td><?php 
					if(mysqli_num_rows($viewreg_query)>0){
						echo "<font color='green'>$row_utme[course_code]</font>";
						}else{echo "<font color='red'>$row_utme[course_code]</font>";}
					 ?></td>
					 <td><?php echo getcourse($row_utme['course_code']); ?></td>
                          <td align='center'><?php echo $row_utme['c_unit']; ?></td>
                          <td><?php echo $row_utme['semester']; ?></td>
                          <td><?php echo getlevel($row_utme['level'],$student_prog); ?></td>
                         <td width="120">
<?php echo $row_utme['session']; ?>	</td> 
<td style="text-align:justify;"><?php echo $row_utme['assessment']; ?></td>
							<td style="text-align:justify;"><?php echo $row_utme['exam']; ?></td>	
							<td style="text-align:justify;"><?php echo $row_utme['total']; ?></td>	
							<td style="text-align:justify;"><?php echo grading($row_utme['total'],$stprogram); ?></td> 		
											
												
												
										
                        </tr>
                    <?php } ?>
                   
								<?php 
$sumnet="select SUM(c_unit) from results where student_id ='".safee($condb,$student_RegNo)."' and total <= '".safee($condb,$getpass)."' ";
  $resultsumnet = mysqli_query($condb,$sumnet); 
  $num_rows2 =mysqli_num_rows($resultsumnet);
 
 while($get_infc = mysqli_fetch_row($resultsumnet))
 {
	  foreach ($get_infc as $sumcredit)
								?>				
											
								<tfoot>
    <tr class="text-offset">
      <td colspan="2"><strong>Total Credit Unit:</strong></td>
    <td align='center'></td><td align='center'></td><td align='center'><strong> <?php if($sumcredit > 0){ echo $sumcredit;}else{echo "0";} ?></strong></td>
    </tr>
   </tfoot> 	<?php } ?>			
												
										
                     
                      </tbody>
                      
                      
                      <div class="btn-group" id="divButtons" name="divButtons">
                      <input type="button" value="Print" onclick="tablePrint();" class="btn btn-default">
                      	 </div>
                    </table>
                    
                    
                    
                    
                  </div>
                </div>
              </div>
              
                 
  