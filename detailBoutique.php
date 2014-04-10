<?php
	include ("inc/entete.inc.php");

		if ( isset($_GET['idType']) )
		{
			$idType = $_GET['idType'];
			if ($idType == 'plantes.php')
			{
				try 
				{
					$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
					$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $nomuser,$motdepass);
					$reponseReq = $bdd->query('SELECT * FROM  produits WHERE categorie="plantes" ');
					echo'<h3>Plantes</h3>';
					echo'<p><a class="pagesuivante1" href="detailBoutique.php?idType=fleurs.php">Vers les fleurs</a></p>';
					echo'<p><a class="pageprecedente" href="detailBoutique.php?idType=compositions.php">Vers les compositions</a></p><br/><br/>';
					echo '<table>';
					echo '<tr class="bord"><th>PHOTO</th><th>DESCRIPTION</th><th>PRIX</th></tr>';
				
					while ( $donnees = $reponseReq->fetch() )
					{
						echo '<tr>';
						echo '<td><img src="images/produit/'.$donnees['image'].'"/></td>';
						echo '<td>'.$donnees['sous_titre'].'</td>';
						echo '<td>'.$donnees['prix'].' €</td>';
						echo '</tr>';
					}
					echo '</table>';
				}
				catch (Exception $erreur) 
				{
					die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
				}
	
		
			include ("inc/foot.inc.php");
		}
		

		elseif ( $idType ==  'compositions.php')
		{
			try 
			{
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $nomuser,$motdepass);
				$reponseReq = $bdd->query('SELECT * FROM  produits WHERE categorie="compo" ');
				echo'<h3>Compostions</h3>';
				echo'<p><a class="pagesuivante1" href="detailBoutique.php?idType=plantes.php">Vers les plantes</a></p>';
				echo'<p><a class="pageprecedente" href="detailBoutique.php?idType=fleurs.php">Vers les fleurs</a></p><br/><br/>';
				echo '<table>';
				echo '<tr class="bord"><th>PHOTO</th><th>DESCRIPTION</th><th>PRIX</th></tr>';
				while ( $donnees = $reponseReq->fetch() )
				{
					echo '<tr>';
					echo '<td><img src="images/produit/'.$donnees['image'].'" width="160"/></td>';
					echo '<td>'.$donnees['sous_titre'].'</td>';
					echo '<td>'.$donnees['prix'].' €</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			catch (Exception $erreur) 
			{
				die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
			}
			
		include ('inc/foot.inc.php');
		}
		elseif ( $idType == 'fleurs.php')
		{
			try 
			{
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $nomuser,$motdepass);
				$reponseReq = $bdd->query('SELECT * FROM  produits WHERE categorie="fleurs" ');
				
				echo'<h3>Fleurs</h3>';
				echo'<p><a class="pagesuivante1" href="detailBoutique.php?idType=compositions.php">Vers les compositons</a></p>';
				echo'<p><a class="pageprecedente" href="detailBoutique.php?idType=plantes.php">Vers les plantes</a></p><br/><br/>';
				echo '<table>';
				echo '<tr class="bord"><th>PHOTO</th><th>DESCRIPTION</th><th>PRIX</th></tr>';
				while ( $donnees = $reponseReq->fetch() )
				{
					echo '<tr>';
					echo '<td><img src="images/produit/'.$donnees['image'].'"/></td>';
					echo '<td>'.$donnees['sous_titre'].'</td>';
					echo '<td>'.$donnees['prix'].' €</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			catch (Exception $erreur) 
			{
				die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
			}
		
			
				include ("inc/foot.inc.php");
		}
		}
?>