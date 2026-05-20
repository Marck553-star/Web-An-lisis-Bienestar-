<style>
:root{
    --azul:#164e63;
    --azul2:#0f766e;
    --verde:#16a34a;
    --naranja:#f59e0b;
    --rojo:#dc2626;
    --fondo:#f4f7f6;
    --texto:#1f2937;
    --card:#ffffff;
}

*{
    box-sizing:border-box;
}

body{
    margin:0;
    font-family:Arial, Helvetica, sans-serif;
    background:var(--fondo);
    color:var(--texto);
}

a{
    color:inherit;
    text-decoration:none;
}

/* =========================
   BANNER
========================= */

header.banner{
    background:linear-gradient(135deg,var(--azul),var(--azul2));
    color:white;
    padding:18px 24px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:18px;
}

.banner-img{
    width:86px;
    height:auto;
    object-fit:contain;
    background:white;
    padding:7px;
    border-radius:10px;
}

.banner-text{
    text-align:center;
    max-width:900px;
}

.banner-text h1{
    margin:0;
    font-size:32px;
}

.banner-text p{
    margin:8px 0 0;
    font-size:16px;
    opacity:.95;
}

/* =========================
   NAV
========================= */

.nav{
    background:white;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
    padding:12px 20px;
    text-align:center;
    position:sticky;
    top:0;
    z-index:10;
}

.nav a{
    display:inline-block;
    margin:4px 8px;
    padding:10px 16px;
    border-radius:999px;
    background:#eef7f6;
    color:var(--azul);
    font-weight:bold;
}

.nav a:hover{
    background:#d1fae5;
}

/* =========================
   CONTENEDOR GENERAL
========================= */

.container{
    max-width:1180px;
    margin:auto;
    padding:38px 20px;
}

/* =========================
   INTRO Y PANELES
========================= */

.intro,
.panel{
    background:white;
    padding:32px 34px;
    border-radius:18px;
    box-shadow:0 4px 14px rgba(0,0,0,.10);
}

.intro{
    margin-bottom:42px;
}

.panel{
    margin-top:20px;
    margin-bottom:35px;
}

.intro h2,
.panel h2{
    color:var(--azul);
    margin-top:0;
    margin-bottom:18px;
}

.intro p,
.panel p{
    font-size:17px;
    line-height:1.65;
    margin-bottom:12px;
}

/* =========================
   TARJETAS DEL MENÚ PRINCIPAL
========================= */

.menu-container{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:28px;
    margin-top:34px;
    margin-bottom:58px; /* separación importante con el panel inferior */
}

.menu-card{
    background:white;
    border-radius:20px;
    padding:32px 28px;
    box-shadow:0 8px 22px rgba(0,0,0,.12);
    transition:.2s ease;
    min-height:170px;
}

.menu-card:hover{
    transform:translateY(-6px);
    box-shadow:0 14px 30px rgba(0,0,0,.18);
}

.menu-card h2{
    color:var(--azul);
    margin:0 0 16px;
    font-size:24px;
}

.menu-card p{
    line-height:1.5;
    margin:0;
    color:#374151;
    font-size:16px;
}

/* =========================
   FILTROS
========================= */

.filters{
    display:flex;
    gap:15px;
    flex-wrap:wrap;
    align-items:center;
    margin-bottom:25px;
}

.filters select,
.filters button{
    padding:11px 14px;
    border:1px solid #cbd5e1;
    border-radius:10px;
    background:white;
    font-size:16px;
}

.filters button{
    background:var(--azul2);
    color:white;
    font-weight:bold;
    cursor:pointer;
}

/* =========================
   TABLAS
========================= */

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 4px 14px rgba(0,0,0,.10);
}

thead{
    background:var(--azul);
    color:white;
}

th,
td{
    padding:14px;
    text-align:center;
    font-size:15px;
}

tbody tr:nth-child(even){
    background:#f1f5f9;
}

tbody tr:hover{
    background:#e8f5f2;
}

.rank{
    font-weight:bold;
    font-size:18px;
}

.link{
    color:var(--azul2);
    font-weight:bold;
}

/* =========================
   TARJETAS DE COMUNIDADES
========================= */

.cards-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
}

.region-card{
    position:relative;
    height:220px;
    border-radius:16px;
    overflow:hidden;
    background:#ddd;
    box-shadow:0 5px 15px rgba(0,0,0,.18);
}

.region-card img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:.25s;
}

.region-card:hover img{
    transform:scale(1.06);
}

.region-title{
    position:absolute;
    bottom:0;
    left:0;
    right:0;
    background:linear-gradient(transparent,rgba(0,0,0,.75));
    color:white;
    padding:42px 16px 16px;
    text-align:center;
    font-size:20px;
    font-weight:bold;
}

/* =========================
   KPIS
========================= */

.kpi-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:18px;
    margin-bottom:28px;
}

.kpi{
    background:white;
    border-radius:16px;
    padding:20px;
    box-shadow:0 4px 14px rgba(0,0,0,.10);
    text-align:center;
}

.kpi h3{
    margin:0 0 8px;
    color:var(--azul);
    font-size:15px;
}

.kpi p{
    margin:0;
    font-size:26px;
    font-weight:bold;
}

.small{
    font-size:13px;
    color:#64748b;
    margin-top:6px;
}

/* =========================
   CLUSTERS
========================= */

.cluster-alto{
    color:#15803d;
    font-weight:bold;
}

.cluster-medio{
    color:#b45309;
    font-weight:bold;
}

.cluster-riesgo{
    color:#b91c1c;
    font-weight:bold;
}

/* =========================
   GRÁFICOS Y BOTONES
========================= */

.chart-box{
    background:white;
    border-radius:18px;
    padding:25px;
    box-shadow:0 4px 14px rgba(0,0,0,.10);
    margin:25px 0;
}

.home{
    text-align:center;
    margin:35px 0;
}

.btn{
    display:inline-block;
    padding:13px 25px;
    background:linear-gradient(135deg,var(--azul),var(--azul2));
    color:white;
    border-radius:999px;
    font-weight:bold;
    box-shadow:0 4px 12px rgba(0,0,0,.18);
}

/* =========================
   FOOTER
========================= */

footer{
    text-align:center;
    background:#dbe4e2;
    padding:18px;
    margin-top:45px;
    color:#334155;
}

/* =========================
   RESPONSIVE
========================= */

@media(max-width:1100px){
    .menu-container{
        grid-template-columns:repeat(2,1fr);
        gap:24px;
        margin-bottom:48px;
    }

    .kpi-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:900px){
    .cards-grid{
        grid-template-columns:1fr;
    }

    .banner-text h1{
        font-size:24px;
    }

    header.banner{
        flex-direction:column;
        text-align:center;
    }

    .banner-img{
        width:70px;
    }

    .container{
        padding:28px 14px;
    }

    th,
    td{
        font-size:13px;
        padding:10px;
    }
}

@media(max-width:700px){
    .menu-container{
        grid-template-columns:1fr;
        gap:22px;
        margin-bottom:42px;
    }

    .menu-card{
        min-height:auto;
        padding:28px 24px;
    }

    .intro,
    .panel{
        padding:26px 24px;
    }

    .kpi-grid{
        grid-template-columns:1fr;
    }
}
</style>