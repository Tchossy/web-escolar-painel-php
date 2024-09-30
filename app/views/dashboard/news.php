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
    <h1>Noticia</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Noticia</a>
      </li>
    </ul>
  </div>
  <button class="btn-download" data-toggle="modal" data-target="#newsModal">
    <i class="bx bxs-file-plus"></i>
    <span class="text">Nova noticia</span>
  </button>
</div>

<!-- MODAL -->
<div id="newsModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Criar nova de noticia</h2>
    </div>

    <form id="formNews" class="modalForm">
      <span id="msgAlertaErroCad"></span>

      <input name="author_news" id="author_news" type="text" hidden>

      <input name="images_news[]" class="form-control" type="file" id="inputImagens" multiple>
      <div id="containerImagens"></div>

      <div>
        <label for="">
          Categoria da noticia <span class="text-danger">*</span>
        </label>
        <input name="category_news" class="form-control" type="text" placeholder="Categoria da noticia">
      </div>
      <div>
        <label for="">
          Titulo da noticia <span class="text-danger">*</span>
        </label>
        <input name="title_news" class="form-control" type="text" placeholder="Titulo da noticia">
      </div>
      <div>
        <label for="">
          Descrição da noticia <span class="text-danger">*</span>
        </label>
        <textarea name="description_news" class="form-control" type="text" placeholder="Descrição da noticia"
          style="min-height: 10rem;"></textarea>
      </div>
      <div>
        <label for="">
          Epígrafe da noticia <span class="text-danger">*</span>
        </label>
        <input name="epigraph_news" class="form-control" type="text" placeholder="Epígrafe da noticia">
      </div>
      <div>
        <label for="">
          Autor da epígrafe <span class="text-danger">*</span>
        </label>
        <input name="author_epigraph_news" class="form-control" type="text" placeholder="Autor da epígrafe">
      </div>
      <div>
        <label for="">
          Data da noticia <span class="text-danger">*</span>
        </label>
        <input name="date_news" class="form-control" type="date">
      </div>

      <button class="base-btn" type="submit">
        Dar entrada
      </button>
    </form>
  </div>
</div>

<div id="newsEditeModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Editar noticia</h2>
    </div>

    <form id="newsEditForm" class="modalForm">
      <span id="msgAlertaErroEditCard"></span>

      <input id="id_edit" name="id_news" hidden>

      <input name="images_news[]" class="form-control" type="file" id="inputImagensEdit" multiple>
      <div id="containerImagensEdit"></div>

      <div>
        <label for="">
          Categoria da noticia <span class="text-danger">*</span>
        </label>
        <input name="category_news" id="category_news_edit" class="form-control" type="text"
          placeholder="Categoria da noticia">
      </div>
      <div>
        <label for="">
          Titulo da noticia <span class="text-danger">*</span>
        </label>
        <input name="title_news" id="title_news_edit" class="form-control" type="text" placeholder="Titulo da noticia">
      </div>
      <div>
        <label for="">
          Descrição da noticia <span class="text-danger">*</span>
        </label>
        <textarea name="description_news" id="description_news_edit" class="form-control" type="text"
          placeholder="Descrição da noticia" style="min-height: 10rem;"></textarea>
      </div>
      <div>
        <label for="">
          Epígrafe da noticia <span class="text-danger">*</span>
        </label>
        <input name="epigraph_news" id="epigraph_news_edit" class="form-control" type="text"
          placeholder="Epígrafe da noticia">
      </div>
      <div>
        <label for="">
          Autor da epígrafe <span class="text-danger">*</span>
        </label>
        <input name="author_epigraph_news" id="author_epigraph_news_edit" class="form-control" type="text"
          placeholder="Autor da epígrafe">
      </div>
      <div>
        <label for="">
          Data da noticia <span class="text-danger">*</span>
        </label>
        <input name="date_news" id="date_news_edit" class="form-control" type="date">
      </div>

      <button class="base-btn" type="submit">
        Dar entrada
      </button>
    </form>
  </div>
</div>


<!-- TABLE -->
<div class="table-data">
  <div class="order">
    <div class="head">
      <h3>Todos os posts</h3>
      <i class="bx bx-search"></i>
      <i class="bx bx-filter"></i>
    </div>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Capa</th>
          <th>Categoria</th>
          <th>Titulo</th>
          <th>Descrição</th>
          <th>Data</th>
          <th>Local</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

<script src="<?= urlProject(FOLDER_DASHBOARD . BASE_JS . "/actions_news_rend.js") ?>"></script>