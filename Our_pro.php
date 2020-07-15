    <section id="content" role="document">
        <main style="min-height: 168px;">
                    <div class="container">
                        

<div class="row">
    <div class="col-xs-12">
        <div id="breadcrumbs-share">
            <section id="breadcrumbs">
                <ul class="breadcrumb">
                                <li><a href=".<?php host(); ?>">Home</a> </li>
                                <li><a > School Programm</a> </li>


                    

                    

                </ul>
            </section>
        </div>
    </div>
</div>
                    </div>

            

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9">
            <div class="page-title-box">
                <h1 id="pageTitleStub">Our School Programmes </h1>
                
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9 margin-lg-bottom link-icons">
            <div class="row">
                <div class="col-xs-12 primary-content link-icons">
                    <p class="first-paragraph">Listed Below are the Programmes we offer in Our institution.</p>

                            <div class="row">
            <div class="col-xs-12 col-md-10">
                <ul class="link-list step-list">
<?php $getfaculty_query = mysqli_query($condb,"select * from faculty  Order by fac_name ASC")or die(mysqli_error($condb)); 
if(mysqli_num_rows($getfaculty_query) > 0)
    {
$number = 1;
while($row_s = mysqli_fetch_array($getfaculty_query)){ $facno = $row_s['fac_id'];   ?>
<!-- href="#step<?php //echo $number; ?>" --!>
                            <li>
                            
<!--<a   onclick="recordClick(<?php echo $facno; ?>);" target="_blank" ><?php echo $number." .". $row_s['fac_name']." ( ".$row_s['fac_desc']." )"; ?></a> --!>
<a  href="javascript:void(0);" onclick="window.open('post.php?view=Dept&facid=<?php echo $facno;?>','_self')"  ><?php echo $number.". ". $row_s['fac_name']." ( ".$row_s['fac_desc']." )"; ?></a>
                            </li>
                            <?php $number ++;}}else{ ?>
                             <li>
                                <a>  No Available Programme at this time Please Check back later!</a>
                            </li>
                          <?php } ?>  
                </ul>
            </div>
            
        </div>
        <!--
        <div class="row">
 <div class="col-xs-12">
                    <a name="step1"></a>
                    <h3>Find your desired institution</h3>
                    <p>You will need to find your desired institution of your choice before applying for admission. You can click on Participating Institutions to view the various institutions in Delta State before applying.</p>

                </div>
                <div class="col-xs-12">
                    <a name="step2"></a>
                    <h3>Click on Apply for Admission</h3>
                    <p>You will have to complete the first step of your application and then proceed to make payments for application fees (this depends on the institution you are applying to). Once you have made your application fees payment, you will be assigned a unique pin and application number with which you can finish up your application process.</p>

                </div>
                
                
                
        </div> --!>

 </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3 margin-lg-bottom sidebar-right">
            <!-- Sidebar space -->
         <!--   
    <div class="apply-box">
        <a class="btn btn-default expand padding-md" href="Our_institution.htm">APPLY NOW</a>
    </div> --!>

<?php include("sidenews.php"); ?>
            <!--    <div class="feature-card">
        <a href="https://applyalberta.ca/media/1086/applyalberta_intro.mp4" target="_blank">
                <img src="Application%20Process%20%20%20ApplyAlberta_files/apply-ab-thumb.png" alt="" class="img-responsive">
        </a>
        <h4>Application Process Video</h4>
            <p>What steps do you need to take to complete your application?</p>
            <a class="btn btn-primary expand" href="https://applyalberta.ca/media/1086/applyalberta_intro.mp4" target="_blank">Watch Video</a>
    </div> --!>

            
        </div>
    </div>
</div>
        </main>
    </section>
    