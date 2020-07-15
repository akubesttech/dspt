<?php include("header.php"); 

?>

    <section id="content" role="document">
        <main style="min-height: 205px;">

            
<div class="container-fluid bkg-full-image" style="background-image: url(assets/media/apas-banner1.png?crop=0,0,0.0000000000000006315935428979,0.0017022886324954375&amp;cropmode=percentage&amp;width=1555&amp;height=377&amp;rnd=131776852160000000);">
    <div class="home-banner-shade"></div>
    <div class="row">
        <div class="col-xs-12 feature-text-content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <span> <?php $schoolname = $row['SchoolName'];  if(empty($row['SchoolName'])){ $nameschl = "Delta State Campus Managment System for tertiary institution";}else{$nameschl = $row['SchoolName']." ";} ?>
                          Welcome To <?php echo ucwords($nameschl); ?> <?php //echo getMacLinux(); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
   <div class="row">
    
        <div class="col-xs-12 col-sm-10 col-md-3">

                    <a class="home-feature-one" href="apply_b.php">
                        <h3>Apply Now!</h3><br><br>
                    </a>


        </div>
        
        <div class="col-xs-12 col-sm-10 col-md-3">

                   <!-- <a class="home-feature-two" href="https://applyalberta.ca/APAS.Web.Public/ApplicationServices/default.aspx?StartingAction=ApplyNow"> --!>
                   <a class="home-feature-two" href="apply_b.php?view=C_R">
                      <!--  <h3>Login to Resume Application</h3> --!>
                    <h3>PUTME Result/Admission Status</h3>
                    </a>

        </div>
        
        <div class="col-xs-12 col-sm-10 col-md-3">

                    <a class="home-feature-three" href="apply_b.php?view=Old">
                        <h3>Existing Student registration</h3><br><br>
                    </a>


        </div>
        <div class="col-xs-12 col-sm-10 col-md-3">

                   <!-- <a class="home-feature-two" href="https://applyalberta.ca/APAS.Web.Public/ApplicationServices/default.aspx?StartingAction=ApplyNow"> --!>
                   <a class="home-feature-two" href="Userlogin.php">
                      <!--  <h3>Login to Resume Application</h3> --!>
                   <!-- <h3>Old/Returning Students</h3>--!><br>
                   <h3>Student Login</h3><br><br><br>
                    </a>

        </div>


    </div>
</div>



<div class="container">

    <div class="row">
    
    <div class="col-xs-12 col-md-6 sidebar-right">
            
<div class="availability-box">
    <div class="availability-title">
        <h2>The Polytechnic</h2>
    </div>

    <div class="availability-content">
    <p>Delta State Polytechnic, Otefe-Oghara is a manifestation of an excellently conceptualized and articulated vision delivered for the benefit of humanity for entrepreneurial acquisition and advancement. The motto of technology for entrepreneurship underscores the fact of talent and technology skills advancement as tool for critical wealth creation.
It therefore explains the role of entrepreneurial and technological skills in creating the abilities, courage, capabilities and managerial competences necessary for economic growth and wealth creation within and beyond Delta State. 
</p>
<div class="view-all-maintenance">
                <p><a href="apply_b.php?view=Readmore1">View more details</a></p>
            </div>
</div>
</div>
        </div>
        
        <div class="col-xs-12 col-md-6 sidebar-right">
        <div class="availability-box">
    <div class="availability-title">
        <h2>Payment (NEW STUDENT)</h2>
    </div>

    <div class="availability-content">
<p>All Year one students that do not have Registration Number should 
					make their payment here with their application Number.</p>
<div class="view-all-maintenance">
                <p><a href="apply_b.php?view=M_P">Add Payment</a></p>
            </div>
</div>
</div>
    

        </div>
       </div>
       
       <!-- Row2 --!>
       
        <div class="row">
    
    <div class="col-xs-12 col-md-6 sidebar-right">
            
<div class="availability-box">
    <div class="availability-title">
        <h2>Our Schools/Courses </h2>
    </div>

    <div class="availability-content">
    <p>Coming Soon!</p>
<div class="view-all-maintenance">
                <p><a href="#">View more details</a></p>
            </div>
</div>
</div>
        </div>
        
        <div class="col-xs-12 col-md-6 sidebar-right">
            
<div class="availability-box">
    <div class="availability-title">
        <h2>Our Vision</h2>
    </div>

    <div class="availability-content">
     <p>To achieve the status of excellence in computing and information technology (I.T).</p>

            <div class="view-all-maintenance">
                <p><a href="#">View more details</a></p>
            </div>
</div>
</div>




        </div>
       </div>
       
</div>


        </main>
    </section>
    
    
    
    <?php include("footer.php"); 
	//$mac = shell_exec("arp -a ".escapeshellarg($_SERVER['REMOTE_ADDR'])." | grep -o -E '(:xdigit:{1,2}:){5}:xdigit:{1,2}'");
// Turn on output buffering  
   ob_start();  
   //Get the ipconfig details using system commond  
   system('ipconfig /all');  
   // Capture the output into a variable  
   $mycomsys=ob_get_contents();  
   // Clean (erase) the output buffer  
   ob_clean();  
   $find_mac = "Physical"; //find the "Physical" & Find the position of Physical text  
   $pmac = strpos($mycomsys, $find_mac);  
   // Get Physical Address  
   //$macaddress=substr($mycomsys,($pmac+36),17);  
   //Display Mac Address  
   //echo $macaddress; 
	?>
    <script>
	setInterval(function() {
    var currentTime = new Date ( );    
    var currentHours = currentTime.getHours ( );   
    var currentMinutes = currentTime.getMinutes ( );   
    var currentSeconds = currentTime.getSeconds ( );
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;   
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;    
    var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";    
    currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;    
    currentHours = ( currentHours == 0 ) ? 12 : currentHours;    
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
    document.getElementById("timer").innerHTML = currentTimeString;
}, 1000);
	</script>