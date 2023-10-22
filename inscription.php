<?php 
// include_once('connection.php');
// include_once('header.php');

// include_once('index.php');

// if ($_SERVER["REQUEST_METHOD"]==='POST') {
//    if (isset($_POST["cree_un_compte"])) {

//     $nom_utilisateur = $_POST["nom_utilisateur"];
//     $adresse_email = $_POST["adresse_email"];
//     $mot_de_passe = $_POST["mot_de_passe"];
//     $confirmation = $_POST["confirmation"];
//     $date_inscription = date('Y-m-d');
// if ($mot_de_passe === $confirmation) {
//       // ajouter un clients
//       $sql="INSERT INTO utilisateur (nom_utilisateur,adresse_email,mot_de_passe,confirmation,date_inscription)
//       VALUE (:nom_utilisateur,:adresse_email,:mot_de_passe,:confirmation,:date_inscription)";
//       // préparer la requette
//       $requette=$db->prepare($sql);
//       // on inject les valeur
//       $requette->bindValue(":nom_utilisateur" ,$nom_utilisateur,PDO::PARAM_STR);
//       $requette->bindValue(":adresse_email",$adresse_email,PDO::PARAM_STR);
//       $requette->bindValue(":mot_de_passe",$mot_de_passe,PDO::PARAM_STR);
//       $requette->bindValue(":confirmation",$confirmation,PDO::PARAM_STR);
//       $requette->bindValue(":date_inscription",$date_inscription,PDO::PARAM_STR);
//      if ( $requette->execute()) {
//         echo  '<p class="success-message">Bienvenue sur votre nouvelle application Gestionnaire de Tâches pour mieux vous organiser au travail. .<br> connectez-vous et commençer dés maintenant!</p>';
//      }
//          else {
//     echo "oups vos deux mot de passe ne correspond pas ";
// }
//    }elseif (isset($_POST['se_connecter']) ) {
  
//         $nom_connect_utilisateur = $_POST["nom_connect_utilisateur"];
//         $mot_conncet_passe = $_POST["mot_de_passe"];
// $sql=("SELECT * FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur");
//         $query = $db->prepare($sql);
//         $query->bindValue(':nom_utilisateur', $nom_connect_utilisateur, PDO::PARAM_STR);
//         $query->execute();
//         $utilisateur = $query->fetch();
//         if ($utilisateur && $mot_conncet_passe ===  $utilisateur['mot_de_passe']) {
//             echo "Bienvenue sur votre applications."; 
//          } else {
//             die("l'utilisateur et /ou le mot de passe est incorrect");
//          }
//    }      
        
//    }}