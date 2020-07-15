<?php 
session_start();
 include('../admin/lib/dbcon.php'); 
dbcon(); 

$query= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row = mysqli_fetch_array($query);
						?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="edo state polytechnic,edo poly,edo state institute of technology and management,usen polytechnic,usen poly,near okada." />
<title><?php echo $row['SchoolName'];  ?>  - Portal::.</title>

<meta name="keywords" content="keywords" content="edo state polytechnic,edo poly,edo state institute of technology and management,usen polytechnic,usen poly,near okada." />
<meta name="description" content="keywords" content="edo state polytechnic,edo poly,edo state institute of technology and management,usen polytechnic,usen poly,near okada." />
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<!--Stylesheets-->
	<link rel="stylesheet" href="css/style-menu.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/colour.css" type="text/css" media="all">

	<link rel="stylesheet" href="css/superfish.css" type="text/css" media="all">
	

	<!--Favicon-->
	<link rel="shortcut icon" href="http://www.myschool.net/favicon.html" type="image/x-icon">

	<!--JavaScript-->
	<script type="text/javascript" src="js/jquery_004.js"></script>

	<script type="text/javascript" src="js/superfish.js"></script>

	
	
<link rel="stylesheet" href="../css/coin-slider.css" type="text/css" media="screen">
<script type="text/javascript" src="../js/script.js"></script>
  <script src="../js/jquery.js" type="text/javascript"></script>

<!-- Bootstrap -->
			<!-- <link href="images/logo.png" rel="icon" type="image"> -->
			<link href="../images/logo.png" rel="icon" type="image">
				<link href="admin/bootstrap1/css/index_background.css" rel="stylesheet" media="screen"/>
				
				<link href="../admin/bootstrap1/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
				<link href="../admin/bootstrap1/css/bootstrap-responsive.min1.css" rel="stylesheet" media="screen"/>
				<link href="../admin/bootstrap1/css/font-awesome.css" rel="stylesheet" media="screen"/>
				<link href="../admin/bootstrap1/css/my_style.css" rel="stylesheet" media="screen"/>
				<link href="../admin/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen"/>
				<link href="../admin/assets/styles.css" rel="stylesheet" media="screen"/>
				<!-- calendar css -->
				<link href="../admin/vendors/fullcalendar/fullcalendar.css" rel="stylesheet" media="screen">
				<!-- index css -->
				<link href="../admin/bootstrap/css/index.css" rel="stylesheet" media="screen"/>
				<!-- data table css -->
				<link href="../admin/assets/DT_bootstrap.css" rel="stylesheet" media="screen"/>
				<!-- notification  -->
				<link href="../admin/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen"/>
				<!-- wysiwug  -->
				<link rel="stylesheet" type="text/css" href="admin/vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml51.css"/>
		<script src="../admin/vendors/jquery-1.9.1.min.js"></script>
        <script src="../admin/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  
     <script type="text/javascript" src="../js/coin-slider.min.js"></script> 
<!--[if IE 6]>
<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
<script src="js/png-fix.js" type="text/javascript" charset="utf-8"></script>
<![endif]-->
<link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<link href="../style1.css" rel="stylesheet" type="text/css">
<link href="css/style_demo.css" rel="stylesheet" type="text/css" />

   <script>
function isNumber(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>

 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>
     <center>
