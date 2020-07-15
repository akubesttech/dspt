<?php 
//session_start();
 //include('admin/lib/dbcon.php'); 
//dbcon(); 

//$query= mysql_query("select * from schoolsetuptd ")or die(mysql_error());
							//  $row = mysql_fetch_array($query);
						?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="edo state polytechnic,edo poly,edo state institute of technology and management,usen polytechnic,usen poly,near okada." />
<title>Contact us! .::Delta State Polytechnic, Otefe - Oghara ::.</title>
<meta name="keywords" content="keywords" content="edo state polytechnic,edo poly,edo state institute of technology and management,usen polytechnic,usen poly,near okada." />
<meta name="description" content="keywords" content="edo state polytechnic,edo poly,edo state institute of technology and management,usen polytechnic,usen poly,near okada." />
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<link href="css/style_demo.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" type="image/x-icon" href="css/images/favicon.ico" />
<script src="js/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.jcarousel.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.jcarousel.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/functions.js" type="text/javascript" charset="utf-8"></script>
<!--[if IE 6]>
<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
<script src="js/png-fix.js" type="text/javascript" charset="utf-8"></script>
<![endif]-->
</head>
<body>
<!-- START PAGE SOURCE -->
<div class="header">
  <div class="shell">
    <h1 id="logo"><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span></span></a></h1>
    <div id="navigation">
     <ul>
        <li><a href="index.php" >Home</a></li>
        <li><a href="#">Programs</a></li>
        <li><a href="#">Admission</a></li>
        <li><a href="Userlogin.php">Portal</a></li>
        <li><a href="contact.php" class="active">Contact</a></li>
        
      </ul>
    </div>
  </div>
</div>
<div class="shell">
  <div class="head">
  
    <div class="slider" id="mycarousel">
      <div class="slider-holder">
       
        
        <ul>
          <li><img src="css/images/slide1.png" alt="" /></li>
          <li><img src="css/images/slide2.png" alt="" /></li>
          <li><img src="css/images/slide3.png" alt="" /></li>
        </ul>
       
        
      </div>
      <div class="slider-navigation">
        <div class="slide-link">
          <div class="img"><a href="#" rel="1"><img src="css/images/slide1.png" alt="" width="115" height="115" /></a></div>
          <div class="shadow">&nbsp;</div>
        </div>
        <div class="slide-link">
          <div class="img"><a href="#" rel="2"><img src="css/images/slide2.png" alt="" width="115" height="115" /></a></div>
          <div class="shadow">&nbsp;</div>
        </div>
        <div class="slide-link last">
          <div class="img"><a href="#" rel="3"><img src="css/images/slide3.png" alt="" width="115" height="115" /></a></div>
          <div class="shadow">&nbsp;</div>
        </div>
        
      </div>
    </div>
    
    <div class="info-box">
     <h2><a href="#">HND ADMISSION FOR 2017/2018 ACADEMIC SESSION</a></h2>
      <div class="info-box-cnt">
        <p align="justify">HND application for the 2017 / 2018 academic session is now open. </p>
      </div>
      <a href="#" class="button"><span></span>Next</a> </div>
      
    <div class="info-shadow"></div>
  </div>
  <div class="container">
    <h1 class="shadowed" style="color:black;text-shadow:-1px 1px 1px #000;">Delta State Polytechnic, Otefe - Oghara</h1>
   
    
    <div class="entry">
    
      <div class="left-content">
        <div class="abs-ico"></div>
        <h2><a href="#" style="color:black;text-shadow:-1px 1px 1px #000;">Contact Address</a></h2>
        <p>P. O. Box 67 Asaba<br>
P. M .B 4 Asaba
Delta State
info@ogharapoly.edu.ng<br>
0806 959 0444 </p>
         </div>
      <div class="right-content">
        <div class="abs-ico"></div>
        <h2><a href="#" style="color:black;text-shadow:-1px 1px 1px #000;">Quick Inquiry</a></h2>
        <div class="inner_right_demo">
		<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			<input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
			<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			<div class="form_box">
			 <div class="clear">
        <table width="200" height="100" >
        <tr style="">
    <td colspan="4" height="36" width="69%"><center><?php
if($resi == 1)
{

echo " <div class=\"alert alert-info\"><i class=\"icon-info-sign\"></i> $res </div> ";
					//echo " $res";
}
?></center></td>
    </tr>
	

  <tr>
  <td width="19%">Name:</td>
    <td width="31%"><input type="text" name="massagename" id="massagename" required="required"></td>
 </tr>
 
 <tr>
  <td width="19%">Email:</td>
    <td width="31%"><input type="text" name="massageemail" id="massageemail" required="required"></td>
 </tr>
  <tr>
  <td width="19%">Subject:</td>
    <td width="31%"><input type="text" name="subject" id="subject" required="required"></td>
 </tr>
 
 <tr>
  <td width="19%">Message:</td>
    <td width="31%"><textarea name="message" id="message" required="required" cols="6"></textarea></td>
 </tr>
 
   <tr >
    <td width="19%" height="20"></td>
    
  </tr>
		
		<tr >
          <td height="10"></td>
          <td  height="10">
          
          <button name="Login_Continue" class="Button1" id="button1" data-placement="right" type="submit" title="Click to Submit"><i class="icon-plus-sign icon-large"> Submit</i></button>
        
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
		</div>
        </div>
      <div class="cl">&nbsp;</div>
    </div>
    
    
    
    <div class="boxes-holder">
    
    
      
      <div class="cl">&nbsp;</div>
    </div>
    
    
  </div>
</div>

<div class="footer-cols">
  <div class="shell">
    <div class="col first-col">
      <h2>Subscribe To Our News Update</h2>
      <div class="form">
        <form action="#" method="post">
          <span class="field">
          <input type="text" class="blink"  placeholder="Enter Email here ..." type="text" />
          </span>
          <input type="submit" class="form-submit" value="Submit" />
          <div class="cl">&nbsp;</div>
        </form>
      </div>
    </div>
    <div class="col">
      <h2>Quick Links</h2>
   <ul>
        <li><a href="#">Apply For Admission </a></li>
        <li><a href="#">Schools/Courses</a></li>
        <li><a href="#">Academic Calender</a></li>
        <li><a href="Userlogin.php">Portal Login </a></li>
      </ul>
    </div>
    <div class="col last-col">
      <h2>Lets Connect</h2>
      <ul>
        <li><a href="#">Visit us on Facebook</a></li>
        <li><a href="#">Follow us on Twitter</a></li>
        <li><a href="#">Keep an eye on our News Update</a></li>
        <li><a href="#">Get support</a></li>
      </ul>
    </div>
    <div class="cl">&nbsp;</div>
  </div>
</div>
<div class="footer">
  <div class="shell">
 <p class="lf">Copyright &copy; 2017 <a href="#">Delta State Polytechnic, Otefe - Oghara.</a> - All Rights Reserved</p>
    <p class="rf"><a href="http://www.demadiur.com/" target="_blank"><!--Powered by UCNET Technologies --!>
    <img src="css/images/footlogo.png" alt="" width="257" height="30" />
</a></p>
    <div style="clear:both;"></div>
  </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>