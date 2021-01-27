<?php
include('lib/dbcon.php'); 
dbcon();
if (isset($_GET['ids'])) {
    $id = $_GET['ids'];

    // fetch file to download from database
    $sql = "SELECT * FROM files WHERE id=$id";
    $result = mysqli_query($condb, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'temp/' . $file['Name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('temp/' . $file['Name']));
        readfile('temp/' . $file['Name']);

        // Now update downloads count
        //$newCount = $file['downloads'] + 1;
        //$updateQuery = "UPDATE files SET downloads=$newCount WHERE id=$id";
        //mysqli_query($conn, $updateQuery);
        //exit;
    }}
    
    /* if(isset($_GET['ids'])) 
          {	$id=$_GET['ids'];
              $query = "SELECT Name,Type,Size,content FROM Files WHERE id='$id' ";         
         $result = mysqli_query($condb,$query) or die('Error, query failed');		 
     list($name, $type, $content) = mysqli_fetch_array($result);
	       $path = 'temp/'.$name;
		   $size = filesize($path);
	     header('Content-Description: File Transfer');
         header('Content-Type: application/octet-stream');
         header("Content-length:". $size);
         header("Content-type:". $type);
         header("Content-Disposition: attachment; filename=\"" . basename($name) . "\";");
		 header('Content-Transfer-Encoding: binary');
         header('Expires: 0');
         header('Cache-Control: must-revalidate');
     ob_clean();
       flush();
	       readfile('temp/'.$name);	
           //echo $path;
                mysqli_close($condb);
                exit;      
	}
    */

?>