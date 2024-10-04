const baseURL =
  '/_web/web-escolar-painel-php/app/views/dashboard/src/controllers/'

const origin_url = window.location.origin

const cardForm = document.getElementById('messageForm')
const msgAlerta = document.getElementById('msgAlertaErroCad')
const btnExit = document.getElementById('btn_exit')
const containerImagensEdit = document.getElementById('containerImagensEdit')

const createCourseForm = document.getElementById('createCourseForm')
const editCourseForm = document.getElementById('editCourseForm')

// Função para listar os cursos
const listCourses = async () => {
  const dataCourses = await fetch(
    `${origin_url}/_web/web-escolar-painel-php/app/views/dashboard/src/controllers/courseControllers.php?typeForm=get_all_courses`
  )
  const response = await dataCourses.text()
  document.querySelector('tbody').innerHTML = response
}

async function confirmDelete(id) {
  const data = await fetch(
    origin_url +
      baseURL +
      `courseControllers.php?typeForm=delete_course&idCourse=${id}`
  )
  const result = await data.json()

  return result
}

// Função para deletar um curso
function deleteCourse(id) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    }
    // buttonsStyling: false
  })

  swalWithBootstrapButtons
    .fire({
      title: 'Tem certeza que pretende eliminar este curso?',
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
        confirmDelete(id)
          .then(result => {
            console.log(result)
          })
          .catch(() => {
            console.log('Error')
          })
        swalWithBootstrapButtons.fire(
          'Excluído!',
          'O curso foi excluído.',
          'success'
        )
        listCourses()
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === swalWithBootstrapButtons.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Não excluído',
          'O curso não foi excluído :)',
          'error'
        )
      }
    })
}

// Função para carregar os dados do curso no formulário de edição
async function editCourse(id) {
  const data = await fetch(
    `${origin_url}/_web/web-escolar-painel-php/app/views/dashboard/src/controllers/courseControllers.php?typeForm=get_course&idCourse=${id}`
  )
  const result = await data.json()

  if (!result.error) {
    const courseData = result.dados

    const cadModalEdit = document.getElementById('courseEditModal')

    cadModalEdit.style.visibility = 'visible'
    cadModalEdit.classList.add('show')

    containerImagensEdit.innerHTML = `<img src="${courseData.image_course}" />`

    // Preenche os campos do formulário com os dados do curso
    document.getElementById('title_course_edit').value = courseData.title_course
    document.getElementById('description_course_edit').value =
      courseData.description_course
    document.getElementById('years_edit').value = courseData.years
    document.getElementById('period_edit').value = courseData.period
    document.getElementById('monthly_course_edit').value =
      courseData.monthly_course
    document.getElementById('course_structure_edit').value =
      courseData.course_structure
    document.getElementById('requerements_edit').value = courseData.requerements
    document.getElementById('how_to_apply_edit').value = courseData.how_to_apply
    document.getElementById('faq_edit').value = courseData.faq
    document.getElementById('id_course').value = courseData.id
  } else {
    msgAlerta.innerHTML = result.msg
  }
}

// Função para enviar o formulário de criação de curso
createCourseForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(createCourseForm)

  const response = await fetch(
    `${origin_url}/_web/web-escolar-painel-php/app/views/dashboard/src/controllers/courseControllers.php?typeForm=create_course`,
    {
      method: 'POST',
      body: dataForm
    }
  )

  const result = await response.json()

  if (result.error) {
    msgAlerta.innerHTML = response['msg']
  } else {
    msgAlerta.innerHTML = response['msg']
    createCourseForm.reset()
  }

  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 5000)

  listCourses()
})

// Função para enviar o formulário de edição de curso
editCourseForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(editCourseForm)

  const response = await fetch(
    `${origin_url}/_web/web-escolar-painel-php/app/views/dashboard/src/controllers/courseControllers.php?typeForm=edit_course`,
    {
      method: 'POST',
      body: dataForm
    }
  )

  const result = await response.json()
  msgAlerta.innerHTML = result.msg

  if (!result.error) {
    const cadModalEdit = document.getElementById('courseEditModal')

    cadModalEdit.classList.remove('show')

    listCourses()
  }
})

// Listener para o botão de sair do formulário de edição
btnExit.addEventListener('click', () => {
  cardForm.classList.remove('show') // Esconde o formulário
  cardForm.reset() // Limpa o formulário
})

// Carrega os cursos na página ao iniciar
listCourses()
