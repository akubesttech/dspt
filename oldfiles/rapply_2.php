<?php
//session_start();

//ini_set('display_errors', 1);
if($_SESSION['insid']==$_POST['insid'])
{
if(isset($_POST['Login_Reprint'])){
 $Pin = $_POST["pin"];
$serial = $_POST["serial"];
$nappNo21 = $_POST["nappNo21"];
	$_SESSION['temppin']=$Pin;

	$sql_pinr="SELECT * FROM new_apply1 WHERE Pin ='$Pin' AND appNo ='$nappNo21'";
$result_pinr = mysql_query($sql_pinr);
$num_pinr = mysql_num_rows($result_pinr);
$num_serialr = mysql_fetch_array($result_pinr);
$num_serialNo = $num_serialr['SerialNo'];
	$sql_pinn2="SELECT reg_status FROM new_apply1 WHERE Pin ='$Pin' AND appNo ='$nappNo21' AND reg_status = '0'";
$result_pinn2 = mysql_query($sql_pinn2);
$num_pinn2 = mysql_num_rows($result_pinn2);
//$sub_user = $num_pinn2['reg_status'];
	$_SESSION['tempserial']=$num_serialNo;
					if($num_pinr < 1){

		$res="<font color='Red'><strong>Incorrect Application Number and Pin  Please Try Again.</strong></font><br>";
				$resi=1;
				}elseif(strpos($Pin," ")){
		$res="<font color='Red'><strong>Please! Pin can not Contain a Space..</strong></font><br>";
				$resi=1;
			   }elseif($num_pinn2 > 0){
		$res="<font color='Red'><strong>Application with the Following Details '$Pin','$nappNo21' Has Not Been Submited</strong></font><br>";
				$resi=1;
				}else{
			//	header("location:apply_b.php?view=N_1");
				//echo "<script>alert('Your Application was Sucessfully Submited!');</script>";
		echo "<script>window.location.assign('studentappprint.php?applicationid=".md5($nappNo21)."');</script>";
			}

}}$_SESSION['insid'] = rand();
?>

  <div class="container">
   <br><br>
    <h1 class="shadowed" style="color:black;text-shadow:-1px 1px 1px #000;">Welcome to the Online Application For Admission </h1>
    
   
    <div class="boxes-holder" style="background-color:#D9F7FD;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:980px;min-width:150px">
   
       <div class="entry products">
       <h3 style="color:orange;text-shadow:0 2px 1px black;">This page will Enable You To Reprint Your Application Slip.</h3><br>
       
       
       	<div id="center">

		<div class="inner_right_demo">
		<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			<input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
			<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			<div class="form_box">
			 <div class="clear">
        <table width="300" height="100" >
        <tr style="">
    <td colspan="4" height="36" width="69%"><center><?php
if($resi == 1)
{

echo " <div class=\"alert alert-info\"><i class=\"icon-info-sign\"></i> $res </div> ";
					//echo " $res";
}
?></center></td>
    </tr>
		 <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
    <td colspan="5" height="39" style="text-shadow: 2px 2px white;"><strong>&nbsp;Enter Login Information</strong></td>
    
    </tr>

  <tr>
  <td width="19%">Application Number:</td>
    <td width="31%"><input type="text" name="nappNo21" id="nappNo21" required="required"></td>
    <td width="19%">Pin:</td>
    <td width="31%"><input type="text" name="pin" id="pin" required="required" ></td>
    
    
    
  </tr>
   <tr >
    <td width="19%" height="20"></td>
    
  </tr>
		
		<tr >
          <td height="10"></td>
          <td  height="10">
          
          <button name="Login_Reprint" class="Button1" id="button1" data-placement="right" type="submit" title="Click to Load Button To Reprint Application Slip"><i class="icon-plus-sign icon-large">Login</i></button>
          
												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#Button1').tooltip('show');
	                                            $('#Button1').tooltip('hide');
	                                            });
	                                            </script>
           
            
											
          </td>
          
          
        </tr>
		</table>
            
      </div>
	
			</div>
			</form>
		</div></div>
    
      
      
      <div class="cl">&nbsp;</div>
    </div>
    
    </div>
    
    <br><br>
  </div>
</div>
