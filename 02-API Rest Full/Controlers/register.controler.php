<?php
class registerControler{
    public function create($data){
        /**
         * Validamos el valor del nombre
         */
        if(isset($data["nombre"]) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/' , $data["nombre"])){
            $json=array(
                "status" => 404,
                "detail"=>"name value isn't permit, only letters"
            );
            echo json_encode($json,true);
            return;
        }
        /**
         * Validamos el valor del apellido
         */
        if(isset($data["apellido"]) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/' , $data["apellido"])){
            $json=array(
                "status" => 404,
                "detail"=>"surname value isn´t permit, only letters"
            );
            echo json_encode($json,true);
            return;
        }
        /**
         * Validamos el correo
         */
        if(isset($data["email"]) && !preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $data["email"])){
            $json=array(
                    "status"=>404,
                    "detail"=>"email value is not correct "
            );
            echo json_encode($json,true);
            return;
        }
        /**
         * Comprobamos que el email no esta ya registrado
         */
        $register = registerModel::index("clientes");
        foreach ($register  as $key => $value) {
            if($value["email"] == $data["email"]){
                 $json=array(
                    "status"=>404,
                    "detail"=> "this mail is already register"
            ); 
            echo json_encode($json,true);
            return;
            }
        }
        /**
         * Creamos los registros de cada cliente
         */
        $id_client= str_replace("$","c",crypt($data["nombre"].$data["apellido"].$data["email"] ,'$2a$89$afartwetsdAD52356FEDGsfhsd$'));
        $key= str_replace("$","a",crypt($data["email"].$data["apellido"].$data["nombre"] ,'$2a$89$afartwetsdAD52356FEDGsfhsd$'));
        $data=array(
            "name"=>$data["nombre"],
			"surname"=>$data["apellido"],
			"email"=>$data["email"],
			"id_client"=>$id_client,
			"key"=>$key,
			"created_at"=>date('Y-m-d h:i:s'),
			"updated_at"=>date('Y-m-d h:i:s')
        );
        $create=registerModel::create("clientes",$data);
        if($create == "create"){
            $json=array(
                "detail"=> "your user has been register",
                "id" => $id_client,
                "key" => $key
        ); 
        echo json_encode($json,true);
        return;
        }
    }
}
?>