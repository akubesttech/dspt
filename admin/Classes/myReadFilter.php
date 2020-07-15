<?php

/**
 * Created by PhpStorm.
 * User: haslek_UCNET
 * Date: 11/28/2019
 * Time: 11:45 AM
 */
//spl_autoload_register(function ($clsnm){
//    require_once "PHPExcel/".$clsnm.".php";
//});
class myReadFilter implements PHPExcel_Reader_IReadFilter
{
    public function readCell($column, $row, $worksheetName = '')
    {
        // TODO: Implement readCell() method.
        if(($row == 14)){
            if(in_array($column,range('T','Z'))){
                return true;
            }

        }
        return false;
    }
}