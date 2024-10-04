<?php $this->layout('_theme') ?>
<?php
require 'src/db/config.php';
session_start();

if ((!isset($_SESSION['adm_email']))) {
  header('Location: http://localhost/_web/web-escolar-painel-php/dashboard');
}
?>

<div class="head-title">
  <div class="left">
    <h1>Cursos</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Cursos</a>
      </li>
    </ul>
  </div>
  <button class="btn-download" data-toggle="modal" data-target="#courseModal">
    <i class="bx bxs-file-plus"></i>
    <span class="text">Novo curso</span>
  </button>
</div>

<!-- MODAL PARA CRIAR CURSO -->
<div id="courseModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Criar novo curso</h2>
    </div>

    <form id="createCourseForm" class="modalForm" enctype="multipart/form-data">
      <span id="msgAlertaErroCad"></span>

      <!-- Upload de Imagem -->
      <div>
        <label for="course_image">Imagem do curso <span class="text-danger">*</span></label>
        <input name="course_image" class="form-control" type="file" id="course_image">
      </div>
      <div id="image_preview"></div>

      <div>
        <label for="">Título do curso <span class="text-danger">*</span></label>
        <input name="title_course" class="form-control" type="text" placeholder="Título do curso">
      </div>
      <div>
        <label for="">Descrição do curso <span class="text-danger">*</span></label>
        <textarea name="description_course" class="form-control" type="text" placeholder="Descrição do curso"
          style="min-height: 10rem;"></textarea>
      </div>
      <div>
        <label for="">Duração (em anos) <span class="text-danger">*</span></label>
        <input name="years" class="form-control" type="number" placeholder="Duração do curso">
      </div>

      <!-- Select para Período -->
      <div>
        <label for="">Período <span class="text-danger">*</span></label>
        <select name="period" class="form-control">
          <option value="" disabled selected>Selecione o período</option>
          <option value="Manhã">Manhã</option>
          <option value="Tarde">Tarde</option>
          <option value="Manhã e Tarde">Manhã e Tarde</option>
          <option value="Noturno">Noturno</option>
        </select>
      </div>

      <div>
        <label for="">Mensalidade <span class="text-danger">*</span></label>
        <input name="monthly_course" class="form-control" type="number" placeholder="Mensalidade do curso">
      </div>
      <div>
        <label for="">Estrutura curricular <span class="text-danger">*</span></label>
        <textarea name="course_structure" class="form-control" placeholder="Estrutura curricular"
          style="min-height: 5rem;"></textarea>
      </div>
      <div>
        <label for="">Requisitos <span class="text-danger">*</span></label>
        <textarea name="requerements" class="form-control" placeholder="Requisitos para o curso"
          style="min-height: 5rem;"></textarea>
      </div>
      <div>
        <label for="">Como se inscrever <span class="text-danger">*</span></label>
        <textarea name="how_to_apply" class="form-control" placeholder="Como se inscrever no curso"
          style="min-height: 5rem;"></textarea>
      </div>
      <div>
        <label for="">Perguntas frequentes (FAQ) <span class="text-danger">*</span></label>
        <textarea name="faq" class="form-control" placeholder="FAQ do curso" style="min-height: 5rem;"></textarea>
      </div>

      <button class="base-btn" type="submit">Salvar curso</button>
    </form>
  </div>
</div>

<!-- MODAL PARA EDITAR CURSO -->
<div id="courseEditModal" class="modal">
  <div class="modal-content">
    <span class="close" id="btn_exit">&times;</span>
    <div class="container-modal">
      <h2>Editar curso</h2>
    </div>

    <form id="editCourseForm" class="modalForm" enctype="multipart/form-data">
      <span id="msgAlertaErroEditCard"></span>

      <input id="id_course" name="id_course" hidden>

      <!-- Upload de Imagem para Edição -->
      <div id="containerImagensEdit"></div>
      <div>
        <label for="course_image_edit">Imagem do curso</label>
        <input name="course_image_edit" class="form-control" type="file" id="course_image_edit">
      </div>

      <div>
        <label for="">Título do curso <span class="text-danger">*</span></label>
        <input name="title_course" id="title_course_edit" class="form-control" type="text"
          placeholder="Título do curso">
      </div>
      <div>
        <label for="">Descrição do curso <span class="text-danger">*</span></label>
        <textarea name="description_course" id="description_course_edit" class="form-control" type="text"
          placeholder="Descrição do curso" style="min-height: 10rem;"></textarea>
      </div>
      <div>
        <label for="">Duração (em anos) <span class="text-danger">*</span></label>
        <input name="years" id="years_edit" class="form-control" type="number" placeholder="Duração do curso">
      </div>

      <!-- Select para Período no Editar -->
      <div>
        <label for="">Período <span class="text-danger">*</span></label>
        <select name="period" id="period_edit" class="form-control">
          <option value="" disabled selected>Selecione o período</option>
          <option value="Manhã">Manhã</option>
          <option value="Tarde">Tarde</option>
          <option value="Manhã e Tarde">Manhã e Tarde</option>
          <option value="Noturno">Noturno</option>
        </select>
      </div>

      <div>
        <label for="">Mensalidade <span class="text-danger">*</span></label>
        <input name="monthly_course" id="monthly_course_edit" class="form-control" type="number"
          placeholder="Mensalidade do curso">
      </div>
      <div>
        <label for="">Estrutura curricular <span class="text-danger">*</span></label>
        <textarea name="course_structure" id="course_structure_edit" class="form-control"
          placeholder="Estrutura curricular" style="min-height: 5rem;"></textarea>
      </div>
      <div>
        <label for="">Requisitos <span class="text-danger">*</span></label>
        <textarea name="requerements" id="requerements_edit" class="form-control" placeholder="Requisitos para o curso"
          style="min-height: 5rem;"></textarea>
      </div>
      <div>
        <label for="">Como se inscrever <span class="text-danger">*</span></label>
        <textarea name="how_to_apply" id="how_to_apply_edit" class="form-control"
          placeholder="Como se inscrever no curso" style="min-height: 5rem;"></textarea>
      </div>
      <div>
        <label for="">Perguntas frequentes (FAQ) <span class="text-danger">*</span></label>
        <textarea name="faq" id="faq_edit" class="form-control" placeholder="FAQ do curso"
          style="min-height: 5rem;"></textarea>
      </div>

      <button class="base-btn" type="submit">Salvar mudanças</button>
    </form>
  </div>
</div>

<!-- TABELA -->
<div class="table-data">
  <div class="order">
    <div class="head">
      <h3>Todos os cursos</h3>
      <i class="bx bx-search"></i>
      <i class="bx bx-filter"></i>
    </div>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Imagem</th>
          <th>Título</th>
          <th>Descrição</th>
          <th>Duração (anos)</th>
          <th>Período</th>
          <th>Mensalidade</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <!-- Os dados dos cursos serão carregados dinamicamente pelo JS -->
      </tbody>
    </table>
  </div>
</div>

<script src="<?= urlProject(FOLDER_DASHBOARD . BASE_JS . "/actions_course.js") ?>"></script>