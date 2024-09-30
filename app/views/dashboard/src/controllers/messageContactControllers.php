<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_all_messages') {

  $result_messages = $pdo->prepare("SELECT * FROM messages_contact ORDER BY id DESC ");
  $result_messages->execute();
  $num_messages = $result_messages->rowCount();

  if ($num_messages <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum agendamentos feitos no momento </div>";
  } else {
    $return = "";

    while ($row_messages = $result_messages->fetch(PDO::FETCH_ASSOC)) {

      extract($row_messages);

      $return .= "
                  <tr>
                      <td>
                        <p>$id</p>
                      </td>
                      <td>
                        <p>$name_user</p>
                      </td>
                      <td>
                        <p>$email_user</p>
                      </td>
                      <td>
                        <p>$summary</p>
                      </td>
                      <td>
                        <p>$message</p>
                      </td>
                      <td><p>$date_create</p></td>
                      <td class='row'>
                      <button onclick='detailsMessages($id)' class='status edite'>Detalhes</button>
                        <button onclick='deleteMessages($id)' class='status delete'>Apagar</button>
                      </td>
                    </tr>
                ";
    }

    echo $return;
  }
}

if ($type_form == 'delete_messages') {
  $id_messages = $_GET['idMessages'];

  $result_messages = $pdo->prepare("DELETE FROM messages_contact WHERE id=?");

  if ($result_messages->execute(array($id_messages))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir a mensagem"];
  } else {
    $return = ['error' => true, 'msg' =>  "A mensagem não foi excluído :)"];
  }
}

if ($type_form == 'get_message') {
  $id_scheduling = $_GET['idMessages'];

  $result_scheduling = $pdo->prepare("SELECT * FROM messages_contact WHERE id = ? ORDER BY id LIMIT 1");
  $result_scheduling->execute(array($id_scheduling));
  $num_scheduling = $result_scheduling->rowCount();

  if ($num_scheduling >= 1) {
    $row_scheduling = $result_scheduling->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_scheduling];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhum agendamento com esse id foi encontrado"];

    echo json_encode($return);
  }
}
