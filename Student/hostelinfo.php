<script>

</script>
<?php 

//if( !isset( $_SESSION['transide'] ) || time() - $_SESSION['in_time'] > 1800){
//	redirect("shostel_manage.php?view=Hrequest");
//}
$query_school= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row_sch = mysqli_fetch_array($query_school);
							  //$s_utme = $row_sch['p_utme'];
$paystatus1=mysqli_query($condb,"SELECT * FROM hostelallot_tb WHERE studentreg ='".safee($condb,$student_RegNo)."'  ");
$paystatus12=mysqli_num_rows($paystatus1);
$payrecordv =mysqli_fetch_array($paystatus1); $hregdate  = $payrecordv['rdate']; $hamount  = $payrecordv['amount'];
 $transref  = $payrecordv['trans_id']; $transession  = $payrecordv['session'];
$paymenttype  = $payrecordv['pay_mode']; $paydept  = $payrecordv['dept']; $payregno  = $payrecordv['studentreg']; 
$payemail  = $payrecordv['email']; $hlevel  = $payrecordv['level']; $hduration  = $payrecordv['duration']; $hcode  = $payrecordv['h_code'];
$hroomno  = $payrecordv['roomno']; $hnob  = $payrecordv['no_of_bed']; $hftype  = $payrecordv['ftype']; $hprog  = $payrecordv['prog'];
 $allotdate  = $payrecordv['allotdate']; $expiredate  = $payrecordv['allotexpire']; $pstatush  = $payrecordv['paystatus']; 
 $validsth = $payrecordv['validity']; $allotstatus = $payrecordv['allotstatus'];
 $dayx = dayCount($expiredate);
 if(!is_positive_integer($dayx)){ $dayremain = "0"; }else{ $dayremain = $dayx;  }
 
 
     
?>
<div class="x_panel">
                <!-- <form name="register2" action="https://voguepay.com/pay/" method="post" enctype="multipart/form-data" id="register2"> --!>
                <form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
            <input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
			<input type='hidden' name='v_merchant_id' value='demo' /> <!-- 9919-0054594 --!>
			
			<input type='hidden' name='merchant_ref2' value='<?php echo $transref;?>' />
		<!--	<input type='hidden' name='notify_url' value='http://www.ucnettechnologies.net/notification.php' />
            <input type='hidden' name='success_url' value='https://64.71.77.20/SOMA/studregprint.php' />
             <input type='hidden' name='fail_url' value='http://www.ucnettechnologies.net/failed.php' />--!>
            <input type='hidden' name='emailx' value='<?php echo $payemail;?>' /> 
			<input type='hidden' name='total' value='<?php echo $hamount ;?>' />
                    
                     
                    
           
           				<div class="col-md-12">
					
						<div class="panel panel-default" id="print_content">
		<div class="panel-heading" style="color:blue;font-size:14px;padding: 9px 6px 9px 0px;"><b> Student Hostel Information </b></div>
							
							<div class="panel-body" > 
								<table id="zctb" class="table table-bordered " border="1" cellspacing="0" width="100%">
									
									
									<tbody>
<?php if($paystatus12 > 0){?>

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
<td><?php echo getlevel($hlevel,$student_prog);?></td>
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
<td colspan="6" style="font-size:13px; padding: 8px 6px 0px 0px;"><h4>Room Allocation Information</h4></td>

</tr >



<tr class="row2" style="font-size:12px;">
<td><b>Hostel Name  :</b></td>
<td><?php echo gethostel($hcode);?></td>
<td><b>Room No :</b></td>
<td><?php echo getroomno($hroomno);?></td>
<td><b>No of Bed  :</b></td>
<td><?php echo getnob($hroomno);?></td>
</tr>

<tr class="row1" style="font-size:12px;">
<td><b>Allotment Date  :</b></td>
<td><?php if($validsth > 0 ){ echo $allotdate;}else{ echo "-----------------";}?></td>
<td><b>Expiration Date :</b></td>
<td><?php if($validsth > 0 ){echo $expiredate; }else{ echo "-----------------";}?></td>
<td><b>Allotment Duration  :</b></td>
<td><?php if($hduration <=1){ echo $hduration." Month";}elseif($hduration > 0 and $hduration < 12){ echo $dr=$hduration; echo " Months";}elseif($hduration = 12 ){ echo "One Year";}
?></td>
</tr>

<tr class="row2" style="font-size:12px;">
<td><b>Request Date :</b></td>
<td><?php echo $hregdate;?></td>
<td><b>Hostel Fee:</b></td>
<td><strike>N</strike>
<?php if($hamount < 1){ echo "0.00" ;}else{ echo  number_format($hamount,2); }?></td>
<td><b>Payment Status:</b></td>
<td><?php  echo getpaystatus($pstatush); ?> </td>
</tr>
<?php if($pstatush > 0){ ?>
<tr class="row1" style="font-size:14px;">
<td colspan="6"><b>Transaction Reference. :<font color='green'><?php echo $transref;?></font>"</b></td>
</tr> <?php } ?>

<tr>
<td colspan="6" align="right" style="color:green;font-size:16px;"><?php if($validsth > 0 ){ ?><b>Validity Status  : 
<?php if($dayremain > 0 ){ echo "<font color='green'> <i class='fa fa-check'></i>"." Active"."</font>"; }else{ echo "<font color='red'><i class='fa fa-close'></i>"." Expired"." </font>";} }
 ?>


</td></b>
</tr>
<tr class="row1" >
<td colspan="6" class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                       <font color="red"> <?php if($validsth > 0 ){ echo diffMonthh($expiredate);}else{ echo " Please Note that a copy of this slip should be presented to admin after payment for approval and check in. ";} ?></font>
                          </td>

</tr>
<tr class="row1" id="cccv">

                          
<td colspan="6"> <a rel="tooltip"  href="javascript:void(0);" title="Print Details"  onClick="return Clickheretoprint();" class="btn btn-default"><i class="fa fa-print icon-large"> Print</i></a>


<button data-placement="right" title="Click Here To Exit Payment Receipt" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='shostel_manage.php?view=Hrequest';" type="reset"><i class="icon-signin icon-large"></i> Exit </button>
<?php if($dayremain < 1 ){
if($allotstatus > 0){ ?>
<a rel="tooltip"  href="javascript:void(0);" title="Click to Renew Your Room" id="save"  onClick="window.location.href='shostel_manage.php?view=Hrenew';" class="btn btn-success pull-right" data-placement="left" ><i class="fa fa-building">  Renew Room </i></a>
<?php }else{ if($pstatush < 1){ ?>
<a rel="tooltip"  href="javascript:void(0);" title="Click to Add Payment" id="save"  onClick="window.location.href='shostel_manage.php?view=Hrequest';" class="btn btn-success pull-right" data-placement="left" ><i class="fa fa-plus">  Add Payment</i></a>
<?php }}} ?>

</td>
</tr>



                      <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script>
                       
<?php
}else{ ?>

<tr class="row1" >
<td colspan="6" class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                       <font color="black">    No Hostel Information Found. </font>
                          </td>

</tr>
<tr class="row1" id="cccv">

                          
<td colspan="6">  


<button data-placement="right" title="Click Here To Apply for Hostel room" id="reset" name="B2" class="btn btn-success pull-right" onClick="window.location.href='shostel_manage.php?view=Hrequest';" type="reset"><i class="fa fa-plus icon-large"></i> Apply </button>



</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
          	</form>        
          
    
                  </div>