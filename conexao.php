<?php

class Conexao{
    public static $instance;
    
    private function __construct() {
        
    }
    
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('pgsql:host=dpg-cqdar156l47c73fruft0-a.oregon-postgres.render.com;
           dbname=itif',
                'vinimvdz', 'Kpg8FepOeyn6sSDlJuC9ZoH5MFXHpQSH');
            self::$instance->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS,
                PDO::NULL_EMPTY_STRING);
        }
        
        return self::$instance;
    }
    
}
?>
