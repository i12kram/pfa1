<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mot_de_passe'];

    // Connexion à la base de données
    $serveur = "localhost";
    $utilisateur = "root";
    $mdp_bdd = ""; 
    $nom_bdd = "pfa1";

    // Connexion à la base de données
    $connexion = new mysqli($serveur, $utilisateur, $mdp_bdd, $nom_bdd);

    // Vérification de la connexion
    if ($connexion->connect_error) {
        die("La connexion a échoué : " . $connexion->connect_error);
    }

    if ($_POST['role'] == 'ouvrier'){
        $requete = "INSERT INTO ouvrier (nom, prenom, email, motdepasse) VALUES ('$nom', '$prenom', '$email', '$mdp')";
        if ($connexion->query($requete) === TRUE) {
            echo "Inscription réussie!";
        } else {
            echo "Erreur lors de l'inscription: " . $connexion->error;
        }

    }
    else if ($_POST['role'] == 'client'){
        $requete = "INSERT INTO client (nom, prenom, email, motdepasse) VALUES ('$nom', '$prenom', '$email', '$mdp')";
        if ($connexion->query($requete) === TRUE) {
            echo "Inscription réussie!";
        } else {
            echo "Erreur lors de l'inscription: " . $connexion->error;
        }
    }

    // Fermeture de la connexion à la base de données
    $connexion->close();
}
?>
