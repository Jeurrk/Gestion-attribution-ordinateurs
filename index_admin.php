 <?php
session_start();
 if (isset($_SESSION['login']) && isset($_SESSION['mdp'])) {
	$bdd = new PDO('mysql:host=localhost;dbname=gestordi_bdd;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  if (isset($_POST['cmdAjouter'])) {
        $requete = "INSERT INTO utilisateur (Nom, Prénom) VALUES (?, ?)";
    $resultat = $bdd->prepare($requete);
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $resultat->execute(array($nom, $prenom));
    }

    if (isset($_POST['cmdAjouterO'])) {
        $requete = "INSERT INTO ordinateur (Type) VALUES (?)";
    $resultat = $bdd->prepare($requete);
    $type = $_POST['typeOrdi'];
    $resultat->execute(array($type));
    }

   if (isset($_POST['cmdModifier'])) {
   	$requete = "UPDATE utilisateur SET Nom = ?, Prénom = ? WHERE idUtilisateur = ?";
   	$resultat = $bdd->prepare($requete);
   	$nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $idUtil = $_POST['idUtil'];
    echo "ça passe";
    $resultat->execute(array($nom, $prenom, $idUtil));
   }

   if (isset($_POST['cmdModifierO'])) {
    $requete = "UPDATE ordinateur SET Type = ? WHERE numOrdi = ?";
    $resultat = $bdd->prepare($requete);
    $type = $_POST['typeOrdi'];
    $numOrdi = $_POST['numOrdi'];
    echo "ça passe";
    $resultat->execute(array($type, $numOrdi));
   }

   if (isset($_POST['cmdSupprimer'])) {
   	$requete = "DELETE FROM utilisateur WHERE idUtilisateur = ?;";
   	$resultat = $bdd->prepare($requete);
    $idUtil = $_POST['idUtil'];
    $resultat->execute(array($idUtil));
   }

    if (isset($_POST['cmdSupprimerO'])) {
    $requete = "DELETE FROM ordinateur WHERE numOrdi = ?;";
    $resultat = $bdd->prepare($requete);
    $numOrdi = $_POST['numOrdi'];
    $resultat->execute(array($numOrdi));
   }

   if (isset($_POST['cmdAttribuer'])) {
     $requete = "UPDATE `utilisateur` SET `numOrdi` = ?, dateAttribution = ?, heureDeb = ?, heureFin = ? WHERE `utilisateur`.`idUtilisateur` = ?;";
     $resultat = $bdd->prepare($requete);
     $idUtil = $_POST['idUtil'];
     $numOrdi = $_POST['numOrdi'];
     $dateAtt = $_POST['dateAttr'];
     $heureDeb = $_POST['heureDeb'];
     $heureFin = $_POST['heureFin'];
     $resultat->execute(array($numOrdi, $dateAtt, $heureDeb, $heureFin, $idUtil));

   }
if(isset($_POST['cmdAnnulerAttr'])) {
  $req = $bdd->prepare('UPDATE utilisateur SET numOrdi = null, dateAttribution = null, heureDeb = null, heureFin = null WHERE idUtilisateur = ?');
  $idUtil = $_POST['idUtil'];
  $req->execute(array($idUtil));
 }
 ?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<?php include 'entete.html'; ?>
	<body>
	<div class='page'>
	<div data-role="header">
		<h1 align='center'>GestOrdi :: Menu</h1>
	</div>
        
	<fieldset class="ui-grid-solo">
            <p><div class="ui-block-a"><button name="cmdAttribuer" id="cmdAttribuer" onclick="location.href='attribuer_ordi.php'" value="Attribuer un ordinateur" /></div></p>
            <div class="ui-block-a"><button name="cmdGererUtil"  id="cmdGererUtil" onclick="location.href='gerer_util.php'" value="Gérer utilisateur" /></div>
            <div class="ui-block-a"><button name="cmdGererOrdi"  id="cmdGererOrdi" onclick="location.href='gerer_ordi.php'" value="Gérer ordinateur" /></div>
            <p><div class="ui-block-a"><button name="cmdDeconnexion" id="cmdDeconnexion" onclick="location.href='deconnexion.php'" value="Déconnexion" /></div></p>
	</fieldset>
	</div>
	</body>
</html>
<?php } ?>







