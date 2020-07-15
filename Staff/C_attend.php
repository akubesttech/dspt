<?php
//session_start();
include('../admin/lib/dbcon.php'); 
dbcon(); 
 include('session.php'); 
if (isset($_POST['add_attend'])){
$id=$_POST['selector'];
//$present = $_POST['selector'];
        $date = date('Y-m-d');
        $month1 = date('M');
        //$length = count($present);
        //$COUR_ASSIGN = $_GET['userId'];
       $checkSunday = strtotime($date);
$N = count($id);
mysqli_query($condb,"DELETE FROM attendance WHERE AttDate = '" . $date . "' and staff_id2 = '" . $session_id . "'")or die(mysqli_error($condb));

for($i=0; $i < $N; $i++)
{
$sql="select * from coursereg_tb where  sregno ='".$id[$i]."' and session ='$default_session'  and semester='$default_semester' ";
			$result=mysqli_query($condb,$sql) or die(mysqli_error($condb));
			$count=mysqli_num_rows($result);
		$row=mysqli_fetch_array($result);
	extract($row);
$sql2="select * from attendance where EmpID ='".$id[$i]."' and session ='$default_session'  and term='$default_semester' and AttDate = '".$date."'";
				$result2=mysqli_query($condb,$sql2) or die(mysqli_error($condb));
				if(mysqli_num_rows($result2)>0)
				{
				//continue;
	mysqli_query($condb,"update attendance  set Prensent='1' where EmpID='".$id[$i]."' and course_id ='".$c_code."' and AttDate ='".$date."' and level ='".$level."' ")or die(mysqli_error($condb));
				}
				else
				{
				$query="insert into attendance(EmpID,Prensent,AttDate,staff_id2,term,month,session,course_id,level)values('".$id[$i]."','1','".$date."','".$session_id."','".$default_semester."','".$month1."','".$default_session."','".$c_code."','".$level."')";
					$result20=mysqli_query($condb,$query) or die(mysqli_error($condb));
				}
					
	if(number_of_days(0, $checkSunday, $checkSunday)){
	mysqli_query($condb,"DELETE FROM attendance WHERE AttDate = '" . $date . "' and staff_id2 = '" . $session_id . "'")or die(mysqli_error($condb));
		message("Note: Today is Sunday  No Attendance was Recorded! ","error");
		
        }elseif(number_of_days(6, $checkSunday, $checkSunday)){
        mysqli_query($condb,"DELETE FROM attendance WHERE AttDate = '" . $date . "' and staff_id2 = '" . $session_id . "'")or die(mysqli_error($condb));
               message("Note: Today is Saturday No Attendance was Recorded!","error");
        }else{message("Class Attendance Successfully Taken!","success");}	

					}

	//if($id[$i] == Null){
	//mysqli_query($condb,"DELETE FROM attendance WHERE AttDate = '" . $date . "'")or die(mysqli_error($condb));
		//	}
    if($c_code == Null){
redirect('Course_m.php');
}else{  //message("Class Attendance Successfully Taken!","success");
redirect('Course_m.php?view=clist&userId='.$c_code.'');}

}

  function number_of_days($day, $start, $end)
    {
        $one_week = 604800;
        $w = array(date('w', $start), date('w', $end));
        return floor( ( $end - $start ) / $one_week ) + ( $w[0] > $w[1] ? $w[0] <= $day || $day <= $w[1] : $w[0] <= $day && $day <= $w[1] );
        
        //echo number_of_days(0, $start, $end); // SUNDAY
        //echo number_of_days(1, $start, $end); // MONDAY
        //echo number_of_days(2, $start, $end); // TUESDAY
        //echo number_of_days(3, $start, $end); // WEDNESDAY
        //echo number_of_days(4, $start, $end); // THURSDAY
        //echo number_of_days(5, $start, $end); // FRIDAY
        //echo number_of_days(6, $start, $end); // SATURDAY
        
    }
    //$hash =strtolower(hash("sha512",$hashseq));
   // $ip = $_SERVER["REMOTE_ADDR"];
?>