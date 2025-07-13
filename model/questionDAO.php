<?php
    require_once __DIR__."/../config/database.php";
    class questionDAO
    {
        function getConnection()
        {
            $dbConnect =  new DatabaseConnection();
            return $dbConnect->getConnection();
        }

        
    }

?>