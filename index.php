<?php require_once __DIR__ . '/includes/data.php'; $rows = load_data(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Bienestar alimentario en España</title>
<?php include __DIR__ . '/includes/styles.php'; ?>
</head>
<body>
<header class="banner">
    <img src="logo1.jpg" class="banner-img" alt="ETSINF">
    <div class="banner-text">
        <h1>Bienestar alimentario y salud en España</h1>
        <p>Ranking autonómico basado en alimentación, obesidad y entorno deportivo · 2010-2022</p>
    </div>
    <img src="logo2.jpg" class="banner-img" alt="UPV">
</header>
<nav class="nav">
    <a href="index.php">Inicio</a>
    <a href="ranking.php">Ranking</a>
    <a href="autonoma.php">Comunidades</a>
    <a href="clusters.php">Perfiles</a>
    <a href="comparador.php">Comparador</a>
</nav>

<div class="container">
    <div class="intro">
        <h2>Proyecto de análisis territorial</h2>
        <p>
            Esta web muestra la evolución del bienestar alimentario y sanitario de las comunidades autónomas españolas entre 2010 y 2022. 
            El índice final combina tres dimensiones: calidad de la alimentación, obesidad invertida y peso relativo de empresas deportivas.
        </p>
        <p>
            El objetivo no es medir la salud completa de una región, sino construir una herramienta visual para comparar territorios, detectar diferencias regionales y facilitar la interpretación de los resultados obtenidos en el análisis estadístico.
        </p>
    </div>

    <div class="menu-container">
        <a href="ranking.php" class="menu-card">
            <h2>📊 Ranking</h2>
            <p>Consulta la clasificación anual de comunidades según el índice de bienestar.</p>
        </a>
        <a href="autonoma.php" class="menu-card">
            <h2>🌍 Comunidades</h2>
            <p>Explora la ficha individual de cada comunidad autónoma y su evolución temporal.</p>
        </a>
        <a href="clusters.php" class="menu-card">
            <h2>🧩 Perfiles</h2>
            <p>Visualiza los grupos territoriales: saludable alto, intermedio y riesgo.</p>
        </a>
        <a href="comparador.php" class="menu-card">
            <h2>⚖️ Comparador</h2>
            <p>Compara dos comunidades por alimentación, obesidad, empresas y bienestar.</p>
        </a>
    </div>

    <div class="panel">
        <h2>Cómo se calcula el índice</h2>
        <p>
            El índice de bienestar se calcula como una puntuación de 0 a 100. La fórmula utilizada es: 
            <strong>50% índice de alimentación + 40% obesidad invertida + 10% empresas deportivas</strong>. 
            La obesidad se invierte porque en un ranking de bienestar una menor obesidad debe sumar más puntos.
        </p>
    </div>
</div>
<footer>Proyecto · Bienestar alimentario autonómico · 2010-2022</footer>
</body>
</html>
