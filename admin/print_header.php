 
  <?php 
session_start();

include('lib/dbcon.php'); 
dbcon(); 
//require_once './function.php';
?>
<?php 
 $user_query = mysqli_query($condb,"select * from schoolsetuptd")or die(mysqli_error($condb));
													$row1 = mysqli_fetch_array($user_query);
													$id2 = $row1['id'];
													$s_utme = $row1['p_utme']; $s_logom = $row1['Logo'];
									
						?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <title>Print View | <?php echo $row1['SchoolName'];  ?></title>		   
        <!-- Bootstrap -->
			<!-- <link href="images/logo.png" rel="icon" type="image"> -->
			<link href="../images/logo.png" rel="icon" type="image">
		<link href="bootstrap1/css/index_background.css" rel="stylesheet" media="screen"/>
				
				<link href="bootstrap1/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
				<link href="bootstrap1/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
				<link href="bootstrap1/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"/>
				<link href="bootstrap1/css/font-awesome.css" rel="stylesheet" media="screen"/>
				<link href="bootstrap1/css/my_style.css" rel="stylesheet" media="screen"/>
				<link href="vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen"/>
				<link href="assets/styles.css" rel="stylesheet" media="screen"/>
				<!-- calendar css -->
				<link href="vendors/fullcalendar/fullcalendar.css" rel="stylesheet" media="screen">
				<!-- index css -->
				<link href="bootstrap/css/index.css" rel="stylesheet" media="screen"/>
				<!-- data table css -->
				<link href="assets/DT_bootstrap.css" rel="stylesheet" media="screen"/>
				<!-- notification  -->
				<link href="vendors1/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen"/>
				<!-- wysiwug  -->
				
		<script src="vendors1/jquery-1.9.1.min.js"></script>
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  		<script src="vendors1/jGrowl/jquery.jgrowl.js"></script>
    		<script src="vendors1/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
			<script src="vendors1/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
			
		 <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		 
		  
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          
        <![endif]-->
		 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    </head>
