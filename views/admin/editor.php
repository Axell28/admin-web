<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - <?php echo EMPRESA ?></title>
    <link rel="shortcut icon" href="<?php echo WEBURL ?>/assets/img/icons/escudo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <script src="https://cdn.tiny.cloud/1/m923kxh2ht5z3iggdm8hghimyq6r44s6egfxl8xat90kag3t/tinymce/5/tinymce.min.js"></script>
</head>

<body>

    <!-- scripts -->
    <script src="<?php echo WEBURL ?>/assets/js/bootstrap.min.js"></script>
    <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>

    <!-- includes -->
    <?php include_once 'includes/header.php'; ?>
    <?php include_once 'includes/menu.php'; ?>

    <!-- styles -->
    <style>
        #cuerpo {
            display: none;
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
    </style>

    <!-- contenido principal -->
    <main class="content" id="app">
        <!-- loading -->

        <div id="preloader">
            <div class="loading">
                <div class="circle"></div>
            </div>
        </div>

        <form id="formNoticia" action="/entrada/preview" method="POST" target="_blank" onsubmit="showpreview(event)" onkeypress="return event.keyCode != 13;">
            <div class="d-flex px-1" style="align-items: center;">
                <div class="tab-titulo">
                    EDICIÓN
                </div>
                <div class="ms-auto d-flex" style="align-items: center;">
                    <button class="btn btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#modalFiles"><i class="fas fa-search"></i>&nbsp; Buscar archivos</button>
                    <button class="btn btn-success text-white mx-3" type="submit"><i class="fas fa-eye"></i>&nbsp; Vista previa</button>
                    <button class="btn btn-primary text-white" type="button" onclick="guardarNoticia()"><i class="fas fa-save"></i>&nbsp; Guardar noticia</button>
                </div>
            </div>
            <hr>
            <div class="row pt-2">
                <div class="col">
                    <input type="text" class="form-control text-uppercase" id="titulo" name="titulo" placeholder="Titulo de publicación" value="<?php echo $this->noticiaInfo['titulo'] ?>" autocomplete="off" maxlength="120" required>
                    <div class="pt-3">
                        <textarea id="editor"><?php echo $this->noticiaInfo['cuerpo'] ?></textarea>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card bg-light p-3">
                        <span>Categoría:</span>
                        <select class="form-select mt-1 mb-3" name="categ">
                            <?php
                            foreach ($this->listCategs as $key => $val) : ?>
                                <option value="<?php echo $key ?>" <?php echo $this->noticiaInfo['idcat'] == $key ? 'selected' : '' ?>>
                                    <?php echo $val['nombre'] ?>
                                </option>
                            <?php endforeach;
                            ?>
                        </select>
                        <span>Fecha de publicación:</span>
                        <input type="date" class="form-control mt-1 mb-3" name="fecpub" value="<?php echo $this->noticiaInfo['fecpub'] ?>">
                        <span>Detalle:</span>
                        <textarea class="form-control mt-1 mb-3" rows="1" id="txtdetalle" name="detalle" maxlength="250" placeholder="Opcional"><?php echo $this->noticiaInfo['detalle'] ?></textarea>
                        <span>Imagen de portada:</span>
                        <input type="link" class="form-control mt-1 mb-3" name="portada" value="<?php echo $this->noticiaInfo['portada'] ?>" onchange="onchangePortada(this.value)" placeholder="Link de imgen" autocomplete="off">
                        <img id="img-portada" src="<?php echo $this->noticiaInfo["portada"]; ?>" onerror="this.src = `https://via.placeholder.com/320x220`" class="rounded" width="100%" style="height: 200px; object-fit: cover;">
                        <!-- elementos ocultos -->
                        <input type="hidden" name="idnot" value="<?php echo $this->noticiaInfo['idnot'] ?>">
                        <textarea name="cuerpo" id="cuerpo"><?php echo $this->noticiaInfo['detalle'] ?></textarea>
                    </div>
                </div>
            </div>
        </form>

        <!-- ventana modal -->
        <div class="modal fade" id="modalFiles" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header py-2 border-bottom">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-fotos-tab" data-bs-toggle="pill" data-bs-target="#pills-fotos" type="button" role="tab" aria-controls="pills-fotos" aria-selected="true" onclick="getCantFiles(<?php echo count($this->listFiles['fotos']) ?>, 1)">Imagenes</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-videos-tab" data-bs-toggle="pill" data-bs-target="#pills-videos" type="button" role="tab" aria-controls="pills-videos" aria-selected="false" onclick="getCantFiles(<?php echo count($this->listFiles['video']) ?>, 2)">Videos</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-files-tab" data-bs-toggle="pill" data-bs-target="#pills-files" type="button" role="tab" aria-controls="pills-files" aria-selected="false" onclick="getCantFiles(<?php echo count($this->listFiles['files']) ?>, 3)">Archivos</button>
                            </li>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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

    <script>
        const detalle = document.querySelector("#txtdetalle");
        const arrFotos = JSON.parse(`<?php echo json_encode($this->listFiles['fotos'], JSON_UNESCAPED_UNICODE) ?>`);
        const modalFiles = new bootstrap.Modal(document.getElementById('modalFiles'));
        let cont = 0,
            tabFile = 1;
        detalle.addEventListener('input', autoResize, false);

        // run tinymce
        tinymce.init({
            selector: '#editor',
            language: "es",
            encoding: 'UTF-8',
            plugins: 'link media table image emoticons advlist lists code table template example paste mediaembed table',
            toolbar: 'formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | numlist bullist checklist | forecolor backcolor | link media image pageembed emoticons | table | removeformat code ',
            menubar: false,
            content_style: 'body { font-size: 17px; line-height: 1.6; }',
            height: '800',
            object_resizing: true,
            fix_list_elements: true,
            media_dimensions: true,
            forced_root_block: 'div',
            paste_as_text: true,
            paste_remove_styles: true,
            paste_remove_styles_if_webkit: true,
            default_link_target: "_blank",
        });

        function autoResize() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        }

        const showpreview = (e) => {
            e.preventDefault();
            const cuerpo = document.getElementById("cuerpo");
            cuerpo.value = tinyMCE.get('editor').getContent();
            e.currentTarget.submit();
        }

        const guardarNoticia = () => {
            let titulo = document.getElementById("titulo");
            if (titulo.value == "") {
                titulo.focus();
                mostrarAlert("Debe ingresar el titulo de la publicación para continuar", "warning");
                return;
            }
            document.getElementById("cuerpo").value = tinyMCE.get('editor').getContent();
            let form = new FormData(document.getElementById("formNoticia"));
            fetch("/admin/editor/<?php echo $this->action ?>", {
                method: "POST",
                body: form
            }).then(function(res) {
                return res.text()
            }).then(function(res) {
                if (res.trim() == "OK") {
                    mostrarAlert("Publicación <?php echo $this->action == 'save' ? 'guardada' : 'editada' ?> correctamente", "success");
                } else {
                    mostrarAlert(res, "error");
                }
            });
        }

        const getCantFiles = (cant, tab) => {
            tabFile = tab;
            cant = tab == 1 ? cont : cant;
            document.getElementById("cant-files").innerText = 'Mostrando ' + cant + ' resultados';
        }

        const cargarArchivos = () => {
            if (cont >= arrFotos.length || tabFile !== 1) {
                mostrarAlert('Ya no existe más archivos que mostrar', 'warning');
                return;
            }
            let mbody = document.querySelector('.modal-body');
            let html = document.getElementById("row-fotos").innerHTML;
            let vmax = (cont + 24) >= arrFotos.length ? arrFotos.length : (cont + 24);
            for (let i = cont; i < vmax; i++) {
                const element = arrFotos[i];
                html += `<div class="col-sm-2 my-2"> <div class="box-enlace-img" onclick="addContenido('img', '${element.path}')"> <div class="enlace-img">${element.name}</div><img src="${element.path}" width="100%" height="170" style="object-fit: cover;"> </div></div>`;
            }
            cont += 24;
            document.getElementById("row-fotos").innerHTML = html;
            document.getElementById("cant-files").innerText = 'Mostrando ' + vmax + ' resultados';
            mbody.scrollTop = mbody.scrollHeight;
        }

        function addContenido(tipo, uri) {
            let html = tinyMCE.get('editor').getContent();
            if (tipo == 'img') {
                html += `<div><img src="${uri}" width="85%"></div>`;
            } else if (tipo == 'video') {
                html += `<div><video src="${uri}" width="100%" height="420" controls></video></div>`;
            } else if (tipo == 'pdf') {
                html += `<div><iframe src="${uri}" width="100%" height="720" frameborder="0"></iframe></div>`;
            } else {
                html += `<div><a href="${uri}" target="_blank">${uri}</a></div>`;
            }
            tinyMCE.get('editor').setContent(html);
            modalFiles.hide();
        }

        const mostrarAlert = (mensaje, icon) => {
            Swal.fire({
                icon: icon,
                text: mensaje,
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    if (icon === 'success') {
                        location.href = '/admin/noticias/all';
                    }
                }
            });;
        }

        cargarArchivos();

        setTimeout(() => {
            let loader = document.getElementById('preloader');
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500);
        }, 2600);
    </script>
</body>

</html>