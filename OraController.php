<?php 
require 'IDBController.php';

class OraController implements IDBController{
    
    private $conn;
    
      //Table functions
    protected function CreateTable($tableName, $columnsNames, $columnsTypes);
    protected function InsertInto($tableName, $values){
        //...
    }
    
    protected function DropTable($tableName){
        $stid = oci_parse($conn, "DROP TABLE $tableName;");
        oci_execute($stid,OCI_COMMIT_ON_SUCCESS);
    }
    
    protected function TruncateTable($tableName){
        $stid = oci_parse($conn, "TRUNCATE TABLE $tableName;");
        oci_execute($stid);
        $r = oci_commit($conn);
        if (!$r) {
            $e = oci_error($conn);
            trigger_error(htmlentities($e['message']), E_USER_ERROR);
        }
    }
    
    protected function ShowTable($tableName){
        $stid = oci_parse($conn, "DESC $tableName;");
        oci_execute($stid);
        while(($row = oci_fetch_row($stid, OCI_ASSOC)))
        {
            return $row;
        }
    }
    
    protected function ShowTableValues($tableName){
        $stid = oci_parse($conn, "SELECT * FROM $tableName;");
        oci_execute($stid);
        while(($row = oci_fetch_array($stid,OCI_ASSOC0)){
            
        }
    }
    
    //Column functions
    #...
    
    //Row functions
    protected function SelectRowByID($tablename, $id){
        $rows = array();
        $stid = oci_parse($conn, "SELECT * FROM $tableName WHERE ID=$id;");
        oci_execute($stid);
        while (($row = oci_fetch_row($stid)) != false) {
            array_push($rows,$row);
        }
        return $rows;
    }
    
    protected function SelectFirst($tableName){
        $stid = oci_parse($conn, "SELECT * FROM (SELECT * FROM $tableName ORDER BY id ASC) WHERE ROWNUM=0;");
        oci_execute($stid);
        while (($row = oci_fetch_row($stid)) != false) {
            return $row;
        }
    }
    protected function SelectWitchSQL($sqlSelectQuery);//??
       
    //Database functions
    protected function DBConnect(){
        $conn = oci_connect('hr', 'welcome', 'MYDB');// user, haslo, bazadanych/tryb
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
    }
    
    protected function DBDisconnect(){
        oci_close($conn);
    }
    protected function DB_SQLExecute($sqlQuery){
        $stid = oci_parse($conn, $sqlQuery);
        oci_execute($stid);
    }
    
}

?>