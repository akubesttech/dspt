
<?php 
if($_GET['id'] == ""){
//echo "<script>alert('Access Not Granted To This User Please Contact System Administrator!');</script>";
		redirect("Spay_manage.php?view=a_p");
}
$query_school= mysql_query("select * from schoolsetuptd ")or die(mysql_error());
							  $row_sch = mysql_fetch_array($query_school);
							  //$s_utme = $row_sch['p_utme'];
$paystatus1=mysql_query("SELECT * FROM payment_tb WHERE trans_id ='".mysql_real_escape_string($_GET['id'])."' ");
$paystatus12=mysql_num_rows($paystatus1);
$payrecordv =mysql_fetch_array($paystatus1); $transdate  = $payrecordv['pay_date']; $amountdue  = $payrecordv['paid_amount'];
$feetype  = $payrecordv['fee_type']; $transref  = $payrecordv['trans_id']; $transession  = $payrecordv['session'];
$paymenttype  = $payrecordv['pay_mode']; $paydept  = $payrecordv['department']; $payregno  = $payrecordv['stud_reg'];
?>
<div class="x_panel">
                
          
                   <form  action="#" method="post" >
            <input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
		<!--	<input type='hidden' name='v_merchant_id' value='demo' /> 
			
			<input type='hidden' name='merchant_ref' value='<?php echo $transref;?>' />
			<input type='hidden' name='notify_url' value='http://www.ucnettechnologies.net/notification.php' />
            <input type='hidden' name='success_url' value='https://64.71.77.20/SOMA/studregprint.php' />
             <input type='hidden' name='fail_url' value='http://www.ucnettechnologies.net/failed.php' />
            <input type='hidden' name='memo' value='<?php echo $feetype;?>' />
			<input type='hidden' name='total' value='<?php echo $amountdue ;?>' /> --!>
                    
                   
                      <span class="section">Payment Transaction Response<?php
                                       


	//	echo "  <center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res vvv</font></label></center> ";
			 
			 

?></span>
     <span id="printout">
                    <div class="x_content">
                
	 <div class="alert alert-error alert-dismissible fade in" role="alert">
                    
          <strong> Your payment was Not Successful!</strong>
                  </div>
            <!--        <section class="content invoice"> --!>
                      
                    <table>
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
            <i class="fa fa-globe"></i> <?php echo $row_sch['SchoolName']; ?>
                                          <small class="pull-right"> <?php echo $feetype." Payment Summary " ;?></small>
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
                                          <br><strong>Department :</strong> <?php echo $student_dept ; ?>
                                         
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
                      </div> </table>
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
                              <tr>
                                <td>1</td>
                                <td><?php echo "Payment Of " .$feetype." For ".$transession ;?></td>
                                 
                                <td><strike>N</strike><?php echo " ".number_format($amountdue,2); ?></td>
                                <td><?php echo $transession ;?></td>
                                <td> <?php echo $feetype ." Payment" ;?>
                                </td>
                                
                              </tr>
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
                       <font color="red"> Your Payment was declined !. </font>
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
                                  <td>0.00</td>
                                </tr>
                                
                                <tr>
                                  <th>Total:</th>
                                  <td><strike>N</strike><?php echo " ".number_format($amountdue,2); ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                       <div class="btn-group" id="divButtons" name="divButtons">
                    <input type="button" value="Print" onclick="tablePrint();" class="btn btn-default"> 
                      <!--  <button class="btn btn-default" onclick="window.tablePrint1();"><i class="fa fa-print"></i> Print</button> --!>
                      	 </div>
                      <div class="row no-print">
                        <div class="col-xs-12">
                        
                          
                          <button class="btn btn-success pull-right" title="Click to Exit this window" id="save" onClick="window.location.href='Spay_manage.php?view=a_p';" data-placement="left" type="reset"><i class="fa fa-cancel"></i> Exit Payment</button>
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
                      </table>
                    
                 <!--   </section> --!>
                     
                  </div>	
                    
           
                  
          
    
                  </div>
               