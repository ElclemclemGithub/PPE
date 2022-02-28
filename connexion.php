<?php 
session_start(); 

################################Log a la basse de donnée##########################################################
    $databases_names = 'GSB';
    $databases_pass = 'azerty';
    $databases_user = 'clement';
    $databases_acces = 'localhost';
    $databases_port = '3306';
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
if(isset($_POST['user_name'])){
    $user = htmlspecialchars($_POST['user_name']);
        $mdp = htmlspecialchars($_POST['user_mail']);
}
###############################Lorsque les information sont etre et que le bouton connexion est appuié###########
###############################on regarde si les information sont dans la bdd et on les récupere#################

if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"])
{
    $captha = $_POST["captcha"];
    $valide = $_SESSION["code"];
}
        
    if (!empty($user) and !empty($mdp) and !empty($captha)){
        $requeteclogin = 'select login, mdp from `utilisateur` where login="'.$user.'"and mdp="'.$mdp.'"';
                
        $resultlogin = $pdo->query($requeteclogin);
        $resultatlogin = $resultlogin->fetch();
                
        $retourloginuser = $resultatlogin['login'];
        $retourloginmdp = $resultatlogin['mdp'];
        $retourgrade = $resultatlogin['libelle'];
        
        $nomconncet=$pdo->query('select nom, prenom, id_utilisateur, libelle from `utilisateur` INNER JOIN grade WHERE utilisateur.id_Grade = grade.id_Grade AND login="'.$user.'"and mdp="'.$mdp.'"');
        
        $data1 = $nomconncet->fetch();
        
        #################on récupére les inforation de l'utilisateur pour plutard#################
        $_SESSION['id'] = $data1['id_utilisateur'];
        $_SESSION['nom'] = $data1['nom'];
        $_SESSION['prenom'] = $data1['prenom'];
        $_SESSION['grade'] = $data1['libelle'];
        ##########################################################################################
        
###############################regarde si il coresponde et envoie ver la prochaine page############################     
            if($user == $retourloginuser and  $mdp == $retourloginmdp){
                header('Location: Accueil.php');
                exit();
            }
            elseif($user != $retourloginuser and $mdp != $retourloginmdp){
                echo ("Il a une erreur dans le nom d'utillisateur ou dans le mots de passe.");
            }
            elseif($captcha != $valide) {
                $status = "<p style='color:#FFFFFF; font-size:20px'>
                <span style='background-color:#FF0000;'>Le code captcha entré ne correspond pas! Veuillez réessayer.</span></p>";
            }
  }
    ?>
<html>
  <head>
      
    <link rel="stylesheet" type="text/css" href="stylecss.css">
    <title>Page de connexion</title>
  </head>
    <form method="POST">
  <div class='arrière_plan'>
  <body>
  <center>
    <br><br><br><br><br><br><br><br><br>
    <div class = 'fonds'>
    <br>
    <img src="GSB Logo.png" style="vertical-align: middle;"/>
    <h1>Page de connexion</h1> 
    <form action="formulaire" method="post">
    <div>
        <label for="name">Login : </label>
        <input type="text" id="name" name="user_name" placeholder="Entrez le login">
    </div>
    <br>
    <div>
        <label for="mail">Mot de passe : </label>
        <input type="password" id="mdp" name="user_mail" placeholder="Entrez le mot de passe">
    </div>
</form>
    <table>
    <tr>
      <td>
        <img src="captcha.php" style="vertical-align: middle;"/>
        <br><br>
        <input name="captcha" type="text" placeholder="Copier le code">
      </td>
    </tr>
    <tr>
        
      <td><br><input name="submit" type="submit" value="Se connecter"></td>
        
        
    
            
    </tr>
    </table>
      </div>
      </center>
      </body>
    </div>
    </form>
</html>
   
