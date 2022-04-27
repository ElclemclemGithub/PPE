<?php
################################Log a la basse de donnée##########################################################

//connection BDD serveur
    $databases_names = 'test_gsb';
    $databases_pass = 'azerty';
    $databases_user = 'clement';
//don't change
    $databases_acces = 'localhost';
    $databases_port = '3306';
//connection BDD locale
    $databases_names1 = 'test_gsb';
    $databases_pass1 = '';
    $databases_user1 = 'root';

//requet et test de connection a la bdd
try{
    $pdo = new PDO("mysql:host=$databases_acces;dbname=$databases_names1;charset_utf8;","$databases_user1", "$databases_pass1");

    }   
    catch (PDOException $exc){
    echo $exc->getMessage();
    exit();
    }
?>