<?php

class Conexao {
    public static $instance;
    
    private function __construct() {
        
    }
    
    public static function getInstance() {
        if (!isset(self::$instance)) {
            $dsn = 'pgsql:host=ep-small-voice-a58jqb4b.us-east-2.aws.neon.tech;
                    dbname=if;
                    options=endpoint%3D[ep-small-voice-a58jqb4b]';
            self::$instance = new PDO($dsn, 'if_owner', '3Vuvj7HhLZDR');
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
        
        return self::$instance;
    }
}
?>

