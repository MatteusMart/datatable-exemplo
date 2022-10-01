<?php

include 'functions.php';

try {

    $id = $_POST['id'];

    $sql = "UPDATE tb_usuarios SET `status` = NOT `status` WHERE id =$id";

    $msg ="Usuário alterado com sucesso";

    insertUpdateDelete($sql,$msg);

} catch (PDOException $erro) {
    pdocatch($erro);
}
// fechar a conexão
$con = null;
