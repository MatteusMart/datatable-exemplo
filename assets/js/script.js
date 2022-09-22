
    // document.ready define scripts JS que serão executados assim que a página for carregada , que a página estiver "pronta"
    $(document).ready( function () {
      // executa a funçao de listar usuarios
      listUser();

      // inicia a datatable
      // $('#tabela').DataTable({
      //   "language":{
      //     url:'\\//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
      //   }
      // });
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

          result.retorno == 'ok' ? listUser() : ''
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
      let datahora = moment().format('DD/MM/YY HH:mm')

      $('#horario-atualizado').html(datahora)

      // destroi a tabela que foi iniciada
      $("#tabela").dataTable().fnDestroy();

      // limpa os dados da tabela 
      $('#tabela-dados').html('')

      // função que irá molstrar as linhas da tabela , o map é um tipo de laço (for)
      result.map(usuario=>{
      $('#tabela-dados').append(`
              <tr>
                <td>${usuario.name}</td>
                <td>${usuario.email}</td>
                <td class="text-center">
                  <button type="button" class="btn btn-sm btn-primary  w-30"><i class="bi bi-pencil-square"></i></button>
                  <button type="button" class="btn btn-sm btn-danger  w-30"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
              `)
              })
              $('#tabela').DataTable({
                "language":{
                  url:'//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
                }
              });
          })

  }
