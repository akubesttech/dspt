<script>

</script>
<?php 

if( !isset( $_SESSION['transide'] ) || time() - $_SESSION['in_time'] > 1800){
unset($_SESSION['transide']);
		redirect("shostel_manage.php?view=Hrequest");
}
$query_school= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row_sch = mysqli_fetch_array($query_school);
							  //$s_utme = $row_sch['p_utme'];
$paystatus1=mysqli_query($condb,"SELECT * FROM hostelallot_tb WHERE trans_id ='".safee($condb,$_SESSION['transide'])."' ");
$paystatus12=mysqli_num_rows($paystatus1);
$payrecordv =mysqli_fetch_array($paystatus1); $hregdate  = $payrecordv['rdate']; $hamount  = $payrecordv['amount'];
 $transref  = $payrecordv['trans_id']; $transession  = $payrecordv['session'];
 $paydept  = $payrecordv['dept']; $payregno  = $payrecordv['studentreg']; 
$payemail  = $payrecordv['email']; $hlevel  = $payrecordv['level']; $hduration  = $payrecordv['duration']; $hcode  = $payrecordv['h_code'];
$hroomno  = $payrecordv['roomno']; $hnob  = $payrecordv['no_of_bed']; $hftype  = $payrecordv['ftype']; $hprog  = $payrecordv['prog'];
 $payrec=mysqli_query($condb,"SELECT * FROM payment_tb WHERE trans_id ='".safee($condb,$_SESSION['transide'])."' ");
$payrecord2 =mysqli_fetch_array($payrec);  $fee_cat  = $payrecord2['ft_cat'];
?>
<div class="x_panel">
                <!-- <form name="register2" action="https://voguepay.com/pay/" method="post" enctype="multipart/form-data" id="register2"> --!>
                <form name="register2" action="hinitialize.php" method="post" enctype="multipart/form-data" id="register2">
            <input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
		<input type='hidden' name='ft_cat' value='<?php echo $fee_cat;?>' /> <!-- 9919-0054594 --!>
			
			<input type='hidden' name='merchant_ref2' value='<?php echo $transref;?>' />
		<!--	<input type='hidden' name='notify_url' value='http://www.ucnettechnologies.net/notification.php' />
            <input type='hidden' name='success_url' value='https://64.71.77.20/SOMA/studregprint.php' />
             <input type='hidden' name='fail_url' value='http://www.ucnettechnologies.net/failed.php' />--!>
            <input type='hidden' name='emailx' value='<?php echo $payemail;?>' /> 
			<input type='hidden' name='total' value='<?php echo $hamount ;?>' />
                    
                     	
                    
           
           				<div class="col-md-12">
					
						<div class="panel panel-default" id="print_content">
		<div class="panel-heading" style="color:blue;font-size:14px;padding: 9px 6px 9px 0px;"><b> Student Room Request Details</b></div>
							<div class="panel-body" > 
								<table id="zctb" class="table table-bordered " border="1" cellspacing="0" width="100%">
									
									
									<tbody>


<tr >
<td colspan="6" style="font-size:13px; padding: 8px 6px 0px 0px;"><h4>Personal / Academic Information </h4></td>
</tr>

<tr class="row2" style="font-size:12px;">
<td><b>Reg No. :</b></td>
<td><?php echo $payregno;?></td>
<td><b>Full Name :</b></td>
<td><?php echo $user_row['FirstName']." ".$user_row['SecondName']." ".$user_row['Othername'];  ?></td>
<td><b>Gender :</b></td>
<td><?php echo $user_row['Gender'];?></td>

</tr>


<tr class="row1" style="font-size:12px;">
<td><b>Programme :</b></td>
<td><?php echo getprog($hprog);?></td>
<td><b>Faculty/School :</b></td>
<td><?php echo getfacultyc($user_row['Faculty']);?></td>
<td><b>Department :</b></td>
<td><?php echo getdeptc($paydept);?></td>
</tr>


<tr class="row2" style="font-size:12px;">
<td><b>Level. :</b></td>
<td><?php echo getlevel($hlevel,$hprog);?></td>
<td><b>Session. :</b></td>
<td colspan="4"><?php echo ($transession);?></td>
</tr>
<!--
<tr>
<td><b>Guardian Contact No. :</b></td>
<td colspan="6"><?php //echo $row->guardianContactno;?></td>
</tr> --!>

<tr>
<td colspan="6" style="font-size:13px; padding: 8px 6px 0px 0px;"><h4>Contact Information</h4></td>
</tr>
<tr class="row2" style="font-size:12px;">
<td><b>Email :</b></td>
<td colspan="2"><?php echo $payemail;?></td>
<td><b>Contact No. :</b></td>
<td colspan="2"><?php echo $user_row['phone'];?></td>
</tr><tr class="row1" style="font-size:12px;">
<td><b>Postal Address</b></td>
<td colspan="2">
<?php echo $user_row['postal_address'];?><br />
</td>
<td><b>Contact Address</b></td>
<td colspan="2">
<?php echo $user_row['address'];?><br />

</td>
</tr>



<tr >
<td colspan="6" style="font-size:13px; padding: 8px 6px 0px 0px;"><h4>Room Request Information</h4></td>

</tr >
<tr class="row1" style="font-size:12px;">
<td colspan="6"><b>Transaction Reference. :<?php echo $transref;?></b></td>
</tr>



<tr class="row2" style="font-size:12px;">
<td><b>Hostel Name  :</b></td>
<td><?php echo gethostel($hcode);?></td>
<td><b>Room No :</b></td>
<td><?php echo getroomno($hroomno);?></td>
<td><b>No of Bed  :</b></td>
<td><?php echo getnob($hroomno);?></td>
</tr>

<tr class="row1" style="font-size:12px;">
<td><b>Request Date :</b></td>
<td><?php echo $hregdate;?></td>
<td><b>Room Fee Per Month:</b></td>
<td><strike>N</strike>
<?php if($hamount < 1){ echo "0.00" ;}else{ echo  number_format($hamount/$hduration,2); }?></td>
<td><b>Duration:</b></td>
<td><?php if($hduration <=1){ echo $hduration." Month";}elseif($hduration > 0 and $hduration < 12){ echo $dr=$hduration; echo " Months";}elseif($hduration = 12 ){ echo "One Year";} ?> </td>
</tr>

<tr>
<td colspan="6" align="right" style="color:green;font-size:14px;"><b>Payment Due Now  : 
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

<button data-placement="right" title="Click Here To Exit Payment Receipt" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='shostel_manage.php?view=Hrequest';" type="reset"><i class="icon-signin icon-large"></i> Exit </button>

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