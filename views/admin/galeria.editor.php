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
    <script src="/assets/js/bootstrap.min.js"></script>
    <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>

    <!-- includes -->
    <?php include_once 'includes/header.php'; ?>
    <?php include_once 'includes/menu.php'; ?>

    <!-- styles -->
    <style>
        #content-grid {
            columns: <?php echo $this->galeriaInfo['ncolum'] ?>;
            column-gap: 6px;
        }

        #content-grid>div.item {
            -webkit-column-break-inside: avoid;
            page-break-inside: avoid;
            break-inside: avoid;
            margin-bottom: 6px;
            overflow: hidden;
        }

        #content-grid img {
            object-fit: cover;
        }

        #content-grid .bottoms {
            z-index: 1;
            position: absolute;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            display: flex;
            background: rgba(0, 0, 0, .5);
            opacity: 0;
            transition: opacity .4s ease-in-out;
        }

        #content-grid>div.item:hover .bottoms {
            opacity: 1;
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
            transform: scale(.92);
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
                CREAR GALERÍA
            </div>
            <div class="ms-auto d-flex flex-row" style="align-items: center;">
                <button class="btn btn-danger text-white mx-3" data-bs-toggle="modal" data-bs-target="#modalFiles"><i class="fas fa-search"></i>&nbsp; Buscar archivos</button>
                <button class="btn btn-success text-white" onclick="guardarGaleria()"><i class="fas fa-save"></i>&nbsp; Guardar galería</button>
            </div>
        </div>
        <hr>
        <div class="row pt-3 pb-4">
            <div class="col mb-4">
                <div id="content-grid"></div>
            </div>
            <div class="col-3">
                <form id="formGaleria" class="card bg-light p-3 pt-4 shadow-sm" style="position: sticky; top: 5.5em;">
                    <span>Titulo de galería:</span>
                    <input type="text" class="form-control mt-1 mb-3" name="titulo" value="<?php echo $this->galeriaInfo['titulo'] ?>" autocomplete="off">
                    <span>Detalle:</span>
                    <textarea class="form-control mt-1 mb-3" rows="3" name="detalle" placeholder="Opcional" maxlength="250"><?php echo $this->galeriaInfo['detalle'] ?></textarea>
                    <span>Imagen de portada:</span>
                    <input type="text" class="form-control mt-1 mb-2" name="portada" value="<?php echo $this->galeriaInfo['portada'] ?>" placeholder="Link de imagen" autocomplete="off">
                    <hr>
                    <div class="row pt-1">
                        <div class="col">
                            <span>Modo de galería:</span>
                            <select class="form-select mt-1 mb-3" name="modo" id="modoGaleria" onchange="cambiarModo()">
                                <option value="A" <?php echo $this->galeriaInfo['modo'] == 'A' ? 'selected' : '' ?>>Collage</option>
                                <option value="B" <?php echo $this->galeriaInfo['modo'] == 'B' ? 'selected' : '' ?>>Cuadrícula</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span>Nro. de columnas:</span>
                            <input type="number" name="colum" class="form-control mt-1 mb-3" min="1" max="6" value="<?php echo $this->galeriaInfo['ncolum'] ?>" onchange="cambiarColumns(this.value)">
                        </div>
                        <div class="col-4">
                            <span>Items:</span>
                            <input type="text" class="form-control mt-1 mb-3" id="cantImg" readonly>
                        </div>
                    </div>
                    <input type="hidden" name="idgal" value="<?php echo $this->galeriaInfo['idgal'] ?>">
                </form>
            </div>
        </div>

        <!-- Modal Archivos -->
        <div class="modal fade" id="modalFiles" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Seleccionar Imagen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4">
                        <div class="row" id="row-fotos"></div>
                    </div>
                    <div class="card-footer d-flex bg-white py-3" style="align-items: center;">
                        <span id="cant-files">0 resultados</span>
                        <div class="ms-auto" style="display: flex; align-items: center;">
                            <a class="text-primary me-4" onclick="insertImagenxLink()" style="cursor: pointer;">Insertar link</a>
                            <a class="text-primary" style="cursor: pointer;" onclick="cargarArchivos()">Cargar más resultados &nbsp;<i class="fas fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const modalFiles = new bootstrap.Modal(document.getElementById('modalFiles'));
        const itemsGaleria = JSON.parse('<?php echo $this->galeriaInfo['cuerpo'] ?>');
        const arrFotos = JSON.parse(`<?php echo json_encode($this->listFiles, JSON_UNESCAPED_UNICODE) ?>`);
        let cont = 0;

        /* funciones */
        const agregarItem = (name, tipo, path) => {
            itemsGaleria.push({
                name: name,
                tipo: tipo,
                path: path
            });
            listImagenes();
            modalFiles.hide();
        }

        const eliminarItem = (index) => {
            itemsGaleria.splice(index, 1);
            listImagenes();
        }

        const cambiarColumns = (valor) => {
            let grid = document.getElementById('content-grid');
            grid.style.columns = valor;
        }

        const cambiarModo = () => {
            let valor = document.getElementById('modoGaleria').value;
            let arrImg = document.querySelectorAll("#content-grid img");
            arrImg.forEach(element => {
                if (valor == 'A') {
                    element.style.height = 'auto';
                } else if (valor == 'B') {
                    element.style.height = '240px';
                }
            });
        }

        const listImagenes = () => {
            let html = '';
            itemsGaleria.forEach((item, index) => {
                html += `<div class="item" style="position: relative;"><div class="bottoms">
                <button class="btn btn-sm btn-danger mx-1" title="Eliminar" onclick="eliminarItem(${index})" style="width:36px; height: 36px;"><i class="far fa-trash-alt"></i></button></div> <img src="${item.path}" width="100%"></div>`;
            });
            document.getElementById('cantImg').value = itemsGaleria.length;
            document.getElementById('content-grid').innerHTML = html;
            cambiarModo();
        }

        const guardarGaleria = () => {
            let data = new FormData(document.getElementById('formGaleria'));
            data.append('cuerpo', JSON.stringify(itemsGaleria));
            fetch("/admin/galeria/<?php echo $this->action ?>", {
                method: "POST",
                body: data
            }).then(function(res) {
                return res.text()
            }).then(function(res) {
                if (res.trim() == "OK") {
                    mostrarAlert('Galería <?php echo $this->action == 'guardar' ? 'guardada' : 'editada' ?> correctamente', 'success');
                } else {
                    mostrarAlert(res, 'error');
                }
            });
        }

        const insertImagenxLink = () => {
            const uri = prompt('Ingrese el link de la imagen');
            if (uri) {
                agregarItem('default', 'img', uri);
            }
        }

        const cargarArchivos = () => {
            if (cont >= arrFotos.length) {
                mostrarAlert('Ya no existe más archivos que mostrar', 'warning');
                return;
            }
            let mbody = document.querySelector('.modal-body');
            let html = document.getElementById("row-fotos").innerHTML;
            let vmax = (cont + 24) >= arrFotos.length ? arrFotos.length : (cont + 24);
            for (let i = cont; i < vmax; i++) {
                const element = arrFotos[i];
                html += `<div class="col-sm-2 my-2"> <div class="box-enlace-img" onclick="agregarItem('${element.name}', '${element.tipo}', '${element.path}')"> <div class="enlace-img">${element.name}</div><img src="${element.path}" width="100%" height="170" style="object-fit: cover;"> </div></div>`;
            }
            cont += arrFotos.length < 24 ? arrFotos.length : 24;
            document.getElementById("row-fotos").innerHTML = html;
            document.getElementById("cant-files").innerText = vmax + ' resultados';
            mbody.scrollTop = mbody.scrollHeight;
        }

        const mostrarAlert = (mensaje, icon) => {
            Swal.fire({
                icon: icon,
                text: mensaje,
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    if (icon === 'success') {
                        location.href = '/admin/galeria';
                    }
                }
            });;
        }

        listImagenes();
        cargarArchivos();

        setTimeout(() => {
            let loader = document.getElementById('preloader');
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500);
        }, 2500);
    </script>

</body>

</html>