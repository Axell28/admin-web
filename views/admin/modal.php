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
</head>

<body>

    <!-- scripts -->
    <script src="<?php echo WEBURL ?>/assets/js/vue.min.js"></script>
    <script async src="<?php echo WEBURL ?>/assets/js/bootstrap.min.js"></script>
    <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>

    <!-- includes -->
    <?php include_once 'includes/header.php'; ?>
    <?php include_once 'includes/menu.php'; ?>

    <!-- styles -->
    <style>
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
            transform: scale(.9);
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

        <!-- loading -->
        <div id="preloader">
            <div class="loading">
                <div class="circle"></div>
            </div>
        </div>

        <div class="d-flex px-1" style="align-items: center;">
            <div class="tab-titulo">
                VENTANA EMERGENTE
            </div>
            <div class="ms-auto d-flex flex-row" style="align-items: center;">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="check-visible" style="border-radius: 2px; transform: scale(1.08); cursor: pointer;" <?php echo $this->arrModal['visible'] == 'S' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="check-visible">Ventana visible</label>
                </div>
                <button class="btn btn-danger text-white mx-3" data-bs-toggle="modal" data-bs-target="#modalFiles"><i class="fas fa-search"></i>&nbsp; Buscar archivos</button>
                <button class="btn btn-success text-white" onclick="actualizarModal()"><i class="fas fa-save"></i>&nbsp; Guardar galería</button>
            </div>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content modal-base-content shadow" style="border-radius: 0;">
                        <div class="modal-header modal-base-header">
                            <input type="text" class="form-control me-3" id="cuerpo-titulo" value="<?php echo $this->arrModal['titulo'] ?>" placeholder="Ingrese un titulo aquí">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body modal-base-body">
                            <?php echo $this->arrModal['cuerpo'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ventana modal -->
        <div class="modal fade" id="modalFiles" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header py-2 border-bottom">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-fotos-tab" data-bs-toggle="pill" data-bs-target="#pills-fotos" type="button" role="tab" aria-controls="pills-fotos" aria-selected="true" onclick="getCantFiles(<?php echo count($this->listFiles['fotos']) ?>, 1)"><i class="far fa-folder-open"></i>&nbsp; Imagenes</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-videos-tab" data-bs-toggle="pill" data-bs-target="#pills-videos" type="button" role="tab" aria-controls="pills-videos" aria-selected="false" onclick="getCantFiles(<?php echo count($this->listFiles['video']) ?>, 2)"><i class="far fa-folder-open"></i>&nbsp; Videos</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-files-tab" data-bs-toggle="pill" data-bs-target="#pills-files" type="button" role="tab" aria-controls="pills-files" aria-selected="false" onclick="getCantFiles(<?php echo count($this->listFiles['files']) ?>, 3)"><i class="far fa-folder-open"></i>&nbsp; Archivos</button>
                            </li>
                            <!-- <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-frames-tab" data-bs-toggle="pill" data-bs-target="#pills-frames" type="button" role="tab" aria-controls="pills-frames" aria-selected="false" onclick="getCantFiles(null, 4)"><i class="far fa-folder-open"></i>&nbsp; Iframes</button>
                            </li> -->
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body modal-file-body">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-fotos" role="tabpanel" aria-labelledby="pills-fotos-tab">
                                <div class="row" id="row-fotos"></div>
                            </div>
                            <div class="tab-pane fade" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab">
                                <div class="row">
                                    <?php
                                    foreach ($this->listFiles['video'] as $file) { ?>
                                        <div class="col-sm-4 my-2">
                                            <div class="box-enlace" onclick="addContenido('video', '<?php echo WEBURL . $file['path'] ?>')" style="align-items: center;">
                                                <span class="fs-2"><i class="fas fa-film"></i></span>
                                                <div class="enlace ms-3"><?php echo $file['name'] ?><br><span style="font-size: 14px;"><?php echo $file['size'] ?></span></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-files" role="tabpanel" aria-labelledby="pills-files-tab">
                                <div class="row">
                                    <?php
                                    foreach ($this->listFiles['files'] as $file) { ?>
                                        <div class="col-sm-4 my-2">
                                            <div class="box-enlace" onclick="addContenido('<?php echo $file['tipo'] ?>', '<?php echo WEBURL . $file['path'] ?>')" style="align-items: center;">
                                                <span class="fs-2"><i class="<?php echo $file['icon'] ?>"></i></span>
                                                <div class="enlace ms-3"><?php echo $file['name'] ?><br><span style="font-size: 14px;"><?php echo $file['size'] ?></span></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- <div class="tab-pane fade" id="pills-frames" role="tabpanel" aria-labelledby="pills-frames-tab">
                                <textarea class="form-control" id="textIframe" rows="6" placeholder="Ingresa el código Iframe a insertar"></textarea>
                                <button class="btn btn-primary btn-sm mt-3" onclick="addContenido('frame', '')">Agregar Frame &nbsp;<i class="fas fa-arrow-alt-circle-right"></i></button>
                            </div> -->
                        </div>
                    </div>
                    <div class="card-footer bg-white d-flex py-3" style="align-items: center;">
                        <span id="cant-files">Mostrando 0 resultados</span>
                        <a class="ms-auto text-primary" onclick="cargarArchivos()" style="cursor: pointer;">Cargar más resultados &nbsp;<i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- code javascript -->
    <script>
        const modalFiles = new bootstrap.Modal(document.getElementById('modalFiles'));
        const arrFotos = JSON.parse(`<?php echo json_encode($this->listFiles['fotos'], JSON_UNESCAPED_UNICODE) ?>`);
        let cont = 0;
        let tabFile = 1;

        const getCantFiles = (cant, tab) => {
            tabFile = tab;
            if (cant == null) {
                document.getElementById("cant-files").innerText = '';
                return;
            }
            cant = tab == 1 ? cont : cant;
            document.getElementById("cant-files").innerText = 'Mostrando ' + cant + ' resultados';
        }

        const cargarArchivos = () => {
            if (cont >= arrFotos.length || tabFile !== 1 || tabFile == null) {
                mostrarAlert('Ya no existe más archivos que mostrar', 'warning');
                return;
            }
            let mbody = document.querySelector('.modal-file-body');
            let html = document.getElementById("row-fotos").innerHTML;
            let vmax = (cont + 24) >= arrFotos.length ? arrFotos.length : (cont + 24);
            for (let i = cont; i < vmax; i++) {
                const element = arrFotos[i];
                html += `<div class="col-sm-2 my-2"> <div class="box-enlace-img placeholder-glow" onclick="addContenido('img', '${element.path}')"> <div class="enlace-img">${element.name}</div><img src="${element.path}" width="100%" height="170" style="object-fit: cover;"> </div></div>`;
            }
            cont += 24;
            document.getElementById("row-fotos").innerHTML = html;
            document.getElementById("cant-files").innerText = 'Mostrando ' + vmax + ' resultados';
            mbody.scrollTop = mbody.scrollHeight;
        }

        function addContenido(tipo, uri) {
            let html = '';
            if (tipo == 'img') {
                html += `<img src="${uri}" class="img-fluid" width="100%">`;
            } else if (tipo == 'video') {
                html += `<video src="${uri}" width="100%" height="auto" controls></video>`;
            } else if (tipo == 'pdf') {
                html += `<iframe src="${uri}" width="100%" height="820" frameborder="0"></iframe>`;
            } else if (tipo == 'frame') {
                let code = document.getElementById("textIframe").value;
                html += code;
            } else {
                html += `<div><a href="${uri}" target="_blank">${uri}</a></div>`;
            }
            document.querySelector(".modal-base-body").innerHTML = html;
            modalFiles.hide();
        }

        const actualizarModal = () => {
            let isvisible = document.getElementById('check-visible').checked;
            let form = new FormData();
            form.append("titulo", document.getElementById("cuerpo-titulo").value);
            form.append("cuerpo", document.querySelector(".modal-base-body").innerHTML);
            form.append("visible", isvisible ? 'S' : 'N');
            fetch("/admin/modal/actualizar", {
                method: "POST",
                body: form
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

        const mostrarAlert = (mensaje, icon) => {
            Swal.fire({
                icon: icon,
                text: mensaje,
            });
        }

        cargarArchivos();

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