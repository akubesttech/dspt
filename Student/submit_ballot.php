<?php
include('../admin/lib/dbcon.php'); 
dbcon(); 
include('session.php');
	if(isset($_POST['vote'])){
		if(count($_POST) == 1){
			//$_SESSION['error'][] = 'Please vote atleast one candidate';
			message("Please vote atleast one candidate", "error");
		}
		else{
			$_SESSION['post'] = $_POST;
			$a=1;
			//$sql = "SELECT * FROM positions";
			$sql = "SELECT * FROM post_tb WHERE ecate1 = '".safee($condb,$ecateg)."'";
$query = mysqli_query($condb,$sql);
			//$query = $conn->query($sql);
			$error = false;
			$sql_array = array();
			//while($row = $query->fetch_assoc()){
			while($row = mysqli_fetch_assoc($query)){
				$position = slugify($row['position']);
				$pos_id = $row['postid'];
				if(isset($_POST[$position])){
					if($row['mvote'] > 1){
						if(count($_POST[$position]) > $row['mvote']){
							$error = true;
							//$_SESSION['error'][] = 'You can only choose '.$row['mvote'].' candidates for '.$row['position'];
							message("You can only choose ".$row['mvote']." candidates for ".$row['position'], "success");
						}
						else{
							foreach($_POST[$position] as $key => $values){
				$sql_array[] = "INSERT INTO votes (voters_id, elect, candid, posit) VALUES ('".$session_id."','".$ecateg."' ,'$values', '$pos_id')";
$sql_array[] = "UPDATE candidate_tb SET votes = votes + 1 WHERE regno = '".getregid($values)."' and post = '".safee($condb,$pos_id)."' and ecate = '".safee($condb,$elect_ID)."' ";    }

						}
						
					}
					else{
						$candidate = $_POST[$position];
		$sql_array[] = "INSERT INTO votes (voters_id,elect, candid, posit) VALUES ('".$session_id."','".$ecateg."' ,'$candidate', '$pos_id')";
		$sql_array[] = "UPDATE candidate_tb SET votes = votes + 1 WHERE regno = '".getregid($candidate)."' and post = '".safee($condb,$pos_id)."' and ecate = '".safee($condb,$elect_ID)."' ";
					}

				}
				
			}

			if(!$error){
				foreach($sql_array as $sql_row){
					mysqli_query($condb,$sql_row);
				}

				unset($_SESSION['post']);
				//$_SESSION['success'] = 'Ballot Submitted';
message("Ballot Submitted.", "success");
			}

		}

	}
	else{
		//$_SESSION['error'][] = 'Select candidates to vote first';
		message("Select candidates to vote first.", "error");
	}

	//header('location: home.php');
redirect('select.php?view=vote');
?>