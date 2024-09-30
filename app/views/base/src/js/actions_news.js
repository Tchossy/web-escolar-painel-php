const baseURL = '/web-consulado_ponta_negra-php/app/views/base/src/controllers/'
const controllerURL = '/web-consulado_ponta_negra-php/app/controllers/'

const origin_url = window.location.origin

const containerNews = document.getElementById('containerNews')

const email_true = localStorage.getItem('email_user')

const listNews = async () => {
  const dataNews = await fetch(
    origin_url + baseURL + 'newsControllers.php?typeForm=get_all_news'
  )

  const response = await dataNews.text()

  containerNews.innerHTML = response
}

listNews()
