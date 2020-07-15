<?php
//core
class dbcon {
//function dbcon(){
//	$user = "root";
//	$pass = "";
//	$host = "localhost";
	//$db = "smsdb";
	//@mysql_pconnect($host,$user,$pass);
//	mysql_select_db($db);
//}
function dbcon() {
      $user = "root";
      $pass = "";
      $server = "localhost";
      $dbase = "dscht_tb";
      $conn = mysql_connect($server, $user, $pass);
      if (!$conn) {
         $this->error("Connection attempt failed");
      }if (!mysql_select_db($dbase, $conn)) {
         $this->error("Dbase Select failed");
      }
      $this->CONN = $conn;
      return true;
   }
function host(){
	$h = "http://".$_SERVER['HTTP_HOST']."/DSCHT/";
	return $h;
}

function hRoot(){
	$url = $_SERVER['DOCUMENT_ROOT']."/DSCHT/";
	return $url;
}

//parse string
function gstr(){
    $qstr = $_SERVER['QUERY_STRING'];
    parse_str($qstr,$dstr);
    return $dstr;
}




function MySQLCN() {
      $user = DB_USERNAME;
      $pass = DB_PASSWORD;
      $server = DB_SERVER;
      $dbase = DB_DATABASE;
      $conn = mysql_connect($server, $user, $pass);
      if (!$conn) {
         $this->error("Connection attempt failed");
      }if (!mysql_select_db($dbase, $conn)) {
         $this->error("Dbase Select failed");
      }
      $this->CONN = $conn;
      return true;
   }

   function close() {
      $conn = $this->CONN;
      $close = mysql_close($conn);
      if (!$close) {
         $this->error("Connection close failed");
      }
      return true;
   }

   function error($text) {
      $no = mysql_errno();
      $msg = mysql_error();
      exit;
   }

   function select($sql = "") {
      if (empty($sql)) {
         return false;
      }
      if (empty($this->CONN)) {
         return false;
      }
      $conn = $this->CONN;
      $results = @mysql_query($sql, $conn);

      if ((!$results) or (empty($results))) {
         return false;
      }
      $count = 0;
      $data = array();
      while ($row = mysql_fetch_array($results)) {
         /* echo "<br/>Row >>> <pre>";
           print_r($row);
           echo "</pre>"; */
        foreach ($row as $key => $value) {
            if (!is_array($value)) {
               $row[$key] = htmlspecialchars_decode($value, ENT_QUOTES);
            }
         }
         $data[$count] = $row;
         $count++;
      }
      /* echo "<br/>Full Data<pre>";
        print_r($data);
        echo "</pre>"; */
      mysql_free_result($results);
      return $data;
   }

   function selectForJason($sql = "") {
      if (empty($sql)) {
         return false;
      }if (empty($this->CONN)) {
         return false;
      }
      $conn = $this->CONN;
      $results = @mysql_query($sql, $conn);

      if ((!$results) or (empty($results))) {
         return false;
      }
      $count = 0;
      $data = array();
      while ($row = mysql_fetch_assoc($results)) {
         foreach ($row as $key => $value) {
            if (!is_array($value)) {
               $row[$key] = htmlspecialchars_decode($value, ENT_QUOTES);
            }
         }
         $data[$count] = $row;
         $count++;
      }
      /* echo "<br/>Full Data<pre>";
        print_r($data);
        echo "</pre>"; */

      mysql_free_result($results);
      return $data;
   }

   function newselect($sql = "") {
      if (empty($sql)) {
         return false;
      }if (!eregi("^select", $sql)) {
         echo "wrongquery<br>$sql<p>";
         echo "<H2>Wrong function silly!</H2>\n";
         return false;
      }if (empty($this->CONN)) {
         return false;
      }
      $conn = $this->CONN;
      $results = @mysql_query($sql, $conn);
      if ((!$results) or (empty($results))) {
         return false;
      }
      $count = 0;
      $data = array();
      while ($row = mysql_fetch_array($results)) {
         $data[$count] = $row;
         $count++;
      }
      mysql_free_result($results);
      return $data;
   }

   function insert($sql = "") {
      if (empty($sql)) {
         return false;
      }if (empty($this->CONN)) {
         return false;
      }
      $conn = $this->CONN;
      $results = mysql_query($sql, $conn);

      if (!$results) {
         echo "Insert Operation Failed..<hr>" . mysql_error();
         $this->error("Insert Operation Failed..");
         $this->error("<H2>No results!</H2>\n");
         return false;
      }
      $id = mysql_insert_id($this->CONN);
      return $id;
   }

   

   function convertDate($temp) {
      return (substr($temp, 6, 4) . '-' . substr($temp, 0, 2) . '-' . substr($temp, 3, 2));
   }

   function printDate($temp) {
      if ($temp != NULL) {
         return (substr($temp, 5, 2) . '-' . substr($temp, 8, 2) . '-' . substr($temp, 0, 4));
      }
      return '';
   }

//ends the class over here
}
?>
