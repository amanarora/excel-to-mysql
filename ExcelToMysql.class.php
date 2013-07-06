<?php
/**
 * Name : Excel To Mysql
 * Description : The simplest way to insert 
 *               the data of your excel sheet into a mysql database. 
 *               Fully customizable and free to use
 * Author : Aman Arora
 * Author Website : http://amanarora.com/
 * 
**/
class ExcelToMysql {
    private $filePath;
    private $sheetNum = 1;
    private $excelCom;
    private $workbook;
    private $worksheet;
    private $mysqlHost;
    private $mysqlUsername;
    private $mysqlPassword;
    private $mysqlDbName;
    
    public function __construct(){
        $this->excelCom = new COM("Excel.application") or die ("Error occured while instantiating Excel component");   
    }
    
    public function open($path="NULL",$sheet = "NULL")
    {
        if($path==="NULL")
        {
            $path = $this->filePath;
        }
        if($sheet==="NULL")
        {
            $sheet = $this->sheetNum;
        }
        $this->workbook = $this->excelCom->Workbooks->Open($path) or die("Error occured while opening the file " . $path . " Please check the path");
        $this->worksheet = $this->workbook->Worksheets($sheet);
        $this->worksheet->Activate;
    }
    
    public function setMysqlDetails($host,$username,$password,$dbname)
    {
        $this->mysqlHost = $host ;
        $this->mysqlUsername = $username;
        $this->mysqlPassword = $password;
        $this->mysqlDbName = $dbname;
    }
}

?>
