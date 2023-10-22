<?php
session_start();
 // on se conecte a la base
 include_once('connection.php');
$utilisateur="";
// $insert=false;
if (!isset($_SESSION['tache'])) {
    $_SESSION['tache']=[];
}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST["ajouter"])) {
  
    
    $title=strip_tags($_POST['title']);
    var_dump($title=strip_tags($_POST['title']));
    $priority=strip_tags($_POST['priority']);
    $status=strip_tags($_POST['status']);
    $description=htmlspecialchars($_POST['description']);
$id= $_SESSION['id_utilisateur'];
   
    $sql=" INSERT INTO  tache  ( titre,Priorité,Statut, Description,id_uitlisateur)  
    VALUES (:titre,:priority,:status,:description,:id_uitlisateur)";
    $requet= $db->prepare($sql);
$requet->bindParam(":titre",$title,PDO::PARAM_STR);
$requet->bindParam(":priority",$priority,PDO::PARAM_STR);
$requet->bindParam(":status",$status,PDO::PARAM_STR);
$requet->bindParam(":description",$description,PDO::PARAM_STR);
$requet->bindParam(":id_uitlisateur",$id,PDO::PARAM_INT);
// on execute

if ($requet->execute()) {
echo "Tache ajouter avec succé";
$insert=true;


}else{
$error=$requet->errorInfo();
echo " Une erreur c'est produit";
}
  

}

$sql= "SELECT * FROM tache WHERE id_uitlisateur=:id_uitlisateur ";
$requet=$db->prepare($sql);
$requet->bindValue(":id_uitlisateur",intval($_SESSION['id_utilisateur']));

// on execute
$requet->execute();

$utilisateur=$requet->fetchALL(PDO::FETCH_ASSOC);
$_SESSION['tache']=$utilisateur;



// echo "<pre>";
// print_r($_SESSION['tache'][0]['id_tache']);
// echo "</pre>";
// die;
    

?> 





















<!DOCTYPE html>
<link rel="stylesheet" href="style.css">
<html>

<head>
    <title>Mes Tâches</title>
</head>

<body>
    <div class="navbar">
        <h1 class="leye">Gestion de Mes Tâches</h1>
        <p><?php echo $_SESSION['nom_utilisateur'] ?></p>
    </div>
    <div class="task-container">
   

    <?php if (is_array($_SESSION['tache']) && count($_SESSION['tache'])>0){ ?>
        
    
        <?php   foreach($_SESSION['tache'] as  $utilisateurs){?>
            <?php if ($utilisateurs['is_delete']==0){ ?>
       <h1 class="lp"><?php echo $utilisateurs['titre'] ?></h1>
       <p><?php echo  $utilisateurs['Description'] ?>.</p>
       <div class="inline-elements">
           <p><?php echo "Prioriter :" .$utilisateurs['Priorité'] ?></p>
           <p class="paragraph"><?php echo "Statut :" .$utilisateurs['Statut'] ?></p>
           <form action="detailtache.php" method="POST">
            <input type="text" name="indextache" id="" value="<?= $utilisateurs['id_tache'] ?>">
           <button type="submit" name="index_detail" style="color: #fff; text-decoration: none" >Voir les détails</button>
           </form>
          
       </div>
       <?php } ?>
       <?php } ?>
        <?php }else{ ?>
    <h2>Aucune tache ajouter.</h2>
        <?php }?>
    </div>

<form action="gestiontache.php" method="POST">
<div class="add-task">
        <h1>Ajouter une nouvelle tâche </h1>
        <h2></h2>
        <label for="task-title">Titre:</label>
        <input type="text" id="task-title" name="title">

        <label for="task-priority">Priorité:</label>
       
        <select id="task-priority" name="priority">
            <option value="haute">Haute</option>
            <option value="moyenne">Moyenne</option>
            <option value="basse">Basse</option>
        </select>

        <label for="task-status">Statut:</label>
        <select id="task-status" name="status">
            <option value="encours">En cours</option>
            <option value="enattente">En attente</option>
            <option value="terminee">Terminée</option>
        </select>

        <label for="task-description">Description:</label>
        <textarea id="task-description" name="description" rows="4"></textarea>

        <button type="submit"  name="ajouter">Ajouter</button>
</form>
    
    </div>
</body>

</html>
