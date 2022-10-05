<?php 

include 'functions.php';

try {

    $name = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['senha'];
    $confirmPassword = $_POST['confirmar'];

    validaCampoVazio($name,'nome');
    validaCampoVazio($email,'email');
    validaCampoVazio($password,'senha');
    validaCampoVazio($confirmPassword,'confirmar senha');

    // exemplo simples de validaçao de preenchimento de variável

    // executa a função que verifica se o email ja ta cadastrado
    checkEmailUser($email);

    

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

    $msg = "Usuário adicionado com sucesso!";

    insertUpdateDelete($sql,$msg);

} catch (PDOException $erro) {
    pdocatch($erro);
}
// fechar a conexão
$con = null;
