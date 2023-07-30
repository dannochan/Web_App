<?php 
class Review{

    function __construct($id, $first_name, $last_name, $university, $status){
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->university = $university;
        $this->status = $status;
    }

    function get_id(){
        return $this->id;
    }

    function get_first_name(){
        return $this->first_name;
    }

    function get_last_name(){
        return $this->last_name;
    }

    function get_university(){
        return $this->university;
    }

    function get_status(){
        return $this->status;
    }

}

?>