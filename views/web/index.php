<?php
require_once DIROOT . '/models/BannerModel.php';
$model = new BannerModel();
$arrBanner = $model->obtenerBanner();
$arrBanner['cuerpo'] = (array) json_decode($arrBanner['cuerpo'], true);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo EMPRESA ?></title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/web.css">
</head>

<body>

    <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>

    <?php include_once 'includes/header.php'; ?>

    <style>
        .carousel-control-prev,
        .carousel-control-next {
            width: 8%;
        }
    </style>

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
                    <img src="<?php echo $item['imagen'] ?>" class="d-block w-100">
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

    <br><br><br>

    <section class="container">
        <div class="row">
            <div class="col">
                <h1 class="mb-4">Página de inicio</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam sint animi corrupti delectus minus blanditiis, iusto perferendis. Minima eius voluptate temporibus, doloremque, sint, minus qui mollitia asperiores provident odio commodi!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam error excepturi suscipit iure? Ullam ipsam obcaecati in! Eligendi beatae voluptate sapiente aut, aliquid debitis eaque modi sint vero fugit iste?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa illo deserunt eligendi atque nostrum dolore laborum eveniet ducimus, quae iusto ullam repellat quisquam unde commodi nihil ipsa facere qui alias!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio adipisci itaque, laboriosam, inventore quaerat veritatis aliquid soluta nobis eveniet dolorem minus debitis exercitationem quos laborum, delectus facilis suscipit vitae nemo?
                </p>
            </div>
        </div>
    </section>

    <br><br><br>

</body>

</html>