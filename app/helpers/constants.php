<?php

define('URL_BASE', "http://localhost/_web/web-escolar-painel-php");
define('SITE', "InsPOPFU - Website escola");

define('CONTROLLERS', 'app/controllers');

define('FOLDER_BASE', "/app/views/base");
define('BASE_VIEWS', "/../views/base");
define('BASE_STYLES', "/src/styles");
define('BASE_JS', "/src/js");
define('BASE_IMG', "/src/assets/images");

define('BASE_DETAILSNEWS', "news/detailsNews");

define('FOLDER_DASHBOARD', "/app/views/dashboard");
define('DASHBOARD_VIEWS', "/../views/dashboard");
define('DASHBOARD_STYLES', "/src/styles");
define('DASHBOARD_JS', "/src/js");
define('DASHBOARD_IMG', "/src/assets/images");


function urlProject(string $uri = null): string
{
  if ($uri) {
    return URL_BASE . "/{$uri}";
  }

  return URL_BASE;
}
function urlDashProject(string $uri = null): string
{
  if ($uri) {
    return URL_BASE . "/dashboard/{$uri}";
  }

  return URL_BASE . "/dashboard";
}
