<?php

session_start();
session_regenerate_id();
        include('admin/lib/dbcon.php');
		dbcon(); 
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
			
       //echo $new_session_id = session_id();
		$username = $_POST['username'];
//$password = $_POST['password'];
$passwordn = $_POST['password'];
   $password = substr(md5($passwordn.SUDO_M),14);
 
		$name='true_admin';

		/*................................................ admin .....................................................*/
			$query = "SELECT * FROM admin WHERE username='".safee($condb,$username)."' AND password='".safee($condb,$password)."' AND validate='1' AND access_level > 0 OR email='".safee($condb,$username)."' AND password='".safee($condb,$password)."' AND validate='1' AND access_level > 0 ";
			$result = mysqli_query($condb,$query)or die(mysqli_error($condb));
			$row = mysqli_fetch_array($result);
			$num_row = mysqli_num_rows($result);
			
		/*................................................... Staff ..............................................*/
		$query_staff = mysqli_query($condb,"SELECT * FROM staff_details WHERE usern_id='".safee($condb,$username)."' AND password='".safee($condb,$password)."' AND r_status='2' AND access_level2> 0 OR email='".safee($condb,$username)."' AND password='".safee($condb,$password)."'AND r_status='2' AND access_level2> 0 ")or die(mysqli_error($condb));
		$num_row_staff = mysqli_num_rows($query_staff);
		$row_staff = mysqli_fetch_array($query_staff);
		/*................................................... Student ..............................................*/
	$query_student = mysqli_query($condb,"SELECT * FROM student_tb WHERE RegNo ='".safee($condb,$username)."' AND password='".safee($condb,$password)."'AND verify_Data ='TRUE' OR e_address='".safee($condb,$username)."' AND password='".safee($condb,$password)."' AND verify_Data ='TRUE'")or die(mysqli_error($condb));
		$num_row_student = mysqli_num_rows($query_student);
		$row_student = mysqli_fetch_array($query_student);
		
	//	$config = mysql_fetch_array(mysql_query(" SELECT * FROM schoolsetuptd "));
		
		if( $num_row > 0 and ( $_POST['captcha'] == $_SESSION['captcha'])) { 
		$_SESSION['id']=$row['admin_id'];
	    $_SESSION['loggedAt2']= time();
		echo $name;
		
mysqli_query($condb,"insert into user_log (username,login_date,admin_id)values('$username',NOW(),".$row['admin_id'].")")or die(mysqli_error($condb));
}else if ($num_row_student > 0 and ( $_POST['captcha'] == $_SESSION['captcha']) ){
		//$_SESSION['member_id']=$row_member['m_id'];
		$_SESSION['student_id']=$row_student['stud_id'];
		$_SESSION['loggedAt2']= time();
		echo 'true_student';
		mysqli_query($condb,"insert into user_log (username,login_date,staff_id)values('$username',NOW(),".$row_student['stud_id'].")")or die(mysqli_error($condb));
				
		}else if ($num_row_staff > 0 and ( $_POST['captcha'] == $_SESSION['captcha'])  ){
		$_SESSION['staff']=$row_staff['staff_id'];
		$_SESSION['loggedAt2']= time();
		echo 'true';
		mysqli_query($condb,"insert into user_log (username,login_date,staff_id)values('$username',NOW(),".$row_staff['staff_id'].")")or die(mysqli_error($condb));
		
		
		 }else{ 
				echo 'false';
		}	
				
		?>