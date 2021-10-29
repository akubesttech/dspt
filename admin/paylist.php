<p class="text-muted font-13 m-b-30">
                  
                    </p>
                  <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
           This Page will Enable Admin To View and Confirm Student Payment. 
                  </div>
                  
                    <form action="Delete_pay.php" method="post">
                  <!-- <table id="datatable-buttons" class="table table-striped table-bordered"> --!>
                    <table  id="datatable-responsive" class="table table-striped table-bordered">
                     <?php //if($admin_accesscheck==1){ ?>
                     <?php if($Rorder == 1 ){ //if (authorize($_SESSION["access3"]["fIn"]["conp"]["delete"])){ ?> 
                    	<a data-placement="top" title="Click to Delete check item"   data-toggle="modal" href="#delete_payment" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a> <?php } ?>
                        <a 	href="javascript:void(0);" onClick="window.location.href='exportpay.php?Schd=<?php echo $dep1; ?>&session2=<?php echo $sec1; ?>&dop=<?php echo $los; ?>&dop2=<?php echo $edate; ?>';" class="btn btn-info"  id="exp_excel" data-placement = "right" title="Click to export Payment records to Excel Format" ><i class="fa fa-file-excel-o"></i>  Export Payment(s)</a>
<a rel="tooltip"  title="Click to Go Back" id="<?php echo $new_a_id; ?>"  onclick="window.open('View_Payment.php?view=s_p','_self')" data-toggle="modal" class="btn btn-info"><i class="fa fa-arrow-left"> Go Back</i></a>
                    	&nbsp;&nbsp;&nbsp;
							<!--	<a href="new_apply.php?view=imp_a" class="btn btn-info"  id="delete2" data-placement="right" title="Click to import Student UTME Exam Result" ><i class="fa fa-file icon-large"></i> Import Data</a> --!>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                         <th>Transaction ID </th>
                         <th>Reg/Mat No</th>
                          <th>Full Name</th>
                          <th>Fee Type</th>
                          <th><?php echo $SGdept1; ?></th>
                          <th>level</th>
                          <th>Session</th>
                          <th>Payment Mode</th>
                         <th>Date</th>
                         <th>Amount</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php
 $depart = $dep1;
 $session=$sec1;
//$dateofpay= $_GET['dop'];
$origDate = $los;
$origDate2 = $edate;
 $date = str_replace('/', '-', $origDate );
$dateofpay = date("Y-m-d", strtotime($date));
$date2 = str_replace('/', '-', $origDate2 );
$dateofpay2 = date("Y-m-d", strtotime($date2));
$total = 0;
//if($depart == "" AND $session == ""){
    //if(empty($depart) AND empty($session)){
//$viewutme_query = mysqli_query($condb,"select * from payment_tb WHERE  session = '".safee($condb,$default_session)."' AND prog = '".safee($condb,$class_ID)."' and  DATE(pay_date) > (CURDATE() - INTERVAL 7 DAY) order by pay_id DESC LIMIT 0,800")or die(mysqli_error($condb));
//}elseif($origDate == ""){ $viewutme_query = mysqli_query($condb,"select * from payment_tb WHERE department = '".safee($condb,$depart)."' AND session = '".safee($condb,$session)."' AND prog = '".safee($condb,$class_ID)."' order by pay_id ASC ")or die(mysqli_error($condb));
//}else{
//$viewutme_query = mysqli_query($condb,"select * from payment_tb WHERE department = '".safee($condb,$depart)."' AND session = '".safee($condb,$session)."' AND prog = '".safee($condb,$class_ID)."'  order by pay_id ASC ")or die(mysqli_error($condb));}

$vquery = "select * from payment_tb WHERE  prog = '".safee($condb,$class_ID)."'";
if(!empty($depart)){$vquery .= " AND department = '".safee($condb,$depart)."'";}
if(!empty($session)){$vquery .= " AND session = '".safee($condb,$session)."'";}
if(!empty($origDate) || !empty($origDate2)){$vquery .= " AND pay_date BETWEEN '".safee($condb,$dateofpay)."' AND '".safee($condb,$dateofpay2)."'";}
if(empty($session)){$vquery .= " AND session = '".safee($condb,$default_session)."' AND DATE(pay_date) > (CURDATE() - INTERVAL 7 DAY)";}
$vquery .= " order by pay_id DESC LIMIT 0,800";
$viewutme_query = mysqli_query($condb,$vquery)or die(mysqli_error($condb));

while($row_utme = mysqli_fetch_array($viewutme_query)){ include('toolttip_edit_delete.php'); 
$id = $row_utme['pay_id'];
$new_a_id = $row_utme['trans_id']; 
$is_active = $row_utme['pay_status'];$feetype = $row_utme['fee_type']; $dept23 = $row_utme['department']; 
$student_reg = $row_utme['stud_reg'];$app_id = $row_utme['app_no'];
if(substr($feetype,0,1) == "B"){ $feet = getfeecat($row_utme['ft_cat']);}else{ $feet = getftype($row_utme['fee_type']);}
?>     
<tr><td width="30"><input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
<td><a rel="tooltip" style="display: none;"  title="View Payment Details" id="<?php echo $id; ?>" class='clickable2-row'
onclick="window.open('?details&userId=<?php echo $new_a_id;?>&dept1_find=<?php echo $depart; ?>&session2=<?php echo $session; ?>&dop=<?php echo $origDate; ?>','_self')"
 data-toggle="modal"><?php 
if($row_utme['pay_status']=='1'){ echo "<font color='green'>$row_utme[trans_id]</font>";}else{ echo "<font color='red'>$row_utme[trans_id]</font>";} ?></a>

<a rel="facebox" href="pay_pop.php?userId=<?php echo $new_a_id;?>&dept1_find=<?php echo $depart; ?>&session2=<?php echo $session; ?>&dop=<?php echo $origDate; ?>" title="View Payment Details" id="<?php echo $id; ?>" class="btn btn-info"><i class=""><?php 
if($row_utme['pay_status']=='1'){ echo "<font color='green'>$row_utme[trans_id]</font>"; $amtn = $row_utme['paid_amount'];}else{ echo "<font color='red'>$row_utme[trans_id]</font>"; $amtn = "0.00";} ?></i></a>
</td>
					 <td><?php if(empty($student_reg)){echo $row_utme['app_no'];}else{ echo $row_utme['stud_reg'];} ?></td>
                          <td><?php if(empty($student_reg)){echo getappname($row_utme['app_no']);}else{ echo getname($row_utme['stud_reg']);} ?></td>
                        
                          <td><?php echo strtoupper($feet); ?></td>
<td><?php  echo getdeptc($row_utme['department']); ?></td>
                           <td><?php echo getlevel($row_utme['level'],$class_ID); ?></td>
                          <td><?php echo $row_utme['session']; ?></td>
                          <td><?php echo $row_utme['pay_mode']; ?></td>
                          <td><?php echo $row_utme['pay_date']; ?></td>
                          <td><?php echo $amtn;  ?></td>
                          
<td><?php if (authorize($_SESSION["access3"]["fIn"]["conp"]["edit"])){ if($Rorder == 1 || $Rorder == 2 || $Rorder == 8 ){ ?><a href="javascript:changePayStatus2(<?php echo $id; ?>, '<?php echo $is_active; ?>','<?php echo $dept23; ?>','<?php echo $session; ?>','<?php echo $origDate; ?>','<?php echo $origDate2; ?>');" class="btn btn-info" ><i class="fa fa-check"></i>&nbsp;<?php echo $is_active == '0'? 'Approve' : 'Decline'; ?></a> <?php } }else{ echo "-----"; }?></td>
                        </tr>
                     <?php  $total += $amtn;} ?>
                      </tbody>
 <tr>  <td colspan="10"><strong>Total :</strong></td> <td><strong><?php if($total > 0){ echo number_format($total,2); }else{ echo "0.00";} ?><strong></td><td colspan="1"></td> </tr>                    
                      
                      	</form>
                    </table>