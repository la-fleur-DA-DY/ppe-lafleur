<?php
include ("inc/entete.inc.php");
if(isset($_SESSION['login']) && ($_SESSION['statut'] == 'admin') ){
?>
		
<h1>Bienvenue<br/><br/><br/></h1>
<h3>Espace d'administration</h3>

<img style="width:300px" src="../img/fleurs_accueil.png"/>

	<?php
	if(isset($_SESSION['login'])) {?>
					<br/><a href="../index.php?deconnexion=1" title="deconnexion">deconnexion</a>
			<?php 
			 }
				

			 }
			 else{
			 	echo 'Connecter vous en tant qu\'administrateur';
			 	?><br/><a href="../index.php?deconnexion=1" title="deconnexion">deconnexion</a><?php 
			 }
include ("inc/foot.inc.php"); 
?>
