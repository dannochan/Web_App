<?php 
session_start();

	//call connect() function and save it in variable
	$pdo = connect();

	//function to connect with db
	function connect() {
		try {
			//adjust personal information (HOST, PORT, DATABASE, USER, PASSWORD)
        	$pdo = new PDO("mysql:host=web06.iis.uni-bamberg.de;port=3307;dbname=wip2122_g3;charset=utf8", "wip2122_g3", "FUznaGVM3");
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        } catch (PDOException $e) {
        	
        	echo 'Verbindung fehlgeschlagen: ' . $e->getMessage();
        }

    	return $pdo;

	}

?>