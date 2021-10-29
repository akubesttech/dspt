
   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php 

$query= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row_C = mysqli_fetch_array($query);
							  $s_utme = $row_C['p_utme']; $smato = $row_C['smat'];
                              $sshow = $stud_row['istatus'];  $semailo = $stud_row['e_address'];
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
                                           <?php if(!empty($smato)){ if(empty($sshow)){  ?>
                <br><b> Username :</b><?php echo $semailo;  ?><?php }else{ ?>
                <br><b>Matric No :</b><?php echo $stud_row['RegNo'];  ?>
             <?php } }else{ ?>
                <br><b>Matric No :</b><?php echo $stud_row['RegNo'];  ?> <?php } ?>
                                         
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
                      <div id="print_content"> 
                    <?php $enableinst = setinstallment;
$depart = isset($_GET['dept1_find']) ? $_GET['dept1_find'] : '';
$level = isset($_GET['level']) ? $_GET['level'] : '';
$semester = isset($_GET['semester']) ? $_GET['semester'] : '';
$user_queryst = mysqli_query($condb,"select * from student_tb where stud_id = '".safee($condb,$session_id)."'")or die(mysqli_error($condb));
$user_rowstate = mysqli_fetch_array($user_queryst);
$states = $user_rowstate['state']; $pn2 = $user_rowstate['RegNo']; $ft = "8";
$student_s = "Delta";
if($states == "Delta"){ $stud_from = "1";}else{ $stud_from = "0";}
$laspdate = getlpdate($pn2,$ft,$student_prog,$student_level,$default_session,$stud_from); 
$sumpay1 = getpayamt($pn2,$ft,$student_prog,$student_level,$default_session); //$warning_data['samount']; 
$duep1 = getDueamt($ft,$student_prog,$student_level,$stud_from); ?>
                      <form method="post" class="form-horizontal"  action="" enctype="multipart/form-data">
                      <tr><td>
  <div  style="color:blue;font-size:15px;text-align: center;"><b><?php if($laspdate < 1 ){ ?>
  Listed Below are Your Due Payment(s) For The Session and also Note that Checked Payment(s) are required to proceed<?php }else{
  if($sumpay1 >= $duep1 ){echo $mesg1 = "Listed Below are Your Due Payment(s) For The Session and also Note that Checked Payment(s) are required to proceed"; }else{ echo $mesg1 = "Make Your Late Payment Penalty Fee To Continue"; }   
  } ?> </b></div></td></tr>
                    <table   class="table table-striped table-bordered" border="0" style="max-width: 1150px;">
 <div id="cccv">
                    <button type="submit" name="addpay"  id="save" data-placement="right" class="btn btn-primary" title="Click to add Payment and Conutinue" ><i class="fa fa-plus-circle icon-large"></i> Add Payment (s)</button>
                    <a data-placement="top" style="display: none;" title="Click to Load The Available Banks You can make payments"    data-toggle="modal" href="#myModal200" id="delete"  class="btn btn-primary" name="delete_course" ><i class="fa fa-external-link icon-large"> View Bank</i></a>
					<a rel="tooltip"  href="javascript:void(0);" title="Print Details"  onClick="return Clickheretoprint();" class="btn btn-default"><i class="fa fa-print icon-large"> Print</i></a>			
                                </div>	<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
									
                      <thead>
                        <tr class="row2">
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

if($sumpay1 >= $duep1 ){ $catp = "1"; }else{  $catp = "8"; } 
$Qviewfee = "select * from fee_db where  Cat_fee = '".safee($condb,$stud_from)."' and level = '".safee($condb,$student_level)."' and program = '".safee($condb,$student_prog)."'  ";
 //if(!empty($enableinst)){$Qviewfee .= " and status = '1'  ";}
if($acastatus == 8){ $Qviewfee.= " and ft_cat BETWEEN 2 and 6 ";}else{
    if($laspdate < 1 ){ $Qviewfee.= " and ft_cat BETWEEN 1 and 2 ";}else{ $Qviewfee.= " and ft_cat = '".safee($condb,$catp)."' "; }}
$Qviewfee.= " order by feetype DESC";
$viewfee_query = mysqli_query($condb,$Qviewfee)or die(mysqli_error($condb));
$ccomp = mysqli_num_rows($viewfee_query);
//if($states == $student_s){
//$stud_from = "1" ;
//$viewfee_query = mysqli_query($condb,"select * from fee_db where  Cat_fee = '1' and level = '".safee($condb,$student_level)."' and program = '".safee($condb,$student_prog)."' and ft_cat BETWEEN 1 and 2  order by feetype DESC ")or die(mysqli_error($condb));
//}else{
//$viewfee_query = mysqli_query($condb,"select * from fee_db where  program ='".safee($condb,$student_prog)."' and Cat_fee = '0' and level = '".safee($condb,$student_level)."' and ft_cat BETWEEN 1 and 2  order by feetype DESC ")or die(mysqli_error($condb));
//$stud_from = "0" ;} 
?>
 <tr>
<?php	if($ccomp < 1){
echo "<td colspan='9' style='text-align:centre;'><strong>No School Payment (s) Found.</strong></td>"; }?>
</tr>
<?php
$serial=1;
$sumcredit=0; $i = 0; $pmt = 0.00; $t_namount = 0.00;
while($row_utme = mysqli_fetch_array($viewfee_query)){ $enablestatus = $row_utme['status'];
    if ($i%2) {$class = 'row2';} else {$class = 'row1';}$i += 1;
$Fee_type1 = $row_utme['feetype'];  $Fee_cat = $row_utme['ft_cat']; if(($Fee_cat == "1" OR $Fee_cat == "6" OR $Fee_cat == "8") AND $enablestatus > 0 ){ $check_c =" Checked";  }else{ $check_c ="";  }
$paysid = $row_utme['fee_id']; $dperc = $row_utme['pper']; 
$psdate = $row_utme['psdate']; $famount =$row_utme['f_amount'];
$setend2 = $row_utme['edate'];$edate20 = str_replace('/', '-', $setend2 );
$date20 = str_replace('/', '-', $psdate );  $newDate20 = date("Y-m-d", strtotime($date20));  $date_now =  date("Y-m-d");
$penaltysum = FeesCalc($famount,$dperc,$newDate20); $difp = $penaltysum - $famount ;
$nedate = date("d-m-Y", strtotime($edate20)); $timestamp2 = strtotime($nedate);
$date_now2 = new DateTime(); $enddate    = new DateTime($nedate);
if($dperc > 0 and $date_now2 < $enddate){ $noteo = ", Note:  (".$dperc."% penalty inclusive ) ".number_format($famount,2) ." + ". number_format($difp,2) ." = ".number_format($penaltysum,2); $namount = $penaltysum; }else{ $noteo = ""; $namount = $row_utme['f_amount'];  } 

//$viewreg_query = mysqli_query($condb,"select pay_status,fee_type from payment_tb WHERE stud_reg = '".safee($condb,$student_RegNo)."'  AND fee_type = '".safee($condb,$Fee_type1)."' AND session = '".safee($condb,$default_session)."' AND level = '".safee($condb,$student_level)."'")or die(mysqli_error($condb));  $row_payview = mysqli_fetch_array($viewreg_query);
//$statuspay2 = $row_payview['pay_status'];  $feetypepay = $row_payview['fee_type'];
$qpaycomp = mysqli_query($condb,"SELECT pstatus FROM feecomp_tb  WHERE regno = '".safee($condb,$student_RegNo)."'  AND session = '".safee($condb,$default_session)."' AND level = '".safee($condb,$student_level)."' AND feetype = '".safee($condb,$Fee_type1)."'");
$row_paycomp = mysqli_fetch_array($qpaycomp);  $statuspay = $row_paycomp['pstatus']; //Batchno ='".safee($condb,$feetp)."' AND  
$payamt = getpayamt($student_RegNo,$Fee_cat,$student_prog,$student_level,$default_session,$Fee_type1);
$dpay = getDueamt($Fee_cat,$student_prog,$student_level,$stud_from,$Fee_type1);
if($statuspay > 0 AND $payamt >= $dpay){$t_namount = $namount; $dip = "display:none"; }else{ $t_namount = $namount - $payamt; $dip = ""; }
?>     <tr class="<?php echo $class ; ?>" style="<?php echo $dip; ?>">
                        	<?php if($statuspay > 0){
							$status = 'Paid';
							 ?>
                             <input type='hidden' name='feetn[]' value='<?php echo $Fee_cat; ?>' />
							<td  style="text-align:center;"  >
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" payamt="<?php echo $t_namount; ?>"  disabled  value="<?php echo $row_utme['fee_id']; ?>">  
</td> <?php }else{ if($Fee_cat =="1"){$status = 'Not Paid';}else{
$status ="Not Paid"; //'<a rel="tooltip"  title="Click to Conutinue Payment" id="delete1" href="Spay_manage.php?view=m_sp&id='.md5($paysid).'" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus-circle icon-large" > Add Payment</i></a>';
}  ?>
														<td  style="text-align:center;">
           	<input id="optionsCheckbox"  class="uniform_on1" name="selector[]" type="checkbox" payamt="<?php echo $t_namount; ?>"   value="<?php echo $row_utme['fee_id']; ?>" <?php echo $check_c ;?> >    
													</td>
                                                    <input type='hidden' name='feetn[]' value='<?php echo $Fee_cat; ?>' />
													<?php } ?>
														<td   style="text-align:center;">
<?php echo $serial++ ; ?>
												</td>
						  <td><?php 
					if($statuspay > 0){
						echo "<font color='green'>".getftype($row_utme['feetype'])." ".$noteo." </font>   ";
						}else{echo "<font color='red'>".getftype($row_utme['feetype'])." ".$noteo."</font> ";}
					 ?></td>
					 <td><?php echo getprog($row_utme['program']); ?></td>
                          <td align='center'><?php echo getlevel($row_utme['level'],$student_prog); ?></td>
                         <td style="text-align:center;"><?php echo number_format($t_namount,2);//$row_utme['f_amount']; ?></td>	
							<td style="text-align:center;"><?php echo $status; ?></td> 		
					 </tr>
                    <?php  $sumcredit += $t_namount;  $pmt += $payamt;} 
                    if($pmt > $sumcredit){ $bal = "0.00";}else{ $bal = $sumcredit - $pmt; } 
                    $inst2 = getinstalment($sumcredit,$enableinst,$sumcredit); ?>
                   <!--	<strike>N</strike>	--!>			
			<?php if($bal > 0){ ?>				
    <tr class="row2">
    <input type="hidden" name="tp" value="<?php echo $sumcredit;?> " />
   <input type="hidden" name="tcp" value="<?php echo $nocomp; //echo  $ccomp;?> " />
    <td colspan="4" style="text-align:center;color: red;"> <?php if($enableinst > 1){ if($pmt > $inst2){}else{ if($Fee_cat !== "8"){?>Please Note that the Minimum Payment installment is <b><?php echo "&#8358; ".number_format($inst2,2)."</b> for $enableinst installments";}}} ?>
    </td><td colspan="1"><strong>Total Scheduled Payment </strong></td><td style="text-align:center;color:red;"><strong><span id="tots"> 
      <?php if($sumcredit > 0){ echo "&#8358; ".number_format($sumcredit,2);}else{echo "0.00";} ?></span></strong></td><td></td></tr>
      <tr class="row2">
    <td colspan="4"></td><td colspan="1"><strong>Total Amount Paid </strong></td><td style="text-align:center;color: green;"><strong>
      <?php if($pmt > 0){ echo "&#8358; ".number_format($pmt,2);}else{echo "0.00";} ?></strong></td><td></td></tr>
      <tr class="row2">
    <td colspan="4"></td><td colspan="1"><strong>Total Balance </strong></td><td style="text-align:center;"><strong> 
      <?php if($bal > 0){ echo "&#8358; ".number_format($bal,2);}else{echo "0.00";} ?></strong></td><td></td></tr> <?php }else{ if(empty($sumcredit)){ }else{ ?>
<tr><td colspan='9' style='text-align:centre;color:green;text-decoration: none;'><strong> ! You have Completed all your payment requirment for the <?php echo $default_session;?> session click <a href="#" onclick="window.location.href='Spay_manage.php';"> view payments </a> for details .</strong></td></tr>	
<?php } }?>
</tbody>
<div class="btn-group" id="ccc2" name="divButtons">
                  
                      	 </div>
                    </table>
                    
                    </form>
                    
                    
                    
                  </div>
                </div>
              </div>
     
                 
  