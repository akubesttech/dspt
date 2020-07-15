    <section id="content" role="document">
        <main style="min-height: 168px;">
                    <div class="container">
                        

<div class="row">
    <div class="col-xs-12">
        <div id="breadcrumbs-share">
            <section id="breadcrumbs">
                <ul class="breadcrumb">
                                <li><a href=".<?php host(); ?>">Home</a> </li>
                                <li><a href="javascript:void(0);" onclick="window.open('post.php','_self')">Go Back</a> </li>

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
     
        <div id="posts_content" class="col-xs-12 col-md-9 margin-lg-bottom link-icons">
        
            <div class="row">
                <div class="col-xs-12 primary-content link-icons">
                          <?php
                          //get number of rows
                          $limit = 10;
                          $keywords = $_GET['search'];
                           if(!empty($keywords)){
        $whereSQL = "WHERE news_title LIKE '%".$keywords."%' OR  news_content LIKE '%".$keywords."%' AND status ='TRUE' ORDER BY news_id DESC";
    }
  
   
    $queryNum = mysqli_query($condb,"SELECT COUNT(*) as postNum FROM news ".$whereSQL);
    $resultNum = mysqli_fetch_assoc($queryNum);
    $rowCount = $resultNum['postNum'];
    
    //initialize pagination class
    $pagConfig = array(
        'totalRows' => $rowCount,
        'perPage' => $limit,
       // 'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);
                   
			$sql ="SELECT * FROM news  ";
			if(isset($_GET['search']))
			{
				$sql = $sql . " where (news_title LIKE '%$_GET[search]%' OR  news_content LIKE '%$_GET[search]%' ) AND status ='TRUE' ";
			}else{
		$sql = $sql . " where  status ='TRUE'";
		}
			
			$sql = $sql . " ORDER BY news_id desc LIMIT $limit";
			$qsql = mysqli_query($condb,$sql); 
			$count = mysqli_num_rows($qsql);
			if(empty($_GET['search'])){	redirect('post.php?view=q');}
			
			elseif ($count < 1){ ?>
			<div id="posts_content" class="col-xs-12 col-md-9 margin-lg-bottom link-icons">
        
              <h1 role="banner">Search Results</h1>
            <div class="row">
                <div class="col-xs-12">
                    <div id="searchResults">
                        <div class="margin-md-bottom">
							<a class="search-submit" onclick="document.getElementById('top_search').submit();"></a>
							<form method="get" action="post.php?view=nMore" id="top_search">
								<label for="q2" class="sr-only">Search</label>
								<input class="search-page-control form-control" id="q2" name="search" autocomplete="on" placeholder="Enter search terms" type="text"> <p align='justify'><h4 id="pageTitleStub"><font color="red">Sorry, no results were found.</font></h4></p>
							</form>
						</div>
                    </div>
                   
                </div>
                
            </div>
            
             
        </div>
		<?php	//echo " <p align='justify'>Sorry, no results were found.</p>";
		
			}else{
				while($rs = mysqli_fetch_array($qsql))
			{$newstype = $rs['news_type'];  $eventd = $rs['event_date'];
    $timestamp = strtotime($eventd); $datetime	= date('F', $timestamp);  $datetime2	= date('jS', $timestamp);
 // $datetime	= date('l, jS F Y', $timestamp);
$npostdate	= $rs['publish_date'];
			if($newstype == "News"){ $newsicon = "<i class='fa fa-bullhorn'></i> ";}else{$newsicon="<i class='fa fa-calendar'></i> "; }
		?>
        <div class="row">


                <div class="col-xs-12">
                    
          
                    <h3><?php echo $newsicon; ?><?php echo " ".ucwords($rs['news_title']); ?></h3>
                    <p align='justify'>
                    <?php if($newstype == "News"){?>
<img src="<?php if ($rs['image']==NULL ){echo "assets/media/blanknews.png";}else{echo "./admin/new_image/".$rs['image'];}?>" style="float:left;width:120px;height:120px;margin: 5px;" >
		<?php }else{ ?><div class="square"><strong><font color="white" size="4"></a><?php echo substr($datetime,0,3); ?></font></strong><br><h2><span class="count"><?php echo $datetime2; ?></span></h2></div> <?php } ?>
		<?php if (strlen($rs['news_content']) > 495){ echo substr($rs['news_content'],0,495); ?> 
					<div style="float:right;">
               <button type="button" onclick="window.open('post.php?view=News&newsid=<?php echo $rs['news_id'];?>','_self')" class="btn btn-primary">Read More</button>
            </div>
					 <?php }else{ echo substr($rs['news_content'],0,100);} ?></p><strong>Date Posted:</strong><?php echo $npostdate; ?>

                </div>
            
        </div><hr>
 <?php }} ?> 
 </div>
            </div>
             <div class="info first-paragraph"><?php echo $pagination->createLinks(); ?> </div>
             
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
    