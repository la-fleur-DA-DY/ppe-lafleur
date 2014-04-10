<?php
include ("inc/entete.inc.php");
include ("inc/fonction.inc.php");

?>

<div>
			
			<form action="ajouterBou.php" method="post" name="formu" id="formu" >
						<fieldset>
						Nom de la boutique : <input type="text" name="nomBou" id="nomBou"/><br/>
						Rue : <input type="text" name="rueBou" id="rueBou"/><br/>
						Cp : <input type="number" name="cpBou" id="cpBou"/><br/>
						Ville : <input type="text" name="villeBou" id="villeBou"><br/>	
						Tel : <input type="number" name="telBou" id="telBou"><br/>
						Ouverture : <input type="text" name="ouvertureBou" id="ouvertureBou"><br/>
						<input type="reset" name="effacer" value="Effacer"/>
						<input type="submit" name="submit" value="Envoyer"/>
						</fieldset>
			</form>
						
						<?php
						
					if (isset ($_POST['submit']))
					{
						if (isset($_POST['nomBou']) && !empty($_POST['nomBou']) && isset($_POST['rueBou']) && !empty($_POST['rueBou'])
						&& isset($_POST['cpBou']) && !empty($_POST['cpBou']) && isset($_POST['villeBou']) && !empty($_POST['villeBou'])
						&& isset($_POST['telBou'])&& !empty($_POST['telBou']) && isset($_POST['ouvertureBou']) && !empty($_POST['ouvertureBou']))
						{
							//$extQueJeVeux = array('jpg', 'jpeg', 'gif', 'png');
							//upload($_POST['nom'], $_POST['fichier'], $extQueJeVeux, '.../images/boutiques/');
							$nom = $_POST['nomBou'];
							$rue = $_POST['rueBou'];
							$cp = $_POST['cpBou'];
							$ville = $_POST['villeBou'];
							$tel = $_POST['telBou'];
							$ouverture = $_POST['ouvertureBou'];
						
							try
							{
								$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
								$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $nomuser, $motdepass);
								$ajoutReq = $bdd->prepare('INSERT INTO boutiques VALUES (\'\', :nom, :rue, :cp, :ville, \'\' ,:telephone, :ouverture)');
								$ajoutReq->execute( array(
										'nom' => $nom,
										'rue' => $rue,
										'cp' => $cp,
										'ville' => $ville,
										'telephone' => $tel,
										'ouverture' => $ouverture,
										));
								echo '<h4>Votre nouvelle boutique a bien été enregistré.</h4>';
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
					</br></br></br><a href="adresse.php">Retour a nos différentes adresse</a> 
					<?php 						
include ("inc/foot.inc.php"); 
?>
</div>