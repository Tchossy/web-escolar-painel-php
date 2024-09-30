const baseURL = '/app/views/base/src/controllers/'
const controllerURL = '/app/controllers/'

const origin_url = window.location.origin

const cardForm = document.getElementById('messageForm')
const msgAlerta = document.getElementById('msgAlertaErroCad')

const btnExit = document.getElementById('btn_exit')

cardForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(cardForm)
  dataForm.append('add', 1)

  const dataNewUser = await fetch(
    origin_url + baseURL + 'messageContactControllers.php',
    {
      method: 'POST',
      body: dataForm
    }
  )

  const response = await dataNewUser.json()

  console.log(response)

  if (response['error']) {
    msgAlerta.innerHTML = response['msg']
  } else {
    msgAlerta.innerHTML = response['msg']
    cardForm.reset()
  }

  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 5000)
})
