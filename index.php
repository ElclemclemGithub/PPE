<?php 

require ("logbdd.php");
session_start(); 

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

###############################Permet de récupérer les information du formulair##################################

if(isset($_POST['login'])){
    $user = htmlspecialchars($_POST['login']);
    $mdp = htmlspecialchars($_POST['pass']);
    
}

###############################Lorsque les information sont etre et que le bouton connexion est appuié###########
###############################on regarde si les information sont dans la bdd et on les récupere#################

if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"]){
    
    $captha = $_POST["captcha"];
    $valide = $_SESSION["code"];
}
 
    if (!empty($user) and !empty($mdp) and !empty($captha)){
        ###########hash du mot de pass#############
        $mdpcrypt = hash("sha256", "$mdp");
        echo $mdpcrypt;
        echo ("<br>");
        
        $requeteclogin = 'select login, mdp from `utilisateur` where login="'.$user.'"and mdp="'.$mdpcrypt.'";';
        echo $requeteclogin;
        echo ("<br>");
                
        $resultlogin = $pdo->query($requeteclogin);
        $resultatlogin = $resultlogin->fetch();
                
        $retourloginuser = $resultatlogin['login'];
        $retourloginmdp = $resultatlogin['mdp'];
        $retourgrade = $resultatlogin['libelle'];
        
        $nomconncet=$pdo->query('select nom, prenom, id_utilisateur, libelle from `utilisateur` INNER JOIN grade WHERE utilisateur.id_Grade = grade.id_Grade AND login="'.$user.'"and mdp="'.$mdpcrypt.'"');
        
        $data1 = $nomconncet->fetch();
        
        #################on récupére les inforation de l'utilisateur pour plutard#################
        
        $_SESSION['id'] = $data1['id_utilisateur'];
        $_SESSION['nom'] = $data1['nom'];
        $_SESSION['prenom'] = $data1['prenom'];
        $_SESSION['grade'] = $data1['libelle'];
        
        ##########################################################################################
        echo $retourloginmdp;
        echo ("<br>");
        
###############################regarde si il coresponde et envoie ver la prochaine page############################   
        
            if($user == $retourloginuser and  $mdpcrypt == $retourloginmdp){
                $_SESSION["autoriser"]="oui";
                header('Location: accueil.php');
                exit();
            }
            elseif($user != $retourloginuser and $mdpcrypt != $retourloginmdp){
                echo ("Il a une erreur dans le nom d'utillisateur ou dans le mots de passe.");
            }
            elseif($captcha != $valide) {
                $status = "<p style='color:#FFFFFF; font-size:20px'>
                <span style='background-color:#FF0000;'>Le code captcha entré ne correspond pas! Veuillez réessayer.</span></p>";
            }
  }
    ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <link href="style.css" rel="stylesheet">
   </head>
   <body >
       
       <div class="imag">
            <img src="image/GSB%20Logo.png" style="vertical-align: middle; "/>
        </div>
       
      <form method="post" action="">
          
         <input type="text" name="login" placeholder="Login" />
            <br/>
         <input type="password" name="pass" placeholder="Mot de passe" />
            <br/>
        <tr>
            <td>
                <img src="captcha.php" style="vertical-align: middle; height: 30px;"/>
                <input name="captcha" type="text" placeholder="Copier le code">
            </td>
        </tr>
         <input type="submit" name="valider" value="Connexion" />
      </form>
       
   </body>

</html> 