<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - <?php echo EMPRESA ?></title>
    <link rel="shortcut icon" href="<?php echo WEBURL ?>/assets/img/icons/escudo.png" type="image/png">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
</head>

<body>

    <!-- scripts -->
    <script src="<?php echo WEBURL ?>/assets/js/jquery.min.js"></script>
    <script src="<?php echo WEBURL ?>/assets/js/jquery-ui.min.js"></script>
    <script async src="<?php echo WEBURL ?>/assets/js/bootstrap.min.js"></script>
    <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>

    <!-- includes -->
    <?php include_once 'includes/header.php'; ?>
    <?php include_once 'includes/menu.php'; ?>

    <!-- styles -->
    <style>
        div.gallery ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        div.gallery ul li {
            float: left;
            width: auto;
            height: auto;
            display: inline;
            width: 25%;
            padding: 0 1%;
        }

        div.gallery .card {
            box-shadow: 0 0 5px rgb(220, 220, 220);
        }

        div.gallery .card-body>img {
            width: 100%;
            height: 130px;
            object-fit: cover;
            cursor: move;
        }

        div.gallery .card-footer {
            display: flex;
            align-items: center;
        }

        div.gallery .card-footer a {
            cursor: pointer;
            color: var(--color1);
        }

        div.gallery .card-footer a:hover {
            color: red;
        }

        #modalFiles div.box-enlace {
            display: flex;
            align-items: center;
            color: rgb(80, 80, 80);
            padding: 7px .8em;
            border: 2px solid rgb(160, 160, 160);
            border-radius: .3em;
            background: rgb(250, 250, 250);
        }

        #modalFiles div.box-enlace-img {
            position: relative;
            border: 1px solid rgb(160, 160, 160);
            border-radius: .2em;
            overflow: hidden;
            transition: transform .2s ease-in-out;
        }

        #modalFiles div.box-enlace-img:hover {
            cursor: pointer;
            transform: scale(.94);
        }

        #modalFiles div.enlace-img {
            z-index: 2;
            position: absolute;
            width: 100%;
            bottom: 0;
            padding: 5px .8em;
            font-size: 14px;
            background: linear-gradient(to bottom, rgba(20, 20, 20, .2), rgba(0, 0, 0, .9));
            color: white;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        #modalFiles div.box-enlace:hover {
            border-color: blue;
            color: blue;
            cursor: pointer;
        }

        #modalFiles div.enlace {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        #modalFiles div.modal-body::-webkit-scrollbar {
            width: 21px;
        }

        #modalFiles div.modal-body::-webkit-scrollbar-track {
            background-color: transparent;
        }

        #modalFiles div.modal-body::-webkit-scrollbar-thumb {
            background-color: #d6dee1;
        }

        #modalFiles div.modal-body::-webkit-scrollbar-thumb {
            background-color: #d6dee1;
            border-radius: 21px;
        }

        #modalFiles div.modal-body::-webkit-scrollbar-thumb {
            background-color: #d6dee1;
            border-radius: 21px;
            border: 6px solid transparent;
            background-clip: content-box;
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
                BANNER PRINCIPAL
            </div>
            <div class="ms-auto d-flex flex-row" style="align-items: center;">
                <div class="ms-3">
                    <select class="form-select" onchange="selectBanner(this)">
                        <option value="slider" <?php echo ($this->tipoBanner == 'slider') ? 'selected' : '' ?>>Banner tipo slider</option>
                        <option value="video" <?php echo ($this->tipoBanner == 'video') ? 'selected' : '' ?>>Banner tipo video</option>
                    </select>
                </div>
                <button class="btn btn-danger text-white mx-3" data-bs-toggle="modal" data-bs-target="#modalFiles"><i class="fas fa-search"></i>&nbsp; Buscar archivos</button>
                <button class="btn btn-success" onclick="actualizar()"><i class="fas fa-sync"></i>&nbsp; Actualizar Banner</button>
            </div>
        </div>
        <hr>
        <?php if ($this->tipoBanner == 'slider') { ?>
            <!-- section banner -->
            <section id="menu-slide">
                <div class="gallery">
                    <ul class="reorder_ul reorder-photos-list" id="list-items"></ul>
                </div>
            </section>
        <?php } else if ($this->tipoBanner == 'video') { ?>
            <section id="menu-video">
                <div class="row pt-3">
                    <div class="col-sm-3">
                        <div class="card shadow-sm">
                            <div class="card-header px-3 py-2">
                                <b><i class="fas fa-bars"></i>&nbsp; Opciones</b>
                            </div>
                            <div class="card-body">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="video_opt_1" <?php echo $this->jsonData['control'] ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="video_opt_1">Mostrar controles</label>
                                </div>
                                <hr>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="video_opt_2" <?php echo $this->jsonData['muted'] ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="video_opt_2">Silenciado</label>
                                </div>
                                <hr>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="video_opt_3" <?php echo $this->jsonData['repeat'] ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="video_opt_3">Repetir video</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <video class="rounded" id="video-banner" class="shadow-sm" src="<?php echo $this->jsonData['video'] ?>" width="100%" controls></video>
                    </div>
                </div>
            </section>
        <?php } ?>

        <!-- Modal Archivos -->
        <div class="modal fade" id="modalFiles" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Seleccionar <?php echo $this->tipoBanner == 'slider' ? 'Imagen' : 'Video' ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4">
                        <div class="row">
                            <?php
                            if ($this->tipoBanner == 'slider') {
                                foreach ($this->listFiles as $file) : ?>
                                    <div class="col-sm-3 my-2">
                                        <div class="box-enlace-img" onclick="agregarFile('<?php echo $file['path'] ?>')">
                                            <div class="enlace-img"><?php echo $file['name'] ?></div><img src="<?php echo $file['path'] ?>" width="100%" height="130" style="object-fit: cover;">
                                        </div>
                                    </div>
                                <?php endforeach;
                            } else {
                                foreach ($this->listFiles as $file) : ?>
                                    <div class="col-sm-4 my-2">
                                        <div class="box-enlace" onclick="agregarFile('<?php echo $file['path'] ?>')" style="align-items: center;">
                                            <span class="fs-2"><i class="<?php echo $file['icon'] ?>"></i></span>
                                            <div class="enlace ms-3"><?php echo $file['name'] ?><br><span style="font-size: 14px;"><?php echo $file['size'] ?></span></div>
                                        </div>
                                    </div>
                            <?php endforeach;
                            } ?>
                        </div>
                    </div>
                    <div class="card-footer d-flex bg-white py-3" style="align-items: center;">
                        <span><?php echo count($this->listFiles) . ' de ' . count($this->listFiles) ?> resultados</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- code javascript -->
    <?php if ($this->tipoBanner == 'slider') { ?>
        <script>
            let sliderArray = JSON.parse(`<?php echo $this->jsonData ?>`);

            $("ul.reorder-photos-list").sortable();

            const listItems = () => {
                var html = "";
                sliderArray.forEach((element, index) => {
                    html += `<li id="item_${index}" class="ui-sortable-handle my-3"><div class="card"><div class="card-body p-0">`;
                    html += `<img src="${element.imagen}"></div><div class="card-footer"><a onclick="eliminarItem(${index})"><i class="far fa-trash-alt"></i> Eliminar</a></div></div></li>`;
                    // <a class="me-3" onclick="editarItem(${index})"><i class="fas fa-pencil-alt"></i> Editar</a>
                });
                $("#list-items").html(html);
            }

            const agregarFile = (url) => {
                sliderArray.push({
                    imagen: url
                });
                listItems();
                $('#modalFiles').modal('hide');
            }

            const editarItem = (index) => {
                let obj = sliderArray[index];
                window.location.href = `/admin/banner/editor/${index}`;
            }

            const eliminarItem = (index) => {
                sliderArray.splice(index, 1);
                listItems();
            }

            const actualizar = () => {
                if (sliderArray.length < 1) {
                    mostrarAlert("Debes agregar mínimo una imagen para continuar.", "warning");
                    return;
                }
                let auxArray = [];
                $("ul.reorder-photos-list li").each(
                    function() {
                        let id = $(this).attr('id').substr(5);
                        auxArray.push({
                            imagen: sliderArray[id].imagen
                        });
                    }
                );
                let data = new FormData();
                data.append("tipo", "<?php echo $this->tipoBanner ?>");
                data.append("cuerpo", JSON.stringify(auxArray));
                fetch("/admin/banner/actualizar", {
                    method: "POST",
                    body: data
                }).then(function(res) {
                    return res.text()
                }).then(function(res) {
                    if (res.trim() == "OK") {
                        mostrarAlert("Cambios guardados correctamente", "success");
                    } else {
                        mostrarAlert(res, "error");
                    }
                });
            }

            listItems();
        </script>
    <?php } else if ($this->tipoBanner == 'video') { ?>
        <script>
            const agregarFile = (uri) => {
                $('#video-banner').attr('src', uri);
                $('#modalFiles').modal('hide');
            }

            const actualizar = () => {
                let data = new FormData();
                data.append("tipo", "<?php echo $this->tipoBanner ?>");
                data.append("cuerpo", JSON.stringify({
                    video: $('#video-banner').attr('src'),
                    control: $('#video_opt_1').prop('checked'),
                    muted: $('#video_opt_2').prop('checked'),
                    repeat: $('#video_opt_3').prop('checked')
                }));
                fetch("/admin/banner/actualizar", {
                    method: "POST",
                    body: data
                }).then(function(res) {
                    return res.text()
                }).then(function(res) {
                    if (res.trim() == "OK") {
                        mostrarAlert("Cambios guardados correctamente", "success");
                    } else {
                        mostrarAlert(res, "error");
                    }
                });
            }
        </script>
    <?php } ?>

    <script>
        const selectBanner = (element) => {
            location.href = '/admin/banner/' + element.value;
        }

        const mostrarAlert = (mensaje, icon) => {
            Swal.fire({
                icon: icon,
                text: mensaje,
            });
        }

        const loadFiles = () => {
            mostrarAlert('Ya no existe más archivos que mostrar', 'warning');
        }

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