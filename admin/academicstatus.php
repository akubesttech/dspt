
<script type="text/javascript">   
$(document).ready(function() {   
$('#categ').change(function(){   
if($('#categ').val() === '2')   
   {   $('#enable1').show(); $('#enable2').hide();    }   
else if ($('#categ').val() === '1') 
   {   $('#enable1').show(); $('#enable2').show();      }
   else {   $('#enable1').hide(); $('#enable2').hide();      }      
});   
});   
</script>

<?php

if(isset($_POST['addstatus'])){
$cMatno= ($_POST['matno']);
$prog = $_POST['prog'];
$ldstatus = $_POST['acs2'];
$changestatus = $_POST['changestatus'];
$custatus = $changestatus == '' ? $ldstatus : $changestatus;
$dog = $_POST['dog']; 
$comment = $_POST['comm']; 
$status = getAcastatus($changestatus); 
$Academicstate = getAstate($changestatus);
$nstatus = $changestatus == '' ? '0' : $changestatus;
$query = mysqli_query($condb,"select * from student_tb where RegNo = '".safee($condb,$cMatno)."' AND reg_status = '1' ")or die(mysqli_error($condb));
$row_course = mysqli_num_rows($query);

if ($row_course < 1){
message("Student with this Matric No [$cMatno] does not Exist Please Try Again.", "error");
		        redirect('Student_Record.php?view=sas');
		    }else{
		
mysqli_query($condb,"UPDATE  student_tb SET  acads='".safee($condb,$custatus)."',verify_Data='".safee($condb,$Academicstate)."',comment='".safee($condb,$comment)."',dog = '".safee($condb,$dog)."' where RegNo='".safee($condb,$cMatno)."'")or die(mysqli_error($condb));
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Academic Status of student with Matric No $cMatno was updated to $status .')")or die(mysqli_error($condb));
 message("Student Academic Status Successfully Updated", "success");
		        redirect('Student_Record.php?view=sas');}
				
				}

?>
<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="register" method="post" enctype="multipart/form-data" id="register">
<input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
<input type="hidden" class="form-control "    name='fac' id="fac" tabindex="3"  placeholder="<?php echo $SCategory; ?>" >
<input type="hidden" class="form-control "    name='dept1' id="dept1" tabindex="6"  placeholder="" >
<input type="hidden" class="form-control "    name='prog' id="prog" tabindex="7"  placeholder="" >
<input type="hidden" class="form-control "    name='acs2' id="acs2" tabindex="14"  placeholder="" >


<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
Enter Matric Number To Edit/View Student Academic Status,Make Comments and Date of Graduation. <?php  //echo getAcastatus()  ; ?>
                  </div>
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"  >
 <label for="email">Matric Number*</label>
<div class="form-group"><input type="text" class="form-control "  name="matno1" id="matno1"  onkeyup="getacastatus2(this.value);" onblur="getacastatus2(this.value);" tabindex="1" placeholder=" Matric No" required="required" > </div></div>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
 <label for="name">Student Full Name (Surname First)</label>
<div class="form-group"><input type="text" class="form-control "    name='fname' id="fname" tabindex="2"  placeholder="Student Full Name" readonly></div></div>

<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"  >
 <label for="email">Programme</label>
<div class="form-group"><input type="text" class="form-control "    name='progn' id="progn" tabindex="8" placeholder="Programme of Study" readonly></div></div>

<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback"  >
 <label for="email"><?php echo $SCategory; ?></label>
<div class="form-group"><input type="text" class="form-control "    name='fac2' id="fac2" required="required" placeholder="<?php echo $SCategory; ?>" tabindex="5" readonly ></div></div>

<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"  >
 <label for="email">Department</label>
<div class="form-group"><input type="text" class="form-control "    name='dept2' id="dept2" required="required" placeholder="" readonly ></div></div>
 
 <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"  style="display:block; " id="penper"  >
 <label for="email">Academic Status</label>
<div class="form-group"><input type="text" class="form-control "    name='acs' id="acs" tabindex="13"  placeholder="" readonly ></div></div>
 
 <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback" style="display:none; " id="changestatus"><label for="heard">Academic Status</label>
<div class="form-group"><select name='changestatus' id="changestatus"    class="form-control"   >
                <option value="">--Status--</option> <?php echo getAcastatus(0,1) ; ?>          
       </select></div></div>
       
        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
		<label for="chkPenalty"> </label><div class="form-group"><br>
    <label class="chkPenalty"><input type="checkbox" id="chkPenalty"  onclick="ShowHideDiv2(this)" name="chkPenalty" value="1" /> Change Academic Status </label></div></div>
    
 <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"  >
 <label for="email">Academic Session</label>
<div class="form-group"><input type="text" class="form-control "    name='sec' id="sec" tabindex="12" readonly></div></div> 

<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"  >
 <label for="email">Sessional CGPA</label>
<div class="form-group"><input type="text" class="form-control "    name='scgpa' id="scgpa" tabindex="9"  readonly></div></div> 

<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
 <label for="email">Date of Graduation</label>
<div class="form-group">  <input type="text" name='dog' id="dog" class="input-large w8em format-d-m-y highlight-days-67 range-middle-today form-control" tabindex="10"  required   placeholder = "Date Created" readonly>
                                          </div></div> 
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"  ><label for="email">Comments</label>
                                          <div class="form-group">
                                          
                                          <textarea name='comm' id="comm" class="span7" placeholder = "Comments" tabindex="11" style="width:220px;"></textarea>
                                          </div>
                                        </div>

                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                       
                        </div>
                      </div>
                    
                                     
                                       
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3" >
                         <?php   if (authorize($_SESSION["access3"]["stMan"]["sas"]["create"])){ ?> 
                        <button  name="addstatus"  id="addstatus"  class="btn btn-primary" title="Click Here to Save Acadamic Status" ><i class="fa fa-save"></i> Save </button><?php } ?>   
                         <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addstatus').tooltip('show');
	                                            $('#addstatus').tooltip('hide');$('#goback').tooltip('show');
	                                            $('#goback').tooltip('hide');
	                                            });
	                                            </script>
	                                           </div> 
                        
                         
                        	
									
                        </form></div>
                       </div>                             