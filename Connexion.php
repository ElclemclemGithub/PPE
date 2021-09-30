<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Page de connexion</title>
  </head>
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
    <form action="validate.php" method="post">
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
    </form>
  </center>
</div>
  </body>
</html>
