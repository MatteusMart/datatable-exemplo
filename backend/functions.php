<?php 

include_once'include/conexao.php';




global $con;



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

    $stmt = $GLOBALS['con']->prepare($sql);

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
                     'message'=>$erro->getMessage());

    $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

    echo $json;

}

function checkEmailUser($email){

    // comando sql que será executado no banco
    $sql = "SELECT email FROM tb_usuarios WHERE email ='$email'";

    $comando = $GLOBALS['con']->prepare($sql);

    $comando->execute();

    $validaEmail = $comando->fetchALL(PDO::FETCH_ASSOC);

    // retorna a variavel retorno
    // quando utilizamos return = será retornado um valor pela funçao
    // quando utilizamos echo = é exibido uma informação na tela
    if($validaEmail != null){
        $retorno = array('retorno'=>'erro',
                         'message'=>'Email já cadastrado, verifique e tente novmente'
                    );

    $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

    echo $json;
    exit;
    }

    function geraTokenUsuario($email){
        $sql = "SELECT id FROM tb_usuarios WHERE email ='$email'";

        $comando = $GLOBALS['con']->prepare($sql);

        $comando->execute();

        $dados = $comando->fetch(PDO::FETCH_ASSOC);

        $idUsuario = $dados['id'];

        // gera um token unico de ativação de conta de usuario
        $token = md5(Uniqid($email));

        $sql = "INSERT INTO tb_usuarios_token(fk_id_usuarios,
        token) VALUES ($idUsuario,'$token')";

        $comando = $GLOBALS['con']->prepare($sql);

        $comando->execute();

        // retorna o token gerado,para ser enviado por email
        return $token;

    }


}