    <section id="content" role="document">
        <main style="min-height: 168px;">
                    <div class="container">
                        

<div class="row">
    <div class="col-xs-12">
        <div id="breadcrumbs-share">
            <section id="breadcrumbs">
                <ul class="breadcrumb">
                                <li><a href=".<?php host(); ?>">Home</a> </li>
       <li><a href="javascript:{}" onclick="window.open('post.php','_self')">Go Back</a> </li>
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
                <h2 id="pageTitleStub">News Update and Events</h2>
                
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9 margin-lg-bottom link-icons">
            <div class="row">
                <div class="col-xs-12 primary-content link-icons">
                
        <div class="row">


                <div class="col-xs-12">
                    <a name="step1"></a>
                    <?php
			$qsql =mysqli_query($condb,"SELECT * FROM news WHERE news_id='".safee($condb,$_GET['newsid'])."' AND status ='TRUE'");
			$dform_checkexist2 = mysqli_num_rows($qsql);
if($dform_checkexist2 < 1){ message("The page you are trying to access is not Available.", "error");
redirect('post.php'); }
			while($rs = mysqli_fetch_array($qsql))
			{ $newstype = $rs['news_type']; $npostdate	= $rs['publish_date'];
			$eventd = $rs['event_date'];
    $timestamp = strtotime($eventd); $datetime	= date('F', $timestamp);  $datetime2	= date('jS', $timestamp);
			if($newstype == "News"){ $newsicon = "<i class='fa fa-bullhorn'></i> ";}else{$newsicon="<i class='fa fa-calendar'></i> "; }?>
                    <h3><?php echo $newsicon; ?><?php echo " ".ucwords($rs['news_title']); ?></h3>
                     <p align="justify" class="zoomin">
					   <?php if($newstype == "News"){?>
					    <img src="<?php if ($rs['image']==NULL ){echo "assets/media/blanknews.png";}else{echo "./admin/new_image/".$rs['image'];}?>" style="float:left;margin: 5px;" >
       
		<?php }else{ ?><div class="square"><strong><font color="white" size="4"></a><?php echo substr($datetime,0,3); ?></font></strong><br><h2><span class="count"><?php echo $datetime2; ?></span></h2></div> <?php } ?>
					<?php echo $rs['news_content']; ?></p><br><strong>Date Posted:</strong><?php echo $npostdate; ?>

                </div>
               <?php } ?> 
                
        </div><hr>

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
    