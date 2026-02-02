<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>LifeOS – Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<header>
    <h1>LifeOS</h1>
    <p>Connecté en tant que <strong><?= htmlspecialchars($user['email']) ?></strong></p>
    <a href="index.php?page=logout">Se déconnecter</a>
    <hr>
</header>

<main>
    <h2>Tableau de bord</h2>

    <section>
        <p>Bienvenue sur ton LifeOS.</p>
        <p>Ici tu géreras bientôt :</p>
        <ul>
            <li>tes tâches</li>
            <li>tes notes</li>
            <li>ta progression</li>
        </ul>
    </section>

    <section>
        <h3>Ajouter une tâche</h3>

        <form method="POST" action="index.php?page=add-task">
            <input
                type="text"
                name="title"
                placeholder="Nouvelle tâche"
                required
            >
            <button type="submit">Ajouter</button>
        </form>
    </section>

    <section>
       <h3>Mes tâches</h3>

       <?php if (empty($tasks)): ?>
           <p>Aucune tâche pour le moment.</p>
       <?php else: ?>
           <ul>
               <?php foreach ($tasks as $task): ?>
                   <li>
                       <?= htmlspecialchars($task['title']) ?>
                       <?= $task['is_done'] ? '✅' : '🕒' ?>
                   </li>
               <?php endforeach; ?>
           </ul>
       <?php endif; ?>
    </section>

</main>

</body>
</html>
