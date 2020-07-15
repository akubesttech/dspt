<?php

include('./admin/lib/dbcon.php'); 
dbcon();  //Include the database connection file

//Check for all tutorials in the database
$check_tutorials = mysql_query("select * from news order by news_id desc");
if(mysql_num_rows($check_tutorials) < 1) 
{
	echo '<div class="info">No News Avaliable at This Time check back later.</div>';
	
}
else 
{
	?>
    <div id="vpb_news_scroller_wrapper">
    
    <div class="vpb_news_scroller">
    <ul>
    <?php
	while($get_tutorials = mysql_fetch_array($check_tutorials)) 
	{
		?>
		 <li>
		 <a href="http://www.vasplus.info/tutorial.php?id=<?php echo strip_tags($get_tutorials["news_id"]); ?>&topic=<?php echo strip_tags($get_tutorials["news_title"]); ?>" target="_blank">
		 <?php echo strip_tags($get_tutorials["news_title"]); ?>
		 </a>
		 </li> 
		<?php
	}
	?>
    </ul>
    </div>
    </div>
    <?php
}
?>
<script type="text/javascript" src="js/vpb_news_scroller.js"></script>