if ($_SERVER["REQUEST_METHOD"]==='POST') {
    if (isset($_POST["inscription"])) {
     $nom_utilisateur = $_POST["nom_utilisateur"];
     $adresse_email = $_POST["adresse_email"];
     $mot_de_passe = $_POST["mot_de_passe"];
     $confirmation = $_POST["confirmation"];
     $date_inscription = date('Y-m-d');
   
     if (empty($nom_utilisateur) || !preg_match('/^[A-Za-z]*$/', $nom_utilisateur)) {
        $nom_utilisateur_error = 'Le nom d\'utilisateur doit contenir uniquement des lettres (majuscules ou minuscules).';
    }else  if (isset($_POST["connexion"]) ){
                        $nom_connect_utilisateur = $_POST["utilisateur"];
                        $mot_conncet_passe = $_POST["mot_de_passe"];
                    $sql="SELECT * FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur";
                        $query = $db->prepare($sql);
                        $query->bindValue(':nom_utilisateur', $nom_connect_utilisateur, PDO::PARAM_STR);
                        $query->execute();
                        $utilisateur = $query->fetchAll();
                        if ($utilisateur && $mot_conncet_passe ===  $utilisateur['mot_de_passe']) {
                            echo "Bienvenue sur votre applications."; 
                        } else {
                            echo "l'utilisateur et /ou le mot de passe est incorrect";
                        }
                }

    if (empty($mot_de_passe)) {
        $mot_de_passe_error = 'Le mot de passe ne peut pas être vide.';
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$/', $mot_de_passe)) {
        $mot_de_passe_error = 'Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule et un chiffre.';
    }

    if ($confirmation != $mot_de_passe) {
        $confirmation_error = 'Ce n\'est pas le même mot de passe.';
    }

    if (empty($adresse_email) || !filter_var($adresse_email, FILTER_VALIDATE_EMAIL)) {
        $adresse_email_error = 'L\'adresse e-mail n\'est pas au format correct (exemple : exemple@domaine.com).';
    }
    // Vérification de toutes les erreurs
    if (empty($nom_utilisateur_error) && empty($mot_de_passe_error) && empty($confirmation_error) && empty($adresse_email_error)) {
        echo '<p class="success-message">Bienvenue sur votre nouvelle application Gestionnaire de Tâches pour mieux vous organiser au travail.</p>';
         if ($mot_de_passe === $confirmation) {
            // ajouter un clients
            $sql="INSERT INTO utilisateur (nom_utilisateur,adresse_email,mot_de_passe,date_inscription)
            VALUES (:nom_utilisateur,:adresse_email,:mot_de_passe,:date_inscription)";
            // préparer la requette
            $requette=$db->prepare($sql);
            // on inject les valeur
            $requette->bindValue(":nom_utilisateur" ,$nom_utilisateur,PDO::PARAM_STR);
            $requette->bindValue(":adresse_email",$adresse_email,PDO::PARAM_STR);
            $requette->bindValue(":mot_de_passe",$mot_de_passe,PDO::PARAM_STR);
            $requette->bindValue(":date_inscription",$date_inscription,PDO::PARAM_STR);
        if ($requette->execute()) {
            echo  '<p class="success-message">Bienvenue sur votre nouvelle application Gestionnaire de Tâches pour mieux vous organiser au travail. .<br> connectez-vous et commençer dés maintenant!</p>';
        }
     } else {
       echo "oups vos deux mot de passe ne correspond pas ";}
    }
}

    }      
         

    if (isset($_POST["connexion"])) {
    $nom_connect_utilisateur = $_POST["utilisateur"];
    $mot_conncet_passe = $_POST["password"];
    $sql = "SELECT * FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur";
    $query = $db->prepare($sql);
    $query->bindValue(':nom_utilisateur', $nom_connect_utilisateur);
    $query->execute();
    $utilisateur = $query->fetch(); // Utilisez fetch() pour obtenir la première ligne du résultat

    if ($utilisateur && $mot_conncet_passe === $utilisateur["mot_de_passe"]) {
        echo "Bienvenue sur votre application.";
    } else {
        echo "L'utilisateur et/ou le mot de passe est incorrect";
    }
}
