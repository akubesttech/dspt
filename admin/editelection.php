
<script type="text/javascript">
 window.onload = function (){
if($('#categ').val() === '2'){   $('#enable1').show(); $('#enable2').hide();    }   
else if ($('#categ').val() === '1') {   $('#enable1').show(); $('#enable2').show();      }
   else {   $('#enable1').hide(); $('#enable2').hide();      }      
}
$(document).ready(function() {   
$('#categ').change(function(){   
if($('#categ').val() === '2')   
   {   $('#enable1').show(); $('#enable2').hide();    }   
else if ($('#categ').val() === '1') 
   {   $('#enable1').show(); $('#enable2').show();      }
   else {   $('#enable1').hide(); $('#enable2').hide();      }      
});   
});   
</script>

<?php
///echo $curdateset = date("Y-m-d");
//$edd = strtotime("2019-05-25");
//$date_now2 =  strtotime($curdateset);
//if($date_now > $date2){$estati = "1";}else{ $estati = "0";}
//if($date_now2 > $edd){echo $estati = "1";}else{ echo $estati = "0";}
if(isset($_POST['savelect'])){
$etitle= ($_POST['etitle']);
$categ = trim($_POST['categ']);
$Sstart = $_POST['Sstart'];
$Send = $_POST['Send'];
$dept_c = $_POST['dept1'];
$facadd = $_POST['fac1'];
$curdateset = date("Y-m-d");
$date_now2 =  strtotime($curdateset);
$currentdate_ts = strtotime($Sstart);
$Send2 = strtotime($Send);
//$date_now = new DateTime(); $date2 = new DateTime($Send);
$query = mysqli_query($condb,"select * from electiontb where title = '".safee($condb,$etitle)."'")or die(mysqli_error($condb));
$row_course = mysqli_num_rows($query);
if($Send2 < $date_now2){$estati = "0";}else{ $estati = "1";}
if ($row_course>1){
message("The Election <strong> $etitle </strong>    Already Exist please Try Again.", "error");
		        redirect('election.php?view=editelect&id='.$_GET['id']);}elseif($Send2 < $currentdate_ts ){
			message("End date should not be in the Past !", "error");
		        redirect('election.php?view=editelect&id='.$_GET['id']);
		        }elseif((! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$Sstart)) or (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$Send)) ) {
						message("Date Formate should be in this Form example: 2017-01-02 !", "error");
			redirect('election.php?view=editelect&id='.$_GET['id']);
			}else{
			
if($categ == "2"){
mysqli_query($condb,"UPDATE  electiontb SET title = '".safee($condb,$etitle)."',ecate = '".safee($condb,$categ)."',estart = '".safee($condb,$Sstart)."',eend ='".safee($condb,$Send)."' ,fac ='".safee($condb,$facadd)."',estatus = '".safee($condb,$estati)."' WHERE id = '".safee($condb,$_GET['id'])."'")or die(mysqli_error($condb));
}elseif($categ == "1"){
mysqli_query($condb,"UPDATE  electiontb SET title = '".safee($condb,$etitle)."',ecate = '".safee($condb,$categ)."',estart = '".safee($condb,$Sstart)."',eend ='".safee($condb,$Send)."',fac ='".safee($condb,$facadd)."',estatus = '".safee($condb,$estati)."' WHERE id = '".safee($condb,$_GET['id'])."'")or die(mysqli_error($condb));
}else{
mysqli_query($condb,"UPDATE  electiontb SET  title = '".safee($condb,$etitle)."',ecate = '".safee($condb,$categ)."',estart = '".safee($condb,$Sstart)."',eend ='".safee($condb,$Send)."',estatus = '".safee($condb,$estati)."' WHERE id = '".safee($condb,$_GET['id'])."'")or die(mysqli_error($condb));
}
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Election Titled $etitle was Add')")or die(mysqli_error($condb));
 message("Election was Successfully Update", "success");
		        redirect('election.php?view=velection');}}

?>
<div class="x_panel">
                
             
                <div class="x_content">
<?php $user_election = mysqli_query($condb,"select * from electiontb  WHERE id = '".safee($condb,$_GET['id'])."'")or die(mysqli_error($condb));
while($row_elect = mysqli_fetch_array($user_election)){ ?>
                    		<form name="register" method="post" enctype="multipart/form-data" id="register">
<input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Election Title </label>
<input type="text" class="form-control " name='etitle' id="etitle" value="<?php echo $row_elect['title']; ?>"  required="required">
                      </div>
 

                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">Election Category </label>
                      
                          <select name='categ' id="categ" class="form-control" required>
                            <option value="<?php echo $row_elect['ecate']; ?>"><?php echo getcateg($row_elect['ecate']); ?></option>
                            <option value="3">General</option>
                            <option value="2"><?php echo $SCategory; ?></option>
                            <option value="1">Department</option>
                          
                          </select> </div>
  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  style="display: none;"  id="enable1">
					    
						  	  <label for="heard"><?php echo $SCategory; ?> </label>
						  	  
                            	  <select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control"   >
                            <option value="<?php echo $row_elect['fac']; ?>"><?php echo getfacultyc($row_elect['fac']); ?></option>
                            <?php  $resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
while($rsblocks = mysqli_fetch_array($resultblocks))
{if($_GET['loadfac'] ==$rsblocks['fac_id'] ){echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";}
	else{echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";}}
?>
                            
                          
                          </select>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" style="display: none;"  id="enable2">
                       
						  	  <label for="heard">Department</label>
                            	  <select name='dept1' id="dept1" class="form-control" >
                           <option value='<?php echo $row_elect['dept']; ?>'><?php echo getdeptc($row_elect['dept']); ?></option>
                          </select>
                      </div>
 
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
                    <label for="email">Voting Start *</label>
                	<div class="form-group">
                	 <input type="text" class="form-control "   name='Sstart' id="Sstart" placeholder="Example : 2009-10-11" value="<?php echo$row_elect['estart']; ?>"  >
			    					</div>
 
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
            <!-- <div class="form-group"> --!>
                    <label for="email">Voting End *</label>
                	<div class="form-group">
                	 <input type="text" class="form-control "    name='Send' id="Send"  placeholder="Example : 2009-12-11" value="<?php echo $row_elect['eend']; ?>" >
			    					</div>
 
            </div>
                      
            
               
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                    
                                     
                                       
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <?php   if (authorize($_SESSION["access3"]["emanag"]["velect"]["create"])){ ?> 
                        <button  name="savelect"  id="savelect"  class="btn btn-primary col-md-4" title="Click Here to Save Election Details" ><i class="fa fa-save"></i> Save </button><?php } ?>   <?php   if (authorize($_SESSION["access3"]["emanag"]["velect"]["view"])){ ?> 
                        <button  name="goback"  id="goback" type='button' onClick="window.location.href='election.php?view=velection';" class="btn btn-primary col-md-4" title="Click Here View Election" ><i class="fa fa-eye"></i> View Election </button><?php } ?> 
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addelection').tooltip('show');
	                                            $('#addelection').tooltip('hide');$('#goback').tooltip('show');
	                                            $('#goback').tooltip('hide');
	                                            });
	                                            </script>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form> <?php } ?>
                       </div> </div>
                 