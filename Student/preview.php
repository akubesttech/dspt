<?php
include('../admin/lib/dbcon.php'); 
dbcon(); 
include('session.php');

$output = array('error'=>false,'list'=>'');
	
	$sql = "SELECT * FROM post_tb WHERE ecate1 = '".safee($condb,$ecateg)."'";
$query = mysqli_query($condb,$sql);
	while($row = mysqli_fetch_assoc($query)){
	 $output['list'] .= "<table border='1'><tr>
           <th colspan='3'>".$row['position']."</th></tr>
				";
		$position = slugify($row['position']);
		$pos_id = $row['postid'];
		if(isset($_POST[$position])){
			if($row['mvote'] > 1){
				if(count($_POST[$position]) > $row['mvote']){
					//$output['error'] = true;
					//$output['message'][] = '<li>You can only choose '.$row['max_vote'].' candidates for '.$row['description'].'</li>';
						message("You can only choose ".$row['mvote']." candidates for ".$row['position'], "error");
				}
				else{
					foreach($_POST[$position] as $key => $values){
						if($ecateg == "2"){
$sql = "SELECT * FROM candidate_tb WHERE candid = '".safee($condb,$values)."' and post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID)."' and approve ='1' and fac = '".safee($condb,$student_facut)."' ";}elseif($ecateg == "1"){
			$sql = "SELECT * FROM candidate_tb WHERE candid = '".safee($condb,$values)."' and post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID)."' and fac = '".safee($condb,$student_facut)."' and dept = '".safee($condb,$student_dept)."' and approve ='1' ";}else{
				$sql = "SELECT * FROM candidate_tb WHERE candid = '".safee($condb,$values)."' and post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID)."' and approve = '1' ";}
						//$sql = "SELECT * FROM candidates WHERE id = '$values'";
						$cmquery = mysqli_query($condb,$sql);
						$cmrow = mysqli_fetch_assoc($cmquery);
						$existv3 = imgExists("../admin/".$cmrow['image']);
                if ($existv3 > 0 ){$image ="../admin/".$cmrow['image'];}else{ $image = "uploads/NO-IMAGE-AVAILABLE.jpg";}
				$output['list'] .= "<tr>
    <td colspan='1'><img  src=".$image." height='30px' width='30px' ></td>
    <td colspan='1'>".$cmrow['fname']." ".$cmrow['lname']."</td>
    <td colspan='1'><i class='fa fa-check-circle-o'style='color:green;font-size: 25px;'></i>  </td>
    </tr>";
					}

				}
				
			}
			else{
				$candidate = $_POST[$position];
					if($ecateg == "2"){
$sql = "SELECT * FROM candidate_tb WHERE candid = '".safee($condb,$candidate)."' and post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID)."' and approve ='1' and fac = '".safee($condb,$student_facut)."' ";
				}elseif($ecateg == "1"){
			$sql = "SELECT * FROM candidate_tb WHERE candid = '".safee($condb,$candidate)."' and post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID)."' and fac = '".safee($condb,$student_facut)."' and dept = '".safee($condb,$student_dept)."' and approve ='1' ";
								}else{
				$sql = "SELECT * FROM candidate_tb WHERE candid = '".safee($condb,$candidate)."' and post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID)."' and approve = '1' ";
									 }
				//$sql = "SELECT * FROM candidates WHERE id = '$candidate'";
				$csquery = mysqli_query($condb,$sql);
				$csrow = mysqli_fetch_assoc($csquery);
				$existv2 = imgExists("../admin/".$csrow['image']);
                if ($existv2 > 0 ){$image ="../admin/".$csrow['image'];}else{ $image = "uploads/NO-IMAGE-AVAILABLE.jpg";}
				$output['list'] .= "<tr>
    <td colspan='1'><img  src=".$image." height='30px' width='30px' ></td>
    <td colspan='1'>".$csrow['fname']." ".$csrow['lname']."</td>
    <td colspan='1'><i class='fa fa-check-circle-o'style='color:green;font-size: 25px;'></i>  </td>
    </tr>";
			}

		}
		
	}
$output['list'] .= "</table>";
	echo json_encode($output);


?>