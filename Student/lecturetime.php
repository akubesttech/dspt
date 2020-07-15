
   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php 
//$to_time = strtotime("2008-12-13 10:42:00");
//$from_time = strtotime("2008-12-13 11:21:00");
//echo round(abs( $from_time - $to_time) / 60,2). " minute";

$query= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row_C = mysqli_fetch_array($query);
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
                    	<?php include('modal_delete.php'); ?>
                    	 <span id="printout">
                    	 	<style type="text/css">	table.timetable {
		margin: auto;
		border-width: 0px;
		border-spacing: 0px;
		border-style: none;
		border-color: black;
		border-collapse: collapse;
		background-color: white;
	}
		table.timetable th {
		border-width: 1px;
		padding: 0px;
		border-style: none;
		border-color: black;
		background-color: white;
		-moz-border-radius: ;
		font-size: 12px;
		font-weight: bold;
		
	}
	table.timetable td {
		padding: 0px;
		border-width: 1px;
		border-style: solid;
		border-color: black;
		border-left:1px dotted rgb(0,0,0);		
		border-right:1px dotted rgb(0,0,0);		
		background-color: white;
		-moz-border-radius: ;
		height: 64px;
		font-size: 11px;
		line-height: 14px;		
		width: 14px;
	}
	table.timetable td.blank {
		background-color: rgb(224,224,224);
	}
	table.timetable td.day {
		border-left:2px solid rgb(0,0,0);
	}
	table.timetable td.block {
		border-left:1px solid rgb(0,0,0);
		border-right:1px solid rgb(0,0,0);
			
	}
	table.timetable td.hour {
		border-right:2px solid rgb(0,0,0);
		
	}
		span.hl_subject	{
		background-color: Wheat;
	}

	span.hl_group {
		background-color: Plum;
	}

	span.hl_facility {
		background-color: LightSkyBlue;
	}

	span.hl_trainer	{
		background-color: Yellow;
	}

	span.hl_class {
		background-color: LightGreen;
	}
		.title {
		float: left;
		font-size: 24px;
		font-weight: bold;
	}
	.logo {
		float: right;
	}
	.sub_title {
		clear: both;
		font-size: 16px;
		font-weight: bold;
	}
	.footer {
		font-size: 11px;
	}
	</style>
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
                                          <strong>Student Name:</strong> <?php echo $stud_row['FirstName']." ".$stud_row['SecondName']." ".$stud_row['Othername'];?>
                                          <br><b>Registration No:</b> <?php echo $stud_row['RegNo'];?>
                                          <br><b>Year of Study:</b> <?php echo $default_session;?>
                                          <br><b>Faculty:</b><?php echo getfacultyc($stud_row['Faculty']);?>
                                          <br><b>Department:</b> <?php echo getdeptc($stud_row['Department']);?>
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col" >
                         
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                         <address>
                          <div class="rounded" align="right">
   <img id="admin_avatar" class="img-rectangle" width="120px" height="100px" src="<?php 
  
				  
				  if ($stud_row['images']==NULL ){
	print "uploads/NO-IMAGE-AVAILABLE.jpg";
	}else{
	print $stud_row['images'];
	
}
				  
				  
				 // echo $row['adminthumbnails']; ?>">
  </div> </address>
                        </div>
                        <hr>
                        <!-- /.col -->
                      </div> </tr></table>
                      <!-- /.row -->
                    	 <div class="alert alert-info alert-dismissible fade in" role="alert">
                    
          <strong> <?php echo $_GET['semester'];?> Semester Lecture Time Table For <?php echo getlevel($_GET['level'],$student_prog);?> level Student of <?php echo getdeptc($stud_row['Department']);?> .</strong>
                  </div>
                    
                    <table  class="table table-striped jambo_table bulk_action" border="1">
                    	<a data-placement="top" title="Click to Delete Selected Courses"    data-toggle="modal" href="#delete_rcourse" id="delete"  class="btn btn-danger" name="delete_course" style="display:none;"><i class="fa fa-trash icon-large"> Delete Course</i></a>
                    
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
						
                      
                      

                 <?php
$depart = $_GET['dept1_find'];
$level=$_GET['level'];
$semester= $_GET['semester'];
//$master_field = $_GET['dept1_find'];
 $days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
//$mado = mysqli_query($condb,"SELECT * FROM details  INNER JOIN payment ON details.regno = payment.regno  and details.level  = payment.level where details.regno like '%$typein%'   AND payment.regno like '%$typein%'  ");

$viewutme_query = mysqli_query($condb,"select time_id  , day , time ,duration,venue,course from lecttime_tb where t_dept = '$student_dept' and session='$_GET[session]' and t_level='$_GET[level]' and semester ='$_GET[semester]'  order by session DESC ")or die(mysqli_error($condb)); ?>


	<?php	
	
	$num_row = mysqli_num_rows($viewutme_query);
	$rows_master = array();
	while ($row=mysqli_fetch_assoc($viewutme_query)){
		//$rows_master[$row[$master_field]] [$row['day']][$row['time_in']]=$row;
		
		$rows_master[$row[$depart]] [$row['day']][$row['time']]=$row;
	}	 		
if($num_row < 1){
echo "<td colspan='10' style='text-align:centre;'><strong>No Lecture Time Table Added for ".getdeptc($student_dept)." Department . </strong></td>";}
 ?>
 						


                   
					
												
										
                     
                      
              
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      <div class="btn-group" id="divButtons" name="divButtons">
                      <input type="button" value="Print" onclick="tablePrint();" class="btn btn-default">
                      	 </div>
                    </table>
                   <?php //print_r($rows_master);
				   foreach ($rows_master as $master_id=>$rows){ ?>
                    <table class="timetable" id="timetable"  border="1">
		<tr style="color:black;">
			<th width="16px">&nbsp; </th>
			<th width="16px">&nbsp;</th>
			<th colspan="4" style="color:black;">&nbsp;&nbsp;&nbsp;&nbsp;08:00 </th>
			<th colspan="4" style="color:black;">&nbsp;&nbsp;&nbsp;&nbsp;09:00</th>
			<th colspan="4" style="color:black;">&nbsp;&nbsp;&nbsp;&nbsp;10:00</th>
			<th colspan="4" style="color:black;">&nbsp;&nbsp;&nbsp;&nbsp;11:00</th>
			<th colspan="4" style="color:black;">&nbsp;&nbsp;&nbsp;&nbsp;12:00</th>
			<th colspan="4" style="color:black;">&nbsp;&nbsp;&nbsp;&nbsp;1:00</th>
			<th colspan="4" style="color:black;">&nbsp;&nbsp;&nbsp;&nbsp;2:00</th>
			<th colspan="4" style="color:black;">&nbsp;&nbsp;&nbsp;&nbsp;3:00</th>
			<th colspan="4" style="color:black;">&nbsp;&nbsp;&nbsp;&nbsp;4:00</th>
			<th colspan="4" style="color:black;">&nbsp;&nbsp;&nbsp;&nbsp;5:00</th>
			<th colspan="4" style="color:black;">&nbsp;&nbsp;&nbsp;&nbsp;6:00</th>
			<th colspan="4" style="color:black;">&nbsp;&nbsp;&nbsp;&nbsp;7:00</th>
			<th colspan="4" style="color:black;">&nbsp;&nbsp;&nbsp;&nbsp;8:00</th>
			<th width="16px">&nbsp;</th>
			<th width="16px">&nbsp;</th>
		</tr>
	
		<?php 	
			$iday=2;
		foreach ($days as $day){
	echo "
		<tr>
			<td class=\"day hour\" colspan=\"4\"><center>$day</center></td>";
				$icol=0;
		while ($icol<52){
		if (array_key_exists($iday,$rows) && array_key_exists($icol,$rows[$iday])){
		$colspan = $rows[$iday][$icol]['duration']; $start = $rows[$iday][$icol]['time'] ; $duration = $start + $rows[$iday][$icol]['duration'];
				if (($icol+$colspan)%4==0){$class="hour";} else {$class="";}
			$html = '<span class="hl_subject">'.setStime($start)." - " .setStime($duration).'</span><br>'
					   		.'<span class="hl_group1"><strong> <font color="green">'.$rows[$iday][$icol]['course'].'</font><strong></span><br>'
					   		.'<span class="hl_trainer">'.$trainer.'</span><br>'
					   	//	.'<span class="hl_class">'.$rows[$iday][$icol]['course2'].'</span><br>'
					   		.'<span class="hl_class">'.$rows[$iday][$icol]['cls_id_2'].'</span>';
					   		
			echo "<td class=\"block $class\" align=\"center\" colspan=\"$colspan\">$html</td>";
			} else {
				$colspan=1;
				if (($icol+$colspan)%4==0){$class="hour";} else {$class="";}
			  	echo "<td class=\"blank $class\">&nbsp;</td>";				
			}
			$icol+=$colspan;
			}
			echo "
		</tr>";
		$iday++;
		if ($iday==8) $iday=1;
		}
			?>
			
               </table>     
                    <?php } ?>
                  </div>
                </div>
              </div>
              
                 
  