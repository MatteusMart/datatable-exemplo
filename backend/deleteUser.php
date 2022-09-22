<?php
     include 'include/conexao.php';

     try{
         $sql "DELETE * FROM tb_usuarios WHERE id = $id";

         $comando = $con->prepare($sql);

        $comando->execute();

     }catch(PDOException $erro){

    }
?>