<?php
$arrayRoutes=explode("/",$_SERVER["REQUEST_URI"]);
   
if(count(array_filter($arrayRoutes))==2){
    /**
     * Cuando no se hace ninguna petición a la API
     */
    $json=array(
         "detail"=>"not found"
    );
    echo json_encode($json,true);
    return;
}else{
    /**
     * Cuando hacemos alguna petición a la API
     */
    if(count(array_filter($arrayRoutes))==3){
        /**
        * Cuando se hace una petición de tipo cursos
        */
        if(array_filter($arrayRoutes)[3]=="cursos"){
            /**
             * Peticiones de tipo POST para añadir cursos
             */
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="POST"){
                /**
                 * Capturamos los datos para añadirlos a la base de datos
                 */
                $data = array(
                    "titulo" => $_POST["title"],
                    "descripcion" => $_POST["description"],
                    "instructor" => $_POST["instructor"],
                    "titulo" => $_POST["title"],
                    "titulo" => $_POST["title"],
                )
                $courses = new coursesControler();
                $courses->create();
            }
            /**
             * Peticiones de tipo GET para consultar los cursos
             */
            elseif(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="GET"){
                $courses = new coursesControler();
                $courses->index();
            }
            
        }
        /**
        * Cuando se hace una petición de tipo registro
        */
        if(array_filter($arrayRoutes)[3]=="registro") {
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="POST"){
                $data=array(
                    "nombre" => $_POST["nombre"],
                    "apellido" => $_POST["apellido"],
                    "email" => $_POST["email"]
                );
                $register = new registerControler();
                $register->create($data);
            }
        }
        
        
    } else {
        if(array_filter($arrayRoutes)[3]=="cursos" && is_numeric(array_filter($arrayRoutes)[4])){
            /**
             * Peticiones GET
             */
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="GET"){
                $courses = new coursesControler();
                $courses->show(array_filter($arrayRoutes)[4]);
            }
            /**
             * Peticiones put
             */
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="PUT"){
                $updateCourses = new coursesControler();
                $updateCourses->show(array_filter($arrayRoutes)[4]);
            }
            /**
             * Peticiones DELETE
             */
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="DELETE"){
                $deleteCourses = new coursesControler();
                $deleteCourses->delete(array_filter($arrayRoutes)[4]);
            }
        }
    } 
}
?>