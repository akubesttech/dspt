<script>

</script>
<?php 

if( !isset($_SESSION['transide'] ) || time() - $_SESSION['in_time'] > 1800){
unset($_SESSION['transide']);
		redirect("changeofcourse_m.php?view=capply");
}
$query_school= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row_sch = mysqli_fetch_array($query_school);
							  //$s_utme = $row_sch['p_utme'];
$paystatus1=mysqli_query($condb,"SELECT * FROM coc_tb WHERE trans_id ='".safee($condb,$_SESSION['transide'])."' ");
$paystatus12=mysqli_num_rows($paystatus1);
$payrecordv =mysqli_fetch_array($paystatus1);  $hamount  = $payrecordv['pamount'];
 $transref  = $payrecordv['trans_id']; 
 $payregno  = $payrecordv['c_matno']; 
$payemail  =  getsemail($payregno);
  $hprog  = $payrecordv['prog'];
 $nfac  = $payrecordv['n_fac']; $ndept  = $payrecordv['n_dept'];
 $ftype  = $payrecordv['ftype']; $pstart  = $payrecordv['pay_status'];
?>
<div class="x_panel">
                <!-- <form name="register2" action="https://voguepay.com/pay/" method="post" enctype="multipart/form-data" id="register2"> --!>
                <form name="register2" action="cinitialize.php" method="post" enctype="multipart/form-data" id="register2">
            <input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
			<input type='hidden' name='v_merchant_id' value='demo' /> <!-- 9919-0054594 --!>
			
			<input type='hidden' name='merchant_ref2' value='<?php echo $transref;?>' />
		
            <input type='hidden' name='emailx' value='<?php echo $payemail;?>' /> 
			<input type='hidden' name='total' value='<?php echo $hamount ;?>' />
                    
                     	
                    
           
           				<div class="col-md-12">
					
						<div class="panel panel-default" id="print_content">
		<div class="panel-heading" style="color:blue;font-size:14px;padding: 9px 6px 9px 0px;"><b> Student Change Of Course Details</b></div>
							<div class="panel-body" > 
								<table id="zctb" class="table table-bordered " border="1" cellspacing="0" width="100%">
									
									
									<tbody>


<tr >
<td colspan="6" style="font-size:13px; padding: 8px 6px 0px 0px;"><h4>Personal / Academic Information </h4></td>
</tr>

<tr class="row2" style="font-size:12px;">
<td><b>Mat No. :</b></td>
<td><?php echo $payregno;?></td>
<td><b>Full Name :</b></td>
<td><?php echo $user_row['FirstName']." ".$user_row['SecondName']." ".$user_row['Othername'];  ?></td>
<td><b>Programme :</b></td>
<td><?php echo getprog($hprog);?></td>

</tr>

<!--
<tr>
<td><b>Guardian Contact No. :</b></td>
<td colspan="6"><?php //echo $row->guardianContactno;?></td>
</tr> --!>

<tr>
<td colspan="6" style="font-size:13px; padding: 8px 6px 0px 0px;"><h4>Course Change Information</h4></td>
</tr>
<tr class="row2" style="font-size:12px;">
<td><b>Current <?php echo $SCategory; ?> :</b></td>
<td colspan="2"><?php echo getfacultyc($student_facut) ; ?></td>
<td><b>Current <?php echo $SGdept1; ?></b></td>
<td colspan="2"><?php echo getdeptc($student_dept) ; ?></td>
</tr>

<tr class="row1" style="font-size:12px;color:green">
<td><b>New <?php echo $SCategory; ?></b></td>
<td colspan="2">
<?php echo getfacultyc($nfac);?><br />
</td>
<td><b>New <?php echo $SGdept1; ?></b></td>
<td colspan="2">
<?php echo getdeptc($ndept);?><br />

</td>
</tr>



<tr >
<td colspan="6" style="font-size:13px; padding: 8px 6px 0px 0px;"><h4>Payment Information</h4></td>

</tr >
<tr class="row1" style="font-size:12px;">
<td colspan="6"><b>Transaction Reference. :<?php echo $transref;?></b></td>
</tr>



<tr class="row2" style="font-size:12px;">
<td><b>Payment Description  :</b></td>
<td><?php echo getftype($ftype);?></td>
<td><b>Pay Status :</b></td>
<td><?php echo getpaystatus($pstart);?></td>
<td><b>Date  :</b></td>
<td><?php echo $payrecordv['date'];?></td>
</tr>



<tr>
<td colspan="6" align="right" style="color:black;font-size:14px; padding: 8px 6px 0px 0px;"><b>Payment Due Now  : 
&#8358;<?php echo " ".number_format($hamount,2); ?></td></b>
</tr>
<tr class="row1" >
<td colspan="6" class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                       <font color="red">    Please Confirm Your Payment Details Before You Proceed. </font>
                          </td>

</tr>
<tr class="row1" id="cccv">
<td colspan="6"> 
<a rel="tooltip"  href="javascript:void(0);" title="Print Details"  onClick="return Clickheretoprint();" class="btn btn-default"><i class="fa fa-print icon-large"> Print</i></a>

<button data-placement="right" title="Click Here To Exit Payment Receipt" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='changeofcourse_m.php?view=capply';" type="reset"><i class="icon-signin icon-large"></i> Exit </button>

<button class="btn btn-success pull-right" title="Click to Make Payment" id="save" data-placement="left"><i class="fa fa-credit-card"></i> Make Payment</button>

</td>
</tr>
<div id="ccc2"></div>


                      <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script>
                       
<?php
//$cnt=$cnt+1;
//} ?>
</tbody>
</table>
</div>
</div>
</div>
      </form>            
          
    
                  </div>