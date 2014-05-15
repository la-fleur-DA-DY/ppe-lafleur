<?php
include ("inc/entete.inc.php");
if(isset($_SESSION['login']) && ($_SESSION['statut'] == 'admin') ){
?>
<h1>Nos produits</h1><br/>
		
		<a class="boutique" href="detailBoutique.php?idType=compo"><h3>Compositions</h3></a>
		<a class="boutique" href="detailBoutique.php?idType=fleurs"><h3>Fleurs</h3></a>
		<a class="boutique" href="detailBoutique.php?idType=plantes"><h3>Plantes</h3></a>
		
		</br></br></br>
		<input type="button" name="addProd" value="Ajouter un produit" onclick="self.location.href='ajouterPro.php'"/>
<?php
}
else{
	echo 'Connecter vous en tant qu\'administrateur';
}
include ("inc/foot.inc.php"); 
?>