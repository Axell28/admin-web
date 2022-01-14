<?php
if (isset($uri[1])) {
    require_once DIROOT . '/models/NoticiasModel.php';
    $model = new NoticiasModel();
    $arrGaleria = $model->listarCategorias();
    if(!empty($_POST) && $uri[1] == 'preview') {
        $arrNoticia['idnot'] = 0;
        $arrNoticia['titulo'] = $_POST['titulo'];
        $arrNoticia['cuerpo'] = $_POST['cuerpo'];
        $arrNoticia['categoria'] = $_POST['categ'];
        $arrNoticia['fecpub'] = Funciones::formatFecha($_POST['fecpub']);
    } else {
        $arrNoticia = $model->buscarNoticiaxTag($uri[1]);
    }
    $idCateg = $arrNoticia['categoria'];
} else {
    header("Location: /error");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo EMPRESA ?></title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/web.css">
</head>

<body>

    <script src="<?php echo WEBURL ?>/assets/js/popper.min.js"></script>
    <script src="<?php echo WEBURL ?>/assets/js/bootstrap.min.js"></script>

    <?php include_once 'includes/header.php'; ?>

    <style>
        .breadcrumb .breadcrumb-item {
            font-size: 16px;
        }

        @media only screen and (max-width: 850px) {
            #entrada img {
                width: 100%;
                height: auto;
            }
            #entrada video {
                width: 100%;
                height: auto;
            }
            #entrada iframe {
                max-width: 100%;
            }
        }
    </style>

    <br><br>

    <section class="container">
        <div class="py-2 bg-light rounded border">
            <ol class="breadcrumb flex-nowrap mb-0" style="padding: 0px .9em;">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item text-truncate"><a href="#"><?php echo $arrGaleria[$idCateg]['nombre'] ?></a></li>
                <li class="breadcrumb-item text-truncate active text-lowercase" aria-current="page"><?php echo $arrNoticia['titulo'] ?></li>
            </ol>
        </div>
    </section>

    <br>

    <section class="container" id="entrada">
        <div class="row justify-content-between">
            <div class="col-xl-8 my-2">
                <div class="card border-0">
                    <div class="card-header bg-white p-2 pb-0">
                        <h3 class="mb-3"><?php echo $arrNoticia['titulo'] ?></h3>
                        <p><i class="far fa-calendar-alt"></i>&nbsp; 13-01-2021</p>
                    </div>
                    <div class="card-bodyp text-justify p-2 pt-4">
                        <?php echo $arrNoticia['cuerpo'] ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-12 my-2 bg-light p-3">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis unde at quos deserunt cupiditate quam iusto vel, accusamus pariatur perferendis ex corrupti fugiat, omnis libero ducimus? Neque sapiente rerum quasi!
            </div>
        </div>
    </section>

    <br><br><br>

</body>

</html>