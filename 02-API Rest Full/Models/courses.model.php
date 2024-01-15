<?php
require_once "connection.php";
class coursesModel{
    static public function index($table){
        $stmt=connection::connect()->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt->close();
        $stmt=null;
    }
}
?>