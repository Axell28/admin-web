<?php
require_once DIROOT . '/models/GaleriaModel.php';
$model = new GaleriaModel();
if (isset($uri[1]) && is_numeric($uri[1])) {
    $arrGaleria = $model->buscarGaleria(intval($uri[1]));
    $arrGaleria['cuerpo'] = (array) json_decode($arrGaleria['cuerpo'], true);
} else {
    header('Location: /error');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo EMPRESA ?></title>
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/venobox.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/web.css">
</head>

<body>

    <script src="<?php echo WEBURL ?>/assets/js/popper.min.js"></script>
    <script src="<?php echo WEBURL ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo WEBURL ?>/assets/js/venobox.js"></script>

    <?php include_once 'includes/header.php'; ?>

    <style>
        #content-grid {
            columns: <?php echo $arrGaleria['ncolum'] ?>;
            column-gap: 9px;
        }

        #content-grid>div.img-links {
            -webkit-column-break-inside: avoid;
            page-break-inside: avoid;
            break-inside: avoid;
            margin-bottom: 9px;
        }
    </style>

    <br><br><br>

    <section class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="text-center">
                    <h2 class="fw-bold"><?php echo $arrGaleria['titulo'] ?></h2>
                    <?php echo '<p>' . $arrGaleria['detalle'] .'</p>' ?>
                </div>
                <hr>
                <div id="content-grid" class="pt-4">
                    <?php
                    foreach ($arrGaleria['cuerpo'] as $val) { ?>
                        <a class="img-links" data-gall="gallery01" title="<?php echo $arrGaleria['titulo'] ?>" href="<?php echo $val['path']; ?>"><img src="<?php echo $val['path']; ?>" class="mb-2" width="100%"></a>
                    <?php }  ?>
                </div>
            </div>
        </div>
    </section>

    <br><br><br>

    <script>
        new VenoBox({
            selector: '.img-links',
            numeration: true,
            infinigall: true,
            navSpeed: 300,
        });
    </script>

</body>

</html>