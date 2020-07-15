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

if(isset($_POST['editform'])){
$f_pro = $_POST['f_pro'];$amt_c = $_POST['amt_c'];
		$fee = $_POST['fee'];$session = $_POST['session']; $years = substr($_POST['session'],0,4);
		$amt_f = $_POST['amt_f'];$moe = $_POST['moe'];
$Sstart = $_POST['Sstart'];$Send = $_POST['Send'];
$end_ts = strtotime($Send);
$curdateset=date("Y-m-d");
$currentdate_ts = strtotime($curdateset);
$query = mysqli_query($condb,"select * from form_db where prog = '".safee($condb,$f_pro)."' and app_type = '".safee($condb,$fee)."' and session = '".safee($condb,$session)."' and mode = '".safee($condb,$moe)."' ")or die(mysqli_error($condb));
$count = mysqli_num_rows($query);
$query_check = mysqli_query($condb,"select * from session_tb where action = '1'")or die(mysqli_error($condb));
$action = mysqli_num_rows($query_check);
$count2 = mysqli_fetch_array($query_check);
if(empty($amt_f)){ 	message("Application Form Amount cannot be empty! ).", "error");
		        redirect('add_form.php'); }elseif($currentdate_ts > $end_ts ){
			message("End date should not be in the Past !", "error");
		        redirect('add_form.php?id='.$get_RegNo);
		        }elseif((! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$Sstart)) or (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$Send)) ) {
						message("Date Formate should be in this Form example: 2017-01-02 !", "error");
			redirect('add_form.php?id='.$get_RegNo);
}elseif($count > 1){ 
	message("The Form (".getprog($f_pro)." ".$session.") has been Added before, Please Comfirm and try Again!", "error");
		        redirect('add_form.php?id='.$get_RegNo);		
}else{
mysqli_query($condb,"update form_db set prog='".safee($condb,$f_pro)."',app_type='".safee($condb,$fee)."',mode='".safee($condb,$moe)."',amount='".safee($condb,$amt_f)."',amount2='".safee($condb,$amt_c)."',session='".safee($condb,$session)."',year='".safee($condb,$years)."',f_start='".safee($condb,$Sstart)."',f_end='".safee($condb,$Send)."' where id ='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'".safee($condb,$admin_username)."','Application form Titled ".getprog($f_pro)." ".$session." was Updated')")or die(mysqli_error($condb)); 
message("Application Form titled (".getprog($f_pro)." ".$session.") Was Successfully Updated", "success");
		        redirect('add_form.php');
}

}
?>
<?php

$s=3;
	while($s>0){
	$AppNo .= rand(0,9);

		$s-=1;
	}
	

?>
<div class="x_panel">
                
             
                <div class="x_content">
<?php
$query_d2form = mysqli_query($condb,"select * from form_db where id='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
								$row_upform = mysqli_fetch_array($query_d2form); 
								?>
                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      
                      <span class="section">Update Application Form </span>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard"   id="enable3" >Program *</label>
                        <select name='f_pro' id="f_pro" class="form-control" required>
                            <option value="<?php echo $row_upform['prog']; ?>"><?php echo getprog($row_upform['prog']); ?></option>
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
                            <option value="<?php echo $row_upform['app_type']; ?>"><?php echo getftype($row_upform['app_type']); ?></option>
                           <?php 
$resultfee = mysqli_query($condb,"SELECT * FROM ftype_db WHERE f_category = '3'  ORDER BY f_type  ASC");
while($rsfee = mysqli_fetch_array($resultfee)){ echo "<option value='$rsfee[id]'>$rsfee[f_type]</option>";}?>
                        </select>
                      </div>
   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard"   id="enable3" >Amount * </label><div  id="txtroomno" >
<input type="text"  id="amt_f" name="amt_f" value="<?php echo $row_upform['amount']; ?>" placeholder="0.00"  required="required" onkeypress="return isNumber(event);"  class="form-control" ></div>
</div>
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard"   id="enable3" >Commission /Other Charges</label>
<input type="text"  id="amt_c" name="amt_c" value="<?php echo $row_upform['amount2']; ?>" placeholder="0.00" onkeypress="return isNumber(event);"   class="form-control" >
                  </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard"   id="enable3" >Session</label>
                         	  	<select class="form-control"  name="session" id="session"  required="required">
  <option value="<?php echo $row_upform['session']; ?>"><?php echo $row_upform['session']; ?></option><?php  $resultsec = mysqli_query($condb,"SELECT * FROM session_tb  ORDER BY session_name ASC");
while($rssec = mysqli_fetch_array($resultsec)){echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	} ?>
</select>
                      </div>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
                    <label for="email">Application Mode</label>
                	<div class="form-group"><select  class="form-control"   name="moe" id="moe" >
  <option value="<?php echo $row_upform['mode']; ?>"><?php echo getamoe($row_upform['mode']); ?></option>
  <?php
$resultsec2 = mysqli_query($condb,"SELECT * FROM mode_tb  ORDER BY id ASC");
while($rssec2 = mysqli_fetch_array($resultsec2)){echo "<option value='$rssec2[id]'>$rssec2[entrymode]</option>";	}?>
   </select>
			    					</div>
 
            </div>
        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
                    <label for="email">Form Start *</label>
                	<div class="form-group">
                	 <input type="text" class="form-control "   name='Sstart' id="Sstart" value="<?php echo $row_upform['f_start']; ?>" placeholder="Example : 2009-10-11" >
			    					</div>
 
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
            <!-- <div class="form-group"> --!>
                    <label for="email">Form Expire *</label>
                	<div class="form-group">
                	 <input type="text" class="form-control "    name='Send' id="Send" value="<?php echo $row_upform['f_end']; ?>"  placeholder="Example : 2009-12-11" >
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
                       <?php   if (authorize($_SESSION["access3"]["sConfig"]["afm"]["edit"])){ ?>  
                        <button  name="editform"  id="editform"  class="btn btn-primary col-md-4" title="Click Here to Update application form set" ><i class="fa fa-sign-in"></i> Update</button> <?php } ?>
                      <a rel="tooltip"  title="" id="<?php echo $id; ?>" onClick="window.location.href='add_form.php';"   class="btn btn-success"><i class="fa fa-plus icon-large"> Add</i></a>
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#editform').tooltip('show');
	                                            $('#editform').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 