
<script type="text/javascript">
var xmlhttp



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


<?php

$s=3;
	while($s>0){
	$AppNo .= rand(0,9);

		$s-=1;
	}
//	if($_SESSION['insidroom']==$_POST['insidroom'])
//{
	if(isset($_GET['delid'])){
	$query_hosterme = mysqli_query($condb,"select * from roomdb where room_id = '".safee($_GET['delid'])."'")or die(mysqli_error($condb));
	$rsdel = mysqli_fetch_array($query_hosterme);
	$room_found = $rsdel['room_no'];
//$resroom="<font color='green'><strong>Room ".$room_found." was sucessfully Deleted..</strong></font><br>";
			//	$resi=1;
$resultdelid = mysqli_query($condb,"DELETE FROM roomdb where room_id='".safee($_GET['delid'])."'");
//$rsdel = mysqli_fetch_array($resultdelid);

echo "<script>alert('Room ".$room_found." was sucessfully Deleted..');</script>";
	echo "<script>window.location.assign('view_Rooms.php');</script>";
//	header("location: view_Rooms.php");
	//$_SESSION['insidroom'] = rand();
		}
	//	}$_SESSION['insidroom'] = rand();
?>
<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="addFee1" method="post"  id="addFee1">
	<input type="hidden" name="insidroom" value="<?php echo $_SESSION['insidroom'];?> " />
                      
                      <span class="section">Select Hostel to view Rooms <?php
                                          if($resi == 1)
{


					echo " 
		
			    <center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$resroom</font></label></center>
			 
			  ";
}
?> </span>


                          
                          
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Hostel Name</label>
                             <?php

echo"<select name='l_hostel'   onchange='accountDisplay(this.name);return false;' id='l_hostel' class='form-control'  required>";

echo"<option value='-1'>Select Hostel</option>";

$resultblocks = mysqli_query($condb,"SELECT * FROM hostedb where h_status='1'");
//$counter=1;
while($rsblocks = mysqli_fetch_array($resultblocks))
{
	if($_GET['blockid'] ==$rsblocks['h_code'] )
	{
	echo "<option value='$rsblocks[h_code]' selected>$rsblocks[h_name]</option>";
//	$counter=$counter+1;
	}
	else
	{
	echo "<option value='$rsblocks[h_code]'>$rsblocks[h_name]</option>";
	//$counter=$counter+1;
	}
}

echo "</select>";

echo "<div class='imgHolder' id='imgHolder'><img src='uploads/tabLoad.gif'></div>";
//echo " <input type='text' value='$rsblocks[h_code]'>";

?>
                      </div>
                    
                     
                    
                     
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                    
                        
                        	
									
                        </form>
                       </div> </div>
                 
				 <div class="x_panel">
                
             
                <div class="x_content">
                
               
               <div class="row">
 <div class="col-md-12" id='account_info'>   </div>
				
				
				</div> </div></div>