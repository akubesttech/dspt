
<?php  include('header.php'); ?>
<?php include('session.php');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

 ?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php') ?>
  <?php $get_RegNo= $_GET['id']; ?>
  <?php $get_RegNo2= $_GET['userId']; ?>
  <?php 
 $sql2="SELECT * FROM b_pms where pmID='$_GET[delid]' ";
  $qsql2= mysqli_query($condb,$sql2);
$rs2 = mysqli_fetch_array($qsql2);
$tite = $rs2['news_type'];
if(isset($_GET['delid']))
{
	$sql="DELETE FROM b_pms WHERE pmID='$_GET[delid]'";
//http://localhost/Secondaryschoolportal/admin/photogallery/13504images1.jpg
	$qsql = mysqli_query($condb,$sql);	
	if(mysqli_affected_rows() == 1)
	{
		if($rs2['image']!=Null){
		unlink("new_image/$rs2[image]");
		}
		
		echo "<script>alert('Message was successfully Deleted..');</script>";
		echo "<script>window.location.assign('message_m.php');</script>";
		//redirect('Location: News_events.php');
		
	}
}

?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Message Management
</h3>
</div>
</div><div class="clearfix"></div>
          

                <div class="row">
              <div class="col-md-12">
              
                <div class="x_panel">
                  <div class="x_title">
                    <h2><a href="message_m.php">Message Inbox </a><big>(<?php
								$sql_countrow = mysqli_query($condb,"SELECT * FROM b_pms WHERE receiver='$session_id'");
							$result=mysqli_num_rows($sql_countrow);
							echo $result;
							$sql_countrowsend = mysqli_query($condb,"SELECT * FROM b_pms WHERE sender='$session_id'");
							$results=mysqli_num_rows($sql_countrowsend); 
								?>)</big></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-3 mail_list_column">
                      <a href="message_m.php?view=c_Msg" class="btn btn-sm btn-success btn-block" >COMPOSE</a>
                        <h4 style="color:green; text-shadow:0 2px 1px gray;">Sent Messages <span class="badge bg-green"><?php echo $results; ?></span><hr></h4>
                        <?php if($results > 0){
        $sql_countread = mysqli_query($condb,"SELECT *,UNIX_TIMESTAMP() - therealtime AS TimeSpent FROM b_pms WHERE sender='$session_id' order by therealtime DESC limit 0,4");
						while($row_read = mysqli_fetch_array($sql_countread)){ ?>
						<a href='message_m.php?view=sendM&ID=<?php echo $row_read['pmID']; ?>'>
                          <div class="mail_list">
                            <div class="left">
                              <i class="fa fa-envelope"></i>
                            </div>
                            <div class="right">
                              <h3><?php 
							  if($row_read['s_status']=='1'){
							echo ucfirst(getstudent2($row_read['receiver'])) ." (Student)";
							}elseif($row_read['s_status']=='2'){
						echo ucfirst(getstaff2($row_read['receiver']))  ." (Staff)";
						}else{ 
					echo ucfirst(getadmin2($row_read['receiver']))  ." (Admin)";
					}
							   ?></h3>
                               <h4 style="color:blue;"><?php echo ucfirst($row_read['subject']); ?></h4>
                              <p style="text-align:justify;"><?php echo ucfirst(substr($row_read['message'],0,40)); ?></p>
                              <h3><small><?php  $days = floor($row_read['TimeSpent'] / (60 * 60 * 24));
			$remainder = $row_read['TimeSpent'] % (60 * 60 * 24);
			$hours = floor($remainder / (60 * 60));
			$remainder = $remainder % (60 * 60);
			$minutes = floor($remainder / 60);
			$seconds = $remainder % 60;
	        if($days > 0)
			echo date('F d Y', $row_read['therealtime']);
			elseif($days == 0 && $hours == 0 && $minutes == 0)
			echo "few seconds ago";		
			elseif($days == 0 && $hours == 0)
			echo $minutes.' minutes ago';
			elseif($days == 0 )
			echo $hours.' hours ago';
			else
			echo date('F d Y', $row_read['therealtime']);
			?></small></h3>
                            </div>
                          </div>
                        </a>
                        <?php }}else{ ?>
                        <a href="#">
                          <div class="mail_list">
                           
                            <div class="right">
                              <p>You Have not Sent Any Messages</p><br>
                            </div>
                          </div>
                        </a>
                        <?php } ?>
                 
                        <a href="message_m.php?view=s_msg" class="btn btn-sm btn-success btn-block" >View More</a>
                      
                      </div>
                      <!-- /MAIL LIST -->

                      <!-- CONTENT MAIL -->
                      <div class="col-sm-9 mail_view">
                        
						<?php 
						$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'sendM' :
		            $content    = 'readsm.php';		
		            break;

	                case 'c_Msg' :
		            $content    = 'compose_m.php';		
		            break;
                   case 'r_msg' :
		            $content    = 'reply_m.php';		
		            break;
                    case 's_msg' :
		            $content    = 'Sent.php';		
		            break;
		            
	                default :
		            $content    = 'inbox.php';
				
                            }
                     require_once $content;
				?>

                      </div>
                      <!-- /CONTENT MAIL -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            </div>


          </div>
        </div>
        <!-- /page content -->
        <?php

  function statusUser()
{
	$userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
	
	$status = $nst == 'Show' ? 'TRUE' : 'FALSE';
	$sql   = "UPDATE news SET status = '$status' WHERE news_id = '$userId'";

	mysqli_query($condb,$sql);
//	header('Location:News_events.php');
		//echo "<script>window.location.assign('News_events.php');</script>";

}
        ?>
        <script>  
function changeUserStatus(userId, status)
{
	var st = status == 'FALSE' ? 'Show' : 'Hide'
	if (confirm('Your About to ' + st+' this Post Make Sure You really what to do so')) {
	window.location.href = 'News_events.php?userId=' + userId + '&nst=' + st;
	}
}</script>

         <?php include('footer.php'); ?>
         
         