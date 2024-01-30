<?php
require_once "connection.php";
class coursesModel{
    /**
     * Función para exportar los datos de la base de datos
     */
    static public function index($table1, $table2, $amount, $from){
        if ($amount == null){
            $stmt=connection::connect()->prepare("SELECT $table1.id, $table1.titulo, $table1.descripcion, $table1.imagen, $table1.precio, $table1.id_creador
                $table2.nombre, $table2.apellido FROM $table1 INNER JOIN $table2 ON $table1.id_creador = $table2.id");  
        } else {
            $stmt=connection::connect()->prepare("SELECT $table1.id, $table1.titulo, $table1.descripcion, $table1.imagen, $table1.precio, $table1.id_creador
                $table2.nombre, $table2.apellido FROM $table1 INNER JOIN $table2 ON $table1.id_creador = $table2.id LIMIT $from,$amount");
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt->close();
        $stmt=null;
    }
    /**
     * Función para importar los datos a la base de datos
     */
    static public function create($table, $data){
        $stmt=connection::connect()->prepare("INSERT INTO $tabla(titulo, descripcion, instructor, imagen, precio, id_creador, created_at, updated_at) VALUES (:titulo, :descripcion, :instructor, :imagen, :precio, :id_creador, :created_at, :updated_at)");
        $stmt -> bindParam(":titulo", $data["titulo"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $data["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":instructor", $data["instructor"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagen", $data["imagen"], PDO::PARAM_STR);
		$stmt -> bindParam(":precio", $data["precio"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_creador", $data["id_creador"], PDO::PARAM_STR);
		$stmt -> bindParam(":created_at", $data["created_at"], PDO::PARAM_STR);
		$stmt -> bindParam(":updated_at", $data["updated_at"], PDO::PARAM_STR);

        if($stmt -> execute()){
			return "ok";
		}else{
			print_r(connection::connect()->errorInfo());
		}
		$stmt-> close();
		$stmt = null;
    }
    /**
     * Función para mostrar los datos pedidos por le usuario
     */
    static public function show($table1, $table2, $id){
        $stmt=connection::connect()->prepare("SELECT $table1.id, $table1.titulo, $table1.descripcion, $table1.imagen, $table1.precio, $table1.id_creador
        $table2.nombre, $table2.apellido FROM $table1 INNER JOIN $table2 ON $table1.id_creador = $table2.id WHERE $table1.id=:id");
        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt->close();
        $stmt=null;
    }
    /**
     * Función para actualizar los datos de un curso
     */
    static public function update($table, $data){
        $stmt = connection::connect() -> prepare("UPDATE `cursos` SET titulo=:titulo, descripcion=:descripcion, instructor=:instructor,
            imagen=:imagen, precio=:precio, updated_at=:update_at WHERE id=:id");

        $stmt -> bindParam(":id", $data["id"], PDO::PARAM_STR);
        $stmt -> bindParam(":titulo", $data["titulo"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $data["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":instructor", $data["instructor"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagen", $data["imagen"], PDO::PARAM_STR);
		$stmt -> bindParam(":precio", $data["precio"], PDO::PARAM_STR);
		$stmt -> bindParam(":updated_at", $data["updated_at"], PDO::PARAM_STR);

        if($stmt -> execute()){
			return "ok";
		}else{
			print_r(connection::connect()->errorInfo());
		}
		$stmt-> close();
		$stmt = null;
    }
    /**
     * Función para borrar un curso
     */
    static public function delete($table, $data){
        $stmt=connection::connect()->prepare("DELETE FROM $table WHERE id=:id");
        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
        IF($stmt->execute()){
            return "ok";
        }else {
            print_r(connection::connect()->errorInfo());
        }
        $stmt->close();
        $stmt=null;
    }
}
?>