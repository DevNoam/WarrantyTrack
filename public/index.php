<?php
  require __DIR__ . '/../vendor/autoload.php';

  use Framework\Router;
  require_once('../helpers.php');
  
  session_start();
  new Framework\Database();

  $router = new Router();
  $routes = require_once(basePath('Routes.php'));
  
  $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $router->route($uri);
?>