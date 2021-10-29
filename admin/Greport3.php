<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
if($class_ID > 0){}else{
                  message("ERROR:  No Programme Select,Please Select a Programme and continue.", "error");
		       redirect('new_apply.php?view=spro');
						}
$serial=1;
 $fcat =  isset($_REQUEST['fcat']) ? $_REQUEST['fcat'] : '';		
// $cati =  isset($_REQUEST['cat']) ? $_REQUEST['cat'] : '';
//$depart = isset($_REQUEST['xdp']) ? $_REQUEST['xdp'] : '';
$gsec= isset($_REQUEST['xsec']) ? $_REQUEST['xsec'] : '';
//$gdop=  isset($_REQUEST['xd1']) ? $_REQUEST['xd1'] : '';
//$gdop2= isset($_REQUEST['xd2']) ? $_REQUEST['xd2'] : '';
$plevel= isset($_REQUEST['xlev']) ? $_REQUEST['xlev'] : '';
//$origDate = $gdop; $origDate2 = $gdop2;
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
						<a 	href="javascript:void(0);" onClick="window.location.href='exportrpay1.php?xsec=<?php echo $gsec; ?>&xlev=<?php echo $plevel; ?>&fcat=<?php echo $fcat; ?>';" class="btn btn-info"  id="exp_excel" data-placement = "right" title="Click to export Payment Report to Excel Format" ><i class="fa fa-file-excel-o"></i>  Export Report</a>
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
//$date = str_replace('/', '-', $origDate );
//$newDate = date("Y-m-d", strtotime($date));

//$date2 = str_replace('/', '-', $origDate2 );
//$newDate2 = date("Y-m-d", strtotime($date2));

if(!empty($plevel)){ echo "<font size='5px'>General Payment Summary </font><br><font size='4px'>".$feename."</font><br>".getlevel($plevel,$class_ID)." ".$gsec." Academic Session  ";
 }else{ echo "<font size='5px'>General Payment Summary </font><br><font size='4px'>".$feename."</font><br> ".$gsec."  Academic Session ";}
?>
 </center></b></div>
                      <thead >
                        <tr style="background-color: gray; color: white;font-family:Verdana, Geneva, sans-serif;font-size:12px;">
<th>S/N</th><?php if($fcat == "3"){ ?><th>Applicant Name</th><th>Email</th><th>Phone</th><th>Other Type</th>
 <?php }else{ ?><th>Mat No</th><th>Name</th><th><?php echo $SGdept1; ?></th><th>Level</th> <?php } ?>
                         <!-- <th>Programme</th> --!>
                          <th>Session</th> <th>No of Installments</th><th>Schedule Fee</th><th>Amount Paid</th><th>Bal</th>
</tr>
                      </thead>
                      
                      
 <tbody>
                 <?php
 
$v_query = "select SUM(paid_amount) as pay_amt,count(stud_reg) as inscout,stud_reg,department,session,level,pay_status,ft_cat   from payment_tb where ft_cat = '".safee($condb,$fcat)."' AND prog = '".safee($condb,$class_ID)."' AND pay_status ='1'   "; 
 if(!empty($gsec)){$v_query .= " AND session ='".safee($condb,$gsec)."'";}
if(!empty($plevel)){$v_query .= " AND level = '".safee($condb,$plevel)."'";}
$v_query .= " GROUP BY stud_reg,department order by stud_reg ASC,department ASC";
$viewutme_query = mysqli_query($condb,$v_query)or die(mysqli_error($condb)); 
 $QP = "select SUM(paid_amount) from payment_tb where ft_cat = '".safee($condb,$fcat)."' AND prog = '".safee($condb,$class_ID)."' AND pay_status ='1' ";
if(!empty($gsec)){$QP .= " AND session ='".safee($condb,$gsec)."'";}
if(!empty($plevel)){$QP .= " AND level = '".safee($condb,$plevel)."'";}
$QP .= " ORDER by pay_date DESC";
$resultQP = mysqli_query($condb,$QP);
$vf_query = "select * from fshop_tb where  ftype = '".safee($condb,$class_ID)."' AND fpay_status ='1' "; 
if(!empty($gsec)){$vf_query .= " AND session ='".safee($condb,$gsec)."'";}
$vf_query .= " ORDER by fdate_paid DESC";
$viewform_query = mysqli_query($condb,$vf_query)or die(mysqli_error($condb)); 


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
while($row_utme = mysqli_fetch_array($viewutme_query)){ //$id = $row_utme['pay_id']; 
$i =0; $is_active = $row_utme['pay_status']; 
$student_reg = $row_utme['stud_reg']; 
$forderquery = mysqli_query($condb,"select pay_status,stud_cat,fee_type,ft_cat,app_no from payment_tb where pay_status > 0 and paid_amount > 0 and stud_reg = '$student_reg' ")or die(mysqli_error($condb));
$row_utme2 = mysqli_fetch_array($forderquery);
$stud_cat = $row_utme2['stud_cat']; $appno = $row_utme2['app_no'];$feetype =$row_utme2['fee_type'];
if(substr($feetype,0,1) == "B"){ $feet = getfeecat($row_utme2['ft_cat']);}else{ $feet = getftype($row_utme2['fee_type']);}
if($is_active == "1"){$amtn = $row_utme['pay_amt']; }else{ $amtn = "0.00"; }
if ($i%2) {$classo = 'row1';} else {$classo = 'row2';}$i += 1;
//get Sccheduled Fee
$qschedfee=mysqli_query($condb,"SELECT  *  FROM fee_db where  ft_cat = '".safee($condb,$fcat)."' and Cat_fee = '$stud_cat' and status ='1' and program ='".safee($condb,$class_ID)."' and level ='".safee($condb,$row_utme['level'])."' "); 
$get_amountin = mysqli_fetch_array($qschedfee);
if(empty($student_reg)){$mat2 =  $appno;}else{ $mat2 = $row_utme['stud_reg'];}  
$namount = getDueamt($fcat,$class_ID,$row_utme['level'],$stud_cat);
$currentbal = getpayamt($mat2,$fcat,$class_ID,$row_utme['level'],$row_utme['session']);
$nbal = $currentbal - $amtn;
$bal = $namount - $amtn;
//$countpay = mysqli_num_rows($forderquery);

?>     
                        <tr class="<?php echo $classo; ?>">
                        
												<td width="30"> <?php echo $serial++;?> </td>
						 
<td><?php echo $mat2; ?></td>
                          <td><?php if(empty($student_reg)){echo getappname($appno);}else{ echo getname($row_utme['stud_reg']);}
                           ?></td>
                          <td><?php echo getdeptc($row_utme['department']); ?></td>
                    <!--  <td><?php echo getprog($row_utme['prog']); ?></td> --!>
                      <td><?php echo getlevel($row_utme['level'],$class_ID); ?></td>
                       <td><?php echo ($row_utme['session']); ?></td>
                          <td><?php echo $row_utme['inscout']; ?></td>
                          <td><?php $namount; echo number_format($namount,2); //$feet; ?></td>
                         <td><?php echo number_format($row_utme['pay_amt'],2);//if($countpay > 0){ echo getpaystatus($row_utme['pay_status']);}else{echo getpaystatus("0");} ?></td>
						 <td><?php if($bal < 1){ echo "0.00";}else{echo number_format($namount - $amtn,2); } ?></td>					
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
					
<td><?php echo $fulname; ?></td>
                          <td><?php echo $email; ?></td>
                          <td><?php echo $phone; ?></td>
                    <!--  <td><?php echo getprog($row_utme['prog']); ?></td> --!>
                      <td><?php echo getftype($row_utme['feen']);  ?></td>
                       <td><?php echo ($row_utme['session']); ?></td>
                          <td><?php echo "-"; ?></td>
                          <td><?php $namount; echo number_format($namount,2); //$feet; ?></td>
                         <td><?php echo number_format($row_utme['fpamount'],2);//if($countpay > 0){ echo getpaystatus($row_utme['pay_status']);}else{echo getpaystatus("0");} ?></td>
						 <td><?php if($bal < 1){ echo "0.00";}else{echo $bal; } ?></td>					
						</tr><?php $tbal += $bal; $tdue += $namount; 
                         $tpaid += $row_utme['fpamount']; } ?>
                        
                             <?php } ?><tr class="<?php echo $classo; ?>">
                        <td colspan="8"><strong>Total </strong></td>
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