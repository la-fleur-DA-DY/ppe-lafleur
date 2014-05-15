<?php
include ("inc/entete.inc.php");
?>


<fieldset><legend>Créer un compte</legend>
<form action="compte.php" method="post" name="formu1" id="formuCompte" enctype="multipart/form-data">
Identifiant : <input type="text" name="login" size="40" value=""/><br/><br/>
Mot de passe : <input type="password" name="password" size="40" value=""/><br/><br/>
Entrer a nouveau votre mot de passe : <input type="password" name="passwordConf" size="40" value=""/><br/><br/><br/>
	
<input class="validation" name="authCompte" type="submit" value="Valider"/>
<input type="reset" name="Effacer" />

<?php 
if(isset($_POST['authCompte']))
{
	if(isset($_POST['login']) && isset($_POST['password']) && ($_POST['password'] == $_POST['passwordConf']) )
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		$passwordConf = $_POST['passwordConf'];	
		try
		{
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $nomuser, $motdepass);
			$ajoutReq = $bdd->prepare('INSERT INTO user VALUES (\'\', :login, :password, :passwordConf)');
			$ajoutReq->execute( array(
					'login' => $login,
					'password' => $password,
					'passwordConf' => $passwordConf,
			));
			echo '<h4>Votre compte a bien été enregistré.</h4>';
		}
		catch (Exception $erreur)
		{
			die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
		}
	}
	else
	{
		echo'Veuillez rentrer tout les champs ';
	}	
}


?>