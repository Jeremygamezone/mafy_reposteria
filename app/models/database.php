<?php

class DataBase{
    const server="localhost";
    const user="root";
    const password="";
    const dbname="reposteria";

    public static function Connect(){
        try{
            $connection = new PDO("mysql:host=".self::server.";dbname=".self::dbname.";charset=utf8",self::user,self::password);

            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $connection;
        }catch(PDOEXception $e){
            return "Fallo".$e->getMessage();
        }
    }
}