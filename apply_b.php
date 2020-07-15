<?php include('header.php');?>
<?php 
		//$user_query = mysql_query("select * from schoolsetuptd")or die(mysql_error());
												//	while($row = mysql_fetch_array($user_query)){
												//	$get_FormStatus = $row['RegNo'];
													//}
					$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'New' :
		            $content    = 'Newapplication.php';		
		            break;

	                case 'Return' :
		            $content    = 'Continue.php';		
		            break;
                    
                     case 'Application_Process' :
		            $content    = 'apply_pro.php';		
		            break;
		            case 'N_1' :
		            $content    = 'apply_1.php';		
		            break;
		            case 'N_2' :
		            $content    = 'rapply_2.php';		
		            break;
		         
		            case 'C_R' :
		            $content    = 'Cutmeresult.php';		
		            break;
		            case 'Old' :
		            $content    = 'Returning.php';		
		            break;
		            case 'O_C' :
		            $content    = 'R_continue.php';		
		            break;
		            
		            case 'M_P' :
		            $content    = 'Selectptype.php';		
		            break;
		            
		            case 'e_view' :
		            $content    = 'e_payview.php';		
		            break;
		           
		            case 'ep_view' :
		            $content    = 'e_pview.php';		
		            break;
		            case 'p_sh' :
		            $content    = 'p_shop.php';		
		            break;
		            case 'f_select' :
		            $content    = 's_form.php';		
		            break;
		            case 'About' :
		            $content    = 'about_cms.php';		
		            break;
		            case 'FAQ' :
		            $content    = 'faq.php';		
		            break;
		            case 'Readmore1' :
		            $content    = 'ourSchool.php';		
		            break;
		            case 'e_suc' :
		            $content    = 'e_payvsuc.php';		
		            break;
		            case 'pay' :
		            $content    = 'newpaylist.php';		
		            break;
		            case 'lpay' :
		            $content    = 'loadpayment.php';		
		            break;
		            case 'opay' :
		            $content    = 'loadpayoption.php';		
		            break;
		            case 'Help' :
		            $content    = 'helps.php';		
		            break;
		            
	                default :
		            $content    = 'apply_a.php';
				
                            }
                     require_once $content;
				
				?>
				
				
<?php include('footer.php'); ?>