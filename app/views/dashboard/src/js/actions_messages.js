const baseURL =
  '/_web/web-escolar-painel-php//app/views/dashboard/src/controllers/'
const controllerURL = '/_web/web-escolar-painel-php//app/controllers/'

const origin_url = window.location.origin

const tbody = document.querySelector('tbody')

const msgAlerta = document.getElementById('msgAlertaErroCad')
const msgEditAlerta = document.getElementById('msgAlertaErroEditCard')

const listMessages = async () => {
  const dataUsers = await fetch(
    origin_url +
      baseURL +
      'messageContactControllers.php?typeForm=get_all_messages'
  )

  const response = await dataUsers.text()

  tbody.innerHTML = response
}

listMessages()

async function confirmDelete(idMessages) {
  await fetch(
    origin_url +
      baseURL +
      'messageContactControllers.php?typeForm=delete_messages&idMessages=' +
      idMessages
  )
  listMessages()
}

function deleteMessages(idMessages) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    }
    // buttonsStyling: false
  })

  swalWithBootstrapButtons
    .fire({
      title: 'Tem certeza que pretende eliminar esta mensagem?',
      text: 'Você não será capaz de reverter está acção!',
      icon: 'warning',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      showCancelButton: true,
      confirmButtonText: 'Sim, exclua!',
      cancelButtonText: 'Não, cancelar!',
      reverseButtons: true
    })
    .then(result => {
      if (result.isConfirmed) {
        confirmDelete(idMessages)
        swalWithBootstrapButtons.fire(
          'Excluído!',
          'A mensagem foi excluído.',
          'success'
        )
        listMessages()
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === swalWithBootstrapButtons.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Não excluído',
          ' mensagem não foi excluído :)',
          'error'
        )
      }
    })
}

async function detailsMessages(idMessages) {
  const dataUsers = await fetch(
    origin_url +
      baseURL +
      'messageContactControllers.php?typeForm=get_message&idMessages=' +
      idMessages
  )

  const response = await dataUsers.json()
  if (response['error']) {
    alert(response['msg'])
  } else {
    const messagesData = response['dados']

    console.log(messagesData)
    const cadModal = document.getElementById('messageDetailModal')

    cadModal.style.visibility = 'visible'
    cadModal.classList.add('show')

    // console.log(response['dados'])

    document.getElementById('id_detail').innerText = messagesData.id
    document.getElementById('name_user_detail').innerText =
      messagesData.name_user
    document.getElementById('email_user_detail').innerText =
      messagesData.email_user
    document.getElementById('summary_detail').innerText = messagesData.summary
    document.getElementById('message_detail').innerText = messagesData.message
    document.getElementById('date_create_detail').innerText =
      messagesData.date_create
  }
}
