<?php
	include ("inc/entete.inc.php");
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
				echo '<td><a href="detailAdresse.php?idChoix='.$donnees['id'].'.php"><img style="width:100px" src="images/boutiques/boutique_'.$donnees['image'].'.jpg" /></a></td>';
				echo '<td class="nomville"><a class="nomville" href="detailAdresse.php?idChoix='.$donnees['id'].'.php">'.$donnees['nom'].'</a></td>';
				echo '<td class="ville">'.$donnees['ville'].'</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		catch (Exception $erreur) {
			die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
		}
		
include ("inc/foot.inc.php");
?>