
   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php 

$query= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row_C = mysqli_fetch_array($query);
							  $s_utme = $row_C['p_utme'];
						?>
                    <h2>Make Payment (s):</h2>
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
                 
                  
                   
                    	<?php include('modal_delete.php'); ?>
                    	 <span id="printout">
                    	  <table ><tr >
                    	 <div   id="divTitle" name="divTitle">
                        <div class="col-xs-12 invoice-header" >
                          <h1 >
                            <i class="fa fa-graduation-cap" ></i><FONT COLOR = "BLUE" style="text-shadow:-1px 1px 1px gray;" ><?php echo $row_C['SchoolName'];  ?>    </FONT><br>
                                          <small class="pull-right">STUDENT PAYMENT FOR THE SESSION</small>
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
                                            <br><b>State Of Origin:</b> <?php echo $stud_row['state'];?>
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
				 // if ($stud_row['images']==NULL ){print "uploads/NO-IMAGE-AVAILABLE.jpg";}else{print $stud_row['images'];}
				  
				  
				 // echo $row['adminthumbnails']; ?>">
  </div> </address>
                        </div>
                        <hr>
                        <!-- /.col -->
                      </div> </tr></table>
                      <!-- /.row -->
                    	 <div class="alert alert-info alert-dismissible fade in" role="alert">
                    
          <strong> Listed Below are Your Due Payment(s) For The Session and also Note that Checked Payment(s) are required to proceed.</strong>
                  </div>
                      <form method="post" class="form-horizontal"  action="" enctype="multipart/form-data">
                    <table  class="table table-striped jambo_table bulk_action" border="1">
                    <button type="submit" name="addpay"  id="save" data-placement="right" class="btn btn-primary" title="Click to add Payment and Conutinue" ><i class="fa fa-plus-circle icon-large"></i> Add Payment (s)</button><a data-placement="top" title="Click to Load The Available Banks You can make payments"    data-toggle="modal" href="#myModal200" id="delete"  class="btn btn-primary" name="delete_course" ><i class="fa fa-external-link icon-large"> View Bank</i></a>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
									
                      <thead>
                        <tr>
                         <th><!--<input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">--!></th>
                         <th>S/N</th>
						 <th>Payment Description</th>
                         <th>Program</th>
                          <th>Level</th>
                         <!-- <th>Department</th> --!>
                          <th>Amount</th>
                         <th>Pay Status</th>
                         
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php
$depart = $_GET['dept1_find'];
$level=$_GET['level'];
$semester= $_GET['semester'];
$user_queryst = mysqli_query($condb,"select * from student_tb where stud_id = '".safee($condb,$session_id)."'")or die(mysqli_error($condb));
$user_rowstate = mysqli_fetch_array($user_queryst);
$states = $user_rowstate['state'];
$student_s = "Delta";
if($states == $student_s){
$stud_from = "1" ;
//f_dept='$student_dept'  and
$viewfee_query = mysqli_query($condb,"select * from fee_db where  Cat_fee = '1' and level = '".safee($condb,$student_level)."' and program = '".safee($condb,$student_prog)."'  order by feetype DESC ")or die(mysqli_error($condb));
}else{
$viewfee_query = mysqli_query($condb,"select * from fee_db where  program ='".safee($condb,$student_prog)."' and Cat_fee = '0' and level = '".safee($condb,$student_level)."'  order by feetype DESC ")or die(mysqli_error($condb));
$stud_from = "0" ;
}
 ?>
 
 <tr>

	<?php		 		
											
							 if(mysqli_num_rows($viewfee_query)<1){
	  echo "<td colspan='9' style='text-align:centre;'><strong>No School Payment (s) Found.</strong></td>";
 }?>
 						
</tr>
<?php
$serial=1;
$sumcredit=0;
while($row_utme = mysqli_fetch_array($viewfee_query)){
$Fee_type1 = $row_utme['feetype'];  $Fee_cat = $row_utme['ft_cat']; if($Fee_cat == "1"){ $check_c =" Checked";  }else{ $check_c ="";  }
$paysid = $row_utme['fee_id']; $dperc = $row_utme['pper']; 
$psdate = $row_utme['psdate']; $famount =$row_utme['f_amount'];
$date20 = str_replace('/', '-', $psdate );  $newDate20 = date("Y-m-d", strtotime($date20));  $date_now =  date("Y-m-d");
$penaltysum = FeesCalc($famount,$dperc,$newDate20); $difp = $penaltysum - $famount ;
if($dperc > 0 and $date_now >= $newDate20){ $noteo = ", Note:  (".$dperc."% penalty inclusive ) ".number_format($famount,2) ." + ". number_format($difp,2) ." = ".number_format($penaltysum,2); $namount = $penaltysum; }else{ $noteo = ""; $namount = $row_utme['f_amount'];  } 

//$viewreg_query = mysqli_query($condb,"select pay_status,fee_type from payment_tb WHERE stud_reg = '".safee($condb,$student_RegNo)."'  AND fee_type = '".safee($condb,$Fee_type1)."' AND session = '".safee($condb,$default_session)."' AND level = '".safee($condb,$student_level)."'")or die(mysqli_error($condb));  $row_payview = mysqli_fetch_array($viewreg_query);
//$statuspay2 = $row_payview['pay_status'];  $feetypepay = $row_payview['fee_type'];
$qpaycomp = mysqli_query($condb,"SELECT pstatus FROM feecomp_tb  WHERE regno = '".safee($condb,$student_RegNo)."'  AND session = '".safee($condb,$default_session)."' AND level = '".safee($condb,$student_level)."' AND feetype = '".safee($condb,$Fee_type1)."'");
$row_paycomp = mysqli_fetch_array($qpaycomp);  $statuspay = $row_paycomp['pstatus']; //Batchno ='".safee($condb,$feetp)."' AND  
?>     <tr >
                        	<?php if($statuspay > 0){
							$status = 'Paid';
							 ?>
							<td width="30" style="text-align:centre;"  >
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" disabled  value="<?php echo $row_utme['fee_id']; ?>">  
                        <input type='hidden' name='feetn[]' value='<?php echo $Fee_cat; ?>' />   
													</td> <?php }else{ if($Fee_cat =="1"){$status = 'Not Paid';}else{
$status ="Not Paid"; //'<a rel="tooltip"  title="Click to Conutinue Payment" id="delete1" href="Spay_manage.php?view=m_sp&id='.md5($paysid).'" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus-circle icon-large" > Add Payment</i></a>';
}
													
													 ?>
														<td width="30" style="text-align:center;">
           	<input id="optionsCheckbox"  class="uniform_on1" name="selector[]" type="checkbox"  value="<?php echo $row_utme['fee_id']; ?>" <?php echo $check_c ;?> >  <input type='hidden' name='feetn[]' value='<?php echo $Fee_cat; ?>' />  
													</td>
													<?php } ?>
														<td  align='center'>
<?php echo $serial++ ; ?>
												</td>
						  <td><?php 
					if($statuspay > 0){
						echo "<font color='green'>".getftype($row_utme['feetype'])." ".$noteo." </font>   ";
						}else{echo "<font color='red'>".getftype($row_utme['feetype'])." ".$noteo."</font> ";}
					 ?></td>
					 <td><?php echo getprog($row_utme['program']); ?></td>
                          <td align='center'><?php echo getlevel($row_utme['level'],$student_prog); ?></td>
                          
						<!--	<td style="text-align:justify;"><?php //echo $row_utme['f_dept']; ?></td>	--!>
							<td style="text-align:center;"><?php echo number_format($namount,2);//$row_utme['f_amount']; ?></td>	
							<td style="text-align:center;"><?php echo $status; ?></td> 		
											
												
												
										
                        </tr>
                    <?php $sumcredit += $namount; }  ?>
                   
								<?php 
//$sumnet="select SUM(f_amount) from fee_db where f_dept='$student_dept' and program ='$student_prog'";
/* $student_s = "Delta";
if($states == $student_s){
$sumnet="select SUM(f_amount) as samount,SUM((pper / 100 * f_amount) + (f_amount)) as samount2 from fee_db where  program ='".safee($condb,$student_prog)."' and Cat_fee = '1' and level = '".safee($condb,$student_level)."'";
  $resultsumnet = mysqli_query($condb,$sumnet);
}else{
$sumnet="select SUM(f_amount) as samount,SUM((pper / 100 * f_amount) + (f_amount)) as samount2 from fee_db where  program ='".safee($condb,$student_prog)."' and Cat_fee = '0' and level = '".safee($condb,$student_level)."'";
  $resultsumnet = mysqli_query($condb,$sumnet);
} 
  $num_rows2 =mysqli_num_rows($resultsumnet);
  
 $get_infc = mysqli_fetch_array($resultsumnet); */
 //$sumcredit = $get_infc['samount'];
  //$sumcredit2 = $get_infc['samount2'];
  //echo $expire = $row_utme['psdate'];
// while($get_infc = mysqli_fetch_row($resultsumnet))
 //{
	  //foreach ($get_infc as $sumcredit)
								?>				
						<!--	<strike>N</strike>	--!>			
								<tfoot>
    <tr class="text-offset">
      <td colspan="5"><strong>Total Amount: </strong></td>
   <td style="text-align:center;"><strong> <?php if($sumcredit > 0){ echo "&#8358; ".number_format($sumcredit,2);}else{echo "0";} ?></strong></td>
    </tr>
   </tfoot> 	<?php //} ?>			
												
										
                     
                      </tbody>
                      
                      
                      <div class="btn-group" id="divButtons" name="divButtons">
                      <input type="button" value="Print" onclick="tablePrint();" class="btn btn-default">
                      	 </div>
                    </table>
                    </form>
                    
                    
                    
                  </div>
                </div>
              </div>
     
                 
  