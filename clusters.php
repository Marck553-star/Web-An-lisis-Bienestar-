<?php
require_once __DIR__ . '/includes/data.php';
$rows = load_data();
$latestYear = max(unique_years($rows));
$latest = filter_year($rows, $latestYear);
$groups = [];
foreach ($latest as $r) { $groups[$r['nombre_cluster']][] = $r; }
$order = ['Perfil saludable alto','Perfil intermedio','Perfil de riesgo'];
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Perfiles territoriales</title><?php include __DIR__ . '/includes/styles.php'; ?></head>
<body>
<header class="banner"><img src="logo1.jpg" class="banner-img"><div class="banner-text"><h1>Perfiles territoriales</h1><p>Agrupación de comunidades según bienestar, alimentación, obesidad y empresas deportivas</p></div><img src="logo2.jpg" class="banner-img"></header>
<nav class="nav"><a href="index.php">Inicio</a><a href="ranking.php">Ranking</a><a href="autonoma.php">Comunidades</a><a href="clusters.php">Perfiles</a><a href="comparador.php">Comparador</a></nav>
<div class="container">
    <div class="intro"><h2>Clustering por CCAA</h2><p>Las comunidades se agrupan en tres perfiles: saludable alto, intermedio y riesgo. Esta clasificación resume patrones parecidos en índice de bienestar, alimentación, obesidad y entorno deportivo.</p></div>
    <?php foreach ($order as $cluster): $items = $groups[$cluster] ?? []; ?>
        <div class="panel">
            <h2 class="<?= cluster_class($cluster) ?>"><?= $cluster ?></h2>
            <table>
                <thead><tr><th>Comunidad</th><th>Ranking <?= $latestYear ?></th><th>Bienestar</th><th>Alimentación</th><th>Obesidad</th><th>Detalle</th></tr></thead>
                <tbody>
                <?php foreach ($items as $r): ?>
                    <tr><td><?= pretty_ccaa($r['CCAA']) ?></td><td><?= $r['ranking_bienestar'] ?></td><td><?= fmt($r['indice_bienestar']) ?></td><td><?= fmt($r['indice_alimentacion']) ?></td><td><?= fmt($r['obesidad']) ?>%</td><td><a class="link" href="detalle.php?ccaa=<?= slug_ccaa($r['CCAA']) ?>">Ver más</a></td></tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
</div>
<footer>Proyecto · Perfiles territoriales · 2010-2022</footer>
</body></html>
