<?php
session_start();
$_SESSION["id_token"] = null;
include('config.inc.php');
require 'vendor/autoload.php';
use GuzzleHttp\Client;

if (isset($_POST['inputUser'])){
  
  $endpoint_url= DIRECCION_BASE."/api/authenticate";
  $string_json = '{
      "password": "'.trim($_POST['inputUser']).'",
      "rememberMe": true,
      "username": "'.trim($_POST['inputPassword']).'"
    }';  
  $client = new Client();
  $options= array(
    'headers'  => ['content-type' => 'application/json', 'Accept' => 'application/json'],
    'body' => $string_json,
    "debug" => true
  );
  try {
    $res = $client->post($endpoint_url, $options);
  } catch (ClientException $e) {
    echo $e->getRequest() . "\n";
    if ($e->hasResponse()) {
      echo $e->getResponse() . "\n";
    }
  }
  $respuesta = json_decode($res->getBody(), true);
  $_SESSION['id_token'] = $respuesta['id_token'];
  header('Location: menu.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Signin Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <form class="form-signin" action="index.php" method="post">  
  <img class="mb-4" src="bootstrap-solid.svg" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Tarea Cliente Rest</h1>
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  <label for="inputUser" class="sr-only">User</label>
  <input type="text" id="inputUser" name="inputUser" class="form-control" placeholder="User" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
</form>
</body>
</html>
