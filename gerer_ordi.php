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

	<h2>Ajouter un ordinateur</h2>
		<form method="post" action="index_admin.php">
			<input type="text" name="typeOrdi" placeholder="Type ordinateur">
			<input type="submit" name="cmdAjouterO" id="cmdAjouter" value="Ajouter">
		</form>

    <h2>Modifier un ordinateur</h2>
    <form method="post" action="index_admin.php">
    	<select name="numOrdi">
    	<?php
    	$bdd = new PDO('mysql:host=localhost;dbname=gestordi_bdd;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    	$req = $bdd->prepare('SELECT * FROM ordinateur');
		$req->execute();
		while ($data = $req->fetch()){
		?> 
			<option value="<?php echo $data['numOrdi'] ?>"> <?php echo $data['numOrdi'] ?> </option>";
        <?php
                }
        ?>
    	</select>

    	<input type="text" name="typeOrdi" placeholder="Type ordinateur">
    	<input type="submit" name="cmdModifierO" id="cmdModifierO" value="Modifier">
    </form>
    
   <h2>Supprimer un ordinateur</h2>
   <form method="post" action="index_admin.php">
   	<select name="numOrdi">
    	<?php
    	$bdd = new PDO('mysql:host=localhost;dbname=gestordi_bdd;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    	$req = $bdd->prepare('SELECT * FROM ordinateur');
		$req->execute();
		while ($data = $req->fetch()){
		?> 
			<option value="<?php echo $data['numOrdi'] ?>"> <?php echo $data['numOrdi'] ?> </option>";
        <?php
                }
        ?>
    </select>
    <input type="submit" name="cmdSupprimerO" id="cmdSupprimerO" value="Supprimer">  
   </form>
    

	<fieldset class="ui-grid-solo">
            <div class="ui-block-b"><button name="cmdAccueil" onclick="location.href='index_admin.php'" id="cmdAccueil" value="Accueil" /></div>
	</fieldset>
	</div>
	</body>
</html>

<?php } ?>

 




