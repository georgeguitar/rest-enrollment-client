<?php
session_start();

if (!isset($_SESSION['id_token'])){
    header('Location: ../index.php');
}

include('../config.inc.php');
$token = $_SESSION['id_token'];

/*
* Se esperan los parametros para que se pueda llenar 
* con ellos el registro mediante la api
*/

require __DIR__ . '/../vendor/autoload.php';
use GuzzleHttp\Client;

if (!isset($_POST['inputName'])){    
    header('Location: program.php');
}

$client = new Client([
    'base_uri' => DIRECCION_BASE . '/api/programs',
    'timeout'  => 5.0,
]);

$headers = [
    'Authorization' => 'Bearer '. $token,
    'Accept' => 'application/json',
    'content-type' => 'application/json'
];
$info = '
{
    "name": "'.$_POST['inputName'].'",
    "semesters": "'.$_POST['selectSemesters'].'",
    "title": "'.$_POST['inputTitle'].'",
    "credits": "'.$_POST['inputCredits'].'"
}
';

/*
* Enviamos al servidor api la solicitud de insertar datos
* segun la direccion va a variar esta accion, el codigo 
* para saber si fue exitoso enviado desde el servidor 201
* aunque deberia de ser el 200
*/
$res = $client->request('POST', '', ['headers' => $headers, 'body' => $info]);
if ($res->getStatusCode() == '201') 
{
$message = "Se ha insertado un PROGRAM";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Starter Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/starter-template/">

    <!-- Bootstrap core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


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
    <link href="../starter-template.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">TAREA API REST</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../menu.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Entities</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
        <a class="dropdown-item" href="../student/student.php">Student</a>
          <a class="dropdown-item" href="../enrollment/enrollment.php">Enrollment</a>
          <a class="dropdown-item" href="program.php">Program</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="../logout.php" method="post">      
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Logout</button>
    </form>
  </div>
</nav>

<main role="main" class="container">
<h1>Inserted Program</h1>
<p><?php echo $message; ?></p>

</main><!-- /.container -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script><script src="../js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script></body>
</html>
<?php 
}
?>