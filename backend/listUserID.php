<?php
    include 'include/conexao.php';

    try{

        $id = $_POST['id'];

        // monta a query sql 
        $sql = "SELECT id,`name`,email, telefone, cpf, created_at, `status` FROM tb_usuarios WHERE id= $id";

        // prepara a execuçao
        $comando = $con->prepare($sql);

        // executa o comando
        $comando->execute();

        // variavel que irá guardar o resultado da execução do comando
        $retorno = $comando->fetchALL(PDO::FETCH_ASSOC);

        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

        echo $json;

}catch(PDOException $erro){
    $retorno = array(
                    'retorno' => 'erro',
                    'mensagem' =>$erro->getMessage()
                    
    );

    $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);
    
    echo $json;
   
}

$con = null;

?>