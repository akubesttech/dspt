
<script type="text/javascript">   
$(document).ready(function() {   
$('#pduration').change(function(){   
if($('#pduration').val() === 'Others')   
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
$checkocupant=mysqli_query($condb,"SELECT * FROM hostelallot_tb left join roomdb ON roomdb.room_id = hostelallot_tb.roomno WHERE  allot_id ='".safee($condb,$_GET['idroom'])."' ");
$queryocupant =mysqli_num_rows($checkocupant);
$rooomrecord =mysqli_fetch_array($checkocupant); $hcoderenew  = $rooomrecord['h_code']; $roomnorenew  = $rooomrecord['roomno']; $unitamt  = $rooomrecord['fee'];   $hlevela  = $rooomrecord['level']; $hroomnoa  = $rooomrecord['no_of_bed'];
$hrega  = $rooomrecord['studentreg']; $hseca  = $rooomrecord['session']; $hallotdatea  =  $rooomrecord['allotdate']; $hallatstatusa  =  $rooomrecord['allotstatus']; $roomduration = $rooomrecord['duration'];
$expiredate = $rooomrecord['allotexpire']; $roomst = $rooomrecord['room_status'];
$dayx = dayCount($expiredate);
 if(!is_positive_integer($dayx)){ $dayremain = ""; $dayremain2 = "0"; }else{ $dayremain = "disabled"; $dayremain2 = $dayx; }
if(isset($_POST['editallot'])){
$allotlevel = ucfirst(trim($_POST['level']));
$allotsec = $_POST['session'];
$aname1 = $_POST['hname'];
$allotroomno = $_POST['roomno'];
$allotdura = $_POST['duration'];
$allotcdate = $_POST['cdate'];
$allotastatus = $_POST['astatus'];
$amtMonth = $_POST["amt"];
$total = $amtMonth * $allotdura;
// for production remove slashes
//$getstartdate= DateTime::createFromFormat('Y-m-d', $hallotdatea)->format('d/m/Y');
//$startdate2= DateTime::createFromFormat('d/m/Y', $allotcdate)->format('Y-m-d');
//$startdate = endCycle($startdate2, $allotdura);
if($dayremain2 > 0){
$sql2_up=	mysqli_query($condb,"UPDATE hostelallot_tb SET allotdate = '".safee($condb,$startdate2)." ".$allotdura."',allotexpire = '".safee($condb,$startdate)."',allotstatus='".safee($condb,$allotastatus)."'  WHERE allot_id  ='".safee($condb,$_GET['idroom'])."' ")or die(mysqli_error($condb));
message("Room allocation was Successfully Edited", "success");
		        redirect('add_Hostel.php?view=allotR');
}else{
if($allotastatus > 0){
if($allotroomno !== $roomnorenew ){
$sql2   = mysqli_query($condb,"UPDATE  roomdb SET room_status = '1' WHERE room_id = '".safee($condb,$roomnorenew)."'");
$sql2   = mysqli_query($condb,"UPDATE  roomdb SET room_status = '0' WHERE room_id = '".safee($condb,$allotroomno)."'");}
$sql2_up1=	mysqli_query($condb,"UPDATE hostelallot_tb SET session = '".safee($condb,$allotsec)."',level = '".safee($condb,$allotlevel)."',duration = '".safee($condb,$allotdura)."',amount = '".safee($condb,$total)."',h_code = '".safee($condb,$aname1)."',roomno = '".safee($condb,$allotroomno)."',allotdate = '".safee($condb,$startdate2)."',allotexpire = '".safee($condb,$startdate)."',allotstatus='".safee($condb,$allotastatus)."',validity = '0'  WHERE allot_id  ='".safee($condb,$_GET['idroom'])."' ")or die(mysqli_error($condb));
message("Room allocation was Successfully Edited", "success");
		        redirect('add_Hostel.php?view=allotR');
}else{
if($roomst < 1){
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'".safee($condb,$admin_username)."','
Hostel Room allotment info of $hrega  with Hostel name :".gethostel($h_code)."  Room No: " .getroomno($roomno)." was Checked Out by ". $admin_username.". ')")or die(mysqli_error($condb));
$sql2   = mysqli_query($condb,"UPDATE  roomdb SET room_status = '1' WHERE room_id = '".safee($condb,$roomnorenew)."'");
$result = mysqli_query($condb,"DELETE FROM hostelallot_tb where allot_id='".safee($condb,$_GET['idroom'])."' AND allotexpire < (CURDATE())");
}
message("Room allocation was Successfully Removed", "success");
		        redirect('add_Hostel.php?view=allotR');
}}

}
?>
<?php //$s=3;while($s>0){ $AppNo .= rand(0,9); $s-=1;} ?>
<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      
                      <span class="section">Edit Hostel Allocation information <?php echo getsname($hrega); ?></span>

<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Matric No</label>
                            	  <input type="text" class="form-control " name='regNo' id="regNo" value="<?php echo $hrega ; ?>" readonly>
                      </div>
    
               <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level</label>
                            	  
                            	  <select  class="form-control " name='level' id="level"  required="required" <?php echo $dayremain ; ?> readonly>
  <option value="<?php echo $hlevela; ?>"><?php echo getlevel($hlevela,$class_ID); ?></option>
               <?php 
//include('lib/dbcon.php'); 
//dbcon(); 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2))
{
echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	
}
?>	
</select>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Academic Session</label>
                            <select name="session" id="session"  required="required" class="form-control" <?php echo $dayremain ; ?> >
  <option value="<?php echo $hseca ; ?>"><?php echo $hseca ; ?></option>
<?php echo fill_sec(); ?>
</select>
                      </div>
                      
                   
   <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Hostel Name *</label>
                            <select name="hname" id="hname" onchange='loadroom2(this.name);return false;'  required="required" class="form-control" <?php echo $dayremain ; ?> >
  <option value="<?php echo $hcoderenew ; ?>"><?php echo gethostel($hcoderenew); ?></option>
<?php  
$resultblocks = mysqli_query($condb,"SELECT DISTINCT h_name,h_code FROM hostedb WHERE h_status  = '1' ORDER BY h_name ASC");
while($rsblocks = mysqli_fetch_array($resultblocks))
{if($_GET['loadroom'] == $rsblocks['h_code'] )
	{echo "<option value='$rsblocks[h_code]' selected>$rsblocks[h_name]</option>";}
	else{echo "<option value='$rsblocks[h_code]'>$rsblocks[h_name]</option>";}}
?>
</select>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Room No *</label>
                            	  <select name='roomno' id="roomno" onchange='loadhamt(this.name);return false;' class="form-control" required="required"  <?php echo $dayremain ; ?> >
                           <option value='<?php echo $roomnorenew ; ?>'><?php echo getroomno($roomnorenew)." (No of Bed ". ($hroomnoa).")" ; ?></option>
                          </select>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
						  	  <label for="heard">Room Fee Per Month</label>
                            	  <div  id="txtamtid" ><input type="text" name='amt' id="amt" class="form-control "   value="<?php echo $unitamt; ?>" readonly>
                      </div>  </div>
                             <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
<label for="heard">Duration</label>

<select name="duration" id="duration" class="form-control"  <?php echo $dayremain ; ?> >
<option value="<?php echo $roomduration; ?>">Select Duration in Month</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>

</div> 
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
<label for="heard">Check in Date</label>
<input  type="text" name="cdate" size="29"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed"   readonly="readonly" style="height:32px;"  value="<?php echo $hallotdatea; ?>">
</div>

<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
<label for="heard">Room Status</label>

<select name="astatus" id="astatus" class="form-control" >
<option value="<?php echo $hallatstatusa; ?>">Select Room Status</option>
<option value="1">Check in</option>
<option value="0">Check out</option>

</select>

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
                         
                        <button  name="editallot"  id="editallot"  class="btn btn-primary col-md-4" title="Click Here to Save Hostel Details" ><i class="fa fa-save"></i> Save </button>
                        <button  name="goback"  id="goback" type='button' onClick="window.location.href='add_Hostel.php?view=allotR';" class="btn btn-primary col-md-4" title="Click Here to Go back to Room allocation register" ><i class="fa fa-caret-left"></i> Go Back</button>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addhostel').tooltip('show');
	                                            $('#addhostel').tooltip('hide');
	                                            });
	                                            </script>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 