<?php $this->layout('_theme') ?>
<?php
require 'src/db/config.php';
session_start();

if ((!isset($_SESSION['adm_email']))) {
  header('Location: http://localhost/_web/web-escolar-painel-php/dashboard');
}

?>

<!-- head-title -->
<div class="head-title">
  <div class="left">
    <h1>Admin</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Admin</a>
      </li>
    </ul>
  </div>
  <button class="btn-download" data-toggle="modal" data-target="#userModal">
    <i class="bx bxs-file-plus"></i>
    <span class="text">Nova admin</span>
  </button>
</div>

<!-- MODAL -->
<div id="userModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Cadastrar novo usuario</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroCad"></span>
    </div>

    <form id="registerForm" class="modalForm">
      <div>
        <label for="">
          Nome do usuario <span class="text-danger">*</span>
        </label>
        <input name="full_name_adm" class="form-control" type="text" placeholder="Nome do usuario">
      </div>
      <div>
        <label for="">
          E-mail do usuario <span class="text-danger">*</span>
        </label>
        <input name="email_address_adm" class="form-control" type="text" placeholder="E-mail do usuario">
      </div>
      <div>
        <label for="">
          Nº de telefone do usuario <span class="text-danger">*</span>
        </label>
        <input name="number_phone_adm" class="form-control" type="text" placeholder="Nº de telefone">
      </div>
      <div>
        <label for="">
          Password <span class="text-danger">*</span>
        </label>
        <input name="login_password_adm" class="form-control" type="password" placeholder="Password">
      </div>
      <div>
        <label for="">
          Confirme a password <span class="text-danger">*</span>
        </label>
        <input name="login_confirm_password_adm" class="form-control" type="password" placeholder="Confirme a password">
      </div>

      <button class="base-btn" type="submit">
        Dar entrada
      </button>
    </form>
  </div>
</div>

<div id="userEditeModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Editar dados do usuario</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroEditCad"></span>
    </div>

    <form id="editForm" class="modalForm">
      <input id="id_edit" name="id_adm" hidden>

      <div>
        <label for="">
          Nome do usuario <span class="text-danger">*</span>
        </label>
        <input id="full_name_adm_edit" name="full_name_adm" class="form-control" type="text"
          placeholder="Nome do usuario">
      </div>
      <div>
        <label for="">
          E-mail do usuario <span class="text-danger">*</span>
        </label>
        <input id="email_address_adm_edit" name="email_address_adm" class="form-control" type="text"
          placeholder="E-mail do usuario">
      </div>
      <div>
        <label for="">
          Nº de telefone do usuario <span class="text-danger">*</span>
        </label>
        <input id="number_phone_adm_edit" name="number_phone_adm" class="form-control" type="text"
          placeholder="Nº de telefone">
      </div>

      <button class="base-btn" type="submit">
        Actualizar dados do usuario
      </button>
    </form>
  </div>
</div>

<!-- TABLE -->
<div class="table-data">
  <div class="order">
    <div class="head">
      <h3>Todos os usuario</h3>
      <i class="bx bx-search"></i>
      <i class="bx bx-filter"></i>
    </div>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Utilizador</th>
          <th>E-mail</th>
          <th>Nº de telefone</th>
          <th>Data de registo</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

<script src="<?= urlProject(FOLDER_DASHBOARD . BASE_JS . "/actions_adm_user.js") ?>"></script>