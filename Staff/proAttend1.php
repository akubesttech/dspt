<?php

/**
 * @author 
 * @copyright 2017
 */

//require_once '../config/config.php';
//require_once '../admin/lib/dbcon2.php';
require_once 'attandanse.php';

$att = new attandanse();

if ($_POST['type'] == 'Add' && $_POST['date']) {
    echo $att->Add();
    
}


?>