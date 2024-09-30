<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_delete = filter_input(INPUT_GET, 'type', FILTER_DEFAULT);
$type_form = $dataForm['type_form'];

if ($type_form == 'create_author') {
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

  $full_name_user_form = $dataForm['full_name_user'];
  $email_address_user_form = $dataForm['email_address_user'];
  $number_phone_user_form = $dataForm['number_phone_user'];
  $login_password_user_form = $dataForm['login_password_user'];
  $login_confirm_password_user_form = $dataForm['login_confirm_password_user'];
  $new_password = md5($login_password_user_form);

  $date_create_user_form = $completeDate;

  $result_utente = $pdo->prepare("SELECT * FROM utentes WHERE email_address_user = ? ORDER BY id ");
  $result_utente->execute(array($email_address_user_form));
  $num_utente = $result_utente->rowCount();

  if ($num_utente >= 1) {
    $return = ['error' => false, 'msg' =>  "<div class='alert alert-danger' role='alert' id='msgAlerta'> Este email já encontra-se cadastrado </div>"];
  } else {
    if (empty($full_name_user_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome está vazio </div>"];
    } elseif (empty($email_address_user_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo email está vazio </div>"];
    } elseif (empty($number_phone_user_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo nº de telefone está vazio </div>"];
    } elseif (empty($login_password_user_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo senha está vazio </div>"];
    } elseif ($login_password_user_form != $login_confirm_password_user_form) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: As senhas não coincidem </div>"];
    } else {

      $sql = $pdo->prepare("INSERT INTO utentes values(null,?,?,?,?,?)");

      if ($sql->execute(array(
        $full_name_user_form,
        $email_address_user_form,
        $number_phone_user_form,
        $new_password,
        $date_create_user_form
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Usuário cadastrado com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao cadastrar usuário </div>"];
      };
    }
  }
}


if ($type_form == 'login_user') {

  if (!empty($dataForm['email_address_user']) && !empty($dataForm['login_password_user'])) {

    $email_address_user_form = $dataForm['email_address_user'];
    $login_password_user_form = $dataForm['login_password_user'];
    $new_password = md5($login_password_user_form);

    $result_utente = $pdo->prepare("SELECT * FROM utentes WHERE email_address_user=? and login_password_user=? ");
    $result_utente->execute(array($email_address_user_form, $new_password));

    if ($result_utente->rowCount() < 1) {
      unset($_SESSION['utente_name']);
      unset($_SESSION['utente_email']);
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Dados do utente incorreto </div>"];
    } else {

      $utente_name = "";

      foreach ($result_utente as $data) {
        $utente_name = $data['full_name_user'];
      };

      $_SESSION['utente_name'] = $utente_name;
      $_SESSION['utente_email'] = $email_address_user_form;

      $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'>Utente '$utente_name' logado</div>", 'email_user' => $email_address_user_form];
    }
  } else {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Preencha todos os dados! </div>"];
  }
}

if ($type_delete == '123') {
  unset($_SESSION['utente_name']);
  unset($_SESSION['utente_email']);
}

echo json_encode($return);
