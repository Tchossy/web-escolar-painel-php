const baseURL =
  '/_web/web-escolar-painel-php//app/views/dashboard/src/controllers/'
const controllerURL = '/_web/web-escolar-painel-php/app/controllers/'

const origin_url = window.location.origin

const cardForm = document.getElementById('registerForm')
const msgAlerta = document.getElementById('msgAlertaErroCad')

const btnExit = document.getElementById('btn_exit')

cardForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(cardForm)
  dataForm.append('add', 1)

  const dataNewUser = await fetch(
    origin_url + baseURL + 'authorsControllers.php',
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
    localStorage.setItem('email_user', response['email_user'])
    window.location.replace(origin_url)
  }

  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 3000)
})
