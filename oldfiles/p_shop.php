
<script>
function showroomno(str)
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
xmlhttp.open("GET","loadamt.php?q="+str,true);
xmlhttp.send();
}
</script>
<?php
//session_start();

//ini_set('display_errors', 1);
if($_SESSION['insid']==$_POST['insid'])
{
if(isset($_POST['buyformp'])){
 $phone1 = $_POST["phone1"];   $semail = $_POST["semail"];$famt = $_POST["amt"];



	$sql_pinn2=mysql_query("SELECT fpay_status FROM fshop_tb WHERE femail ='$semail' AND  fpay_status = '1'");
$num_pinn2 = mysql_num_rows($sql_pinn2);
	$result_ph=mysql_query("SELECT * FROM fshop_tb WHERE femail='$semail'");
$num_ph = mysql_num_rows($result_ph);
//$sub_user = $num_pinn2['reg_status'];
	//$_SESSION['tempserial']=$num_serialNo;
	if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $_POST['semail'])){
		$res="<font color='Red'><strong>Please! Provide a valid Email Address...</strong></font><br>";
				$resi=1;
				}elseif($num_ph > 0){
$res="<font color='Red'><strong>Another Person Has ordered for Pin with This Email '$semail' Before.</strong></font><br>";    $resi=1;
				//	}elseif($num_pinn < 1){
//$res="<font color='Red'><strong>Incorrect Pin and Application Number Please Try Again.</strong></font><br>";
				//$resi=1;
				}elseif($famt == "0.00" ){
		$res="<font color='Red'><strong>No Payment Amount Found For This Order!</strong></font><br>";
				$resi=1;
			   }elseif($num_pinn2 > 0){
		$res="<font color='Red'><strong>Pin Order with this Email '$semail' Has Been Processed ,Check Your mail For Details!</strong></font><br>";
				$resi=1;
				}else{
		$_SESSION['snamef'] = $_POST["sname1"];
$_SESSION['oname'] = $_POST["oname1"];
//$_SESSION['Fnamep'] = $payeefullname;
$_SESSION['mobile'] =  $phone1;
$_SESSION['emailp'] = $semail;
$_SESSION['ftype2'] = $_POST["ftype"];
$_SESSION['amount'] = $famt;
		echo "<script>window.location.assign('apply_b.php?view=ep_view&o_id=".md5($semail)."');</script>";
			}

}}$_SESSION['insid'] = rand();


?>

  <div class="container">
  <br><br>
    <h1 class="shadowed" style="color:black;text-shadow:-1px 1px 1px #000;">Welcome to Our Pin Shop </h1>
    
   
    <div class="boxes-holder" style="background-color:#D9F7FD;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:980px;min-width:150px">
   
       <div class="entry products">
       <h3 style="color:orange;text-shadow:0 2px 1px black;">This page will Enable You To Continue with Pin Purchase From Our Pin Shop.</h3><br>
       
       
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
    <td colspan="5" height="39" style="text-shadow: 2px 2px white;"><strong>&nbsp;Pin Purchase Information</strong></td>
    
    </tr>

  <tr>
  <td width="19%">Surname:</td>
    <td width="31%"><input type="text" name="sname1" id="sname1" required="required"></td>
    <td width="19%">Othername:</td>
    <td width="31%"><input type="text" name="oname1" id="oname1" required="required" ></td>
    </tr>
    <tr>
    <td width="19%">Email:</td>
    <td width="31%"><input type="text" name="semail" id="semail" required="required"></td>
    <td width="19%">Phone:</td>
    <td width="31%"><input type="text" name="phone1" id="phone1" required="required" ></td>
     </tr>
       <tr>
         <td width="30%">Form Type:</td>
    <td width="31%"><select class="input-medium"   name="ftype" id="ftype" onchange="showroomno(this.value)" required="required">
  <option value="">Select Form</option>
  
<?php  
$resultsec = mysql_query("SELECT * FROM prog_tb where status = '1' ORDER BY pro_id ASC");
while($rssec = mysql_fetch_array($resultsec))
{
echo "<option value='$rssec[Pro_name]'>$rssec[Pro_name]</option>";	
}
?>
</select></td>
    <td width="19%">Amount:</td>
    <td width="31%">
    <div  id="txtroomno" >
			  <input type="text" name="amt" id="amt" value="" placeholder="0.00"  required="required" readonly  >
			 
			  </div></td>
    
    
    
  </tr>
   <tr >
    <td width="19%" height="20"></td>
    
  </tr>
		
		<tr >
          <td height="10"></td>
          <td  height="10">
          
          <button name="buyformp" class="Button1" id="button1" data-placement="right" type="submit" title="Click to Buy Button To Continue Pin Shopping"><i class="icon-plus-sign icon-large"> Buy</i></button>
            <button name="Reprint" class="Button1" id="button1" data-placement="right" type="button"  title="Click  To Exit Pin Shop" onClick="window.location.href='apply_b.php?view=New';"><i class="icon-plus-sign icon-large"> Exit Shop</i></button>
												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#button1').tooltip('show');
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
