<?php
require_once("config.php");
class Manager{

    function __construct() {
        try {
                return new PDO(TYPE_CNX.':host='.DB_HOST.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);
            }
        catch (PDOException $e) {
            return FALSE;
        }
     }

}

?>


