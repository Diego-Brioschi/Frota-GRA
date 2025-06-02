<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel='icon' type='image/png' sizes='192x192'  href='https://dodoifarma.com.br/Admin/img/android-icon-192x192.png'>
    <link rel='icon' type='image/png' sizes='32x32' href='https://dodoifarma.com.br/Admin/img/favicon-32x32.png'>

    <title>GRA Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Inclui os Menus -->
            <?php include('includes/menu.php'); ?> 

            <!--Divider-->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

               <!-- Inclui o Header -->
            <?php include('includes/header.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

     <!-- Inclui Footer -->
     <?php include('includes/footer.php'); ?> 

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function () {
            Swal.fire({
            title: '<strong>FROTA GRA</strong>',
            allowOutsideClick: false,
            width: '800px',
            html: '<div class="text-center"><b>SELECIONE UMA OPÇÃO ABAIXO</b></div>',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: '<i class="bi bi-speedometer"></i><b> CONTROLE DE KM</b>',
                denyButtonText: `<i class="bi bi-fuel-pump-fill"></i><b> ABASTECIMENTO/MANUTEN&Ccedil&AtildeO</b>`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = 'controle_frota_diario.php';
                    } else if (result.isDenied) {
                        location.href = 'controle_frota_combustivel.php';
                    }
                });
        });
    </script>

</body>

</html>