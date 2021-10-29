
<?php 
if($_SESSION['transide'] == ""){
redirect("Spay_manage.php?view=a_p");
}
$query_school= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row_sch = mysqli_fetch_array($query_school);
							  //$s_utme = $row_sch['p_utme'];
$paystatus1=mysqli_query($condb,"SELECT * FROM payment_tb WHERE trans_id ='".safee($condb,$_SESSION['transide'])."' ");
$paystatus12=mysqli_num_rows($paystatus1);
$payrecordv =mysqli_fetch_array($paystatus1); $transdate  = $payrecordv['pay_date']; $amountdue  = $payrecordv['dueamount'];
$feetype  = $payrecordv['fee_type']; $transref  = $payrecordv['trans_id']; $transession  = $payrecordv['session'];
$paymenttype  = $payrecordv['pay_mode']; $paydept  = $payrecordv['department']; $payregno  = $payrecordv['stud_reg']; 
$payemail  = $payrecordv['email']; $fee_cat  = $payrecordv['ft_cat'];

?>
<div class="x_panel">
                <!-- <form name="register2" action="https://voguepay.com/pay/" method="post" enctype="multipart/form-data" id="register2"> --!>
                <form name="register2" action="initialize.php" method="post" enctype="multipart/form-data" id="register2">
            <input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
			<input type='hidden' name='ft_cat' value='<?php echo $fee_cat;?>' /> <!-- 9919-0054594 --!>
			
			<input type='hidden' name='merchant_ref3' value='<?php echo $transref;?>' />
		<!--	<input type='hidden' name='notify_url' value='http://www.ucnettechnologies.net/notification.php' />
            <input type='hidden' name='success_url' value='https://64.71.77.20/SOMA/studregprint.php' />
             <input type='hidden' name='fail_url' value='http://www.ucnettechnologies.net/failed.php' />--!>
            <input type='hidden' name='emailx' value='<?php echo $payemail;?>' /> 
			<input type='hidden' name='total' value='<?php echo $amountdue ;?>' />
              <input type='hidden' name='matno' value='<?php echo $payregno;?>' />
            <input type='hidden' name='sec' value='<?php echo $transession;?>' />      
                      
                      <span class="section">Payment Transaction Summary</span>

                    <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
            <i class="fa fa-globe"></i> <?php echo $row_sch['SchoolName']; ?>
                                          <small class="pull-right"> <?php echo getftype($feetype)." Payment Summary " ;?></small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                           <strong><font color="darkblue"> Transaction Reference # </font> </strong>
                          <address>
                                          <strong>Transaction Id : </strong><?php echo $transref ; ?>
                                       
                                          <br><strong>Registration Number :</strong> <?php echo $payregno ; ?>
                                          
                                          <br><strong>Transaction Date :</strong><?php echo $transdate ; ?>
                                        
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                         <strong> <font color="darkblue">  Invoiced To </font> </strong>
                          <address>
                                          <strong><?php echo $user_row['FirstName']." ".$user_row['SecondName'];  ?></strong>
                                          <br><strong>Department :</strong> <?php echo getdeptc($student_dept) ; ?>
                                         
                                          <br><strong>Phone:</strong> <?php echo $user_row['phone'];  ?>
                                          <br><strong>Email:</strong> <?php echo $user_row['e_address'];  ?>
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b><font color="darkblue">Pay To </font></b>
                          <br> <?php echo $row_sch['SchoolName']; ?>
                          <br>
                          
                         
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">   
                            <thead>
                              <tr>
                                <th>S/N</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Session</th>
                                <th style="width: 40%">Payment Type</th>
                                
                              </tr>
                            </thead> 
                            <tbody>
 <?php if(substr($feetype,0,1) == "B"){ $paycomponent=mysqli_query($condb,"SELECT * FROM feecomp_tb  WHERE Batchno ='".safee($condb,$feetype)."' ");
$serial=1;		 while($row_utme = mysqli_fetch_array($paycomponent)){ $ftypecon = $row_utme['feetype']; $amount = $row_utme['f_amount'];
$paysession = $row_utme['session']; $feecategory = $row_utme['fcat']; $penalty = $row_utme['penalty']; if($penalty > 0){ $pens = " ( penalty inclusive).";}else{ $pens ="";} ?>
							<tr><td><?php echo $serial++ ; ?></td>
                                <td><?php echo "Payment Of " .getftype($ftypecon) ;?></td>
                                <td><!--<strike>N</strike>--!> &#8358;<?php echo " ".number_format($amount,2); ?></td>
                                <td><?php echo $paysession ;?></td>
                                <td> <?php echo getfeecat($feecategory).$pens ;?> </td></tr>
	<?php	}}else{  ?> 
						 <tr><td>1</td>
                                <td><?php echo "Payment Of " .getftype($feetype)." For ".$transession ;?></td>
                                 
                                <td><!--<strike>N</strike>--!> &#8358;<?php echo " ".number_format($amountdue,2); ?></td>
                                <td><?php echo $transession ;?></td>
                                <td> <?php echo getfeecat($feecategory).$pens ;?>
                                </td>
                              </tr><?php	}  ?>
                             <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                 
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;
                                </td>
                                
                              </tr>
                              
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                          <p class="lead">Payment Methods:</p>
                          <img src="../css/images/epaylogo.png" alt="Visa">
                          
                          
						  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                       <font color="red">    Please Confirm Your Payment Details Before You Proceed. </font>
                          </p>
                          
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead">Due Amount</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                              
                                <tr>
                                  <th>Tax (0.0%)</th>
                                  <td>&#8358; 0.00</td>
                                </tr>
                                
                                <tr>
                                  <th>Total:</th>
                                  <td><!--<strike>N</strike>--!><strong> &#8358;<?php echo " ".number_format($amountdue,2); ?></strong></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                           <button data-placement="right" title="Click Here To Exit Payment Receipt" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='Spay_manage.php?view=a_p';" type="reset"><i class="icon-signin icon-large"></i> Exit </button>
                          <button class="btn btn-success pull-right" title="Click to Make Payment" id="save" data-placement="left"><i class="fa fa-credit-card"></i> Submit Payment</button>
                  <!--    <button class="btn btn-primary pull-right" style="margin-right: 5px;" ><i class="fa fa-download"></i> Cancel Payment </button>  --!>
                  <!--    <a  rel='tooltip' href='uploadNow.php?file=<?php echo $file; ?>' id='submit'  class='btn btn-primary col-md-2' title='Click to Cancel Payment'><i class='fa fa-cancel'></i> Cancel Payment</i></a> --!>
                      <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                      </div>
                      
                    </section>
                    
                  </div>	</form>
                    
           
                  
          
    
                  </div>