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
    public function create(){
        $json=array(
            "detail"=>"you are on the list create courses"
        );
        echo json_encode($json,true);
        return;
    }
    public function show($id){
        $json=array(
            "detail"=>"you are on the course => ".$id
        );
        echo json_encode($json,true);
        return;
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