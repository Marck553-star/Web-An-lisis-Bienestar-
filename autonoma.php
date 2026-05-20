<?php require_once __DIR__ . '/includes/data.php'; $rows = load_data(); $ccaas = unique_ccaa($rows); ?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Explorar comunidades</title><?php include __DIR__ . '/includes/styles.php'; ?></head>
<body>
<header class="banner"><img src="logo1.jpg" class="banner-img"><div class="banner-text"><h1>Explorar por comunidad autónoma</h1><p>Ficha individual con evolución de bienestar, obesidad y alimentación</p></div><img src="logo2.jpg" class="banner-img"></header>
<nav class="nav"><a href="index.php">Inicio</a><a href="ranking.php">Ranking</a><a href="autonoma.php">Comunidades</a><a href="clusters.php">Perfiles</a><a href="comparador.php">Comparador</a></nav>
<div class="container">
    <div class="cards-grid">
        <?php foreach ($ccaas as $ccaa): ?>
            <a href="detalle.php?ccaa=<?= slug_ccaa($ccaa) ?>" class="region-card">
                <img src="<?= image_for_ccaa($ccaa) ?>" alt="<?= pretty_ccaa($ccaa) ?>">
                <div class="region-title"><?= pretty_ccaa($ccaa) ?></div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<footer>Proyecto · Fichas por comunidad · 2010-2022</footer>
</body></html>
