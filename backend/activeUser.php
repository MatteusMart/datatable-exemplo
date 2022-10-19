<?php
    include 'include/conexao.php';

    try{
        $token = $_GET['token'];

        $sql = "UPDATE tb_usuarios u  INNER JOIN tb_usuarios_token t on t.fk_id_usuarios
        = u.id SET u.ativo = 1 WHERE t.token = $token";

        $msg = 'Ativada com seucesso!';

        $comando = $con->prepare($sql);

        $comando->execute();

        $retorno = true;


    }catch(PDOException $erro){

        $retorno = false;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Sistema Senac - Ativação de Cadastro</title>
</head>
<body>
    <div id="container-sm">
        <div class="alert <?php echo $retorno == true ? 'alert-success' : 'alert-danger';?>"
        role="alert">
            <?php
                echo $retorno != 0 ? 'Cadastro ativado com sucesso!' : 'Erro ao ativar cadastro';
            ?>
            <a href="../index.html">
            <button type="button" class="btn- btn-primary">Acessar Sistema
            </button>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>