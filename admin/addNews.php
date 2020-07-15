
<script type="text/javascript">   
$(document).ready(function() {   
$('#p_type').change(function(){   
if($('#p_type').val() === 'Events')   
   {  
   $('#c_title2').show(); $('#c_title').hide();
    $('#e_dt1').show();  $('#e_dt2').show();  $('#e_dt3').show();$('#e_dt4').show(); 
	  $('#im_d').hide();$('#fileInput').hide();
  }   
else 
   { 
    $('#c_title').show();  $('#c_title2').hide(); 
 $('#e_dt1').hide();$('#e_dt2').hide();$('#e_dt3').hide(); $('#e_dt4').hide();
 $('#im_d').show();$('#fileInput').show();
            
   }   
});   
});   
</script>


<?php //$get_RegNo= $_GET['albumid']; ?>

<?php

if(isset($_POST['post_news'])){
$p_type = $_POST['p_type'];
$c_title = $_POST['pname'];
$post_Disc = $_POST['post_Disc'];
//$mm = trim(strip_tags($_POST['mm']));
	//$dd = trim(strip_tags($_POST['dd']));
	$eventdate = $_POST['eventdate'];
$dop = $vartime=date("D M d, Y H:i:s");
//$event_date = $mm."-".$dd;
$age=date('Y')- $yy;
//$image_name = ucfirst($_POST['image_name']);
$status = $_POST['status'];
$name4     = $_FILES['image_name']['name'];
$tmpName  = $_FILES['image_name']['tmp_name'];
 $ext = strtolower(pathinfo($name4, PATHINFO_EXTENSION));
$maxsize = 500000;

$query_f = mysqli_query($condb,"select * from news where news_title = '$c_title' and publish_date='$dop'")or die(mysqli_error($condb));
//$row = mysql_fetch_array($query);
$row_fee = mysqli_num_rows($query_f);
if ($row_fee>0){
message("The $p_type Type with This Caption $c_title Already Exist Try Again", "error");
		        redirect('News_events.php');
	}else{
if($p_type=="News"){
if($_FILES['image_name']['name'] == Null)  {
message("Please Select an Image Before You post Your $p_type.", "error");
		        redirect('News_events.php');
}elseif(!in_array($ext, array('jpg','jpeg','png','gif')) ){
message("Invalid file type. Only  JPG, GIF and PNG types are accepted.", "error");
		        redirect('News_events.php');
			//}elseif($_FILES["image_name"]["size"] > $maxsize)  {
			}elseif(getimagesize($_FILES['image_name']['tmp_name']) < $maxsize){
			message("File size should be greater than 500kb.", "error");
		        redirect('News_events.php');
				}else{
	$filename = rand().$_FILES['image_name']['name'];
	move_uploaded_file($_FILES['image_name']["tmp_name"],"new_image/".$filename);
		mysqli_query($condb,"INSERT INTO news (news_title,news_type,publish_date,news_content,image,status,event_date) VALUES('$c_title','$p_type','$dop','$post_Disc','$filename','$status','-------')")or die(mysqli_error($condb));

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','$p_type Titled $c_title was Posted')")or die(mysqli_error($condb)); 
 ob_start();
 	message("New [$p_type] was Successfully Posted", "success");
		        redirect('News_events.php');
}
}else{
if((! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$eventdate)) ) {
						message("Date Formate should be in this Form example: 2017-01-02 !", "error");
			redirect('News_events.php');}else{
	mysqli_query($condb,"INSERT INTO news (news_title,news_type,publish_date,news_content,status,event_date) VALUES('$c_title','$p_type','$dop','$post_Disc','$status','$eventdate')")or die(mysqli_error($condb));
	
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','$p_type Titled $c_title was Posted')")or die(mysqli_error($condb)); 
// ob_start();
	message("New [$p_type] was Successfully Posted", "success");
		        redirect('News_events.php');}
}
}
}
?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                      <span class="section">Publish News And Events </span>

   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Post Type </label>
                            	  <select name='p_type' id="p_type" class="form-control" required="required" >
                            <option value="">Select Post Type</option>
                             <option value="News">News</option>
                              <option value="Events">Events</option>
                            
                             </select>
                      </div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard" id="c_title">News Caption :</label>
                      <label for="heard" style="display: none;" id="c_title2">Event Caption :</label>
                          <input type="text" class="form-control " name='pname' id="pname"  value=""  required="required"> </div>
                          
                       
                      
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
					  <label for="heard">Content :</label>
                      <textarea name="post_Disc" id="post_Disc" class="form-control"   required="required"><?php echo $row['album_description']; ?></textarea>
                           </div>
                           
                           <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" style="display: none;" id='e_dt1'>
					  <label for="heard" >Event Date:</label>
                      
                          <input type="text" class="form-control " name='eventdate' id="eventdate" placeholder="Example : 2009-10-11" value="" autocomplete="off"  > </div>
                           
                    <!--  <div class="col-md-2 col-sm-2  form-group has-feedback">
					  <label for="heard" style="display: none;" id='e_dt1'>Set Event Day :</label>
                      <select class="form-control" name="dd"  style="display: none;" id='e_dt2' >
<option value="00">Day</option>
<?php for($x=1;$x<32;$x++){
	echo '<option value="'.$x.'">'.$x.'</option>';
	} ?>
    </select>
    </div><div class="col-md-2 col-sm-2  form-group has-feedback">
    <label for="heard" style="display: none;" id='e_dt3'>Set Event Month :</label>
    <select class="form-control" name="mm"  style="display: none;" id='e_dt4'>
<option value="00">Month</option>
<option value="Jan">Jan</option>
<option value="Feb">Feb</option> 
<option value="Mar">Mar</option>
<option value="Apr">Apr</option> 
<option value="May">May</option> 
<option value="Jun">Jun</option> 
<option value="Jul">Jul</option> 
<option value="Aug">Aug</option> 
<option value="Sep">Sep</option> 
<option value="Oct">Oct</option> 
<option value="Nov">Nov</option> 
<option value="Dec">Dec</option> 
</select>
                          
						  
						  </div> --!>
						  
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
					  <label for="heard" id="im_d">News Image:</label>
                      <input name="image_name" class="form-control" id="fileInput" type="file" accept="image/*" onchange="preview_image(event)" style="width:200px;">
						  </div>
                          
                          <!--
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Date Of Publication</label>
                            	    <input  type="text" name="dop" size="18" style="height:32px;"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed1"   readonly="readonly"></div> --!>
  
                      
                     
                    
                     <div class="col-md-3 col-sm-3  form-group has-feedback">
						  	  <label for="heard">Post Status </label>
                            	  <select name='status' id="status" class="form-control" >
                            <option value="">Select Status</option>
                             <option value="TRUE">Show</option>
                              <option value="FALSE">Hide</option>
                            
                             </select>
                      </div>
               
                         <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        
                         	<?php   if (authorize($_SESSION["access3"]["nOt"]["ane"]["create"])){ ?>
                        <button  name="post_news"  id="addpro"  class="btn btn-primary" title="Click Here to Post Data" ><i class="fa fa-sign-in"></i> Post </button>
                      <?php } ?>
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addpro').tooltip('show');
	                                            $('#addpro').tooltip('hide');
	                                            });
	                                            </script>
                        
                        </div>  </form>
					   
					   </div>
                 