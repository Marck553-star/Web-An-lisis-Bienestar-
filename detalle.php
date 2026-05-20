<?php
require_once __DIR__ . '/includes/data.php';
$rows = load_data();
$slug = $_GET['ccaa'] ?? '';
$ccaa = ccaa_from_slug($slug, $rows);
if (!$ccaa) { http_response_code(404); echo 'Comunidad no encontrada'; exit; }
$serie = filter_ccaa($rows, $ccaa);
$last = end($serie);
$labels = array_column($serie, 'periodo');
$bienestar = array_column($serie, 'indice_bienestar');
$obesidad = array_column($serie, 'obesidad');
$alimentacion = array_column($serie, 'indice_alimentacion');
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title><?= pretty_ccaa($ccaa) ?> · Bienestar</title><?php include __DIR__ . '/includes/styles.php'; ?><script src="https://cdn.jsdelivr.net/npm/chart.js"></script></head>
<body>
<header class="banner"><img src="logo1.jpg" class="banner-img"><div class="banner-text"><h1><?= pretty_ccaa($ccaa) ?></h1><p>Detalle autonómico de bienestar alimentario y salud</p></div><img src="logo2.jpg" class="banner-img"></header>
<nav class="nav"><a href="index.php">Inicio</a><a href="ranking.php">Ranking</a><a href="autonoma.php">Comunidades</a><a href="clusters.php">Perfiles</a><a href="comparador.php">Comparador</a></nav>
<div class="container">
    <div class="intro">
        <h2>Resumen 2022</h2>
        <p>
            <?= pretty_ccaa($ccaa) ?> pertenece al grupo <span class="<?= cluster_class($last['nombre_cluster']) ?>"><?= $last['nombre_cluster'] ?></span>. 
            En 2022 ocupa la posición <strong><?= $last['ranking_bienestar'] ?></strong> del ranking autonómico, con un índice de bienestar de <strong><?= fmt($last['indice_bienestar']) ?></strong> puntos.
        </p>
    </div>

    <div class="kpi-grid">
        <div class="kpi"><h3>Ranking 2022</h3><p><?= $last['ranking_bienestar'] ?></p><div class="small">1 = mejor posición</div></div>
        <div class="kpi"><h3>Índice bienestar</h3><p><?= fmt($last['indice_bienestar']) ?></p><div class="small">escala 0-100</div></div>
        <div class="kpi"><h3>Obesidad</h3><p><?= fmt($last['obesidad']) ?>%</p><div class="small">menor es mejor</div></div>
        <div class="kpi"><h3>Alimentación</h3><p><?= fmt($last['indice_alimentacion']) ?></p><div class="small">índice alimentario</div></div>
    </div>

    <div class="chart-box"><canvas id="evolucion"></canvas></div>

    <table>
        <thead><tr><th>Año</th><th>Ranking</th><th>Bienestar</th><th>Alimentación</th><th>Obesidad</th><th>Empresas dep.</th></tr></thead>
        <tbody>
        <?php foreach ($serie as $r): ?>
            <tr><td><?= $r['periodo'] ?></td><td><?= $r['ranking_bienestar'] ?></td><td><?= fmt($r['indice_bienestar']) ?></td><td><?= fmt($r['indice_alimentacion']) ?></td><td><?= fmt($r['obesidad']) ?>%</td><td><?= fmt($r['porcentaje_empresas']) ?>%</td></tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="home"><a class="btn" href="autonoma.php">Volver a comunidades</a></div>
</div>
<script>
const ctx = document.getElementById('evolucion');
new Chart(ctx, {type:'line',data:{labels:<?= json_encode($labels) ?>,datasets:[{label:'Índice de bienestar',data:<?= json_encode($bienestar) ?>,borderWidth:3,tension:.25},{label:'Índice de alimentación',data:<?= json_encode($alimentacion) ?>,borderWidth:2,tension:.25},{label:'Obesidad (%)',data:<?= json_encode($obesidad) ?>,borderWidth:2,tension:.25}]},options:{responsive:true,plugins:{title:{display:true,text:'Evolución 2010-2022'},legend:{position:'bottom'}},scales:{y:{beginAtZero:false}}}});
</script>
<footer>Proyecto · Detalle autonómico · 2010-2022</footer>
</body></html>
