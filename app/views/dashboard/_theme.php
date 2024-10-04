<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title> <?= SITE ?> </title>

  <!-- Favicons -->
  <link href="<?= urlProject(FOLDER_BASE . "/src/images/icon.jpg") ?>" rel="icon" />
  <link href="<?= urlProject(FOLDER_BASE . "/src/images/icon.jpg") ?>" rel="apple-touch-icon" />

  <!-- CEO -->
  <link as="image" rel="preload" href="<?= urlProject(FOLDER_BASE . "/src/images/cover.png") ?>" fetchpriority="high" />
  <meta property="og:url" content="<?= urlProject(FOLDER_BASE . "/src/images/cover.png") ?>" />
  <meta property="og:image" content="<?= urlProject(FOLDER_BASE . "/src/images/cover.png") ?>" />
  <meta property="og:site_name" content="Complexo Escolar Pensador do Futuro" />
  <meta property="og:title" content="Complexo Escolar Pensador do Futuro" />
  <meta property="og:description"
    content="O Complexo Escolar Pensador do Futuro foi fundado com a missão de oferecer uma educação técnica de excelência, capacitando jovens e adultos, preparando-os para os desafios do mercado de trabalho." />
  <meta name="author" content="https://www.tchossy.com/" />
  <meta property="og:type" content="article" />
  <meta property="article:tag" content="Complexo Escolar" />
  <meta property="article:tag" content="Pensador do Futuro" />
  <meta property="article:tag" content="Educação Técnica" />
  <meta property="article:tag" content="Capacitação" />
  <meta property="article:tag" content="Mercado de Trabalho" />
  <meta property="article:tag" content="Formação Profissional" />
  <meta property="article:tag" content="Educação" />
  <meta property="article:tag" content="Ensino" />
  <meta property="article:tag" content="Jovens" />
  <meta property="article:tag" content="Adultos" />
  <meta property="article:tag" content="Excelência" />

  <!-- Boxicons -->
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
  <!-- STYLES -->
  <link rel="stylesheet" type="text/css" href="<?= urlProject(FOLDER_DASHBOARD . "/src/css/style.css") ?> " />

</head>


<body>

  <!-- SIDEBAR -->
  <section id="sidebar">
    <a href="<?= urlProject("home") ?>" class="brand">
      <img src="<?= urlProject(FOLDER_BASE . "/src/images/logo.png") ?>" class="logo" alt="" />
    </a>
    <ul class="side-menu top">
      <li>
        <a href="<?= urlProject("home") ?>">
          <i class="bx bxs-dashboard"></i>
          <span class="text">Painel</span>
        </a>
      </li>
      <li>
        <a href="<?= urlProject("usersAdm") ?>">
          <i class='bx bxs-user-check'></i>
          <span class="text">Admin</span>
        </a>
      </li>
      <li>
        <a href="<?= urlProject("course") ?>">
          <i class='bx bxs-book'></i>
          <span class="text">Cursos</span>
        </a>
      </li>
      <li>
        <a href="<?= urlProject("messages") ?>">
          <i class='bx bx-message-dots'></i>
          <span class="text">Mensagens</span>
        </a>
      </li>
      <li>
        <a href="<?= urlProject("news") ?>">
          <i class="bx bx-news"></i>
          <span class="text">Noticias</span>
        </a>
      </li>
    </ul>
    <ul class="side-menu">
      <!-- <li>
          <a href="#">
            <i class="bx bxs-cog"></i>
            <span class="text">Configurações</span>
          </a>
        </li> -->
      <li>
        <a id="logout" class="logout">
          <i class="bx bxs-log-out-circle"></i>
          <span class="text">Sair do painel</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- SIDEBAR -->

  <!-- CONTENT -->
  <section id="content">
    <!-- NAVBAR -->
    <nav>
      <i class="bx bx-menu"></i>
      <form action="#">
      </form>

      <form action="#" hidden>
        <div class="form-input">
          <button type="submit" class="search-btn">
            <i class="bx bx-search"></i>
          </button>
        </div>
      </form>
      <input type="checkbox" id="switch-mode" hidden />
      <label for="switch-mode" class="switch-mode"></label>

      <div class="row" style="display: flex;align-items: center;gap: 0.6rem;">
        <div class="profile">
          <img src="https://www.pngfind.com/pngs/m/470-4703547_icon-user-icon-hd-png-download.png" />
        </div>
        <p id="name_adm"></p>
      </div>
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>

      <?= $this->section('content') ?>

    </main>
    <!-- MAIN -->
  </section>
  <!-- CONTENT -->

  <!-- Custom scripts for all pages-->
  <script src="<?= urlProject(FOLDER_DASHBOARD . "/src/js/home_script.js") ?> "></script>
  <script src="<?= urlProject(FOLDER_DASHBOARD . "/src/js/script.js") ?> "></script>
  <script src="<?= urlProject(FOLDER_DASHBOARD . "/src/vendor/bootstrap/bootstrap.min.js") ?> "></script>
  <script src="<?= urlProject(FOLDER_DASHBOARD . "/src/js/sweetalert.min.js") ?> "></script>

</body>

</html>