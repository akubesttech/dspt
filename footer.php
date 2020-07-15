<section id="footer">
        <footer role="contentinfo">
            <div class="container-fluid footer-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="container footer padding-lg-top padding-md-bottom">
                            <div class="row">
                                        <div class="col-xs-12 col-sm-4 quick-links">
            <h2><a href="apply_b.php?view=About">About CMSystem</a></h2>

            <ul class="menu">
                   <!-- <li><a href="#">Before You Start</a></li> --!>
                    <li><a href="apply_b.php?view=Application_Process">Application Process</a></li>
                    <!--<li><a href="Our_institution.htm">Participating Institutions</a></li>--!>
            </ul>

        </div>
        <div class="col-xs-12 col-sm-4 quick-links">
            <!--<h2><a href="#">Need More Information?</a></h2> --!>
<h2><a href="post.php?view=Program">Our School Programmes</a></h2>
            <ul class="menu">
            <?php $getfaculty_query = mysqli_query($condb,"select * from faculty  Order by fac_name ASC ")or die(mysqli_error($condb)); 
if(mysqli_num_rows($getfaculty_query) > 0)
    { $number = 1; while($row_s = mysqli_fetch_array($getfaculty_query)){ $facno = $row_s['fac_id'];   ?>
                    <li><a href="javascript:void(0);" onclick="window.open('post.php?view=Dept&facid=<?php echo $facno;?>','_self')"><?php echo $number.". ". $row_s['fac_name']; ?></a></li>
                    <?php $number ++;}}else{ ?>
                             <li>
                                <a>  No Available Programme </a>
                            </li>
                   <!-- <li><a href="#">Graduate Studies</a></li>
                    <li><a href="#">International Students</a></li>
                    <li><a href="#">Continuing Education</a></li>
                    <li><a href="#">Apprenticeship Programs</a></li> --!>
                   <?php } ?>  
            </ul>

        </div>
        <div class="col-xs-12 col-sm-4 quick-links">
            <h2><a href="apply_b.php?view=Help">Help</a></h2>

            <ul class="menu">
                   <!-- <li><a href="#">System Availability</a></li> --!>
                    <li><a href="apply_b.php?view=FAQ">Frequently-Asked Questions</a></li>
            </ul>

        </div>


<div class="col-xs-12 privacy-copyright">
        <a href="#">Privacy Policy</a>
            <div class="divider"></div>
            <span class="copyright"> &copy; 2018 Campus Management System, All Rights Reserved </span>
        <div class="divider"></div>
                    <!--<a href="http://www.demadiur.com"> --!><a href="https://smartdelta.com.ng/">
                         Powered by Delta State Smart City.<!-- ©  --!>
                    </a>
</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </section>
    
     <div class="modal hide" id="myModalat">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">x</button>
            <h3>Login to MyWebsite.com</h3>
          </div>
          <div class="modal-body">
            <form method="post" action='' name="login_form">
              <p><input type="text" class="span3" name="eid" id="email" placeholder="Email"></p>
              <p><input type="password" class="span3" name="passwd" placeholder="Password"></p>
              <p><button type="submit" class="btn btn-primary">Sign in</button>
                <a href="#">Forgot Password?</a>
              </p>
            </form>
          </div>
          <div class="modal-footer">
            New To MyWebsite.com?
            <a href="#" class="btn btn-primary">Register</a>
          </div>
        </div>
    
 
      <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/modernizr.js"></script>
    <script src="assets/js/abca.js"></script>
    
	
    <?php include('script.php'); ?>
    <!-- CDF: No JS dependencies were declared //-->

</body></html>
