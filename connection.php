<link rel="stylesheet" href="style.css">
<?php
// include_once('header.php');
// constantesd'environnement
define("DBHOST","localhost");
define("DBUSER","root");
define("DBPASS","");
define("DBNAME","gestionnairredetache");
// data source name
$dsn="mysql:dbname=".DBNAME.";host=".DBHOST ;
// se connecter a la base 
try{ // création du php data objet(PDO)
    $db= new PDO ($dsn,DBUSER,DBPASS);
   //echo "nous somme connecter";
// envoyer les donner en utf8
$db->exec("SET NAMES UTF8");
    // on definit le mode de "fecth" par deéfaut
//$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


}catch(PDOException $e){
die( "Erreur".$e->getMessage());
}