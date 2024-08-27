<?php

class Conexao{
    public static $instance;
    
    private function __construct() {
        
    }
    
    public static function getInstance() {
        $host = 'localhost';
        $dbname = 'teste_itif';
        $username = 'root';
        $password = '';
        if (!isset(self::$instance)) {
            self::$instance = new PDO("mysql:host=$host;dbname=$dbname", $username,
            $password);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS,
                PDO::NULL_EMPTY_STRING);
        }
        
        return self::$instance;
    }
    
}
?>
