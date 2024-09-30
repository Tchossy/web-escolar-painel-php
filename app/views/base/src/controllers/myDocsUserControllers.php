<?php

session_start();
include_once "../db/config.php";

$email_utente = $_GET['realEmailUser'];

$result_document = $pdo->prepare("SELECT * FROM state_document WHERE email_utente=? ");
$result_document->execute(array($email_utente));
$result_document->execute();
$num_document = $result_document->rowCount();

if ($num_document <= 0) {
  echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum documento no momento </div>";
} elseif (empty($email_utente)) {
  $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Faça o login ou registre-se para fazer o agendamento </div>"];
} else {
  $return = "";

  while ($row_document = $result_document->fetch(PDO::FETCH_ASSOC)) {

    extract($row_document);

    $state_is = '';
    $date_delivery_document_is = '';

    if (empty($date_delivery_document)) {
      $date_delivery_document_is = '-------------------------';
    } else {
      $date_delivery_document_is = $date_delivery_document;
    }

    if ($state_document == 'Pronto') {
      $state_is = 'completed';
    } elseif ($state_document == 'Pendente') {
      $state_is = 'pending';
    } elseif ($state_document == 'Recusado') {
      $state_is = 'delete';
    } elseif ($state_document == 'Em tratamento') {
      $state_is = 'completed';
    }

    $return .= "
                <tr>
                  <td>
                    <p>4</p>
                  </td>
                  <td>
                    <p>$sector_document</p>
                  </td>
                  <td>
                    <p>$description_document</p>
                  </td>
                  <td>
                    <p>$date_entry_document</p>
                  </td>
                  <td>
                    <p>$date_delivery_document_is</p>
                  </td>

                  <td>
                    <div class='status $state_is' style='text-align: center;'>$state_document</div>
                  </td>
                </tr>
                ";
  }

  echo $return;
}
