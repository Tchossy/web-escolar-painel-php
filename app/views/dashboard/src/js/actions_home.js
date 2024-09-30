const baseURL =
  '/_web/web-escolar-painel-php//app/views/dashboard/src/controllers/'
const controllerURL = '/_web/web-escolar-painel-php//app/controllers/'

const origin_url = window.location.origin

const tbody = document.querySelector('tbody')
const todoList = document.getElementById('todo-list')
const num_admins = document.getElementById('num_admins')
const num_message = document.getElementById('num_message')
const num_new = document.getElementById('num_new')

const numAdmins = async () => {
  const dataAdmins = await fetch(
    origin_url + baseURL + 'homeController.php?typeAction=count_adm_users'
  )
  const response = await dataAdmins.text()

  num_admins.innerText = response
}
numAdmins()

const numMessage = async () => {
  const dataMessage = await fetch(
    origin_url + baseURL + 'homeController.php?typeAction=count_message'
  )
  const response = await dataMessage.text()

  num_message.innerText = response
}
numMessage()

const numNew = async () => {
  const dataNew = await fetch(
    origin_url + baseURL + 'homeController.php?typeAction=count_new'
  )
  const response = await dataNew.text()

  num_new.innerText = response
}
numNew()

const listAdmins = async () => {
  const dataAdmins = await fetch(
    origin_url + baseURL + 'homeController.php?typeAction=get_admins'
  )

  const response = await dataAdmins.text()

  tbody.innerHTML = response
}
listAdmins()

const listMessages = async () => {
  const dataMessages = await fetch(
    origin_url + baseURL + 'homeController.php?typeAction=get_messages'
  )

  const response = await dataMessages.text()

  todoList.innerHTML = response
}
listMessages()
