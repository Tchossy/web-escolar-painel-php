<?php

$mode = 'local';

if ($mode == 'local') {
  $dbHost = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbName = "opensadordofuturo";
}
if ($mode == 'producao') {
  $dbHost = "localhost";
  $dbUsername = "u843095325_adm_opensadordofuturo";
  $dbPassword = "Consulado_apn2023";
  $dbName = "u843095325_opensadordofuturo";
}
try {
  $pdo = new PDO(
    "mysql:host=$dbHost;dbname=$dbName",
    $dbUsername,
    $dbPassword,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
  );
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
  echo "Falha ao se conectar com o banco da dados" . $erro->getMessage()();
}