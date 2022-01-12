<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTICIAS - <?php echo EMPRESA ?></title>
    <link rel="shortcut icon" href="<?php echo WEBURL ?>/assets/img/icons/escudo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
</head>

<body>

    <!-- scripts -->
    <script async src="<?php echo WEBURL ?>/assets/js/bootstrap.min.js"></script>
    <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>

    <!-- includes -->
    <?php include_once 'includes/header.php'; ?>
    <?php include_once 'includes/menu.php'; ?>

    <!-- contenido principal -->
    <main class="content" id="app">
        <!-- loading -->
        <!-- <div id="preloader">
            <div class="loading">
                <div class="circle"></div>
            </div>
        </div> -->
        <div class="d-flex px-1" style="align-items: center;">
            <div class="tab-titulo">
                NOTICIAS
            </div>
            <div class="ms-auto d-flex" style="align-items: center;">
                <?php
                if (count($this->listCategs) > 1) { ?>
                    <div>Categoría : </div>
                    <div class="ms-3 me-3">
                        <select class="form-select" onchange="cambiarCategoria(this.value)">
                            <option value="all">Todas</option>
                        </select>
                    </div>
                <?php } ?>
                <button class="btn btn-success text-white" onclick="location.href = '/admin/editor'"><i class="fas fa-plus"></i>&nbsp; Nueva noticia</button>
            </div>
        </div>
        <hr>
    </main>

    <script>
        setTimeout(() => {
            let loader = document.getElementById('preloader');
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500);
        }, 2000);
    </script>

</body>

</html>