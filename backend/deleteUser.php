<?php
     include 'functions.php';

     try{
        $id= $_POST['id'];

         $sql = "DELETE FROM tb_usuarios WHERE id = $id";

        $msg = "Usuário Deletado com sucesso!";


        insertUpdateDelete($sql,$msg);

     }catch(PDOException $erro){
       pdocatch($erro);
    }

?>