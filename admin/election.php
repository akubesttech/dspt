
<?php  include('header.php'); ?>
<?php include('session.php');
	$status = FALSE;
if ( authorize($_SESSION["access3"]["emanag"]["velect"]["create"]) || 
authorize($_SESSION["access3"]["emanag"]["velect"]["edit"]) || 
authorize($_SESSION["access3"]["emanag"]["velect"]["view"]) || 
authorize($_SESSION["access3"]["emanag"]["velect"]["delete"]) ) {
 $status = TRUE;
}
 ?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');
	if ($status === FALSE) {message("You don't have the permission to access this page", "error");
		        redirect('./'); } ?>
  <?php $get_RegNo= $_GET['id']; 
  $get_staff= $_GET['allot_id'];
  	
  ?>
  
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Election Management
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
				/*	$num=$get_RegNo;
				if ($num!==null){
			include('editUser.php');
			}else{
			
				include('addlecturetime.php'); } */
				?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2><!-- List Of Lecture Time Set --!>
                  <?php  if($_GET['view'] == "viewpost"){ echo "List of Positions" ;}if($_GET['view'] == "add_post"){
echo "Add New Position";
}if($_GET['view'] == "edit_posit"){echo "Edit New Position";}if($_GET['view'] == "candidates"){
echo "Candidates List";}if($_GET['view'] == "velection"){echo "Election List";
} if($_GET['view'] == "addelect"){echo "Add New Election";} if($_GET['view'] == "editelect"){echo "Edit Election";}if($_GET['view'] == "add_cand"){echo "Add Candidate";}if($_GET['view'] == "editcand"){echo "Edit Candidate";} if($_GET['view'] == "selection"){echo "Select Election";}if($_GET['view'] == "eresult"){ ?> <a href='#' class='btn btn-info' onclick="window.open('election.php?view=selection','_self')"><i class='fa fa-check-circle-o'></i> Select Election </a> | <?php echo "Election Result";} ?>
			<strong></strong>
					</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  
                  <?php 
						$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'add_post' :
		            $content    = 'addposition.php';
					break;
					case 'edit_posit' :
		            $content    = 'editposit.php';
					break;
		            case 'viewpost' :
		            $content    = 'viewposition.php';		
		            break;
                    case 'add_cand' :
		            $content    = 'addcandidate.php';		
		            break;
	                case 'candidates' :
		            $content    = 'vcandidate.php';		
		            break;
		            case 'editcand' :
		            $content    = 'editcandidate.php';		
		            break;
		            case 'velection' :
		            $content    = 'velect.php';		
		            break;
                    
                    case 'addelect' :
		            $content    = 'addelection.php';		
		            break;
		            case 'editelect' :
		            $content    = 'editelection.php';		
		            break;
		            case 'selection' :
		            $content    = 'Select_elect.php';		
		            break;
		            case 'eresult' :
		            $content    = 'elect_result.php';		
		            break;
	                default :
		            //$content    = 'searchStud.php';
					$content    = 'Select_elect.php';
                            }
                     require_once $content;
					?>

                    
                    
                  </div>
                </div>
              </div>



            
            
          </div>
        </div>
        <!-- /page content -->
        <?php 


        ?>
  <!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Position</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="positions_add.php">
                <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="description" name="description" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="max_vote" class="col-sm-3 control-label">Maximum Vote</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="max_vote" name="max_vote" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>


         <?php include('footer.php'); ?>
         <?php
  $sql = "SELECT * FROM post_tb WHERE ecate1 = '".safee($condb,$ecat)."' ORDER BY position ASC";
  $query = mysqli_query($condb,$sql);
    while($row = mysqli_fetch_assoc($query)){
    if($ecat == "2"){
$sql = "SELECT * FROM candidate_tb WHERE post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID2)."' and approve ='1' and fac = '".safee($condb,$elefacu)."' ";}elseif($ecat == "1"){
			$sql = "SELECT * FROM candidate_tb WHERE post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID2)."' and fac = '".safee($condb,$elefacu)."' and dept = '".safee($condb,$eleDept)."' and approve ='1' ";}else{
$sql = "SELECT * FROM candidate_tb WHERE post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID2)."' and approve = '1' ";}
									 //$sql = "SELECT * FROM candidate_tb WHERE post = '".$row['postid']."' ";
    $cquery = mysqli_query($condb,$sql);
    $carray = array();
    $varray = array();
    while($crow = mysqli_fetch_assoc($cquery)){
      array_push($carray, $crow['lname']);
      $sql = "SELECT * FROM votes WHERE candid = '".$crow['candid']."'";
      $vquery = mysqli_query($condb,$sql);
      array_push($varray, mysqli_num_rows($vquery));
    }
    $carray = json_encode($carray);
     $varray = json_encode($varray);
    ?>
    <script>
    $(function(){
      var rowid = '<?php echo $row['candid']; ?>';
      var description = '<?php echo slugify($row['position']); ?>';
      var barChartCanvas = $('#'+description).get(0).getContext('2d')
      var barChart = new Chart(barChartCanvas)
      var barChartData = {
        labels  : <?php echo $carray; ?>,
        datasets: [
          {
            label               : 'Votes',
            fillColor           : 'rgba(60,141,188,0.9)',
            strokeColor         : 'rgba(60,141,188,0.8)',
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : <?php echo $varray; ?>
          }
        ]
      }
      var barChartOptions                  = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero        : true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : true,
        //String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        //Boolean - If there is a stroke on each bar
        barShowStroke           : true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth          : 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing         : 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing       : 1,
        //String - A legend template
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to make the chart responsive
        responsive              : true,
        maintainAspectRatio     : true
      }

      barChartOptions.datasetFill = false
      var myChart = barChart.HorizontalBar(barChartData, barChartOptions)
      //document.getElementById('legend_'+rowid).innerHTML = myChart.generateLegend();
    });
    </script>
    <?php
  }
?>