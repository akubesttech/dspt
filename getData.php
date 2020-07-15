<div class="row">
                <div class="col-xs-12 primary-content link-icons">
<?php
if(isset($_POST['page'])){
    //Include pagination class file
   include('./admin/pagination.php');
    
    //Include database configuration file
include('./admin/lib/dbcon.php'); 
dbcon();
    
    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = 10;
    
    //set conditions for search
    $whereSQL = $orderSQL = '';
    $keywords = $_GET['search'];
    $sortBy = $_POST['sortBy'];
    if(!empty($keywords)){
          $whereSQL = "WHERE news_title LIKE '%".$keywords."%' OR  news_content LIKE '%".$keywords."%' AND status ='TRUE' ORDER BY news_id DESC ";
    }
   
    if(!empty($sortBy)){
        $orderSQL = " ORDER BY publish_date ".$sortBy;
    }else{
        $orderSQL = " ORDER BY news_id DESC ";
    } 

    //get number of rows
    ///$queryNum = mysqli_query($condb,"SELECT COUNT(*) as postNum FROM class_tb ".$whereSQL.$orderSQL);
    $queryNum = mysqli_query($condb,"SELECT COUNT(*) as postNum FROM news ".$whereSQL );
 
     //$queryNum = mysqli_query($condb,"SELECT COUNT(*) as postNum FROM news where  status ='TRUE'");
    $resultNum = mysqli_fetch_assoc($queryNum);
    $rowCount = $resultNum['postNum'];

    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);
    
    //get rows
    $query = mysqli_query($condb,"SELECT * FROM news where  status ='TRUE' LIMIT $start,$limit");
   $count = mysqli_num_rows($query);
			if ($count < 1){
			echo " <p align='justify'>No New Post Avaliable at this time.</p>";
			}else{?>
        
        
        <?php
        	while($rs = mysqli_fetch_array($query)){ 
                //$postID = $rec['id'];
                $newstype = $rs['news_type']; $npostdate	= $rs['publish_date'];
			if($newstype == "News"){ $newsicon = "<i class='fa fa-bullhorn'></i> ";}else{$newsicon="<i class='fa fa-calendar'></i> "; }
        ?>
        
            
			  <div class="row">


                <div class="col-xs-12">
                    <a name="step1"></a>
          
                    <h3><?php echo $newsicon; ?><?php echo " ".ucwords($rs['news_title']); ?></h3>
                    
  <p align='justify'><img src="./admin/new_image/<?php echo $rs['image']; ?>" style="float:left;width:120px;height:120px;margin: 5px;" ><?php echo $rs['news_content']; ?></p><br><strong>Date Posted:</strong><?php echo $npostdate; ?>
                </div>
            
        </div><hr>
        
		
        <?php }} ?>
       </div>
            </div>
             <div class="info first-paragraph"><?php echo $pagination->createLinks(); ?> </div>
             <?php } ?>