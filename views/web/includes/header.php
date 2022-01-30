<?php
$active1 = 'nav-link';
$active2 = 'nav-link';
$active3 = 'nav-link';
$active4 = 'nav-link';
switch ($nameview) {
    case 'index':
        $active1 .= ' active';
        break;
    case 'nosotros':
        $active2 .= ' active';
        break;
    case 'noticias':
    case 'entrada':
        $active3 .= ' active';
        break;
    case 'galeria':
    case 'galerias':
        $active4 .= ' active';
        break;
}
?>
<header class="fixed-top" id="header">
    <div class="bar-sup">
        <?php if (!empty($empresa['facebook'])) { ?>
            <a href="<?php echo $empresa['facebook'] ?>" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>
        <?php } ?>
        <?php if (!empty($empresa['youtube'])) { ?>
            <a href="<?php echo $empresa['youtube'] ?>" target="_blank"><i class="fab fa-youtube"></i> Youtube</a>
        <?php } ?>
        <?php if (!empty($empresa['instagram'])) { ?>
            <a href="<?php echo $empresa['instagram'] ?>" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
        <?php } ?>
        <?php if (!empty($empresa['twitter'])) { ?>
            <a href="<?php echo $empresa['twitter'] ?>" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
        <?php } ?>
        <div class="ms-auto">
            <?php if (!empty($empresa['telefono'])) { ?>
                <a href="tel:<?php echo $empresa['telefono'] ?>"><i class="fas fa-phone-alt"></i> <?php echo $empresa['telefono'] ?></a>
            <?php } ?>
            <?php if (!empty($empresa['telefono'])) { ?>
                <a href="<?php echo $empresa['intranet'] ?>" target="_blank"><i class="fas fa-globe"></i> Intranet</a>
            <?php } ?>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="/">
            <img src="/assets/img/icons/escudo.png" height="90">
            <span><?php echo EMPRESA ?></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="<?php echo $active1 ?>" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="<?php echo $active2 ?>" href="#">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="<?php echo $active3 ?>" href="/noticias">Noticias</a>
                </li>
                <li class="nav-item">
                    <a class="<?php echo $active4 ?>" href="/galerias">Galerías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Contacto</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<script>
    const height = document.getElementById('header').clientHeight;
    document.querySelector("body").style.marginTop = height + 'px';
</script>