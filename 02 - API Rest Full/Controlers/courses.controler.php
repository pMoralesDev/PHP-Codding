<?php
class coursesControler{
    public function index(){
        $json=array(
            "detail"=>"you are on the list courses"
        );
        echo json_encode($json,true);
        return;
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