
<?php  include('header.php'); ?>
<?php include('session.php'); 
$status = FALSE;
if ( authorize($_SESSION["access3"]["nOt"]["ane"]["create"]) || 
authorize($_SESSION["access3"]["nOt"]["ane"]["edit"]) || 
authorize($_SESSION["access3"]["nOt"]["ane"]["view"]) || 
authorize($_SESSION["access3"]["nOt"]["ane"]["delete"]) ) {
 $status = TRUE;
}

?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');
	  if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} ?>
  <?php $get_RegNo= $_GET['id']; ?>
  <?php $get_RegNo2= $_GET['userId']; ?>
  <?php 
 $sql2="SELECT * FROM news where news_id='$_GET[delid]' ";
  $qsql2= mysqli_query($condb,$sql2);
$rs2 = mysqli_fetch_array($qsql2);
$tite = $rs2['news_type'];
if(isset($_GET['delid']))
{
	$sql="DELETE FROM news WHERE news_id='$_GET[delid]'";
//http://localhost/Secondaryschoolportal/admin/photogallery/13504images1.jpg
	$qsql = mysqli_query($condb,$sql);	
	if(mysqli_affected_rows($condb) == 1)
	{
		if($rs2['image']!=Null){
		unlink("new_image/$rs2[image]");
		}
		 message("Posted Record  was successfully Deleted", "success");
 redirect('News_events.php');
		//echo "<script>alert('$tite  was successfully Deleted..');</script>";
		//echo "<script>window.location.assign('News_events.php');</script>";
		//redirect('Location: News_events.php');
		
	}
}

?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>News and Events Panel
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
					$num=$get_RegNo;
				if ($num!==null){
		//	include('editProgram.php');
			}else{
			
				include('addNews.php');
				//statusUser20(); 
				//echo "<script>window.location.assign('News_events.php');</script>";
				}?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2> List Of New and Events</h2>
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
                    <form action="Delete_pro.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                    	
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show');
									 $('#delete').tooltip('hide');$('#delete1').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                          <th>Post Title</th>
                          <th>Post Type</th>
                         <th>Post Content</th>
                          <th>Event Date</th>
                        <th>Publication Date</th>
                        <th>Image</th>
                          <th>Action</th>
                           <th>display</th>
                        </tr>
                      </thead>


                      <tbody>
                       <?php
													$user_query = mysqli_query($condb,"select * from news ")or die(mysqli_error($condb));
													while($row_f = mysqli_fetch_array($user_query)){
													$id = $row_f['news_id']; $is_active = $row_f['status']; 
													$existsa = imgExists("new_image/".$row_f['image']);
													?>
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
											
                          <td><?php echo $row_f['news_title']; ?></td>
                          <td><?php echo $row_f['news_type']; ?></td>
                          <td><?php echo ucfirst(substr($row_f['news_content'],0,60)); ?></td>
                          <td><?php echo $row_f['event_date']; ?></td>
                          <td><?php echo $row_f['publish_date']; ?></td>
                          <td><img src="<?php if ($existsa > 0 ){print "new_image/".$row_f['image'];}else{ echo "uploads/NO-IMAGE-AVAILABLE.jpg";} ?>" style="width:50px;height:30px;" /></td>
                  
                          	<td width="120">
							<?php   if (authorize($_SESSION["access3"]["nOt"]["ane"]["delete"])){ ?>				
					<a rel="tooltip"  title="Click to Delete Post" id="delete" href="News_events.php?delid=<?php echo $row_f['news_id']; ?> "  data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash icon-large"> Delete</i></a><?php } ?>
												</td>
												<td width="120">
												<?php   if (authorize($_SESSION["access3"]["nOt"]["ane"]["view"])){ ?>
	<a rel="tooltip"  title="Click to Show/Hide Post" id="delete1" href="javascript:changeUserStatus3(<?php echo $id; ?>, '<?php echo $is_active; ?>');"  data-toggle="modal" class="btn btn-success"><i class="fa fa-eye icon-large">&nbsp;<?php echo $is_active == 'FALSE'? 'Show' : 'Hide'; ?></i></a>
	<?php } ?>
												</td>
                        </tr>
                     
            
                        <?php } ?>
                      </tbody>
                      	</form>
                    </table>
                  </div>
                </div>
              </div>



            
            
          </div>
        </div>
        <!-- /page content -->
        <?php

        ?>
        <script>  
</script>

         <?php include('footer.php'); ?>