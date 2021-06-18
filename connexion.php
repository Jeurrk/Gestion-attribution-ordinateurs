    <?php
session_start();  // démarrage d'une session

try 
    {
        $bdd = new PDO('mysql:host=localhost;dbname=gestordi_bdd;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } 
    //on se connecte à MySQL
    catch (Exception $e) 
    {
        //En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage("Problème de connexion à MySQL"));
    }

// on vérifie que les données du formulaire sont présentes
if (isset($_POST['login']) && isset($_POST['mdp'])) {
    $bdd = new PDO('mysql:host=localhost;dbname=gestordi_bdd;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    // cette requête permet de récupérer l'utilisateur depuis la BD
    $requete = "SELECT * FROM admin WHERE identifiant=? AND motDePasse=?";
    $resultat = $bdd->prepare($requete);
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
    $resultat->execute(array($login, $mdp));
    if ($resultat->rowCount() == 1) {
        // l'utilisateur existe dans la table
        // on ajoute ses infos en tant que variables de session
        $_SESSION['login'] = $login;
        $_SESSION['mdp'] = $mdp;
        // cette variable indique que l'authentification a réussi
        $authOK = true;
        header('location: index_admin.php');
    }
} 
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Résultat de l'authentification</title>
</head>
<body>
    <h1>Résultat de l'authentification</h1>
    <?php
    if (isset($authOK)) {
        echo "<p>Vous avez été reconnu(e) en tant que " . escape($login) . "</p>";
        echo '<a href="membres.php">Poursuivre vers la page membre</a>';
    }
    else { ?>
        <p>Vous n'avez pas été reconnu(e)</p>
        <p><a href="index.php">Nouvel essai</p>
    <?php } ?>
</body>
</html>