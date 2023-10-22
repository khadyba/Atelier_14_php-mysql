<?php
session_start();
// var_dump($_SESSION['terminer']);die;
$tache="";
// var_dump($_POST['index_detail']);die;
if (isset($_POST['index_detail'])){
    foreach($_SESSION['tache'] as $detail){
        if ( intval($_POST['indextache'])== $detail['id_tache']) {
            $tache=$detail;
            break;
        }
    }
}elseif( isset($_SESSION['terminer'])){
    foreach($_SESSION['tache'] as $detail){
        if ( intval($_SESSION['terminer'])== $detail['id_tache']) {
            $tache=$detail;
            break;
        }
    }
}
var_dump($tache['is_delete']);




// echo " la tache <br> <br> ";

?>
<!DOCTYPE html>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>Details de la Tâche</title>
</head>

<body>
    <div class="navbar">
     <?php if(is_array($tache)&& count($tache)>0 ){?>
        <?php if($tache['is_delete']==0){?>

            <h1>Details Tâche : <?php echo $tache['titre'] ?></h1>
    
            <div class="task-details">
        <h1 class="lp"> <?php echo $tache['titre'] ?></h1>
        <div class="inline-elements">
        
            <p class="priority">Priorité:<?= $tache['Priorité'] ?> </p>
            <p class="status">Statut:<?= $tache['Statut'] ?></p>
        </div>
        <p><?php echo  $tache['Description'] ?>.</p>
       
        <div class="button-container">
            <form action="modify_tache.php" method="POST">
                <input type="text" name="tache_a_modifier" id="" value="<?= $tache['id_tache']?>">
            <button  type="submit" id="markCompleted" style="background-color:green" name="marquer_a_terminer">Marquer comme terminé</button>
            </form>
           <form action="supprimer_tache.php" method="POST">
            <input type="text" name="tache_a_supprimer" id="" value="<?= $tache['id_tache']?>" style="width: 30px"  >
           <button type="submit" id="deleteTask" style="background-color:red"  name="supprimer"  >Supprimer la tâche</button>
           </form>
            
        </div>
        <?php }else{ ?>
            <div class="task-details"><h2>Tache non envoyer</h2></div>
        <?php } ?>
        <?php }?>




       
       
    </div>


        </div>

    <div class="button-retour">
        <!-- <button id="returnToList" ">Retour à la liste des tâches</button> -->
        <a href="gestiontache.php">Retour à la liste des tâches</a>
    </div>
</body>

</html>
