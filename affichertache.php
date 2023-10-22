<?php 
// include_once('gestiontache.php'); 


session_start();
if ($_SERVER["REQUEST_METHOD"]==='POST' && isset($_POST["ajouter"])){
    $title=strip_tags($_POST['title']);
    var_dump($title=strip_tags($_POST['title']));
    $priority=strip_tags($_POST['priority']);
    $status=strip_tags($_POST['status']);
    $description=htmlspecialchars($_POST['description']);
$id= $_SESSION['id_utilisateur'];
// on se conecte a la base
include_once('connection.php');
$sql= "SELECT * FROM tache ";
$requet=$db->prepare($sql);
// on execute
if ($requet->execute()) {
    echo ""
}






}



















?>