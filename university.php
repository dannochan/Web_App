<?php 

class University{

    function __construct($id, $name, $location, $country, $semester, $description, $degree){
        $this->id = $id;
        $this->name = $name;
        $this->location = $location;
        $this->country = $country;
        $this->semester = $semester;
        $this->description = $description;
        $this->degree = $degree;
    }

    function get_id(){
        return $this->id;
    }

    function get_name(){
        return $this->name;
    }

    function get_location(){
        return $this->location;
    }

    function get_country(){
        return $this->country;
    }

    function get_semester(){
        return $this->semester;
    }

    function get_description(){
        return $this->description;
    }

    function get_degree(){
        return $this->degree;
    }

}


?>