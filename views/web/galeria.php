<?php 
    require_once DIROOT . '/models/GaleriaModel.php';
    $model = new GaleriaModel();
    if(isset($uri[1]) && is_numeric($uri[1])) {
        $arrGaleria = $model->buscarGaleria(intval($uri[1]));
        $arrGaleria['cuerpo'] = (array) json_decode($arrGaleria['cuerpo']. JSON_UNESCAPED_UNICODE);
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
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>

<body>

    <?php include_once 'includes/header.php'; ?>

    <br><br><br>

    <section class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="text-center">
                    <h2><?php echo $arrGaleria['titulo'] ?></h2>
                </div>
            </div>
        </div>
    </section>

</body>

</html>