<!-- reset_password.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
</head>
<body>
    <?php if (isset($_GET['token'])): ?>
        <form action="../Controller/reset_password.controller.php" method="POST">
                            <div class="form-group">
                                <label for="token">Jeton de réinitialisation :</label>
                                <input type="text" id="token" name="token" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">Nouveau mot de passe :</label>
                                <input type="password" id="new_password" name="new_password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Réinitialiser le mot de passe</button>
                        </form>
    <?php else: ?>
        <p>Token de réinitialisation invalide.</p>
    <?php endif; ?>
</body>
</html>
