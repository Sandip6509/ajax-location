<?php

class MyModel {

    public $connection = '';

    function __construct() {
        try {
            $this->connection = new mysqli("localhost", "root", "password", "ajax_mvc");
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $folderName = "DBErrorLog";
            if (!file_exists($folderName)) {
                 mkdir($folderName,777,true); // ubuntu require permission 
            }
            $FileName = $folderName . "/ErrorLog_" . date("d_M_Y") . ".txt";
            file_put_contents($FileName, PHP_EOL . "TIME:>> " . date('Y-m-d H:i A') . PHP_EOL . "ErrorMessage:>> " . $msg . PHP_EOL, FILE_APPEND);
        }
    }

	function SelectData($tbl,$where = ''){
        $Sql= " SELECT * FROM $tbl";
        if ($where != '') {
            $Sql .= " WHERE ";
            foreach ($where as $key => $value) {
                $Sql .= " $key = '$value' AND";
            }
            $Sql = rtrim($Sql,'AND');
        }
        $Ex= $this->connection->query($Sql);
        if ($Ex->num_rows > 0) {

            while ($FetchData = $Ex->fetch_object()) {
                $allData[] = $FetchData;
            }
            $Res['data'] = $allData;
            $Res['status'] = 1;
            $Res['message'] = "Success";
        }else{
            $Res['data'] = 0;
            $Res['status'] = 0;
            $Res['message'] = "No data found";
        }
        return $Res;
    }
}
