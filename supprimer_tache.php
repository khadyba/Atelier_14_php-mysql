<?php
session_start();

if (isset($_POST['supprimer'])) {
include_once('connection.php');
$sql= "UPDATE tache SET is_delete= 1 WHERE id_tache=:id_tache";
$requet=$db->prepare($sql);

$requet->bindValue(":id_tache",intval($_POST['tache_a_supprimer']) ,PDO::PARAM_INT);
// $requet->execute();
// echo "la tache a étais modifié";
if ($requet->execute()) {
    $sql= "SELECT * FROM tache WHERE id_tache=:id_tache ";
$requet=$db->prepare($sql);
$requet->bindValue(":id_tache",intval($_POST['tache_a_supprimer']));

// on execute
$requet->execute();
$utilisateur=$requet->fetchALL(PDO::FETCH_ASSOC);
$_SESSION['tache']=$utilisateur;
$_SESSION['terminer']=$_POST['tache_a_supprimer'];
header("location: detailtache.php");
exit();
}

}