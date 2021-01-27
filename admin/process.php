<?php 
//require_once
include('./lib/dbcon.php'); 
dbcon(); 
include('session.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
			
	case 'status' :
		statusUser();
		break;
		case 'status2' :
	   statusUser2();
		break;
		case 'status20' :
	   statusUser20();
	   break;
		case 'status21' :
	   statusUser21();
		break;
    case 'status3' :
	   statusUser3();
		break;
		case 'status4' :
	   statusUser4();
		break;
		case 'status5' :
	   statusUser5();
		break;
	case 'status6' :
	statuscapp2();
	break;
		case 'status60' :
	statuscapp20();
		break;
			case 'status10' :
	statuspay();
		break;
	case 'status7' :
	statusUser7();
		break;
		case 'status8' :
	statusUser8();
		break;
		case 'status9' :
	statusUser9();
		break;
        case 'status11' :
	statusappresult();
		break;
        case 'status12' :
	statusappresult2();
		break;
        case 'status13' :
	statussignoff();
		break;
        case 'status14' :
	statusaccept();
		break;
        case 'status15' :
	enableappedit();
		break;
	default :
	 redirect("../admin/");
		//redi('Location: index.php');
}
function statusUser()
{ $userId = $_GET['userId'];	
	$nst 	= $_GET['nst']; $dep1 = $_GET['dep']; $sec1 = $_GET['sec']; $los 	= $_GET['cho'];
	$status = $nst == 'Cancel Approval' ? 'FALSE' : 'TRUE';
$sql   = mysqli_query(Database ::$conn,"UPDATE new_apply1 SET verify_apply = '".safee(Database::$conn,$status)."' WHERE stud_id = '".safee(Database::$conn,$userId)."' ");
//redirect("new_apply.php?details&userId=".$userId);
if(empty($dep1)){redirect("new_apply.php");}else{ redirect("new_apply.php?dept1_find=".$dep1."&session2=".$sec1."&c_choice=".$los);}
}
function statusUser2()
{$userId = $_GET['userId'];	
$nst 	= $_GET['nst'];
$status = $nst == 'Cancel Verification' ? 'FALSE' : 'TRUE';
$getsup=mysqli_query(Database ::$conn,"SELECT * FROM student_tb WHERE  stud_id ='".safee(Database::$conn,$userId)."' AND reg_status = '1'");
$stfound = mysqli_fetch_array($getsup); $regNo1 = $stfound['RegNo']; $pass_word = substr(md5($regNo1.SUDO_M),14); $yearofgrag = $stfound['yoe']+ $stfound['prog_dura'];
	$sql   = mysqli_query(Database ::$conn,"UPDATE student_tb SET verify_Data = '".safee(Database::$conn,$status)."',password = '".safee(Database::$conn,$pass_word)."',yog = '".safee(Database::$conn,$yearofgrag)."' WHERE stud_id = '".safee(Database::$conn,$userId)."'"); //redirect("Student_Record.php?details&userId=");
redirect("Student_Record.php?details&userId=".$userId);
	}
	
	function statusUser20()
{$userId = $_GET['userId'];
$nst 	= $_GET['nst']; $dep1 = $_GET['dep']; $sec1 = $_GET['sec']; $los 	= $_GET['los'];
$status = $nst == 'Cancel' ? 'FALSE' : 'TRUE';
$getsup=mysqli_query(Database ::$conn,"SELECT * FROM student_tb WHERE  stud_id ='".safee(Database ::$conn,$userId)."' AND reg_status = '1'");
$stfound = mysqli_fetch_array($getsup); $regNo1 = $stfound['RegNo'];if(strlen($stfound['password'] < 1)){ $pass_word = substr(md5($regNo1.SUDO_M),14); }else{$pass_word = $stfound['password']; }
$yearofgrag = $stfound['yoe']+ $stfound['prog_dura'];
	$sql   = mysqli_query(Database ::$conn,"UPDATE student_tb SET verify_Data = '".safee(Database ::$conn,$status)."',password = '".safee(Database ::$conn,$pass_word)."',yog = '".safee(Database ::$conn,$yearofgrag)."' WHERE stud_id = '".safee(Database::$conn,$userId)."'"); //redirect("Student_Record.php?details&userId=");
if(empty($dep1)){redirect("Student_Record.php");}else{ redirect("Student_Record.php?dept1_find=".$dep1."&session2=".$sec1."&los=".$los);}
	}
	  function statusUser21()
{ $userId = $_GET['userId'];	
	$nst 	= $_GET['nst']; $status = $nst == 'Block user' ? '0' : '1';
	$sql   = mysqli_query(Database ::$conn,"UPDATE admin SET validate = '".safee(Database ::$conn,$status)."' WHERE admin_id = '".safee(Database ::$conn,$userId)."'");
redirect("add_Users.php?view=Users");
}
	  function statusUser3()
{ $userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
	$status = $nst == 'Show' ? 'TRUE' : 'FALSE';
	$sql   = mysqli_query(Database ::$conn,"UPDATE news SET status = '".safee(Database::$conn,$status)."' WHERE news_id = '".safee(Database::$conn,$userId)."'");
redirect("News_events.php");
}
	  function statusUser4()
{$userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
	$status = $nst == 'Approve' ? '1' : '0';
	$hinfoo=mysqli_query(Database ::$conn,"SELECT * FROM hostelallot_tb WHERE  allot_id ='".safee(Database::$conn,$userId)."' AND paystatus = '1'");
	$hinfoo1 = mysqli_fetch_array($hinfoo); $roomid = $hinfoo1['roomno']; $startdatec = $hinfoo1['allotdate']; $duration = $hinfoo1['duration'];

	//$startdate2= DateTime::createFromFormat('d/m/Y', $startdatec)->format('Y-m-d');
		//production
//$startdate = endCycle($startdatec, $duration);
$sql   = mysqli_query(Database ::$conn,"UPDATE  hostelallot_tb SET validity = '".safee(Database::$conn,$status)."',allotdate = '".safee(Database::$conn,$startdatec)."',allotexpire = '".safee(Database::$conn,$startdate)."', allotstatus ='".safee(Database::$conn,$status)."',approve_by = '".$_SESSION['id']."' WHERE allot_id = '".safee(Database::$conn,$userId)."'");
$sql2   = mysqli_query(Database ::$conn,"UPDATE  roomdb SET room_status = '0' WHERE room_id = '".safee(Database::$conn,$roomid)."'");
redirect("add_Hostel.php?view=roomR");
}

function statusUser5()
{$userId = $_GET['id2'];	
	$nst 	= $_GET['nst'];
	$status = $nst == 'Show' ? 'TRUE' : 'FALSE';
	$sql   = "UPDATE staff_details SET u_display = '$status' WHERE staff_id = '$userId' ";
mysqli_query(Database ::$conn,$sql);
redirect("add_Staff.php?view=Employeelist");
	//header('Location: add_staff.php');	

}
function statuscapp2()
{$userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
	$cosn 	= getccode2($_GET['cos']);
		//$status = $nst == 'Verified' ? 'TRUE' : 'FALSE';
	$status = $nst == 'Approve' ? '1' : '0';
	$sql   = "UPDATE coursereg_tb SET lect_approve = '$status' WHERE sregno = '$userId'";
mysqli_query(Database::$conn,$sql); redirect("Course_m.php?view=clist&userId=".$cosn);
//redirect("Course_m.php?view=v_allot");
}
function statuscapp20()
{$userId = $_GET['userId'];	//$cosn 	= getccode2($_GET['slos']);
	$nst 	= $_GET['nst']; $cosn 	= $_GET['slos'];$sess = ($_GET['sec']);$sdp = ($_GET['Schd']); $matno = getrno($_GET['userId']);
	$status = $nst == 'Approve' ? '1' : '0';
	$sql   = "UPDATE coursereg_tb SET lect_approve = '$status' WHERE creg_id = '$userId'";
mysqli_query(Database::$conn,$sql); redirect("Result_am.php?view=caprove&dlist&userId=".($matno)."&Schd=".$sdp."&sec=".$sess."&slos=".$cosn);


}
function statusUser7()
{$userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
	$status = $nst == 'Approve' ? '1' : '0';
	$sql   = "UPDATE candidate_tb SET approve = '$status' WHERE candid = '$userId'";
mysqli_query(Database::$conn,$sql);
redirect("election.php?view=candidates");
}
function statusUser8()
{$userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
	$status = $nst == 'Approve' ? '1' : '0';
	$sql   = "UPDATE candidate_tb SET approve_result = '$status' WHERE candid = '$userId'";
mysqli_query(Database::$conn,$sql);
redirect("election.php?view=candidates");
}
function statusUser9()
{$userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
	$status = $nst == 'Start' ? '0' : '1';
	$sql   = "UPDATE electiontb SET estatus = '$status' WHERE id = '$userId'";
mysqli_query(Database::$conn,$sql);
redirect("election.php?view=velection");
}
function statuspay(){
$userId = $_GET['userId'];	
$nst 	= $_GET['nst']; $dop 	= $_GET['dop']; $sess = ($_GET['ses']);$sdp = ($_GET['dep']);
$status = $nst == 'Approve' ? '1' : '0';
$getsup=mysqli_query(Database ::$conn,"SELECT * FROM payment_tb WHERE  pay_id ='".safee(Database::$conn,$userId)."' AND paid_amount > 0 ");
$stfound = mysqli_fetch_array($getsup); $feetype = $stfound['fee_type']; 
$sql   = mysqli_query(Database ::$conn,"UPDATE payment_tb SET pay_status = '".safee(Database::$conn,$status)."' WHERE pay_id ='".safee(Database::$conn,$userId)."'");
$sql2 = mysqli_query(Database ::$conn,"UPDATE feecomp_tb SET pstatus ='".safee(Database::$conn,$status)."' WHERE Batchno ='".safee(Database::$conn,$feetype)."' ")or die(mysqli_error(Database::$conn));
redirect("View_Payment.php?dept1_find=".$sess."&session2=".$sdp."&dop=".$dop);
	}
 function statusappresult() 
{ $con = new Database(); $nst 	= $_GET['nst']; $dept = $_GET['Schd']; $sems = $_GET['sem']; $sess= $_GET['sec']; $lev = $_GET['lev']; $pro = $_GET['pro']; $fac = $_SESSION['bfac'];
$status = $nst == 'Approve' ? '1' : '0';
$queryresultapp2 = mysqli_query(Database::$conn,"select * from resultapproval_tb WHERE prog = '".safee($con,$pro)."' AND dept = '".safee($con,$dept)."' AND session = '".safee($con,$sess)."' AND level = '".safee($con,$lev)."' AND semester = '".safee($con,$sems)."' ");
 $aptatus = mysqli_num_rows($queryresultapp2); if($aptatus > 0){
 mysqli_query(Database::$conn,"UPDATE resultapproval_tb SET prog ='".safee($con,$pro)."' ,fac ='".safee($con,$fac)."' ,dept ='".safee($con,$dept)."' ,session ='".safee($con,$sess)."',level ='".safee($con,$lev)."',semester = '".safee($con,$sems)."',approveby ='".safee($con,$_SESSION['id'])."',apstatus ='".safee($con,$status)."',dateapproved = NOW() WHERE prog = '".safee($con,$pro)."' AND dept = '".safee($con,$dept)."' AND session = '".safee($con,$sess)."' AND level = '".safee($con,$lev)."' AND semester = '".safee($con,$sems)."'")or die(mysqli_error(Database::$conn));
}else{
mysqli_query(Database::$conn,"insert into resultapproval_tb (prog,fac,dept,session,level,semester,approveby,apstatus,dateapproved) values('".safee($con,$pro)."','".safee($con,$fac)."','".safee($con,$dept)."','".safee($con,$sess)."','".safee($con,$lev)."','".safee($con,$sems)."','".safee($con,$_SESSION['id'])."','".safee($con,$status)."',NOW())")or die(mysqli_error(Database::$conn));
} 
redirect("resultsheet_p.php?Schd=".$dept."&sec=".$sess."&lev=".$lev."&sem=".$sems);

}
 function statusappresult2() 
{ $con = new Database(); $nst 	= $_GET['nst']; $dept = $_GET['Schd']; $sems = $_GET['sem']; $sess= $_GET['sec']; $lev = $_GET['lev']; $pro = $_GET['pro']; $fm = $_GET['rform']; $fac = $_SESSION['bfac'];
$status = $nst == 'Approve' ? '1' : '0';
$queryresultapp2 = mysqli_query(Database::$conn,"select * from resultapproval_tb WHERE prog = '".safee($con,$pro)."' AND dept = '".safee($con,$dept)."' AND session = '".safee($con,$sess)."' AND level = '".safee($con,$lev)."' AND semester = '".safee($con,$sems)."' ");
 $aptatus = mysqli_num_rows($queryresultapp2); if($aptatus > 0){
 mysqli_query(Database::$conn,"UPDATE resultapproval_tb SET prog ='".safee($con,$pro)."' ,fac ='".safee($con,$fac)."' ,dept ='".safee($con,$dept)."' ,session ='".safee($con,$sess)."',level ='".safee($con,$lev)."',semester = '".safee($con,$sems)."',approveby ='".safee($con,$_SESSION['id'])."',apstatus ='".safee($con,$status)."',dateapproved = NOW() WHERE prog = '".safee($con,$pro)."' AND dept = '".safee($con,$dept)."' AND session = '".safee($con,$sess)."' AND level = '".safee($con,$lev)."' AND semester = '".safee($con,$sems)."'")or die(mysqli_error(Database::$conn));
}else{
mysqli_query(Database::$conn,"insert into resultapproval_tb (prog,fac,dept,session,level,semester,approveby,apstatus,dateapproved) values('".safee($con,$pro)."','".safee($con,$fac)."','".safee($con,$dept)."','".safee($con,$sess)."','".safee($con,$lev)."','".safee($con,$sems)."','".safee($con,$_SESSION['id'])."','".safee($con,$status)."',NOW())")or die(mysqli_error(Database::$conn));
} 
redirect("resultsheet_c.php?Schd=".$dept."&sec=".$sess."&lev=".$lev."&sem=".$sems."&rform=".$fm);

}
function statussignoff(){
$userId = $_GET['userId'];	
$nst 	= $_GET['nst']; $dept 	= $_GET['dep']; $staff = getstaff($_GET['stf']); $std = getsnameid($userId);
$status = $nst == 'Signoff' ? '1' : '0'; $depn = getdeptc($_GET['dep']);
 $sql   = mysqli_query(Database ::$conn,"UPDATE coc_tb SET chod_app = '".safee(Database::$conn,$status)."' WHERE sid ='".safee(Database::$conn,$userId)."'");
mysqli_query(Database ::$conn,"insert into activity_log (date,username,action) values(NOW(),'".$admin_username."','$std was sign off from $depn by $staff ')")or die(mysqli_error(Database::$conn)); 
redirect("Student_Record.php?view=coc");
	}
    function statusaccept(){
$userId = $_GET['userId'];	
$nst 	= $_GET['nst']; $dept 	= $_GET['dep']; $staff = getstaff($_GET['stf']); $std = getsnameid($userId);
$status = $nst == 'Accept' ? '1' : '0'; $depn = getdeptc($_GET['dep']);
 $sql   = mysqli_query(Database ::$conn,"UPDATE coc_tb SET nhod_app = '".safee(Database::$conn,$status)."' WHERE sid ='".safee(Database::$conn,$userId)."'");
mysqli_query(Database ::$conn,"insert into activity_log (date,username,action) values(NOW(),'".$admin_username."','$std was Accepted into $depn by $staff ')")or die(mysqli_error(Database::$conn)); 
redirect("Student_Record.php?view=coc");
	}
    function enableappedit()
{ $userId = $_GET['userId'];	
	$nst 	= $_GET['nst']; $dep1 = $_GET['dep']; $sec1 = $_GET['sec']; $los 	= $_GET['cho'];
	$status = $nst == 'Disable Edit' ? '1' : '0';
    
$sql   = mysqli_query(Database ::$conn,"UPDATE new_apply1 SET reg_status = '".safee(Database::$conn,$status)."' WHERE stud_id = '".safee(Database::$conn,$userId)."' ");
//redirect("new_apply.php?details&userId=".$userId);
if(empty($dep1)){redirect("new_apply.php");}else{ redirect("new_apply.php?dept1_find=".$dep1."&session2=".$sec1."&c_choice=".$los);}
}
?>