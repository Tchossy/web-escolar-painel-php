<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

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

$full_name_form = $dataForm['name_user'];
$email_address_form = $dataForm['email_user'];
$summary_form = $dataForm['summary'];
$message_form = $dataForm['message'];
$date_create_form = $completeDate;

if (empty($full_name_form)) {
  $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome está vazio </div>"];
} elseif (empty($email_address_form)) {
  $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo email está vazio </div>"];
} elseif (empty($summary_form)) {
  $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo assunto está vazio </div>"];
} elseif (empty($message_form)) {
  $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo mensagem está vazio </div>"];
} else {

  $sql = $pdo->prepare("INSERT INTO messages_contact values(null,?,?,?,?,?)");

  if ($sql->execute(array(
    $full_name_form,
    $email_address_form,
    $summary_form,
    $message_form,
    $date_create_form
  ))) {
    $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Sua mensagem foi enviada com sucesso </div>"];
  } else {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao enviar sua mensagem usuário </div>"];
  };
}



echo json_encode($return);
