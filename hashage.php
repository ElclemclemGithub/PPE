<?php
################################Log a la basse de donnée##########################################################

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


    $recup = $pdo->query("Select id_utilisateur, mdp from utilisateur;");
    
    while ($hash = $recup->fetch()) {
        $hashid[] = $hash['id_utilisateur'];
        $hashmdp[] = $hash['mdp']; 
    }

    for ($a = 0; count($hashmdp) > $a; $a++){
        $mdpcrypt = hash("sha256", "$hashmdp[$a]");
        $hash[] = $mdpcrypt;
        $up = $pdo->prepare("update utilisateur set mdp = '". $mdpcrypt."' where id_utilisateur = '". $hashid[$a]."';");
        $up->execute()
    }
       ?>