   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2>News Update</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                  
                    </p>
                  <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
           Listed Below are Our News Update. 
                  </div>
                  
                    <form action="Reg_course.php" method="post">
                    
                    <table id="datatable" class="table table-striped table-bordered">
                    <!--	<a data-placement="top" title="Click to Register Selected Courses"   data-toggle="modal" href="#reg_course" id="delete"  class="btn btn-info" name=""  ><i class="fa fa-plus icon-large"> Register Courses</i></a> --!>
                    
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                        
                         <th>Title</th>
                          <th>Post Content</th>
                          
                        <th>Publication Date</th>
                        <th>Image</th>
                          <th>View Action</th>
                         
                        </tr>
                      </thead>
                      
                      
 <tbody  style="overflow: auto;">
                 <?php

$viewnews_query = mysqli_query($condb,"select * from news where news_type = 'News' order by news_id  DESC ")or die(mysqli_error($condb));
													
 ?>
 <tr>

	<?php		 		
											
							 if(mysqli_num_rows($viewnews_query)<1){
	  echo "<td colspan='12' style='text-align:centre;'><strong>Currently There is No News Update.</strong></td>";
 }?>
 						
</tr>

<?php 
while($row_news = mysqli_fetch_array($viewnews_query)){
													$id = $row_news['news_id'];

?>     
                        <tr><td width="30">
           	<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $row_news['news_id']; ?>">
													</td>
											
					 <td><?php echo $row_news['news_title']; ?></td>
                <td><?php echo ucfirst(substr($row_news['news_content'],0,60)); ?> .</td>
                          <td><?php  echo $row_news['publish_date'] ; ?></td> 
                        <td><div class="zoomin"><img src="<?php if ($row_news['image']==NULL ){echo "../assets/media/blanknews.png";}else{echo "../admin/new_image/".$row_news['image'];}?>" style="width:50px;height:30px;" /></div></td>
     
	                   
					<td> <?php if(strlen($row_news['news_content']) > 60){ ?>  <a rel="tooltip" href="?details&view=News&userId=<?php echo $id;?>"    id="addpay" class="btn btn-info" title="Click to Read More News" data-toggle="modal"><i class="fa fa-file"></i>&nbsp;Read More</a></td>			<?php	}else{ ?> --------------<?php } ?>
												
													
										
                        </tr>
                     
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form>
                    </table>
                  </div>
                </div>
              </div>
                     <?php 
if(isset($_GET['details'])){
//statusUser2();
?>

<script>
    $(document).ready(function(){
        $('#myModal002').fadeIn('fast');
    });
    
    $(document).ready(function(){
        $('#close').click(function(){
            $('#myModal002').fadeOut('fast');
            windows.location = "student_Private.php";
        })
    })

</script>

<?php }?>
      
   <div id="myModal002" class="modal dialog bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content" style="overflow: auto; width:600px;" >

                        <div class="modal-header">
                        <a href="student_Private.php?view=News" class="close"><span aria-hidden="true"></i>x</span> </a>
                         
                          <h4 class="modal-title" id="myModalLabel2">-- News --</h4>
                        </div>
                        <div class="modal-body" style="overflow: auto; width:580px; height:400px;" >
                        <?php
$find_choicead = mysqli_fetch_array(mysqli_query($condb," SELECT * FROM news where news_type = 'News' and news_id='$_GET[userId]'"));
$num_fchoice =$find_choicead['course_choice'] ;
?>
<div class="alert alert-info alert-dismissible fade in" role="alert" style="text-shadow:-1px 1px 1px #000;" ><?php echo ucfirst($find_choicead['news_title']); ?></div>
<form method="post"  action="" enctype="multipart/form-data">							  
							 <table  id="datatable" class="table table-striped table-bordered" >
				<tr><td><div class="zoomin">
<img src="<?php if ($find_choicead['image']==NULL ){echo "../assets/media/blanknews.png";}else{echo "../admin/new_image/".$find_choicead['image'];}?>" alt="post image" align='left' style="border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; float:left;margin:0 10px 10px 0;" > </div><p style="text-align:justify;text-indent:1em;">
<?php echo $find_choicead['news_content']; ?></p></td></tr>
				<tr><td><strong>Date Published :</strong><?php echo $find_choicead['publish_date']; ?> </td></tr>
				</table>
				 </div><div class="modal-footer">
				 <a href="student_Private.php?view=News" class="btn btn-info" ><i class="fa fa-remove"></i>&nbsp;Close</a>
                        </div></form>
                      </div>
                    </div>
                  </div>
                  <!-- /modals -->