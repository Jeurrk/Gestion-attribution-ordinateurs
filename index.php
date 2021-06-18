<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<?php include 'entete.html'; ?>
	<body>
	<div class='page'>
	<div data-role="header">
		<h1 align='center'>GestOrdi : connexion</h1>
	</div>
	<form method="post" action="connexion.php">
    	<input type="text" name="login" id="login" placeholder="Identifiant" required/>
    	<br />
    	<input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required/>
    	<br />
    	<input type="submit" name="connexion" value="Connexion" />
	</form>
	</div>
	</body>
</html>