<?php
//core
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//include_once('linkoff.php');  
//strip_php_extension(); 
include_once("dbclass.php");
//include_once("Secureme.php");
//date_default_timezone_set("UTC");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
Database::initialize();
dbcon();
} catch(Exception $e) {
  error_log($e->getMessage());
  exit('Unable to establish Database connection!'); //Should be a message a typical user could understand
}
function dbcon() {
    global $condb;
$condb = mysqli_connect(SERVER,USERNAME,PASSWORD,DATABASE);
if (mysqli_connect_errno()) { printf("Connect failed: %s\n", mysqli_connect_error());
        exit();}}
        
        // set user right
        function set_rights($menus, $menuRights, $topmenu) {
    $data = array();

    for ($i = 0, $c = count($menus); $i < $c; $i++) {


        $row = array();
        for ($j = 0, $c2 = count($menuRights); $j < $c2; $j++) {
            if ($menuRights[$j]["rr_modulecode"] == $menus[$i]["mod_modulecode"]) {
                if (authorize($menuRights[$j]["rr_create"]) || authorize($menuRights[$j]["rr_edit"]) ||
                        authorize($menuRights[$j]["rr_delete"]) || authorize($menuRights[$j]["rr_view"])
                ) {

                    $row["menu"] = $menus[$i]["mod_modulegroupcode"];
                    $row["menu_name"] = $menus[$i]["mod_modulename"];
                    $row["page_name"] = $menus[$i]["mod_modulepagename"];
                    $row["create"] = $menuRights[$j]["rr_create"];
                    $row["edit"] = $menuRights[$j]["rr_edit"];
                    $row["delete"] = $menuRights[$j]["rr_delete"];
                    $row["view"] = $menuRights[$j]["rr_view"];

                    $data[$menus[$i]["mod_modulegroupcode"]][$menuRights[$j]["rr_modulecode"]] = $row;
                    $data[$menus[$i]["mod_modulegroupcode"]]["top_menu_name"] = $menus[$i]["mod_modulegroupname"];
                    $data[$menus[$i]["mod_modulegroupcode"]]["top_menu_icon"] = $menus[$i]["mod_modulegroupicon"];
                    $data[$menus[$i]["mod_modulegroupcode"]]["top_menu_order"] = $menus[$i]["mod_moduleorder"];
                }
            }
        }
    }
    
    return $data;
}

function authorize($module) {
    return $module == "1" ? 1 : 0;
}

define('SITE_URL', "https://".$_SERVER['HTTP_HOST']."/");

function host(){
	$h = "https://".$_SERVER['HTTP_HOST']."/";
	return $h;
}

function hRoot(){
	$url = $_SERVER['DOCUMENT_ROOT']."/";
	return $url;
}
global $from ,$replyto,$SCategory,$comn,$SGdept1,$SGdept2;
$from = "support@edu.smartdelta.ng";
$replyto = "ifennalue2018@gmail.com";
$SCategory = "School";
$SGdept1 = "Department"; $SGdept2 = "SUBJECT_COMB";
$comn="Delta state Smart Education";

//parse string
function gstr(){
    $qstr = $_SERVER['QUERY_STRING'];
    parse_str($qstr,$dstr);
    return $dstr;
}

 function imageUrl($imageid)
    { $imageid = ""; //"assets/media/upevents.png"
return "https://".$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")+1).$imageid;
    }
function message($msg="", $msgtype="") {
	  if(!empty($msg)) {
	    // then this is "set message"
	    // make sure you understand why $this->message=$msg wouldn't work
	    $_SESSION['message'] = $msg;
	    $_SESSION['msgtype'] = $msgtype;
	  } else {
	    // then this is "get message"
			return $message;
			//return "";
	  }
	}
	function check_message(){
	
		if(isset($_SESSION['message'])){
			if(isset($_SESSION['msgtype'])){
				if ($_SESSION['msgtype']=="info"){ ?>
	 				<div class="alert info" style="text-align:center;"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>'<?php echo $_SESSION['message']; ?></div>
	 			<?php	 
				}elseif($_SESSION['msgtype']=="error"){ ?>
					<div class="alert danger" style="text-align:center;"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> <?php echo $_SESSION['message'] ; ?></div>
				<?php					
				}elseif($_SESSION['msgtype']=="success"){ ?>
					<div class="alert success" style="text-align:center;"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> ' <?php echo $_SESSION['message']; ?></div>
			<?php	}	
				unset($_SESSION['message']);
	 			unset($_SESSION['msgtype']);
	   		}
  
		}	

	} 
function redirect($location=Null){
		if($location!=Null){
			echo "<script>
					window.location='{$location}'
				</script>";	
		}else{
			echo 'error location';
		}
		 
	}
function getpaystatus($statnum)
{if ($statnum==0)
  { // return "Not Confirmed";
    return "Pending";}
  else if($statnum==1)
  {// return "Confirmed";
     return "Successful";}}
     
  function getggroup($statnum)
{if ($statnum==01){return "General";
  }else if($statnum==02){return "Entrance Exam";}}
  
   function getcateg($statnum)
{ global $SCategory; if ($statnum==3){return "General";}else if($statnum==2){return $SCategory;}else if($statnum==1){return "Department";}}

function getdeptc($get_dep) { //$mysqli = new mysqli("localhost", "root", "","dscht_db");
//$query2_hod = $mysqli->query("select d_name from dept where dept_id = '$get_dep' ")or die(mysqli_error($condb));
$query2_hod = mysqli_query(Database::$conn,"select d_name from dept where dept_id = '$get_dep' ")or die(mysqli_error($condb));
$count_hod = mysqli_fetch_array($query2_hod);
 $nameclass22=$count_hod['d_name'];
return $nameclass22;} 

//new student
function getDep($get_dep20)
{$query2 = @mysqli_query(Database::$conn,"select Department from student_tb where RegNo = '$get_dep20' or appNo = '$get_dep20'")or die(mysqli_error($condb));
$count = mysqli_fetch_array($query2);
 $nameclass2=$count['Department'];
return $nameclass2;
}
function getname($get_name)
{$query_cou = @mysqli_query(Database::$conn,"select FirstName,SecondName,Othername from student_tb where RegNo = '$get_name' or appNo = '$get_name'")or die(mysqli_error($condb));
$count_cou = mysqli_fetch_array($query_cou);
 $namecourse2=$count_cou['FirstName']." ".$count_cou['SecondName']." ".$count_cou['Othername'];
return $namecourse2;}

 function getdcode($get_dept) { 
 $query2_hod = mysqli_query(Database::$conn,"select dept_id from dept where d_name = '$get_dept' ")or die(mysqli_error($condb));
$count_hod = mysqli_fetch_array($query2_hod);
 $nameclass22=$count_hod['dept_id'];
return $nameclass22;
}
function getfacultyc($get_fac)
{ $query2_hod = mysqli_query(Database::$conn,"select fac_name from faculty where fac_id = '$get_fac' ");
$count_hod = mysqli_fetch_array($query2_hod);
 $nameclass22=$count_hod['fac_name'];
return $nameclass22;
}

//function safee2($string){
//return safee($condb,$string);
//}
function safee($ncon,$string){ $ncon = Database::$conn; //$string = $this->mysqli->real_escape_string($string);
$string = mysqli_real_escape_string($ncon,$string); return $string ;
    }
function getdura($get_dura1)
{ 
$query2_fac = mysqli_query(Database::$conn,"select pro_dura from prog_tb where pro_id = '$get_dura1' ");
$count_fac = mysqli_fetch_array($query2_fac);
 $nameclass2=$count_fac['pro_dura'];
return $nameclass2;
}

/*function getamoe($statnum20)
{ if ($statnum20==01){ return "UTME";}else if($statnum20==02){ return "Pre_Science";}
   else if($statnum20==03){ return "Direct Entry";}else if($statnum20==04)
  { return "Undergraguate(Cep)";}} */
  
function getlevel($get_fac2,$pro)
{ 
$query2 = mysqli_query(Database::$conn,"select level_name from level_db where level_order = '$get_fac2' and prog = '$pro' ");
$count = mysqli_fetch_array($query2);
 $nameclass2=$count['level_name'];
return $nameclass2;
}

function getprog($get_RegNo){    
$query2 = mysqli_query(Database::$conn,"select Pro_name from prog_tb where pro_id = '$get_RegNo' ");
$count = mysqli_fetch_array($query2);
 $nameclass2=$count['Pro_name']; 
return $nameclass2;
}
function getftype($get_RegNo)
{ 
$query2 = mysqli_query(Database::$conn,"select f_type from ftype_db where id = '$get_RegNo' ");
$count = mysqli_fetch_array($query2);
 $nameclass2=$count['f_type'];
return $nameclass2;
}
function getftcat($get_RegNo)
{ 
$query2 = mysqli_query(Database::$conn,"select f_category from ftype_db where id = '$get_RegNo' ");
$count = mysqli_fetch_array($query2);
 $nameclass2=$count['f_category'];
return $nameclass2;}

function age_add($birthday){
list($day, $month, $year) = explode("/",$birthday);
$year_diff = date("Y") - $year;
$month_diff = date("m") - $month;
$day_diff = date("d") - $day;
if($day_diff < 0 && $month_diff ==0) $year_diff--;
if($day_diff < 0 && $month_diff < 0) $year_diff--;
return $year_diff;
}
//course_choice
//function getadminstatusc($statnum)
//{ if ($statnum==0){ return "Not Verified"; }else if($statnum==1){return "Admitted";
 // }else if($statnum==3){ return "Not Admitted";}else if($statnum==2){ return "Pending";}}
  
  function getappstatus($statnum)
{if ($statnum==0){return "Not Verified";}else if($statnum==1){return "Admitted";}
else if($statnum==3){return "Not Admitted";}else if($statnum==2){return "Pending";}}
  
  //get exam type
  function getexamtype($statnum)
{ if ($statnum==1){ return "WAEC"; }else if($statnum==2){return "NECO";
  }else if($statnum==3){ return "GCE O' LEVEL";}else if($statnum==4){ return "GCE A' LEVEL";}else if($statnum==5){ return "TC II";}
  else if($statnum==6){ return "RSA";}else if($statnum==7){ return "NABTEB";}else if($statnum==8){ return "SSCE";}
  else if($statnum==9){ return "ACE";}else if($statnum==10){ return "IGCSE";}else if($statnum==11){ return "WAEC Technical Examination";}}
  
    function fill_sub()
{     
$output = '';   $result = mysqli_query(Database::$conn,"SELECT * FROM subject ORDER BY subject ASC");
	while($row = mysqli_fetch_array($result)){
	$output .= '<option value="'.$row["sub_id"].'">'.$row["subject"].'</option>';	}
 return $output;
}
    function getf_sub($subid){ 
 $query2 = mysqli_query(Database::$conn,"select subject from subject where sub_id = '$subid' ")or die(mysqli_error($condb));
$count = mysqli_fetch_array($query2);$nameclass2=$count['subject'];return $nameclass2;
}
function fill_grade()
{     $output = '';   
$arr = array("Excellent (A1)" =>"1","Very Good (A2)" =>"2","Good (A3)" =>"3","Very Good (B2)" =>"4","Good (B3)"=>"5","Credit (C4)" =>"6","Credit (C5)" =>"7","Credit (C6)" =>"8","Pass (A)"=>"9","Pass (B)"=>"10","Pass (C)"=>"11","Pass (U)"=>"12","Pass (D7)"=>"13","Pass (P7)"=>"14","Pass (P8)"=>"15","Pass (E8)"=>"16","Fail (F9)"=>"17","A (a)"=>"18","B (b)" =>"19","C (c)" =>"20","D (d)" =>"21","E (e)" =>"22","F (f)" =>"23","G (g)" =>"24","Credit-1" =>"25","Credit-2" =>"26","Distinction" =>"27","Pass" =>"28","Awaiting Results" =>"29");
	foreach($arr as $val => $nvalue)
	{
		$output .= '<option value="'.$nvalue.'">'.$val.'</option>';
	}
 return $output;
}
function fill_Day()
{     $output = '';  
	$arr = array("Monday" =>"2","Tuesday" =>"3","Wednesday" =>"4","Thursday" =>"5","Friday" =>"6","Saturday" =>"7","Sunday" =>"1"); 
foreach($arr as $val => $nvalue)
	{$output .= '<option value="'.$nvalue.'">'.$val.'</option>';}
 return $output;}
 
   function getDay($statnum)
{ if ($statnum==2){ return "Monday"; }else if($statnum==3){return "Tuesday";
  }else if($statnum==4){ return "Wednesday";}else if($statnum==5){ return "Thursday";}else if($statnum==6){ return "Friday";}
  else if($statnum==7){ return "Saturday";}else if($statnum==1){ return "Sunday";}}
  
     function getStime($statnum){ if ($statnum=="8:00 AM"){ return "0"; }else if($statnum=="8:30 AM"){return "2";
  }else if($statnum=="9:00 AM"){ return "4";}else if($statnum=="9:30 AM"){ return "6";}else if($statnum=="10:00 AM"){ return "8";}
  else if($statnum=="10:30 AM"){ return "10";}else if($statnum=="11:00 AM"){ return "12";}else if($statnum=="11:30 AM"){ return "14";}
  else if($statnum=="12:00 PM"){ return "16";}else if($statnum=="12:30 PM"){ return "18";}else if($statnum=="1:00 PM"){ return "20";}else if($statnum=="1:30 PM"){ return "22";}else if($statnum=="2:00 PM"){ return "24";}else if($statnum=="2:30 PM"){ return "26";}else if($statnum=="3:00 PM"){ return "28";}else if($statnum=="3:30 PM"){ return "30";}else if($statnum=="4:00 PM"){ return "32";}else if($statnum=="4:30 PM"){ return "34";}else if($statnum=="5:00 PM"){ return "36";}else if($statnum=="5:30 PM"){ return "38";}else if($statnum=="6:00 PM"){ return "40";}else if($statnum=="6:30 PM"){ return "42";}else if($statnum=="7:00 PM"){ return "44";}else if($statnum=="7:30 PM"){ return "46";}else if($statnum=="8:00 PM"){ return "48";}
  }
  
    function setStime($statnum){ if ($statnum=="0"){ return "8:00 AM"; }else if($statnum=="2"){return "8:30 AM";
  }else if($statnum=="4"){ return "9:00 AM";}else if($statnum=="6"){ return "9:30 AM";}else if($statnum=="8"){ return "10:00 AM";}
  else if($statnum=="10"){ return "10:30 AM";}else if($statnum=="12"){ return "11:00 AM";}else if($statnum=="14"){ return "11:30 AM";}
  else if($statnum=="16"){ return "12:00 PM";}else if($statnum=="18"){ return "12:30 PM";}else if($statnum=="20"){ return "1:00 PM";}else if($statnum=="22"){ return "1:30 PM";}else if($statnum=="24"){ return "2:00 PM";}else if($statnum=="26"){ return "2:30 PM";}else if($statnum=="28"){ return "3:00 PM";}else if($statnum=="30"){ return "3:30 PM";}else if($statnum=="32"){ return "4:00 PM";}else if($statnum=="34"){ return "4:30 PM";}else if($statnum=="36"){ return "5:00 PM";}else if($statnum=="38"){ return "5:30 PM";}else if($statnum=="40"){ return "6:00 PM";}else if($statnum=="42"){ return "6:30 PM";}else if($statnum=="44"){ return "7:00 PM";}else if($statnum=="46"){ return "7:30 PM";}else if($statnum=="48"){ return "8:00 PM";}
  }
 
 function getfgrade($gradeid)
{if ($gradeid==1){ return "Excellent (A1)";}else if($gradeid==2){ return "Very Good (A2)";}else if($gradeid==3){ return "Good (A3)";}else if($gradeid==4){ return "Very Good (B2)";}else if($gradeid==5){ return "Good (B3)";}else if($gradeid==6){ return "Credit (C4)";}else if($gradeid==7){ return "Credit (C5)";}else if($gradeid==8){ return "Credit (C6)";}else if($gradeid==9){ return "Pass (A)";}else if($gradeid==10){ return "Pass (B)";}else if($gradeid==11){ return "Pass (C)";}else if($gradeid==12){ return "Pass (U)";}else if($gradeid==13){ return "Pass (D7)";}else if($gradeid==14){ return "Pass (P7)";}else if($gradeid==15){ return "Pass (P8)";}else if($gradeid==16){ return "Pass (E8)";}else if($gradeid==17){ return "Fail (F9)";}else if($gradeid==18){ return "A (a)";}else if($gradeid==19){ return "B (b)";}else if($gradeid==20){ return "C (c)";}else if($gradeid==21){ return "D (d)";}else if($gradeid==22){ return "E (e)";}else if($gradeid==23){ return "F (f)";}else if($gradeid==24){ return "G (g)";}else if($gradeid==25){ return "Credit-1";}else if($gradeid==26){ return "Credit-2";}else if($gradeid==27){ return "Distinction";}else if($gradeid==28){ return "Pass";}else if($gradeid==29){ return "Awaiting Results";}
}
function grading($marks,$class_name20){ 
$grade = mysqli_query(Database::$conn,"SELECT grade,grade_group,prog FROM grade_tb WHERE b_min <= round($marks) and b_max >= round($marks) and prog='".safee($condb,$class_name20)."' and grade_group ='01'");
$gd =mysqli_fetch_row($grade);
return $gd[0];
}
function gradpoint($marks,$class_name20){ 
$grade = mysqli_query(Database::$conn,"SELECT gp,grade_group,prog FROM grade_tb WHERE b_min <= round($marks) and b_max >= round($marks) and prog='".($class_name20)."' and grade_group ='01'");
$gd =mysqli_fetch_row($grade);
return $gd[0];
}
function Resultremark($marks,$class_name20){ 
$grade = mysqli_query(Database::$conn,"SELECT gradename,grade_group,prog FROM grade_tb WHERE gpmin <= round($marks,2) and gpmax >= round($marks,2) and prog='".($class_name20)."' and grade_group ='01'");
$gd =mysqli_fetch_row($grade);
return $gd[0];
}
//admin status
function entranceStatus($marks,$class_name20){ 
$grade = mysqli_query(Database::$conn,"SELECT gp,grade_group,prog FROM grade_tb WHERE b_min <= round($marks) and b_max >= round($marks) and prog='".($class_name20)."' and grade_group ='02'");
$gd =mysqli_fetch_row($grade);
return $gd[0];
}
    function getstudentpro($subid)
{ 
$query2 = mysqli_query(Database::$conn,"select app_type from student_tb where RegNo = '$subid' ")or die(mysqli_error($condb));
$count = mysqli_fetch_array($query2);$nameclass2=$count['app_type'];return $nameclass2;
}
function getcandpro($subid)
{ $query2 = mysqli_query(Database::$conn,"select app_type from new_apply1 where appNo = '$subid' ")or die(mysqli_error($condb));
$count = mysqli_fetch_array($query2);$nameclass2=$count['app_type'];return $nameclass2;}
//regno to id
function getregid($subid)
{ $query2 = mysqli_query(Database::$conn,"select regno from candidate_tb where candid = '$subid' ")or die(mysqli_error($condb));
$count = mysqli_fetch_array($query2);$nameclass2= trim($count['regno']);return $nameclass2;
}
function getidreg($subid)
{ $query2 = mysqli_query(Database::$conn,"select candid from candidate_tb where regno = '$subid' ")or die(mysqli_error($condb));
$count = mysqli_fetch_array($query2);$nameclass2= trim($count['candid']);return $nameclass2;
}
function getcourse($get_RegNo)
{  
$query2_fac = mysqli_query(Database::$conn,"select C_title from courses where C_code = '$get_RegNo' ")or die(mysqli_error($condb));
$count_fac = mysqli_fetch_array($query2_fac);
 $nameclass2=$count_fac['C_title'];
return $nameclass2;
}
function getcourseid($get_RegNo)
{ $query2_fac = mysqli_query(Database::$conn,"select C_title from courses where C_id = '$get_RegNo' ")or die(mysqli_error($condb));
$count_fac = mysqli_fetch_array($query2_fac);
 $nameclass2=$count_fac['C_title'];
return $nameclass2;
}
function getccode2($get_RegNo)
{ $query2_fac = mysqli_query(Database::$conn,"select C_code from courses where C_id = '$get_RegNo' ")or die(mysqli_error($condb));
$count_fac = mysqli_fetch_array($query2_fac);
 $nameclass2=$count_fac['C_code'];
return $nameclass2;
}
function getys($statnum)
{if ($statnum==1){return substr($statnum,0,1)."Year";}else if($statnum > 1){return substr($statnum,0,1)."Years";}}

function getfra($value) 
{
$fraction = ltrim(($value - floor($value)),"0.");
//$fraction   = $value - floor ($value); if ($value < 0){$fraction *= -1;}
if($fraction == 0){ }elseif($fraction ==1){return " and ".$fraction." Month";}elseif($fraction >1){ return " and ".$fraction." Months"; }

}
function getfrationapp($value) 
{$fraction = ltrim(($value - floor($value)),"0.");
//$fraction   = $value - floor ($value); if ($value < 0){$fraction *= -1;}
return $fraction ;
}
function getsemail($get_RegNo)
{ 
$query2_fac = mysqli_query(Database::$conn,"select e_address from student_tb where RegNo = '".safee($condb,$get_RegNo)."' ")or die(mysqli_error($condb));
$count_fac = mysqli_fetch_array($query2_fac);
 $nameclass2=$count_fac['e_address'];
return $nameclass2;
}

function getemail($get_email)
{
$query2= mysqli_query(Database::$conn,"select email from admin where admin_id = '$get_email' ")or die(mysqli_error($condb));
$count = mysqli_fetch_array($query2);
 $nameclass2=$count['email'];
return $nameclass2;
}

function getsname($get_RegNo){  $query2_fac = mysqli_query(Database::$conn,"select FirstName,SecondName,Othername from student_tb where RegNo = '".safee($condb,$get_RegNo)."' ")or die(mysqli_error($condb));
$count_fac = mysqli_fetch_array($query2_fac);
 $nameclass2=$count_fac['FirstName']." ".$count_fac['SecondName']." ".$count_fac['Othername'];
return $nameclass2;
}

function gethostel($get_RegNo)
{  
$query2_fac = mysqli_query(Database::$conn,"select h_name from hostedb where h_code = '".safee($condb,$get_RegNo)."' ")or die(mysqli_error($condb));
$count_fac = mysqli_fetch_array($query2_fac);
 $nameclass2=$count_fac['h_name'];
return $nameclass2;
}
function getnob($get_RegNo)
{ 
$query2_fac = mysqli_query(Database::$conn,"select no_of_bed from roomdb where room_id = '".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
$count_fac = mysqli_fetch_array($query2_fac);
 $nameclass2=$count_fac['no_of_bed'];
return $nameclass2;
}

function getroomno($get_RegNo)
{ 
$query2_fac = mysqli_query(Database::$conn,"select room_no from roomdb where room_id = '".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
$count_fac = mysqli_fetch_array($query2_fac);
 $nameclass2=$count_fac['room_no'];
return $nameclass2;
}

function getroomftype($get_RegNo)
{ 
$query2_fac =  mysqli_query(Database::$conn,"select feetype from roomdb where room_id = '".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
$count_fac = mysqli_fetch_array($query2_fac);
 $nameclass2=$count_fac['feetype'];
return $nameclass2;
}

       function getstaff($get_fac2)
{ 
$query2 = mysqli_query(Database::$conn,"select lastname,firstname from admin where admin_id = '".safee($condb,$get_fac2)."' ")or die(mysqli_error($condb));
$count = mysqli_fetch_array($query2);
 $nameclass2=$count['lastname']." ".$count['firstname'];
return $nameclass2;
}
//$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");

//foreach($age as $x => $x_value) {
    //echo "Key=" . $x . ", Value=" . $x_value;
    //echo "<br>";
//}

function add_months($months, DateTime $dateObject) 
    { $next = new DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +'.$months.' month');
if($dateObject->format('d') > $next->format('d')) {
            return $dateObject->diff($next); } else {
            return new DateInterval('P'.$months.'M');}}

function endCycle($d1, $months){ $date = new DateTime($d1);
// call second function to add the months
$newDate = $date->add(add_months($months, $date));
// goes back 1 day from date, remove if you want same day of month
$newDate->sub(new DateInterval('P1D')); 
//formats final date to Y-m-d form
$dateReturned = $newDate->format('Y-m-d'); 
return $dateReturned;
    }
function diffMonthh($date2) {
$date1 = date('Y-m-d');
$d1 = date_create($date1);
$d2= date_create($date2);
$interval= date_diff($d1, $d2);
$nmonth = $interval->format('%m');
 $start_ts = strtotime($date1);
$end_ts = strtotime($date2);
$diff = $end_ts - $start_ts;
$nday = round($diff / 86400);
  if($nmonth < 1 ){ return "Your Payment will Expire by Next ".$nday." Day (s)."; }else{ return "Your Payment will Expire by Next ".$nmonth." Month (s)." ;}
}

function dayCount($end) {
$start = date('Y-m-d');
$start_ts = strtotime($start);
$end_ts = strtotime($end);
$diff = $end_ts - $start_ts;
return round($diff / 86400);
}
function is_positive_integer($str) {
  return (is_numeric($str) && $str > 0 && $str == round($str));
}

function imgExists($url) {
        if (@file_get_contents($url, 0, NULL, 0, 1)) {
            return 1;} return 0;           
    }
     function getfacid($get_dept)
{ 
$query2_hod = mysqli_query(Database::$conn,"select fac_did from dept where dept_id = '$get_dept' ")or die(mysqli_error($condb));
$count_hod = mysqli_fetch_array($query2_hod);
 $nameclass22=$count_hod['fac_did'];
return $nameclass22;
}
//function for getting member status
function gethod($get_RegNo)
{$query2_hod = mysqli_query(Database::$conn,"select sname,mname,oname from staff_details where staff_id = '$get_RegNo' ")or die(mysqli_error($condb));
$count_hod = mysqli_fetch_array($query2_hod);
 $nameclass22=$count_hod['sname']." ".$count_hod['mname']." ".$count_hod['oname'];
return $nameclass22;
}
//function for getting member status
function getdean($get_RegNo)
{
$query2_hod = mysqli_query(Database::$conn,"select sname,mname,oname from staff_details where staff_id = '$get_RegNo' ")or die(mysqli_error($condb));
$count_hod = mysqli_fetch_array($query2_hod);
 $nameclass22=$count_hod['sname']." ".$count_hod['mname']." ".$count_hod['oname'];
return $nameclass22;
}

       function getstatus($get_fac2)
{//if ($statnum==0){   return "No Access";}
  //else if($statnum==1){
    // return "Super Admin";}else if($statnum==2){return "Administrator";}else if($statnum==3)
  //{return "Registrar";}else if($statnum==4){return "Academic Staff";}else if($statnum==5)
  //{return "Non Academic Staff";}else if($statnum==6){return "Bursary"; }
$query2 = mysqli_query(Database::$conn,"select role_rolename from role where role_rolecode = '$get_fac2' ")or die(mysqli_error($condb));
$count = mysqli_fetch_array($query2);
 $nameclass2=$count['role_rolename'];
return $nameclass2;
  }
  
    
       function getlect($get_fac2)
{
$query2 = mysqli_query(Database::$conn,"select sname,mname,oname from staff_details where staff_id = '$get_fac2' ")or die(mysqli_error($condb));
$count = mysqli_fetch_array($query2);
 $nameclass2=$count['sname']." ".$count['mname']." ".$count['oname'];
return $nameclass2;
}

  function getyear($statnum20)
{if ($statnum20==1){ return "One Year";}else if($statnum20==2){
     return "Two Years"; }else if($statnum20==3){return "Three Years";}else if($statnum20==4)
  {return "Four Years";}else if($statnum20==5){return "Five Years";} else if($statnum20==6)
  {return "Six Years";}}
  
 /* function getmplevel($statnum20)
{if ($statnum20==100){ return "Year One";}else if($statnum20==200){
     return "Year Two"; }else if($statnum20==300){return "Year Three";}else if($statnum20==400)
  {return "Year Four";}else if($statnum20==500){return "Year Five";} else if($statnum20==600)
  {return "Year Six";}}*/
function getmplevel($statnum20)
{if ($statnum20==100){ return "ND I";}else if($statnum20==200){
     return "ND II"; }else if($statnum20==300){return "HND I";}else if($statnum20==400)
  {return "HND II";}}
  
  function getadminstatus($statnum)
{if ($statnum=='FALSE'){return "Not Verified";}else if($statnum=='TRUE'){ return "Verified";}}


//record by username
	        function getstaff2($get_staff)
{
$query2_hod = mysqli_query(Database::$conn,"select sname,mname from staff_details where usern_id = '$get_staff' ");
$count = mysqli_fetch_array($query2_hod,MYSQLI_ASSOC);
 $nameclass2=$count['sname']." ".$count['mname'];
return $nameclass2;
}

						        function getstudent2($get_student)
{
$query2 = mysqli_query(Database::$conn,"select FirstName,SecondName from student_tb where RegNo = '$get_student' ");
$count = mysqli_fetch_array($query2);
 $nameclass2=$count['FirstName']." ".$count['SecondName'];
return $nameclass2;
}
					  
        function getadmin2($get_admin)
{//
$query2 = mysqli_query(Database::$conn,"select firstname,lastname from admin where admin_id = '$get_admin' ");
$count = mysqli_fetch_array($query2);
 $nameclass2=$count['firstname']." ".$count['lastname'];
return $nameclass2;
}
//staff userid						  
function getsusern($get_admin)
{$query2 = mysqli_query(Database::$conn,"select staff_id from staff_details where usern_id = '$get_admin' "); $count = mysqli_fetch_array($query2);
 $nameclass2=$count['staff_id'];return $nameclass2;}
function getstatus2($statnum)
{if ($statnum==0){return "No Access";}else if($statnum==1){return "Super Admin";}else if($statnum==2){
    return "Administrator";}else if($statnum==3){return "Registrar";}else if($statnum==4){return "Academic Staff";}
  else if($statnum==5){ return "Non Academic Staff";}else if($statnum==6){ return "Bursary";}}
  
function getamoe($get_student)
{$query2 = mysqli_query(Database::$conn,"select entrymode from mode_tb where id = '$get_student' ");
$count = mysqli_fetch_array($query2);
 $nameclass2=$count['entrymode'];
return $nameclass2;
}
   function getelevel($get_student)
{$query2 = mysqli_query(Database::$conn,"select entrylevel from mode_tb where id = '$get_student' ");
$count = mysqli_fetch_array($query2);
 $nameclass2=$count['entrylevel'];
return $nameclass2;
}
  function getcertinview($get_student)
{$query2 = mysqli_query(Database::$conn,"select certinview from prog_tb where pro_id = '$get_student' ");
$count = mysqli_fetch_array($query2);
 $nameclass2=$count['certinview'];
return $nameclass2;
}
function getelectpost($get_fac)
{ $query2_hod = mysqli_query(Database::$conn,"select position from post_tb where postid = '$get_fac' ");
$count_hod = mysqli_fetch_array($query2_hod);
 $nameclass22=$count_hod['position'];
return $nameclass22;
}
function getmingp($get_fac)
{ $query2_hod = mysqli_query(Database::$conn,"select minGP from post_tb where postid = '$get_fac' ");
$count_hod = mysqli_fetch_array($query2_hod);
 $nameclass22=$count_hod['minGP'];
return $nameclass22;
}
function getecate($get_fac)
{ $query2_hod = mysqli_query(Database::$conn,"select title from electiontb where id = '$get_fac' ");
$count_hod = mysqli_fetch_array($query2_hod);
 $nameclass22=$count_hod['title'];
return $nameclass22;
}
function getecated($get_fac)
{ $query2_hod = mysqli_query(Database::$conn,"select ecate from electiontb where id = '$get_fac' ");
$count_hod = mysqli_fetch_array($query2_hod);
 $nameclass22=$count_hod['ecate'];
return $nameclass22;
}
function getefd($get_fac)
{ $query2_hod = mysqli_query(Database::$conn,"select fac,dept,ecate from electiontb where id = '$get_fac' ");
$count_hod = mysqli_fetch_array($query2_hod);
 $nameclass22=$count_hod['ecate'];
 if($nameclass22 == 2){ return $count_hod['fac']; }elseif($nameclass22 == 1){return $count_hod['dept'];}
}

//get assement default score
function getamax($get_fac)
{ $query2_hod = mysqli_query(Database::$conn,"select assmax from prog_tb where pro_id = '$get_fac' ");
$count_hod = mysqli_fetch_array($query2_hod); $nameclass22=$count_hod['assmax']; return $nameclass22;}
//get assement default score
function getemax($get_fac)
{ $query2_hod = mysqli_query(Database::$conn,"select exammax from prog_tb where pro_id = '$get_fac' ");
$count_hod = mysqli_fetch_array($query2_hod); $nameclass22=$count_hod['exammax']; return $nameclass22; }

//get last string
function getlstr($string,$length)
{ return substr($string, strlen($string) - $length, $length);
}
// function to generate mat no
function getmatno($sec,$dep,$prog){ 
    $matno = ""; $yearadd = substr($sec,0,4); $yst = substr($sec,2,2); $yend = substr($sec,7,2);
$yearadds = $yst."".$yend;
    $tran=mysqli_query(Database::$conn,"select max(reg_count) from student_tb WHERE Asession = '".safee($condb,$sec)."' and Department ='".safee($condb,$dep)."' ");
while($tid = mysqli_fetch_array($tran, MYSQLI_BOTH))
{if($tid[0] == null){$tmax="10001";}else{$tmax=$tid[0]+1;}}
$maxadd = substr($tmax,1,4);
$fd = mysqli_fetch_array(mysqli_query(Database::$conn," SELECT * FROM dept where dept_id='".safee($condb,$dep)."'"));
if(empty($fd['d_code'])){ $dID =$fd['dept_id'] ; }else{ $dID =$fd['d_code'] ; }
//$matno =($yearadd)."/".$dID."/".$maxadd;
$matno ="DSPT/".($dID)."/".$yearadds."/".$maxadd;
//dep/level/year/no
//dspt/otm/1718/no
return $matno;
}
// function to student payment status for the section
function getpayn($mat,$sec,$prog,$lev,$sh){ $conn = 0; //$sh = 0;
    $getstd = $viewutme_query = mysqli_query(Database::$conn,"select * from student_tb WHERE stud_id = '".safee($conn,$mat)."' ")or die(mysqli_error($conn));
$fetstd = mysqli_fetch_array($getstd); $matno = $fetstd['RegNo']; $appno = $fetstd['appNo']; $state = $fetstd['state']; 
    if($state == "Delta"){ $scan = "1";}else{ $scan = "0";}
    $qcompamtd = mysqli_query(Database::$conn,"select * from fee_db where ft_cat ='1' and level= '".safee($conn,$lev)."' and program='".safee($conn,$prog)."' and status = '1' and Cat_fee = '".safee($conn,$scan)."' ") or die(mysqli_error($conn)); $sumcreditm=0;
while($row_camt = mysqli_fetch_array($qcompamtd)){ 
$paysidm = $row_camt['fee_id']; $dpercm = $row_camt['pper']; 
$psdatem = $row_camt['psdate'];  $famountm =$row_camt['f_amount'];
$date20m = str_replace('/', '-', $psdatem );  $newDate20m = date("Y-m-d", strtotime($date20m));  $date_nowm =  date("Y-m-d");
$penaltysumm = FeesCalc($famountm,$dpercm,$newDate20m); $difpm = $penaltysumm - $famountm ;
if($dpercm > 0 and $date_nowm >= $newDate20m){  $namountm = $penaltysumm; }else{  $namountm = $famountm; }
$sumcreditm += $namountm;  }
$nocompm = mysqli_num_rows($qcompamtd); if($sumcreditm > 0){   $com_payamt = $sumcreditm; }else{ $com_payamt = 0; } 
if(empty($matno)){
$querycompamount = mysqli_query(Database::$conn,"select * from feecomp_tb where fcat ='1' and level= '".safee($conn,$lev)."' and prog='".safee($conn,$prog)."' and pstatus = '1' and session = '".safee($conn,$sec)."' and regno = '".safee($conn,$appno)."' ") or die(mysqli_error($conn));}else{
$querycompamount = mysqli_query(Database::$conn,"select * from feecomp_tb where fcat ='1' and level= '".safee($conn,$lev)."' and prog='".safee($conn,$prog)."' and pstatus = '1' and session = '".safee($conn,$sec)."' and regno = '".safee($conn,$matno)."'") or die(mysqli_error($conn));} $sumcredito=0;
$nocomp = mysqli_num_rows($querycompamount); while($row_camount = mysqli_fetch_array($querycompamount)){ $famountc =$row_camount['f_amount'];
$sumcredito += $famountc;   }
if($sumcredito > 0){   $com_amount = $sumcredito; }else{ $com_amount = 0; }
if(empty($matno)){ $que_checkpay=mysqli_query(Database::$conn,"select SUM(paid_amount) as samount from payment_tb where app_no = '".safee($conn,$appno)."' and session ='".safee($conn,$sec)."' and pay_status='1' and ft_cat='1' and level = '".safee($conn,$lev)."' ");}else{
$que_checkpay=mysqli_query(Database::$conn,"select SUM(paid_amount) as samount from payment_tb where stud_reg ='".safee($conn,$matno)."' and session ='".safee($conn,$sec)."' and pay_status='1' and ft_cat='1' and level = '".safee($conn,$lev)."'  ");}
	$warning_count2=mysqli_num_rows($que_checkpay);	      $warning_data=mysqli_fetch_array($que_checkpay);   $sumpay = $warning_data['samount'];
 
 if($sumpay >= $com_amount and $sumpay > 0 and $nocomp >= $nocompm ){ $pstatus = "
 Payment Status : Paid &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
 Amount: ".number_format($sumpay,2); $pstatus2 = 1;}else{$pstatus = "
 Payment Status : Not Paid &nbsp;&nbsp;&nbsp;&nbsp;&nbsp";$pstatus2 = 0; }
if($sh > 0){ return $pstatus2; }else{ return $pstatus;}
}

function send_email($data) {
	$email = $data['to'];
	$sub = $data['sub'];
	$msg = $data['msg'];
	$sendername = $data['srname'];
	$message = get_email_msg($data);
 //require_once "./phpmailer/class.phpmailer.php";
require_once "./../phpmailer/class.phpmailer.php";
$mail = new PHPMailer(true);
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->isHTML(true);
        $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host = "mail.smartdelta.com.ng";      // sets GMAIL as the SMTP server
        $mail->Port = 465;                   // set the SMTP port for the GMAIL server
        $mail->Username = 'notification@smartdelta.com.ng';
         $mail->Password = 'xculp82017';

       // $mail->SetFrom('youremail@gmail.com', 'Your Name');
       $mail->SetFrom('notification@smartdelta.com.ng', $sendername);
       $mail->AddReplyTo("notification@smartdelta.com.ng",$sendername);
      $mail->addBCC("mailcopy@smartdelta.com.ng");
     $mail->AddAddress($email);
       $mail->Subject = $sub ;//trim("Email Verifcation - www.thesoftwareguy.in");
        $mail->MsgHTML($message);

        try {
          if(!$mail->send()) { return 'fail';} else {return 'success'; }
          //$msgType = "success";
        } catch (Exception $ex) {
          $msg = $ex->getMessage();
          //$msgType = "warning";
        }
}

function send_email2($data) {
	$email = $data['to'];
	$sub = $data['sub'];
	$msg = $data['msg'];
	$sendername = $data['srname'];
	$message = get_email_msg($data);
 require_once "./phpmailer/class.phpmailer.php";

$mail = new PHPMailer(true);
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->isHTML(true);
        $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host = "mail.smartdelta.com.ng";      // sets GMAIL as the SMTP server
        $mail->Port = 465;                   // set the SMTP port for the GMAIL server
        $mail->Username = 'notification@smartdelta.com.ng';
         $mail->Password = 'xculp82017';

       // $mail->SetFrom('youremail@gmail.com', 'Your Name');
       $mail->SetFrom('notification@smartdelta.com.ng', $sendername);
       $mail->AddReplyTo("notification@smartdelta.com.ng",$sendername);
       $mail->addBCC("mailcopy@smartdelta.com.ng");
        $mail->AddAddress($email);
       $mail->Subject = $sub ;//trim("Email Verifcation - www.thesoftwareguy.in");
        $mail->MsgHTML($message);

        try {
            if(!$mail->send()) { return 'fail';} else {return 'success'; }
          //$mail->send();
          //$msg = "An email has been sent for verfication.";
          //$msgType = "success";
        } catch (Exception $ex) {
          $msg = $ex->getMessage();
          //$msgType = "warning";
        }
}


function get_email_msg($data) {
	$msg_text = "";
	
	switch($data['msg']) {
		
		case 'pinorder':
			$msg_text = $data['body'];
		break;
		
		case 'Notify':
			$msg_text = $data['body'];
		break;
		
	}//switch
	return $msg_text;
}

function generateRandompass($length = 10) {
 // This function has taken from stackoverflow.com
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 $charactersLength = strlen($characters);
 $randomString = '';
 for ($i = 0; $i < $length; $i++)
 {$randomString .= $characters[rand(0, $charactersLength - 1)];
 }return ($randomString);
 }
 function createRandomPassword1() {
$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
srand((double)microtime()*1000000);$i = 0;$pass = '' ;while ($i <= 7) {
$num = rand() % 33;$tmp = substr($chars, $num, 1);$pass = $pass . $tmp;$i++;}
return $pass;}

function differenceInHours($startdate,$enddate){
	$starttimestamp = strtotime($startdate);
	$endtimestamp = strtotime($enddate);
	$difference = abs($endtimestamp - $starttimestamp)/3600;
	return $difference;
}
function slugify($string){
$preps = array('in', 'at', 'on', 'by', 'into', 'off', 'onto', 'from', 'to', 'with', 'a', 'an', 'the', 'using', 'for');
	$pattern = '/\b(?:' . join('|', $preps) . ')\b/i';
	$string = preg_replace($pattern, '', $string);
$string = preg_replace('~[^\\pL\d]+~u', '-', $string);
$string = trim($string, '-');
$string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
$string = strtolower($string);
$string = preg_replace('~[^-\w]+~', '', $string);
return $string;

}
  function getrorder($subid)
{$query2 = mysqli_query(Database::$conn,"select roleorder from role where role_rolecode = '$subid' ")or die(mysqli_error($condb));
$count = mysqli_fetch_array($query2);$nameclass2=$count['roleorder'];return $nameclass2;}
function FeesCalc($Fees,$per,$sdate){
    $date2 = str_replace('/', '-', $sdate ); $newDate2 = date("Y-m-d", strtotime($date2));
        $date_now =  date("Y-m-d");
        if($date_now >= $newDate2){ $late = ($per / 100) * $Fees;
            return $TotalFees = $late+$Fees;}else{ return $TotalFees = $Fees; }}
 function getfeecat($statnum)
{if ($statnum==0){return "Others";}else if($statnum==1){return "Service Charge";}
else if($statnum==3){return "Form";}else if($statnum==2){return "Dues";}}
function getappname($subid){$query2 = mysqli_query(Database::$conn,"select FirstName,SecondName,Othername from new_apply1 where appNo = '$subid' ")or die(mysqli_error($condb));
$count = mysqli_fetch_array($query2);$nameclass2=$count['FirstName']." ".$count['SecondName']." ".$count['Othername'];return $nameclass2;}

function getrno($get_admin)
{$query2 = mysqli_query(Database::$conn,"select sregno from coursereg_tb where creg_id = '".safee($condb,$get_admin)."' ");
$count = mysqli_fetch_array($query2); $nameclass2=$count['sregno']; return $nameclass2;}

function fill_Mgrade()
{     $output = '';   
$arr = array("A" =>"A","AB" =>"AB","B" =>"B","BC" =>"BC","C"=>"C","CD" =>"CD","D" =>"D","E" =>"E","F"=>"F");
foreach($arr as $val => $nvalue){$output .= '<option value="'.$nvalue.'">'.$val.'</option>';}return $output;}
$del_ucomfirmed = mysqli_query($condb,"DELETE FROM fshop_tb WHERE fpay_status = '0' and fpamount < 1 and  dategen <  DATE_SUB(CURDATE(), INTERVAL 3 DAY)");
$del_ucomfirmed2 = mysqli_query($condb,"DELETE FROM payment_tb WHERE pay_status = '0' and paid_amount < 0 and  pay_date < DATE_SUB(CURDATE(), INTERVAL 2 DAY)");
$del_ucomfirmed3 = mysqli_query($condb,"UPDATE hostelallot_tb SET validity = '0' , paystatus = '0', rchange = '0' WHERE allotstatus = '1' and  allotexpire < CURDATE()");
function gnum($nob){
    if(empty($nob)){return "0";}else{ return $nob; }}
//staff userid						  
function getsdept($get_admin)
{$query2 = mysqli_query(Database::$conn,"select s_dept from staff_details where usern_id = '$get_admin' "); $count = mysqli_fetch_array($query2);
 $nameclass2=$count['s_dept'];return $nameclass2;}
// // time zone manager
/*if(!isset($_SESSION['timezone']))
{if(!isset($_REQUEST['offset']))
    {?>
        <script>
        var d = new Date()
        var offset= -d.getTimezoneOffset()/60;
        location.href = "<?php echo $_SERVER['PHP_SELF']; ?>?offset="+offset;
        </script>
        <?php   
    }else
    {$zonelist = array('Kwajalein' => -12.00, 'Pacific/Midway' => -11.00, 'Pacific/Honolulu' => -10.00, 'America/Anchorage' => -9.00, 'America/Los_Angeles' => -8.00, 'America/Denver' => -7.00, 'America/Tegucigalpa' => -6.00, 'America/New_York' => -5.00, 'America/Caracas' => -4.30, 'America/Halifax' => -4.00, 'America/St_Johns' => -3.30, 'America/Argentina/Buenos_Aires' => -3.00, 'America/Sao_Paulo' => -3.00, 'Atlantic/South_Georgia' => -2.00, 'Atlantic/Azores' => -1.00, 'Europe/Dublin' => 0, 'Europe/Belgrade' => 1.00, 'Europe/Minsk' => 2.00, 'Asia/Kuwait' => 3.00, 'Asia/Tehran' => 3.30, 'Asia/Muscat' => 4.00, 'Asia/Yekaterinburg' => 5.00, 'Asia/Kolkata' => 5.30, 'Asia/Katmandu' => 5.45, 'Asia/Dhaka' => 6.00, 'Asia/Rangoon' => 6.30, 'Asia/Krasnoyarsk' => 7.00, 'Asia/Brunei' => 8.00, 'Asia/Seoul' => 9.00, 'Australia/Darwin' => 9.30, 'Australia/Canberra' => 10.00, 'Asia/Magadan' => 11.00, 'Pacific/Fiji' => 12.00, 'Pacific/Tongatapu' => 13.00);
        $index = array_keys($zonelist, $_REQUEST['offset']);
        $_SESSION['timezone'] = $index[0];
    }
}
date_default_timezone_set($_SESSION['timezone']);*/
?>
