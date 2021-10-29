 <?php 
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
 if($class_ID > 0){}else{
                  message("ERROR:  No Programme Select,Please Select a Programme and continue.", "error");
		       redirect('new_apply.php?view=spro');
						}
$sreg = $_GET['sreg'];
$gsec=$_GET['xsec'];
$gdop= $_GET['xdop']; 
$plevel= $_GET['xlev'];
				$serial=1;			?>
 <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
           Student Payment Ledger <strong><?php //echo getprog($class_ID); ?></strong>. 
                  </div>
              
                   <!-- <form action="Delete_sapp.php" method="post"> --!>
                    <form action="" method="post"> <div  id="print_content">
<style type="text/css" media="print"> @media print { a[href]:after {content: none !important;}} @page {size: auto;margin: 0;}
.row1 {background-color: #EFEFEF;border: 1px solid #98C1D1; height: 30px;	font-family:Verdana, Geneva, sans-serif; font-size:12px; }
.row2 {background-color: #DEDEDE;border: 1px solid #98C1D1; height: 30px;font-family:Verdana, Geneva, sans-serif; font-size:12px; }
					  </style> 
                    <table id="datatable-responsive" class="table table-striped jambo_table bulk_action" cellspacing="0" width="100%" border="1">
                <!--    	<a data-placement="top" title="Click to Delete check item"   data-toggle="modal" href="#student_app" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
                    	&nbsp;&nbsp;&nbsp;  --!><div id="cccv" > 
								<a href="#" onclick="window.open('formSales.php?view=sledger','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-backward icon-large"></i> Go back</a>
							&nbsp;&nbsp;&nbsp;
						
								<a href="#" onClick="return Clickheretoprint();" class="btn btn-info"  id="delete2" data-placement="right" title="Click to preview select record" ><i class="fa fa-print icon-large"></i> Preview</a> </div>	<div	id="ccc2"></div>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
														<?php $existsop = imgExists($rowp['Logo']);//include('modal_delete.php'); ?>
<center><img width="100" height="70" id="Picture 1" src="   <?php  if ($existsop > 0 ){ print $rowp['Logo']; }else{ print "uploads/NO-IMAGE-AVAILABLE.jpg";} ?>  "  ></center>
										<h1 style="color:black;font-size:35px;text-shadow: 1px 0px #0000FF;" > <center> <?php echo $schoolNe ; ?></center></h1>
<div class="panel-heading" style="color:blue;font-size:15px;padding: 9px 6px 9px 0px;" id="ccc3"><b> <center>
<?php 
$sreg = $_GET['sreg'];
$gsec=$_GET['xsec'];
$gdop= $_GET['xdop']; 
$plevel= $_GET['xlev'];
$gdop2= $_GET['xd2']; //isset($_REQUEST['xd2']) ? $_REQUEST['xd2'] : '';
$origDate = $gdop;
$origDate2 = $gdop2;
 $date = str_replace('/', '-', $origDate );
$newDate = date("Y-m-d", strtotime($date));
$date2 = str_replace('/', '-', $origDate2 );
$newDate2 = date("Y-m-d", strtotime($date2));
$sdept = getDep($sreg);
if(empty($plevel)){ $prol = "";}else{ $prol = " [ ".getlevel($plevel,$class_ID)." ]";}
echo "<font size='5px'>Payment Ledger </font><br> ".getprog($class_ID)."   ".$prol." <br>".getdeptc($sdept)."<br>".ucwords(getname($sreg))." (".$sreg.")";
if(empty($gdop) && empty($gdop2)){ echo $secd = "";}else{ echo $secd = " <br> From ".$date." To ".$date2;}
?>
 </center></b></div>
                      <thead >
                        <tr style="background-color: gray; color: white;font-family:Verdana, Geneva, sans-serif;font-size:12px;">
                      
                         <th>S/N</th>
						 <th>Reference No</th>
                          <th>Name</th>
                           <th>Level</th>
                          <th>Payment Type</th>
                          <th>Session</th>
                         <th>Payment Date</th>
                           <th>Transaction Status</th>
                           <th>Schedule Fee<?php //echo $SGdept1; ?></th>
                           <th>Amount Paid</th>
                          <th>Balance</th>
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php
 $vquery = "select * from payment_tb where prog = '".safee($condb,$class_ID)."' and stud_reg = '".safee($condb,$sreg)."'   and pay_status = '1'  ";
if(!empty($gsec)){$vquery .= " AND session ='".safee($condb,$gsec)."'";}
if(!empty($plevel)){$vquery .= " AND level = '".safee($condb,$plevel)."'";}
if(!empty($gdop) && !empty($gdop2)){$vquery .= " AND pay_date BETWEEN '".safee($condb,$newDate)."' AND '".safee($condb,$newDate2)."'";}
$vquery .= " ORDER BY ft_cat ASC,pay_date DESC,session DESC limit 0,500";
$viewutme_query = mysqli_query($condb,$vquery)or die(mysqli_error($condb));
//if($gsec == Null and $gdop == null and $plevel == null ){
//$viewutme_query = mysqli_query($condb,"select * from payment_tb where prog = '".safee($condb,$class_ID)."' and stud_reg = '".safee($condb,$sreg)."'   and pay_status ='1' order by pay_date DESC limit 0,500 ")or die(mysqli_error($condb));
//$resultQP = mysqli_query($condb,"select SUM(paid_amount) from payment_tb where prog = '".safee($condb,$class_ID)."' and stud_reg = '".safee($condb,$sreg)."' and pay_status ='1' order by pay_date DESC limit 0,500 ");
//}elseif($gdop == null and $plevel == null ){ 
//$viewutme_query = mysqli_query($condb,"select * from payment_tb where prog = '".safee($condb,$class_ID)."' and stud_reg = '".safee($condb,$sreg)."'   and session ='".safee($condb,$gsec)."' and pay_status ='1' order by pay_date DESC limit 0,500 ")or die(mysqli_error($condb));
 //$resultQP = mysqli_query($condb,"select SUM(paid_amount) from payment_tb where prog = '".safee($condb,$class_ID)."' and stud_reg = '".safee($condb,$sreg)."' and session ='".safee($condb,$gsec)."' and pay_status ='1' order by pay_date DESC limit 0,500 ");
 //}elseif($gdop == null ){
 //$viewutme_query = mysqli_query($condb,"select * from payment_tb where prog = '".safee($condb,$class_ID)."' and stud_reg = '".safee($condb,$sreg)."'   and session ='".safee($condb,$gsec)."' and level = '".safee($condb,$plevel)."' and pay_status ='1' order by pay_date DESC limit 0,500 ")or die(mysqli_error($condb));
 //$resultQP = mysqli_query($condb,"select SUM(paid_amount) from payment_tb where prog = '".safee($condb,$class_ID)."' and stud_reg = '".safee($condb,$sreg)."'   and session ='".safee($condb,$gsec)."' and level = '".safee($condb,$plevel)."' and pay_status ='1' order by pay_date DESC limit 0,500 ");
//}else{ 
//$viewutme_query = mysqli_query($condb,"select * from payment_tb where prog = '".safee($condb,$class_ID)."' and stud_reg = '".safee($condb,$sreg)."'   and session ='".safee($condb,$gsec)."' and level = '".safee($condb,$plevel)."' and pay_date = '".safee($condb,$newDate)."' and pay_status ='1' order by pay_date DESC limit 0,500 ")or die(mysqli_error($condb)); 
// $resultQP = mysqli_query($condb,"select SUM(paid_amount) from payment_tb where prog = '".safee($condb,$class_ID)."' and stud_reg = '".safee($condb,$sreg)."'   and session ='".safee($condb,$gsec)."' and level = '".safee($condb,$plevel)."' and pay_date = '".safee($condb,$newDate)."' and pay_status ='1' order by pay_date DESC limit 0,500 ");
//}




$countrow = mysqli_num_rows($viewutme_query);
if($countrow < 1){
?>
<tr class="row1" >
<td colspan="12" class="text-muted well well-sm no-shadow" style="margin-top: 10px;"><font color="black"><strong>    No Payment Information Found.</strong> </font></td></tr>
<?php
}$bal = 0.00;
$tdue = 0.00;
$tbal = 0.00;
$tpaid = 0.00;$nbal = 0.00; $amtn = 0.00;
while($row_utme = mysqli_fetch_array($viewutme_query)){
$id = $row_utme['pay_id'];  $feetype = $row_utme['fee_type'];$is_active = $row_utme['pay_status'];
if(substr($feetype,0,1) == "B"){ $feet = getfeecat($row_utme['ft_cat']);}else{ $feet = getftype($row_utme['fee_type']);}
$fcat = $row_utme['ft_cat'];  
$student_reg = $row_utme['stud_reg'];$app_id = $row_utme['app_no'];$stud_cat = $row_utme['stud_cat'];
if(empty($student_reg)){$matn = $row_utme['app_no'];}else{ $matn = $row_utme['stud_reg'];}
 if($is_active == "1"){$amtn = $row_utme['paid_amount']; }else{ $amtn = "0.00"; }
//get Sccheduled Fee
$namount = getDueamt($fcat,$class_ID,$row_utme['level'],$stud_cat);
$currentbal = getpayamt($matn,$fcat,$class_ID,$row_utme['level'],$row_utme['session']);
$nbal = $currentbal - $amtn;
$bal = $namount - $nbal - $amtn;
if($bal < 1){ $nbal= "0.00";}else{ $nbal= number_format($bal,2); }
$i = 0;
if ($i%2) {$classo = 'row1';} else {$classo = 'row2';}$i += 1;
$forderquery = mysqli_query($condb,"select pay_status,paid_amount from payment_tb where pay_status > 0 and paid_amount > 0 and pay_id ='".safee($condb,$id)."'")or die(mysqli_error($condb));
$countpay = $row_utme['pay_status'];
?>     
<tr class="<?php echo $classo; ?>">
<td width="30"> <?php echo $serial++;?> </td>
<td> <?php 
if($countpay > 0){echo "<font color='green'>$row_utme[trans_id]</font>";}else{echo "<font color='red'>$row_utme[trans_id]</font>";} ?></td>
                          <td><?php echo ucwords(getname($row_utme['stud_reg'])); ?></td>
<td><?php echo getlevel($row_utme['level'],$class_ID); ?></td>
                          <td><?php echo $feet; ?></td>
                          <td><?php echo ($row_utme['session']); ?></td>
                          <td><?php echo $row_utme['pay_date']; ?></td>
<td><?php if($countpay > 0){ echo getpaystatus($row_utme['pay_status']);}else{echo getpaystatus("0");} ?></td>
<td><?php echo number_format($namount,2); ?></td>
						 <td><?php echo number_format($amtn,2);  ?></td>
                         <td><?php echo $nbal; ?></td>	</tr>
<?php  $tpaid += $amtn;  $tbal += $bal;  } ?>
                             <tr class="<?php echo $classo; ?>">
                        <td colspan="9"><strong>Total </strong></td>
                          <td width="15%" style="text-shadow: 1px 0px #0000FF; text-decoration-style: solid; font-weight: bold;">&#8358;
                          <?php  if($tpaid > 0){ echo " ".number_format($tpaid,2);}else{echo " 0.00";}  ?></td>
                   <td width="15%" style="text-shadow: 1px 0px #0000FF; text-decoration-style: solid; font-weight: bold;">&#8358;
                          <?php if($tbal > 0){ echo " ".number_format($tbal,2);}else{echo " 0.00";}  ?></td>
                   </tr>
                      </tbody>
                      
                      
                      	</form>
                      	
                      	
                    </table></div>