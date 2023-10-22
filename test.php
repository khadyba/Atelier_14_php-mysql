<?php
session_start();
include_once('connection.php');
if (isset($_POST["ajouter"])) {
    
            $title=htmlspecialchars($_POST['title']);
            $priority=htmlspecialchars($_POST['priority']);
            $status=htmlspecialchars($_POST['status']);
            $description=htmlspecialchars($_POST['description']);
    $id= 2;

            // on se conecte a la base
            $sql=" INSERT INTO  tache  ( titre,Priorité,Statut, Description,id_uitlisateur)  
            VALUES ('oo','ojoj','okokok','jjjj',1)";
            $requet= $db->prepare($sql);
    // $requet->bindParam(":titre",$title);
    // $requet->bindParam(":priority",$priority);
    // $requet->bindParam(":status",$status);
    // $requet->bindParam(":description",$description);
    // $requet->bindParam(":id_uitlisateur",$id);
     // on execute

     if ($requet->execute()) {
        echo "Tache ajouter avec succé";
     }else{
        echo " Une erreur c'est produit";
     }
     
    }






    

 
   
}

$id= $_SESSION['id_utilisateur'];
// on se conecte a la base
include_once('connection.php');
$sql= "SELECT * FROM tache WHERE id_uitlisateur=:id_uitlisateur ";
$requet=$db->prepare($sql);
$requet->bindValue(":id_uitlisateur",$id);

// on execute
$requet->execute();
    $utilisateur=$requet->fetchALL();








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
        <p></p>
    </div>

<form action="" method="POST">
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
