<?php
class connection{
    static public function connect(){
        $link = new PDO("mysql:host=localhost;dbname=api-rest-full","root","");
        $link->exec("set names utf8");
        return $link;
    }
}
?>