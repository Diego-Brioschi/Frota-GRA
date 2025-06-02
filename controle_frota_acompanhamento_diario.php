<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

    $con = mysqli_connect('mysql.dodoifarma.com.br:3306', 'dodoifarma', 'dodoifarma2021', 'dodoifarma');
    $con->set_charset('utf8');

    /*$sql = "SELECT 
        un.codigo, 
        fv.veiculo, 
        fv.placa, 
        fq.registros, 
        fq.registro, 
        format(fq.quilometragem,0,'de_DE') as quilometragem,
        u.name,
        fq.userid,
        fq.imagem,
        fv.id as veiculoid,
        SUM(fcom.valor) AS combu_valor,
        SUM(fmanu.valor) AS manu_valor
    FROM 
        frota_veiculos fv 
    JOIN 
        (SELECT 
            fq1.veiculoid,
            COUNT(fq1.id) AS registros, 
            DATE_FORMAT(MAX(fq1.data),'%d/%m/%Y %H%:%i')  AS registro, 
            MAX(fq1.quilometragem) AS quilometragem,
            fq1.userid,
            fq1.imagem
        FROM 
            frota_quilometragem fq1
        JOIN 
            (SELECT 
                veiculoid,
                MAX(data) AS max_data
            FROM 
                frota_quilometragem
            GROUP BY 
                veiculoid) AS fq2 ON fq1.veiculoid = fq2.veiculoid AND fq1.data = fq2.max_data
        GROUP BY 
            fq1.veiculoid, fq1.userid, fq1.imagem) AS fq ON fq.veiculoid = fv.id
    LEFT JOIN 
        users u ON u.user_name = fq.userid
    LEFT JOIN 
        unidadenegocio un ON un.id = u.lojaid
    LEFT JOIN 
        frota_abastecimento fcom ON fcom.veiculoid = fv.id AND DATE_FORMAT(fcom.data, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m') and fcom.tipo = 'combustivel'
    LEFT JOIN 
        frota_abastecimento fmanu ON fmanu.veiculoid = fv.id AND DATE_FORMAT(fmanu.data, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m') and fmanu.tipo = 'manutencao'
    GROUP BY
        un.codigo, fv.veiculo, fv.placa, fq.registros, fq.registro, fq.quilometragem, u.name, fq.userid, fq.imagem, fv.id
    ORDER BY 
        un.codigo ASC, fq.registro DESC;";*/
    $sql = "SELECT 
    un.codigo, 
    fv.veiculo, 
    fv.placa, 
    fq.registros, 
    fq.registro, 
    format(fq.quilometragem,0,'de_DE') as quilometragem,
    u.name,
    fq.userid,
    fq.imagem,
    fv.id as veiculoid,
    COALESCE(fc.combu_valor, 0) AS combu_valor,
    COALESCE(fm.manu_valor, 0) AS manu_valor
FROM 
    frota_veiculos fv 
JOIN 
    (SELECT 
        fq1.veiculoid,
        COUNT(fq1.id) AS registros, 
        DATE_FORMAT(MAX(fq1.data),'%d/%m/%Y %H:%m')  AS registro, 
        MAX(fq1.quilometragem) AS quilometragem,
        fq1.userid,
        fq1.imagem
    FROM 
        frota_quilometragem fq1
    JOIN 
        (SELECT 
            veiculoid,
            MAX(data) AS max_data
        FROM 
            frota_quilometragem
        GROUP BY 
            veiculoid) AS fq2 ON fq1.veiculoid = fq2.veiculoid AND fq1.data = fq2.max_data
    GROUP BY 
        fq1.veiculoid, fq1.userid, fq1.imagem) AS fq ON fq.veiculoid = fv.id
LEFT JOIN 
    users u ON u.user_name = fq.userid
LEFT JOIN 
    unidadenegocio un ON un.id = u.lojaid
LEFT JOIN 
    (SELECT 
        veiculoid, 
        SUM(valor) AS combu_valor
    FROM 
        frota_abastecimento 
    WHERE 
        DATE_FORMAT(data, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m') 
        AND tipo = 'combustivel'
    GROUP BY 
        veiculoid) AS fc ON fc.veiculoid = fv.id
LEFT JOIN 
    (SELECT 
        veiculoid, 
        SUM(valor) AS manu_valor
    FROM 
        frota_abastecimento 
    WHERE 
        DATE_FORMAT(data, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m') 
        AND tipo = 'manutencao'
    GROUP BY 
        veiculoid) AS fm ON fm.veiculoid = fv.id
GROUP BY
    un.codigo, fv.veiculo, fv.placa, fq.registros, fq.registro, fq.quilometragem, u.name, fq.userid, fq.imagem, fv.id
ORDER BY 
    un.codigo ASC, fq.registro DESC;
";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Inclui Logo e Versão -->
            <?php include('includes/system.php'); ?> 

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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Acompanhamento da Frota</h1>
                      
                    <div class="table-responsive" style="overflow: visible;">
                    <table class="table table-striped table-sm table-bordered">
                        <thead>
                        <tr style="color: black;">
                            <th class="text-center">Loja</th>
                            <th>Veículo</th>
                            <th class="text-center">Placa</th>
                            <th class="text-center">Ultimo Registro</th>
                            <th class="text-center">KM</th>
                            <th>Colaborador</th>
                            <th class="text-center">Abastecimento (<?php echo date('m/Y'); ?>)</th>
                            <th class="text-center">Manutenção (<?php echo date('m/Y'); ?>)</th>
                            <th class="text-center">Detalhes</th>
                        </tr>
                        </thead>
                        <tbody style="color: black;">
                        <?php foreach($row as $row){ ?>
                        <tr>
                            <td class="text-center"><?php echo $row['codigo']; ?></td>
                            <td><?php echo $row['veiculo']; ?></td>
                            <td class="text-center"><?php echo $row['placa']; ?></td>
                            <td class="text-center"><?php echo $row['registro']; ?></td>
                            <td class="text-center"><?php echo $row['quilometragem']; ?> <a href="https://dodoifarma.com.br/Admin/img/frota/quilometragem/<?php echo $row['imagem']; ?>" target="_blank"><i class="fa fa-camera" aria-hidden="true"></i></a></td>
                            <td><?php echo $row['name']; ?></td>
                            <td class="text-center">R$: <?php echo number_format($row['combu_valor'], 2, ',', '.'); ?></td>
                            <td class="text-center">R$: <?php echo number_format($row['manu_valor'], 2, ',', '.'); ?></td>
                            <td><button class="btnDetalhes btn btn-primary" data-id="<?php echo $row['veiculoid']; ?>">Detalhes</button></td>

                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    </div>

		    <div class="modal" id="modalDetalhesManu">
		       <div class="modal-dialog modal-xl">
			  <div class="modal-content">
				 <!-- Modal Header -->
				 <div class="modal-header">
					<h4 class="modal-title">Detalhes Abastecimento e Manutenção</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				 </div>
				 <!-- Modal body -->
				 <div class="modal-body">
					<div class="row">
					   <div class="col">
						  <h5>Combustivel</h5>
						  <table class="table table-bordered table-sm">
							 <thead>
								<tr>
								   <th>Loja</th>
								   <th>Entregador</th>
								   <th>Data</th>
								   <th>Valor</th>
								   <th>KM</th>
								</tr>
							 </thead>
							 <tbody id="tbody_combu_detalhado">
							 </tbody>
						  </table>
					   </div>
					   <div class="col">
						  <h5>Manutenção</h5>
						  <table class="table table-bordered table-sm">
							 <thead>
								<tr>
								   <th>Loja</th>
								   <th>Entregador</th>
								   <th>Data</th>
								   <th>Valor</th>
								   <th>KM</th>
								</tr>
							 </thead>
							 <tbody id="tbody_manu_detalhado">
							 </tbody>
						  </table>
					   </div>
					</div>
				 </div>
				 <!-- Modal footer -->
				 <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
				 </div>
			  </div>
		     </div>
		</div>

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

    <script>
        $(document).ready(function () {
            $(document).on("click", ".btnDetalhes", function(e) {
                var veiculoid = $(this).data('id');
                $.ajax({
                    url: "php/frota/get_detalhes_manu.php",
                    data: {
                        veiculoid:veiculoid 
                    },
                    type: 'post',
                    success: function (data) {
                        var json = JSON.parse(data);
                        var combu = json.combu;
                        var manu = json.manu;
                        var result_combu = '';
                        var result_manu = '';
                        var current_combu = '';
                        var current_manu = '';
                        var current_combu_valor = 0;
                        var current_manu_valor = 0;
                        if(combu.length >= 1){
                            combu.forEach(function(e, index) {
                                
                                current_combu = e.data;
                                result_combu += '<tr style="color:black;">';
                                result_combu += '<td class="text-center">'+e.codigo+'</td>';
                                result_combu += '<td>'+e.name+'</td>';
                                result_combu += '<td class="text-center">'+e.dia+'</td>';
                                result_combu += '<td class="text-center">'+parseFloat(e.valor).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })+'</td>';
                                result_combu += '<td class="text-center">'+e.quilometragem+' <a href="https://dodoifarma.com.br/Admin/img/frota/abastecimento/'+e.imagem+'" target="_blank"><i class="fa fa-camera" aria-hidden="true"></i></td>';
                                result_combu += '</tr>';

                                if(current_combu != e.data){
                                    current_combu_valor = 0;
                                    current_combu_valor += parseFloat(e.valor);
                                    result_combu += '<tr style="color:black;">'; 
                                    result_combu += '<td class="bg-secondary">'+e.data+'</td>';
                                    result_combu += '<td class="bg-secondary text-center" colspan="4">'+parseFloat(current_combu_valor).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })+'</td>';
                                    result_combu += '</tr>';
                                }
                                
                                
                            });
                        }else{
                            result_combu += '<tr class="text-center font-weight-bold" style="color:black;"><td class="text-center" colspan="6">NENHUM RESULTADO ENCONTRADO</td></tr>';
                        }
                        if(manu.length >= 1){
                            manu.forEach(function(e, index) {
                                current_manu = e.data;
                                result_manu += '<tr style="color:black;">';
                                result_manu += '<td class="text-center">'+e.codigo+'</td>';
                                result_manu += '<td>'+e.name+'</td>';
                                result_manu += '<td class="text-center">'+e.dia+'</td>';
                                result_manu += '<td class="text-center">'+parseFloat(e.valor).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })+'</td>';
                                result_manu += '<td class="text-center">'+e.quilometragem+' <a href="https://dodoifarma.com.br/Admin/img/frota/abastecimento/'+e.imagem+'" target="_blank"><i class="fa fa-camera" aria-hidden="true"></i></td>';
                                result_manu += '</tr>';

                                if(current_manu != e.data){
                                    current_manu_valor = 0;
                                    current_manu_valor += parseFloat(e.valor);
                                    result_manu += '<tr style="color:black;">'; 
                                    result_manu += '<td class="bg-secondary">'+e.data+'</td>';
                                    result_manu += '<td class="bg-secondary text-center" colspan="4">'+parseFloat(current_manu_valor).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })+'</td>';
                                    result_manu += '</tr>';
                                }
                                
                                
                            });
                        }else{
                            result_manu += '<tr class="text-center font-weight-bold" style="color:black;"><td class="text-center" colspan="6">NENHUM RESULTADO ENCONTRADO</td></tr>';
                        }
                        console.log(result_combu);
                        $('#tbody_combu_detalhado').html(result_combu).show();
                        $('#tbody_manu_detalhado').html(result_manu).show();
                        $('#modalDetalhesManu').modal('show');
                    }
                });
            });
        });
    </script>



</body>

</html>
<?php 
}else{
     header("Location: login1.php");
     exit();
}
 ?>	