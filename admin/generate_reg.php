
<?php 
$usergen = $_GET['userId'];$gdp =$_GET['dp'];
$find_d_load = mysqli_fetch_array(mysqli_query($condb," SELECT * FROM student_tb where stud_id='".safee($condb,$_GET['userId'])."'"));
$num_dep =trim($find_d_load['Department']) ;  $yearadd = substr($default_session,0,4); $sessionad  = $find_d_load['Asession'];
$pro  = $find_d_load['app_type'];$levn  = $find_d_load['p_level'];
$find_d_load = mysqli_fetch_array(mysqli_query($condb," SELECT * FROM dept where dept_id='".safee($condb,$num_dep)."'"));
if(empty($find_d_load['d_code'])){ $num_dept_id =$find_d_load['dept_id'] ; }else{ $num_dept_id =$find_d_load['d_code'] ; }
$studentRegnon = getmatno($sessionad,$num_dep,$pro); $regcount = "1".getlstr($studentRegnon,3);
if(empty($gdp)){$link2 = "Student_Record.php";  }else{ $link2 = "Student_Record.php?dept1_find=".$gdp."&session2=".$sessionad."&los=".$levn;; }
//$yearadd=date('Y');
//$chima='CSS/'.($yearadd - 1)."/".$num_dept_id."/";
$chima=($yearadd).$num_dept_id;

?>
<script>
function randomStringToInput(clicked_element)
{
    var self = $(clicked_element);
   
    var random_string = generateRandomString(3);
    $('input[name=RegNo]').val(random_string);
    //self.remove();
}

//function generateRandomString(string_length)
function generateRandomString(string_length)
{
//var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   // var characters = '0123456789';
    var characters = '';

    var string = '<?php echo $chima . substr($serial,1,4); ?>';

    for(var i = 0; i <= string_length; i++)
    {
        var rand = (characters.length - 1);
        
        var character =characters.substr(rand, 1);
         
        string = string + character;
    }
//<input type="text" name="RegNo" readonly="readonly" value="">
    return string;
}
</script>
<?php
//if($_SESSION['insidf']==$_POST['insidf'])
//{
if(isset($_POST['addFee'])){

$studentRegno = $_POST['RegNo'];
//$regcount = $_POST['genome'];


$query_reg = @mysqli_query($condb,"select * from student_tb where RegNo='".safee($condb,$studentRegno)."'")or die(mysqli_error($condb));
$count_reg = mysqli_num_rows($query_reg);
if ($count_reg>0){
message("Student Matric No Already Exist In our Database.", "error");
		       redirect('Student_Record.php?view=view=G_Reg&userId='.$usergen);
}elseif(strpos($studentRegno," ")){
message("Please! Student Matric No can not Contain a Space.", "error");
		       redirect('Student_Record.php?view=view=G_Reg&userId='.$usergen);
}else{
mysqli_query($condb,"UPDATE student_tb SET RegNo='".safee($condb,$studentRegno)."',reg_count='".safee($condb,$regcount)."' WHERE stud_id='".safee($condb,$_GET['userId'])."'")or die(mysqli_error($condb));
 ob_start();
 message("Student Matric No [$studentRegno] Successfully Added! Please click verify to Activate the Student", "success");
		       redirect($link2);
//$res="<font color='green'><strong>Student Registration Number [$studentRegno] Successfully Added ! </strong></font><br>";
				//$resi=1;
/*$queryupdate="UPDATE lastserial SET last='$serial' WHERE id=1";
$output2=mysqli_query($condb,$queryupdate);
if(!$output2){
	echo mysqli_error($condb);
	//exit();
} */
}
}//}$_SESSION['insidf'] = rand();
?>
<?php
//$s=3;while($s>0){$AppNo .= rand(0,9);$s-=1;	}
	$find_d_load2 = mysqli_fetch_array(mysqli_query($condb," SELECT * FROM student_tb where stud_id='".safee($condb,$_GET['userId'])."'"));
$num_dep =$find_d_load['Department'] ;

?>
<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />

                      
                      <span class="section">Generate Matric No  </span>

<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Note: This window will enable admin to Generate Matric No For Student and you can as well type in Reg No. 
                  </div>
   
					    <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard">Student Name </label>
						  	  
        <input type="text" class="form-control " name="st_name" id="st_name"  value="<?php echo ucwords($find_d_load2['FirstName']." ".$find_d_load2['SecondName']." ".$find_d_load2['Othername']) ;?>" readonly  >
                      </div>
                     
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard"><?php echo $SGdept1; ?></label>
    <input type="text" class="form-control " name="deept" id="deept"  value="<?php echo getdeptc($find_d_load2['Department']) ;?>" readonly >
                      </div>

                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Student Matric No:  </label>
                      <?php 
 
$tran=mysqli_query($condb,"select max(reg_count) from student_tb WHERE Asession = '".safee($condb,$default_session)."' and Department ='".safee($condb,$find_d_load2['Department'])."' ");
//$tran=mysqli_query($condb,"SELECT MAX(counted) FROM( SELECT COUNT(*) AS counted FROM student_tb WHERE Asession = '".$default_session."' and Department='".$num_dep."' GROUP BY Department ) AS counts");
while($tid = mysqli_fetch_array($tran, MYSQLI_BOTH))
{
if($tid[0] == null)
{
$tmax="1001";
}
else
{
$tmax=$tid[0]+1;
}
}
$maxadd = substr($tmax,1,4);
//$chima='CSS/'.($yearadd - 1)."/".$num_dept_id."/";
$genregnonew =($yearadd)."/".$num_dept_id."/".$maxadd;
     ?>
	  <input type="hidden" name="genome" value="<?php echo $tmax;?> " />              
     <input type="text" class="form-control" name="RegNo" id="RegNo" onkeypress="return isNumber(event);" value="<?php echo $studentRegnon; ?>"  required="required">
		<!--				 <input type="button" value="Generate Reg Number" title="Click to Generate Registration Number" class="btn btn-info" onclick="randomStringToInput(this)">  --!>
		</div>
                    
                    
               
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         
                        <button  name="addFee"  id="addFee"  class="btn btn-primary col-md-4" title="Click Here to Add Matric Number To Selected Student" ><i class="fa fa-sign-in"></i> Add Matric No</button>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addFee').tooltip('show');
	                                            $('#addFee').tooltip('hide');
	                                            });
	                                            </script>
	                                             <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 