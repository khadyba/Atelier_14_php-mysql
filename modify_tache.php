<?php
session_start();

if (isset($_POST['marquer_a_terminer'])) {
include_once('connection.php');
$sql= "UPDATE tache SET Statut='Terminée' WHERE id_tache=:id_tache";
$requet=$db->prepare($sql);

$requet->bindValue(":id_tache",intval($_POST['tache_a_modifier']) ,PDO::PARAM_INT);
// $requet->execute();
// echo "la tache a étais modifié";
if ($requet->execute()) {
    $sql= "SELECT * FROM tache WHERE id_tache=:id_tache ";
$requet=$db->prepare($sql);
$requet->bindValue(":id_tache",intval($_POST['tache_a_modifier']));

// on execute
$requet->execute();
$utilisateur=$requet->fetchALL(PDO::FETCH_ASSOC);
$_SESSION['tache']=$utilisateur;
$_SESSION['terminer']=$_POST['tache_a_modifier'];
header("location: detailtache.php");
exit();
}

}