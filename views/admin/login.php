<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <title>ADMIN - <?php echo EMPRESA ?></title>
</head>

<body>

    <!-- scripts -->
    <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>

    <!-- styles -->
    <style>
        body {
            height: 100vh;
            background: #2C4CAA;
        }

        main.card {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 340px;
            transform: translate(-50%, -53%);
            padding: 1% .8%;
        }
    </style>

    <!-- content -->
    <main class="card shadow">
        <div class="card-body">
            <div class="text-center pt-2 pb-3">
                <img src="<?php echo WEBURL ?>/assets/img/icons/escudo.png" height="130">
                <h4 class="fw-bold mt-3">AdminWeb</h4>
            </div>
            <form id="form-login" onsubmit="verificarAcceso(event)">
                <input type="text" name="name" class="form-control mb-3" placeholder="Nombre de usuario" required>
                <input type="password" name="pass" class="form-control mb-3" placeholder="Contraseña" required>
                <button class="btn btn-primary d-block w-100" type="submit">Ingresar&nbsp; <i class="fas fa-sign-in-alt"></i></button>
            </form>
        </div>
    </main>

    <section class="fixed-bottom text-center pb-3">
        <span style="color: rgba(255, 255, 255, .5);">AdminWeb.v4</span>
    </section>

    <!-- code javascript -->
    <script>
        function verificarAcceso(e) {
            e.preventDefault();
            let uri = "/admin/login/validarAcceso";
            let data = new FormData(document.getElementById('form-login'));
            fetch(uri, {
                method: "POST",
                mode: 'cors',
                body: data
            }).then(function(res) {
                return res.text()
            }).then(function(res) {
                if (res.trim() == "OK") {
                    location.href = '/admin/home';
                } else {
                    showAlert(res, "error");
                }
            });
        }

        function showAlert(mensaje, icon) {
            Swal.fire({
                icon: icon,
                text: mensaje,
            });
        }
    </script>
</body>

</html>