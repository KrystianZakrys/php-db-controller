<?php 

require 'IDBController.php'

class SQLiteController implements IDBController extends SQLite3{
    
    private $db ; 
    
    protected function CreateTable($tableName, $columnsNames, $columnsTypes){
        
    }
    
    protected function InsertInto($tableName, $values)// bez sensu zapytanie!!!
    {
        $sqlQuery = "
            INSERT INTO $tableName VALUES(";
        
            
        foreach ($values as $value) {
            $sqlQuery .= $value.',';
        }
        $sqlQuery = substr($sqlQuery, 0, -1);
        $sqlQuery.= ");";
        }
        try 
        {
            $db->exec($sqlQuery);
        }
        catch(Exception $error)
        {
            die($error);
        }

    }
    
    protected function DropTable($tableName){
          $sqlQuery = <<<EOF 
        DROP TABLE $tableName;
        EOF;
    }
    
    protected function TruncateTable($tableName){
        $sqlQuery = <<<EOF 
        DELETE FROM $tableName;
        EOF;
    }
    //protected function ShowTable($tableName){
    //    $sqlQuery
    //}
    
    
    protected function ShowTableValues($tableName){
        $wiersze = array();
        $sqlQuery = <<<EOF 
        SELECT * FROM $tableName ;
        EOF;
        $ret = $db->query($sqlQuery);     
        while?($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            array_push($wiersze,$row);
        }
        return $wiersze;
    }
    
    
    //Column functions
    #...
    
    //Row functions
    protected function SelectRowByID($tablename, $id){
        $sqlQuery = <<<EOF 
        SELECT * FROM $tableName WHERE ID=$id;
        EOF;
        $ret = $db->query($sqlQuery);
        while?($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            return $row;
        }
        
    }
    
    protected function SelectFirst($tableName){//Minimalne ID jeśli PK jest inkrementowany
            $sqlQuery = <<<EOF 
            SELECT * FROM $tableName
            ORDER BY id ASC
            fetch first 1 rows only;
            EOF;
            $ret = $db->query($sqlQuery);
          while?($row = $ret->fetchArray(SQLITE3_ASSOC) ){
              return $row;
        }
    }
    
    protected function DB_SQLExecute($sqlSelectQuery);//??
    
    
    //Database functions
    protected function DBConnect(){
        try {
            //otwieramy/tworzymy baze sqlite
            $db = new SQLiteDatabase('database.sqlite', 0666, $error);
        }
        catch(Exception $error) {
            die($error);
        }
    }
    
    protected function DBDisconnect(){
        try{
             $db->close();
        }
        catch(Exception $error){
            die($error);
        }
          
    }
    
    protected function SelectWitchSQL($sqlQuery){
        $wiersze = array();
        $ret = $db->query($sqlQuery);     
        while?($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            array_push($wiersze,$row);
        }
        return $wiersze;
    }
}

?>