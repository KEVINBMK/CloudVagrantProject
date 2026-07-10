<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cluster 2 — Apache + PHP</title>
</head>
<body>
    <h1>Cluster 2 — Application PHP (Apache)</h1>
    <p>Serveur : <?php echo gethostname(); ?></p>
    <p>IP : <?php echo $_SERVER['SERVER_ADDR'] ?? 'N/A'; ?></p>
    <p>PHP Version : <?php echo phpversion(); ?></p>
    <p>Équipe : TSHILUMBA TSHILUMBA JONATHAN</p>
</body>
</html>
