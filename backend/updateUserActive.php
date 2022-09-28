<?php

include 'include/conexao.php';

try {

    $id = $_POST['id'];

    $sql = "UPDATE tb_usuarios SET `status` = NOT `status` WHERE id =$id";

    $stmt = $con->prepare($sql);

    $stmt->execute();

    $return = array('retorno'=>'ok',
                    'message' => 'Status alterado com sucesso');

    // Cria um json com relação ao array acima
    $json = json_encode($return, JSON_UNESCAPED_UNICODE);

    echo $json;
} catch (PDOException $erro) {
    // tratamento de erro ou exceção
    $retorno = array('retorno'=>'erro',
                     'mensagem'=>$erro->getMessage());

    $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

    echo $json;

}
// fechar a conexão
$con = null;
