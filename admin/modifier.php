<?php
include ("inc/entete.inc.php");
include ("inc/fonction.inc.php");

			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $nomuser,$motdepass);
			
			if ( isset($_GET['idModif']) )
			{
				$idModif = $_GET['idModif'];
				try 
				{
					
					$reponseReq = $bdd->prepare('SELECT * FROM produits WHERE produit_id = :produit_id');
					$reponseReq->execute( array(
							'produit_id' => $idModif
					));
					$donnees = $reponseReq->fetch();
					?>
					
					<form action="modifier.php" method="post" name="formu1" id="formu1" enctype="multipart/form-data">
						<input type="hidden" name="hdnIdProd" id="hdnIdProd" value="<?php echo $donnees['produit_id']; ?>"/>
						Nom du produit : <input type="text" name="nomProd" id="nomProd" value="<?php echo $donnees['nom']; ?>"/><br/>
						Description du produit : <input type="text" name="descProd" id="descProd" value="<?php echo $donnees['sous_titre']; ?>"/><br/>
						Prix : <input type="number" name="prixProd" id="prixProd" value="<?php echo $donnees['prix']; ?>"/><br/>
						Insérez image de votre produit <input type="file" name="fichier" id="fichier" /><br/>
						Types de prduit : <select name="typeProd" id="typeProd">
						<?php
								$reponseReq2 = $bdd->query('SELECT DISTINCT categorie FROM produits');
								while ( $donnees2 = $reponseReq2->fetch() )
								{
									if ($donnees['categorie'] == $donnees2['categorie'])
									{
										echo '<option value="'.$donnees2['categorie'].'" selected="select">'.$donnees2['categorie'].'</option>';
									}
									echo '<option value="'.$donnees2['categorie'].'" >'.$donnees2['categorie'].'</option>';
								}
						?>
						</select></br>
						<input type="reset" name="effacer" />	
						<input type="submit" name="modifier" value="Modifier"/>		
					</form>
					
				<?php 
				}
				catch (Exception $erreur) 
				{
					die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
				}
				
			}
			
			
			if ( isset($_POST['modifier']) ) 
			{
				if ( isset($_POST['nomProd']) && isset($_POST['descProd'])  && isset($_POST['prixProd']) && isset($_POST['typeProd']) ) 
				{
					$idP = $_POST['hdnIdProd'];
					
					if (!$_FILES['fichier']['error'])
					{
						$extension = array('jpg', 'jpeg', 'gif', 'png');
						upload($_POST['nomProd'], $_FILES['fichier'], $extension, '1000000', '../images/produit/');
						$nomImageP = $_FILES['fichier']['name'];
					}
					else 
					{
						$infoImg = $bdd->prepare('SELECT * FROM produits WHERE produit_id = :produit_id');
						$infoImg->execute( array(
								'produit_id' => $idP
						));
						$donneesI = $infoImg->fetch();
						$nomImageP = $donneesI['image'];
					}
					
					$nomP = $_POST['nomProd'];
					$descP = $_POST['descProd'];
					$prixP = $_POST['prixProd'];
					$typeP = $_POST['typeProd'];
					
					try 
					{
						$modificationProd = $bdd->prepare('UPDATE produits SET nom = :nom, sous_titre = :sous_titre, prix = :prix, image = :image,  categorie = :categorie WHERE produit_id = :produit_id');
						$modificationProd->execute( array(
								'produit_id' => $idP,
								'nom' => $nomP,
								'sous_titre' => $descP,
								'prix' => $prixP,
								'image'=> $nomImageP,
								'categorie' => $typeP
								
						));

						$infos = $bdd->prepare('SELECT * FROM produits WHERE produit_id = :produit_id');
						$infos->execute( array(
								'produit_id' => $idP
						));
						$donneesP = $infos->fetch();
						
						echo '<table>';
						echo '<h4>Le produit a était modifier</h4>';
						echo '<tr class="bord"><th>PHOTO</th><th>DESCRIPTION</th><th>PRIX</th><th>MODIFIER</th><th>SUPPRIMER</th></tr>';
						echo '<tr>';
						echo '<td><img src="../images/produit/'.$donneesP['image'].'" width="160"/></td>';
						echo '<td>'.$donneesP['sous_titre'].'</td>';
						echo '<td>'.$donneesP['prix'].' €</td>';
						echo '<td><a href="modifier.php?idModif='.$donneesP['produit_id'].'"><img src="../img/modifier.png" alt="modifier" width="50"/></a></td>';
						echo '<td><a href="supprimer.php?idEfface='.$donneesP['produit_id'].'"><img src="../img/supprime.png" alt="Supprimer" height="50" /></a></td>';
						echo '</tr>';
						echo '</table>';
					}
					catch (Exception $erreur) {
						die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
					}
				}
				?>
				</br></br></br><a href="boutique.php">Retour a nos différents produits</a> 
				<?php 
			}
			
			
			if ( isset($_GET['idChoix']) )
			{
				$idChoix = $_GET['idChoix'];
				try
				{
						
					$reponseReq = $bdd->prepare('SELECT * FROM boutiques WHERE id=:id');
					$reponseReq->execute( array(
							'id' => $idChoix));
					$donnees = $reponseReq->fetch();
					?>
						<form action="modifier.php" method="post" name="formu" id="formu" >
						Nom de la boutique : <input type="text" name="nomBou" id="nomBou" value="<?php echo $donnees['nom']?>"/><br/>
						Rue : <input type="text" name="rueBou" id="rueBou" value="<?php echo $donnees['rue']?>"/><br/>
						cp : <input type="number" name="cpBou" id="cpBou" value="<?php echo $donnees['cp']?>"/><br/>
						Ville : <input type="text" name="villeBou" id="villeBou" value="<?php echo $donnees['ville']?>"><br/>	
						Tel : <input type="text" name="telBou" id="telBou" value="<?php echo $donnees['telephone']?>"><br/>
						Ouverture : <input type="text" name="ouvertureBou" id="ouvertureBou" value="<?php echo $donnees['ouverture']?>"><br/>
						<input type="hidden" name="idchoix" id="idchoix" value="<?php echo $idChoix ?>"/><br/>
						<input type="submit" id="modif" name="modif" value="Modifier"/></form>
			<?php	}
					catch (Exception $erreur) 
					{
				  		die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
					}	
				}	
						
								
						if (isset ($_POST['modif']) && isset($_POST['nomBou']) && !empty($_POST['nomBou']) && isset($_POST['rueBou']) && !empty($_POST['rueBou'])
						&& isset($_POST['cpBou']) && !empty($_POST['cpBou']) && isset($_POST['villeBou']) && !empty($_POST['villeBou'])
						&& isset($_POST['telBou'])&& !empty($_POST['telBou']) && isset($_POST['ouvertureBou']) && !empty($_POST['ouvertureBou']))
						{
							
							$nom = $_POST['nomBou'];
							$rue = $_POST['rueBou'];
							$cp = $_POST['cpBou'];
							$ville = $_POST['villeBou'];
							$tel = $_POST['telBou'];
							$ouverture = $_POST['ouvertureBou'];
							$id = $_POST['idchoix'];
							
			
			
							try
							{
								$modification = $bdd->prepare('UPDATE boutiques SET nom = :nom, rue = :rue, cp = :cp, ville = :ville, telephone = :tel, ouverture = :ouverture WHERE id = :id');
								$modification->execute(array(
										'nom' => $nom,
										'rue' => $rue,
										'cp' => $cp,
										'ville' => $ville,
										'tel' => $tel,
										'ouverture' => $ouverture,
										'id' => $id
										));
										echo '<h3>Donnée modifier</h3>';
							}
							catch (Exception $erreur)
							{
								die('Erreur : ' . $erreur->getMessage());
							}
							?>
							</br></br></br><a href="adresse.php">Retour a nos différentes adresse</a> 
							<?php 
						}			
include ("inc/foot.inc.php");
?>
</div>