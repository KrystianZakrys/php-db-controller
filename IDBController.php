<?php

interface IDBController{
    //Table functions
    protected function CreateTable($tableName, $columnsNames, $columnsTypes);
    protected function InsertInto($tableName);
    protected function DropTable($tableName);
    protected function TruncateTable($tableName);
    protected function ShowTable($tableName);
    protected function ShowTableValues($tableName);
    
    //Column functions
    #...
    
    //Row functions
    protected function SelectRowByID($tablename, $id);
    protected function SelectFirst($tableName);//??
    protected function SelectWitchSQL($sqlSelectQuery);//??
    
    
    //Database functions
    protected function DBConnect();
    protected function DBDisconnect();
    protected function DB_SQLExecute($sqlQuery);
}

?>