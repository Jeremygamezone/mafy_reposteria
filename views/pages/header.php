<head>
    <meta name="description" content="Sistema administrativo de repostería">

   
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Repostería">
    <meta property="og:title" content="Sistema administrativo de repostería">

    <title>Repostería</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  
    <link rel="stylesheet" type="text/css" href="../public/css/main.css">

    
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    >
</head>
    <h1>Reposteria</h1>
<header class="app-header">

</header>

<style>
:root {
    /* Paleta de la marca */
    --bs-pink-light: #ED96D7;
    --bs-pink-dark: #B32E6C;
    --bs-wine: #92003A;
    --bs-wine-darker: #3a0319;
    --bs-yellow-light: #FFE185;

    /* Bootstrap: color principal */
    --bs-primary: var(--bs-wine);
    --bs-primary-rgb: 146, 0, 58;
    --bs-primary-text-emphasis: #6A002A;
    --bs-primary-bg-subtle: #F8DDE9;
    --bs-primary-border-subtle: #E9A5C0;

    /* Enlaces y foco */
    --bs-link-color: var(--bs-wine);
    --bs-link-color-rgb: 146, 0, 58;
    --bs-link-hover-color: var(--bs-pink-dark);
    --bs-link-hover-color-rgb: 179, 46, 108;
    --bs-focus-ring-color: rgba(179, 46, 108, 0.25);

    /* Superficies */
    --bs-body-bg: #FFF9FC;
    --bs-body-color: #38232D;
    --bs-border-color: #F0D6E3;
}

main {
    padding: 20px;
    color: #38232D;
}

/* Fondo general */
body {
    background-color: #340005;
    color: #38232D;
}

/* Barra superior */
.app-header {
    background-color: var(--bs-wine);
    box-shadow: 0 2px 10px rgba(146, 0, 58, 0.18);
}

.app-header__logo {
    color: #FFFFFF;
}

.app-header__logo:hover,
.app-header__logo:focus {
    color: var(--bs-yellow-light);
}

/* Menú lateral */
.app-sidebar {
    background-color: var(--bs-wine);
}

.app-sidebar__user {
    color: #FFFFFF;
    border-bottom: 1px solid rgba(255, 255, 255, 0.18);
}

.app-menu__item {
    color: #FFFFFF;
    border-left-color: transparent;
}

.app-menu__item.active,
.app-menu__item:hover,
.app-menu__item:focus {
    color: #FFFFFF;
    background-color: var(--bs-pink-dark);
    border-left-color: var(--bs-yellow-light);
}

/* Submenús */
.treeview-menu {
    background-color: #70002D;
}

.treeview.is-expanded [data-toggle="treeview"] {
    background-color: var(--bs-pink-dark);
    border-left-color: var(--bs-yellow-light);
}

.treeview-item {
    color: #FFFFFF;
}

.treeview-item.active,
.treeview-item:hover,
.treeview-item:focus {
    color: #FFFFFF;
    background-color: var(--bs-pink-dark);
}

.title-font{
    color: #fff;
  text-align: center;
  font-family: "Niconne";
}

/* Contenido principal */
.app-content {
    background-color: #FFF9FC;
}

/* Encabezados de cada página */
.app-title {
    background-color: #FFFFFF;
    border-bottom: 3px solid var(--bs-pink-light);
}

.app-title h1,
.app-title h2,
.app-title h3 {
    color: var(--bs-wine);
}

.card-header {
    background-color: #FCEAF4;
    color: var(--bs-wine);
    border-bottom-color: #F0D6E3;
}

/* Botón principal de Bootstrap */
.btn-primary {
    --bs-btn-bg: var(--bs-wine);
    --bs-btn-border-color: var(--bs-wine);
    --bs-btn-hover-bg: var(--bs-pink-dark);
    --bs-btn-hover-border-color: var(--bs-pink-dark);
    --bs-btn-active-bg: var(--bs-pink-dark);
    --bs-btn-active-border-color: var(--bs-pink-dark);
    --bs-btn-color: #FFFFFF;
    --bs-btn-hover-color: #FFFFFF;
}

/* Botón alternativo para acciones secundarias */
.btn-reposteria {
    color: var(--bs-wine);
    background-color: var(--bs-pink-light);
    border: 1px solid var(--bs-pink-light);
}

.btn-reposteria:hover,
.btn-reposteria:focus {
    color: var(--bs-wine);
    background-color: var(--bs-yellow-light);
    border-color: var(--bs-yellow-light);
}

/* Tablas */
.table {
    --bs-table-hover-bg: rgba(237, 150, 215, 0.15);
    --bs-table-hover-color: #38232D;
    border-color: #F0D6E3;
}

.table thead th {
    background-color: var(--bs-wine);
    color: #FFFFFF;
    border-color: var(--bs-wine);
}

.table-hover tbody tr:hover > * {
    --bs-table-bg-state: rgba(237, 150, 215, 0.15);
}

/* Formularios */
.form-control:focus,
.form-select:focus {
    border-color: var(--bs-pink-dark);
    box-shadow: 0 0 0 0.25rem rgba(179, 46, 108, 0.20);
}

.bg-light {
    background-color: var(--bs-pink-light) !important;
    color: var(--bs-pink-light) !important;
}

.bg-dark {
    background-color: var(--bs-wine--dark) !important;
    color: var(--bs-wine--dark) !important;
}

.bg-pink{
    background-color: var(--bs-pink-light) !important;
    color: white;
}

.bg-pink-dark{
    background-color: var(--bs-pink-dark) !important;
    color: white;
}

.text{
  color: var(--bs-yellow-light) !important;
}

.text-yellow-light{
  color: var(--bs-yellow-light) !important;
}

.text-light{
  color: var(--bs-pink-light) !important;
}

.text-dark{
  color: var(--bs-wine) !important;
}

/* Texto seleccionado */
::selection {
    color: var(--bs-wine);
    background-color: var(--bs-yellow-light);
}
</style>

<aside class="sidebar">

    <div class="text-light"><a href="index.php">
        <h3>Regresar a Inicio</h3>
    </div><hr>

    <ul class="app-menu">

        <li>
            <a class="app-menu__item"
               href="?c=producto"
               data-toggle="treeview">
                <i class="app-menu__icon bi bi-cake2"></i>
                <span class="app-menu__label">Postres</span>
                <i class="treeview-indicator bi bi-chevron-right"></i>
            </a>
        </li>

        <li>
            <a class="app-menu__item"
               href="?c=venta"
               data-toggle="treeview">
                <i class="app-menu__icon bi bi-receipt"></i>
                <span class="app-menu__label">Ventas</span>
                <i class="treeview-indicator bi bi-chevron-right"></i>
            </a>
        </li>

    </ul>

</aside>