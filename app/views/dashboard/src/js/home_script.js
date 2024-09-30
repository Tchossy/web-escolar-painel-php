const base_URL =
  '/_web/web-escolar-painel-php//app/views/dashboard/src/controllers/'

const nameAdmStorage = localStorage.getItem('adm_name')

const nameAdm = document.getElementById('name_adm')
const logout = document.getElementById('logout')

nameAdm.innerText = nameAdmStorage

logout.addEventListener('click', async () => {
  const dataAdm = await fetch(
    origin_url + base_URL + 'admControllers.php?type_form=logout_adm'
  )

  const response = await dataAdm.text()

  location.reload()
})
