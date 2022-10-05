<?php 

include 'functions.php';

try {

    $name = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $password = $_POST['senha'];
    $confirmPassword = $_POST['confirmar'];

    validaCampoVazio($name,'nome');
    validaCampoVazio($email,'email');
    validaCampoVazio($telefone,'telefone');
    validaCampoVazio($cpf,'cpf');
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

    //criptografa a senha do usuario
    // alguns algoritimo de criptografia sha1, md5, password hash php
    $senha_cripto = sha1($password); 

    $sql = "INSERT INTO tb_usuarios (`name`, email,`telefone`,`cpf`, `password`) VALUES ('$name', '$email','$telefone','$cpf', '$senha_cripto')";

    $msg = "Usuário adicionado com sucesso!";

    insertUpdateDelete($sql,$msg);

} catch (PDOException $erro) {
    pdocatch($erro);
}
// fechar a conexão
$con = null;
