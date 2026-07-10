<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cluster 1 — Nginx + PHP</title>
</head>
<body>
    <h1>Cluster 1 — Application PHP (Nginx)</h1>
    <p>Serveur : <?php echo gethostname(); ?></p>
    <p>IP : <?php echo $_SERVER['SERVER_ADDR'] ?? 'N/A'; ?></p>
    <p>PHP Version : <?php echo phpversion(); ?></p>
    <p>Équipe : SIKU EMEDI JOSE</p>
</body>
</html>
