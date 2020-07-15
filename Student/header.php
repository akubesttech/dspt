 

  
  <?php 
session_start();

include('../admin/lib/dbcon.php'); 
dbcon(); 
//require_once './function.php';
?>
<?php 

$query= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row = mysqli_fetch_array($query);
							  $s_utme = $row['p_utme'];
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
    <link href="../font-awesome-4.7.0/css/font-awesome.css1" rel="stylesheet" media="print"/>
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker1.css" rel="stylesheet">
    <script type="text/javascript" src="../admin/bootstrap/js/datepicker.js"></script>
        <link rel="shortcut icon" href="https://edu.smartdelta.com.ng/favicon2.ico" type="image/x-icon">
    <link rel="icon" href="https://edu.smartdelta.com.ng/favicon2.ico" type="image/x-icon">
        <link href="../admin/bootstrap/css/datepicker.css" rel="stylesheet" type="text/css" />
 <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Custom Theme Style -->
  
        
    <link href="../build/css/custom.min.css" rel="stylesheet">
    	<link href="../vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="print"/>
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
    <link type="text/css" rel="stylesheet" href="../admin/ia63bs.css" />
      <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="./plugins/iCheck/all.css">

	<style>
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
#bday
{
 -webkit-animation: head1_animate 1s infinite;
 -moz-animation: head1_animate 1s infinite;
 animation: head1_animate 1s infinite;
}
@-webkit-keyframes head1_animate {
 0%{-webkit-transform: scale(1.0);} 
 40% {-webkit-transform: scale(1.11);}
 80%{-webkit-transform: scale(1.12);}
 100%{-webkit-transform: scale(1);}
}
@-moz-keyframes head1_animate {
 0%{-moz-transform: scale(1.0);} 
 40% {-moz-transform: scale(1.11);}
 80%{-moz-transform: scale(1.12);}
 100%{-moz-transform: scale(1);}
}
@keyframes head1_animate {
 0%{transform: scale(1.0);} 
 40% {transform: scale(1.11);}
 80%{transform: scale(1.12);}
 100%{transform: scale(1);}
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
.row1 {
	background-color: #EFEFEF;
		border: 1px solid #98C1D1;
		height: 30px;	font-family:Verdana, Geneva, sans-serif; 
	font-size:12px; 
}

.row2 {
	background-color: #DEDEDE;
	border: 1px solid #98C1D1;
		height: 30px;
			font-family:Verdana, Geneva, sans-serif; 
	font-size:12px; 
}

	</style>



  </head>

   <body class="nav-md">
   
    <div class="container body">
      <div class="main_container">
      
     