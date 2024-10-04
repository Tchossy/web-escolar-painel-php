<?php
session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'create_course') {
  $image_course = $_FILES['course_image']; // Certifique-se de que este é o nome correto do campo no formulário
  $title_course = $dataForm['title_course'];
  $description_course = $dataForm['description_course'];
  $years = $dataForm['years'];
  $period = isset($dataForm['period']) ? $dataForm['period'] : null;
  $monthly_course = $dataForm['monthly_course'];
  $course_structure = $dataForm['course_structure'];
  $requerements = $dataForm['requerements'];
  $how_to_apply = $dataForm['how_to_apply'];
  $faq = $dataForm['faq'];
  $date_create = date('Y-m-d H:i:s');

  if (empty($image_course['name'])) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Nenhuma imagem foi selecionada </div>"];
  } elseif (empty($title_course)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo título está vazio </div>"];
  } elseif (empty($description_course)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo descrição está vazio </div>"];
  } elseif (is_null($period)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo período está vazio </div>"];
  } else {
    $size_max = 2097152; // 2MB
    $accept = ["jpg", "png", "jpeg", "JPG", "PNG", "JPEG"];
    $extension = pathinfo($image_course['name'], PATHINFO_EXTENSION);

    if ($image_course['size'] >= $size_max) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB </div>"];
    } elseif (!in_array($extension, $accept)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitida </div>"];
    } else {
      $folder = '../../../../_imagesDb/courses/';
      if (!is_dir($folder)) {
        mkdir($folder, 0755, true);
      }

      $tmp = $image_course['tmp_name'];
      $newName = "img_course-" . date('d-m-Y') . '-' . uniqid() . ".$extension";

      if (move_uploaded_file($tmp, $folder . $newName)) {
        $image_course_url = 'http://localhost/_web/web-escolar-painel-php/app/_imagesDb/courses/' . $newName;

        // Insira o curso no banco de dados
        $sql = $pdo->prepare("INSERT INTO course VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($sql->execute(array(
          $image_course_url, // Armazena a URL da imagem diretamente
          $title_course,
          $description_course,
          $years,
          $period,
          $monthly_course,
          $course_structure,
          $requerements,
          $how_to_apply,
          $faq,
          $date_create
        ))) {
          $return = ['error' => false, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Curso criado com sucesso! </div>"];
        } else {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro ao criar o curso </div>"];
        }
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro ao realizar o upload </div>"];
      }
    }
  }
  echo json_encode($return);
}

if ($type_form == 'get_all_courses') {
  $result_course = $pdo->prepare("SELECT * FROM course ORDER BY id DESC");
  $result_course->execute();
  $num_course = $result_course->rowCount();

  if ($num_course <= 0) {
    echo "<div class='alert alert-danger'>Não há cursos cadastrados</div>";
  } else {
    $return = "";
    while ($row_course = $result_course->fetch(PDO::FETCH_ASSOC)) {
      extract($row_course);

      $decode_images_course = json_decode($image_course);
      $url_image = $decode_images_course[0] ?? "https://via.placeholder.com/150";

      $return .= "
                <tr>
                    <td><p>$id</p></td>
                    <td><img src='$url_image' width='100' /></td>
                    <td><p>$title_course</p></td>
                    <td><p>$description_course</p></td>
                    <td><p>$years</p></td>
                    <td><p>$period</p></td>
                    <td><p>$monthly_course</p></td>
                    <td class='row'>
                        <button onclick='editCourse($id)' class='status edite'>Editar</button>
                        <button onclick='deleteCourse($id)' class='status delete'>Excluir</button>
                    </td>
                </tr>
            ";
    }
    echo $return;
  }
}

if ($type_form == 'delete_course') {
  $id_course = $_GET['idCourse'];
  $result_course = $pdo->prepare("DELETE FROM course WHERE id=?");

  if ($result_course->execute(array($id_course))) {
    $return = ['error' => false, 'msg' => "Curso excluído com sucesso"];
  } else {
    $return = ['error' => true, 'msg' => "Erro ao excluir o curso"];
  }

  echo json_encode($return);
}

if ($type_form == 'get_course') {
  $id_course = $_GET['idCourse'];
  $result_course = $pdo->prepare("SELECT * FROM course WHERE id = ? LIMIT 1");
  $result_course->execute(array($id_course));
  $row_course = $result_course->fetch(PDO::FETCH_ASSOC);

  if ($row_course) {
    echo json_encode(['error' => false, 'dados' => $row_course]);
  } else {
    echo json_encode(['error' => true, 'msg' => "Nenhum curso encontrado com esse ID"]);
  }
}

if ($type_form == 'edit_course') {
  $id_course = $dataForm['id_course'];
  $title_course = $dataForm['title_course'];
  $description_course = $dataForm['description_course'];
  $years = $dataForm['years'];
  $period = $dataForm['period'];
  $monthly_course = $dataForm['monthly_course'];
  $course_structure = $dataForm['course_structure'];
  $requerements = $dataForm['requerements'];
  $how_to_apply = $dataForm['how_to_apply'];
  $faq = $dataForm['faq'];

  $sql = $pdo->prepare("UPDATE course SET title_course=?, description_course=?, years=?, period=?, 
        monthly_course=?, course_structure=?, requerements=?, how_to_apply=?, faq=? WHERE id=?");

  if ($sql->execute(array(
    $title_course,
    $description_course,
    $years,
    $period,
    $monthly_course,
    $course_structure,
    $requerements,
    $how_to_apply,
    $faq,
    $id_course
  ))) {
    echo json_encode(['error' => false, 'msg' => "Curso atualizado com sucesso!"]);
  } else {
    echo json_encode(['error' => true, 'msg' => "Erro ao atualizar o curso"]);
  }
}