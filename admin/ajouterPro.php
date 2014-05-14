<?php
session_start();
include ("inc/entete.inc.php");
include ("inc/fonction.inc.php");
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $nomuser, $motdepass);
?>

<div>

		<form action="ajouterPro.php" method="post" name="formu" id="formu" enctype="multipart/form-data"> 
				<fieldset>
				</br>
				Insérez votre image <input type="file" name="fichier" id="fichier" /><br/>
				</br>
				Nom du produit : <input type="text" name="nomProduit" id="nomProduit"/><br/>
				Description : <input type="text" name="descProduit" id="descProduit"/><br/>
				Prix : <input type="number" name="prixProduit" id="prixProduit"/><br/>
				Types de prduit : <select name="typeProduit" id="typeProduit">
				<?php
					$reponseReq = $bdd->query('SELECT DISTINCT categorie FROM produits');
					while ( $donnees = $reponseReq->fetch() )
					{
						echo '<option value="' .$donnees['categorie']. '">'.$donnees['categorie'].'</option>';
					}
				?>
				</select></br>
				<input type="reset" name="effacer" value="Effacer"/>
				<input type="submit" id="submitNouvEtu" name="submit" value="Envoyer"/>
				</fieldset>
			</form>
								
	<?php
				
				
			if (isset ($_POST['submit']))
			{
				if( isset($_POST['nomProduit']) && isset($_POST['descProduit']) 
				&& isset($_POST['prixProduit']) && isset($_POST['typeProduit'])
				&& (!$_FILES['fichier']['error']))
				{
					$extension = array('jpg', 'jpeg', 'gif', 'png');
					upload($_POST['nomProduit'], $_FILES['fichier'], $extension, '1000000', '../images/produit/');
					
					$nom = $_POST['nomProduit'];
					$description = $_POST['descProduit'];
					$prix = $_POST['prixProduit'];
					$type = $_POST['typeProduit'];
					$nomImage = $_FILES['fichier']['name'];
					
					try
					{
						$ajoutReq = $bdd->prepare('INSERT INTO produits VALUES (\'\', :nom, :sous_titre, :prix, :image, :categorie)');
						$ajoutReq->execute( array(
								'nom' => $nom,
								'sous_titre' => $description,
								'prix' => $prix,
								'image' => $nomImage,
								'categorie' => $type
								));
						
						echo '<h4>Votre nouveau produit a bien été enregistré </h4>';
					}
					catch (Exception $erreur) 
					{
						die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
					}
				}
				else 
					echo'Veuillez rentrer tout les champs ';
			}
			?>
			</br></br></br><a href="boutique.php">Retour a nos différents produits</a> 
			<?php 
						
include ("inc/foot.inc.php"); 
?>
</div>