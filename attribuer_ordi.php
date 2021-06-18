 <?php
 session_start();
 if (isset($_SESSION['login']) && isset($_SESSION['mdp'])) {

 $bdd = new PDO('mysql:host=localhost;dbname=gestordi_bdd;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  if(isset($_POST['cmdSuppAttr'])) {
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
		<h1 align='center'>GestOrdi :: Attribuer</h1>
	</div>
	<h2>Attribuer un ordinateur</h2>
	<form method="post" action="index_admin.php">
		<h3>Attribuer à</h3>
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
    	<h3>L'ordinateur numéro </h3>
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
    	<input type="date" name="dateAttr">
    	<input type="time" name="heureDeb">
    	<input type="time" name="heureFin">
    	<input type="submit" name="cmdAttribuer" id="cmdAttribuer" value="Attribuer">
    </form>

    <fieldset class="ui-grid-solo">
            <div class="ui-block-b"><button name="cmdAccueil" onclick="location.href='index_admin.php'" id="cmdAccueil" value="Accueil" /></div>
	</fieldset>
<h3>Les attributions</h3>
	<?php
		$req = $bdd->prepare('SELECT * FROM ordinateur as O INNER JOIN utilisateur as U on O.numOrdi = U.numOrdi');
		$req->execute();
	?>
<form method="post" action="attribuer_ordi.php">
	<table style="width:100%">
  <tr>
    <th>Prénom</th>
    <th>Nom</th> 
    <th>Ordinateur</th>
    <th>Date d'attribution</th>
    <th>Heures</th>
    <th>Actions</th>
  </tr>
  <?php
  while ($data = $req->fetch()){
    $_POST['idUtil'] = $data['idUtilisateur'];
  ?>
  <tr>
  	<td><?php echo $data['Prénom'] ?></td>
  	<td><?php echo $data['Nom'] ?></td>
    <td><?php echo $data['numOrdi'] ?></td>
    <td><?php echo $data['dateAttribution'] ?></td>
    <td><?php echo $data['heureDeb'] . " " . $data['heureFin'] ?></td>
    <td><input type="submit" name="cmdSuppAttr" value="Annuler" onclick="return confirm('Etes-vous sur de vouloir annuler cette attribution ?')></td>
  </tr>
  <?php } ?>
</table>
</form>


</div>
</body>
</html>
<?php } ?>