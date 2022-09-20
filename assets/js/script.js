
    // document.ready define scripts JS que serão executados assim que a página for carregada , que a página estiver "pronta"
    $(document).ready( function () {
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
            title: 'Sucesso!!!!!',
            text: result.message,
            icon: 'success',
          })
     })   
}   
