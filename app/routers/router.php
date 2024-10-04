<?php

use CoffeeCode\Router\Router;

function router()
{

  $router = new Router(URL_BASE);

  $router->namespace("App\controllers");

  // ROTA DE BASE
  $router->group(null);
  // 1º parâmetro: Rota | 2º parâmetro: controller (o que será executado)
  // No controller: 1º parâmetro: o arquivo (onde tem a função) (ex.: Base) |  2º parâmetro: função (ex.: home)

  // ROTA DA DASHBOARD
  // $router->group("/dashboard");
  $router->get("/", "Dash:login");
  $router->get("/home", "Dash:home");
  $router->get("/login", "Dash:login");
  $router->get("/usersAdm", "Dash:usersAdm");
  $router->get("/course", "Dash:course");
  $router->get("/messages", "Dash:messages");
  $router->get("/news", "Dash:news");

  // ROTA DE ERROS
  $router->group("/ops");
  $router->get("/{errocode}", "Dash:error");


  $router->dispatch();

  if ($router->error()) {
    $router->redirect("/ops/{$router->error()}");
  }
}
