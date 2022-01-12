<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - <?php echo EMPRESA ?></title>
    <link rel="shortcut icon" href="<?php echo WEBURL ?>/assets/img/icons/escudo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo WEBURL ?>/assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
</head>

<body>

    <!-- scripts -->
    <script src="<?php echo WEBURL ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo WEBURL ?>/assets/js/vue.min.js"></script>
    <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>

    <!-- styles -->
    <style>
        #fileupload {
            display: none;
        }

        table .btn {
            width: 32px;
            height: 31px;
            padding: 0;
        }

        table a.btn {
            padding-top: 2px;
        }
    </style>

    <!-- includes -->
    <?php include_once 'includes/header.php'; ?>
    <?php include_once 'includes/menu.php'; ?>

    <!-- contenido principal -->
    <main class="content" id="app">

        <div id="preloader">
            <div class="loading">
                <div class="circle"></div>
            </div>
        </div>

        <div class="d-flex px-1" style="align-items: center;">
            <div class="tab-titulo">
                ARCHIVOS
            </div>
            <div class="ms-auto">
                <label class="btn btn-primary text-white px-3" for="fileupload">
                    <span><i class="fas fa-cloud-upload-alt"></i></span>
                    <span class="ms-1" id="loadtext">Cargar archivo</span>
                </label>
                <input type="file" id="fileupload" size="40120" accept="image/*" @change.prevent="cargarArchivo()">
            </div>
        </div>
        <hr>
        <div class="row pt-1 pb-3">
            <div class="col-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active text-start" id="tab-fotos-tab" data-bs-toggle="pill" data-bs-target="#tab-fotos" type="button" role="tab" aria-controls="tab-fotos" aria-selected="true" @click="tabactive = 1"><i class="far fa-folder"></i>&nbsp; Imagenes</button>
                    <button class="nav-link text-start" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false" @click="tabactive = 2"><i class="far fa-folder"></i>&nbsp; Banner</button>
                    <button class="nav-link text-start" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" @click="tabactive = 3"><i class="far fa-folder"></i>&nbsp; Videos</button>
                    <button class="nav-link text-start" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" @click="tabactive = 4"><i class="far fa-folder"></i>&nbsp; Archivos</button>
                </div>
            </div>
            <div class="col">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-fotos" role="tabpanel" aria-labelledby="tab-fotos-tab">
                        <table class="table border-top">
                            <thead>
                                <tr>
                                    <th style="width: 40px; font-weight: bold;">#</th>
                                    <th class="text-start fw-bold">NOMBRE DE ARCHIVO</th>
                                    <th style="width: 80px; font-weight: bold;">TIPO</th>
                                    <th style="width: 100px; font-weight: bold;">TAMAÑO</th>
                                    <th style="width: 180px; font-weight: bold;">MODIFICACIÓN</th>
                                    <th style="width: 165px; font-weight: bold;">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody style="border-top: none;">
                                <tr v-for="(item, index) in arrayImages">
                                    <td>{{index + 1}}</td>
                                    <td class="text-start"><a :href="item.path" target="_blank" style="word-break: break-all;">{{item.name}}</a></td>
                                    <td>{{item.tipo}}</td>
                                    <td>{{item.size}}</td>
                                    <td>{{item.date}}</td>
                                    <td>
                                        <button class="btn btn-outline-info mx-1" title="Copiar enlace" @click="copiarEnlace(item.path)"><i class="fas fa-paste"></i></button>
                                        <a :href="item.path" class="btn btn-outline-success mx-1" :download="item.name" title="Descargar"><i class="fas fa-file-download"></i></a>
                                        <button class="btn btn-outline-danger mx-1" title="Eliminar" @click="eliminarArchivo(item.path)"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                <tr v-show="arrayImages.length == 0">
                                    <td colspan="6">No se encontrarón archivos</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <table class="table border-top">
                            <thead>
                                <tr>
                                    <th style="width: 40px; font-weight: bold;">#</th>
                                    <th class="text-start fw-bold">NOMBRE DE ARCHIVO</th>
                                    <th style="width: 80px; font-weight: bold;">TIPO</th>
                                    <th style="width: 100px; font-weight: bold;">TAMAÑO</th>
                                    <th style="width: 180px; font-weight: bold;">MODIFICACIÓN</th>
                                    <th style="width: 165px; font-weight: bold;">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody style="border-top: none;">
                                <tr v-for="(item, index) in arrayBanner">
                                    <td>{{index + 1}}</td>
                                    <td class="text-start"><a :href="item.path" target="_blank" style="word-break: break-all;">{{item.name}}</a></td>
                                    <td>{{item.tipo}}</td>
                                    <td>{{item.size}}</td>
                                    <td>{{item.date}}</td>
                                    <td>
                                        <button class="btn btn-outline-info mx-1" title="Copiar enlace" @click="copiarEnlace(item.path)"><i class="fas fa-paste"></i></button>
                                        <a :href="item.path" class="btn btn-outline-success mx-1" :download="item.name" title="Descargar"><i class="fas fa-file-download"></i></a>
                                        <button class="btn btn-outline-danger mx-1" title="Eliminar" @click="eliminarArchivo(item.path)"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                <tr v-show="arrayBanner.length == 0">
                                    <td colspan="6">No se encontrarón archivos</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <table class="table border-top">
                            <thead>
                                <tr>
                                    <th style="width: 40px; font-weight: bold;">#</th>
                                    <th class="text-start fw-bold">NOMBRE DE ARCHIVO</th>
                                    <th style="width: 80px; font-weight: bold;">TIPO</th>
                                    <th style="width: 100px; font-weight: bold;">TAMAÑO</th>
                                    <th style="width: 180px; font-weight: bold;">MODIFICACIÓN</th>
                                    <th style="width: 165px; font-weight: bold;">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody style="border-top: none;">
                                <tr v-for="(item, index) in arrayVideos">
                                    <td>{{index + 1}}</td>
                                    <td class="text-start"><a :href="item.path" target="_blank" style="word-break: break-all;">{{item.name}}</a></td>
                                    <td>{{item.tipo}}</td>
                                    <td>{{item.size}}</td>
                                    <td>{{item.date}}</td>
                                    <td>
                                        <button class="btn btn-outline-info mx-1" title="Copiar enlace" @click="copiarEnlace(item.path)"><i class="fas fa-paste"></i></button>
                                        <a :href="item.path" class="btn btn-outline-success mx-1" :download="item.name" title="Descargar"><i class="fas fa-file-download"></i></a>
                                        <button class="btn btn-outline-danger mx-1" title="Eliminar" @click="eliminarArchivo(item.path)"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                <tr v-show="arrayVideos.length == 0">
                                    <td colspan="6">No se encontrarón archivos</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <table class="table border-top">
                            <thead>
                                <tr>
                                    <th style="width: 40px; font-weight: bold;">#</th>
                                    <th class="text-start fw-bold">NOMBRE DE ARCHIVO</th>
                                    <th style="width: 80px; font-weight: bold;">TIPO</th>
                                    <th style="width: 100px; font-weight: bold;">TAMAÑO</th>
                                    <th style="width: 180px; font-weight: bold;">MODIFICACIÓN</th>
                                    <th style="width: 165px; font-weight: bold;">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody style="border-top: none;">
                                <tr v-for="(item, index) in arrayFiles">
                                    <td>{{index + 1}}</td>
                                    <td class="text-start"><a :href="item.path" target="_blank" style="word-break: break-all;">{{item.name}}</a></td>
                                    <td>{{item.tipo}}</td>
                                    <td>{{item.size}}</td>
                                    <td>{{item.date}}</td>
                                    <td>
                                        <button class="btn btn-outline-info mx-1" title="Copiar enlace" @click="copiarEnlace(item.path)"><i class="fas fa-paste"></i></button>
                                        <a :href="item.path" class="btn btn-outline-success mx-1" :download="item.name" title="Descargar"><i class="fas fa-file-download"></i></a>
                                        <button class="btn btn-outline-danger mx-1" title="Eliminar" @click="eliminarArchivo(item.path)"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                <tr v-show="arrayFiles.length == 0">
                                    <td colspan="6">No se encontrarón archivos</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- code javascript -->
    <script>
        new Vue({
            el: '#app',
            data() {
                return {
                    tabactive: "1",
                    pathFiles: ['', '/img/galeria/', '/img/banner/', '/video/', '/files/'],
                    arrayImages: [],
                    arrayBanner: [],
                    arrayVideos: [],
                    arrayFiles: []
                }
            },
            created() {
                this.listarArchivos("1");
                this.listarArchivos("2");
                this.listarArchivos("3");
                this.listarArchivos("4");
            },
            watch: {
                tabactive: (val) => {
                    if (val == 1 || val == 2) {
                        document.getElementById("fileupload").setAttribute("accept", "image/*");
                    } else if (val == 3) {
                        document.getElementById("fileupload").setAttribute("accept", "video/*");
                    } else if (val == 4) {
                        document.getElementById("fileupload").setAttribute("accept", ".xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf,.rar,.zip,.mp3");
                    }
                }
            },
            methods: {
                async listarArchivos(tab) {
                    let uri = "/admin/archivos/listar";
                    let data = new FormData();
                    data.append("path", this.pathFiles[tab]);
                    let json = await this.requestAJAX(uri, data);
                    if (tab == "1") {
                        this.arrayImages = JSON.parse(json);
                    } else if (tab == "2") {
                        this.arrayBanner = JSON.parse(json);
                    } else if (tab == "3") {
                        this.arrayVideos = JSON.parse(json);
                    } else if (tab == "4") {
                        this.arrayFiles = JSON.parse(json);
                    }
                },
                cargarArchivo() {
                    const vue = this;
                    const uri = "/admin/archivos/guardar";
                    const fileup = document.getElementById("fileupload").files[0];
                    const sizekb = parseInt(fileup.size / 1024);
                    if (sizekb > 40120) {
                        this.mostrarAlert("El archivo supera el límite del peso permitido, Max(40MB)", "warning");
                    } else {
                        document.getElementById("fileupload").disabled = true;
                        let http = new XMLHttpRequest();
                        let data = new FormData();
                        data.append("path", `${this.pathFiles[this.tabactive] + vue.limpiarNameFile(fileup.name)}`);
                        data.append("file", fileup);
                        http.open("post", uri);
                        http.upload.addEventListener("progress", function(e) {
                            let status = Math.round((e.loaded / e.total) * 100);
                            document.getElementById("loadtext").innerText = "Subiendo " + status + "%";
                        });
                        http.addEventListener("load", function() {
                            let res = http.responseText;
                            document.getElementById("loadtext").innerText = "Cargar archivo";
                            document.getElementById("fileupload").disabled = false;
                            if (res.trim() == "OK") {
                                vue.listarArchivos(vue.tabactive);
                                vue.mostrarAlert("Archivo subido correctamente", "success");
                            } else {
                                vue.mostrarAlert(res, "error");
                            }
                        });
                        http.send(data);
                    }
                },
                eliminarArchivo(path) {
                    let vue = this;
                    Swal.fire({
                        icon: 'question',
                        text: '¿Está seguro de eliminar este archivo?',
                        showDenyButton: true,
                        allowOutsideClick: false,
                        confirmButtonText: 'Aceptar',
                        denyButtonText: 'Cancelar',
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            let uri = "/admin/archivos/eliminar";
                            let data = new FormData();
                            data.append("path", path);
                            let resp = await this.requestAJAX(uri, data);
                            if (resp.trim() == "OK") {
                                vue.listarArchivos(vue.tabactive);
                                vue.mostrarAlert("Archivo eliminado", "success");
                            } else {
                                vue.mostrarAlert(resp, "error");
                            }
                        }
                    });
                },
                copiarEnlace(path) {
                    let link = location.origin + path;
                    let aux = document.createElement("input");
                    aux.setAttribute("value", link);
                    document.body.append(aux);
                    aux.select();
                    document.execCommand("copy");
                    aux.remove();
                    this.mostrarAlert("Enlace copiado al portapapeles", "success");
                },
                requestAJAX(uri, data) {
                    const resp = fetch(uri, {
                        method: 'POST',
                        body: data
                    }).then((res) => {
                        return res.text();
                    }).then((res) => {
                        return res;
                    });
                    return resp;
                },
                mostrarAlert(mensaje, type) {
                    if (type == 'success') {
                        Swal.fire({
                            icon: 'success',
                            text: mensaje,
                            showConfirmButton: false,
                            timer: 1800
                        });
                    } else {
                        Swal.fire({
                            icon: type,
                            text: mensaje,
                        });
                    }
                },
                limpiarNameFile(str) {
                    str = str.replace(/\s+/g, '-');
                    str = str.normalize("NFD").replace(/[\u0300-\u036f]/g, '');
                    return str;
                }
            }
        });
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