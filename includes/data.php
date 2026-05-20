<?php
function data_file_path() {
    return __DIR__ . '/../data/dataset_web_final_con_cluster.csv';
}

function to_float($value) {
    if ($value === null || $value === '') return null;
    $value = trim((string)$value);
    $value = str_replace('.', '', $value);
    $value = str_replace(',', '.', $value);
    return is_numeric($value) ? (float)$value : null;
}

function load_data() {
    $file = data_file_path();
    $rows = [];
    if (!file_exists($file)) {
        return $rows;
    }

    $handle = fopen($file, 'r');
    if (!$handle) return $rows;

    $headers = fgetcsv($handle, 0, ';');
    if (!$headers) return $rows;
    $headers[0] = preg_replace('/^\xEF\xBB\xBF/', '', $headers[0]);

    while (($data = fgetcsv($handle, 0, ';')) !== false) {
        if (count($data) < count($headers)) continue;
        $row = array_combine($headers, $data);
        $row['periodo'] = (int)$row['periodo'];
        $row['obesidad'] = to_float($row['obesidad']);
        $row['indice_alimentacion'] = to_float($row['indice_alimentacion']);
        $row['porcentaje_empresas'] = to_float($row['porcentaje_empresas']);
        $row['indice_bienestar'] = to_float($row['indice_bienestar']);
        $row['ranking_bienestar'] = (int)$row['ranking_bienestar'];
        $rows[] = $row;
    }
    fclose($handle);
    return $rows;
}

function fmt($value, $decimals = 2) {
    if ($value === null || $value === '') return '—';
    return number_format((float)$value, $decimals, ',', '.');
}

function slug_ccaa($name) {
    $map = [
        'Andalucía' => 'andalucia',
        'Aragón' => 'aragon',
        'Asturias, Principado de' => 'asturias',
        'Balears, Illes' => 'baleares',
        'Canarias' => 'canarias',
        'Cantabria' => 'cantabria',
        'Castilla La Mancha' => 'castilla-la-mancha',
        'Castilla y León' => 'castilla-y-leon',
        'Cataluña' => 'cataluna',
        'Comunitat Valenciana' => 'valencia',
        'Extremadura' => 'extremadura',
        'Galicia' => 'galicia',
        'Madrid, Comunidad de' => 'madrid',
        'Murcia, Región de' => 'murcia',
        'Navarra, Comunidad Foral de' => 'navarra',
        'País Vasco' => 'pais-vasco',
        'Rioja, La' => 'rioja'
    ];
    return $map[$name] ?? strtolower(preg_replace('/[^a-z0-9]+/i', '-', $name));
}

function ccaa_from_slug($slug, $rows) {
    foreach (unique_ccaa($rows) as $ccaa) {
        if (slug_ccaa($ccaa) === $slug) return $ccaa;
    }
    return null;
}

function pretty_ccaa($name) {
    $map = [
        'Madrid, Comunidad de' => 'Comunidad de Madrid',
        'Navarra, Comunidad Foral de' => 'Navarra',
        'Asturias, Principado de' => 'Asturias',
        'Balears, Illes' => 'Islas Baleares',
        'Rioja, La' => 'La Rioja',
        'Comunitat Valenciana' => 'Comunidad Valenciana',
        'Castilla La Mancha' => 'Castilla-La Mancha'
    ];
    return $map[$name] ?? $name;
}

function image_for_ccaa($name) {
    $map = [
        'Andalucía' => 'andalucia.jpg',
        'Aragón' => 'aragon.jpg',
        'Asturias, Principado de' => 'asturias.jpg',
        'Balears, Illes' => 'baleares.jpg',
        'Canarias' => 'canarias.jpg',
        'Cantabria' => 'cantabria.jpg',
        'Castilla La Mancha' => 'cuenca.jpg',
        'Castilla y León' => 'leon.jpg',
        'Cataluña' => 'barcelona.jpg',
        'Comunitat Valenciana' => 'valencia.jpg',
        'Extremadura' => 'extremadura.jpg',
        'Galicia' => 'galicia.jpg',
        'Madrid, Comunidad de' => 'madrid.jpg',
        'Murcia, Región de' => 'murcia.jpg',
        'Navarra, Comunidad Foral de' => 'navarra.jpg',
        'País Vasco' => 'paisvasco.jpg',
        'Rioja, La' => 'rioja.jpg'
    ];
    return $map[$name] ?? 'default.jpg';
}

function unique_years($rows) {
    $years = array_unique(array_column($rows, 'periodo'));
    sort($years);
    return $years;
}

function unique_ccaa($rows) {
    $ccaa = array_unique(array_column($rows, 'CCAA'));
    sort($ccaa, SORT_NATURAL | SORT_FLAG_CASE);
    return $ccaa;
}

function filter_year($rows, $year) {
    return array_values(array_filter($rows, fn($r) => (int)$r['periodo'] === (int)$year));
}

function filter_ccaa($rows, $ccaa) {
    $filtered = array_values(array_filter($rows, fn($r) => $r['CCAA'] === $ccaa));
    usort($filtered, fn($a, $b) => $a['periodo'] <=> $b['periodo']);
    return $filtered;
}

function latest_by_ccaa($rows, $ccaa) {
    $filtered = filter_ccaa($rows, $ccaa);
    return end($filtered) ?: null;
}

function cluster_class($cluster) {
    if ($cluster === 'Perfil saludable alto') return 'cluster-alto';
    if ($cluster === 'Perfil intermedio') return 'cluster-medio';
    return 'cluster-riesgo';
}
?>
