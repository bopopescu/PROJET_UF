<?php
    session_start();

    $db_params = parse_ini_file('db.ini',true);

    try{
        $pdo = new PDO($db_params['db']['url'], $db_params['db']['user'], $db_params['db']['pass']);
    }
    catch(Exception $e) {
        die("Erreur : ".$e -> getMessage());
        
    }
?>