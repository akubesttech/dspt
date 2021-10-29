<?php
define('DB_DRIVER', 'mysql');
define('SERVER', 'localhost');
define('USERNAME', 'deltasma_dspogharasmart');
define('PASSWORD', 'ogharasmart_2019l#');
define('DATABASE', 'deltasma_dspogharasmartdb');//
//define('t_gate', 'sk_test_375b86dbef946eaf1fa3fa26c5c30503c5355f21');
define('t_gate', 'sk_live_3f4facadaf3a76db8ca7bb654e40b9d1e4007e1a');
//other creaditials 
define('t_ACCTS', ''); //for school
define('t_ACCTB', ''); // for Bisapp
define('t_ACCTSP', ''); // for school Penaty Account
class Database
{

    /** TRUE if static variables have been initialized. FALSE otherwise
    */
    private static $init = FALSE;
    /** The mysqli connection object
    */
    public static $conn;
    /** initializes the static class variables. Only runs initialization once.
    * does not return anything.
    */
    public static function initialize()
    {
        if (self::$init===TRUE)return;
        self::$init = TRUE;
        self::$conn = new mysqli(SERVER,USERNAME,PASSWORD,DATABASE);
        self::$conn->set_charset("utf8mb4");
    }
public $con;
    public function __construct()
    {
        $this->con = new mysqli(SERVER,USERNAME,PASSWORD,DATABASE);
    }
    public function getCon(){
        return $this->con;
    }
    public function getData($query){
        if($resp = $this->con->query($query)){
            return $resp->fetch_all(MYSQLI_ASSOC);
        }else{
            return $this->con->error;
        }
    }
    public function getSingleData($query){
        if($resp = $this->con->query($query)){
            return $resp->fetch_array(MYSQLI_ASSOC);
        }else{
            return $this->con->error;
        }
    }
    public function getDataAsNumArray($query){
        if($resp = $this->con->query($query)){
            return $resp->fetch_all(MYSQLI_NUM);
        }else{
            return $this->con->error;
        }
    }
}
$dboptions = array(
              PDO::ATTR_PERSISTENT => FALSE, 
              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
              PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );

try {
  $DB2 = new PDO(DB_DRIVER.':host='.SERVER.';dbname='.DATABASE, USERNAME, PASSWORD , $dboptions);  
} catch (Exception $ex) {
  echo $ex->getMessage();
  die;
}
define('SUDO_M', "xculp8_edu2019#,!");
define('ROOTNO', "/");
define('showfullresult', 'no'); // display full result : yes and not full result no (letter case as specified (yes/no))
define('setinstallment', '2'); // define payment installment for school payment i.e 2 for twices installment.
define('setresultuptype', '1'); // define result upload if enabled = 1 course registration is required else course registration is uptional = 0.

/*
define('SERVER', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'dscht_db');

class mysqliSingleton
{
    private static $instance;
    private $connection;

    private function __construct()
    {
        $this->connection = new mysqli(SERVER,USERNAME,PASSWORD,DATABASE);
    }

    public static function init()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new mysqliSingleton();
        }

        return self::$instance;
    }


    public function __call($name, $args)
    {
        if(method_exists($this->connection, $name))
        {
             return call_user_func_array(array($this->connection, $name), $args);
        } else {
             trigger_error('Unknown Method ' . $name . '()', E_USER_WARNING);
             return false;
        }
    }
}
*/
function numtowords($number) {
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'Zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'Three',
        4                   => 'Four',
        5                   => 'Five',
        6                   => 'Six',
        7                   => 'Seven',
        8                   => 'Eight',
        9                   => 'Nine',
        10                  => 'Ten',
        11                  => 'Eleven',
        12                  => 'Twelve',
        13                  => 'Thirteen',
        14                  => 'Fourteen',
        15                  => 'Fifteen',
        16                  => 'Sixteen',
        17                  => 'Seventeen',
        18                  => 'Eighteen',
        19                  => 'Nineteen',
        20                  => 'Twenty',
        30                  => 'Thirty',
        40                  => 'Fourty',
        50                  => 'Fifty',
        60                  => 'Sixty',
        70                  => 'Seventy',
        80                  => 'Eighty',
        90                  => 'Ninety',
        100                 => 'Hundred',
        1000                => 'Thousand',
        1000000             => 'Million',
        1000000000          => 'Billion',
        1000000000000       => 'Trillion',
        1000000000000000    => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
    );
    if (!is_numeric($number)) {
        return false;
    }
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }
    if ($number < 0) {
        return $negative . numtowords(abs($number));
    }
    $string = $fraction = null;
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . numtowords($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = numtowords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= numtowords($remainder);
            }
            break;
    }
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    return $string;
}
?>