<?php
	if(isset($_SESSION['login']) && ($_SESSION['statut'] == 'admin') ){


	include ("inc/entete.inc.php");
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $nomuser,$motdepass);

	if ( isset($_GET['idChoix']) )
	{
		$idChoix = $_GET['idChoix'];
		try 
		{
			$reponseReq = $bdd->prepare('SELECT * FROM boutiques WHERE id=:id');
			$reponseReq->execute( array(
					'id' => $idChoix));
			while ( $donnees = $reponseReq->fetch() )
			{
				echo '<p class ="titreboutique">'.$donnees['nom'].'<br/></p>';
				echo $donnees['ville'].' ';
			}
			?></br></br><?php 
			echo 'Boutique supprimé';
			$reponseSup = $bdd->prepare('DELETE FROM boutiques WHERE id=:id');
			$reponseSup->execute( array(
					'id' => $idChoix));		
		}
		catch (Exception $erreur) 
		{
	  		die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
		}
		?>
		</br></br></br><a href="adresse.php">Retour a nos différentes adresses</a> 
		<?php 
	}
					
	if ( isset($_GET['idEfface']) )
	{
		$idEfface = $_GET['idEfface'];
		try
		{
				$reponseSup = $bdd->prepare('DELETE FROM produits WHERE produit_id=:produit_id');
				$reponseSup->execute( array(
						'produit_id' => $idEfface));		
				echo 'Produit supprimé';	
		}
			catch (Exception $erreur) 
			{
		  		die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
			}	
			?>
			</br></br></br><a href="boutique.php">Retour a nos différents produits</a> 
			<?php 
	}
	}
	else{
		echo 'Connecter vous en tant qu\'administrateur';
	}
include ("inc/foot.inc.php"); 
?>
