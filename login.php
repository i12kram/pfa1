<?php
// Configuration de la base de données
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'pfa1';

// Établir une connexion à la base de données
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Vérifier que les champs Email et Password sont bien envoyés
if (isset($_POST['Email']) && isset($_POST['motdepasse'])) {
    $email = $_POST['Email'];
    $password = $_POST['mot_de_passe'];

    // Requête pour récupérer le hash du mot de passe en base de données
    $stmt = $conn->prepare("SELECT ID_ouvrier, motdepasse FROM ouvrier WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Vérifier si l'utilisateur existe
    if ($row) {
        $stored_hash = $row['motdepasse'];
        
        // Comparer le mot de passe saisi avec le hash stocké en base de données
        if (password_verify($password, $stored_hash)) {
            session_start();
            $_SESSION['user_id'] = $row['ID_ouvrier'];
            // Authentification réussie
            header('Location: acceuil.html');
            exit; // Terminer l'exécution du script après la redirection
        } else {
            // Mot de passe incorrect
            echo "Email ou mot de passe incorrect";
        }
    } else {
        // Utilisateur non trouvé
        echo "Email ou mot de passe incorrect";
    }

    // Fermer la connexion
    $stmt->close();
} else {
    echo "Les champs Email et Password sont requis.";
}

$conn->close();
?>
