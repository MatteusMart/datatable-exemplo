<?php 



// arquivo de funçoes genericas que podem ser utilizadas em qq pagina

// função que valuda o preenchimento de uma variavel
function validaCampoVazio($campo,$nomedocampo){
    
      if($campo == ''){
        $return = array('retorno'=>'erro',
                        'message' => 'Preencha o campo '.$nomedocampo.'! ');

        // Cria um json com relação ao array acima
        $json = json_encode($return, JSON_UNESCAPED_UNICODE);

        echo $json;
        exit();
    }
    
}
// funçao generica que executa uma query de adicionar, atualizar ou remover registros

function insertUpdateDelete($sql,$mensagemretorno){
    include 'include/conexao.php';

    $stmt = $con->prepare($sql);

    $stmt->execute();

    $return = array('retorno'=>'ok',
                    'message' => $mensagemretorno);

    // Cria um json com relação ao array acima
    $json = json_encode($return, JSON_UNESCAPED_UNICODE);

    echo $json;
}

function pdocatch($erro){
    // tratamento de erro ou exceção
    $retorno = array('retorno'=>'erro',
                     'mensagem'=>$erro->getMessage());

    $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

    echo $json;

}