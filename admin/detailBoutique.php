<?php
	include ("inc/entete.inc.php");

		if ( isset($_GET['idType']) )
		{
			$idType = $_GET['idType'];
				try 
				{
					$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
					$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $nomuser,$motdepass);
					$reponseReq = $bdd->prepare('SELECT * FROM  produits WHERE categorie=:categorie ');
					$reponseReq->execute( array(
							'categorie' => $idType));
					echo'<h3>'.$idType.'</h3>';
					echo '<table>';
					echo '<tr class="bord"><th>PHOTO</th><th>DESCRIPTION</th><th>PRIX</th></tr>';
				
					while ( $donnees = $reponseReq->fetch() )
					{
						echo '<tr>';
						echo '<td><img src="../images/produit/'.$donnees['image'].'" width="160"/></td>';
						echo '<td>'.$donnees['sous_titre'].'</td>';
						echo '<td>'.$donnees['prix'].' €</td>';
						echo '<td><a href="modifier.php?idModif='.$donnees['produit_id'].'"><img src="../img/modifier.png" alt="modifier" width="50"/></a></td>';
						echo '<td><a href="supprimer.php?idEfface='.$donnees['produit_id'].'"><img src="../img/supprime.png" alt="Supprimer" height="50" /></a></td>';
						echo '</tr>';
					}
					echo '</table>';
				}
				catch (Exception $erreur) 
				{
					die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
				}
?>
</br></br></br><a href="boutique.php">Retour a nos différents produits</a> 
<?php 
		
			include ("inc/foot.inc.php");
		}
?>