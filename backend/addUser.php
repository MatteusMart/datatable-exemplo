<?php

include 'include/conexao.php';

try {

    $name = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['senha'];
    $confirmPassword = $_POST['confirmar'];

    if ($password != $confirmPassword) {
        // Cria um array para armazenar a mensagem de erro
        $return = array('retorno'=>'erro',
                        'message' => 'As senhas não conferem ');

        // Cria um json com relação ao array acima
        $json = json_encode($return, JSON_UNESCAPED_UNICODE);

        echo $json;
        exit();
    }

    $sql = "INSERT INTO tb_usuarios (`name`, email, `password`) VALUES ('$name', '$email', '$password')";

    $stmt = $con->prepare($sql);

    $stmt->execute();

    $return = array('retorno'=>'ok',
                    'message' => 'Usuário cadastrado com sucesso');

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
