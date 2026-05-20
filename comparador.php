<?php
require_once __DIR__ . '/includes/data.php';
$rows = load_data();
$ccaas = unique_ccaa($rows);
$years = unique_years($rows);
$year = isset($_GET['year']) ? (int)$_GET['year'] : max($years);
$ccaa1 = $_GET['ccaa1'] ?? ($ccaas[0] ?? '');
$ccaa2 = $_GET['ccaa2'] ?? ($ccaas[1] ?? '');
function row_for($rows, $ccaa, $year){ foreach($rows as $r){ if($r['CCAA']===$ccaa && (int)$r['periodo']===(int)$year) return $r; } return null; }
$r1 = row_for($rows,$ccaa1,$year); $r2 = row_for($rows,$ccaa2,$year);
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Comparador de comunidades</title><?php include __DIR__ . '/includes/styles.php'; ?></head>
<body>
<header class="banner"><img src="logo1.jpg" class="banner-img"><div class="banner-text"><h1>Comparador de comunidades</h1><p>Compara dos territorios en un mismo año</p></div><img src="logo2.jpg" class="banner-img"></header>
<nav class="nav"><a href="index.php">Inicio</a><a href="ranking.php">Ranking</a><a href="autonoma.php">Comunidades</a><a href="clusters.php">Perfiles</a><a href="comparador.php">Comparador</a></nav>
<div class="container">
    <form class="filters" method="get">
        <label><strong>Año:</strong></label><select name="year"><?php foreach($years as $y): ?><option value="<?= $y ?>" <?= $y==$year?'selected':'' ?>><?= $y ?></option><?php endforeach; ?></select>
        <label><strong>Comunidad 1:</strong></label><select name="ccaa1"><?php foreach($ccaas as $c): ?><option value="<?= htmlspecialchars($c) ?>" <?= $c==$ccaa1?'selected':'' ?>><?= pretty_ccaa($c) ?></option><?php endforeach; ?></select>
        <label><strong>Comunidad 2:</strong></label><select name="ccaa2"><?php foreach($ccaas as $c): ?><option value="<?= htmlspecialchars($c) ?>" <?= $c==$ccaa2?'selected':'' ?>><?= pretty_ccaa($c) ?></option><?php endforeach; ?></select>
        <button type="submit">Comparar</button>
    </form>
    <table>
        <thead><tr><th>Indicador</th><th><?= pretty_ccaa($ccaa1) ?></th><th><?= pretty_ccaa($ccaa2) ?></th></tr></thead>
        <tbody>
            <tr><td>Ranking bienestar</td><td><?= $r1['ranking_bienestar'] ?? '—' ?></td><td><?= $r2['ranking_bienestar'] ?? '—' ?></td></tr>
            <tr><td>Índice bienestar</td><td><?= fmt($r1['indice_bienestar'] ?? null) ?></td><td><?= fmt($r2['indice_bienestar'] ?? null) ?></td></tr>
            <tr><td>Índice alimentación</td><td><?= fmt($r1['indice_alimentacion'] ?? null) ?></td><td><?= fmt($r2['indice_alimentacion'] ?? null) ?></td></tr>
            <tr><td>Obesidad</td><td><?= fmt($r1['obesidad'] ?? null) ?>%</td><td><?= fmt($r2['obesidad'] ?? null) ?>%</td></tr>
            <tr><td>Empresas deportivas</td><td><?= fmt($r1['porcentaje_empresas'] ?? null) ?>%</td><td><?= fmt($r2['porcentaje_empresas'] ?? null) ?>%</td></tr>
            <tr><td>Perfil territorial</td><td class="<?= cluster_class($r1['nombre_cluster'] ?? '') ?>"><?= $r1['nombre_cluster'] ?? '—' ?></td><td class="<?= cluster_class($r2['nombre_cluster'] ?? '') ?>"><?= $r2['nombre_cluster'] ?? '—' ?></td></tr>
        </tbody>
    </table>
</div>
<footer>Proyecto · Comparador autonómico · 2010-2022</footer>
</body></html>
