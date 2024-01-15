<?php
require_once "connection.php";
class registerModel {
    static public function index($table){
        $stmt=connection::connect()->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt->close();
        $stmt=null;
    }
    static public function create($table, $data){
        $stmt=connection::connect()->prepare("INSERT INTO $table(nombre, apellido, email, id_cliente, llave_secreta, created_at, updated_at) VALUES (:name, :surname, :email, :id_client, :key, :created_at, :updated_at)");
        $stmt -> bindParam(":nombre", $datos["name"], PDO::PARAM_STR);
		$stmt -> bindParam(":apellido", $datos["apsurnamellido"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_cliente", $datos["id_client"], PDO::PARAM_STR);
		$stmt -> bindParam(":llave_secreta", $datos["key"], PDO::PARAM_STR);
		$stmt -> bindParam(":created_at", $datos["created_at"], PDO::PARAM_STR);
		$stmt -> bindParam(":updated_at", $datos["updated_at"], PDO::PARAM_STR);
        if($stmt->execute()){
            return "create";
        }else{
			print_r(Conexion::connect()->errorInfo());
		}
        $stmt-> close();
		$stmt = null;
    }
}
?>