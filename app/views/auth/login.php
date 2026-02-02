<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>LifeOS - Login</title>
</head>
<body>
    <h1>Connexion à LifeOS</h1>
    <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    <form method="post" action="index.php?page=login">
        <label>Email : <input type="email" name="email" required></label><br><br>
        <label>Mot de passe : <input type="password" name="password" required></label><br><br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>

