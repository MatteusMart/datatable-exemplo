
    // document.ready define scripts JS que serão executados assim que a página for carregada , que a página estiver "pronta"
    $(document).ready( function () {
      // executa a funçao de listar usuarios
      listUser();

      // inicia a datatable
      $('#tabela').DataTable({
        "language":{
          url:'\\//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
        }
      });
    } );


    // função que add usuário
    const addUser = () => {
        // captura todo o formulario
        let dados = new FormData($('#form-usuarios')[0]);

        // captura todo usuario e cria um formData
        const result = fetch('backend/addUser.php', {
            method: 'POST',
            body: dados
        })
        .then((response)=>response.json())
        .then((result)=>{
          // aqui é tratado o retorno ao front 
          Swal.fire({
            title: result.retorno == 'ok' ? 'sucesso' : 'erro',
            text: result.message,
            icon: result.retorno == 'ok' ? 'success' : 'error'
          })

          // limpa os campos caso o retorno tenha sucesso
          // utilização do if ternario para a redução de escrita de codigo
          result.retorno == 'ok' ? $('#form-usuarios')[0].reset() : ''
     })
      
};
  //final da função addUser
  
  // função que lista os usuarios cadastrados
  const listUser = () => {
    // captura todo o formulario
    let dados = new FormData($('#form-usuarios')[0]);

    // captura todo usuario e cria um formData
    const result = fetch('backend/listUser.php', {
        method: 'POST',
        body: dados
    })
    .then((response)=>response.json())
    .then((result)=>{
      // aqui é tratado o retorno ao fronto
      result.map(usuarios=>{
      $('#tabela-dados').append(`
              <tr>
                <td>${usuario.nome}</td>
                <td>${usuario.email}</td>
                <td class="text-center">
                  <button type="button" class="btn btn-sm btn-primary  w-30">Alterar</button>
                  <button type="button" class="btn btn-sm btn-danger  w-30">Excluir</button>
                </td>
              </tr>
              `)

      })

    })

  }
