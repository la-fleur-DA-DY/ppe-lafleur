<?php
	include ("inc/entete.inc.php");
	if(isset($_SESSION['login']) && ($_SESSION['statut'] == 'admin') ){
?>
<h1>Nos différentes adresses</h1>
<?php		
		try {
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $nomuser,$motdepass);
			$reponseReq = $bdd->query('SELECT * FROM boutiques');
			echo '<table class="adress">';
			while ( $donnees = $reponseReq->fetch() )
			{
				echo '<tr>';
				echo '<td><a href="detailAdresse.php?idChoix='.$donnees['id'].'.php"><img style="width:100px" src="../images/boutiques/'.$donnees['image'].'" /></a></td>';
				echo '<td class="nomville"><a class="nomville" href="detailAdresse.php?idChoix='.$donnees['id'].'.php">'.$donnees['nom'].'</a></td>';
				echo '<td class="ville">'.$donnees['ville'].'</td>';
				echo '<td><a href="modifier.php?idChoix='.$donnees['id'].'"><img src="../img/modifier.png" /></a></td>';
				echo '<td><a href="supprimer.php?idChoix='.$donnees['id'].'"><img src="../img/supprime.png" height="50" /></a></td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		catch (Exception $erreur) {
			die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
		}
		?>
		</br></br></br>
		<input type="button" name="addAdresse" value="Ajouter une adresse" onclick="self.location.href='ajouterBou.php'"/>
</br></br></br>
		<?php 	
		}
		else{
			echo 'Connecter vous en tant qu\'administrateur';
		}
include ("inc/foot.inc.php");
?>
