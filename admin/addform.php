<script>
function getformamount(str)
{
if (str=="")
  {
  //document.getElementById("txtroomno").innerHTML="Amount was Not Loaded Because Form Type was Not Selected";
 // return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtroomno").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","loadfamt.php?q="+str,true);
xmlhttp.send();
}
</script>


<?php

if(isset($_POST['addform'])){
$f_pro = $_POST['f_pro'];$amt_c = $_POST['amt_c'];
		$fee = $_POST['fee'];$session = $_POST['session']; $years = substr($_POST['session'],0,4);
		$amt_f = $_POST['amt_f'];$moe = $_POST['moe'];
$Sstart = $_POST['Sstart'];$Send = $_POST['Send'];
$end_ts = strtotime($Send);
$curdateset=date("Y-m-d");
$currentdate_ts = strtotime($curdateset);
//prog, app_type, mode, amount, amount2, session, year, f_start, f_end) VALUES('$f_pro', '$fee', '$moe','$amt_f', '$amt_c', '$session','$years', '$Sstart','$Send'
$query = mysqli_query($condb,"select * from form_db where prog = '".safee($condb,$f_pro)."' and app_type = '".safee($condb,$fee)."' and session = '".safee($condb,$session)."' and mode = '".safee($condb,$moe)."' ")or die(mysqli_error($condb));
$count = mysqli_num_rows($query);
$query_check = mysqli_query($condb,"select * from session_tb where action = '1'")or die(mysqli_error($condb));
$action = mysqli_num_rows($query_check);
$count2 = mysqli_fetch_array($query_check);
if(empty($amt_f)){ 	message("Application Form Amount cannot be empty! ).", "error");
		        redirect('add_form.php'); }elseif($currentdate_ts > $end_ts ){
			message("End date should not be in the Past !", "error");
		        redirect('add_form.php');
		        }elseif((! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$Sstart)) or (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$Send)) ) {
						message("Date Formate should be in this Form example: 2017-01-02 !", "error");
			redirect('add_form.php');
}elseif ($count > 0){ 
	message("The Form (".getprog($f_pro)." ".$session.") has been Added before, Please Comfirm and try Again!", "error");
		        redirect('add_form.php');		
}else{
mysqli_query($condb,"INSERT INTO form_db(prog, app_type, mode, amount, amount2, session, year, f_start, f_end) VALUES('".safee($condb,$f_pro)."', '".safee($condb,$fee)."', '".safee($condb,$moe)."','".safee($condb,$amt_f)."', '".safee($condb,$amt_c)."', '".safee($condb,$session)."','".safee($condb,$years)."', '".safee($condb,$Sstart)."','".safee($condb,$Send)."')")or die(mysqli_error($condb));
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Session Titled $session was Add')")or die(mysqli_error($condb)); 
// ob_start();
message("Application form titled (".getprog($f_pro)." ".$session.") Was Successfully Added", "success");
		        redirect('add_form.php');
}

}
?>
<?php //$s=3; while($s>0){ $AppNo .= rand(0,9); $s-=1;} ?>
<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      
                      <span class="section">Add New Application Form </span>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard"   id="enable3" >Program *</label>
                        <select name='f_pro' id="f_pro" class="form-control" required>
                            <option value="">Select Program</option>
                            <?php  
$resultproe = mysqli_query($condb,"SELECT * FROM prog_tb  ORDER BY Pro_name  ASC");
while($rsproe = mysqli_fetch_array($resultproe))
{
echo "<option value='$rsproe[pro_id]'>$rsproe[Pro_name]</option>";}?>
                            
                             </select>
                      </div>
                          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard"   id="enable3" >Fee Type *</label>
          <select name='fee' id="fee" class="form-control" onchange="getformamount(this.value)" required>
                            <option value="">Select Fee</option>
                           <?php 
$resultfee = mysqli_query($condb,"SELECT * FROM ftype_db WHERE f_category = '3'  ORDER BY f_type  ASC");
while($rsfee = mysqli_fetch_array($resultfee)){ echo "<option value='$rsfee[id]'>$rsfee[f_type]</option>";}?>
                        </select>
                      </div>
   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard"   id="enable3" >Amount * </label><div  id="txtroomno" >
<input type="text"  id="amt_f" name="amt_f" value="" placeholder="0.00"  required="required" onkeypress="return isNumber(event);"  class="form-control" ></div>
</div>
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard"   id="enable3" >Commission /Other Charges</label>
<input type="text"  id="amt_c" name="amt_c" value="" placeholder="0.00" onkeypress="return isNumber(event);"   class="form-control" >
                  </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard"   id="enable3" >Session</label>
                         	  	<select class="form-control"  name="session" id="session"  required="required">
  <option value="">Select Session</option><?php echo fill_sec(); ?>
</select>
                      </div>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
                    <label for="email">Application Mode</label>
                	<div class="form-group"><select  class="form-control"   name="moe" id="moe"  >
  <option value="">Select Mode</option>
<?php
$resultsec2 = mysqli_query($condb,"SELECT * FROM mode_tb  ORDER BY id ASC");
while($rssec2 = mysqli_fetch_array($resultsec2)){echo "<option value='$rssec2[id]'>$rssec2[entrymode]</option>";	}?>
   </select>
			    					</div>
 
            </div>
        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
                    <label for="email">Form Start *</label>
                	<div class="form-group">
                	 <input type="text" class="form-control "   name='Sstart' id="Sstart" placeholder="Example : 2009-10-11"  >
			    					</div>
 
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
            <!-- <div class="form-group"> --!>
                    <label for="email">Form Expire *</label>
                	<div class="form-group">
                	 <input type="text" class="form-control "    name='Send' id="Send"  placeholder="Example : 2009-12-11" >
			    					</div>
 
            </div>
                    
                   
               
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <?php   if (authorize($_SESSION["access3"]["sConfig"]["afm"]["create"])){ ?>
                        <button  name="addform"  id="addform"  class="btn btn-primary col-md-4" title="Click Here to Save application form set" ><i class="fa fa-sign-in"></i> Save</button><?php } ?>

                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addform').tooltip('show');
	                                            $('#addform').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 