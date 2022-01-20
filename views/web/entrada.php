<?php
if (isset($uri[1])) {
    require_once DIROOT . '/models/NoticiasModel.php';
    $model = new NoticiasModel();
    $arrGaleria = $model->listarCategorias();
    if (!empty($_POST) && $uri[1] == 'preview') {
        $arrNoticia['idnot'] = 0;
        $arrNoticia['titulo'] = $_POST['titulo'];
        $arrNoticia['cuerpo'] = $_POST['cuerpo'];
        $arrNoticia['categoria'] = $_POST['categ'];
        $arrNoticia['fecpub'] = Funciones::formatFecha($_POST['fecpub']);
    } else {
        $arrNoticia = $model->buscarNoticiaxTag($uri[1]);
    }
    $idCateg = $arrNoticia['categoria'];
    $arrRecientes = $model->listarNoticiasWeb(0, 4, '%');
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
    <link rel="shortcut icon" href="<?php echo WEBURL ?>/assets/img/icons/escudo.png" type="image/png">
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

        li.list-group-item {
            background: #FCFBF4;
        }

        li.list-group-item span.fecpub {
            color: rgb(100, 100, 100);
            font-size: 14px;
        }

        li.list-group-item a.titulo {
            color: #6491BE;
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
            <div class="col-xl-3 col-md-12 my-2 p-2">
                <div style="position: sticky; top: 9.5em;">
                    <h4 class="mb-3">Publicaciones recientes</h4>
                    <div class="card shadow-sm">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                <?php
                                foreach ($arrRecientes as $key => $value) { ?>
                                    <li class="list-group-item pt-3">
                                        <a href="/entrada/<?php echo $value['tagname'] ?>" class="titulo">
                                            <h6 class="mb-1"><?php echo $value['titulo'] ?></h6>
                                        </a>
                                        <span class="fecpub"><i class="far fa-calendar-alt"></i>&nbsp; <?php echo Funciones::formatFecha($value['fecpub']) ?></span>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br><br><br>

</body>

</html>