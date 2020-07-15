
 <?php if($class_ID > 0){}else{
                  message("ERROR:  No Programme Select,Please Select a Programme and continue.", "error");
		       redirect('new_apply.php?view=spro');
						}
$gprog = $_GET['xpo'];
$gsec=$_GET['xsec'];
$gdop= $_GET['xdop']; 
				$serial=1;			?>
 <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
           Form Order transaction details <strong><?php //echo getprog($class_ID); ?></strong>. 
                  </div>
              
                   <!-- <form action="Delete_sapp.php" method="post"> --!>
                    <form action="" method="post"> <div  id="print_content">
<style type="text/css" media="print"> @media print { a[href]:after {content: none !important;}} @page {size: auto;margin: 0;}
					 
					  .row1 {
	background-color: #EFEFEF;
		border: 1px solid #98C1D1;
		height: 30px;	font-family:Verdana, Geneva, sans-serif; 
	font-size:12px; 
}

.row2 {
	background-color: #DEDEDE;
	border: 1px solid #98C1D1;
		height: 30px;
			font-family:Verdana, Geneva, sans-serif; 
	font-size:12px; 
}
					  </style> 
                    <table id="datatable-responsive" class="table table-striped jambo_table bulk_action" cellspacing="0" width="100%" border="1">
                <!--    	<a data-placement="top" title="Click to Delete check item"   data-toggle="modal" href="#student_app" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
                    	&nbsp;&nbsp;&nbsp;  --!><div id="cccv" > 
								<a href="#" onclick="window.open('formSales.php?view=formOrder','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-backward icon-large"></i> Go back</a>
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
										<h1> <center> <?php echo $schoolNe ; ?></center></h1>
<div class="panel-heading" style="color:blue;font-size:15px;padding: 9px 6px 9px 0px;" id="ccc3"><b> <center>
<?php 
//echo $gprog;
if(empty($gdop) and empty($gsec) and empty($gprog) ){ echo "Form Order Transaction Details For the past One Week.";}
if(!empty($gdop)){ echo "Form Order Transaction Details On ".$gdop." For ".$gsec." Session .";}
if(empty($gdop) and !empty($gsec) and !empty($gprog)){ echo" Form Order Transaction Details For ". getprog($gprog)." ".$gsec." Session .";}
?>
 </center></b></div>
                      <thead >
                        <tr style="background-color: gray; color: white;font-family:Verdana, Geneva, sans-serif;font-size:12px;">
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                         <th>S/N</th>
						 <th>Reference No</th>
                          <th>Applicant Name</th>
                          <th>Email</th>
                          <th>Mobile Number</th>
                          <th>Programme</th>
                          <th>Other Type</th>
                          <th>Session</th>
                         
                           <th>Amount Paid</th>
                           <th>Transaction Date</th>
                           <th>Transaction Status</th>
                          
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php


$origDate = $gdop;
 
$date = str_replace('/', '-', $origDate );
$newDate = date("Y-m-d", strtotime($date));

/*
if($gdop == Null){
$viewutme_query = mysqli_query($condb,"select * from fshop_tb where (ftype) = '".safee($condb,$gprog)."' and session = '".safee($condb,$gsec)."'  order by form_id DESC limit 0,1000 ")or die(mysqli_error($condb)); echo "no";
}else{ 
$viewutme_query = mysqli_query($condb,"select * from fshop_tb where (ftype) = '".safee($condb,$gprog)."' and session = '".safee($condb,$gsec)."'  and fdate_paid = '".safee($condb,$newDate)."' order by form_id DESC limit 0,1000 ")or die(mysqli_error($condb)); echo "yex";
//$viewutme_query = mysqli_query($condb,"select * from fshop_tb where md5(ftype) = '".safee($condb,$class_ID)."' and session = '".safee($condb,$default_session)."' and DATE(fdate_paid) > (CURDATE() - INTERVAL 5 DAY) order by form_id DESC limit 0,1000 ")or die(mysqli_error($condb)); 
} */
if($gprog=="" || $gsec == "" ){
$viewutme_query = mysqli_query($condb,"select * from fshop_tb where ftype = '".safee($condb,$class_ID)."' and session = '".safee($condb,$default_session)."' and  DATE(fdate_paid) > (CURDATE() - INTERVAL 7 DAY)  order by form_id DESC limit 0,1000 ")or die(mysqli_error($condb));

}elseif($gdop == Null){
$viewutme_query = mysqli_query($condb,"select * from fshop_tb where (ftype) = '".safee($condb,$gprog)."' and session = '".safee($condb,$gsec)."'  order by form_id DESC limit 0,1000 ")or die(mysqli_error($condb)); 
}else{ 
$viewutme_query = mysqli_query($condb,"select * from fshop_tb where (ftype) = '".safee($condb,$gprog)."' and session = '".safee($condb,$gsec)."'  and fdate_paid = '".safee($condb,$newDate)."' order by form_id DESC limit 0,1000 ")or die(mysqli_error($condb));
//$viewutme_query = mysqli_query($condb,"select * from fshop_tb where md5(ftype) = '".safee($condb,$class_ID)."' and session = '".safee($condb,$default_session)."' and DATE(fdate_paid) > (CURDATE() - INTERVAL 5 DAY) order by form_id DESC limit 0,1000 ")or die(mysqli_error($condb)); 
}

while($row_utme = mysqli_fetch_array($viewutme_query)){
$id = $row_utme['form_id'];
$new_a_id = $row_utme['form_id'];
//$newstatus = $row_utme['verify_apply'];
if ($i%2) {$classo = 'row1';} else {$classo = 'row2';}$i += 1;
$forderquery = mysqli_query($condb,"select fpay_status,fpamount from fshop_tb where fpay_status > 0 and fpamount > 0 and form_id ='".safee($condb,$id)."'")or die(mysqli_error($condb));
$countpay = mysqli_num_rows($forderquery);
?>     
                        <tr class="<?php echo $classo; ?>">
                        	<td width="30">
                        	<?php if($countpay > 0){ ?>
				<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>" checked  >
												<?php }else{ ?>
				<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												<?php } ?>
												</td>
												<td width="30"> <?php echo $serial++;?> </td>
						  <td><a rel="tooltip"  title="View form Order Details" id="<?php echo $new_a_id; ?>" onclick="window.open('?details&userId=<?php echo $new_a_id;?>&xpo=<?php echo $gprog; ?>&xsec=<?php echo $gsec; ?>&xdop=<?php echo $gdop; ?>','_self')"
						  data-toggle="modal" class="btn btn-info"><i class=""> <?php 
if($countpay > 0){echo "<font color='green'>$row_utme[ftrans_id]</font>";}else{echo "<font color='red'>$row_utme[ftrans_id]</font>";} ?></i></a></td>
                          <td><?php echo $row_utme['fsname'].'  '.$row_utme['foname']; ?></td>
                          <td><?php echo $row_utme['femail']; ?></td>
                          <td><?php echo $row_utme['fphone']; ?></td>
                          <td><?php echo getprog($row_utme['ftype']); ?></td>
                          <td><?php echo getftype($row_utme['feen']); ?></td>
                          <td><?php echo ($row_utme['session']); ?></td>
                          <td><?php echo $row_utme['fpamount']; ?></td>
                          <td><?php echo ($row_utme['fdate_paid']); ?></td>
<td><?php if($countpay > 0){ echo getpaystatus($row_utme['fpay_status']);}else{echo getpaystatus("0");} ?></td>
											
												
                        </tr>
                     
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form>
                    </table></div>