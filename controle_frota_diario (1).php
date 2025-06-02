<?php 
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

 ?>


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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">


</head>

<body id="page-top">

<style>
#overlay {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    display: none; /* Inicialmente oculto */
}

/* Estilos para o spinner */
.custom-loader {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    border: 9px solid #4306A1;
    animation: spinner-bulqg1 0.8s infinite linear alternate,
               spinner-oaa3wk 1.6s infinite linear;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

@keyframes spinner-bulqg1 {
    0% {
        clip-path: polygon(50% 50%, 0 0, 50% 0%, 50% 0%, 50% 0%, 50% 0%, 50% 0%);
    }
    12.5% {
        clip-path: polygon(50% 50%, 0 0, 50% 0%, 100% 0%, 100% 0%, 100% 0%, 100% 0%);
    }
    25% {
        clip-path: polygon(50% 50%, 0 0, 50% 0%, 100% 0%, 100% 100%, 100% 100%, 100% 100%);
    }
    50% {
        clip-path: polygon(50% 50%, 0 0, 50% 0%, 100% 0%, 100% 100%, 50% 100%, 0% 100%);
    }
    62.5% {
        clip-path: polygon(50% 50%, 100% 0, 100% 0%, 100% 0%, 100% 100%, 50% 100%, 0% 100%);
    }
    75% {
        clip-path: polygon(50% 50%, 100% 100%, 100% 100%, 100% 100%, 100% 100%, 50% 100%, 0% 100%);
    }
    100% {
        clip-path: polygon(50% 50%, 50% 100%, 50% 100%, 50% 100%, 50% 100%, 50% 100%, 0% 100%);
    }
}

@keyframes spinner-oaa3wk {
    0% {
        transform: scaleY(1) rotate(0deg);
    }
    49.99% {
        transform: scaleY(1) rotate(135deg);
    }
    50% {
        transform: scaleY(-1) rotate(0deg);
    }
    100% {
        transform: scaleY(-1) rotate(-135deg);
    }
}
</style>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="mb-5">


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 mt-4 text-gray-800">Controle de KM</h1>

                    <form id="form_controle_diario" enctype="multipart/form-data">
                        <!--<div class="form-group">
                            <label for="sel_placa_moto" class="font-weight-bold text-dark">Placa o Ve&iacuteculo</label>
                            <input type="text" value="" class="form-control" id="sel_placa_moto" style="text-transform:uppercase" required>
                        </div>-->
                        <div class="form-group">
                             <label for="sel_placa_moto" class="font-weight-bold text-dark">Placa o Ve&iacuteculo</label>
                             <select class="selectpicker border border-secondary form-control" data-live-search="true" id="sel_placa_moto" data-width="100%" title="Selecione a placa...">
                             </select>
                        </div>
                        <div class="form-group">
                            <label for="motorista" class="font-weight-bold text-dark">N&uacutemero do Motorista (A7):</label>
                            <input type="number" value="" class="form-control border border-secondary" id="motorista" required>
                        </div>
                        <div class="form-group">
                            <label for="km" class="font-weight-bold text-dark">KM atual:</label>
                            <input type="number" class="form-control border border-secondary" id="km" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="data" class="font-weight-bold text-dark">Data:</label>
                            <input type="text" disabled value="<?php echo date('d/m/Y H:i'); ?>" class="form-control border border-secondary" id="data" required>
                        </div>
                        <div class="form-group">
                            <label for="imagem" class="font-weight-bold text-dark">Fotografe o  od&ocircmetro:</label>
                            <input type="file" class="form-control-file rounded border border-secondary" id="imagem" required accept="image/*;capture=camera">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg" id="btn_save">Registrar</button>
                        </div>
                    </form>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker();

		function showCustomLoading() {
			// Adiciona o overlay ao body
			$('<div id="overlay"><div class="custom-loader"></div></div>').appendTo('body');
			// Exibe o overlay
			$('#overlay').fadeIn();
		}

		// Função para finalizar o loading
		function hideCustomLoading() {
			// Oculta e remove o overlay do body
			$('#overlay').fadeOut(function() {
				$(this).remove();
			});
		}

            //Get All Placas
            $.ajax({
                url: "php/frota/get_all_placas.php",
                data: {},
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    var option = '';
                    $.each(json, function(i, obj) {
                        option += "<option value='" + obj.id + "'>" +obj.veiculo + " - " + obj.placa + "</option>";
                    });
                    $('#sel_placa_moto').html(option).show().selectpicker('refresh');
                }
            });

            $(document).on("change", "#sel_placa_moto", function() {
                var id = $('#sel_placa_moto :selected').val();
                $.ajax({
                    url: "php/frota/get_km_revisao.php",
                    data: {id:id},
                    type: 'post',
                    success: function(data) {
                        var json = JSON.parse(data);

                        // Função para verificar se está perto de fazer revisão
                        function estaPertoDeRevisao(kmAtual, kmUltimaRevisao, intervaloRevisao, kmAviso) {
                            const kmDesdeUltimaRevisao = kmAtual - kmUltimaRevisao;
                            const kmParaProximaRevisao = intervaloRevisao - (kmDesdeUltimaRevisao % intervaloRevisao);
                            return kmParaProximaRevisao <= kmAviso;
                        }

                        // Exemplo de uso:
                        const kmAtual = json.quilometragem; // Exemplo de quilometragem atual obtida do banco de dados
                        const kmUltimaRevisao = json.ultimarevisao; // Exemplo de quilometragem da última revisão
                        const intervaloRevisao = 6000; // Intervalo de revisão a cada 6000 km
                        const kmAviso = 300; // Considera "perto" se faltarem 500 km ou menos para a revisão

                        if (estaPertoDeRevisao(kmAtual, kmUltimaRevisao, intervaloRevisao, kmAviso)) {
                            if(kmAtual <= 48000){
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Este veÃ­culo estÃ¡ prÃ³ximo da revisÃ£o!',
                                    html: `
                                        <h3 style="color:white;font-weight:bold;text-align:center;">A revisÃ£o ja foi realizada ?</h3>
                                    `,
                                    showDenyButton: true,
                                    showCancelButton: false,
                                    confirmButtonText: `<i class="bi bi-check-circle"></i><b> SIM</b>`,
                                    denyButtonText: `<i class="bi bi-x-circle"></i><b> N&AtildeO</b>`,
                                    focusConfirm: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey : false,
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $.ajax({
                                                url: "php/frota/submit_realizacao_revisao.php",
                                                data: {
                                                    km:kmAtual,
                                                    veiculoid:id
                                                },
                                                type: 'post',
                                                success: function(data) {
                                                    var json = JSON.parse(data);
                                                    var status = json.status;
                                                    if(status == 'true'){
                                                        location.reload();
                                                    }else{
                                                        location.reload();
                                                    }
                                                }
                                            });
                                            
                                        }
                                });
                            }
                        }

                    }
                });
            });

            //Submit Controle Diario
            $(document).on("submit", "#form_controle_diario", function(e) {
                e.preventDefault();
                showCustomLoading();
                //var veiculo = $('#sel_placa_moto').val();
                var veiculo = $('#sel_placa_moto :selected').val();
                var km = parseFloat($('#km').val());
                var motorista = $('#motorista').val();
                var imagem = $('#imagem').prop('files')[0];
                var form_data = new FormData();
                form_data.append("veiculo", veiculo);
                form_data.append("km", km);
                form_data.append("motorista", motorista);
                form_data.append("imagem", imagem);
                if((veiculo != '') && (km != '') && (motorista != '')){
                    $.ajax({
                        url: "php/frota/submit_controle_quilometragem.php",
                        dataType: 'script',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function(data) {
                            var json = JSON.parse(data);
                            var status = json.status;
                            if (status === 'true') {
                                $('#form_controle_diario').trigger('reset');
                                hideCustomLoading();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Registro enviado com Sucesso !',
                                    }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.href = 'controle_frota.php';
                                    }
                                });
                            }else{
                                location.reload();
                            }
                        }
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Preencha todos os campos !'
                    })
                }
            });
        });
    </script>

</body>

</html>