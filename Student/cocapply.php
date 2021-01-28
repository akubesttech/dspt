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
   $( "#ed" ).datepicker({
    dateFormat: "yy-mm-dd"
    });   
</script>
<?php 
	function createRandomPassword2() {
$chars = "abcdefghijkmnopqrstuvwxyz023456789";
srand((double)microtime()*1000000);$i = 0;$pass = '' ;while ($i <= 7) {
$num = rand() % 33;$tmp = substr($chars, $num, 1);$pass = $pass . $tmp;$i++;}
return $pass;}

function createRandomPassword($qtd){
//Under the string $Caracteres you write all the characters you want to be used to randomly generate the code.
    $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
    $QuantidadeCaracteres = strlen($Caracteres);
    $QuantidadeCaracteres--;

    $Hash=NULL;

    for($x=1;$x<=$qtd;$x++){
        $Posicao = rand(0,$QuantidadeCaracteres);
        $Hash .= substr($Caracteres,$Posicao,1);
    }

    return $Hash;
}
$viewfee_query1 = mysqli_query($condb,"select * from fee_db where program ='".safee($condb,$student_prog)."' and ft_cat ='7'")or die(mysqli_error($condb));
$cfeecheck = mysqli_num_rows($viewfee_query1);
$row_fee = mysqli_fetch_array($viewfee_query1); $Fee_amount = $row_fee['f_amount']; $Fee_type = $row_fee['feetype'];
$fcat = $row_fee['ft_cat'];
$totalamt = $Fee_amount;
$Fee_level = $row_fee['level'];
$pemail1 = getsemail($student_RegNo);
$qsel = mysqli_query($condb,"SELECT ct.sid,ct.a_app,ct.chod_app,ct.nhod_app,ct.pay_status FROM payment_tb pt LEFT JOIN coc_tb ct ON  ct.trans_id = pt.trans_id WHERE ct.sid ='".safee($condb,$session_id)."'  AND ct.a_app > 0 AND ct.chod_app > 0 AND ct.nhod_app > 0 AND ct.pay_status = '1'") or die(mysqli_error($condb));
$resultcont=mysqli_num_rows($qsel);
$rsay=mysqli_query($condb,"SELECT * FROM coc_tb WHERE sid ='".safee($condb,$session_id)."' AND pay_status = '1'");
$scount=mysqli_num_rows($rsay); $row_rec = mysqli_fetch_array($rsay); $genfac = $row_rec['n_fac']; $gendep = $row_rec['n_dept'];

if(isset($_POST['cocapply'])){
$studid = $_POST['sid'];
$prog = $_POST["prog"];
$cfac = $_POST["cfac"];
$cdept = $_POST["cdept"];
$newfac = $_POST["fac1"];
$newdept = $_POST["dept1"];
$transid = createRandomPassword(12);

$paystatus1 = mysqli_query($condb,"SELECT ct.sid,ct.a_app,ct.chod_app,ct.nhod_app,ct.pay_status FROM payment_tb pt LEFT JOIN coc_tb ct ON  ct.trans_id = pt.trans_id WHERE ct.sid ='".safee($condb,$studid)."'  AND ct.a_app > 0 AND ct.chod_app > 0 AND ct.nhod_app > 0 AND ct.pay_status = '1'") or die(mysqli_error($condb));
//$paystatus1=mysqli_query($condb,"SELECT * FROM coc_tb WHERE sid ='".safee($condb,$studid)."'  AND a_app > 0 AND chod_app > 0 AND nhod_app > 0 AND pay_status = '1'");
$paystatus12=mysqli_num_rows($paystatus1);
$paystatuspin=mysqli_query($condb,"SELECT * FROM coc_tb WHERE  sid ='".safee($condb,$studid)."' AND c_dept = '".safee($condb,$cdept)."'");
$paystatus13 =mysqli_num_rows($paystatuspin);

if($cdept == $newdept){ 
message("Your cannot Change to the same course.", "error");
redirect('changeofcourse_m.php?view=capply');
}elseif($cfeecheck < 1){
    message("Unable to Load Payment at this time Please Try Again .", "error");
redirect('changeofcourse_m.php?view=capply');
}elseif($paystatus12 > 0){
  message("Your Change of Course Has Been Verified.", "success");
redirect('changeofcourse_m.php?view=c_info');  
}else{

if($paystatus13 > 0){
$sql2_up=	mysqli_query($condb,"UPDATE coc_tb SET trans_id ='".safee($condb,$transid)."',c_matno ='".safee($condb,$student_RegNo)."',c_fac = '".safee($condb,$cfac)."',c_dept = '".safee($condb,$cdept)."',n_fac = '".safee($condb,$newfac)."',n_dept = '".safee($condb,$newdept)."',prog = '".safee($condb,$prog)."',a_app = '0',chod_app = '0',nhod_app = '0',pay_status = '0',date = NOW(),pamount = '".safee($condb,$totalamt)."',ftype ='".safee($condb,$Fee_type)."'  WHERE sid ='".safee($condb,$studid)."'")or die(mysqli_error($condb));

$sql2_pay=	mysqli_query($condb,"UPDATE payment_tb SET pay_date=NOW(),email='".safee($condb,$pemail1)."',session='".safee($condb,$s_session)."',dueamount='".safee($condb,$totalamt)."',trans_id='".safee($condb,$transid)."',fee_type='".safee($condb,$Fee_type)."',ft_cat = '".safee($condb,$fcat)."',level='".safee($condb,$level)."',ft_cat='',prog='".safee($condb,$student_prog)."' WHERE stud_reg ='".safee($condb,$student_RegNo)."' AND session='".safee($condb,$s_session)."' AND pay_status = '0' AND fee_type='".safee($condb,$Fee_type)."'")or die(mysqli_error($condb));
$_SESSION['transide'] = $transid;
$_SESSION['in_time'] = time();
}else{   
$result = mysqli_query($condb,"insert into coc_tb (sid,trans_id,c_matno,c_fac,c_dept,n_fac,n_dept,prog,a_app,chod_app,nhod_app,pay_status,pamount,ftype,date)
values('".safee($condb,$studid)."','".safee($condb,$transid)."','".safee($condb,$student_RegNo)."','".safee($condb,$cfac)."','".safee($condb,$cdept)."','".safee($condb,$newfac)."','".safee($condb,$newdept)."','".safee($condb,$prog)."','0','0','0','0','".safee($condb,$totalamt)."','".safee($condb,$Fee_type)."',NOW())")or die(mysqli_error($condb));
$resultpay = mysqli_query($condb,"insert into payment_tb(stud_reg,trans_id,email,pay_mode,fee_type,ft_cat,dueamount,pay_date,session,level,department,pay_status,prog) 
			values('".safee($condb,$student_RegNo)."','".safee($condb,$transid)."','".safee($condb,$pemail1)."','Online','".safee($condb,$Fee_type)."','".safee($condb,$fcat)."','".safee($condb,$totalamt)."',NOW(),'".safee($condb,$s_session)."','".safee($condb,$level)."','".safee($condb,$student_dept)."','0','".safee($condb,$student_prog)."')")or die(mysqli_error($condb));
$_SESSION['transide'] = $transid;
 $_SESSION['in_time'] = time();
}
message("Loading Change of Course Payment Invoice!", "info");
//echo "<script>alert('Loading Room Booking Preview!');</script>";
redirect('changeofcourse_m.php?view=c_info'); 
}

			}
		
?>
<div class="x_panel">
                
             
                <div class="x_content">
	                <form method="post" class="form-horizontal"  action="" enctype="multipart/form-data">
                    <input type="hidden" name="sid" value="<?php echo $_SESSION['student_id'];?> " />
<input type="hidden" class="form-control " name='prog' id="prog" value="<?php echo $student_prog; ?>" >
<input type="hidden" class="form-control " name='cfac' id="cfac" value="<?php echo $student_facut ; ?>" >
      	  <input type="hidden" class="form-control " name='cdept' id="cdept" value="<?php echo $student_dept ; ?>" >
          <input type="hidden" class="form-control " name='famt' id="famt" value="<?php echo $Fee_amount ; ?>" >
                                                               
                      
                      
                      <span class="section">Change Of Course Form</span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Please Note that an Online payment would be required to Complete your Change of Course Form after this Stage. 
                  </div>
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Matric No</label>
                            	  <input type="text" class="form-control " name='regNo' id="regNo" value="<?php echo $student_RegNo ; ?>" readonly>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level</label>
                            	  <input type="text" class="form-control " name='lev' id="lev" value="<?php echo getlevel($student_level,$student_prog); ?>" readonly>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Academic Session</label>
                            	  <input type="text" class="form-control " name='sec' id="sec" value="<?php echo $s_session ; ?>" readonly>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Program</label>
                            	  <input type="text" class="form-control " name='regNo' id="regNo" value="<?php echo getprog($student_prog) ; ?>" readonly>
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Current <?php echo $SCategory; ?></label>
                            	  <input type="text" class="form-control " name='cf' id="cf" value="<?php echo getfacultyc($student_facut) ; ?>" readonly>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Current <?php echo $SGdept1; ?></label>
                            	  <input type="text" class="form-control " name='cd' id="cd" value="<?php echo getdeptc($student_dept) ; ?>" readonly> 
                      </div>
           
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="color:green;" >
                       <label for="heard">New <?php echo $SCategory; ?> </label>
                        <select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" >
                         <?php if($resultcont > 0) {?>
                            <option value="">Select <?php echo $SCategory; ?></option>
                        <?php }else{   if($scount > 0){ ?>   <option value="<?php echo $genfac; ?>"> <?php echo getfacultyc($genfac); ?></option> <?php }else{?>
                         <option value="">Select <?php echo $SCategory; ?></option>
                            <?php } }
$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
while($rsblocks = mysqli_fetch_array($resultblocks))
{if($_GET['loadfac'] ==$rsblocks['fac_id'] ){echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";
}else{echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";}}
?></select> </div>
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="color:green;">
<label for="heard">New <?php echo $SGdept1; ?></label>
                            	  <select name='dept1' id="dept1" class="form-control"  >
                                   <?php if($resultcont > 0) {?>
                            <option value="">Select <?php echo $SGdept1; ?></option>
                          <?php }else{ if($scount > 0){ ?> <option value='<?php echo getdeptc($gendep); ?>'> <?php echo getdeptc($gendep); ?></option> <?php }else{?>
                          <option value=''>Select <?php echo $SGdept1; ?></option>
                          <?php }} ?>
                          </select>
                      </div>
    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback" style="text-align:center;color: red;">
<label for="heard" ><input id="approve" name="approve" value="1"  
			onchange="document.getElementById('cocapply').disabled = !this.checked;"
			onclick="javascript: toggleCheckBox();" type="checkbox"> Do you still wish to continue with the change of Course!</label>
            <br>
            <button type="submit" name="cocapply"  id="cocapply" data-placement="right" disabled class="btn btn-primary" title="Click to Submit " ><i class="fa fa-sign-in"></i> Submit</button>
               <?php if($scount > 0){  ?>  
            <button data-placement="right" title="Click Here to view your charge of Course Status" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='changeofcourse_m.php?view=cslip';" type="reset"><i class="icon-signin icon-large"></i> View Details</button>
            <?php }   ?>       
                      </div>
               
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3"> 
                       <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#cocapply').tooltip('show');
	                                            $('#cocapply').tooltip('hide');
	                                            });
	                                            </script>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='../admin/uploads/tabLoad.gif'></div>
                        </div>
                        
                      </div>
                    </form>
                    
                    
                    
                    
                    
                    
                  </div>
                  
                  
                  