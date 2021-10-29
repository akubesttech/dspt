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
$('#level').change(function(){   
if($('#level').val() === 'Others')   
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

if(isset($_POST['editFee'])){
$fee = $_POST['fee'];
$f_pro = $_POST['f_pro'];
//$Dept = $_POST['dept1'];
//$Dfac = $_POST['fac1'];
//$otherl = ucfirst($_POST['otherl']);
$amount = $_POST['amount'];
$status = $_POST['status'];
$flevel = $_POST['level'];
$Cat_fee = $_POST['cat_fee'];
$Cpen = gnum($_POST['chkPenalty']); 
if(empty($Cpen)){$Penper = 0; $pendate = $_POST['pdate'];$enddate = $_POST['pdate3'];}else{
$Penper = $_POST['penper']; $pendate = $_POST['pdate']; $enddate = $_POST['pdate3'];
}
$edt = str_replace('/', '-', $enddate );  $edtt = date("Y-m-d", strtotime($edt));
$end_ts = strtotime($edtt);
$curdateset=date("Y-m-d");
$currentdate_ts = strtotime($curdateset);
$query_f = mysqli_query($condb,"select * from fee_db where level = '".safee($condb,$flevel)."' and program = '".safee($condb,$f_pro)."' and Cat_fee = '".safee($condb,$Cat_fee)."' and feetype = '".safee($condb,$fee)."' ")or die(mysqli_error($condb));
//$row_fee = mysqli_fetch_array($query);
$row_fee = mysqli_num_rows($query_f);
if ($row_fee>1) {
			message("ERROR:  The Fee Entered  Already Added For ". getprog($f_pro) ." in ".getlevel($flevel,$class_ID) ." Try Again", "error");
		        redirect('add_Fees.php?id='.$get_RegNo);
				}elseif(!ctype_digit($amount)){
					message("ERROR: Incorrect Format For Amount  it should be a Digit", "error");
		            redirect('add_Fees.php?id='.$get_RegNo);
                    }elseif(($currentdate_ts > $end_ts) && !empty($Cpen) ){
			message("End date should not be in the Past !", "error");
		       redirect('add_Fees.php?id='.$get_RegNo);
}else{ //,f_dept='".safee($condb,$Dept)."'
//if($Dfac==""){
mysqli_query($condb,"update  fee_db set feetype='".safee($condb,$fee)."',ft_cat='".getftcat($fee)."',program='".safee($condb,$f_pro)."',level='".safee($condb,$flevel)."',f_amount='".safee($condb,$amount)."',status='".safee($condb,$status)."',Cat_fee='".safee($condb,$Cat_fee)."',penalty = '".safee($condb,$Cpen)."',pper = '".safee($condb,$Penper)."',psdate = '".safee($condb,$pendate)."',edate = '".safee($condb,$enddate)."' where fee_id ='".safee($condb,$get_RegNo)."'") or die(mysqli_error($condb));
//}else{ 
//mysqli_query($condb,"update  fee_db set feetype='$fee',ft_cat='".getftcat($fee)."',program='$f_pro',level='$flevel',f_dept='$Dept',f_fac='".getfaculty2($Dfac)."',f_amount='$amount',status='$status',Cat_fee='$Cat_fee' where fee_id ='$get_RegNo'") or die(mysqli_error($condb));
//}

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','".getftype($fee)." for ".getprog($f_pro)." ".getlevel($flevel,$class_ID) ." was Updated')")or die(mysqli_error($condb)); 
 ob_start();
message("New Fee [". getftype($fee) ."] was Successfully Updated for ".getlevel($flevel,$class_ID)." ".getprog($f_pro)."", "success");
		            redirect('add_Fees.php');
}
}
?>

<div class="x_panel">
                
             
                <div class="x_content">
<?php
								$query_f2 = mysqli_query($condb,"select * from fee_db where fee_id ='$get_RegNo' ")or die(mysqli_error($condb));
								$row_f = mysqli_fetch_array($query_f2); $cpenalty= $row_f['penalty'];  $fprog = $row_f['ft_cat'];
								?>
                    			<form name="register" method="post" enctype="multipart/form-data"  id="register">
<input type="hidden" name="insidd2" value="<?php echo $_SESSION['insidd2'];?> " />
                      
                      <span class="section">Edit Fee </span>


<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Fee Type</label>
						  <!--	  <input type="text" class="form-control "  name='fee' id="fee"  value="<?php echo getftype($row_f['feetype']); ?>"  required="required" readonly> --!>
                          	  <select name='fee' id="fee" class="form-control" required>
                            <option value="<?php echo $row_f['feetype']; ?>"><?php echo getftype($row_f['feetype']); ?></option>
                           <!-- <option value="School fee">School fee</option>
                            <option value="Admission Form">Admission Form</option>
                            <option value="Departmental fee">Departmental fee</option> --!>
						<?php 
$resultfee = mysqli_query($condb,"SELECT * FROM ftype_db   ORDER BY f_type  ASC");
while($rsfee = mysqli_fetch_array($resultfee)){ echo "<option value='$rsfee[id]'>$rsfee[f_type]</option>";}?>
                        <!--    <option value="Others">Other Fees</option> -->
                          
                          </select>  	
                      </div>
                    
                      
                      
                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Program </label>
                            	  <select name='f_pro' id="f_pro" class="form-control" required>
                           <option value="<?php echo $row_f['program']; ?>"><?php echo getprog($row_f['program']); ?></option>
                             <?php  
$resultproe = mysqli_query($condb,"SELECT * FROM prog_tb  ORDER BY Pro_name  ASC");
while($rsproe = mysqli_fetch_array($resultproe))
{
echo "<option value='$rsproe[pro_id]'>$rsproe[Pro_name]</option>";	
}
?>
                            
                             </select>
                      </div>
                      <!--
   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard">Faculty </label>
						  	  
                            	  <select name='fac1' id="fac1" onchange='loadDept3(this.name);return false;' class="form-control">
                            <option value=""><?php echo $row_f['f_fac']; ?></option>
                            <?php  

$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//$counter=1;
while($rsblocks = mysqli_fetch_array($resultblocks))
{
	if($_GET['loadfac'] ==$rsblocks['fac_id'] )
	{
	echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";
//	$counter=$counter+1;
	}
	else
	{
	echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";
	//$counter=$counter+1;
	}
}
?>
                            
                          
                          </select>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Department</label>
                            	  <select name='dept1' id="dept_load" class="form-control" required="required" >
                           <option value="<?php echo $row_f['f_dept']; ?>"><?php echo $row_f['f_dept']; ?></option>
                          </select>
                      </div> --!>
                      
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">Amount </label>
                      
                          <input type="text" class="form-control " name='amount' id="amount" onkeypress="return isNumber(event);" value="<?php echo $row_f['f_amount']; ?>"  required="required"> </div>
                          
                           <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"> Indigene Or Non Indigene </label>
                            	  <select name='cat_fee' id="cat_fee" class="form-control" required="required" >
                            <option value="<?php echo $row_f['Cat_fee']; ?>"><?php  if($row_f['Cat_fee']=="1"){ echo "Indigene"; }else{ echo "Non Indigene"; }  ?></option>
                             <option value="1">Indigene</option>
                              <option value="0">Non Indigene</option>
                            
                             </select>
                      </div>
                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level </label>
                            	  <select name='level' id="status" class="form-control" >
                            <option value="<?php echo $row_f['level']; ?>"><?php echo getlevel($row_f['level'],$class_ID); ?></option>
                             <?php 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2))
{echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	
}?></select></div>
                    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Fee Status </label><select name='status' id="status" class="form-control" >
<option value="<?php echo $row_f['status']; ?>"><?php if ($row_f['status']=1){ echo "compulsory";}else{echo "Optional";} ?></option>
                             <option value="1">compulsory</option>
                              <option value="0">Optional</option></select> </div>
               <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
		<label for="chkPenalty"> </label><br><br>
    <label class="chkPenalty"><input type="checkbox" id="chkPenalty"  onclick="ShowHideDiv(this)" name="chkPenalty" value="1" <?php echo ($cpenalty == '1')?"checked":"" ; ?> /><?php echo ($fprog == '8')?" Add penalty Period":" Add penalty by Amount Per (%)" ; ?> </label></div>
    <?php if($cpenalty == "1"){?>
    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback "  id="penper">
					  <label for="heard">Penalty fee in percent (%)</label> <input type="text" class="form-control " name='penper' id="penper" placeholder="example 1.5 % of the Fee Amount" onkeyup="checkDec(this);" maxlength="3"  value="<?php echo $row_f['pper']; ?>"  > 
					  </div>
					 <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"  id="pdate">
					  <label for="heard">Penalty Start Date </label> <input type="text"  name='pdate'   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed" style="height:32px;"  readonly="readonly" value="<?php echo $row_f['psdate']; ?>" size="29"  > </div>
					  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"  id="pdate3">
					  <label for="heard">Penalty End Date </label> 
                      <input type="text"  name='pdate3'   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed1" style="height:32px;"  readonly="readonly" value="<?php echo $row_f['edate']; ?>" size="29"  > </div>
					  
                      <?php }else{ ?>
					  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback " style="display:none; " id="penper">
					  <label for="heard">Penalty fee in percent (%)</label> <input type="text" class="form-control " name='penper' id="penper" placeholder="example 1.5 % of the Fee Amount" onkeyup="checkDec(this);" maxlength="3"  value="<?php echo $row_f['pper']; ?>"  > 
					  </div>
					 <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display:none; " id="pdate">
					  <label for="heard">Penalty Start Date </label> <input type="text"  name='pdate'   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed" style="height:32px;"  readonly="readonly" value="<?php echo $row_f['psdate']; ?>" size="29"  > </div>
					  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display:none; " id="pdate3">
					  <label for="heard">Penalty End Date </label> 
                      <input type="text"  name='pdate3'   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed1" style="height:32px;"  readonly="readonly" value="<?php echo $row_f['edate']; ?>" size="29"  > </div>
					  
                      <?php } ?>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <?php  if (authorize($_SESSION["access3"]["fIn"]["afee"]["edit"])){ ?> 
                        <button  name="editFee"  id="editFee" type='submite' class="btn btn-primary col-md-4" title="Click Here to Save Fee Details" ><i class="fa fa-sign-in"></i> Edit Fee</button> <button  name="goback"  id="goback" type='button' onClick="window.location.href='add_Fees.php';" class="btn btn-primary col-md-4" title="Click Here to Save Fee Details" ><i class="fa fa-plus"></i> Add Fee </button>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#editFee').tooltip('show');
	                                            $('#editFee').tooltip('hide');
	                                            });
	                                            </script><?php }   ?>
	                                             <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 