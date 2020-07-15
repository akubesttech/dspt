<?php if($_GET['p_id'] != md5($_SESSION['spayid'])){
echo "<script>window.location.assign('apply_b.php?view=M_P');</script>";
} ?>
  <div class="container">
    <h1 class="shadowed" style="color:black;text-shadow:-1px 1px 1px #000;"> Post UTME EXAM RESULT CHECKER </h1>
    
   
    <div class="boxes-holder" style="background-color:#D9F7FD;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:980px;min-width:150px">
   
       <div class="entry products">
       <h3 style="color:orange;text-shadow:0 2px 1px black;">Student Payment Information Preview .</h3><br>
       
       
       	<div id="center">

		<div class="inner_right_demo">
		<form name="register2" action="https://voguepay.com/pay/" method="post" enctype="multipart/form-data" id="register2">
			<input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
			<input type='hidden' name='v_merchant_id' value='9919-0054594' />
			<input type='hidden' name='merchant_ref' value='234-567-890' />
			<input type='hidden' name='notify_url' value='http://www.ucnettechnologies.net/notification.php' />
            <input type='hidden' name='success_url' value='http://www.ucnettechnologies.net/thank_you.php' />
             <input type='hidden' name='fail_url' value='http://www.ucnettechnologies.net/failed.php' />
            <input type='hidden' name='memo' value='<?php echo $_SESSION['sfee'];?>' />
			<input type='hidden' name='total' value='<?php echo $_SESSION['amount'];?>' />
			<div class="form_box">
			 <div class="clear">
        <table width="700" height="100" border="0">
        
        
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
    <td colspan="5" height="39" style="text-shadow: 2px 2px white;"><strong>&nbsp;Transaction Summary </strong></td>
    
    </tr>
    
   <tr>
    <td width="19%" height="20" colspan="5"></td>
    </tr>
    
  <tr class="row1">
  <td width="20%" colspan="1" height="20"><strong>Application ID:</strong></td>
    <td width="35%" colspan="4"><?php echo $_SESSION['spayid']; ?></td>
   </tr>
  <tr class="row2">
  <td width="20%" colspan="1" height="15"><strong>Full Name:</strong></td>
    <td width="31%" colspan="4"><?php echo $_SESSION['Fnamep']; ?></td>
    </tr>
    <tr class="row1">
  <td width="20%" colspan="1" height="20"><strong>Email:</strong></td>
    <td width="20%" colspan="1"><?php echo $_SESSION['emailp']; ?></td>
      <td width="20%" colspan="1" height="20"><strong>Mobile No:</strong></td>
    <td width="20%" colspan="1"><?php echo $_SESSION['mobile']; ?></td>
   </tr>
   <tr class="row2">
   <td width="20%" colspan="1" height="20"><strong>Department:</strong></td>
    <td width="20%" colspan="1"><?php echo $_SESSION['paydepart']; ?></td>
      <td width="20%" colspan="1" height="20"><strong>Academic Session:</strong></td>
    <td width="20%" colspan="1"><?php echo $_SESSION['sessionpay'];?></td>
   </tr>
   <tr class="row1">
    <td width="20%" colspan="1" height="20"><strong>Payment Description:</strong></td>
    <td width="20%" colspan="4"><?php echo $_SESSION['sfee'] ;?></td>
     
   </tr>
<tr class="row2">
    <td width="20%" colspan="1" height="20"><strong>Amount:</strong></td>
    <td width="20%" colspan="4"><strike>N</strike><?php echo " ".number_format($_SESSION['amount'],2); ?></td>
     
   </tr>


    
   <tr class="row1">
    <td width="19%" height="20" colspan="5"></td>
    </tr>
		
		<tr style="border-width: 0px;text-align:left;padding-top: 20px;">
          <td height="10" colspan="1">&nbsp;&nbsp;&nbsp;&nbsp; <button name="Login_Reprint" class="Button1" id="button1" data-placement="right" type="submit" title="Click to Make Payment"><i class="icon-plus-sign icon-large">Pay Now</i></button></td>
          <td  height="10" colspan="4">
          <img src="css/images/epaylogo.png" width="224" height="50"></a>
         
      
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