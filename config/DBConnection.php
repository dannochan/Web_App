<?php
    function db_connection(){
        $db = new PDO("mysql:host=web06.iis.uni-bamberg.de;port=3307;dbname=wip2122_g3;charset=utf8", "wip2122_g3", "FUznaGVM3");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
?>