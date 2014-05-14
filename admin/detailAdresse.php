<?php
session_start();
	include ("inc/entete.inc.php");
	
	if ( isset($_GET['idChoix']) )
	{
		$idChoix = $_GET['idChoix'];
	try 
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $nomuser,$motdepass);
		$reponseReq = $bdd->prepare('SELECT * FROM boutiques WHERE id=:id');
		$reponseReq->execute( array(
				'id' => $idChoix));
		while ( $donnees = $reponseReq->fetch() )
		{
			echo '<p class ="titreboutique">'.$donnees['nom'].'<br/></p>';
			echo '<img style="width:400px" src="../images/boutiques/'.$donnees['image'].'" /><br/>';					
			echo $donnees['rue'].' ';
			echo $donnees['cp'].' ';
			echo $donnees['ville'].' ';
			echo'<br/><br/> Tel : '.$donnees['telephone'].' <br/>Ouverture : '.$donnees['ouverture'];
				
		}
	}
	catch (Exception $erreur) 
	{
		die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
	}
	}
?>

</br></br></br><a href="adresse.php">Retour a nos différentes adresse</a>

</div>			
</div>
</div>
</body>
</html>