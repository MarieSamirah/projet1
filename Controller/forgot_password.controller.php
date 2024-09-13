<?php
// forgot_password.controller.php

include_once '../Model/Database.php';

// Initialiser la connexion
$database = new Database();
$db = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);

    if (empty($username)) {
        $error_message = "Veuillez entrer votre nom d'utilisateur.";
    } else {
        // Vérifier si l'utilisateur existe
        $query = "SELECT id FROM oublier WHERE username = :username LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user_id = $stmt->fetchColumn();

            // Générer un token sécurisé pour la réinitialisation
            $reset_token = bin2hex(random_bytes(50)); 
            $expires_at = date("Y-m-d H:i:s", strtotime('+1 hour')); // Le lien expire dans 1 heure

            // Mettre à jour la base de données avec le token et l'expiration
            $query = "UPDATE oublier SET reset_token = :reset_token, reset_token_expire = :expires_at WHERE id = :user_id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':reset_token', $reset_token);
            $stmt->bindParam(':expires_at', $expires_at);
            $stmt->bindParam(':user_id', $user_id);

            if ($stmt->execute()) {
                // Rediriger vers le formulaire de réinitialisation avec le token
                header("Location: ../View/reset_password.php?token=$reset_token");
                exit;
            } else {
                $error_message = "Une erreur est survenue. Veuillez réessayer.";
            }
        } else {
            $error_message = "Cet utilisateur n'existe pas.";
        }
    }
}
?>
