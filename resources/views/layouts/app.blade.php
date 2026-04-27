<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Congreso Secundaria Aprende')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>

:root {
    --header-h: 75px;
    --subheader-h: 95px;
    --footer-h: 35px;
}

/* ===== HEADER ===== */
.header-ba {
    background-color: #8CE1D4;
    height: var(--header-h);
    border-top-right-radius: 40px;
}

.header-inner {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* lado izquierdo */
.header-left {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.85rem;
    white-space: nowrap;
}

.header-logo {
    height: 30px;
    object-fit: contain;
}

.icon-social {
    height: 23px;
    width: auto;
    object-fit: contain;
    transition: transform 0.15s ease;
}

.icon-social:hover {
    transform: scale(1.1);
}

/* texto */
.handle {
    font-family: 'Nunito', sans-serif;
    font-size: 1.5rem;
    font-weight: 600;
}

/* ===== SUBHEADER ===== */
.subheader-sa {
    height: var(--subheader-h);
    background: linear-gradient(
        to right,
        #6ED3C5 0%,
        #ffffff 42%,
        #ffffff 58%,
        #FFD000 100%
    );
    display: flex;
    align-items: center;
}

.subheader-inner {
    display: flex;
    align-items: center;
    justify-content: center;
}

.subheader-left {
    display: flex;
    align-items: center;
    gap: 3px;
}

.titulo-congreso {
    font-family: 'Nunito', sans-serif;
    font-size: 2.5rem;
    font-weight: 600;
    color: #0B2B3C;
}

/* logo secundaria aprende */
.logo-sa {
    height: 85px;
    transform: translateY(26px);
    display: block;
}

/* ===== NAV ===== */
.header-left a {
    text-decoration: none;
}

/* ===== FOOTER ===== */
.footer-text {
    font-size: 1.5rem;
    font-weight: 700;
    font-family: 'Nunito', sans-serif;
}

.footer-logo {
    height: var(--footer-h);
    object-fit: contain;
}

.footer-dots {
    height: var(--footer-h);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.footer-dots span {
    width: 4px;
    height: 4px;
    background-color: #0B2B3C;
    border-radius: 50%;
}

.footer-ba {
    background-color: #F2C230;
    border-top-right-radius: 28px;
}


.titulo-resaltado span {
    position: relative;
    font-family: 'Nunito', sans-serif;
    font-weight: 800;
    font-size: 2.5rem;
    color: #0B2B3C;
    display: inline-block;
}

/* fondo amarillo */
.titulo-resaltado span::before {
    content: "";
    position: absolute;
     left: -6px;

    right: -6px;

    bottom: 0.15em;   /* 👈 más abajo */

    height: 0.45em;   /* 👈 más fino */

    background: #FFD000;
    z-index: -2;
}

/* fondo celeste (ligeramente corrido) */
.titulo-resaltado span::after {
    content: "";
    position: absolute;
    left: -2px;

    right: -2px;

    bottom: 0em;  /* 👈 un poco más abajo que el amarillo */

    height: 0.45em;   /* 👈 mismo grosor */

    background: #8CE1D4;
    z-index: -1;
}

</style>

@stack('styles')
</head>

<body style="background-color: #f7f7f7;">

@include('partials.header')   <!-- 👈 NUEVO -->
@include('partials.subheader')
@include('partials.nav')

<div class="container py-2">
    @yield('content')
</div>

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>