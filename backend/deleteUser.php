<?php
     include 'include/conexao.php';

     try{
        $id= $_POST['id'];

         $sql = "DELETE FROM tb_usuarios WHERE id = $id";

         $comando = $con->prepare($sql);

        $comando->execute();

        $return = array('retorno'=>'ok',
                        'message' => 'Usuário excluido com sucesso');

    // Cria um json com relação ao array acima
    $json = json_encode($return, JSON_UNESCAPED_UNICODE);

    echo $json;
     }catch(PDOException $erro){
         // tratamento de erro ou exceção
    $retorno = array('retorno'=>'erro',
    'mensagem'=>$erro->getMessage());

    $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

    echo $json;
    }
    $con = null;

?>