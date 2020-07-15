<?php
include('../admin/lib/dbcon.php'); 
dbcon();

$query3 = mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $rowdd = mysqli_fetch_array($query3);
							  $title = $rowdd['SchoolName']; $logoback = "../admin/".$rowdd['Logo'];
							  $exists = imgExists($logoback);
							  if ($exists > 0 ){ $logob =  "../admin/".$rowdd['Logo'];
	}else{ $logob = "uploads/NO-IMAGE-AVAILABLE.jpg";}
include('session.php');
//$catee = getecated($elect_ID);
function generateRow($conn,$ecat,$elect_ID2,$eleDept,$elefacu){
		$contents = '';
	 	
		$sql = "SELECT * FROM post_tb WHERE ecate1 = '".safee($condb,$ecat)."' ORDER BY position ASC";
        $query = mysqli_query(Database::$conn,$sql);
        while($row = mysqli_fetch_assoc($query)){
        	$id = $row['postid'];$nvote = $row['mvote'];
        	//$contents .= '';
 if($ecat == "2"){
$sql = "SELECT * FROM candidate_tb WHERE post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID2)."' and approve ='1' and fac = '".safee($condb,$elefacu)."' and approve_result = '1' ORDER BY votes DESC LIMIT ".$nvote;}elseif($ecat == "1"){
			$sql = "SELECT * FROM candidate_tb WHERE post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID2)."' and fac = '".safee($condb,$elefacu)."' and dept = '".safee($condb,$eleDept)."' and approve ='1'  and approve_result = '1' ORDER BY votes DESC LIMIT ".$nvote;}else{
$sql = "SELECT * FROM candidate_tb WHERE post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID2)."' and approve = '1'  and approve_result = '1' ORDER BY votes DESC LIMIT ".$nvote;}
//$sql = "SELECT * FROM candidates WHERE position_id = '$id' ORDER BY lastname ASC";
    		$cquery = mysqli_query(Database::$conn,$sql);$serial = 1 ;
    		$votest = mysqli_num_rows($cquery);
    		while($crow = mysqli_fetch_assoc($cquery)){
    	
    		//$resulta = $db->prepare("SELECT sum(votes) FROM candidate_tb WHERE position= :a");
				//	$resulta->bindParam(':a', $dsds);
					//$resulta->execute();
					//for($i=0; $rowa = $resulta->fetch(); $i++){
					//$dsada=$rowa['sum(votes)'];
					//}
					
				//
    			$sql = "SELECT * FROM votes WHERE candid = '".$crow['candid']."'";
      			$vquery = mysqli_query(Database::$conn,$sql);
      			$votes = mysqli_num_rows($vquery);
	//if($votes > 0 ){
      			$contents .= '
      			<tr>
        			<td colspan="3" align="center" style="font-size:15px;color:#FFF;background-color: #428bca;"><b>'.$row['position'].'</b></td>
        		</tr>
      		<tr><td width="10%"><b>POS.</b></td>
        			<td width="70%"><b>Candidates</b></td>
        			<td width="20%"><b>Votes</b></td>
        		</tr>
      				<tr><td>'.$serial ++ .'</td>
      					<td>'.$crow['fname'].", ".$crow['lname'].'</td>
      					<td>'.$votes.'</td>
      				</tr>
      			'; 
//}else{
if($votest < 1){ $contents .= '<tr><td colspan="3">No Election result Found!</td> </tr>';}
    		}
			

        }

		return $contents;
	}
		
	//$parse = parse_ini_file('config.ini', FALSE, INI_SCANNER_RAW);
    //$title = $parse['election_title'];

	require_once('../admin/tcpdf/tcpdf.php');  
	 $ecat = getecated($elect_ID); if($ecat == "2"){ $nelect = getecate($elect_ID)." (".getfacultyc($efaculty).")"; }elseif($ecat == "1"){  $nelect = getecate($elect_ID)." (".getdeptc($electdept).")";}else{ $nelect = getecate($elect_ID);} 
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Election Winners: '.$title);  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(true);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();
    // -- set new background ---

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
	// set bacground image
        //$img_file = K_PATH_IMAGES.'../admin/uploads/84896975.png';
        // set alpha to semi-transparency
$pdf->SetAlpha(0.5);
        $img_file = $logob; //'../admin/uploads/84896975.jpg';
        $pdf->Image($img_file, 50, 100, 100, '', '', '', '', false, 300, '', false, false, 0); 
        $pdf->SetAlpha(1);
		// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();
 
    $content = '';  
    $content .= '
      	<h2 align="center" style="text-shadow:-1px 1px 1px #000;">'.$title.'</h2>
      	<h4 align="center" style="color:#000;"> Election Winner (s) for '.$nelect.'</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
      ';  
   	$content .= generateRow($condb,$ecat,$elect_ID,$student_dept,$student_facut);  
    $content .= '</table>';  
    $pdf->writeHTML($content);
	ob_end_clean();  
    $pdf->Output('election_winners.pdf', 'I');

?>