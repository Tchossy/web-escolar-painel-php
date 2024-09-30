<?php

namespace App\controllers;

use League\Plates\Engine;

class Dash
{
  private $templates;

  public function __construct()
  {
    $viewsPath = __DIR__ . DASHBOARD_VIEWS;
    $this->templates = new Engine($viewsPath);
  }

  public function home($data)
  {
    $page_name = "home";
    echo $this->templates->render($page_name, $data);
  }
  public function login($data)
  {
    $page_name = "login";
    echo $this->templates->render($page_name, $data);
  }
  public function usersAdm($data)
  {
    $page_name = "usersAdm";
    echo $this->templates->render($page_name, $data);
  }
  public function utentes($data)
  {
    $page_name = "utentes";
    echo $this->templates->render($page_name, $data);
  }
  public function scheduling($data)
  {
    $page_name = "scheduling";
    echo $this->templates->render($page_name, $data);
  }
  public function stateDocuments($data)
  {
    $page_name = "state_documents";
    echo $this->templates->render($page_name, $data);
  }
  public function messages($data)
  {
    $page_name = "messages";
    echo $this->templates->render($page_name, $data);
  }
  public function news($data)
  {
    $page_name = "news";
    echo $this->templates->render($page_name, $data);
  }
  public function events($data)
  {
    $page_name = "events";
    echo $this->templates->render($page_name, $data);
  }

  public function error($data)
  {
    echo " <h1> Erro Dash {$data["errocode"]} </h1> ";
    var_dump($data);
  }
}
