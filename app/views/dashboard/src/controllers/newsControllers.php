<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

function getWeek(string $fWeek = null): string
{
  if ($fWeek == 'Sunday') {
    return 'Domingo';
  } elseif ($fWeek == 'Monday') {
    return 'Segunda-Feira';
  } elseif ($fWeek == 'Tuesday') {
    return 'Terca-Feira';
  } elseif ($fWeek == 'Wednesday') {
    return 'Quarta-Feira';
  } elseif ($fWeek == 'Thursday') {
    return 'Quinta-Feira';
  } elseif ($fWeek == 'Friday') {
    return 'Sexta-Feira';
  } elseif ($fWeek == 'Saturday') {
    return 'Sábado';
  }
}
function getMonth(string $fMonth = null): string
{
  if ($fMonth == 'January') {
    return 'Janeiro';
  } elseif ($fMonth == 'February') {
    return 'Fevereiro';
  } elseif ($fMonth == 'March') {
    return 'Marco';
  } elseif ($fMonth == 'April') {
    return 'Abril';
  } elseif ($fMonth == 'May') {
    return 'Maio';
  } elseif ($fMonth == 'June') {
    return 'Junho';
  } elseif ($fMonth == 'July') {
    return 'Julho';
  } elseif ($fMonth == 'August') {
    return 'Agosto';
  } elseif ($fMonth == 'September') {
    return 'Novembro';
  } elseif ($fMonth == 'October') {
    return 'Setembro';
  } elseif ($fMonth == 'November') {
    return 'Outubro';
  } elseif ($fMonth == 'December ') {
    return 'Dezembro';
  }
}

if ($type_form == 'create_news') {
  $data = date('D');
  $mes = date('M');
  $dia = date('d');
  $ano = date('Y');

  $semana = array(
    'Sun' => 'Domingo',
    'Mon' => 'Segunda-Feira',
    'Tue' => 'Terca-Feira',
    'Wed' => 'Quarta-Feira',
    'Thu' => 'Quinta-Feira',
    'Fri' => 'Sexta-Feira',
    'Sat' => 'Sábado'
  );

  $mes_extenso = array(
    'Jan' => 'Janeiro',
    'Feb' => 'Fevereiro',
    'Mar' => 'Marco',
    'Apr' => 'Abril',
    'May' => 'Maio',
    'Jun' => 'Junho',
    'Jul' => 'Julho',
    'Aug' => 'Agosto',
    'Nov' => 'Novembro',
    'Sep' => 'Setembro',
    'Oct' => 'Outubro',
    'Dec' => 'Dezembro'
  );

  $completeDate =  $semana["$data"] . ", {$dia} de " . $mes_extenso["$mes"] . " de {$ano}";

  $data_form = $dataForm['date_news'];
  setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
  $timestamp = strtotime($data_form);
  $dayOfWeek = date('l', $timestamp);
  $day = date('d', $timestamp);
  $month = date('F', $timestamp);
  $year = date('Y', $timestamp);
  $ptWeek = getWeek($dayOfWeek);
  $ptMonth = getMonth($month);
  $data_complete = "$ptWeek, $day de $ptMonth de $year  ";

  $author_news_form = $dataForm['author_news'];
  $images_news_form = $_FILES['images_news'];
  $images_array_news_form = [];
  $category_news_form = $dataForm['category_news'];
  $title_news_form = $dataForm['title_news'];
  $description_news_form = $dataForm['description_news'];
  $epigraph_news_form = $dataForm['epigraph_news'];
  $author_epigraph_news_form = $dataForm['author_epigraph_news'];
  $date_news_form = $data_complete;
  $date_create_form = $completeDate;

  if (empty($images_news_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Nenhuma imagem foi selecionada </div>"];
  } elseif (empty($category_news_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo categoria está vazio </div>"];
  } elseif (empty($title_news_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo titulo está vazio </div>"];
  } elseif (empty($description_news_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo descrição está vazio </div>"];
  } elseif (empty($epigraph_news_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo epígrafe está vazio </div>"];
  } elseif (empty($author_epigraph_news_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo autor da epígrafe do news está vazio </div>"];
  } elseif (empty($date_news_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo estado data da noticia está vazio</div>"];
  } else {

    foreach ($images_news_form['name'] as $key => $name) {
      $size_max = 2097152; //2MB
      $accept  = array("jpg", "png", "jpeg");
      $extension  = pathinfo($images_news_form['name'][$key], PATHINFO_EXTENSION);

      if ($images_news_form['size'][$key] >= $size_max) {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
      } else {
        if (in_array($extension, $accept)) {
          // echo "Permitido";
          $folder = '../../../../_imagesDb/news/';

          if (!is_dir($folder)) {
            mkdir($folder, 755, true);
          }

          // Nome temporário do arquivo
          $tmp = $images_news_form['tmp_name'][$key];
          // Novo nome do arquivo
          $newName = "img_news-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

          if (move_uploaded_file($tmp, $folder . $newName)) {
            $image_news = 'http://localhost/_web/web-escolar-painel-php/app/_imagesDb/news/' . $newName;
            array_push($images_array_news_form, $image_news);
            // echo "Upload realizado com sucesso!";
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
          }
        } else {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
        }
      }
    }

    $encode_images_array_news = json_encode($images_array_news_form);

    $sql = $pdo->prepare("INSERT INTO news values(null,?,?,?,?,?,?,?,?,?)");

    if ($sql->execute(array(
      $author_news_form,
      $encode_images_array_news,
      $category_news_form,
      $title_news_form,
      $description_news_form,
      $epigraph_news_form,
      $author_epigraph_news_form,
      $date_news_form,
      $date_create_form
    ))) {
      $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> A noticia foi publicada com sucesso </div>"];
    } else {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao publicar a noticia </div>"];
    };
  }

  echo json_encode($return);
}

if ($type_form == 'get_all_news') {
  $result_news = $pdo->prepare("SELECT * FROM news ORDER BY id DESC ");
  $result_news->execute();
  $num_news = $result_news->rowCount();

  if ($num_news <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhuma noticia no momento </div>";
  } else {
    $return = "";

    while ($row_news = $result_news->fetch(PDO::FETCH_ASSOC)) {

      extract($row_news);

      $decode_images_news = json_decode($images_news);

      $url_image = "";

      if ($decode_images_news) {
        $url_image = $decode_images_news[0];
      } else {
        $url_image = "https://img.freepik.com/free-vector/realistic-news-studio-background_23-2149985606.jpg";
      }

      $return .= "
                <tr>
                  <td>
                    <p>$id</p>
                  </td>
                  <td>
                    <img src='$url_image' />
                  </td>
                  <td>
                    <p>$category_news</p>
                  </td>
                  <td>
                    <p>$title_news</p>
                  </td>
                  <td>
                    <p>$description_news</p>
                  </td>
                  <td>
                    <p>$epigraph_news</p>
                  </td>
                  <td>
                    <p>$author_epigraph_news</p>
                  </td>
                  <td>
                    <p>$date_news</p>
                  </td>
                  <td class='row'>
                    <button onclick='editeNews($id)' class='status edite'>Editar</button>
                    <button onclick='deleteNews($id)' class='status delete'>Apagar</button>
                  </td>
                </tr>
                ";
    }

    echo $return;
  }
}

if ($type_form == 'delete_news') {
  $id_news = $_GET['idNews'];

  $result_news = $pdo->prepare("DELETE FROM news WHERE id=?");

  if ($result_news->execute(array($id_news))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir a noticia"];
  } else {
    $return = ['error' => true, 'msg' =>  "A noticia não foi excluído :)"];
  }
}

if ($type_form == 'get_news') {
  $id_news = $_GET['idNews'];

  $result_news = $pdo->prepare("SELECT * FROM news WHERE id = ? ORDER BY id LIMIT 1");
  $result_news->execute(array($id_news));
  $num_news = $result_news->rowCount();

  if ($num_news >= 1) {
    $row_news = $result_news->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_news];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhum agendamento com esse id foi encontrado"];

    echo json_encode($return);
  }
}

if ($type_form == 'edit_news') {
  $data_form = $dataForm['date_news'];
  setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
  $timestamp = strtotime($data_form);
  $dayOfWeek = date('l', $timestamp);
  $day = date('d', $timestamp);
  $month = date('F', $timestamp);
  $year = date('Y', $timestamp);
  $ptWeek = getWeek($dayOfWeek);
  $ptMonth = getMonth($month);
  $data_complete = "$ptWeek, $day de $ptMonth de $year  ";

  $id_news = $dataForm['id_news'];
  $images_news_form = $_FILES['images_news'];
  $images_array_news_form = [];
  $category_news_form = $dataForm['category_news'];
  $title_news_form = $dataForm['title_news'];
  $description_news_form = $dataForm['description_news'];
  $epigraph_news_form = $dataForm['epigraph_news'];
  $author_epigraph_news_form = $dataForm['author_epigraph_news'];
  $date_news_form = $data_complete;

  if (empty($images_news_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Nenhuma imagem foi selecionada </div>"];
  } elseif (empty($category_news_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo categoria está vazio </div>"];
  } elseif (empty($title_news_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo titulo está vazio </div>"];
  } elseif (empty($description_news_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo descrição está vazio </div>"];
  } elseif (empty($epigraph_news_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo epígrafe está vazio </div>"];
  } elseif (empty($author_epigraph_news_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo autor da epígrafe do news está vazio </div>"];
  } elseif (empty($date_news_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo estado data da noticia está vazio</div>"];
  } else {

    foreach ($images_news_form['name'] as $key => $name) {
      $size_max = 2097152; //2MB
      $accept  = array("jpg", "png", "jpeg");
      $extension  = pathinfo($images_news_form['name'][$key], PATHINFO_EXTENSION);

      if ($images_news_form['size'][$key] >= $size_max) {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
      } else {
        if (in_array($extension, $accept)) {
          // echo "Permitido";
          $folder = '../../../../_imagesDb/news/';

          if (!is_dir($folder)) {
            mkdir($folder, 755, true);
          }

          // Nome temporário do arquivo
          $tmp = $images_news_form['tmp_name'][$key];
          // Novo nome do arquivo
          $newName = "img_news-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

          if (move_uploaded_file($tmp, $folder . $newName)) {
            $image_news = 'http://localhost/_web/web-escolar-painel-php/app/_imagesDb/news/' . $newName;
            array_push($images_array_news_form, $image_news);
            // echo "Upload realizado com sucesso!";
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
          }
        } else {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
        }
      }
    }

    $encode_images_array_news = json_encode($images_array_news_form);

    if ($images_array_news_form == []) {
      $sql = $pdo->prepare("UPDATE news SET category_news=?, title_news=?, description_news=?, epigraph_news=?, author_epigraph_news=?, date_news=? WHERE id=? ");

      if ($sql->execute(array(
        $category_news_form,
        $title_news_form,
        $description_news_form,
        $epigraph_news_form,
        $author_epigraph_news_form,
        $date_news_form,
        $id_news
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> A noticia foi actualizada com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar a noticia </div>"];
      };
    } else {
      $sql = $pdo->prepare("UPDATE news SET images_news=?, category_news=?, title_news=?, description_news=?, epigraph_news=?, author_epigraph_news=?, date_news=? WHERE id=? ");

      if ($sql->execute(array(
        $encode_images_array_news,
        $category_news_form,
        $title_news_form,
        $description_news_form,
        $epigraph_news_form,
        $author_epigraph_news_form,
        $date_news_form,
        $id_news
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> A noticia foi actualizada com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar a noticia </div>"];
      };
    }
  }
  echo json_encode($return);
}