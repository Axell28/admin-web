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
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css"> -->
</head>

<body>

    <!-- scripts -->
    <script src="<?php echo WEBURL ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo WEBURL ?>/assets/js/vue.min.js"></script>
    <!-- <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script> -->

    <!-- styles -->
    <style>
        img.cover {
            object-fit: cover;
        }

        img.cover:hover {
            cursor: pointer;
        }
    </style>

    <!-- includes -->
    <?php include_once 'includes/header.php'; ?>
    <?php include_once 'includes/menu.php'; ?>

    <!-- contenido principal -->
    <main class="content" id="app">
        <!-- loading -->
        <div id="preloader">
            <div class="loading">
                <div class="circle"></div>
            </div>
        </div>
        <div class="d-flex px-1" style="align-items: center;">
            <div class="tab-titulo">
                GALERÍA
            </div>
            <div class="ms-auto d-flex" style="align-items: center;">
                <button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#modalFiles">
                    <i class="fas fa-search"></i>&nbsp; Buscar imagenes
                </button>
                <button class="btn btn-success text-white">
                    <i class="fas fa-plus"></i>&nbsp; Guardar galería
                </button>
            </div>
        </div>
        <hr>

        <!-- ventana modal -->
        <div class="modal fade" id="modalFiles" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h5 class="modal-title">Buscar imagenes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal-body">
                        <div class="row">
                            <div class="col-md-3 my-2" v-for="(item, index) in arrayFiles">
                                <div style="position: relative;">
                                    <div style="position: absolute; width: 100%; bottom: 0;">
                                        <div style="background: rgba(0, 0, 0, .4); width: 100%; padding: 5px 10px; color: white;">
                                            {{item.name}}
                                        </div>
                                    </div>
                                    <img :src="item.path" class="shadow-sm cover" width="100%" height="170">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white d-flex">
                        <span>{{ arrayFiles.length }} de <?php echo $this->totalArchivos ?> resultados</span>
                        <a class="text-primary ms-auto" @click="listarArchivos()" style="cursor: pointer;">Cargar más resultados &nbsp;<i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
        const modalFiles = new bootstrap.Modal(document.getElementById('modalFiles'));
        /* modalFiles.show(); */

        new Vue({
            el: '#app',
            data() {
                return {
                    arrayFiles: [],
                    inicio: 0,
                    limite: 16
                }
            },
            created() {
                this.listarArchivos();
            },
            methods: {
                listarArchivos() {
                    let vue = this;
                    let uri = `/admin/galeria/files/${vue.inicio}/${vue.limite}`;
                    fetch(uri, {
                        method: "GET"
                    }).then(function(res) {
                        return res.text()
                    }).then(function(res) {
                        let data = JSON.parse(res);
                        let nuevaList = vue.arrayFiles.concat(data);
                        vue.arrayFiles = nuevaList;
                        vue.inicio = vue.limite;
                        vue.limite += 16;
                    });
                }
            }
        });

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