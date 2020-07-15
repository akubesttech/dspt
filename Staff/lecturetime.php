   
   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php 

$query= mysql_query("select * from schoolsetuptd ")or die(mysql_error());
							  $row_C = mysql_fetch_array($query);
							  $s_utme = $row_C['p_utme'];
						?>
                    <h2>Lecture Time Table:</h2>
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
                 
                  
                    <form action="Delete_regcourse.php" method="post">
                    	<?php //include('modal_delete.php'); ?>
                    	 <span id="printout">
                    	  <table ><tr >
                    	 <div   id="divTitle" name="divTitle">
                        <div class="col-xs-12 invoice-header" >
                          <h1 >
                            <i class="fa fa-graduation-cap" ></i><FONT COLOR = "BLUE" style="text-shadow:-1px 1px 1px gray;" ><?php echo $row_C['SchoolName'];  ?>    </FONT><br>
                                          <small class="pull-right">LECTURE TIME TABLE</small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                    	 <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col" >
                         
                          <address>
                                          <strong> Name In Full:</strong> <?php echo $user_row['sname']." ".$user_row['mname']." ".$user_row['oname'];?>
                                        
                                          <br><b>Academic Session:</b> <?php echo $default_session;?>
                                          <br><b>Faculty:</b><?php echo getfaculty2($user_row['s_fac']);?>
                                          <br><b>Department:</b> <?php echo $user_row['s_dept'];?>
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col" >
                         
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                         <address>
                          <div class="rounded" align="right">
   <img id="admin_avatar" class="img-rectangle" width="120px" height="100px" src="../admin/<?php 
  
				  
				  if ($user_row['image']==NULL ){
	print "uploads/NO-IMAGE-AVAILABLE.jpg";
	}else{
	print $user_row['image'];
	
}
				  
				  
				 // echo $row['adminthumbnails']; ?>">
  </div> </address>
                        </div>
                        <hr>
                        <!-- /.col -->
                      </div> </tr></table>
                      <!-- /.row -->
                    	 <div class="alert alert-info alert-dismissible fade in" role="alert">
                    
          <strong> <?php echo $_GET['semester'];?> Semester Lecture Time Table For <?php echo $_GET['level'];?> level Student of <?php echo $_GET['depart'];?> .</strong>
                  </div>
                    
                    <table  class="table table-striped jambo_table bulk_action" border="1">
                    	<a data-placement="top" title="Click to Delete Selected Courses"    data-toggle="modal" href="#delete_rcourse" id="delete"  class="btn btn-danger" name="delete_course" style="display:none;"><i class="fa fa-trash icon-large"> Delete Course</i></a>
                    
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
									
                      <thead>
                         <tr>
    <th scope="col">Day / Time&nbsp;</th>
    <th scope="col">&nbsp;8.00 AM - 9.00 AM</th>
    <th scope="col">&nbsp;9.00 AM - 10.00 AM</th>
    <th scope="col">&nbsp;10.05 AM - 11.00 AM</th>
    <th scope="col">11.05 AM - 12.00 PM</th>
    <th scope="col">12.05 PM - 01.00 PM</th>
    <th rowspan="7" scope="col">&nbsp;</th>
    <th scope="col">02.00 PM - 3.00 PM</th>
    <th scope="col">03.05 PM - 04.00 PM</th>
    <th scope="col">04.05 PM - 05.00 PM</th>
  </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php
$depart = $_GET['dept1_find'];
$level=$_GET['level'];
$semester= $_GET['semester'];

function getcourse($get_RegNo)
{
$query2_fac = @mysql_query("select C_title from courses where C_code = '$get_RegNo' ")or die(mysql_error());
$count_fac = mysql_fetch_array($query2_fac);
 $nameclass2=$count_fac['C_title'];
return $nameclass2;
}
//$mado = mysql_query("SELECT * FROM details  INNER JOIN payment ON details.regno = payment.regno  and details.level  = payment.level where details.regno like '%$typein%'   AND payment.regno like '%$typein%'  ");

$viewutme_query = mysql_query("select * from lecttime_tb where t_dept = '$_GET[depart]' and session='$_GET[session]' and t_level='$_GET[level]' and semester ='$_GET[semester]'  order by session DESC ")or die(mysql_error()); ?>
 <tr>

	<?php		 		
											
							if(mysql_num_rows($viewutme_query)<1){
	  echo "<td colspan='9' style='text-align:centre;'><strong>No Lecture Time Table Added for $_GET[depart] Department . </strong></td>";
 }else{?>
 						
</tr>
<?php
$serial=1;?>

                         <tr>
    <th scope="row">Mon <?php $day ="Monday"; ?></th>
    <td>&nbsp;<?php
	$time="8.00 AM - 9.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="9.00 AM - 10.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="10.05 AM - 11.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="11.05 AM - 12.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="12.05 PM - 01.00 PM";
	include("includetimetable.php");
	?></td>
	<td>&nbsp;</td>
    <td>&nbsp;<?php
	$time="02.05 PM - 03.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="03.05 PM - 04.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="04.05 PM - 05.00 PM";
	include("includetimetable.php");
	?></td>
  </tr>
  <tr>
    <th scope="row">Tue <?php $day ="Tuesday"; ?></th>
     <td>&nbsp;<?php
	$time="8.00 AM - 9.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="9.00 AM - 10.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="10.05 AM - 11.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="11.05 AM - 12.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="12.05 PM - 01.00 PM";
	include("includetimetable.php");
	?></td><td>&nbsp;</td>
    <td>&nbsp;<?php
	$time="02.05 PM - 03.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="03.05 PM - 04.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="04.05 PM - 05.00 PM";
	include("includetimetable.php");
	?></td>
  </tr>
  <tr>
    <th scope="row">Wed <?php $day ="Wednesday"; ?></th>
     <td>&nbsp;<?php
	$time="8.00 AM - 9.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="9.00 AM - 10.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="10.05 AM - 11.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="11.05 AM - 12.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="12.05 PM - 01.00 PM";
	include("includetimetable.php");
	?></td><td>&nbsp;</td>
    <td>&nbsp;<?php
	$time="02.05 PM - 03.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="03.05 PM - 04.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="04.05 PM - 05.00 PM";
	include("includetimetable.php");
	?></td>
  </tr>
  <tr>
    <th scope="row">Thu <?php $day ="Thursday"; ?></th>
     <td>&nbsp;<?php
	$time="8.00 AM - 9.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="9.00 AM - 10.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="10.05 AM - 11.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="11.05 AM - 12.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="12.05 PM - 01.00 PM";
	include("includetimetable.php");
	?></td><td>&nbsp;</td>
    <td>&nbsp;<?php
	$time="02.05 PM - 03.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="03.05 PM - 04.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="04.05 PM - 05.00 PM";
	include("includetimetable.php");
	?></td>
  </tr>
  <tr>
    <th scope="row">Fri <?php $day ="Friday"; ?></th>
     <td>&nbsp;<?php
	$time="8.00 AM - 9.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="9.00 AM - 10.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="10.05 AM - 11.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="11.05 AM - 12.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="12.05 PM - 01.00 PM";
	include("includetimetable.php");
	?></td><td>&nbsp;</td>
    <td>&nbsp;<?php
	$time="02.05 PM - 03.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="03.05 PM - 04.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="04.05 PM - 05.00 PM";
	include("includetimetable.php");
	?></td>
  </tr>
  <tr>
    <th height="26" scope="row">Sat <?php $day ="Saturday"; ?></th>
     <td>&nbsp;<?php
	$time="8.00 AM - 9.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="9.00 AM - 10.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="10.05 AM - 11.00 AM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="11.05 AM - 12.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="12.05 PM - 01.00 PM";
	include("includetimetable.php");
	?></td><td>&nbsp;</td>
    <td>&nbsp;<?php
	$time="02.05 PM - 03.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="03.05 PM - 04.00 PM";
	include("includetimetable.php");
	?></td>
    <td>&nbsp;<?php
	$time="04.05 PM - 05.00 PM";
	include("includetimetable.php");
	?></td>
  </tr>
                    <?php } ?>
                   
					
												
										
                     
                      </tbody>
                      
                      
                      <div class="btn-group" id="divButtons" name="divButtons">
                      <input type="button" value="Print" onclick="tablePrint();" class="btn btn-default">
                      	 </div>
                    </table>
                    
                    
                    
                    
                  </div>
                </div>
              </div>
              
                 
  