<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cluster 2 — Apache + PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 2rem;
            background: #f5f7fb;
            color: #1f2937;
        }
        .card {
            max-width: 720px;
            margin: auto;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }
        h1, h2 { color: #0f766e; }
        p { margin: 0.6rem 0; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Cluster 2</h1>
        <h2>Apache + PHP</h2>
        <p><strong>Serveur :</strong> <?php echo htmlspecialchars(gethostname()); ?></p>
        <p><strong>Adresse IP :</strong> <?php echo htmlspecialchars($_SERVER['SERVER_ADDR'] ?? 'N/A'); ?></p>
        <p><strong>Version PHP :</strong> <?php echo htmlspecialchars(phpversion()); ?></p>
        <p><strong>Nom :</strong> TSHILUMBA TSHILUMBA JONATHAN</p>
    </div>
</body>
</html>
