<?php
//session_start();

//ini_set('display_errors', 1);
if($_SESSION['insid']==$_POST['insid'])
{
if(isset($_POST['Continue'])){
 $Pin = $_POST["pin"];
$serial = $_POST["serial"];
	$_SESSION['temppin']=$Pin;
	$_SESSION['tempserial']=$serial;
	$sql_pin="SELECT * FROM pin WHERE pinnumber='$Pin' AND serial='$serial' AND status = 'NOTUSED'";
$result_pin = mysql_query($sql_pin);
$num_pin = mysql_num_rows($result_pin);


					if($num_pin < 1){

		$res="<font color='Red'><strong>Incorrect Pin and Serial Number Please Try Again.</strong></font><br>";
				$resi=1;
				}elseif(strpos($Pin," ")){
		$res="<font color='Red'><strong>Please! Pin can not Contain a Space..</strong></font><br>";
				$resi=1;
				}else{
				//header("location:apply_b.php?view=N_1");
				redirect("apply_b.php?view=N_1");
				//echo "<script>window.location.assign('location:apply_b.php?view=N_1');</script>";
			}

}}$_SESSION['insid'] = rand();
?>

  <div class="container">
   <br><br>
    <h1 class="shadowed" style="color:black;text-shadow:-1px 1px 1px #000;">Welcome to the Online Application For Admission </h1>
    
   
    <div class="boxes-holder" style="background-color:#D9F7FD;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:980px;min-width:150px">
   
       <div class="entry products">
       <h3 style="color:orange;text-shadow:0 2px 1px black;">This page will Enable You To Continue with Rest Of The application Process After Pin/Serial Number Verification.</h3><br>
       
       
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
    <td colspan="5" height="39" style="text-shadow: 2px 2px white;"><strong>&nbsp;Enter Card Payment Details</strong></td>
    
    </tr>

  <tr>
    <td width="19%">Pin:</td>
    <td width="31%"><input type="text" name="pin" id="pin" required="required" ></td>
    <td width="19%">Serial Number:</td>
    <td width="31%"><input type="text" name="serial" id="serial" required="required"></td>
    
    
  </tr>
   <tr >
    <td width="19%" height="20"></td>
    
  </tr>
		
		<tr >
          <td height="10"></td>
          <td  height="10">
          
          <button name="Continue" class="Button1" id="button1" data-placement="right" type="submit" title="Click to Contine"><i class="icon-plus-sign icon-large"> Continue</i></button>
												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#button1').tooltip('show'); $('#Button2').tooltip('show');
	                                            $('#button1').tooltip('hide');$('#Button2').tooltip('hide');
	                                            });
	                                            </script>
              <button name="buypin" class="Button1" id="button1" data-placement="right" type="submit" title="Click to Buy pin From Our Pin Shop" onClick="window.location.href='apply_b.php?view=p_sh';"><i class="icon-plus-sign icon-large"> Buy Pin</i></button>
             
            
											
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
