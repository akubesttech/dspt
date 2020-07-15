<script type="text/javascript">
var xmlhttp

function loadDept3(str)
{var a=document.getElementById(str)[document.getElementById(str).selectedIndex].innerHTML;
if(a=='Select Faculty'){ return;}
else{
var e=document.getElementById('imgHolder2');
e.style.visibility='visible';
xmlhttp=GetXmlHttpObject();

setTimeout(function(){if (xmlhttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  }

var d=document.getElementById(str)[document.getElementById(str).selectedIndex].innerHTML;
var url="loadDept.php";
url=url+"?loadfac="+d;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}

function stateChanged()
{
if (xmlhttp.readyState==4)
  {
  document.getElementById("dept_load").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';
  }
}

function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}

</script>
<script type="text/javascript">   
$(document).ready(function() {   
$('#fee').change(function(){   
if($('#fee').val() === 'Others')   
   {   
   $('#otherl').show(); 
      $('#other2').show();    
   }   
else 
   {   
   $('#otherl').hide(); 
      $('#other2').hide();      
   }   
});   
});   
</script>

<?php

if(isset($_POST['addFee'])){
$fee = $_POST['fee']; $f_pro = ($_POST['f_pro']); $Dept = $_POST['dept1'];
$Dfac = $_POST['fac1']; $otherl = ucfirst($_POST['otherl']);
$amount = $_POST['amount'];$status = $_POST['status'];$flevel = $_POST['level'];
$Cat_fee = $_POST['cat_fee']; $Cpen = $_POST['chkPenalty']; if(empty($Cpen)){$Penper = 0; $pendate = $_POST['pdate'];}else{
$Penper = $_POST['penper']; $pendate = $_POST['pdate'];
}

$query_f = mysqli_query($condb,"select * from fee_db where level = '".safee($condb,$flevel)."' and program = '".safee($condb,$f_pro)."' and Cat_fee = '".safee($condb,$Cat_fee)."' and feetype = '".safee($condb,$fee)."'")or die(mysqli_error($condb));

$row_fee = mysqli_num_rows($query_f);
if ($row_fee>0){
	message("ERROR:  The Fee Entered  Already Added For ". getprog($f_pro) ." in ".getlevel($flevel,$class_ID) ." Try Again", "error");
		        redirect('add_Fees.php');
			}elseif(!ctype_digit($amount)){
					message("ERROR: Incorrect Format For Amount  it should be a Digit", "error");
		        redirect('add_Fees.php');
			
}else{
mysqli_query($condb,"insert into fee_db (feetype,ft_cat,program,level,f_dept,f_fac,f_amount,status,Cat_fee,penalty,pper,psdate) values('".safee($condb,$fee)."','".getftcat($fee)."','".safee($condb,$f_pro)."','".safee($condb,$flevel)."','$Dept','$Dfac','".safee($condb,$amount)."','".safee($condb,$status)."','".safee($condb,$Cat_fee)."','".safee($condb,$Cpen)."','".safee($condb,$Penper)."','".safee($condb,$pendate)."')")or die(mysqli_error($condb));

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','".getftype($fee)." for ".getprog($f_pro)." ".getlevel($flevel,$class_ID) ." was added')")or die(mysqli_error($condb)); 
// ob_start();
message("New Fee [". getftype($fee) ."] was Successfully Added for ".getlevel($flevel,$class_ID)." ".getprog($f_pro)."", "success");
		        redirect('add_Fees.php');
}
}

?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      
                      <span class="section">Add New Payment </span>


 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Fee Type</label>
                            	  <select name='fee' id="fee" class="form-control" required>
                            <option value="">Select Fee</option>
                           <!-- <option value="School fee">School fee</option>
                            <option value="Admission Form">Admission Form</option>
                            <option value="Departmental fee">Departmental fee</option> --!>
						<?php 
$resultfee = mysqli_query($condb,"SELECT * FROM ftype_db   ORDER BY f_type  ASC");
while($rsfee = mysqli_fetch_array($resultfee)){ echo "<option value='$rsfee[id]'>$rsfee[f_type]</option>";}?>
                        <!--    <option value="Others">Other Fees</option> -->
                          
                          </select>
                      </div>
<!--  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  > <label for="heard"  style="display: none;"  id="other2" >Other Fee Type</label> <input type="text" class="form-control " style="display: none;"  type="hidden" name='otherl' id="otherl" ></div> -->
                      
                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Program </label>
                            	  <select name='f_pro' id="f_pro" class="form-control" required>
                            <option value="">Select Program</option>
                            <?php  
$resultproe = mysqli_query($condb,"SELECT * FROM prog_tb   ORDER BY Pro_name  ASC");
while($rsproe = mysqli_fetch_array($resultproe))
{
echo "<option value='$rsproe[pro_id]'>$rsproe[Pro_name]</option>";}?>
                            
                             </select>
                      </div>
 <!--
  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard">Faculty </label>
						  	  
                            	  <select name='fac1' id="fac1" onchange='loadDept3(this.name);return false;' class="form-control" required="required"  >
                            <option value="">Select Faculty</option>
                            <?php  

$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//$counter=1;
while($rsblocks = mysqli_fetch_array($resultblocks))
{
	if($_GET['loadfac'] ==$rsblocks['fac_id'] )
	{
	echo "<option value='$rsblocks[fac_name]' selected>$rsblocks[fac_name]</option>";
//	$counter=$counter+1;
	}
	else
	{
	echo "<option value='$rsblocks[fac_name]'>$rsblocks[fac_name]</option>";
	//$counter=$counter+1;
	}
}
?>
                            
                          
                          </select>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Department</label>
                            	  <select name='dept1' id="dept_load" class="form-control" required="required" >
                           <option value=''>Select Department</option>
                          </select>
                      </div> --!>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">Amount </label>
                      
                          <input type="text" class="form-control " name='amount' id="amount" onkeypress="return isNumber(event);" value=""  required="required"> </div>
                          
                           <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"> Indigene Or Non Indigene </label>
                            	  <select name='cat_fee' id="cat_fee" class="form-control" >
                            <option value="">Select Category</option>
                             <option value="1">Indigene</option>
                              <option value="0">Non Indigene</option>
                            
                             </select>
                      </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level </label>
                            	  <select name='level' id="status" class="form-control" >
                            <option value="">Select Level</option>
                      <?php 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2))
{
echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	
}
?>
                            
                             </select>
                      </div>
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Fee Status </label>
                            	  <select name='status' id="status" class="form-control" >
                            <option value="">Select Status</option>
                             <option value="1">Enabled</option>
                              <option value="0">Disabled</option>
                            </select></div>
                            
               <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
		<label for="chkPenalty"> </label><br><br>
    <label class="chkPenalty"><input type="checkbox" id="chkPenalty"  onclick="ShowHideDiv(this)" name="chkPenalty" value="1" /> Add penalty </label></div>
    
    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback " style="display:none; " id="penper">
					  <label for="heard">Penalty fee in percent (%)</label> <input type="text" class="form-control " name='penper' id="penper" placeholder="example 1.5 % of the Fee Amount" onkeyup="checkDec(this);" maxlength="3"  value=""  > 
					  </div>
					  
					  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display:none; " id="pdate">
					  <label for="heard">Penalty Start Date </label> <input type="text"  name='pdate'   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed" style="height:32px;"  readonly="readonly" value="" size="29"  > </div>
					  
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <?php   if (authorize($_SESSION["access3"]["fIn"]["afee"]["create"])){ ?> 
                        <button  name="addFee"  id="addFee"  class="btn btn-primary col-md-4" title="Click Here to Save Fee Details" ><i class="fa fa-sign-in"></i> Add Fee</button>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addFee').tooltip('show');
	                                            $('#addFee').tooltip('hide');
	                                            });
	                                            </script> <?php } ?>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 