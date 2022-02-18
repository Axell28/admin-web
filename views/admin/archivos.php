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
                <?php echo $this->translate('ARCHIVOS'); ?>
            </div>
            <div class="ms-auto d-flex" style="align-items: center;">
                <div class="me-4"><input type="search" v-model="buscar" class="form-control bg-light" placeholder="<?php echo $this->translate('Buscar archivos'); ?>"></div>
                <label class="btn btn-success text-white px-3" for="fileupload">
                    <span><i class="fas fa-cloud-upload-alt"></i></span>
                    <span class="ms-1" id="loadtext"><?php echo $this->translate('Cargar archivo'); ?></span>
                </label>
                <input type="file" id="fileupload" size="60120" accept="image/*" @change.prevent="cargarArchivo()">
            </div>
        </div>
        <hr>
        <div class="row pt-1 pb-3">
            <div class="col-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="position: sticky; top: 5.5em;">
                    <button class="nav-link active text-start d-flex" id="tab-fotos-tab" data-bs-toggle="pill" data-bs-target="#tab-fotos" type="button" role="tab" aria-controls="tab-fotos" aria-selected="true" @click="tabactive = 0"><span><i class="far fa-folder-open"></i>&nbsp; <?php echo $this->translate('Imagenes'); ?></span></button>
                    <button class="nav-link text-start d-flex" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false" @click="tabactive = 1"><span><i class="far fa-folder-open"></i></i>&nbsp; <?php echo $this->translate('Banner'); ?></span></button>
                    <button class="nav-link text-start d-flex" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" @click="tabactive = 2"><i class="far fa-folder-open"></i></i>&nbsp; <?php echo $this->translate('Videos'); ?></button>
                    <button class="nav-link text-start d-flex" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" @click="tabactive = 3"><i class="far fa-folder-open"></i></i>&nbsp; <?php echo $this->translate('Archivos'); ?></button>
                </div>
            </div>
            <div class="col">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-fotos" role="tabpanel" aria-labelledby="tab-fotos-tab">
                        <table class="table border-top">
                            <thead>
                                <tr>
                                <th style="width: 40px; font-weight: bold;">#</th>
                                    <th class="text-start fw-bold"> <?php echo $this->translate('NOMBRE DE ARCHIVO'); ?></th>
                                    <th style="width: 80px; font-weight: bold;"><?php echo $this->translate('TIPO'); ?></th>
                                    <th style="width: 100px; font-weight: bold;"><?php echo $this->translate('TAMAÑO'); ?></th>
                                    <th style="width: 180px; font-weight: bold;"><?php echo $this->translate('MODIFICACIÓN'); ?></th>
                                    <th style="width: 165px; font-weight: bold;"><?php echo $this->translate('OPCIONES'); ?></th>
                                </tr>
                            </thead>
                            <tbody style="border-top: none;">
                                <tr v-for="(item, index) in arrImages">
                                    <td>{{index + 1}}</td>
                                    <td class="text-start"><a :href="item.path" target="_blank" style="word-break: break-all;">{{item.name}}</a></td>
                                    <td>{{item.tipo}}</td>
                                    <td>{{item.size}}</td>
                                    <td>{{item.date}}</td>
                                    <td>
                                        <button class="btn btn-outline-primary mx-1" title="Copiar enlace" @click="copiarEnlace(item.path)"><i class="fas fa-paste"></i></button>
                                        <a :href="item.path" class="btn btn-outline-success mx-1" :download="item.name" title="Descargar"><i class="fas fa-file-download"></i></a>
                                        <button class="btn btn-outline-danger mx-1" title="Eliminar" @click="eliminarArchivo(item.path)" :disabled="item.remove"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                <tr v-show="arrImages.length == 0">
                                    <td colspan="6"><?php echo $this->translate('No se encontrarón archivos'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <table class="table border-top">
                            <thead>
                                <tr>
                                    <th style="width: 40px; font-weight: bold;">#</th>
                                    <th class="text-start fw-bold"> <?php echo $this->translate('NOMBRE DE ARCHIVO'); ?></th>
                                    <th style="width: 80px; font-weight: bold;"><?php echo $this->translate('TIPO'); ?></th>
                                    <th style="width: 100px; font-weight: bold;"><?php echo $this->translate('TAMAÑO'); ?></th>
                                    <th style="width: 180px; font-weight: bold;"><?php echo $this->translate('MODIFICACIÓN'); ?></th>
                                    <th style="width: 165px; font-weight: bold;"><?php echo $this->translate('OPCIONES'); ?></th>
                                </tr>
                            </thead>
                            <tbody style="border-top: none;">
                                <tr v-for="(item, index) in arrBanner">
                                    <td>{{index + 1}}</td>
                                    <td class="text-start"><a :href="item.path" target="_blank" style="word-break: break-all;">{{item.name}}</a></td>
                                    <td>{{item.tipo}}</td>
                                    <td>{{item.size}}</td>
                                    <td>{{item.date}}</td>
                                    <td>
                                        <button class="btn btn-outline-primary mx-1" title="Copiar enlace" @click="copiarEnlace(item.path)"><i class="fas fa-paste"></i></button>
                                        <a :href="item.path" class="btn btn-outline-success mx-1" :download="item.name" title="Descargar"><i class="fas fa-file-download"></i></a>
                                        <button class="btn btn-outline-danger mx-1" title="Eliminar" @click="eliminarArchivo(item.path)" :disabled="item.remove"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                <tr v-show="arrBanner.length == 0">
                                    <td colspan="6"><?php echo $this->translate('No se encontrarón archivos'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <table class="table border-top">
                            <thead>
                                <tr>
                                    <th style="width: 40px; font-weight: bold;">#</th>
                                    <th class="text-start fw-bold"> <?php echo $this->translate('NOMBRE DE ARCHIVO'); ?></th>
                                    <th style="width: 80px; font-weight: bold;"><?php echo $this->translate('TIPO'); ?></th>
                                    <th style="width: 100px; font-weight: bold;"><?php echo $this->translate('TAMAÑO'); ?></th>
                                    <th style="width: 180px; font-weight: bold;"><?php echo $this->translate('MODIFICACIÓN'); ?></th>
                                    <th style="width: 165px; font-weight: bold;"><?php echo $this->translate('OPCIONES'); ?></th>
                                </tr>
                            </thead>
                            <tbody style="border-top: none;">
                                <tr v-for="(item, index) in arrVideos">
                                    <td>{{index + 1}}</td>
                                    <td class="text-start"><a :href="item.path" target="_blank" style="word-break: break-all;">{{item.name}}</a></td>
                                    <td>{{item.tipo}}</td>
                                    <td>{{item.size}}</td>
                                    <td>{{item.date}}</td>
                                    <td>
                                        <button class="btn btn-outline-primary mx-1" title="Copiar enlace" @click="copiarEnlace(item.path)"><i class="fas fa-paste"></i></button>
                                        <a :href="item.path" class="btn btn-outline-success mx-1" :download="item.name" title="Descargar"><i class="fas fa-file-download"></i></a>
                                        <button class="btn btn-outline-danger mx-1" title="Eliminar" @click="eliminarArchivo(item.path)" :disabled="item.remove"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                <tr v-show="arrVideos.length == 0">
                                    <td colspan="6"><?php echo $this->translate('No se encontrarón archivos'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <table class="table border-top">
                            <thead>
                                <tr>
                                    <th style="width: 40px; font-weight: bold;">#</th>
                                    <th class="text-start fw-bold"> <?php echo $this->translate('NOMBRE DE ARCHIVO'); ?></th>
                                    <th style="width: 80px; font-weight: bold;"><?php echo $this->translate('TIPO'); ?></th>
                                    <th style="width: 100px; font-weight: bold;"><?php echo $this->translate('TAMAÑO'); ?></th>
                                    <th style="width: 180px; font-weight: bold;"><?php echo $this->translate('MODIFICACIÓN'); ?></th>
                                    <th style="width: 165px; font-weight: bold;"><?php echo $this->translate('OPCIONES'); ?></th>
                                </tr>
                            </thead>
                            <tbody style="border-top: none;">
                                <tr v-for="(item, index) in arrFiles">
                                    <td>{{index + 1}}</td>
                                    <td class="text-start"><a :href="item.path" target="_blank" style="word-break: break-all;">{{item.name}}</a></td>
                                    <td>{{item.tipo}}</td>
                                    <td>{{item.size}}</td>
                                    <td>{{item.date}}</td>
                                    <td>
                                        <button class="btn btn-outline-primary mx-1" title="Copiar enlace" @click="copiarEnlace(item.path)"><i class="fas fa-paste"></i></button>
                                        <a :href="item.path" class="btn btn-outline-success mx-1" :download="item.name" title="Descargar"><i class="fas fa-file-download"></i></a>
                                        <button class="btn btn-outline-danger mx-1" title="Eliminar" @click="eliminarArchivo(item.path)" :disabled="item.remove"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                <tr v-show="arrFiles.length == 0">
                                    <td colspan="6"><?php echo $this->translate('No se encontrarón archivos'); ?></td>
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
                    buscar: '',
                    tabactive: 0,
                    pathFiles: ['/img/galeria/', '/img/banner/', '/video/', '/files/'],
                    arrImages: [],
                    arrBanner: [],
                    arrVideos: [],
                    arrFiles: []
                }
            },
            created() {
                this.listarArchivos(0);
                this.listarArchivos(1);
                this.listarArchivos(2);
                this.listarArchivos(3);
            },
            watch: {
                tabactive: (val) => {
                    if (val == 0 || val == 1) {
                        document.getElementById("fileupload").setAttribute("accept", "image/*");
                    } else if (val == 2) {
                        document.getElementById("fileupload").setAttribute("accept", "video/*");
                    } else if (val == 3) {
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
                    if (tab == 0) {
                        this.arrImages = JSON.parse(json);
                    } else if (tab == 1) {
                        this.arrBanner = JSON.parse(json);
                    } else if (tab == 2) {
                        this.arrVideos = JSON.parse(json);
                    } else if (tab == 3) {
                        this.arrFiles = JSON.parse(json);
                    }
                },
                cargarArchivo() {
                    const vue = this;
                    const uri = "/admin/archivos/guardar";
                    const fileup = document.getElementById("fileupload").files[0];
                    const sizekb = parseInt(fileup.size / 1024);
                    if (sizekb > 60120) {
                        this.mostrarAlert("<?php echo $this->translate('El archivo supera el límite del peso permitido, Max(60MB)'); ?>", "warning");
                    } else {
                        document.getElementById("fileupload").disabled = true;
                        let http = new XMLHttpRequest();
                        let data = new FormData();
                        data.append("path", `${this.pathFiles[this.tabactive] + vue.limpiarNameFile(fileup.name)}`);
                        data.append("dirc", vue.tabactive == 1 ? 'banner' : '');
                        data.append("file", fileup);
                        http.open("post", uri);
                        http.upload.addEventListener("progress", function(e) {
                            let status = Math.round((e.loaded / e.total) * 100);
                            document.getElementById("loadtext").innerText = "Subiendo " + status + "%";
                        });
                        http.addEventListener("load", function() {
                            let res = http.responseText;
                            document.getElementById("loadtext").innerText = "<?php echo $this->translate('Cargar archivo'); ?>";
                            document.getElementById("fileupload").disabled = false;
                            if (res.trim() == "OK") {
                                vue.listarArchivos(vue.tabactive);
                                vue.mostrarAlert("<?php echo $this->translate('Archivo subido correctamente'); ?>", "success");
                            } else {
                                vue.mostrarAlert(res, "error");
                                document.getElementById("fileupload").disabled = false;
                            }
                        });
                        http.send(data);
                    }
                },
                eliminarArchivo(path) {
                    let vue = this;
                    Swal.fire({
                        icon: 'question',
                        text: '<?php echo $this->translate('¿Está seguro de eliminar este archivo?'); ?>',
                        showDenyButton: true,
                        allowOutsideClick: false,
                        confirmButtonText: '<?php echo $this->translate('Aceptar'); ?>',
                        denyButtonText: '<?php echo $this->translate('Cancelar'); ?>',
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            let uri = "/admin/archivos/eliminar";
                            let data = new FormData();
                            data.append("path", path);
                            let resp = await this.requestAJAX(uri, data);
                            if (resp.trim() == "OK") {
                                vue.listarArchivos(vue.tabactive);
                                vue.mostrarAlert("<?php echo $this->translate('Archivo eliminado'); ?>", "success");
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
                    this.mostrarAlert("<?php echo $this->translate('Enlace copiado al portapapeles'); ?>", "success");
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