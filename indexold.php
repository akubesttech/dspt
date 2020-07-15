<?php 
session_start();
 include('admin/lib/dbcon.php'); 
dbcon(); 

$query= mysql_query("select * from schoolsetuptd ")or die(mysql_error());
							  $row = mysql_fetch_array($query);
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
<link rel="shortcut icon" type="image/x-icon" href="css/images/favicon.ico" />
<script src="js/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.jcarousel.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.jcarousel.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/functions.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--[if IE 6]>
<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
<script src="js/png-fix.js" type="text/javascript" charset="utf-8"></script>
<![endif]-->
	
</head>
<body>
<!-- START PAGE SOURCE -->
<!--<div class="header">
  <div class="shell">
    <h1 id="logo"> --!> <!--<a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delta State College Of Health Technology<span>..knowledge for health</span></a>--!> <!--</h1>
    <div id="navigation">
      <ul>
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="program.php">Programs</a></li>
        <li><a href="admission.php">Admission</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li>  <a href="Userlogin.php">Portal</a>
		<a href="javascript:;">Portal</a>
					<ul>
							<li><a href="Our_History.php">Our History</a></li>
							<li><a href="#">Our Record</a></li>
							<li><a href="gallery.php">Our Gallery</a></li>
							</ul>
		</li>
        
        
      </ul>
    </div>
  </div>
</div> --!>
<div class="header">
<div class="shell">
<h1 id="logo"> </h1>
<div class="navbar">
  <a href="index.php" class="active">Home</a>
  <a href="program.php">Programs</a>
  <a href="admission.php">Admission</a>
  <div class="dropdown">
    <button class="dropbtn" >Portal
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content" >
      <a href="Userlogin.php">NCE Portal</a>
      <a href="#">Degree Portal</a>
      
    </div>
   
  </div> 
   <a href="contact.php">Contact</a>
</div>



</div></div>

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
    <!--
    <div class="info-box">
      <h2><a href="#">HND ADMISSION FOR 2017/2018 ACADEMIC SESSION</a></h2>
      <div class="info-box-cnt">
        <p align="justify">HND application for the 2017 / 2018 academic session is now open. </p>
      </div>
      <a href="#" class="button"><span></span>Next</a> </div>
      
    <div class="info-shadow"></div> --!>
  </div>
  <div class="container">
  <!--  <h1 class="shadowed" style="color:black;text-shadow:-1px 1px 1px #000;">Delta State College Of Health Technology, Ofuoma Ughelli - Campus </h1> --!>
    <h1 class="shadowed" style="color:black;text-shadow:-1px 1px 1px #000;">Delta State Polytechnic, Otefe - Oghara<?php echo md5("akubest");?></h1>
    <div class="entry products">
      <div class="product">
        <div class="img"><a href="apply_b.php"><img src="css/images/apply_logo.gif" alt="" /></a></div>
        <h3><a href="apply_b.php">Apply For Admission</a></h3>
      </div>
      <div class="product">
        <div class="img"><a href="apply_b.php?view=C_R"><img src="css/images/entrance.gif" alt="" /></a></div>
        <h3><a href="apply_b.php?view=C_R">Entrance Result</a></h3>
      </div>
      <div class="product last-product">
        <div class="img"><a href="apply_b.php?view=Old"><img src="css/images/check.gif" alt="" /></a></div>
        <h3><a href="apply_b.php?view=Old">Old/Returning Student</a></h3>
      </div>
      <div class="cl">&nbsp;</div>
    </div>
    <div class="entry">
      <div class="left-content">
        <div class="abs-ico"></div>
        <h2><a href="#" style="color:black;text-shadow:-1px 1px 1px #000;">The College</a></h2>
        <p><!--Studying at Delta State School of Nursing Warri (DSSNW) gives you the opportunity to explore our rich educational cultural heritage with extensive library resources and a stream of seasoned lecturers learning has never been so much fun! Following the creation of Delta state on 27th August 1991, the State Government commenced the execution of its own health care delivery services to the benefit of the citizens of the state. Thus the need for middle level health manpower became apparent.--!>
		Delta State Polytechnic, Otefe-Oghara was established through a bill that was signed into law by Governor James Onanefe Ibori in November 2002. This is the result of a partnership between the Delta State Ministry of Education and Westminster University, London. The partnership gave birth to the Delta State Higher Education Project (DSHEP).  Located in the agricultural town of Otefe in Ethiope West Local Government Area of Delta State.
		 </p>
        <a href="#" class="button"><span></span>Read More</a> 
		<div class="left-content">
        <div class="abs-ico"></div>
        <h2><a href="#" style="color:black;text-shadow:-1px 1px 1px #000;">Our Vision</a></h2>
        <p>To achieve the status of excellence in computing and information technology (I.T).
		 </p>
        <a href="#" class="button"><span></span>Read More</a> </div>
		</div>
        
        
      <div class="right-content">
        <div class="abs-ico"></div>
        <h2><a href="#" style="color:black;text-shadow:-1px 1px 1px #000;">Our Schools/Courses</a></h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc <a href="#">ornare</a> consequat tortor quis porttitor. Aliquam sed fringilla arcu. Maecenas sit amet <strong>cursus</strong> augue. Donec felis eros, luctus at blandit ac. Lorem ipsum dolor sit amet, consectetur <a href="#">adipiscing</a> elit.</p>
        <a href="#" class="button"><span></span>Read More</a> </div>
        
        
        <div class="right-content">
        <div class="abs-ico1"></div>
        <h2><a href="#" style="color:black;text-shadow:-1px 1px 1px #000;">Payment</a></h2>
        <p>All Year one  student that does not has Registration Number should make their payment here with their application Number.</p>
        <a href="apply_b.php?view=M_P" class="button"><span></span>Add Payment</a> </div>
        
      <div class="cl">&nbsp;</div>
    </div>
    
    <h1 class="shadowed" style="color:black;text-shadow:-1px 1px 1px #000;">OUR TEAM</h1>
    
    <div class="boxes-holder">
    
    <div id="product-slider">
    <ul>
    	<?php
			$result_show=mysql_query("select * from staff_details where u_display='TRUE'") or die (mysql_error());
			                if(mysql_num_rows($result_show) < 1) 
{
	echo "
	
	<li>
	<center>
      <div class='box'>
        
       <font color='green'> ..Loading Team Wait</font><img src='./admin/uploads/tabLoad.gif'>
	
      </div></center>	</li>
	";
	
}
else 
{
			while($row_show=mysql_fetch_array($result_show)){
		?>
    	<li>
    <!--  <div class="box">
        
        <div class="img"><a href="#"><img src="./admin/<?php echo $row_show['image'];?>" alt=""  width="272" height="145" /></a></div>
        <h2><a href="#"><?php echo $row_show['title']." .";?> <?php echo $row_show['sname']." ".$row_show['mname'];?></a></h2><br>
       <span>— <?php echo $row_show['position'];?></span><br>
		<span>— <?php echo $row_show['heq']." , ".$row_show['oder_quali'];?>.</span><br>
		<span>— <?php echo $row_show['cos'];?></span><br>
		
		<span>— <?php echo $row_show['phone'];?></span><br>
	
      </div> --!>
      <div class="card">
  <img src="./admin/<?php echo $row_show['image'];?>" alt="Avatar" style="width:100%;height:245px;">
  <div class="container">
    <h4><b><?php echo $row_show['title']." .";?> <?php echo $row_show['sname']." ".$row_show['mname'];?></b></h4> 
    <p><?php echo $row_show['position'];?></p> 
  </div>
</div>
      	</li>
      		 <?php }//else{ ?>
      		 
      		 
      		 	 <?php }?>
      		 <!--
      		<li>
      <div class="box">
        
        <div class="img"><a href="#"><img src="css/images/staff2.jpg" alt=""  width="272" height="145"/></a></div>
        <h2><a href="#">Dr Ester Anyanwu</a></h2><br>
       <span>— Lecturer II</span><br>
		<span>— B.A., M.A.</span><br>
		<span>— Igbo, African and Asian Studies</span><br>
		<span>— GS 108 and GS 109</span><br>
		<span>— 08063456788</span><br>
	
      </div>	</li>
      	<li>
      <div class="box last-box">
        
        <div class="img"><a href="#"><img src="css/images/staff3.jpg" alt=""  width="272" height="145"/></a></div>
        <h2><a href="#">Dr Ester Anyanwu</a></h2><br>
       <span>— Lecturer II</span><br>
		<span>— B.A., M.A.</span><br>
		<span>— Igbo, African and Asian Studies</span><br>
		<span>— GS 108 and GS 109</span><br>
		<span>— 08063456788</span><br>
	
      </div>
      
      	</li>--!>
      	</ul>
      	
      </div>
      
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
        <li><a href="#">Portal Login </a></li>
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
    <p class="rf"><a href="#" target="_blank"><!--Powered by UCNET Technologies --!>
    <img src="css/images/footlogo.png" alt="" width="257" height="30" />
</a></p>
    <div style="clear:both;"></div>
  </div>
</div>
<!-- END PAGE SOURCE -->

</body>
</html>


