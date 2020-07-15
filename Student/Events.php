   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2>Upcoming Events </h2>
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
           Listed Below are Our Upcoming Events. 
                  </div>
                  
                    <form action="Reg_course.php" method="post">
                       <table id="datatable-buttons" class="table table-striped table-bordered">
                    <!-- <table id="datatable" class="table table-striped table-bordered">
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
                          <th>Description</th>
                          <th>Event Date</th>
                        <th>Publication Date</th>
                          <th>View Action</th>
                         
                        </tr>
                      </thead>
                      
                      
 <tbody style="overflow: auto;" >

                 <?php

$viewnews_query = mysqli_query($condb,"select * from news where news_type = 'Events' order by news_id  DESC ")or die(mysqli_error($condb));

	//$eventmonth   =	substr($viewnews_query['event_date'],5,10);												
 ?>
 <tr>

	<?php		 		
											
							 if(mysqli_num_rows($viewnews_query)<1){
	  echo "<td colspan='12' style='text-align:centre;'><strong>Currently There is No Event .</strong></td>";
 }?>
 						
</tr>

<?php 
while($row_news = mysqli_fetch_array($viewnews_query)){
	$eventday   =	substr($row_news['event_date'],1,3);
													$id = $row_news['news_id'];
	//$eventday   =	substr($row_news['event_date'],4,6);
	//$eventmonth   =	substr($row_news['event_date'],0,3);
	//$npostdate	= $rs['publish_date'];
			$eventd = $row_news['event_date'];
    $timestamp = strtotime($eventd); $datetime	= date('F', $timestamp);  $datetime2	= date('jS', $timestamp);
?>     
                        <tr><td width="30">
           	<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $row_news['news_id']; ?>">
													</td>
											
					 <td><?php echo $row_news['news_title']; ?></td>
                <td><?php echo ucfirst(substr($row_news['news_content'],0,60)); ?> .</td>
                           <td><article class="media event"><a class="pull-left date">
                          
                        <p class="month"><strong><?php  echo substr($datetime,0,3); ?></strong></p>
                        <p class="day" style="font-size:12px;"><?php  echo $datetime2; ?></p>
                      </a></article></td>
                      <td><?php  echo $row_news['publish_date'] ; ?></td>
                        
					<td> <?php if(strlen($row_news['news_content']) > 60){ ?>  <a rel="tooltip" href="?det&view=Evt&userId=<?php echo $id;?>"    id="addpay" class="btn btn-info" title="Click to View The Details of the Event" data-toggle="modal"><i class="fa fa-file"></i>&nbsp;Read More</a></td>			<?php	}else{ ?> --------------<?php } ?>
												
													
										
                        </tr>
                     
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form>
                    </table>
                  </div>
                </div>
              </div>
                     <?php 
if(isset($_GET['det'])){
//statusUser2();
?>

<script>
    $(document).ready(function(){
        $('#myModal003').fadeIn('fast');
    });
    
    $(document).ready(function(){
        $('#close').click(function(){
            $('#myModal003').fadeOut('fast');
            windows.location = "student_Private.php";
        })
    })

</script>

<?php }?>
      
   <div id="myModal003" class="modal dialog bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content" style="overflow: auto; width:600px;" >

                        <div class="modal-header">
                        <a href="student_Private.php?view=Evt" class="close"><span aria-hidden="true"></i>x</span> </a>
                         
                          <h4 class="modal-title" id="myModalLabel2">-- Events --</h4>
                        </div>
                        <div class="modal-body" style="overflow: auto; width:580px; height:200px;" >
                        <?php
$find_choicead = mysqli_fetch_array(mysqli_query($condb," SELECT * FROM news where news_type = 'Events' and news_id='".safee($condb,$_GET['userId'])."'"));
$eventd2 = $find_choicead['event_date'];
 $timestamp2 = strtotime($eventd2); $datetime2	= date('F', $timestamp2);  $datetime3	= date('jS', $timestamp2);
?>
<div class="alert alert-info alert-dismissible fade in" role="alert" style="text-shadow:-1px 1px 1px #000;" ><?php echo ucfirst($find_choicead['news_title']); ?></div>
<form method="post"  action="" enctype="multipart/form-data">							  
							 <table  id="datatable" class="table table-striped table-bordered" >
				<tr><td><div class="zoomin" align='left' style="float:left;margin:0 10px 10px 0;">
				
				<article class="media event" ><a class="pull-left date">
                          
                        <p class="month"><strong><?php  echo substr($datetime2,0,3); ?></strong></p>
                        <p class="day" style="font-size:12px;"><?php  echo $datetime3; ?></p>
                      </a></article>
 </div><p style="text-align:justify;">
<?php echo $find_choicead['news_content']; ?></p></td></tr>
				<tr><td><strong>Date Published :</strong><?php echo $find_choicead['publish_date']; ?> </td></tr>
				</table>
				 </div><div class="modal-footer">
				 <a href="student_Private.php?view=Evt" class="btn btn-info" ><i class="fa fa-remove"></i>&nbsp;Close</a>
                        </div></form>
                      </div>
                    </div>
                  </div>
                  <!-- /modals -->