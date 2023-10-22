<?php
session_start();
require("connection.php");

$nom_utilisateur_error = $mot_de_passe_error = $confirmation_error = $adresse_email_error = "";

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    if (isset($_POST["inscription"])) {
        $nom_utilisateur = $_POST["nom_utilisateur"];
        $adresse_email = $_POST["adresse_email"];
        $mot_de_passe = $_POST["mot_de_passe"];
        $confirmation = $_POST["confirmation"];
        $date_inscription = date('Y-m-d');

        // Validation du nom d'utilisateur (uniquement des lettres)
        if (!preg_match('/^[A-Za-z]+$/', $nom_utilisateur)) {
            $nom_utilisateur_error = 'Le nom d\'utilisateur doit contenir uniquement des lettres.';
        }

        // Validation de l'adresse e-mail
        if (!filter_var($adresse_email, FILTER_VALIDATE_EMAIL)) {
            $adresse_email_error = 'L\'adresse e-mail n\'est pas au format correct.';
        }

        // Validation du mot de passe (lettre majuscule, chiffres, caractères spéciaux)
        if (!preg_match('/^(?=.*[A-Z])(?=.*[0-9!@#$%^&*])\w+$/', $mot_de_passe)) {
            $mot_de_passe_error = 'Le mot de passe doit commencer par une lettre majuscule, contenir des chiffres et des caractères spéciaux.';
        }

        if ($mot_de_passe === $confirmation && empty($nom_utilisateur_error) && empty($adresse_email_error) && empty($mot_de_passe_error)) {
            // Ajouter un client
            $sql = "INSERT INTO utilisateur (nom_utilisateur, adresse_email, mot_de_passe, date_inscription)
                    VALUES (:nom_utilisateur, :adresse_email, :mot_de_passe, :date_inscription)";
            $requette = $db->prepare($sql);
            $requette->bindValue(":nom_utilisateur", $nom_utilisateur, PDO::PARAM_STR);
            $requette->bindValue(":adresse_email", $adresse_email, PDO::PARAM_STR);
            $requette->bindValue(":mot_de_passe", $mot_de_passe, PDO::PARAM_STR);
            $requette->bindValue(":date_inscription", $date_inscription, PDO::PARAM_STR);

            if ($requette->execute()) {
                echo '<p class="success-message">Bienvenue sur votre nouvelle application Gestionnaire de Tâches pour mieux vous organiser au travail. .<br> connectez-vous et commencer dès maintenant!</p>';
            }
        }
    }  elseif (isset($_POST["connexion"])) {
        $nom_connect_utilisateur = $_POST["utilisateur"];
        $mot_conncet_passe = $_POST["password"];

        $sql = "SELECT * FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur";
        $query = $db->prepare($sql);
        $query->bindValue(':nom_utilisateur', $nom_connect_utilisateur);
        $query->execute();
        $utilisateur = $query->fetch(PDO:: FETCH_ASSOC );

        if ($utilisateur && $mot_conncet_passe === $utilisateur["mot_de_passe"]) {
            // Connexion réussie
            $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
            $_SESSION['nom_utilisateur'] = $utilisateur['nom_utilisateur'];
            echo "Bienvenue sur votre application.";
            header('location: gestiontache.php');
            exit();
        } else {
            echo "L'utilisateur et/ou le mot de passe est incorrect";
        }
    }}
          
        
        
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Acceuil</title>
   
</head>
<?php include_once('header.php');?>
<body>   
<div class="formulaire_général">
<div class="formulaire_contenaire1">
    <form action="index.php"  method="POST">
    <h2>Créer un compte</h2>
        <div class="formulaire_input_label1">
        <label for="nom_utilisateur" class="labelle">Nom d'utilisateur :</label>
        <input class="inputtype" type="text" name="nom_utilisateur" id="nom_utilisateur" require><br>
        <span class="error-message"><?php echo $nom_utilisateur_error; ?></span><br>
        <label  for="adresse_email" class="labelle">Adresse email :</label>
        <input class="inputtype" type="text" name="adresse_email" id="adresse_email" require><br>
        <span class="error-message"><?php echo $adresse_email_error; ?></span>

        <label class="labelle" for="mot_de_passe">Mot de passe :</label>
        <input class="inputtype" type="password" name="mot_de_passe" id="mot_de_passe" require><br>
        <span class="error-message"><?php echo $mot_de_passe_error; ?></span>

        <label  for="confirmation" class="labelle">Confirmation :</label>
        <input class="inputtype" type="text" name="confirmation" id="confirmation" require><br>
        <span class="error-message"><?php echo $confirmation_error; ?></span>
        <div class="submit2">
        <input class="sumit" type="submit" name="inscription" id="créer_un_compte" value="Créer un compte">
        </div>
        </div>
    </form>
    </div>
   
    <div class="formulaire_contenaire2">
        <form action="" method="POST">
         <div class="formulaire_input_label2">
         <h3>Connexion</h3>
            <label for="nom_connect_utilisateur" class="label_connection">Nom d'utilisateur :</label>
            <input  class="inpute" type="text" name="utilisateur" id="nom_connect_utilisateur">
           <label for="mot_connect_passe" class="label_connection">Mot de passe :</label>
           <input  class="inpute" type="password" name="password" id="mot_connect_passe">
           <div class="submit1">
           <input   class="sumit" type="submit" name="connexion" value="Se connecter">
           </div>
            </div>
       
            </form>
   </div>
</div>
    
</body>
</html>