<?php
require 'src/db/config.php';
session_start();

if ((isset($_SESSION['adm_email']))) {
  header('Location: http://localhost/_web/web-escolar-painel-php/home');
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- set the encoding of your site -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="keywords" content="InsPOPFU, Tchossy, Tchossy Solution" />
  <meta name="description" content="InsPOPFU" />
  <meta name="author" content="https://www.tchossy.com/" />

  <link rel="shortcut icon" href="<?= urlProject(FOLDER_BASE . "/src/images/favicon.png") ?>" />

  <!-- CEO -->
  <meta property="og:url" content="<?= urlProject(FOLDER_BASE . "/src/images/apresentation.png") ?>" />
  <meta property=" og:site_name" content="Consulado Geral de Angola em Ponta Negra" />
  <meta property="og:title" content="Consulado Geral de Angola em Ponta Negra" />
  <meta property="og:image" content="<?= urlProject(FOLDER_BASE . "/src/images/apresentation.png") ?>" />
  <meta property=" og:description" content="Consulado Geral de Angola Ponta Negra" />
  <meta property="og:type" content="article" />
  <meta property="article:tag" content="InsPOPFU" />
  <meta property="article:tag" content="Angola" />
  <meta property="article:tag" content="Tchossy" />
  <meta property="article:tag" content="Tchossy Solution" />

  <!-- set the page title -->
  <title> <?= SITE ?> </title>

  <!-- Web Fonts
========================= -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900"
    type="text/css" />

  <!-- Stylesheet
========================= -->
  <link rel="stylesheet" type="text/css" href="<?= urlProject(FOLDER_BASE . "/src/css/bootstrap.min.css") ?>" />
  <link rel="stylesheet" type="text/css"
    href="<?= urlProject(FOLDER_BASE . "/src/vendor/font-awesome/css/all.min.css") ?>" />
  <link rel="stylesheet" type="text/css" href="<?= urlProject(FOLDER_BASE . "/src/css/login.css") ?>" />
</head>

<body>

  <div id="main-wrapper" class="oxyy-login-register h-100 d-flex flex-column bg-transparent">
    <div class="container my-auto">
      <div class="row">
        <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
          <div class="bg-white shadow-md rounded p-4 px-sm-5 mt-4">
            <p class="text-center"> <strong>Pagina de Login!</strong> </p>

            <div class="logo">
              <a class="d-flex justify-content-center" href="<?= urlProject("dashboard/") ?>"
                title="Consulado de Angola Ponta Negra"><img
                  src="<?= urlProject(FOLDER_BASE . "/src/images/logo.png") ?>"
                  alt="Consulado de Angola Ponta Negra"></a>
            </div>

            <p class="text-center" style="font-size: 0.98rem;">Sistema Integrado para Gerenciamento da pagina InsPOPFU
            </p>


            <div id="msgAlertaErroCad"></div>

            <form id="loginForm" method="post">
              <div class="mb-3">
                <label for="emailAddress" class="form-label">Endereço de email</label>
                <input name="email_address_adm" type="email" class="form-control" id="emailAddress" required
                  placeholder="Digite seu e-mail">
              </div>
              <div class="mb-3">
                <label for="loginPassword" class="form-label">Senha</label>
                <input name="login_password_adm" type="password" class="form-control" id="loginPassword" required
                  placeholder="Digite a senha">
              </div>
              <button class="btn btn-primary" style="width: 100%; border-radius: .4rem;" type="submit">
                Entrar
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-3">
      <p class="text-center text-2 text-muted mb-0">Copyright © 2023 <a href="www.tchossy.com">Tchossy</a>. All Rights
        Reserved.</p>
    </div>
  </div>

  <script src="<?= urlProject(FOLDER_DASHBOARD . BASE_JS . "/actions_login_adm.js") ?>"></script>

</body>

</html>