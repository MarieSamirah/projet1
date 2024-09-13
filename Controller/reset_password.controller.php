<?php
// Inclure la connexion à la base de données
include_once '../Model/Database.php';

// Initialiser la connexion
$database = new Database();
$db = $database->getConnection();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $reset_token = trim($_POST['token']);
    $new_password = trim($_POST['new_password']);
    
    // Valider les champs
    if (empty($reset_token) || empty($new_password)) {
        $error_message = "Tous les champs sont obligatoires.";
    } else {
        // Vérifier si le jeton est valide
        $query = "SELECT * FROM oublier WHERE reset_token = :reset_token AND reset_token_expire > NOW() LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':reset_token', $reset_token);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Hacher le nouveau mot de passe
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            
            // Mettre à jour le mot de passe
            $update_query = "UPDATE oublier  SET password = :new_password, reset_token = NULL, reset_token_expire = NULL WHERE reset_token = :reset_token";
            $update_stmt = $db->prepare($update_query);
            $update_stmt->bindParam(':new_password', $hashed_password);
            $update_stmt->bindParam(':reset_token', $reset_token);

            if ($update_stmt->execute()) {
                echo "Votre mot de passe a été réinitialisé avec succès.";
            } else {
                $error_message = "Erreur lors de la réinitialisation du mot de passe.";
            }
        } else {
            $error_message = "Jeton de réinitialisation invalide ou expiré.";
        }
    }
}
?>
