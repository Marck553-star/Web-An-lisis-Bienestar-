<?php
require_once __DIR__ . '/includes/data.php';
$rows = load_data();
$years = unique_years($rows);
$year = isset($_GET['year']) ? (int)$_GET['year'] : max($years);
$ranking = filter_year($rows, $year);
usort($ranking, fn($a, $b) => $a['ranking_bienestar'] <=> $b['ranking_bienestar']);
$media = count($ranking) ? array_sum(array_column($ranking, 'indice_bienestar')) / count($ranking) : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Ranking de bienestar autonómico</title><?php include __DIR__ . '/includes/styles.php'; ?></head>
<body>
<header class="banner"><img src="logo1.jpg" class="banner-img"><div class="banner-text"><h1>Ranking de bienestar autonómico</h1><p>Clasificación anual según alimentación, obesidad y entorno deportivo</p></div><img src="logo2.jpg" class="banner-img"></header>
<nav class="nav"><a href="index.php">Inicio</a><a href="ranking.php">Ranking</a><a href="autonoma.php">Comunidades</a><a href="clusters.php">Perfiles</a><a href="comparador.php">Comparador</a></nav>
<div class="container">
    <form class="filters" method="get">
        <label><strong>Año:</strong></label>
        <select name="year">
            <?php foreach ($years as $y): ?><option value="<?= $y ?>" <?= $y == $year ? 'selected' : '' ?>><?= $y ?></option><?php endforeach; ?>
        </select>
        <button type="submit">Actualizar</button>
    </form>

    <div class="kpi-grid">
        <div class="kpi"><h3>Mejor comunidad</h3><p><?= pretty_ccaa($ranking[0]['CCAA'] ?? '—') ?></p><div class="small">Ranking 1</div></div>
        <div class="kpi"><h3>Índice más alto</h3><p><?= fmt($ranking[0]['indice_bienestar'] ?? null) ?></p><div class="small">sobre 100</div></div>
        <div class="kpi"><h3>Media del año</h3><p><?= fmt($media) ?></p><div class="small">índice medio</div></div>
        <div class="kpi"><h3>Comunidades</h3><p><?= count($ranking) ?></p><div class="small">CCAA analizadas</div></div>
    </div>

    <table>
        <thead><tr><th>Posición</th><th>Comunidad</th><th>Bienestar</th><th>Alimentación</th><th>Obesidad</th><th>Empresas dep.</th><th>Perfil</th><th>Detalle</th></tr></thead>
        <tbody>
        <?php foreach ($ranking as $r): ?>
            <tr>
                <td class="rank"><?= $r['ranking_bienestar'] == 1 ? '🥇 ' : ($r['ranking_bienestar'] == 2 ? '🥈 ' : ($r['ranking_bienestar'] == 3 ? '🥉 ' : '')) ?><?= $r['ranking_bienestar'] ?></td>
                <td><?= pretty_ccaa($r['CCAA']) ?></td>
                <td><strong><?= fmt($r['indice_bienestar']) ?></strong></td>
                <td><?= fmt($r['indice_alimentacion']) ?></td>
                <td><?= fmt($r['obesidad']) ?>%</td>
                <td><?= fmt($r['porcentaje_empresas']) ?>%</td>
                <td class="<?= cluster_class($r['nombre_cluster']) ?>"><?= $r['nombre_cluster'] ?></td>
                <td><a class="link" href="detalle.php?ccaa=<?= slug_ccaa($r['CCAA']) ?>">Ver más</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<footer>Proyecto · Ranking de bienestar autonómico · 2010-2022</footer>
</body></html>
