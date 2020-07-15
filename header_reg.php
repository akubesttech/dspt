<?php 
session_start();
 include('./admin/lib/dbcon.php'); 
dbcon(); 

$query= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row = mysqli_fetch_array($query);
							  $sql45 = "SELECT * FROM news where status='TRUE' ORDER BY news_id desc LIMIT 0,20";  
 $result_do = mysqli_query($condb,$sql45);
						?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="edo state polytechnic,edo poly,edo state institute of technology and management,usen polytechnic,usen poly,near okada." />
<title>Welcome ! .::Delta State Polytechnic, Otefe - Oghara::.</title>
<meta name="keywords" content="keywords" content="edo state polytechnic,edo poly,edo state institute of technology and management,usen polytechnic,usen poly,near okada." />
<meta name="description" content="keywords" content="edo state polytechnic,edo poly,edo state institute of technology and management,usen polytechnic,usen poly,near okada." />
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<link href="layout/styles/layout21.css" rel="stylesheet" type="text/css" media="all">

<!-- notification  -->
<link href="admin/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen"/>
	<!-- wysiwug  -->
<link rel="stylesheet" type="text/css" href="admin/vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css"/>
		<script src="admin/vendors/jquery-1.9.1.min.js"></script>
        <script src="admin/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        
		<link href="spry/tabbedpanels/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="spry/tabbedpanels/SpryTabbedPanels.js" type="text/javascript"></script>
			
<link href="css/style_demo.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" type="image/x-icon" href="css/images/favicon.ico" />
<script src="js/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.jcarousel.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.jcarousel.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/functions.js" type="text/javascript" charset="utf-8"></script>

<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="js/vpb_news_scroller_loader.js"></script>
<!--[if IE 6]>
<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
<script src="js/png-fix.js" type="text/javascript" charset="utf-8"></script>
<![endif]-->

</head>
<body>
<!-- START PAGE SOURCE -->
<div class="header">
  <div class="shell">
    <h1 id="logo"><!--<a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delta State College Of Health Technology<span>..knowledge for health</span></a>--!></h1>
    <div id="navigation">
      <ul>
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="#">Programs</a></li>
        <li><a href="#">Admission</a></li>
        <li><a href="Userlogin.php">Portal</a></li>
        <li><a href="contact.php">Contact</a></li>
        
      </ul>
    </div>
  </div>
</div>

<div class="shell">
  <div class="head2" style="text-align:centre;">
<strong> <font color="red"> News Update </font> |</strong> 
 <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" width="850px"  >  
                <?php  
                if(mysqli_num_rows($result_do) < 1) 
{
	echo 'No News Avaliable at This Time check back later.';
	
}
else 
{
                     if(mysqli_num_rows($result_do) > 0)  
                     {  
                          while($row_do = mysqli_fetch_array($result_do))  
                          {  
echo ": :&nbsp;&nbsp;<a href='news_more.php?newsid=".$row_do['news_id']."' target='_blank' style='color: #ccc;font-family:Verdana, Geneva, sans-serif; font-size:14px;text-decoration: none;text-align:centre;'>'".ucfirst($row_do['news_title'])."'</a> .&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";  
                          }  
                     }  }
                ?>  
                </marquee> 

  </div>