<script type="text/javascript">   
$(document).ready(function() {   
$('#paytype').change(function(){   
if($('#paytype').val() === 'Paycard')   
   {   
    $('#pin1').show(); $('#pin2').show();    $('#pin3').show(); $('#pin4').show();$('#pin5').show(); $('#pin6').show();
   }   
else 
   {   
   $('#pin1').hide();    $('#pin2').hide();    $('#pin3').hide();  $('#pin4').hide();  $('#pin5').hide(); $('#pin6').hide();  
   }   
});   
});   
</script>
<?php 
	//function createRandomPassword2() {
//$chars = "abcdefghijkmnopqrstuvwxyz023456789";
//srand((double)microtime()*1000000);$i = 0;$pass = '' ;while ($i <= 7) {
//$num = rand() % 33;$tmp = substr($chars, $num, 1);$pass = $pass . $tmp;$i++;}
//return $pass;}
/*function createRandomPassword($qtd){
//Under the string $Caracteres you write all the characters you want to be used to randomly generate the code.
    $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
    $QuantidadeCaracteres = strlen($Caracteres);
    $QuantidadeCaracteres--;
$Hash=NULL; for($x=1;$x<=$qtd;$x++){
$Posicao = rand(0,$QuantidadeCaracteres);
$Hash .= substr($Caracteres,$Posicao,1);}
return $Hash;} */

$user_queryst = mysqli_query($condb,"select * from student_tb where stud_id = '".safee($condb,$session_id)."'")or die(mysqli_error($condb));
$user_rowstate = mysqli_fetch_array($user_queryst);
$states = $user_rowstate['state'];
$student_s = "Delta";
if($states == "Delta"){ $stud_from = "1";}else{ $stud_from = "0";}
$enableinst = setinstallment;
if(substr($_GET['id'],0,1) == "B"){$viewfee_query1 = mysqli_query($condb,"select * from  feecomp_tb where md5(Batchno)='".md5(safee($condb,$_GET['id']))."'")or die(mysqli_error($condb));
$resultsumnet=mysqli_query($condb,"select SUM(f_amount) as samount from feecomp_tb where md5(Batchno)='".md5(safee($condb,$_GET['id']))."'");
$row_fsum = mysqli_fetch_array($resultsumnet); $Fee_amount =  $row_fsum['samount']; $cfeecheck = mysqli_num_rows($viewfee_query1);
$row_fee = mysqli_fetch_array($viewfee_query1);    $Fee_level = $row_fee['level'];
$Fee_type = $row_fee['Batchno']; $fcat =  $row_fee['fcat']; 
}else{
$viewfee_query1 = mysqli_query($condb,"select * from fee_db where md5(fee_id)='".safee($condb,$_GET['id'])."'")or die(mysqli_error($condb));
$cfeecheck = mysqli_num_rows($viewfee_query1);
$row_fee = mysqli_fetch_array($viewfee_query1); $pendate = $row_fee['psdate']; $penper = $row_fee['pper']; $Fee_amount = FeesCalc($row_fee['f_amount'],$penper,$pendate);   $Fee_level = $row_fee['level']; $Fee_type = $row_fee['feetype']; $fcat = getftcat($Fee_type); }
$pemail1 = getsemail($student_RegNo);
if($cfeecheck >1){$feetshow = getfeecat($fcat);   }else{ $feetshow = getftype($Fee_type); }
if($cfeecheck < 1){ message("The page you are trying to access is not Available.", "error");
//echo "<script>alert('The page you are trying to access is not Available!');</script>";
//unset($_SESSION['student_id']);
redirect('Spay_manage.php?view=a_p'); }
//echo $TIME = date('G:ia');
if(isset($_POST['addpayment'])){
 $Session_checker1 = $_POST["session"];
 $tp = $_POST['tp'];
$level = $_POST["level"];
$paytype = $_POST['paytype'];
$Pin = $_POST["pin"];
$transid = getfcode($fcat) . createpayref(10);//createRandomPassword(10);
$paidamt = $_POST["paidamt"]; 
$origDate = $_POST["dop"];
$bank = $_POST["bank"];
	$_SESSION['temppin']=$Pin;
	//$origDate = $gdop;
 $date2 = str_replace('/', '-', $origDate );
$date = date("Y-m-d", strtotime($date2));

$sql2="SELECT * FROM pin_fee WHERE pinnumber='".safee($condb,$Pin)."' AND status='NOTUSED'";
$result10=mysqli_query($condb,$sql2);
$numPin=mysqli_num_rows($result10);
if($student_state == "Delta"){ $stud_from = "1" ;}else{ $stud_from = "0" ;}

$paystatus1=mysqli_query($condb,"SELECT * FROM payment_tb WHERE stud_reg ='".safee($condb,$student_RegNo)."' AND session='".safee($condb,$Session_checker1)."' AND ft_cat = '".safee($condb,$fcat)."' AND pay_status = '1'");
$paystatus12=mysqli_num_rows($paystatus1);
$paystatuspin=mysqli_query($condb,"SELECT * FROM payment_tb WHERE pin ='".safee($condb,$Pin)."' and stud_reg ='".safee($condb,$student_RegNo)."' and session='".safee($condb,$Session_checker1)."'");
$paystatus13 =mysqli_num_rows($paystatuspin);
$inst = getinstalment($tp,$enableinst,$Fee_amount);
//if(strpos($nappNo21," ")){ $res="<font color='Red'><strong>Please! Application Id can not Contain a Space..</strong></font><br>";
//$resi=1;
//if($paystatus12 > 0 ){
//message("You Have Paid ".$feetshow." For $Session_checker1 Session.", "success");
//redirect('Spay_manage.php');
   if(($inst > $Fee_amount) AND ($paystatus12 < 1)){
message("Your Payment installment should not be lessthan &#8358;".number_format($inst,2), "success");
		       redirect('Spay_manage.php?view=m_sp&id='.($_GET['id'])); 
}else{
if($paytype == 'Paycard'){
$name4     = $_FILES['image_name']['name'];
$tmpName  = $_FILES['image_name']['tmp_name'];
 $ext = strtolower(pathinfo($name4, PATHINFO_EXTENSION));
$maxsize = 300000;
if($numPin < 1 ){
	message("Incorrect Payment Pin Number!", "error");
		        redirect('Spay_manage.php?view=m_sp&id='.($_GET['id']));
	}elseif($paystatus13 > 0 ){
		message("This Pin Has Already Been Used For Payment!", "error");
		        redirect('Spay_manage.php?view=m_sp&id='.($_GET['id']));
	}
				elseif($_FILES['image_name']['size'] == Null)  {
					message("Please Attach your payment Teller Before You Submit This Payment!", "error");
		        redirect('Spay_manage.php?view=m_sp&id='.($_GET['id']));

				}elseif(getimagesize($_FILES['image_name']['tmp_name']) < $maxsize){
						message("File size should be less than 300kb", "error");
		        redirect('Spay_manage.php?view=m_sp&id='.($_GET['id']));
}elseif(!in_array($ext, array('jpg','jpeg','png','gif')) ){
	message("Invalid file type. Only  JPG, GIF and PNG types are accepted", "error");
		        redirect('Spay_manage.php?view=m_sp&id='.($_GET['id']));
 }
				elseif(empty($paidamt))  {
					message("Please Amount Paid In Is Requried", "error");
		        redirect('Spay_manage.php?view=m_sp&id='.($_GET['id']));
}else{
				   while($r < 6){
								   $dig .=rand(3,9);
                                    $r+=1;
                                          }
                                         $newname=$dig . ".gif";
$recordimage = move_uploaded_file($_FILES["image_name"]["tmp_name"], "../admin/payimg/$newname");
                                $adminthumbnails = "payimg/" .$newname;
    if($c_cho==1){ $pdepart = $deep1; }else{$pdepart = $deep2;
						}
 $result = mysqli_query($condb,"insert into payment_tb(stud_reg,trans_id,email,pay_mode,fee_type,ft_cat,pin,bank_name,teller_no,teller_img,dueamount,paid_amount,pay_date,session,level,department,pay_status,stud_cat,prog) 
			values('".safee($condb,$student_RegNo)."','".safee($condb,$transid)."','".safee($condb,$pemail1)."','$paytype','".safee($condb,$Fee_type)."','".safee($condb,$fcat)."','".safee($condb,$Pin)."','$bank','".safee($condb,$_POST['tellerno'])."','".safee($condb,$adminthumbnails)."','".safee($condb,$paidamt)."','".safee($condb,$paidamt)."','$date','".safee($condb,$Session_checker1)."','$level','".safee($condb,$student_dept)."','1','$stud_from','".safee($condb,$student_prog)."')")or die(mysqli_error($condb));
$resultapp20 = mysqli_query($condb,"UPDATE feecomp_tb SET session = '".safee($condb,$Session_checker1)."',pstatus = '1' where Batchno = '".safee($condb,$_GET['id'])."'")or die(mysqli_error($condb));		
			$sql2=	mysqli_query($condb,"UPDATE pin_fee SET status='USED' WHERE pinnumber='".safee($condb,$Pin)."'")or die(mysqli_error($condb));
	//$find_d_load = mysqli_fetch_array(mysqli_query($condb," SELECT * FROM dept where d_name='$num_dep'"));
			echo "<script>alert('Your ".$feetshow." Payment was Sucessfully Submited!');</script>";
			echo "<script>window.location.assign('../paymentslip.php?p_id=".md5($transid)."');</script>";
                                }

}else{
//$paystatus12=mysqli_query($condb,"SELECT * FROM payment_tb WHERE stud_reg ='".safee($condb,$student_RegNo)."' AND session='".safee($condb,$Session_checker1)."' AND ft_cat = '".safee($condb,$fcat)."'");
//$paystatus13=mysqli_num_rows($paystatus12); 
$date1=date("Y-m-d");
//if($paystatus13 > 0){
//$sql2_up=	mysqli_query($condb,"UPDATE payment_tb SET pay_date='".safee($condb,$date1)."',email='".safee($condb,$pemail1)."',session='".safee($condb,$Session_checker1)."',dueamount='".safee($condb,$paidamt)."',trans_id='".safee($condb,$transid)."',fee_type='".safee($condb,$Fee_type)."',level='".safee($condb,$level)."',ft_cat='".safee($condb,$fcat)."',stud_cat='".safee($condb,$stud_from)."',prog='".safee($condb,$student_prog)."' WHERE stud_reg ='".safee($condb,$student_RegNo)."' AND session='".safee($condb,$Session_checker1)."' AND fee_type = '".safee($condb,$Fee_type)."'")or die(mysqli_error($condb));
//$_SESSION['transide'] = $transid;
//}else{
$result = mysqli_query($condb,"insert into payment_tb(stud_reg,trans_id,email,pay_mode,fee_type,ft_cat,dueamount,pay_date,session,level,department,pay_status,stud_cat,prog)values('".safee($condb,$student_RegNo)."','".safee($condb,$transid)."','".safee($condb,$pemail1)."','".safee($condb,$paytype)."','".safee($condb,$Fee_type)."','".safee($condb,$fcat)."','".safee($condb,$paidamt)."','".safee($condb,$date1)."','".safee($condb,$Session_checker1)."','$level','".safee($condb,$student_dept)."','0','".safee($condb,$stud_from)."','".safee($condb,$student_prog)."')")or die(mysqli_error($condb));
$resultapp2 = mysqli_query($condb,"UPDATE feecomp_tb SET session = '".safee($condb,$Session_checker1)."' where Batchno = '".safee($condb,$_GET['id'])."'")or die(mysqli_error($condb));
 $_SESSION['transide'] = $transid;
//}

echo "<script>alert('Loading Student Payment Preview!');</script>";
redirect("Spay_manage.php?view=e_pv");
}
			//	header("location:apply_b.php?view=N_1");
				//echo "<script>alert('Your Application was Sucessfully Submited!');</script>";
	
		//echo "<script>window.location.assign('studentresultprint.php?applyid=".md5($nappNo21)."');</script>";
			}
			

}//}$_SESSION['insidp'] = rand();
$tamt = getDueamt($fcat,$student_prog,$Fee_level,$stud_from);
?>
<div class="x_panel">
                
             
                <div class="x_content">
	                <form method="post" class="form-horizontal"  action="" enctype="multipart/form-data">
                    <input type="hidden" name="insidp" value="<?php echo $_SESSION['insidp'];?> " />
                      <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                       <input type="hidden" name="tp" value="<?php echo $tamt;?> " />
                      <span class="section">Add Payment</span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Please Complete the  information Below to make payment. 
                  </div>
                  <div class="col-xs-12 primary-content link-icons" style="font-size: 20px;">
	<p class="first-paragraph">Total Amount : <font color="red"> <?php echo "&#8358; ".number_format($Fee_amount,2) ;?></font></p>
                </div>
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Matric No</label>
                            	  <input type="text" class="form-control " name='regNo' id="regNo" value="<?php echo $student_RegNo ; ?>" readonly>
                      </div>
    
               <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level</label>
                            	  
                            	  <select  class="form-control " name='level' id="level"  required="required" readonly>
  <option value="<?php echo $Fee_level; ?>"><?php echo getlevel($Fee_level,$student_prog); ?></option>
               <?php $resultsec2 = mysqli_query($condb,"SELECT * FROM level_db WHERE prog = '".safee($condb,$student_prog)."'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2))
{ echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	
}
?>	
</select>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Academic Session</label>
                            <select name="session" id="session"  required="required" class="form-control">
  <option value="<?php echo $default_session; ?>"><?php echo $default_session; ?></option><?php echo fill_sec(); ?>
</select>
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Mode of Payment</label>
                       <select name="paytype" id="paytype"  class="form-control" required>
 <option value="">Select</option>
    <option value="Paycard">E-Paycard</option>
    <option value="Online">Online Payment</option>
  </select></div>
  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display: none;" id="pin1">
						  	  <label for="heard">Card Pin</label>
                            	  <input type="text" class="form-control " name='pin' id="pin"  >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display: none;" id="pin2">
						  	  <label for="heard">Bank Name</label>
                         <?php $query2 = "SELECT * FROM bank";
 $result2 = mysqli_query($condb,$query2); 
 ?> <select   name="bank" class="form-control"><option selected="selected" value="" >--- Select  Bank---</option>
<?php while ($line2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
  { 
  ?><option value="<?php echo $line2['b_name'];?>"> <?php echo $line2['b_name'];?> </option>

<?php } 
?>  </select></div>
 <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display: none;" id="pin3"> <label for="heard">Teller No</label>
<input type="text" class="form-control " name="tellerno" id="tellerno"  > </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display: none;" id="pin4">
						  	  <label for="heard">Amount</label>
                            	 <input  type="text"  class="form-control "  name="paidamt" id="paidamt"   readonly="readonly" value="<?php echo $Fee_amount ; ?>" >
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display: none;" id="pin5">
<label for="heard">Date of Payment</label>
<input  type="text" name="dop" size="30"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed1"   readonly="readonly" style="height:32px;"></div>

                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback" style="display: none;" id="pin6">
						  	  <label for="heard">Upload Teller:</label>
                            	<input name="image_name" class="input-file uniform_on" id="fileInput" type="file" >
                      </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3"> 
                         <button data-placement="right" title="Click Here To Exit Payment" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='Spay_manage.php?view=a_p';" type="reset"><i class="icon-signin icon-large"></i> Exit </button>
                         <button type="submit" name="addpayment"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click to Make Payment" ><i class="fa fa-money"></i> Pay</button>
                        
                        <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='../admin/uploads/tabLoad.gif'></div>
                        </div>
                        
                      </div>
                    </form>
                  </div>
                  