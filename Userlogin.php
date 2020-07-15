<?php include('header.php'); ?>

   <section id="content" role="document">
        <main style="min-height: 168px;">
                    <div class="container">
                        

<div class="row">
    <div class="col-xs-12">
        <div id="breadcrumbs-share">
            <section id="breadcrumbs">
                <ul class="breadcrumb">
                                <li><a href="<?php  host(); ?>">Home</a> </li>


                    

                    

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
            <h3>User Login Panel  </h3>
        </div>
        <div class="col-xs-12 primary-content link-icons">
<p class="first-paragraph">Please Note That Every Activity From Here is logged.</p>
                </div>
                
        <div class="margin-md-top row cards section-cards">
           <div class="col-xs-12">
           
            <div class="row nopadding nomargin" id="cards">
            
					<!-- form window  --!>	
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<!-- <h3 class="panel-title">Please sign up for Bootsnipp <small>It's free!</small></h3> --!>
			    		<h4 class="panel-title"><i class="fa fa-lock"></i> Please Login  </h4>
			 			</div>
			 			
			 			<div class="panel-body">
			    		<form id="login_form1" class="form-signin" method="POST" >
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Username<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			<input type="text"   class="form-control input-sm"   id="username" name="username" placeholder="Enter your Username or Reg No" required>
			             </div>
			    				</div>
			    				</div>
<!--
			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div> --!>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<label class="head">Password<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    <input type="password"  class="form-control input-sm"   id="password" name="password" placeholder="Password" required>
			    					</div>
			    				</div>
			    				
			    			</div>
			    				<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    			<div class="form-group">
		<div class="element-input"><label class="title">Solve the Captcha<span class="required">*</span></label>
    <img src="captcha1/captcha.php" id="captcha" /><br/>
    <a href="#" onClick="
    document.getElementById('captcha').src='captcha1/captcha.php?'+Math.random();
    document.getElementById('captcha-form').focus();"
    id="change-image">Not readable? Change text.</a><br/>
	
	<input class="medium" type="text" name="captcha" id="captcha-form"  required="required"/></div>
  </select>
			    					</div>
			    				</div>
			    				
			    			</div>
			    			
			    		<!--	<button type="button" class="btn btn-primary btn-vote">Vote!</button>
			    			<input type="submit" value="Apply" class="btn btn-primary btn-block"> --!>
			    			<input type="submit" value="Sign in" name="login" class="btn btn-primary">
			    		
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<label class="head"><a  rel="facebox" href='Up_recover.php'>Forgotten your password?</a></label>
			    				</div></div> 
			    						<!--<br> <button  title="Click Here to Apply" id="save1" name="B2" class="btn btn-primary col-md-4" onClick="window.location.href='apply_b.php';" type="reset">New Student Application </button><br><br>
				
					<button  title="Click Here to Check Your Entrance Exam Result" id="save2" name="B2" class="btn btn-primary col-md-4" onClick="window.location.href='apply_b.php?view=C_R';" type="reset"> Entrance Exam Result </button><br><br>
					
					<button  title="Click Here to Registration" id="save3" name="B2" class="btn btn-primary col-md-4" onClick="window.location.href='apply_b.php?view=Old';" type="reset">Old/Returning Student Registration</button> --!>
			    		
			    		</form>
			    	
			    		<?php $num="true_admin"; ?>
						<script>
						jQuery(document).ready(function(){
						jQuery("#login_form1").submit(function(e){
								e.preventDefault();
								var formData = jQuery(this).serialize();
								$.ajax({
									type: "POST",
									url: "logins.php",
									data: formData,
									success: function(html){
                                     
									if(html=='true_admin')
									{ 
                                    $.jGrowl("Loading File Please Wait......", { sticky: true });
									$.jGrowl("Welcome to <?php echo $row['SchoolName']; ?>", { header: 'Access Granted' });
									var delay = 1000;
										setTimeout(function(){ window.location = 'admin/'  }, delay);   
                                    }else if (html == 'true'){
									$.jGrowl("Loading Staff Window Please Wait......", { sticky: true });
										$.jGrowl("Welcome to <?php echo $row['SchoolName']; ?>", { header: 'Access Granted' });
									var delay = 1000;
										setTimeout(function(){ window.location = 'Staff/'  }, delay); 
										}else if (html == 'true_student'){
										$.jGrowl("Welcome to <?php echo $row['SchoolName']; ?>", { header: 'Access Granted' });
									var delay = 1000;
										setTimeout(function(){ window.location = 'Student/'  }, delay); 
									}else{
									$.jGrowl("Please Check your Username and Password <br> or Your Account is Inactive Please Contact Admin <br> or Your Captch Verification is Wrong ", { header: 'Login Failed' });
										
									}
									}
								});
								return false;
							});
						});
						</script>
						
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
<?php include("sidenews1.php"); ?>
            
        </div>
    </div>
</div>


        </main>
    </section>
    
    <?php include('footer.php'); ?>
    