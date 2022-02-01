<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - <?php echo EMPRESA ?></title>
    <link rel="shortcut icon" href="<?php echo WEBURL ?>/assets/img/icons/escudo.png" type="image/png">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <script src="https://cdn.tiny.cloud/1/m923kxh2ht5z3iggdm8hghimyq6r44s6egfxl8xat90kag3t/tinymce/5/tinymce.min.js"></script>
</head>

<body>

    <!-- scripts -->
    <script async src="<?php echo WEBURL ?>/assets/js/bootstrap.min.js"></script>
    <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>

    <!-- includes -->
    <?php include_once 'includes/header.php'; ?>
    <?php include_once 'includes/menu.php'; ?>

    <!-- styles -->
    <style>
        .wrapper {
            position: absolute;
            padding: 2em;
            width: 100%;
            height: 97.9%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgb(0, 0, 0, .4);
        }

        .wrapper>section {
            padding: .5em;
        }

        [contenteditable]:focus {
            outline: 3px dashed cyan;
        }
    </style>

    <!-- main content -->
    <main class="content" id="app">

        <div id="preloader">
            <div class="loading">
                <div class="circle"></div>
            </div>
        </div>

        <div class="d-flex px-1" style="align-items: center;">
            <div class="tab-titulo">
                EDICIÓN
            </div>
            <div class="ms-auto d-flex flex-row">
                <button class="btn btn-success"><i class="fas fa-sync"></i>&nbsp; Guardar cambios</button>
            </div>
        </div>
        <hr>
        <div class="w-100 py-2" style="position: relative;">
            <div class="wrapper">
                <section class="text-white w-50 tinymce-body">
                    <h1 class="fs-1">TITULO DE PRUEBA AQUÍ</h1>
                    <p style="font-size: 19px;">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa ab praesentium provident blanditiis a. Dolor temporibus, dolore enim at quibusdam repudiandae magni, labore nihil eveniet magnam pariatur nostrum, eaque molestias?</p>
                    <a href="#" class="btn btn-primary btn-lg py-2 px-4">Iniciar proceso</a>
                </section>
            </div>
            <img src="<?php echo $this->imgBanner ?>" width="100%">
        </div>
        <br>
    </main>

    <script>
        const configTiny = {
            selector: '.tinymce-body',
            menubar: false,
            inline: true,
            language: "es",
            encoding: 'UTF-8',
            plugins: 'link media table image emoticons advlist lists code table template example paste table',
            toolbar: [
                'bold italic | fontselect fontsizeselect',
                'forecolor backcolor | alignleft aligncenter alignright alignfull | link media image'
            ],
            object_resizing: true,
            fix_list_elements: true,
            media_dimensions: true,
            forced_root_block: 'div',
            paste_as_text: true,
            paste_remove_styles: true,
            paste_remove_styles_if_webkit: true,
            default_link_target: "_blank",
        };

        tinymce.init(configTiny);

        setTimeout(() => {
            let loader = document.getElementById('preloader');
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500);
        }, 2400);
    </script>

</body>

</html>