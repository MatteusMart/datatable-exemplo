<?php

include 'functions.php';

try {

    $nome = 'Mateus';
    $curso = 'informatica';
    $periodo = 'noite';

    $sql = "INSERT INTO tb_aluno (nome,curso,periodo)VALUES('$nome','$curso','$periodo')";

    $msg ="Aluno cadastrado com sucesso";

    insertUpdateDelete($sql,$msg);

} catch (PDOException $erro) {
    pdocatch($erro);
}
// fechar a conexão
$con = null;
