 <link rel="stylesheet" href="style.css"
<?php
 include_once('connection.php');

    if ( isset($_POST['se_connecter']) )  {
   
        $nom_connect_utilisateur = $_POST["nom_connect_utilisateur"];
        $mot_conncet_passe = $_POST["mot_de_passe"];
$sql=("SELECT * FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur");
        $query = $db->prepare($sql);
        $query->bindValue(':nom_utilisateur', $nom_connect_utilisateur, PDO::PARAM_STR);
        $query->execute();
        $utilisateur = $query->fetch();
        if ($utilisateur && $mot_conncet_passe ===  $utilisateur['mot_de_passe']) {
            echo "Bienvenue sur votre applications."; 
         } else {
            die("l'utilisateur et /ou le mot de passe est incorrect");
         }
       
// créer une session php pour enregistrer les donner de connection de l'utilisateur
session_start();
 // on stocke dans la session les information de l'utilisateur
 $_SESSION['utilisateur'] = [
    "id" => $utilisateur['id'],
    "nom_ utilisateur" => $nom_connect_utilisateur['nom_utilisateur'],
    "email" => $email['email'],
    "mot_de_passe" => $mot_conncet_passe['mot_de_passe'],

 ];
 
    }


   















?> 
