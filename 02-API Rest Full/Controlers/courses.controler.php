<?php
class coursesControler{
    public function index(){
        /**
         * Validamos las credenciales del cliente
         */
        $register = registerModel::index("clientes");
        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
            foreach($register as $key => $value){
                /**
                 * Usamos la funcione base64_encode para hacer los datos más largos y difucultar los accesos no permitidos
                 */
                if(base64_encode($_SERVER['PHP_AUTH_USER'].':'.$_SERVER['PHP_AUTH_PW']) == base64_encode($value["id_cliente"].':'.$value["llave_secreta"])){
                    $courses=courseModel::index("cursos");
                    $json=array(
                    "detail"=>$courses 
                    );
                    echo json_encode($json,true);
                    return;
                }
            }
        }
    }
    public function create($data){
        /**
         * Validamos las credenciales para asegurarnos que es un usarioautorizado
         */
        $register = registerModel::index("clientes");
        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
            foreach($register as $key => $value){
                /**
                 * Usamos la funcione base64_encode para hacer los datos más largos y difucultar los accesos no permitidos
                 */
                if(base64_encode($_SERVER['PHP_AUTH_USER'].':'.$_SERVER['PHP_AUTH_PW']) == base64_encode($value["id_cliente"].':'.$value["llave_secreta"])){
                    /**
                     * Validamos los datos
                     */
                    foreach($data as $key => $valueData){
                        if(isset($valueData) && !preg_match('/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $valueData)){
							$json = array(
								"status"=>404,
								"detalle"=>"Error on field ".$key
							);
							echo json_encode($json, true);
							return;
						}
                    }
                    /**
                     * Comprobamos que los datos no están ya registrados
                     */
                    $courses = coursesModel::index("cursos");
                    foreach($courses as $key => $valueCourses) {
                        if($valueCourses->titulo == $data["titulo"]){
							$json = array(
								"status"=>404,
								"detalle"=>"The title already exists on the database"
							);
							echo json_encode($json, true);	
							return;
                        }
                        if($valueCourses->descripcion == $data["descripcion"]){
							$json = array(
								"status"=>404,
								"detalle"=>"This description already exists on the database"
							);
							echo json_encode($json, true);	
							return;
                        }
                    }
                    /**
                     * Exportamos los datos al modelo
                     */
                    $data = array( 
                        "titulo"=>$data["titulo"],
                        "descripcion"=>$data["descripcion"],
                        "instructor"=>$data["instructor"],
                        "imagen"=>$data["imagen"],
                        "precio"=>$data["precio"],
                        "id_creador"=>$valueCliente["id"],
                        "created_at"=>date('Y-m-d h:i:s'),
                        "updated_at"=>date('Y-m-d h:i:s')
                    );
                    $create = coursesModel::create("cursos", $data);
                    /**
                     * Confirmación de éxito
                     */
                    if($create == "ok"){
                        $json = array(
                            "status"=>200,
                            "details"=>"The information has been saved successfully",
                        );
                    }
                }
            }
        }
        $json=array(
            "detail"=>"you are on the list create courses"
        );
        echo json_encode($json,true);
        return;
    }
    public function show($id){
        /** 
         * Validar las credenciales del cliente
         */
        $register = registerModel::index("clientes");
        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
            foreach($register as $key => $value){
                /**
                 * Usamos la funcione base64_encode para hacer los datos más largos y difucultar los accesos no permitidos
                 */
                if(base64_encode($_SERVER['PHP_AUTH_USER'].':'.$_SERVER['PHP_AUTH_PW']) == base64_encode($value["id_cliente"].':'.$value["llave_secreta"])){
                    /**
                     * Mostramos los cursos
                     */
                    $courses=courseModel::show("cursos","clientes",$id);
                    if(!empty($courses)){
                        $json=array(
                            "status"=>200,
                            "detail"=>$courses
                        );
                        echo json_encode($json,true);
                        return;
                    }else{
                        $json=array(
                            "status"=>200,
                            "register_count"=>0,
                            "detail"=>"There are no courses registered"
                        );
                        echo json_encode($json,true);
                        return;
                    }
                    
                }
            }
        }
    }
    public function update($id){
        $json=array(
            "detail"=>"update course => ".$id
        );
        echo json_encode($json,true);
        return;
    }
    public function delete($id){
        $json=array(
            "detail"=>"delete course => ".$id
        );
        echo json_encode($json,true);
        return;
    }
}
?>