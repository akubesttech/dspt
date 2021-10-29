<?php if($class_ID > 0){}else{
                  message("ERROR:  No Programme Select,Please Select a Programme and continue.", "error");
		       redirect('new_apply.php?view=spro');
						}
$serial=1;
 $fcat =  isset($_REQUEST['fcat']) ? $_REQUEST['fcat'] : '';		
 $cati =  isset($_REQUEST['cat']) ? $_REQUEST['cat'] : '';
$depart = isset($_REQUEST['xdp']) ? $_REQUEST['xdp'] : '';
$gsec= isset($_REQUEST['xsec']) ? $_REQUEST['xsec'] : '';
$gdop=  isset($_REQUEST['xd1']) ? $_REQUEST['xd1'] : '';
$gdop2= isset($_REQUEST['xd2']) ? $_REQUEST['xd2'] : '';
$plevel= isset($_REQUEST['xlev']) ? $_REQUEST['xlev'] : '';
$origDate = $gdop; $origDate2 = $gdop2;
$feename = getfeecat($fcat);
	?>
 <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          General Payment Report <strong><?php //echo getprog($class_ID); ?></strong>. 
                  </div>
              
                   <!-- <form action="Delete_sapp.php" method="post"> --!>
                    <form action="" method="post"> <div  id="print_content">
<style type="text/css" media="print"> @media print { a[href]:after {content: none !important;}} @page {size: auto;margin: 0;}
.row1 {background-color: #EFEFEF; border: 1px solid #98C1D1; height: 30px;	font-family:Verdana, Geneva, sans-serif; font-size:12px; }
.row2 { background-color: #DEDEDE; border: 1px solid #98C1D1;height: 30px;font-family:Verdana, Geneva, sans-serif; font-size:12px; }
					  </style> 
                    <table id="datatable-responsive" class="table table-striped jambo_table bulk_action" cellspacing="0" width="100%" border="1">
                <!--    	<a data-placement="top" title="Click to Delete check item"   data-toggle="modal" href="#student_app" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
                    	&nbsp;&nbsp;&nbsp;  --!><div id="cccv" > 
								<a href="#" onclick="window.open('formSales.php?view=Reportmain','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-backward icon-large"></i> Go back</a>
							&nbsp;&nbsp;&nbsp;
						<a 	href="javascript:void(0);" onClick="window.location.href='exportrpay.php?xdp=<?php echo $depart; ?>&xsec=<?php echo $gsec; ?>&xd1=<?php echo $gdop; ?>&xd2=<?php echo $gdop2; ?>&xlev=<?php echo $plevel; ?>&cat=<?php echo $cati; ?>&fcat=<?php echo $fcat; ?>';" class="btn btn-info"  id="exp_excel" data-placement = "right" title="Click to export Payment Report to Excel Format" ><i class="fa fa-file-excel-o"></i>  Export Report</a>
								<a href="#" onClick="return Clickheretoprint();" class="btn btn-info"  id="delete2" data-placement="right" title="Click to preview select record" ><i class="fa fa-print icon-large"></i> Preview</a> </div>	<div	id="ccc2"></div>
									<script type="text/javascript">
$(document).ready(function(){ $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
$('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');});
									</script>
										<?php $existsop = imgExists($rowp['Logo']);//include('modal_delete.php'); ?>
<center><img width="100" height="70" id="Picture 1" src="   <?php  if ($existsop > 0 ){ print $rowp['Logo']; }else{ print "uploads/NO-IMAGE-AVAILABLE.jpg";} ?>  "  ></center>
<h3 style="color:black;font-size:25px;text-shadow: 1px 0px #0000FF;" > <center> <?php echo $schoolNe ; ?></center></h3>
<h3 style="color:black;font-size:15px;text-shadow: 1px 0px #0000FF;padding-bottom: -160px;" > <center> <?php echo strtoupper(getprog($class_ID)) ; ?></center></h3>
<div class="panel-heading" style="color:blue;font-size:15px;padding: 0px 2px 2px 0px;" id="ccc3"><b> <center>
<?php 
$date = str_replace('/', '-', $origDate );
$newDate = date("Y-m-d", strtotime($date));

$date2 = str_replace('/', '-', $origDate2 );
$newDate2 = date("Y-m-d", strtotime($date2));

if($cati== "1"){ echo "<font size='5px'>General Payment Report  </font><br><font size='4px'>".$feename."</font><br> From ".($newDate)."  To ".$newDate2." ";}
elseif($cati== "2"){ echo "<font size='5px'>General Payment Report </font><br><font size='4px'>".$feename."</font><br> ".getdeptc($depart)." ".$SGdept1;}elseif($cati== "4"){ echo "<font size='5px'>General Payment Report </font><br><font size='4px'>".$feename."</font><br> ".getdeptc($depart)."<br>".getlevel($plevel,$class_ID)." ".$gsec." Academic Session  ";}else{ echo "<font size='5px'>General Payment Report </font><br><font size='4px'>".$feename."</font><br> ".$gsec."  Academic Session ";}
?>
 </center></b></div>
                      <thead >
                        <tr style="background-color: gray; color: white;font-family:Verdana, Geneva, sans-serif;font-size:12px;">
<th>S/N</th><th>Reference No</th><?php if($fcat == "3"){ ?><th>Applicant Name</th><th>Email</th><th>Phone</th><th>Other Type</th>
 <?php }else{ ?><th>Mat No</th><th>Name</th><th><?php echo $SGdept1; ?></th><th>Level</th> <?php } ?>
                         <!-- <th>Programme</th> --!>
                          <th>Session</th> <th>Payment Date</th><th>Schedule Fee</th><th>Amount Paid</th><th>Bal</th>
</tr>
                      </thead>
                      
                      
 <tbody>
                 <?php
if($cati== "1"){
$viewutme_query = mysqli_query($condb,"select * from payment_tb where ft_cat = '".safee($condb,$fcat)."' and prog = '".safee($condb,$class_ID)."' and pay_date BETWEEN '".safee($condb,$newDate)."' and '".safee($condb,$newDate2)."' and pay_status ='1' order by pay_date DESC,department ASC limit 0,1000 ")or die(mysqli_error($condb));
$resultQP = mysqli_query($condb,"select SUM(paid_amount) from payment_tb where ft_cat = '".safee($condb,$fcat)."' and prog = '".safee($condb,$class_ID)."' and pay_date BETWEEN '".safee($condb,$newDate)."' and '".safee($condb,$newDate2)."' and pay_status ='1' order by pay_date DESC limit 0,1000 ");
$viewform_query = mysqli_query($condb,"select * from fshop_tb where  ftype = '".safee($condb,$class_ID)."' and fdate_paid BETWEEN '".safee($condb,$newDate)."' and '".safee($condb,$newDate2)."' and fpay_status ='1' order by fdate_paid DESC limit 0,1000 ")or die(mysqli_error($condb));
}elseif($cati== "2" ){ 
$viewutme_query = mysqli_query($condb,"select * from payment_tb where ft_cat = '".safee($condb,$fcat)."' and prog = '".safee($condb,$class_ID)."' and department = '".safee($condb,$depart)."' and session ='".safee($condb,$gsec)."' and pay_status ='1' order by pay_date DESC,department ASC ")or die(mysqli_error($condb));
 $resultQP = mysqli_query($condb,"select SUM(paid_amount) from payment_tb where ft_cat = '".safee($condb,$fcat)."' and prog = '".safee($condb,$class_ID)."'  and department = '".safee($condb,$depart)."' and session ='".safee($condb,$gsec)."' and pay_status ='1' order by pay_date DESC ");
 $viewform_query = mysqli_query($condb,"select * from fshop_tb where ftype = '".safee($condb,$class_ID)."'  and session ='".safee($condb,$gsec)."' and fpay_status ='1' order by fdate_paid DESC ")or die(mysqli_error($condb));
 }elseif($cati== "4"){
 $viewutme_query = mysqli_query($condb,"select * from payment_tb where ft_cat = '".safee($condb,$fcat)."' and prog = '".safee($condb,$class_ID)."' and department = '".safee($condb,$depart)."' and session ='".safee($condb,$gsec)."' and level = '".safee($condb,$plevel)."' and pay_status ='1' order by pay_date DESC,department ASC,level ASC ")or die(mysqli_error($condb));
 $resultQP = mysqli_query($condb,"select SUM(paid_amount) from payment_tb where ft_cat = '".safee($condb,$fcat)."' and prog = '".safee($condb,$class_ID)."' and department = '".safee($condb,$depart)."' and session ='".safee($condb,$gsec)."' and level = '".safee($condb,$plevel)."' and pay_status ='1' order by pay_date DESC ");
$viewform_query = mysqli_query($condb,"select * from fshop_tb where  ftype = '".safee($condb,$class_ID)."' and  session ='".safee($condb,$gsec)."' and  fpay_status ='1' order by fdate_paid DESC ")or die(mysqli_error($condb));
 }else{ 
$viewutme_query = mysqli_query($condb,"select * from payment_tb where ft_cat = '".safee($condb,$fcat)."' and prog = '".safee($condb,$class_ID)."' and session ='".safee($condb,$gsec)."' and pay_status ='1' order by pay_date DESC,department ASC ")or die(mysqli_error($condb)); 
 $resultQP = mysqli_query($condb,"select SUM(paid_amount) from payment_tb where ft_cat = '".safee($condb,$fcat)."' and prog = '".safee($condb,$class_ID)."' and session ='".safee($condb,$gsec)."' and pay_status ='1' order by pay_date DESC");
$viewform_query = mysqli_query($condb,"select * from fshop_tb where  ftype = '".safee($condb,$class_ID)."' and session ='".safee($condb,$gsec)."' and fpay_status ='1' order by fdate_paid DESC ")or die(mysqli_error($condb)); 
 }
 if($fcat == "3"){ $countrow = mysqli_num_rows($viewform_query);}else{ $countrow = mysqli_num_rows($viewutme_query); }
if($countrow < 1){
?>
<tr class="row1" >
<td colspan="12" class="text-muted well well-sm no-shadow" style="margin-top: 10px;"><font color="black"><strong>    No Payment Information Found.</strong> </font></td></tr>
<?php
}
$bal = 0.00;
$tdue = 0.00;
$tbal = 0.00;
$tpaid = 0.00;
$namount = 0.00;$nbal = 0.00;
  if($fcat !== "3"){
while($row_utme = mysqli_fetch_array($viewutme_query)){ 
$id = $row_utme['pay_id']; $i =0; $feetype =$row_utme['fee_type'];$is_active = $row_utme['pay_status']; 
$student_reg = $row_utme['stud_reg']; $stud_cat = $row_utme['stud_cat']; //$paidamt = $row_utme['paid_amount'];
if(substr($feetype,0,1) == "B"){ $feet = getfeecat($row_utme['ft_cat']);}else{ $feet = getftype($row_utme['fee_type']);}
if($is_active == "1"){$amtn = $row_utme['paid_amount']; }else{ $amtn = "0.00"; }
if ($i%2) {$classo = 'row1';} else {$classo = 'row2';}$i += 1;
$forderquery = mysqli_query($condb,"select pay_status,paid_amount from payment_tb where pay_status > 0 and paid_amount > 0 and pay_id ='".safee($condb,$id)."'")or die(mysqli_error($condb));
//get Sccheduled Fee
$qschedfee=mysqli_query($condb,"SELECT  *  FROM fee_db where  ft_cat = '".safee($condb,$fcat)."' and Cat_fee = '$stud_cat' and status ='1' and program ='".safee($condb,$class_ID)."' and level ='".safee($condb,$row_utme['level'])."' "); 
$get_amountin = mysqli_fetch_array($qschedfee);
if(empty($student_reg)){$mat2 =  $row_utme['app_no'];}else{ $mat2 = $row_utme['stud_reg'];}  
$namount = getDueamt($fcat,$class_ID,$row_utme['level'],$stud_cat);
$currentbal = getpayamt($mat2,$fcat,$class_ID,$row_utme['level'],$row_utme['session']);
$nbal = $currentbal - $amtn;
$bal = $namount - $nbal - $amtn;
$countpay = mysqli_num_rows($forderquery);

?>     
                        <tr class="<?php echo $classo; ?>">
                        
												<td width="30"> <?php echo $serial++;?> </td>
						  <td> <?php 
if($countpay > 0){echo "<font color='green'>$row_utme[trans_id]</font>";}else{echo "<font color='red'>$row_utme[trans_id]</font>";} ?></td>
<td><?php echo $mat2; ?></td>
                          <td><?php if(empty($student_reg)){echo getappname($row_utme['app_no']);}else{ echo getname($row_utme['stud_reg']);}
                           ?></td>
                          <td><?php echo getdeptc($row_utme['department']); ?></td>
                    <!--  <td><?php echo getprog($row_utme['prog']); ?></td> --!>
                      <td><?php echo getlevel($row_utme['level'],$class_ID); ?></td>
                       <td><?php echo ($row_utme['session']); ?></td>
                          <td><?php echo $row_utme['pay_date']; ?></td>
                          <td><?php $namount; echo number_format($namount,2); //$feet; ?></td>
                         <td><?php echo number_format($row_utme['paid_amount'],2);//if($countpay > 0){ echo getpaystatus($row_utme['pay_status']);}else{echo getpaystatus("0");} ?></td>
						 <td><?php if($bal < 1){ echo "0.00";}else{echo $bal; } ?></td>					
						</tr><?php $tbal += $bal; $tdue += $namount; } }else{ ?>
                      <?php  while($row_utme = mysqli_fetch_array($viewform_query)){ 
 $i =0; $is_active = $row_utme['fpay_status'];
 $email = $row_utme['femail']; $phone = $row_utme['fphone'];
$fulname = ucwords($row_utme['fsname']." ".$row_utme['foname']);
$namount = $row_utme['famount'];
if($is_active == "1"){$amtn = $row_utme['fpamount']; }else{ $amtn = "0.00"; }
$bal = $namount -  $amtn;
if ($i%2) {$classo = 'row1';} else {$classo = 'row2';}$i += 1;
?>     
                        <tr class="<?php echo $classo; ?>">
                        
												<td width="30"> <?php echo $serial++;?> </td>
						  <td> <?php 
if($is_active > 0){echo "<font color='green'>$row_utme[ftrans_id]</font>";}else{echo "<font color='red'>$row_utme[ftrans_id]</font>";} ?></td>
<td><?php echo $fulname; ?></td>
                          <td><?php echo $email; ?></td>
                          <td><?php echo $phone; ?></td>
                    <!--  <td><?php echo getprog($row_utme['prog']); ?></td> --!>
                      <td><?php echo getftype($row_utme['feen']);  ?></td>
                       <td><?php echo ($row_utme['session']); ?></td>
                          <td><?php echo $row_utme['fdate_paid']; ?></td>
                          <td><?php $namount; echo number_format($namount,2); //$feet; ?></td>
                         <td><?php echo number_format($row_utme['fpamount'],2);//if($countpay > 0){ echo getpaystatus($row_utme['pay_status']);}else{echo getpaystatus("0");} ?></td>
						 <td><?php if($bal < 1){ echo "0.00";}else{echo $bal; } ?></td>					
						</tr><?php $tbal += $bal; $tdue += $namount; 
                         $tpaid += $row_utme['fpamount']; } ?>
                        
                             <?php } ?><tr class="<?php echo $classo; ?>">
                        <td colspan="9"><strong>Total </strong></td>
                          <td style="text-shadow: 1px 0px #0000FF; text-decoration-style: solid; font-weight: bold;display: none;">&#8358; <?php echo number_format($tdue,2) ; ?></td>
                          <td width="15%" style="text-shadow: 1px 0px #0000FF; text-decoration-style: solid; font-weight: bold;">&#8358;
                          <?php if($fcat !== "3"){ while($get_qp = mysqli_fetch_row($resultQP))
 { foreach ($get_qp as $sumqp) if($sumqp > 0){ echo $tpaid = " ".number_format($sumqp,2);}else{echo $tpaid = " 0.00";}} }else{ echo number_format($tpaid,2); }  ?></td>
  <td style="text-shadow: 1px 0px #0000FF; text-decoration-style: solid; font-weight: bold;">&#8358; <?php if($tbal < 1){ echo "0.00";}else{echo number_format($tbal,2); }  ?></td>
                   </tr>
                      <tr class="<?php echo $classo; ?>" style="display: none;">
                        <td colspan="1"></td>
                        <td colspan="1"><strong>Total Scheduled Fee </strong></td>
                        <td colspan="1"><strong>&#8358; <?php echo number_format($tdue,2) ; ?> </strong></td>
                        <td colspan="1"><strong>Total Amount Paid </strong></td>
                        <td colspan="1"><strong>&#8358; <?php echo $tpaid ; ?> </strong></td>
                        <td colspan="1"><strong>Total UnPaid </strong></td>
                        <td colspan="1"><strong>&#8358; <?php echo number_format($tbal,2) ; ?> </strong></td>
                        <td colspan="1"><strong>Per Paid % </strong></td>
                        <td colspan="1"><strong>0.00 </strong></td>
                        <td colspan="1"><strong>Per UnPaid % </strong></td>
                        <td colspan="1"><strong>0.00 </strong></td>
                        </tr>
                      </tbody>
                      
                      
                      	</form>
                      	
                      	
                    </table></div>