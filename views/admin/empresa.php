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
    <script async src="<?php echo WEBURL ?>/assets/js/bootstrap.min.js"></script>
    <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>

    <!-- includes -->
    <?php include_once 'includes/header.php'; ?>
    <?php include_once 'includes/menu.php'; ?>

    <!-- styles -->
    <style>
        div.accordion-item {
            border: none;
            border-radius: 0px;
        }

        button.accordion-button {
            border: 1px solid rgb(170, 170, 170);
            background-color: #f8f8f8;
            border-radius: 0px;
            padding-top: 0px;
            padding-bottom: 0px;
            line-height: 47px;
        }

        button.accordion-button:not(.collapsed) {
            color: var(--color2);
            background-color: #f8f8f8;
            box-shadow: none;
            border-radius: 0px;
        }

        div.accordion-body {
            background-color: white;
            border: none;
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
                <?php echo $this->translate('EMPRESA'); ?>
            </div>
            <div class="ms-auto d-flex flex-row" style="align-items: center;">
                <button class="btn btn-success text-white" onclick="actualizarDatos()" type="button"><i class="fas fa-sync"></i>&nbsp; <?php echo $this->translate('Actualizar datos'); ?></button>
            </div>
        </div>
        <hr>

        <div class="accordion border-0 pt-2" id="accordionEmp">
            <?php
            foreach ($this->dataEmp as $key => $localEmp) : ?>
                <div class="accordion-item mb-3">
                    <button class="accordion-button fw-bold <?php echo $key > 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_<?php echo $key ?>" aria-expanded="true" aria-controls="collapse_<?php echo $key ?>">
                        <span style="font-size: 15px;" class="text-uppercase"><?php echo !empty($localEmp['nombre']) ? $localEmp['nombre'] : "LOCAL #" . ($key + 1) ?></span>
                        <i class="fas fa-chevron-down ms-auto" style="font-size: 17px;"></i>
                    </button>
                    <div id="collapse_<?php echo $key ?>" class="accordion-collapse <?php echo $key > 0 ? 'collapse' : 'collapse show' ?>" data-bs-parent="#accordionEmp">
                        <div class="accordion-body px-3">
                            <form onkeypress="return event.keyCode != 13;">
                                <div class="row">
                                    <div class="col-4 my-2">
                                        <span> <?php echo $this->translate('Nombre de la institución:'); ?> </span>
                                        <input type="text" class="form-control mt-1" name="nombre" value="<?php echo $localEmp['nombre'] ?>" required>
                                    </div>
                                    <div class="col-4 my-2">
                                        <span> <?php echo $this->translate('Teléfono:'); ?> </span>
                                        <input type="text" class="form-control mt-1" name="telefono" value="<?php echo $localEmp['telefono'] ?>">
                                    </div>
                                    <div class="col-4 my-2">
                                        <span> <?php echo $this->translate('Celular:'); ?> </span>
                                        <input type="text" class="form-control mt-1" name="celular" value="<?php echo $localEmp['celular'] ?>">
                                    </div>
                                </div>
                                <div class="row pt-1 pb-2">
                                    <div class="col-4 my-2">
                                        <span> <?php echo $this->translate('Dirreción:'); ?> </span>
                                        <input type="text" class="form-control mt-1" name="direction" value="<?php echo $localEmp['direction'] ?>" required>
                                    </div>
                                    <div class="col-4 my-2">
                                        <span> <?php echo $this->translate('Correo de contacto:'); ?> </span>
                                        <input type="email" class="form-control mt-1" name="correo" value="<?php echo $localEmp['correo'] ?>" required>
                                    </div>
                                    <div class="col-4 my-2" style="<?php echo $key > 0 ? 'display: none' : '' ?>">
                                        <span><i class="fas fa-info-circle text-muted" title="<?php echo $this->translate('En meta description podemos describir brevemente el contenido de la página web, su papel central influye de manera decisiva en la elección del usuario del mejor resultado acorde con su búsqueda, este meta tag es considerado uno de los más importantes en cuanto a la optimización para los buscadores.'); ?> " style="cursor: pointer;"></i> <?php echo $this->translate('Meta descripción:'); ?> </span>
                                        <textarea class="form-control mt-1" rows="1" name="metades" maxlength="350"><?php echo $localEmp['metades'] ?></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4 my-2">
                                        <span>Facebook:</span>
                                        <input type="text" class="form-control mt-1" name="facebook" value="<?php echo $localEmp['facebook'] ?>">
                                    </div>
                                    <div class="col-4 my-2">
                                        <span>Instagram:</span>
                                        <input type="text" class="form-control mt-1" name="instagram" value="<?php echo $localEmp['instagram'] ?>">
                                    </div>
                                    <div class="col-4 my-2">
                                        <span>Whatsapp:</span>
                                        <input type="text" class="form-control mt-1" name="whatsapp" value="<?php echo $localEmp['whatsapp'] ?>">
                                    </div>
                                </div>
                                <div class="row pt-1 pb-2">
                                    <div class="col-4 my-2">
                                        <span>Youtube:</span>
                                        <input type="text" class="form-control mt-1" name="youtube" value="<?php echo $localEmp['youtube'] ?>">
                                    </div>
                                    <div class="col-4 my-2">
                                        <span>Twitter:</span>
                                        <input type="text" class="form-control mt-1" name="twitter" value="<?php echo $localEmp['twitter'] ?>">
                                    </div>
                                    <div class="col-4 my-2">
                                        <span>Intranet:</span>
                                        <input type="text" class="form-control mt-1" name="intranet" value="<?php echo $localEmp['intranet'] ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4 my-2">
                                        <span> <?php echo $this->translate('Enlace a libro de reclamaciones:'); ?> </span>
                                        <input type="link" class="form-control mt-1" name="liblink" value="<?php echo $localEmp['liblink'] ?>">
                                    </div>
                                    <div class="col-4 my-2">
                                        <span> <?php echo $this->translate('Correo de reclamos:'); ?> </span>
                                        <input type="email" class="form-control mt-1" name="libmail" value="<?php echo $localEmp['libmail'] ?>">
                                    </div>
                                    <div class="col-4 my-2" style="<?php echo $key > 0 ? 'display: none' : '' ?>">
                                        <span> <?php echo $this->translate('Sonido de fondo:'); ?> </span>
                                        <select class="form-select mt-1" name="audio">
                                            <option value=""> <?php echo $this->translate('Ninguno'); ?> </option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" value="<?php echo $localEmp['idemp'] ?>" name="idemp">
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <br><br>
    </main>

    <!-- code javascript -->
    <script>
        const obtenerArrayDatos = () => {
            const empForms = document.querySelectorAll('form');
            const empDatos = [];
            empForms.forEach(form => {
                const data = new FormData(form);
                empDatos.push(Object.fromEntries(data.entries()));
            });
            return empDatos;
        }

        const actualizarDatos = async () => {
            const obj = await obtenerArrayDatos();
            const data = new FormData();
            data.append("data", JSON.stringify(obj));
            fetch("/admin/empresa/actualizar", {
                method: "POST",
                body: data
            }).then(function(res) {
                return res.text()
            }).then(function(res) {
                if (res.trim() == "OK") {
                    showAlert("<?php echo $this->translate('Todos los datos fueron actualizados') ?>", "success");
                } else {
                    showAlert(res, "error");
                }
            });
        }

        const showAlert = (mensaje, icon) => {
            Swal.fire({
                icon: icon,
                text: mensaje,
            });
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