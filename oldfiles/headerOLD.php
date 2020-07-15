<?php 
session_start();
 include('./admin/lib/dbcon.php'); 
dbcon(); 

$query= mysql_query("select * from schoolsetuptd ")or die(mysql_error());
							  $row = mysql_fetch_array($query);
						?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="edo state polytechnic,edo poly,edo state institute of technology and management,usen polytechnic,usen poly,near okada." />
<title>Welcome ! .::Delta State College Of Health Technology, Ofuoma Ughelli - Portal::.</title>
<meta name="keywords" content="keywords" content="edo state polytechnic,edo poly,edo state institute of technology and management,usen polytechnic,usen poly,near okada." />
<meta name="description" content="keywords" content="edo state polytechnic,edo poly,edo state institute of technology and management,usen polytechnic,usen poly,near okada." />
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<link href="layout/styles/layout21.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" type="image/x-icon" href="css/images/favicon.ico" />
<script src="js/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.jcarousel.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.jcarousel.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/functions.js" type="text/javascript" charset="utf-8"></script>

<link href="admin/bootstrap1/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
	<link href="admin/bootstrap1/css/font-awesome.css" rel="stylesheet" media="screen"/>
	
	
		<!-- notification  -->
				<link href="admin/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen"/>
					<!-- wysiwug  -->
				<link rel="stylesheet" type="text/css" href="admin/vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css"/>
		<script src="admin/vendors/jquery-1.9.1.min.js"></script>
        <script src="admin/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<!--[if IE 6]>
<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
<script src="js/png-fix.js" type="text/javascript" charset="utf-8"></script>
<![endif]-->
<script>
            $(document).ready(function(){
                $( "#endDate" ).datepicker({
                    dateFormat: 'yy-mm-dd',
                    showOn: "button",
                    buttonImage: "../uploads/calendar.gif",
                    buttonImageOnly: true
                });
            });
        </script>
</head>
<body>
<!-- START PAGE SOURCE -->
<div class="header2">
  <div class="shell">
    <h1 id="logo2"><!--<a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delta State College Of Health Technology<span>..knowledge for health</span></a>--!></h1>
    <div id="navigation">
      <ul>
        <li><a href="index.php" >Home</a></li>
        <li><a href="#">Programs</a></li>
        <li><a href="#">Admission</a></li>
        <li><a href="Userlogin.php" class="active">Portal</a></li>
        <li><a href="contact.php">Contact</a></li>
        
      </ul>
    </div>
  </div>
</div>
<div class="shell">
  <div class="head">
  
   
    
    
  </div>