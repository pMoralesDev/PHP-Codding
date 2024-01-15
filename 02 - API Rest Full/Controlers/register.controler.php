<?php
class registerControler{
    public function index(){
        $json=array(
            "detail"=>"you are on the list register"
        );
        echo json_encode($json,true);
        return;
    }
}
?>