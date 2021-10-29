
 <?php 

 if($class_ID > 0){}else{
                  message("ERROR:  No Programme Select,Please Select a Programme and continue.", "error");
		       redirect('new_apply.php?view=spro');
						}
$searchp =  isset($_GET['q']) ? $_GET['q'] : '';
$sfcat =  isset($_GET['fc']) ? $_GET['fc'] : '';
$feename = getfeecat($sfcat);
				$serial=1;			?>
 <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button> <strong>
                    <?php  if($searchp == "wp1"){ echo "Weekly Report (s)" ;}if($searchp == "mp2"){
echo "Monthly Report (s)";}if($searchp == "qp3"){echo "Quaterly Report (s)";}if($searchp == "ap4"){echo "Annually Report (s)";} ?>
          <?php //echo getprog($class_ID); ?></strong>. 
                  </div>
              
                   <!-- <form action="Delete_sapp.php" method="post"> --!>
                    <form action="" method="post"> <div  id="print_content">
<style type="text/css" media="print"> @media print { a[href]:after {content: none !important;}} @page {size: auto;margin: 0;}
                .row1 {
	background-color: #EFEFEF; border: 1px solid #98C1D1;height: 30px;	font-family:Verdana, Geneva, sans-serif; font-size:12px; }
.row2 {background-color: #DEDEDE;border: 1px solid #98C1D1;height: 30px;font-family:Verdana, Geneva, sans-serif; font-size:12px; }
					  </style> 
                    <table id="datatable-responsive" class="table table-striped jambo_table bulk_action" cellspacing="0" width="100%" border="1">
                <!--    	<a data-placement="top" title="Click to Delete check item"   data-toggle="modal" href="#student_app" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
                    	&nbsp;&nbsp;&nbsp;  --!><div id="cccv" > 
								<a href="#" onclick="window.open('formSales.php?view=Reportmain','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-backward icon-large"></i> Go back</a>
							&nbsp;&nbsp;&nbsp;
						
								<a href="#" onClick="return Clickheretoprint();" class="btn btn-info"  id="delete2" data-placement="right" title="Click to preview select record" ><i class="fa fa-print icon-large"></i> Preview</a> </div>	<div	id="ccc2"></div>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
		<?php $existsop = imgExists($rowp['Logo']); //include('modal_delete.php'); ?>
	<center><img width="100" height="70" id="Picture 1" src="   <?php  if ($existsop > 0 ){ print $rowp['Logo']; }else{ print "uploads/NO-IMAGE-AVAILABLE.jpg";} ?>  "  ></center>
			<h2 style="color:black;font-size:35px;text-shadow: 1px 0px #0000FF;" > <center> <?php echo $schoolNe ; ?></center></h2>
<div class="panel-heading" style="color:blue;font-size:15px;padding: 9px 6px 9px 0px;" id="ccc3"><b> <center><font size='5px'>
<?php 
$sreg =  isset($_GET['sreg']) ? $_GET['sreg'] : '';
$gsec = isset($_GET['xsec']) ? $_GET['xsec'] : '';
$gdop=  isset($_GET['xdop']) ? $_GET['xdop'] : '';
$plevel= isset($_GET['xlev']) ? $_GET['xlev'] : '';

$origDate = $gdop;
 $date = str_replace('/', '-', $origDate );
$newDate = date("Y-m-d", strtotime($date));

if($searchp == "wp1"){ echo "Weekly Report (s) <br>".$feename; $col = "9"; $col2 = "11"; $col3 = "2";}if($searchp == "mp2"){
echo "Monthly Report (s)<br>".$feename;$col = "9";$col2 = "11";$col3 = "2";}if($searchp == "qp3"){echo "Quaterly Report (s) <br>".$feename;$col = "9";$col2 = "11";$col3 = "2";}if($searchp == "ap4"){echo "Annually Report (s)<br>".$feename;$col = "9";$col2 = "11";$col3 = "2";}
if($searchp == "ap5"){echo "Management Summary <br>".$feename;$col = "2";$col2 = "6";$col3 = "1";}
?>
</font> </center></b></div>
                      <thead >
                        <tr style="background-color: gray; color: white;font-family:Verdana, Geneva, sans-serif;font-size:12px;">
<th>S/N</th>
					<?php if($searchp == "ap5"){?>
                    <th><?php echo $SGdept1; ?></th><th>No Of Student</th><th>Total Expected (avg)</th><th>Total Payment</th><th>Total Bal</th>	
                    <?php }else{ if($sfcat == "3"){ ?><th>Reference No</th><th>Applicant Name</th>
                          <th>Email</th><th>Phone</th><th>Other Type</th><th>Session</th><th>Payment Date</th><th>Schedule Fee</th><th>Amount Paid</th> <th>Bal</th>
<?php }else{ ?>  <th>Reference No</th><th>Mat No</th><th>Name</th>
                          <th><?php echo $SGdept1; ?></th><th>Level</th><th>Session</th><th>Payment Date</th><th>Schedule Fee</th><th>Amount Paid</th> <th>Bal</th>
<?php } } ?>
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php
if($searchp == "wp1"){
$viewutme_query = mysqli_query($condb,"select * from payment_tb where session ='".safee($condb,$default_session)."' and ft_cat ='".safee($condb,$sfcat)."' and prog = '".safee($condb,$class_ID)."' and pay_date  >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) and pay_status ='1'  ORDER BY department ")or die(mysqli_error($condb));
$resultQP = mysqli_query($condb,"select SUM(paid_amount) from payment_tb where session ='".safee($condb,$default_session)."' and ft_cat ='".safee($condb,$sfcat)."' and prog = '".safee($condb,$class_ID)."' and pay_date  >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) and pay_status ='1'   ");
$viewform_query = mysqli_query($condb,"select * from fshop_tb where session ='".safee($condb,$default_session)."' and ftype = '".safee($condb,$class_ID)."' and fdate_paid  >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) and fpay_status ='1'")or die(mysqli_error($condb));
}elseif($searchp == "mp2" ){ 
$viewutme_query = mysqli_query($condb,"select * from payment_tb where session ='".safee($condb,$default_session)."' and ft_cat ='".safee($condb,$sfcat)."' and prog = '".safee($condb,$class_ID)."' and pay_date  >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) and pay_status ='1'  ORDER BY department ")or die(mysqli_error($condb));
$resultQP = mysqli_query($condb,"select SUM(paid_amount) from payment_tb where session ='".safee($condb,$default_session)."' and ft_cat ='".safee($condb,$sfcat)."' and prog = '".safee($condb,$class_ID)."' and pay_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) and pay_status ='1'   ");
$viewform_query = mysqli_query($condb,"select * from fshop_tb where session ='".safee($condb,$default_session)."' and ftype = '".safee($condb,$class_ID)."' and fdate_paid  >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) and fpay_status ='1' ")or die(mysqli_error($condb));
}elseif($searchp == "qp3"){
$viewutme_query = mysqli_query($condb,"select * from payment_tb where session ='".safee($condb,$default_session)."' and ft_cat ='".safee($condb,$sfcat)."' and prog = '".safee($condb,$class_ID)."' and pay_date  >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) and pay_status ='1'  ORDER BY department ")or die(mysqli_error($condb));
$resultQP = mysqli_query($condb,"select SUM(paid_amount) from payment_tb where session ='".safee($condb,$default_session)."' and ft_cat ='".safee($condb,$sfcat)."' and prog = '".safee($condb,$class_ID)."' and pay_date >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) and pay_status ='1'   ");
$viewform_query = mysqli_query($condb,"select * from fshop_tb where session ='".safee($condb,$default_session)."' and ftype = '".safee($condb,$class_ID)."' and fdate_paid  >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) and fpay_status ='1' ")or die(mysqli_error($condb));
}elseif($searchp == "ap5"){
 $viewutme_query = mysqli_query($condb,"select DISTINCT Department,COUNT(*) AS nofstud  from student_tb where Asession ='".safee($condb,$default_session)."' and  app_type = '".safee($condb,$class_ID)."'  GROUP BY Department ")or die(mysqli_error($condb));
 $viewform_query = mysqli_query($condb,"select DISTINCT feen,COUNT(*) AS nofstud  from fshop_tb where session ='".safee($condb,$default_session)."' and  ftype = '".safee($condb,$class_ID)."'  GROUP BY feen ")or die(mysqli_error($condb));
}else{ 
$viewutme_query = mysqli_query($condb,"select * from payment_tb where session ='".safee($condb,$default_session)."' and ft_cat ='".safee($condb,$sfcat)."' and prog = '".safee($condb,$class_ID)."' and pay_date  >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) and pay_status ='1'  ORDER BY department ")or die(mysqli_error($condb));
$resultQP = mysqli_query($condb,"select SUM(paid_amount)  from payment_tb where session ='".safee($condb,$default_session)."' and ft_cat ='".safee($condb,$sfcat)."' and prog = '".safee($condb,$class_ID)."' and pay_date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) and pay_status ='1' ORDER BY department   ");
$viewform_query = mysqli_query($condb,"select * from fshop_tb where session ='".safee($condb,$default_session)."'  and ftype = '".safee($condb,$class_ID)."' and fdate_paid  >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) and fpay_status ='1' ")or die(mysqli_error($condb));
}
if($sfcat == "3"){ $countrow = mysqli_num_rows($viewform_query);}else{ $countrow = mysqli_num_rows($viewutme_query); }
if($countrow < 1){
?>
<tr class="row1" >
<td colspan="12" class="text-muted well well-sm no-shadow" style="margin-top: 10px;"><font color="black"><strong>    No Payment Information Found.</strong> </font></td></tr>
<?php
}
$bal = "0.00"; $totalschedule = "0.00";
$texp = "0.00"; $tpayn = "0.00"; $finalbal = "0.00"; $stud = 0;
$nos = 0; $closebal = "0.00";
if($searchp !== "ap5"){
    if($sfcat !== "3"){
while($row_utme = mysqli_fetch_assoc($viewutme_query)){  $is_active = $row_utme['pay_status'];
$id = $row_utme['pay_id'];  $feetype = $row_utme['fee_type']; $student_reg = $row_utme['stud_reg']; $stud_cat = $row_utme['stud_cat'];
if(substr($feetype,0,1) == "B"){ $feet = getfeecat($row_utme['ft_cat']);}else{ $feet = getftype($row_utme['fee_type']);}
if(empty($row_utme['stud_reg'])){ $fulname = ucwords(getappname($row_utme['app_no']));}else{ $fulname = ucwords(getname($row_utme['stud_reg']));}
if(empty($student_reg)){$mat2 =  $row_utme['app_no'];}else{ $mat2 = $row_utme['stud_reg'];}
$namount = getDueamt($sfcat,$class_ID,$row_utme['level'],$stud_cat);
$currentbal = getpayamt($mat2,$sfcat,$class_ID,$row_utme['level'],$row_utme['session']);
if($is_active == "1"){$amtn = $row_utme['paid_amount']; }else{ $amtn = "0.00"; }
$nbal = $currentbal - $amtn;
$bal = $namount - $nbal - $amtn;
$i = 0;

if ($i%2) {$classo = 'row1';} else {$classo = 'row2';}$i += 1;
$forderquery = mysqli_query($condb,"select pay_status,paid_amount from payment_tb where pay_status > 0 and paid_amount > 0 and pay_id ='".safee($condb,$id)."'")or die(mysqli_error($condb));
//$countpay = $row_utme['trans_id'];
$countpay = mysqli_num_rows($forderquery);
?>     
                        <tr class="<?php echo $classo; ?>">
                        	<td width="30"><?php echo $serial++;?></td>
<td width="30"> <?php if($countpay > 0){echo "<font color='green'>$row_utme[trans_id]</font>";}else{echo "<font color='red'>$row_utme[trans_id]</font>";} ?> </td>
<td> <?php echo $mat2; ?> </td>
<td><?php if(empty($student_reg)){echo getappname($row_utme['app_no']);}else{ echo getname($row_utme['stud_reg']);} ?></td>
                          <td><?php echo getdeptc($row_utme['department']); ?></td>
                          <td><?php echo getlevel($row_utme['level'],$class_ID); ?></td>
                      <td><?php echo ($row_utme['session']); ?></td>
                      <td><?php echo $row_utme['pay_date']; ?></td>
                          <td><?php $namount; echo number_format($namount,2); //echo $feet; ?></td>
                          <td><?php echo number_format($row_utme['paid_amount'],2); ?></td>
                          <td><?php if($bal < 1){ echo "0.00";}else{echo $bal; } ?></td>
                         <td style="display: none;"><?php //if($countpay > 0){ echo getpaystatus($row_utme['pay_status']);}else{echo getpaystatus("0");} ?></td>
						 	</tr>
                     <?php $tpayn += $row_utme['paid_amount']; $finalbal += $bal; }
                     }else{  while($row_utme = mysqli_fetch_assoc($viewform_query)){ ?>
                      <?php $is_active = $row_utme['fpay_status'];
 $email = $row_utme['femail']; $phone = $row_utme['fphone'];
$fulname = ucwords($row_utme['fsname']." ".$row_utme['foname']);
$namount = $row_utme['famount'];
if($is_active == "1"){$amtn = $row_utme['fpamount']; }else{ $amtn = "0.00"; }
$bal = $namount -  $amtn;
$i = 0;
if ($i%2) {$classo = 'row1';} else {$classo = 'row2';}$i += 1;
?>     
                        <tr class="<?php echo $classo; ?>">
                        	<td width="30"><?php echo $serial++;?></td>
<td width="30"> <?php if($is_active > 0){echo "<font color='green'>$row_utme[ftrans_id]</font>";}else{echo "<font color='red'>$row_utme[ftrans_id]</font>";} ?> </td>
<td> <?php echo $fulname; ?> </td><td><?php echo $email; ?></td><td><?php echo $phone; ?></td>
                          <td><?php echo getftype($row_utme['feen']); ?></td>
                       <td><?php echo ($row_utme['session']); ?></td>
                      <td><?php echo $row_utme['fdate_paid']; ?></td>
                          <td><?php $namount; echo number_format($namount,2); ?></td>
                          <td><?php echo number_format($row_utme['fpamount'],2); ?></td>
                          <td><?php if($bal < 1){ echo "0.00";}else{echo $bal; } ?></td>
                         <td style="display: none;"><?php //if($countpay > 0){ echo getpaystatus($row_utme['pay_status']);}else{echo getpaystatus("0");} ?></td>
						 	</tr> <?php $tpayn += $row_utme['fpamount']; $finalbal += $bal; $totalschedule += $row_utme['famount']; } }
                            
                     }else{ while($row_utme = mysqli_fetch_assoc($viewutme_query)){ $stud = $row_utme['nofstud']; $dept = $row_utme['Department'];
                        $resultQP = mysqli_query($condb,"select SUM(paid_amount)  AS amt_paid from payment_tb where session ='".safee($condb,$default_session)."' and ft_cat ='".safee($condb,$sfcat)."' and department = '".safee($condb,$dept)."' and prog = '".safee($condb,$class_ID)."' and pay_status ='1' GROUP BY department  ");
$get_revgen = mysqli_fetch_array($resultQP); $paidamount = $get_revgen['amt_paid']; //and session ='".safee($condb,$default_session)."'
$namount = Dueamt($sfcat,$class_ID,$default_session,$dept);
if($namount < 1 and $paidamount < 1 ){ $balance = "0.00"; }else{ $balance = $namount - $paidamount ;}
if($balance < 1){$bal = "0.00";}else{ $bal = $balance; }
                        $i = 0; if ($i%2) {$classo = 'row1';} else {$classo = 'row2';}$i += 1;
                        ?>
                        
                         <tr class="<?php echo $classo; ?>">
<td width="30"> <?php echo $serial++;?> </td>
					
                          <td><?php echo getdeptc($row_utme['Department']); ?></td>
                      <td><?php echo $stud; ?></td>
                      <td><?php echo number_format((double)$namount,2); ?></td>
<td><?php echo number_format($paidamount,2); ?></td>
						 <td><?php echo number_format($bal,2); ?></td>	</tr>
                   <?php $nos += $stud; $texp += (double)$namount; $tpayn += $paidamount; $finalbal += $bal; }} ?>
                   
                     
                             <tr class="<?php echo $classo; ?>">
                        <td colspan="<?php echo $col; ?>"><strong>Total </strong></td><?php if($searchp == "ap5"){ ?>
<td width="15%" style="text-shadow: 1px 0px #0000FF; text-decoration-style: solid; font-weight: bold;"> <?php echo $nos;  ?></td>
   <td width="15%" style="text-shadow: 1px 0px #0000FF; text-decoration-style: solid; font-weight: bold;">&#8358;<?php echo " ".number_format($texp,2); ?></td>
 <td width="15%" style="text-shadow: 1px 0px #0000FF; text-decoration-style: solid; font-weight: bold;">&#8358;<?php echo " ".number_format($tpayn,2);  ?></td>
 <td width="15%" style="text-shadow: 1px 0px #0000FF; text-decoration-style: solid; font-weight: bold;">&#8358; <?php echo " ".number_format($finalbal,2);  ?></td>
    <?php }else{ ?>
<td width="15%" style="text-shadow: 1px 0px #0000FF; text-decoration-style: solid; font-weight: bold;">&#8358;<?php echo " ".number_format($tpayn,2);  ?></td>
 <td width="15%" style="text-shadow: 1px 0px #0000FF; text-decoration-style: solid; font-weight: bold;">&#8358; <?php echo " ".number_format($finalbal,2);  ?></td>
    
    <?php } if($sfcat !== "3"){ $tdue = Dueamt($sfcat,$class_ID,$default_session); }else{ $tdue = $totalschedule; } $totalschedule; $closebal = $tdue - $tpayn ; ?>              
                   </tr>
                   
                   <tr class="<?php echo $classo; ?>" >
                   <td colspan="<?php echo $col2; ?>" style="text-align: center;font-size:18px;font-weight: bold;">&nbsp; Overall Payment Analysis</td>
                   </tr>
                   <tr class="<?php echo $classo; ?>" >
                  
<td colspan="<?php echo $col3; ?>"><strong>Total Scheduled Fee </strong></td>
                        <td colspan="<?php echo $col3; ?>"><strong>&#8358; <?php echo number_format((double)$tdue,2) ; ?> </strong></td>
                        <td colspan="<?php echo $col3; ?>"><strong>Total Amount Paid </strong></td>
                        <td colspan="<?php echo $col3; ?>"><strong>&#8358; <?php echo  number_format($tpayn,2) ; ?> </strong></td>
                        <td colspan="<?php echo $col3; ?>"><strong>Total UnPaid </strong></td>
                        <td colspan="1"><strong>&#8358; <?php echo number_format($closebal,2) ; ?> </strong></td>
                        </tr><tr class="<?php echo $classo; ?>" >
                        <td colspan="<?php echo $col3; ?>"><strong>Per Paid % </strong></td>
                        <td colspan="<?php echo $col3; ?>"><strong><?php echo $ppaid = get_percentage($tpayn,$tdue)." %"; ?> </strong></td>
                        <td colspan="<?php echo $col3; ?>"><strong>Per UnPaid % </strong></td>
                        <td colspan="<?php echo $col3; ?>"><strong><?php echo 100 - (double)$ppaid." %"; ?>  </strong></td>
                        </tr>
                      </tbody>
                      
                      
                      	</form>
                      	
                      	
                    </table></div>