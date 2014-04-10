<?php
function upload($nom, $fichier, $listeExt, $taille, $destination) 
{
	if ( isset($nom) && isset($fichier) ) 
	{
		$nom = htmlspecialchars($nom);
		if ( $fichier['error'] == 0 ) 
		{
			$tailleFichier = $fichier['size'];
			$typeFichier = $fichier['type'];
			$nomFichier = $fichier['name'];
			$detailFichier = pathinfo($fichier['name']);
			$extFichier = $detailFichier['extension'];

			if ( $tailleFichier <= $taille ) 
			{
				$extAutorisee = $listeExt;

				if ( in_array($extFichier, $extAutorisee) == 1 ) 
				{
					$dossierDestination = $destination;
					$fichierDepose = move_uploaded_file($fichier['tmp_name'], $dossierDestination.$nomFichier);
					if ( $fichierDepose == 1 ) 
					{
						echo '<h4>Upload réussi.</h4>';
					}
					else 
					{
						echo '<h4>Erreur d\'écriture du fichier !</h4>';
					}
				}
				else 
				{
					echo '<h4>L\'extension n\'est pas autorisée</h4>';
				}
			}
			else 
			{
				echo '<h4>Votre fichier est trop gros</h4>';
			}
		}
		else 
		{
			echo '<h4>Erreur dans l\'envoi du fichier !</h4>';
		}
	}
	else 
	{
		echo '<h4>Image non changer</h4>';
	}
}