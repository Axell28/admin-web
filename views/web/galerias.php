<?php
require_once DIROOT . '/models/GaleriaModel.php';
$model = new GaleriaModel();
$arrGalerias = $model->listarGalerias();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo EMPRESA ?></title>
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/web.css">
</head>

<body>

    <script src="<?php echo WEBURL ?>/assets/js/popper.min.js"></script>
    <script src="<?php echo WEBURL ?>/assets/js/bootstrap.min.js"></script>

    <?php include_once 'includes/header.php'; ?>

    <br><br><br>

    <style>
        .card-body {
            display: flex;
            align-items: center;
        }
        .card h5 {
            font-size: 14px;
            text-transform: uppercase;
            font-weight: bold;
        }
    </style>

    <section class="container">
        <div class="row">
            <?php
            foreach ($arrGalerias as $galeria) { ?>
                <div class="col-lg">
                    <div class="card h-100 shadow">
                        <img src="/assets/img/icons/galeria-holder.png" width="100%" height="200" style="object-fit: cover;">
                        <div class="card-body pb-2">
                            <a href="/galeria/<?php echo $galeria['idgal'] ?>"><h5><?php echo $galeria['titulo'] ?></h5></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

</body>

</html>