const baseURL =
  '/_web/web-escolar-painel-php//app/views/dashboard/src/controllers/'
const controllerURL = '/_web/web-escolar-painel-php//app/controllers/'

const origin_url = window.location.origin

const tbody = document.querySelector('tbody')

const nameAdmNewsStorage = localStorage.getItem('adm_name')

const inputImagens = document.getElementById('inputImagens')
const containerImagens = document.getElementById('containerImagens')
const inputImagensEdit = document.getElementById('inputImagensEdit')
const containerImagensEdit = document.getElementById('containerImagensEdit')

const authorNews = document.getElementById('author_news')
const cardNewsForm = document.getElementById('formNews')
const cardEditNewsForm = document.getElementById('newsEditForm')
const msgAlerta = document.getElementById('msgAlertaErroCad')
const msgEditAlerta = document.getElementById('msgAlertaErroEditCard')

authorNews.value = nameAdmNewsStorage

inputImagens.addEventListener('change', function () {
  containerImagens.innerHTML = ''
  const files = this.files

  console.log(files[0])

  for (let i = 0; i < files.length; i++) {
    const file = files[i]
    const reader = new FileReader()

    reader.addEventListener('load', function () {
      const imagem = document.createElement('img')
      imagem.src = reader.result
      containerImagens.appendChild(imagem)
    })

    reader.readAsDataURL(file)
  }
})
inputImagensEdit.addEventListener('change', function () {
  containerImagensEdit.innerHTML = ''
  const files = this.files

  console.log(files[0])

  for (let i = 0; i < files.length; i++) {
    const file = files[i]
    const reader = new FileReader()

    reader.addEventListener('load', function () {
      const imagem = document.createElement('img')
      imagem.src = reader.result
      containerImagensEdit.appendChild(imagem)
    })

    reader.readAsDataURL(file)
  }
})

const listNews = async () => {
  const dataNews = await fetch(
    origin_url + baseURL + 'newsControllers.php?typeForm=get_all_news'
  )

  const response = await dataNews.text()

  tbody.innerHTML = response
}

listNews()

cardNewsForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(cardNewsForm)

  // for (var dados of dataForm.entries()) {
  //   console.log(dados[0] + ' ' + dados[1])
  // }

  const dataNew = await fetch(
    origin_url + baseURL + 'newsControllers.php?typeForm=create_news',
    {
      method: 'POST',
      body: dataForm
    }
  )

  window.console.log(dataForm)

  const response = await dataNew.json()

  if (response['error']) {
    msgAlerta.innerHTML = response['msg']
  } else {
    msgAlerta.innerHTML = response['msg']
    cardNewsForm.reset()
    listNews()
    containerImagens.innerHTML = ''
  }

  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 5000)

  listNews()
})

async function confirmDelete(idNews) {
  await fetch(
    origin_url +
      baseURL +
      'newsControllers.php?typeForm=delete_news&idNews=' +
      idNews
  )
  listNews()
}

function deleteNews(idNews) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    }
    // buttonsStyling: false
  })

  swalWithBootstrapButtons
    .fire({
      title: 'Tem certeza que pretende eliminar esta noticia?',
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
        confirmDelete(idNews)
        swalWithBootstrapButtons.fire(
          'Excluído!',
          'A noticia foi excluído.',
          'success'
        )
        listNews()
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === swalWithBootstrapButtons.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Não excluído',
          'O documento não foi excluído :)',
          'error'
        )
      }
    })
}

async function editeNews(idNews) {
  const dataNews = await fetch(
    origin_url +
      baseURL +
      'newsControllers.php?typeForm=get_news&idNews=' +
      idNews
  )

  const response = await dataNews.json()
  if (response['error']) {
    alert(response['msg'])
  } else {
    const newsData = response['dados']

    const decodeImage = JSON.parse(newsData.images_news)
    const cadModal = document.getElementById('newsEditeModal')

    containerImagensEdit.innerHTML = `<img src="${decodeImage[0]}" />`

    cadModal.style.visibility = 'visible'
    cadModal.classList.add('show')

    document.getElementById('description_news_edit').value =
      newsData.description_news
    console.log(document.getElementById('description_news_edit').value)

    document.getElementById('id_edit').value = newsData.id
    document.getElementById('category_news_edit').value = newsData.category_news
    document.getElementById('title_news_edit').value = newsData.title_news
    document.getElementById('description_news_edit').value =
      newsData.description_news
    document.getElementById('epigraph_news_edit').value = newsData.epigraph_news
    document.getElementById('author_epigraph_news_edit').value =
      newsData.author_epigraph_news
  }
}

cardEditNewsForm.addEventListener('submit', async event => {
  event.preventDefault()
  const dataEditForm = new FormData(cardEditNewsForm)

  // for (var dados of dataEditForm.entries()) {
  //   console.log(dados[0] + ' ' + dados[1] + ' ' + dados[2])
  // }

  dataEditForm.append('add', 1)

  const dataNew = await fetch(
    origin_url + baseURL + 'newsControllers.php?typeForm=edit_news',
    {
      method: 'POST',
      body: dataEditForm
    }
  )

  console.log(origin_url + baseURL + 'newsControllers.php?typeForm=edit_news')

  const response = await dataNew.json()

  if (response['error']) {
    msgEditAlerta.innerHTML = response['msg']
  } else {
    msgEditAlerta.innerHTML = response['msg']

    listNews()
  }

  listNews()

  setTimeout(() => {
    msgEditAlerta.innerHTML = ''
  }, 8000)
})
