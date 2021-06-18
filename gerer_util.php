 <?php
 session_start();
 if (isset($_SESSION['login']) && isset($_SESSION['mdp'])) {
 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<?php include 'entete.html'; ?>
	<body>
	<div class='page'>
	<div data-role="header">
		<h1 align='center'>GestOrdi :: Ajout</h1>
	</div>	

	<h2>Ajouter un utilisateur</h2>
		<form method="post" action="index_admin.php">
			<input type="text" name="nom" placeholder="Nom">
			<input type="text" name="prenom" placeholder="Prénom">
			<input type="submit" name="cmdAjouter" id="cmdAjouter" value="Ajouter">
		</form>

    <h2>Modifier un utilisateur</h2>
    <?php
    	$bdd = new PDO('mysql:host=localhost;dbname=gestordi_bdd;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    	$req = $bdd->prepare('SELECT * FROM utilisateur');
		$req->execute();?>
    <form method="post" action="index_admin.php">
    	<select name="idUtil">
    	<?php
		while ($data = $req->fetch()){
		?> 
			<option value="<?php echo $data['idUtilisateur']; ?>"> <?php echo $data['Nom'] . " " . $data['Prénom']; ?> </option>";
        <?php
                }
        ?>
    	</select>

    	<input type="text" name="nom" placeholder="Nom">
    	<input type="text" name="prenom" placeholder="Prénom">
    	<input type="submit" name="cmdModifier" id="cmdModifier" value="Modifier">
    </form>
    
   <h2>Supprimer un utilisateur</h2>
   <form method="post" action="index_admin.php">
   	<select name="idUtil">
    	<?php
    	$bdd = new PDO('mysql:host=localhost;dbname=gestordi_bdd;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    	$req = $bdd->prepare('SELECT * FROM utilisateur');
		$req->execute();
		while ($data = $req->fetch()){
		?> 
			<option value="<?php echo $data['idUtilisateur'] ?>"> <?php echo $data['Nom'] . " " . $data['Prénom'] ?> </option>";
        <?php
                }
        ?>
    </select>
    <input type="submit" name="cmdSupprimer" id="cmdSupprimer" value="Supprimer">  
   </form>
    

	<fieldset class="ui-grid-solo">
            <div class="ui-block-b"><button name="cmdAccueil" onclick="location.href='index_admin.php'" id="cmdAccueil" value="Accueil" /></div>
	</fieldset>
	</div>
	</body>
</html>
<?php
}
?>





