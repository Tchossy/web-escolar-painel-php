<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['type_form'];

if ($type_form == 'login_adm') {

  if (!empty($dataForm['email_address_adm']) && !empty($dataForm['login_password_adm'])) {

    $email_address_adm_form = $dataForm['email_address_adm'];
    $login_password_adm_form = $dataForm['login_password_adm'];
    $new_password = md5($login_password_adm_form);

    $result_utente = $pdo->prepare("SELECT * FROM adm_user WHERE email_address_adm=? and login_password_adm=? LIMIT 1 ");
    $result_utente->execute(array($email_address_adm_form, $new_password));

    if ($result_utente->rowCount() < 1) {
      unset($_SESSION['adm_name']);
      unset($_SESSION['adm_email']);
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Dados do utente incorreto </div>"];
    } else {

      $adm_name = "";

      foreach ($result_utente as $data) {
        $adm_name = $data['full_name_adm'];
      };

      $_SESSION['adm_name'] = $adm_name;
      $_SESSION['adm_email'] = $email_address_adm_form;

      $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'>ADM '$adm_name' logado</div>", 'adm_email' => $email_address_adm_form, 'adm_name' => $adm_name];
    }
  } else {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Preencha todos os dados! </div>"];
  }

  echo json_encode($return);
}

if ($type_form == 'logout_adm') {
  unset($_SESSION['adm_name']);
  unset($_SESSION['adm_email']);

  echo $return = 'Adm desconectado com sucesso';
}
