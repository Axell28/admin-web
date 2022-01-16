<?php
require_once DIROOT . '/models/NoticiasModel.php';
$modelo = new NoticiasModel();
$arrNoticias = $modelo->listarNoticiasWeb(0, 50, '%');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo EMPRESA ?></title>
    <link rel="shortcut icon" href="<?php echo WEBURL ?>/assets/img/icons/escudo.png" type="image/png">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/web.css">
</head>

<body>

    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>

    <?php include_once 'includes/header.php'; ?>

    <style>
        h6.titulo {
            line-height: 1.6;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            text-transform: uppercase;
            color: var(--color1);
        }

        p.detalle {
            font-size: 16px;
            line-height: 1.6;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            color: rgb(120, 120, 120);
        }

        div.card-footer {
            color: var(--color2);
            font-size: 15px;
        }
    </style>

    <br><br><br>

    <section class="container">
        <div class="row">
            <div class="col-lg">
                <h2>BLOG</h2>
            </div>
        </div>
        <hr>
        <div class="row pt-1">
            <?php
            foreach ($arrNoticias as $value) { ?>
                <div class="col-md-4 my-3 px-3">
                    <div class="card h-100 shadow">
                        <img src="<?php echo $value['portada'] ?>" width="100%" height="210" style="object-fit: cover;">
                        <a href="/entrada/<?php echo $value['tagname'] ?>" class="card-body">
                            <h6 class="titulo"><?php echo $value['titulo'] ?></h6>
                            <p class="detalle pb-0 mb-0"><?php echo $value['detalle'] ?></p>
                        </a>
                        <div class="card-footer bg-white">
                            <span><i class="far fa-calendar-alt"></i>&nbsp; <?php echo Funciones::formatFecha($value['fecpub']) ?></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <br><br>

</body>

</html>