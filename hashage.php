<?php
require ("logbdd.php");


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