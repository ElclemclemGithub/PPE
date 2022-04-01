<?php
################################Log a la basse de donnée##########################################################

//accés serveur SISR
    $databases_names = 'GSB';
    $databases_pass = 'azerty';
    $databases_user = 'clement';

//accés
    $databases_acces = 'localhost';
    $databases_port = '3306';

//accés local
    $databases_names1 = 'test_gsb';
    $databases_pass1 = '';
    $databases_user1 = 'root';

####################################Permet de tester la connexion a la BDD####################################### 

try{
    $pdo = new PDO("mysql:host=$databases_acces;dbname=$databases_names1;charset_utf8;","$databases_user1", "$databases_pass1");

    }   
    catch (PDOException $exc){
    echo $exc->getMessage();
    exit();
    }
?>