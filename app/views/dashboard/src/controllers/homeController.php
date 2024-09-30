<?php

include_once "../db/config.php";

$type_action = $_GET['typeAction'];

if ($type_action == 'count_adm_users') {
  $query_get_adm_users = "SELECT * FROM adm_user";
  $result_adm_users = $pdo->prepare($query_get_adm_users);
  $result_adm_users->execute();

  $num_adm_users = $result_adm_users->rowCount();

  echo $num_adm_users;
}
if ($type_action == 'count_message') {
  $query_get_message = "SELECT * FROM messages_contact";
  $result_message = $pdo->prepare($query_get_message);
  $result_message->execute();

  $num_message = $result_message->rowCount();

  echo $num_message;
}
if ($type_action == 'count_new') {
  $query_get_new = "SELECT * FROM news";
  $result_new = $pdo->prepare($query_get_new);
  $result_new->execute();

  $num_new = $result_new->rowCount();

  echo $num_new;
}

if ($type_action == 'get_admins') {

  $result_utentes = $pdo->prepare("SELECT * FROM adm_user ORDER BY id DESC LIMIT 8");
  $result_utentes->execute();
  $num_utentes = $result_utentes->rowCount();

  if ($num_utentes <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum utente cadastrado no momento </div>";
  } else {
    $return = "";

    while ($row_utentes = $result_utentes->fetch(PDO::FETCH_ASSOC)) {
      extract($row_utentes);

      $return .= "
                  <tr>
                    <td>
                      <p>$full_name_adm</p>
                    </td>
                    <td>
                      <p>$email_address_adm</p>
                    </td>
                    <td>$date_create_adm</td>
                  </tr>
      ";
    }

    echo $return;
  }
}

if ($type_action == 'get_messages') {

  $result_messages = $pdo->prepare("SELECT * FROM messages_contact ORDER BY id DESC LIMIT 4");
  $result_messages->execute();
  $num_messages = $result_messages->rowCount();

  if ($num_messages <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum mensagem no momento </div>";
  } else {
    $return = "";

    while ($row_messages = $result_messages->fetch(PDO::FETCH_ASSOC)) {
      extract($row_messages);

      $return .= "
                  <li class='completed'>
                    <p><i>$email_user</i> <br/> <strong>$summary</strong> <br/> $message <br/> $date_create </p> 
                    <i class='bx bx-dots-vertical-rounded'></i>
                  </li>
      ";
    }

    echo $return;
  }
}
