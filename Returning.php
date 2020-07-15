<?php
//session_start();

//ini_set('display_errors', 1);
//if($_SESSION['insido']==$_POST['insido'])
//{
if(isset($_POST['old_Continue'])){
 
$reg_no = $_POST["reg_no"];
	$_SESSION['temppin']=$reg_no;

	$sql_pinn="SELECT * FROM student_tb WHERE RegNo ='".safee($condb,$reg_no)."'";
$result_pinn = mysqli_query($condb,$sql_pinn);
$num_pinn = mysqli_num_rows($result_pinn);
$num_serial = mysqli_fetch_array($result_pinn);
$studentpics8 = $num_serial['images'];
//$find_record = mysqli_fetch_array($result_pin1);
//$studentpics = $find_record['images'];

$sql_pinn2="SELECT images FROM student_tb WHERE RegNo ='".safee($condb,$reg_no)."' AND appNo ='".safee($condb,$num_appNo)."' AND reg_status = '0'";
$result_pinn2 = mysqli_query($condb,$sql_pinn2);
$num_pinn2 = mysqli_num_rows($result_pinn2);

	if(strpos($reg_no," ")){
		message("Please! Registration Number can not Contain a Space.", "error");
				redirect("apply_b.php?view=Old");
					}elseif($num_pinn > 0 and $studentpics8!=Null){
echo "<script>alert('Your Details have been Submited!');</script>";
		echo "<script>window.location.assign('studregprint.php?stid=".md5($_POST['reg_no'])."');</script>";
		
				}else{
				if($num_pinn > 0 and $studentpics8==Null){
				//header("location:apply_b.php?view=O_C");
				redirect("apply_b.php?view=O_C");
					//echo "<script>window.location.assign('apply_b.php?view=O_C');</script>";
			}else{
				//header("location:apply_b.php?view=O_C");
				//echo "<script>window.location.assign('apply_b.php?view=N_1 & applicationid=".$nappNo20."');</script>";
				redirect("apply_b.php?view=O_C");
			}

}}//}$_SESSION['insido'] = rand();
?>
   <section id="content" role="document">
        <main style="min-height: 168px;">
                    <div class="container">
                        

<div class="row">
    <div class="col-xs-12">
        <div id="breadcrumbs-share">
            <section id="breadcrumbs">
                <ul class="breadcrumb">
                                <li><a href="<?php echo  host(); ?>">Home</a> </li>

                </ul>
            </section>
        </div>
    </div>
</div>
                    </div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9 link-icons">
            <div class="row">
                <div class="col-xs-12">
            <h3>Old/Returning Student Record Validation Form   </h3>
        </div>
        <div class="col-xs-12 primary-content link-icons">
<p class="first-paragraph">This page will Enable Old Student Validate Their Information..</p>
                </div>
                
        <div class="margin-md-top row cards section-cards">
           <div class="col-xs-12">
           
            <div class="row nopadding nomargin" id="cards">
            
					<!-- form window  --!>	
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<!-- <h3 class="panel-title">Please sign up for Bootsnipp <small>It's free!</small></h3> --!>
			    		<h4 class="panel-title"> Matric/Registration Number:  </h4>
			 			</div>
			 			
			 			<div class="panel-body">
			    		<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			    		<input type="hidden" name="insido" value="<?php echo $_SESSION['insido'];?> " />
			<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					
			    					<div class="form-group">
			<input type="text"   class="form-control input-sm"   name="reg_no" id="reg_no" placeholder="Enter your Matric/Registration Number" required="required" >
			             </div>
			    				</div>
			    				</div>
<!--
			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div> --!>

			    			
			    			
			    		<!--	<button type="button" class="btn btn-primary btn-vote">Vote!</button>
			    			<input type="submit" value="Apply" class="btn btn-primary btn-block"> --!>
			    		
			    		<button name="old_Continue" class="btn btn-primary" id="button1" data-placement="right" type="submit" title="Click to Next Button To Continue Registration"><i class="icon-plus-sign icon-large"> Next</i></button>
			    			
			    		
			    		</form>
			    	</div>
	    		</div>
    	
    	
    
    	
    	
						
                </div>
                
                
            </div>
        </div>



            </div>
            
        </div>
        
        <div class="col-xs-12 col-md-3 sidebar-right margin-lg-bottom">
            <!-- right feature space -->
            
   <!-- <div class="apply-box">
        <a class="btn btn-default expand padding-md" href="https://applyalberta.ca/APAS.Web.Public/ApplicationServices/default.aspx?StartingAction=ApplyNow">APPLY NOW</a>
    </div> --!>

<?php include("sidenews.php"); ?>
            
        </div>
        
        
    </div>
</div>


        </main>
    </section>
    
  