 

  
  <?php 
//session_start();

include('lib/dbcon.php'); 
dbcon();

 session_start();
require_once './function.php';
?>
<?php 

$query= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row = mysqli_fetch_array($query);
							  $s_utme = $row['p_utme'];  $shows = $row['smat'];
						?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   <title>Dashboard | <?php echo $row['SchoolName'];  ?></title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../font-awesome-4.7.0/css/font-awesome.css1" rel="stylesheet" media="screen"/>
    <script language="JavaScript" type="text/javascript" src="wysiwyg.js"></script>
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker1.css" rel="stylesheet">
    <script type="text/javascript" src="bootstrap/js/datepicker.js"></script>
    <script type="text/javascript" src="assets/m_function.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <link href="bootstrap/css/datepicker.css" rel="stylesheet" type="text/css" />
         <link rel="shortcut icon" href="https://edu.smartdelta.com.ng/favicon2.ico" type="image/x-icon">
    <link rel="icon" href="https://edu.smartdelta.com.ng/favicon2.ico" type="image/x-icon">
 <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
   
    <!-- Custom Theme Style -->
    
        
    <link href="../build/css/custom.min.css" rel="stylesheet">
    	<link href="../vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen"/>
		 <link href="../plugins/bootstrap-fileinput.css" rel="stylesheet" type="text/css">
		 
    	 <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min1.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min1.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap1.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min1.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min1.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="../vendors/pnotify/dist/pnotify1.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.buttons1.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.nonblock1.css" rel="stylesheet">
    
<script type="text/javascript" src="../vendors/jquery/dist/jquery.min.js"></script>
    <link type="text/css" rel="stylesheet" href="ia63bs.css" />
 
 <link href="assets/js/jquery-ui.min.css" type="text/css" rel="stylesheet" >
  <script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
    <link href="bootstrap/js/facebox.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="bootstrap/js/facebox.js" type="text/javascript"></script>
  
    
    
    
	<style>
	.txtedit{
    display: none;
    width: 99%;
    height: 30px;
}
    .control-label
{
 -webkit-animation: head2_animate 2s infinite;
 -moz-animation: head2_animate 2s infinite;
 animation: head2_animate 2s infinite;
}
@-webkit-keyframes head2_animate {
 0%, 20%, 50%, 80%, 100% {-webkit-transform: translateY(0);} 
 40% {-webkit-transform: translateY(-30px);}
 60% {-webkit-transform: translateY(-15px);}
}
@-moz-keyframes head2_animate {
 0%, 20%, 50%, 80%, 100% {-moz-transform: translateY(0);} 
 40% {-moz-transform: translateY(-30px);}
 60% {-moz-transform: translateY(-15px);}
}
@keyframes head2_animate {
 0%, 20%, 50%, 80%, 100% {transform: translateY(0);} 
 40% {transform: translateY(-30px);}
 60% {transform: translateY(-15px);}
}
.alertm {
position: fixed;
    padding: 10px;
    background-color: #f44336;
    color: white;
    text-align: center;
  top: 30px;
  left: 40px;
  right: 20px;
   width: 95%;
   border-radius: 5px;
    z-index: 10;
   }
.alertm.success {background-color: #4CAF50;}
.alertm.info {background-color: #2196F3;}
.alertm.warning {background-color: #ff9800;}
.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}
.clickable2-row {cursor: pointer;}
	</style>

  </head>
<body class="nav-md" onload="StartTimers();" onmousemove="ResetTimers();">
   
   <?php //include('modal_alert.php'); ?>
    <div class="container body">
      <div class="main_container">
      
     