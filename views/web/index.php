<?php
$modelA = new BannerModel();
$modelB = new NoticiasModel();
$modelC = new ModalModel();
$arrBanner = $modelA->obtenerBanner();
$arrBanner['cuerpo'] = (array) json_decode($arrBanner['cuerpo'], true);
$arrNoticias = $modelB->listarNoticiasWeb(0, 4, '%');
$arrModal = $modelC->obtenerModal();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $empresa['metades'] ?>">
    <title><?php echo $empresa['nombre'] ?></title>
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
        .carousel-control-prev,
        .carousel-control-next {
            width: 8%;
        }

        #noticias div.card {
            transition: transform .3s ease-in-out;
        }

        #noticias div.card:hover {
            transform: scale(1.05);
        }

        #noticias h6.titulo {
            line-height: 1.6;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            text-transform: uppercase;
            color: var(--color1);
        }

        #noticias p.detalle {
            font-size: 16px;
            line-height: 1.6;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            color: rgb(120, 120, 120);
        }

        #noticias div.card-footer {
            color: var(--color2);
            font-size: 15px;
        }
    </style>

    <!-- Modal -->
    <?php
    if ($arrModal['visible'] == 'S') { ?>
        <div class="modal fade" id="modalHome" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo $arrModal['titulo'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo $arrModal['cuerpo'] ?>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const modalHome = new bootstrap.Modal(document.getElementById('modalHome'));
            modalHome.show();
        </script>
    <?php } ?>

    <section class="container-fluid px-0">
        <?php
        if ($arrBanner['tipo'] == 'slider') { ?>
            <div id="carouselBanner" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php
                    for ($i = 0; $i < count($arrBanner['cuerpo']); $i++) { ?>
                        <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="<?php echo $i ?>" class="<?php echo $i == 0 ? 'active' : '' ?>"></button>
                    <?php } ?>
                </div>
                <div class="carousel-inner">
                    <?php
                    foreach ($arrBanner['cuerpo'] as $key => $item) { ?>
                        <div class="carousel-item <?php echo $key == 0 ? 'active' : '' ?>" style="position: relative;">
                            <img src="<?php echo $item['imagen'] ?>" width="100%" style="height: 85vh;">
                        </div>
                    <?php } ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        <?php
        } else if ($arrBanner['tipo'] == 'video') { ?>
            <video src="<?php echo $arrBanner['cuerpo']['video']; ?>" width="100%" <?php echo $arrBanner['cuerpo']['control'] ? 'controls' : '' ?> <?php echo $arrBanner['cuerpo']['muted'] ? 'muted' : '' ?> autoplay></video>
        <?php } ?>
    </section>

    <br><br><br>

    <section class="container">
        <div class="row">
            <div class="col-lg text-center">
                <h2>BIENVENIDOS</h2>
            </div>
        </div>
        <hr>
        <div class="row justify-content-between pt-4">
            <div class="col-md-6 text-justify my-2">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam sint animi corrupti delectus minus blanditiis, iusto perferendis. Minima eius voluptate temporibus, doloremque, sint, minus qui mollitia asperiores provident odio commodi!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam error excepturi suscipit iure? Ullam ipsam obcaecati in! Eligendi beatae voluptate sapiente aut, aliquid debitis eaque modi sint vero fugit iste?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa illo deserunt eligendi atque nostrum dolore laborum eveniet ducimus, quae iusto ullam repellat quisquam unde commodi nihil ipsa facere qui alias!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio adipisci itaque, laboriosam, inventore quaerat veritatis aliquid soluta nobis eveniet dolorem minus debitis exercitationem quos laboru
                </p>
            </div>
            <div class="col-md-5 my-2">
                <img src="https://www.magisnet.com/wp-content/uploads/2021/02/PROGRAMACIO%CC%81N.jpg" class="rounded shadow" width="100%">
            </div>
        </div>
    </section>

    <br><br><br>

    <section class="container" id="noticias">
        <div class="row">
            <div class="col-lg text-center">
                <h2>BLOG</h2>
            </div>
        </div>
        <hr>
        <div class="row justify-content-center pt-1">
            <?php
            foreach ($arrNoticias as $value) { ?>
                <div class="col-md-3 my-3 px-2">
                    <div class="card h-100 shadow">
                        <img src="<?php echo $value['portada'] ?>" width="100%" height="185" style="object-fit: cover;">
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
        <div class="row pt-4">
            <div class="text-center">
                <button class="btn btn-primary">Ver mas noticias&nbsp; <i class="fas fa-arrow-alt-circle-right"></i></button>
            </div>
        </div>
    </section>

    <br><br><br>

</body>

</html>