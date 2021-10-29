<script type="text/javascript">   
$(document).ready(function() {   
$('#paytype').change(function(){   
if($('#paytype').val() === 'Paycard')   
   {   
   $('#pin').show();   $('#pin2').show();    $('#pin3').show(); $('#pin4').show(); $('#pin5').show();$('#pin1').show();
   }   
else 
   {   
   $('#pin').hide();    $('#pin2').hide();    $('#pin3').hide();  $('#pin4').hide();  $('#pin5').hide();  $('#pin1').hide();
   }   
});   
});   
</script>
<script type='text/javascript'>
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>
<script>

function sync(){
var sname = document.getElementById('nappNo21');
var sname1 = sname.value;
var userID = document.getElementById('userID');
//var number = Math.floor(Math.random() * 100) +4;

userID.value = sname1+number;
//userID.value.changeToUpperCase();
}


</script>
<?php
/*function createRandomPasswordN($qtd){
//Under the string $Caracteres you write all the characters you want to be used to randomly generate the code.
    $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
    $QuantidadeCaracteres = strlen($Caracteres);
    $QuantidadeCaracteres--;
$Hash=NULL; for($x=1;$x<=$qtd;$x++){
$Posicao = rand(0,$QuantidadeCaracteres);
$Hash .= substr($Caracteres,$Posicao,1);}
return $Hash;}*/

$enableinst = setinstallment;
$viewfee_query1 = mysqli_query($condb,"select * from  feecomp_tb where md5(Batchno)='".md5(safee($condb,$_GET['id']))."'")or die(mysqli_error($condb)); $viewcount=mysqli_num_rows($viewfee_query1);if($viewcount < 1){ redirect('apply_b.php?view=lpay'); }
$resultsumnet=mysqli_query($condb,"select SUM(f_amount) as samount from feecomp_tb where md5(Batchno)='".md5(safee($condb,$_GET['id']))."'");
$row_fsum = mysqli_fetch_array($resultsumnet); $Fee_amount =  $row_fsum['samount']; $cfeecheck = mysqli_num_rows($viewfee_query1);
$row_fee = mysqli_fetch_array($viewfee_query1);     $Fee_level = $row_fee['level'];
$Fee_type = $row_fee['Batchno']; $fcat =  $row_fee['fcat']; $appNoreg =  $row_fee['regno']; $paysession =  $row_fee['session']; $payprog =  $row_fee['prog'];  $feetshow = getfeecat($fcat); $_SESSION['transide'] = "";
//$pendate = $row_fee['psdate']; $penper = $row_fee['pper'];
// check if paid acceptance
 $sql_cstudent = mysqli_query($condb,"SELECT * FROM student_tb WHERE appNo = '".safee($condb,$appNoreg)."'");
$contstate = mysqli_num_rows($sql_cstudent);$res = mysqli_fetch_array($sql_cstudent); $matx = $res['RegNo'];

$user_queryst = mysqli_query($condb,"select * from new_apply1 where appNo = '".safee($condb,$appNoreg)."'")or die(mysqli_error($condb));
$user_rowstate = mysqli_fetch_array($user_queryst);
$states = $user_rowstate['state'];$sprog = $user_rowstate['app_type'];$entrymodel = getelevel($user_rowstate['moe']);
$student_s = "Delta";  $apno1 = $user_rowstate['appNo']; $admitsec = $user_rowstate['Asession'];
if($states == $student_s){ $scan = "1";}else{ $scan = "0";}

if(isset($_POST['loadpaypreview'])){
 $Session_checker1 = $_POST["session"];
$tp = $_POST['tp'];
$paytype = $_POST['paytype'];
$nappNo21 = $_POST["nappNo21"];
$Pin = $_POST["pin"];
$transid = getfcode($fcat) . createpayref(10); //createRandomPasswordN(10);
$paidamt = $_POST["paidamt"];
$date = $_POST["end_date"];
$bank = $_REQUEST["bank"];
	$_SESSION['sessionpay']=$Session_checker1;

	$sql_load="SELECT * FROM new_apply1 WHERE Asession ='".safee($condb,$paysession)."' AND  adminstatus ='1' AND ( appNo ='".safee($condb,$appNoreg)."' OR JambNo ='".safee($condb,$nappNo21)."')";$result_load = mysqli_query($condb,$sql_load);
$num_pinr = mysqli_num_rows($result_load);
$find_student = mysqli_fetch_array($result_load);
$c_cho= $find_student['course_choice'];
$deep1= $find_student['first_Choice'];
$deep2= $find_student['Second_Choice']; $payemail = $find_student['e_address']; $phonepay = $find_student['phone']; 
$programs = $find_student['app_type']; $student_state = $find_student['state'];
$payeefullname = $find_student['FirstName']." ".$find_student['SecondName']." ".$find_student['Othername'];
if($student_state == "Delta"){ $stud_from = "1" ;}else{ $stud_from = "0" ;}
 if($c_cho==1){ $pdepart = $deep1;}else{ $pdepart = $deep2;}
$result10=mysqli_query($condb,"SELECT * FROM pin_fee WHERE pinnumber='".safee($condb,$Pin)."' AND status='NOTUSED'");
$numPin=mysqli_num_rows($result10);
$paystatus1=mysqli_query($condb,"SELECT * FROM payment_tb WHERE app_no ='".safee($condb,$appNoreg)."'  AND session='".safee($condb,$paysession)."' AND fee_type = '".safee($condb,$Fee_type)."' AND pay_status = '1'");
$paystatus12=mysqli_num_rows($paystatus1);

$paystatuspin=mysqli_query($condb,"SELECT * FROM payment_tb WHERE pin ='".safee($condb,$Pin)."' and app_no ='".safee($condb,$appNoreg)."' AND session='".safee($condb,$paysession)."' AND level ='".safee($condb,$Fee_level)."'  ");
$paystatus13 =mysqli_num_rows($paystatuspin);
//$_SESSION['tempserial']=$num_serialNo;
$inst = getinstalment($tp,$enableinst,$Fee_amount);
//if($paystatus12 > 0 ){ message("You Have Paid ".$feetshow." For $paysession Session.", "success");
		        //redirect('apply_b.php?view=opay&id='.$Fee_type); 9850 19700 2000
                if(($inst > $Fee_amount) and ($fcat == "1")){
message("Your Payment installment should not be lessthan &#8358;".number_format($inst,2), "success");
		       redirect('apply_b.php?view=lpay&p_id='.md5($appNoreg)); 
}else{
if($paytype == 'Paycard'){
$name4     = $_FILES['image_name']['name'];
$tmpName  = $_FILES['image_name']['tmp_name'];
 $ext = strtolower(pathinfo($name4, PATHINFO_EXTENSION));
$maxsize = 300000;
if($numPin < 1 ){
	message("Incorrect Payment Pin Number", "error");
		        redirect('apply_b.php?view=opay&id='.$Fee_type);
		}elseif($paystatus13 > 0 ){
				 message("This Pin Has Already Been Used For Payment", "error");
		        redirect('apply_b.php?view=opay&id='.$Fee_type);
				}
				elseif($_FILES['image_name']['size'] == Null)  {
					 message("Please Attach your payment Teller Before You Submit This Payment", "error");
		        redirect('apply_b.php?view=opay&id='.$Fee_type);
				}elseif(getimagesize($_FILES['image_name']['tmp_name']) < $maxsize){
					 message("File size should be less than 300kb", "error");
		        redirect('apply_b.php?view=opay&id='.$Fee_type);
	}elseif(!in_array($ext, array('jpg','jpeg','png','gif')) ){
		 message("Invalid file type. Only  JPG, GIF and PNG types are accepted", "error");
		        redirect('apply_b.php?view=opay&id='.$Fee_type);
 	}elseif(empty($paidamt))  {
 		 message("Please Amount Paid In Is Requried", "error");
		        redirect('apply_b.php?view=opay&id='.$Fee_type);
		        exit();

				}else{
				   while($r < 6){
								   $dig .=rand(3,9);
                                    $r+=1;
                                          }
                                         $newname=$dig . ".gif";
$recordimage = move_uploaded_file($_FILES["image_name"]["tmp_name"], "admin/payimg/$newname");
                                $adminthumbnails = "payimg/" .$newname;
            if($c_cho==1){ $pdepart = $deep1;  }else{ $pdepart = $deep2;
						}
 $result = mysqli_query($condb,"insert into payment_tb(app_no,trans_id,email,pay_mode,fee_type,ft_cat,pin,bank_name,teller_no,teller_img,dueamount,paid_amount,pay_date,session,level,department,pay_status,stud_cat,prog) 
			values('".safee($condb,$appNoreg)."','".safee($condb,$transid)."','".safee($condb,$payemail)."','$paytype','".safee($condb,$Fee_type)."','".safee($condb,$fcat)."','$Pin','$bank','".safee($condb,$_POST['tellerno'])."','".safee($condb,$adminthumbnails)."','".safee($condb,$Fee_amount)."','".safee($condb,$Fee_amount)."','$date','".safee($condb,$paysession)."','".safee($condb,$Fee_level)."','".safee($condb,$pdepart)."','1','".safee($condb,$stud_from)."','".safee($condb,$payprog)."')")or die(mysqli_error($condb));

$resultapp20 = mysqli_query($condb,"UPDATE feecomp_tb SET session = '".safee($condb,$paysession)."',pstatus = '1' where Batchno = '".safee($condb,$Fee_type)."'")or die(mysqli_error($condb));
			$sql2=	mysqli_query($condb,"UPDATE pin_fee SET status='USED' WHERE pinnumber='$Pin'")or die(mysqli_error($condb));
	echo "<script>alert('Your ".$feetshow." Payment was Sucessfully Submited!');</script>";
			echo "<script>window.location.assign('paymentslip.php?p_id=".md5($transid)."');</script>";
                                }}else{ $date1 = date("Y-m-d");
 $result = mysqli_query($condb,"insert into payment_tb(app_no,trans_id,email,pay_mode,fee_type,ft_cat,dueamount,pay_date,session,level,department,pay_status,stud_cat,prog)values('".safee($condb,$appNoreg)."','".safee($condb,$transid)."','".safee($condb,$payemail)."','".safee($condb,$paytype)."','".safee($condb,$Fee_type)."','".safee($condb,$fcat)."','".safee($condb,$Fee_amount)."','".safee($condb,$date1)."','".safee($condb,$paysession)."','".safee($condb,$Fee_level)."','".safee($condb,$pdepart)."','0','".safee($condb,$stud_from)."','".safee($condb,$payprog)."')")or die(mysqli_error($condb));
$resultapp2 = mysqli_query($condb,"UPDATE feecomp_tb SET session = '".safee($condb,$Session_checker1)."' where Batchno = '".safee($condb,$_GET['id'])."'")or die(mysqli_error($condb));
 $_SESSION['transide'] = md5($transid);

//echo "<script>alert('Loading Student Payment Preview!');</script>";
 message("Loading Student Payment Preview!", "success");
redirect("apply_b.php?view=e_view");
}}}
//-----------------------------------------------load fees

$tamt = getDueamt($fcat,$payprog,$Fee_level,$scan);
?>
   <section id="content" role="document">
        <main style="min-height: 168px;">
                    <div class="container">
                        

<div class="row">
    <div class="col-xs-12">
        <div id="breadcrumbs-share">
            <section id="breadcrumbs">
                <ul class="breadcrumb">
                                <li><a href="<?php echo host();  ?>">Home</a> </li>

                </ul>
            </section>
        </div>
    </div>
</div>
                    </div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9 link-icons">
            <div class="row">
                <div class="col-xs-12">
            <h3>Payment Panel For Newly Admitted Student </h3>
        </div>
        <div class="col-xs-12 primary-content link-icons">
	<p class="first-paragraph">Total Amount : <font color="red"> <?php echo "&#8358; ".number_format($Fee_amount,2) ;?></font></p>
                </div>
                
        <div class="margin-md-top row cards section-cards">
           <div class="col-xs-12">
           
            <div class="row nopadding nomargin" id="cards">
            
					<!-- form window  --!>	
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<!-- <h3 class="panel-title">Please sign up for Bootsnipp <small>It's free!</small></h3> --!>
			    		<h4 class="panel-title">Select Payment  Method </h4>
			 			</div>
			 			
			 			<div class="panel-body">
			    	<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
                    <input type="hidden" name="tp" value="<?php echo $tamt;?> " />
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Application No<span class="w3l-star"> * </span><?php //echo $fcat; ?></label>
			    					<div class="form-group">
			        
	<input type="text" name="nappNo21" id="nappNo21" required="required" value="<?php echo $appNoreg; ?>" readonly class="form-control input-sm">
			    					</div>
			    				</div>
			    				
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Session<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			        <input type="text" name="session" id="session" required="required" value="<?php echo $paysession; ?>" readonly class="form-control input-sm">
			    					</div>
			    				</div>
			    		
			    			</div>

			    			<div class="row">
			    			<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Program of Study<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
<input type="text" name="prog" id="prog" required="required" value="<?php echo getprog($payprog); ?>" readonly class="form-control input-sm">
			    					</div>
			    				</div>
			    				
			    			
			    				
			    				
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<label class="head">Mode of Payment<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    			<select name="paytype" id="paytype"  required="required" class="form-control input-sm">
    
  <option value="">Select</option>
    <option value="Paycard">E-Paycard</option>
    <option value="Online">Online Payment</option>
  </select>
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row" style="display: none;" id="pin">
			    				<div class="col-xs-6 col-sm-6 col-md-6" >
			    				<label class="head">Card Pin<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
		<input type="text" name="pin" onkeypress="return isNumber(event);" id="pin"  class="form-control input-sm"></div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<label class="head">Bank Name<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    					<div  id="txtroomno" >
			  <?php $query2 = "SELECT * FROM bank";
 $result2 = mysqli_query($condb,$query2); 
 ?> 
<select   name="bank" class="form-control input-sm" ><option selected="selected" value="" >--- Select  Bank---</option>
<?php while ($line2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){ ?>
  <option value="<?php echo $line2['b_name'];?>"> <?php echo $line2['b_name'];?> </option>
<?php } ?>  
    </select>
			 </div>
			    					</div>
			    				</div>
			    			</div>
			    			
			    				<div class="row" style="display: none;" id="pin5">
			    				<div class="col-xs-6 col-sm-6 col-md-6" >
			    				<label class="head">Teller No</label>
			    					<div class="form-group">
		<input type="text" name="tellerno" id="tellerno"  class="form-control input-sm"></div>
			    				</div>
			    				
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<label class="head">Date of Payment</label>
			    					<div class="form-group">
			    				<input  type="text" name="end_date" style='width:190px;' class="input-file uniform_on w8em format-d-m-y highlight-days-67 range-middle-today " id="ed"   readonly="readonly" ></div>
			    				</div></div>
			    					<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6" style="display: none;" id="pin4">
			    				<label class="head">Amount</label>
			    					<div class="form-group">
		<input type="text" name="paidamt" id="paidamt" class="form-control input-sm" value="<?php echo $Fee_amount ; ?>" onkeypress="return isNumber(event);" readonly >
			    				</div>
			    			</div>
							<div class="col-xs-6 col-sm-6 col-md-6" style="display: none;" id="pin3">
			    				<label class="head">Upload Teller</label>
			    					<div class="form-group">
		<input name="image_name" class="input-file uniform_on" id="fileInput" type="file" accept="image/*" onchange="preview_image(event)" style="width:200px;">
			    				</div>
			    		</div>
			    			
							</div>
								<div class="row">
									<div class="col-xs-6 col-sm-6 col-md-6" style="display: none;" id="pin1">
									<div class="otherinputs">
<div class="fileinput-new thumbnail" style="width: 200px; height: 120px; border: 1px solid #0080e5;">
<img src='' alt='Note : File size should not be Greater than 300kb' id='output_image' style='width:200px;height: 120px;'>
 </div> </div> </div></div>
 
	<button name="loadpaypreview" class="btn btn-primary" data-placement="right" type="submit" title="Click to Add Payment">Pay</button>
            <button name="Reprint" class="btn btn-primary" data-placement="right" type="button"  title="Click  To Go Back " onClick="window.location.href='apply_b.php?view=lpay&p_id=<?php echo md5($appNoreg); ?>';">Go Back</button>
			    			
			    		
			    		</form>
			    	</div>
	    		</div>
    	
    	
    
    	
    	
						
                </div>
                
                
            </div>
        </div>



            </div>
            
        </div>
        <div class="col-xs-12 col-md-3 sidebar-right margin-lg-bottom">
            <!-- right feature space -->
            
   <!-- <div class="apply-box">
        <a class="btn btn-default expand padding-md" href="https://applyalberta.ca/APAS.Web.Public/ApplicationServices/default.aspx?StartingAction=ApplyNow">APPLY NOW</a>
    </div> --!>

 <?php include("sidenews.php"); ?>
</div>
            
        </div>
    </div>
</div>


        </main>
    </section>
    
  