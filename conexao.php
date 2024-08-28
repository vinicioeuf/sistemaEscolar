<?php

class Conexao {
    public static $instance;
    
    private function __construct() {
        // Construtor privado para impedir a criação de instâncias externas
    }
    
    public static function getInstance() {
        $host = 'autorack.proxy.rlwy.net';
        $dbname = 'railway';
        $username = 'root';
        $password = 'bdLgUSdBvEpoTiQUhcLjPhQhMAzqKTFA';
        $port = 19891;
        
        if (!isset(self::$instance)) {
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
            self::$instance = new PDO($dsn, $username, $password);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
        
        return self::$instance;
    }
    
}
?>
