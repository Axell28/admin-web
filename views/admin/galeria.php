<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - <?php echo EMPRESA ?></title>
    <link rel="shortcut icon" href="<?php echo WEBURL ?>/assets/img/icons/escudo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
</head>

<body>

    <!-- scripts -->
    <script src="/assets/js/bootstrap.min.js"></script>
    <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>

    <!-- includes -->
    <?php include_once 'includes/header.php'; ?>
    <?php include_once 'includes/menu.php'; ?>

    <!-- styles -->
    <style>
        div.card-footer {
            display: flex;
            flex-direction: row;
            align-items: center;
            background: transparent;
            border-color: rgb(218, 218, 218);
            padding: 10px 17px;
        }

        div.card-footer .btn {
            padding-top: 6px;
            padding-bottom: 4px;
        }
    </style>

    <!-- main content -->
    <main class="content" id="app">
        <!-- loading -->
        <div id="preloader">
            <div class="loading">
                <div class="circle"></div>
            </div>
        </div>

        <div class="d-flex px-1" style="align-items: center;">
            <div class="tab-titulo">
                GALERÍAS
            </div>
            <div class="ms-auto d-flex flex-row" style="align-items: center;">
                <button class="btn btn-primary text-white" onclick="location.href = '/admin/galeria/vista'"><i class="fas fa-plus"></i>&nbsp; Nueva galería</button>
            </div>
        </div>
        <hr>
        <div class="row">
            <?php
            foreach ($this->listGaleria as $val) { ?>
                <div class="col-md-3 my-2" id="card-<?php echo $val['idgal'] ?>">
                    <div class="card h-100 shadow-sm">
                        <img src="https://thumbs.dreamstime.com/b/galer%C3%ADa-bot%C3%B3n-del-%C3%A1lbum-el-mejor-vector-130465107.jpg" width="100%" height="180" style="object-fit: cover;">
                        <div class="card-body">
                            <a href="/galeria/<?php echo $val['idgal'] ?>" target="_blank" class="text-uppercase"><?php echo $val['titulo'] ?></a>
                        </div>
                        <div class="card-footer bg-white">
                            <span><i class="far fa-calendar-alt"></i> <?php echo Funciones::formatFecha($val['fecpub']) ?></span>
                            <div class="ms-auto">
                                <button class="btn btn-sm btn-outline-info me-1" title="Copiar enlace" onclick="copiarEnlace('/galeria/<?php echo $val['idgal'] ?>')"><i class="fas fa-paste"></i></button>
                                <a href="/admin/galeria/vista/<?php echo $val['idgal'] ?>" class="btn btn-sm btn-outline-success me-1" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                <button class="btn btn-sm btn-outline-danger" title="Eliminar" onclick="eliminarGaleria('<?php echo $val['idgal'] ?>')"><i class="far fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>

    <!-- code Javascript -->
    <script>
        const eliminarGaleria = (id) => {
            Swal.fire({
                icon: 'question',
                text: '¿Está seguro de eliminar esta galería?',
                showDenyButton: true,
                allowOutsideClick: false,
                confirmButtonText: 'Aceptar',
                denyButtonText: 'Cancelar',
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let uri = `/admin/galeria/eliminar/${id}`;
                    fetch(uri, {
                        method: "GET"
                    }).then(function(res) {
                        return res.text()
                    }).then(function(res) {
                        if (res.trim() == "OK") {
                            document.getElementById("card-" + id).remove();
                            mostrarAlert("Galería eliminada correctamente", "success");
                        } else {
                            mostrarAlert(res, "error");
                        }
                    });
                }
            });
        }

        const copiarEnlace = (path) => {
            let link = location.origin + path;
            let aux = document.createElement("input");
            aux.setAttribute("value", link);
            document.body.append(aux);
            aux.select();
            document.execCommand("copy");
            aux.remove();
            mostrarAlert("Enlace copiado al portapapeles", "success");
        }

        const mostrarAlert = (mensaje, icon) => {
            if (icon == 'success') {
                Swal.fire({
                    icon: 'success',
                    text: mensaje,
                    showConfirmButton: false,
                    timer: 1800
                });
            } else {
                Swal.fire({
                    icon: icon,
                    text: mensaje,
                });
            }
        }

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