<?php include('header.php'); ?>
<style>
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}
.button4 {
    background-color: white; 
    color: black; 
    border: 2px solid #4CAF50;
}

.button4:hover {
    background-color: #4CAF50;
    color: white;
}
</style>
<div class="container">
    <h1 class="shadowed" style="color:black;text-shadow:-1px 1px 1px #000;">User Login Panel </h1>
      <div class="boxes-holder" style="background-color:#D9F7FD;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:980px;min-width:150px;box-shadow:0 1px 1px gray">
      
      <div class="entry products">
       <h4 style="color:orange;text-shadow:0 2px 1px black;">Please Note That Every Activity From Here is logged.</h4><br>
      
		<div class="row-fluid">
		
			<div class="span8"><div class="pull-right">
      			  	<table width="100%">
<tbody><tr><td colspan="2" height="10" width="10%" ></td><td height="5">


			  <div id="layer-log" >
			  
			<form id="login_form1" class="form-signin" method="POST">
			<br>
				<h3 class="form-signin-heading">
			
					<i class="icon-lock"></i> Please Login 
				</h3>
					
				<input type="text"      class="input-block-level"   id="username" name="username" placeholder="Enter your Username or Reg No" required>
				<input type="password"  class="input-block-level"   id="password" name="password" placeholder="Password" required>
					  
			<?php
//$config = mysql_fetch_array(mysql_query(" SELECT * FROM schoolsetuptd "));
//if($config['captcha'] == '1') {
?>
 <div class="element-input"><label class="title">Solve the Captcha<span class="required">*</span></label>
    <img src="captcha1/captcha.php" id="captcha" /><br/>
    <a href="#" onClick="
    document.getElementById('captcha').src='captcha1/captcha.php?'+Math.random();
    document.getElementById('captcha-form').focus();"
    id="change-image">Not readable? Change text.</a><br/>
	
	<input class="medium" type="text" name="captcha" id="captcha-form"  required="required"/></div>
	

<?php
//}
?>
				<br/>
				<button  title="Click Here to Sign In" id="signin" data-placement="right" name="login" class="btn btn-info" type="submit"><i class="icon-signin icon-large"></i> Sign in</button>
							<!--	<a  rel="facebox" href='apply_b.php?view=Old'><h5><font face="sans-serif" style="italic">Old/Returning Student Registration</font></h5></a> --!>
				<a  rel="facebox" href='Up_recover.php'><h5><font face="sans-serif" style="italic">Forgotten your password?</font></h5></a>
				<br> <!-- <button class="btn btn-info" >&nsub;&nsub; Student &nsub;&nsub;</button> --!>
				
					<button  title="Click Here to Apply" id="save1" name="B2" class="btn btn-primary col-md-4" onClick="window.location.href='apply_b.php';" type="reset"><i class="fa fa-reply"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; New Student Application &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button><br><br>
					
					<button  title="Click Here to Check Your Entrance Exam Result" id="save2" name="B2" class="btn btn-primary col-md-4" onClick="window.location.href='apply_b.php?view=C_R';" type="reset"><i class="fa fa-reply"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Entrance Exam Result &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button><br><br>
					
					<button  title="Click Here to Registration" id="save3" name="B2" class="btn btn-primary col-md-4" onClick="window.location.href='apply_b.php?view=Old';" type="reset"><i class="fa fa-reply"></i>&nbsp;&nbsp;&nbsp;&nbsp; Old/Returning Student Registration&nbsp;&nbsp;&nbsp;&nbsp; </button>
				
				<script type="text/javascript">
				$(document).ready(function(){
		$('#signin').tooltip('show');	$('#save1').tooltip('show');	$('#save2').tooltip('show');	$('#save3').tooltip('show');
		$('#signin').tooltip('hide'); 	$('#save1').tooltip('hide'); 	$('#save2').tooltip('hide');	$('#save3').tooltip('hide');
				});
				</script>  </td> <td colspan="2" height="10" >
				

</td>
					<tr>
  <td colspan="2" height="10" valign="middle"></td>
  </tr>	
			</form>
			<?php $num="true_admin"; ?>
						<script>
						jQuery(document).ready(function(){
						jQuery("#login_form1").submit(function(e){
								e.preventDefault();
								var formData = jQuery(this).serialize();
								$.ajax({
									type: "POST",
									url: "logins.php",
									data: formData,
									success: function(html){
									if(html=='<?php echo $num; ?>')
									{
									$.jGrowl("Loading File Please Wait......", { sticky: true });
									$.jGrowl("Welcome to <?php echo $row['SchoolName']; ?>", { header: 'Access Granted' });
									var delay = 1000;
										setTimeout(function(){ window.location = 'admin/index.php'  }, delay);  
									}else if (html == 'true'){
									$.jGrowl("Loading Staff Window Please Wait......", { sticky: true });
										$.jGrowl("Welcome to <?php echo $row['SchoolName']; ?>", { header: 'Access Granted' });
									var delay = 1000;
										setTimeout(function(){ window.location = 'Staff/index.php'  }, delay); 
										}else if (html == 'true_student'){
										$.jGrowl("Welcome to <?php echo $row['SchoolName']; ?>", { header: 'Access Granted' });
									var delay = 1000;
										setTimeout(function(){ window.location = 'Student/index.php'  }, delay); 
									}else{
									$.jGrowl("Please Check your Username and Password <br> or Your Account is Inactive Please Contact Admin <br> or Your Captch Verification is Wrong", { header: 'Login Failed' });
										
									}
									}
								});
								return false;
							});
						});
						</script>
			  </div>
			
			
</tr>
</tbody></table>
  <div class="cl">&nbsp;</div>
    </div>
    </div></div>
			
		</div>
	
      </div>

</div><br>
<?php include('footer.php'); ?>
   

