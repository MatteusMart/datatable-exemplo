<?php

    // incluide do arquivo de conexao
    include 'include/conexao.php';

    try{

        $nome      = $_POST['nome'];
        $email     = $_POST['email'];
        $senha     = $_POST['senha'];
        $confirmar = $_POST['confirmar'];

        if($senha != $confirmar){
            // cria um array para armazenar a mensagem de erro
            $retorno = array('Mensagem' =>'Senhas não conferem, veriifique e tente novamente');
            // cria uma variavel que ira receber o array acima convertido em JSON
            $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

            // retorno em formato json
            echo $json;
            // encerra o script
            exit;
        }   

        $sql = "INSERT INTO tb_cadastro (nome, email, senha) values ('$nome','$email','$senha')";

        $comando = $conexao->prepare($sql);

        $comando->execute();

        $retorno = array('Mensagem' =>'Usuario adicionado com sucesso!');
        // cria uma variavel que ira receber o array acima convertido em JSON
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

        // retorno em formato json
        echo $json;




    }catch(PDOException $erro){
       
    }