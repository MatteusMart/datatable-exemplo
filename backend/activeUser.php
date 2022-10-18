<?php
    include 'include/conexao.php';

    try{
        $token = $_GET['token'];

        $sql = "UPDATE tb_usuarios u  INNER JOIN tb_usuarios_token t on t.fk_id_usuarios
        = u.id SET u.ativo = 1 WHERE t.token = $toke";
    }catch(PDOException $erro){

    }

?>