<div class="availability-box">
    <div class="availability-title">
        <h2>News Update/Events </h2>
    </div>
<!--Z6TN5CLV --!>
    <div class="availability-content" id="refresh1">
    <div  id="time">
    <?php //"SELECT t.* FROM (SELECT ROUND(RAND() * (SELECT MAX(news_id) FROM news)) num, @num:=@num+1 FROM (SELECT @num:=0) AS a, news LIMIT 1) AS b, myTable AS t WHERE b.num = t.id LIMIT $starts , 2 "
                    if(!isset($_GET['starts'])){$starts=0;}else{$starts=$_GET['starts'];}
			  $sql ="SELECT * FROM news where status ='TRUE' ORDER BY RAND() LIMIT $starts , 2";
			$qsql = mysqli_query($condb,$sql);
			$count = mysqli_num_rows($qsql);  if ($count < 1){
			//ORDER BY news_id DESC
			echo " <p align='justify'>No New Post Avaliable at this time.</p>";
			}else{
			while($rs = mysqli_fetch_array($qsql)){ $newstype = $rs['news_type']; //upevents.png
			if($newstype == "News"){ $newsicon = "<i class='fa fa-bullhorn'></i> "; $eventdop ="assets/media/blanknews.png";}else{$newsicon="<i class='fa fa-calendar'></i> ";$eventdop ="assets/media/upevents.png"; }
			?>
         <h3 ><a href='post.php?view=News&newsid=<?php echo $rs['news_id'];?>'><?php echo $newsicon; ?><?php echo " ".ucwords($rs['news_title']); ?></a></h3>
              <p><div class="container2"><?php if (strlen($rs['news_content']) > 100){ echo substr($rs['news_content'],0,100)."...";}else{ echo substr($rs['news_content'],0,100);} ?>
					<a href="javascript:{}" onclick="window.open('post.php?view=News&newsid=<?php echo $rs['news_id'];?>','_self')"> <div class="overlay30"><img src="<?php if ($rs['image']==NULL ){echo $eventdop;}else{echo "./admin/new_image/".$rs['image'];}?>" alt="<?php if (strlen($rs['news_content']) > 100){ echo substr($rs['news_content'],0,100)."...";}else{ echo substr($rs['news_content'],0,100);} ?>"  class="image" /></div> </a></div>
					 </p>     
		<?php	}
			?>
           
<?php }if ($count < 1){ echo "<p></p><br><br><br><br><br><br>";}else{ ?>
            <div class="view-all-maintenance">
                <p><a href="javascript:{}" onclick="window.open('post.php?view=nMore','_self')">View more details</a></p>
            </div> <?php } ?>
            </div>
</div>
</div>