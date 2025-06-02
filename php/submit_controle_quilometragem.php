<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$con = mysqli_connect('mysql.dodoifarma.com.br:3306', 'dodoifarma', 'dodoifarma2021', 'dodoifarma');
$con->set_charset('utf8');

$veiculo = $_POST['veiculo'];
$quilometragem = $_POST['km'];
$userid = $_POST['motorista'];
$loja = 0;
$data = date('Y-m-d H:i:s');

$filename = md5($_FILES["imagem"]["name"].$data.$userid);

$target_directory = "/home/dodoifarma/www/Admin/img/frota/quilometragem/";
$target_file = $target_directory.basename($_FILES["imagem"]["name"]);
$filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$newfilename = $target_directory.$filename.".".$filetype;

//Nome sem Caminho para Query
$fileNameSql = $filename.".".$filetype;

if(move_uploaded_file($_FILES["imagem"]["tmp_name"],$newfilename)){
    $sql = "INSERT INTO frota_quilometragem (veiculoid,lojaid,userid,quilometragem,imagem,data) 
    VALUES ('$veiculo','$loja','$userid','$quilometragem','$fileNameSql','$data')";
    $query = mysqli_query($con, $sql); 

    if ($query == true) {

        $data = array(
            'status' => 'true',

        );

        echo json_encode($data);
    } else {
        $data = array(
            'status' => 'false',

        );

        echo json_encode($data);
    }
}

?>