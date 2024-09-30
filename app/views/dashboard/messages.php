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
    <h1>Mensagens</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Mensagens</a>
      </li>
    </ul>
  </div>
</div>

<!-- MODAL -->
<div id="messageDetailModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Detalhes da mensagem</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroEditCad"></span>
    </div>

    <form class="modalForm">
      <input id="id_detail" name="id_Scheduling" hidden>
      <span id="msgAlertaErroEditCard"></span>

      <div>
        <label for="">
          Nome do utente
        </label>
        <p id="name_user_detail" class="form-control"></p>
      </div>
      <div>
        <label for="">
          E-mail do utente
        </label>
        <p id="email_user_detail" class="form-control"></p>
      </div>
      <div>
        <label for="">
          Assunto
        </label>
        <p id="summary_detail" class="form-control"></p>
      </div>
      <div>
        <label for="">
          Mensagem
        </label>
        <p id="message_detail" class="form-control-description"></p>
      </div>
      <div>
        <label for="">
          Nº de telefone do utente
        </label>
        <p id="date_create_detail" class="form-control"></p>
      </div>
    </form>
  </div>
</div>

<!-- TABLE -->
<div class="table-data">
  <div class="order">
    <div class="head">
      <h3>Todos os usuários</h3>
      <i class="bx bx-search"></i>
      <i class="bx bx-filter"></i>
    </div>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Nome do utente</th>
          <th>E-mail</th>
          <th>Assunto</th>
          <th>Mensagem</th>
          <th>Ordem de Data</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>

<script>
  var today = new Date().toISOString().split('T')[0];
  document.getElementById("myDateInput").setAttribute("min", today);
</script>

<script src="<?= urlProject(FOLDER_DASHBOARD . BASE_JS . "/actions_messages.js") ?>"></script>