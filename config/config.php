<?php

session_start();

$con = connect();

function connect()
{

  try {

    $con = new PDO("mysql:host=web06.iis.uni-bamberg.de; port=3307; dbname=wip2122_g3; charset=utf8", "wip2122_g3", "FUznaGVM3");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo 'Verbindung fehlgeschlagen: ' . $e->getMessage();
  }

  return $con;
}
