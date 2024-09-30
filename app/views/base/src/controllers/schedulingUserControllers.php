<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'create_scheduling') {
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

  $name_user_form = $dataForm['name_user'];
  $email_user_form = $dataForm['email_user'];
  $real_email_user_form = $dataForm['real_email_user'];
  $phone_user_form = $dataForm['phone_user'];
  $secto_scheduling_form = $dataForm['secto_scheduling'];
  $scheduling_state_form = "Pendente";
  $data_scheduling_form = $dataForm['data_scheduling'];
  $date_create_form = $completeDate;

  if (empty($real_email_user_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Faça o login ou registre-se para fazer o agendamento </div>"];
  } elseif (empty($name_user_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo nome está vazio </div>"];
  } elseif (empty($email_user_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo email está vazio </div>"];
  } elseif (empty($phone_user_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo nº de telefone está vazio </div>"];
  } elseif (empty($secto_scheduling_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo sector está vazio </div>"];
  } elseif (empty($data_scheduling_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo data do agendamento está vazio </div>"];
  } else {

    $sql = $pdo->prepare("INSERT INTO scheduling values(null,?,?,?,?,?,?,?,?)");

    if ($sql->execute(array(
      $name_user_form,
      $email_user_form,
      $real_email_user_form,
      $phone_user_form,
      $secto_scheduling_form,
      $scheduling_state_form,
      $data_scheduling_form,
      $date_create_form
    ))) {
      $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Seu agendamento foi marcado com sucesso </div>"];
    } else {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao fazer o seu agendamento </div>"];
    };
  }

  echo json_encode($return);
} else {
  $real_email_user = $_GET['realEmailUser'];

  $result_scheduling = $pdo->prepare("SELECT * FROM scheduling WHERE real_email_user=? ");
  $result_scheduling->execute(array($real_email_user));
  $result_scheduling->execute();
  $num_scheduling = $result_scheduling->rowCount();

  if ($num_scheduling <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum agendamento feito no momento </div>";
  } else {
    $return = "";

    while ($row_scheduling = $result_scheduling->fetch(PDO::FETCH_ASSOC)) {

      extract($row_scheduling);

      $state_is = '';
      if ($scheduling_state == 'Pendente') {
        $state_is = 'pending';
      } else {
        $state_is = 'completed';
      }

      $return .= "
                <tr>
                  <td>
                    <p> $secto_scheduling </p>
                  </td>
                  <td>
                    <p> $data_scheduling </p>
                  </td>
                  <td>
                    <button class='status $state_is'>$scheduling_state</button>
                  </td>
                </tr>
                ";
    }

    echo $return;
  }
}