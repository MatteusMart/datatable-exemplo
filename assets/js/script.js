
    // document.ready define scripts JS que serão executados assim que a página for carregada , que a página estiver "pronta"
    $(document).ready( function () {
      // executa a funçao de listar usuarios
      listUser();

    //  utilizamos a biblioteca input mask para criar uma mascara de telefone
    $('#telefone').inputmask('(99)99999-99999')
    // inputmask campo cpf
    $('#cpf').inputmask('999.999.999.99')

    FechaLoader();

    } );


    // função que add usuário
    const addUser = () => {
      // ao clicar no add usuarios o loader é carregado
      AbreLoader();
      // valida se o nome foi preenchido
      let = nome = $('#nome').val()

      // valida se o nome foi preenchido com o js vanila

      // let = nome = document.getElementById('nome').value

      // if(nome == ''){
      //   Swal.fire({
      //     icon: 'error',
      //     tittle: 'Atenção',
      //     text: 'Preencha o nome!'
      //   })
      //   return
      // }

        // captura todo o formulario
        let dados = new FormData($('#form-usuarios')[0]);

        // captura todo usuario e cria um formData
        const result = fetch('backend/addUser.php', {
            method: 'POST',
            body: dados
        })
        .then((response)=>response.json())
        .then((result)=>{

          FechaLoader();
          // aqui é tratado o retorno ao front 
          Swal.fire({
            title: result.retorno == 'ok' ? 'sucesso' : 'error',
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
                <td>${moment(usuario.created_at).format('DD/MM/YY HH:mm')}</td>
                <td>
                  <div class="form-check form-switch">
                   <input class = "form-check-input" type="checkbox" role="switch" id="ativo" ${usuario.status == 1 ? 'checked' : ''} onchange="updateUserActive(${usuario.id})">
                  </div>
                </td>
                <td class="text-center">
                  <button type="button" class="btn btn-sm btn-primary   w-30" onclick="listUserID(${usuario.id})"><i class="bi bi-pencil-square"></i></button>
                  <button type="button" class="btn btn-sm btn-danger  w-30"><i class="bi bi-trash" onclick="deleteUser(${usuario.id})"></i></button>
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

          // <button type="button" class="btn btn-sm btn-${usuario.status == 1 ? 'success' : 'danger'}">${usuario.status == 1 ? 'Sim' : 'Não'}</button>
  }

  // função que altera o status de ativo de usuario

  const updateUserActive = (id) => {
    const result = fetch(`backend/updateUserActive.php`,{
      method: "POST",
      body : `id=${id}`,
      headers:{
        'content-type':'application/x-www-form-urlencoded'
      }
    })
    .then((response) =>response.json()) //retorna uma promise
    .then((result) => {
        Swal.fire({
          icon: result.retorno == 'ok' ? 'success' : 'error',
          title: result.message,
          showConfirmButton: false,
          timer: 2000
        })
    });
  }

  const deleteUser = (id) => {
    const result = fetch(`backend/deleteUser.php`,{
      method: "POST",
      body : `id=${id}`,
      headers:{
        'content-type':'application/x-www-form-urlencoded'
      }
    })
    .then((response) =>response.json()) //retorna uma promise
    .then((result) => {
        Swal.fire({
          icon: result.retorno == 'ok' ? 'success' : 'error',
          title: result.message,
          showConfirmButton: false,
          timer: 2000
        })
        // recarregar a tebela de usuarios
        listUser()
    });
  }

  const listUserID = (id) =>{
    // lista os dados dos usuarios por id, para a alteraçao 
    const result = fetch(`backend/listUserID.php`,{
      method: "POST",
      body : `id=${id}`,
      headers:{
        'content-type':'application/x-www-form-urlencoded'
      }
    })
    .then((response) =>response.json()) //retorna uma promise
    .then((result) => {

      // preenche os dados do form de editar usuarios
      $('#edita-nome').val(result[0].name)
      $('#edita-email').val(result[0].email)
      $('#edita-telefone').val(result[0].telefone)
      $('#edita-cpf').val(result[0].cpf)


      $('#edita-telefone').val(result[0].cpf)
      $('#edita-cpf').val(result[0].cpf)

      

      // exibe o modal apos receber os dados de ediçao
      const modalEditar = new bootstrap.Modal('#modal-editar-usuario')

      modalEditar.show()
    });
   
  }

  const updateUser = () =>{
    // igualzinho o adduser
    // js igual a funçao addUser
    // PHP igual o adduser.php
  }


  // apos o carregamento completo da pagina o pré loader é fechado
const FechaLoader = () => {
  $('.preloader').fadeOut("slow", 0);
}

const AbreLoader = () => {

  $('.preloader').fadeTo("slow", 1);
}