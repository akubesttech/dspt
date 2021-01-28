
<?php  include('header.php'); ?>
<?php include('session.php'); ?>
	
		    	

 <?php include('student_slidebar.php'); ?>
    <?php include('navbar.php') ?>
  <?php $get_RegNo = isset($_GET['userId']) ? $_GET['userId'] : ''; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Student Payment Management
</h3>
</div>
</div>
<?php 
if($student_state == "Delta"){ $scan = "1";}else{ $scan = "0";} 
$qcomp = "select * from fee_db where  level= '".safee($condb,$student_level)."' and program='".safee($condb,$student_prog)."' and cat_fee ='".safee($condb,$scan)."' and status = '1'";
if($acastatus == 8){ $qcomp.= " and ft_cat ='6' ";}else{$qcomp.= " and ft_cat ='1' ";}
$querycomp = mysqli_query($condb,$qcomp) or die(mysqli_error($condb));
 $nocomp = mysqli_num_rows($querycomp);
 $Bno = 0;
$s=8;while($s>0){ $Bno .= rand(0,9);$s-=1; } $batchno = "B".$Bno;

if (isset($_POST['addpay'])){ $date_now =  date("Y-m-d");
	 if(empty($_POST['selector'])){
				message("You have not selected any payment component !", "error");
		        redirect('Spay_manage.php?view=a_p');
		        //}elseif(count($_POST['selector']) < $nocomp){
		        	//message("compulsory Fees are required to Continue payment !", "error");
		        //redirect('Spay_manage.php?view=a_p');
				}else{ $id=$_POST['selector'];  $N = count($id);
for($i=0; $i < $N; $i++){
$sfcom = mysqli_query($condb,"select * from fee_db where fee_id ='".$id[$i]."' ") or die(mysqli_error($condb));
$row = mysqli_fetch_array($sfcom); extract($row);$date20 = str_replace('/', '-', $psdate );  $newDate20 = date("Y-m-d",strtotime($date20));
 if($pper > 0 and $date_now >= $newDate20){ $penaltysum = FeesCalc($f_amount,$pper,$newDate20); $pen1 = "1";}else{ $penaltysum = $f_amount; $pen1 = "0"; }
$qfcomp=mysqli_query($condb,"select * from feecomp_tb where feetype ='".safee($condb,$feetype)."' and prog = '".safee($condb,$program)."' and fcat = '".safee($condb,$ft_cat)."' and level ='".safee($condb,$level)."' and regno = '".safee($condb,$stud_row['RegNo'])."'") or die(mysqli_error($condb));
if(mysqli_num_rows($qfcomp)>0){
 $resultapp = mysqli_query($condb,"UPDATE feecomp_tb SET f_amount ='".safee($condb,$penaltysum)."',session = '".safee($condb,$default_session)."',Batchno = '".safee($condb,$batchno)."'  where feetype ='".safee($condb,$feetype)."' and prog = '".safee($condb,$program)."' and fcat = '".safee($condb,$ft_cat)."' and penalty = '".$pen1."' and level ='".safee($condb,$level)."' and regno = '".safee($condb,$stud_row['RegNo'])."'")or die(mysqli_error($condb));
}else{
$queryin = mysqli_query($condb,"insert into feecomp_tb(regno,feetype,prog,level,f_amount,fcat,penalty,session,Batchno)values('".safee($condb,$stud_row['RegNo'])."','".safee($condb,$feetype)."','".safee($condb,$program)."','".safee($condb,$level)."','".safee($condb,$penaltysum)."','".$ft_cat."','".$pen1."','".safee($condb,$default_session)."','".safee($condb,$batchno)."')")or die(mysqli_error($condb));
}
	//message(" Applicant(s) information  Successfully Verified .", "success");
 redirect('Spay_manage.php?view=m_sp&id='.$batchno); }}}
?>
<div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
			
					<?php 
	
						$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'a_p' :
		            $content    = 'addPay.php';		
		            break;

	                case 'm_sp' :
		            $content    = 'caddPay.php';		
		            break;
		            
		             case 'e_pv' :
		            $content    = 'e_paymentv.php';		
		            break;
		            
		             case 'e_suc' :
		            $content    = 'e_payvsuc.php';		
		            break;
		            case 'e_fail' :
		            $content    = 'e_payvfail.php';		
		            break;
                    
		            
	                default :
		            $content    = 'loadedpayment.php';
				
                            }
                     require_once $content;  
					//$num=$get_RegNo;
				//if ($num!==null){
			//include('editStaff.php');
			//}else{
			
			//	include('addStaff.php'); }?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



          



            
            
          </div>
        </div>
        <!-- /page content -->
        
  


         <?php include('footer.php'); ?>