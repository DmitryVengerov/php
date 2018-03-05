<?php
//session_start();
//if(!isset($_SESSION['user'])){
  ///header("Location: /");
  //exit;
//}
include_once("db_connect.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Профиль</title>
    <link rel="stylesheet" href="bootstrap.min.css">
  </head>
  <body>
    <?php include_once("nav.php"); ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          Меня зовут <?php echo "$name $lastname" ?>
           <h2>
             Тут должна быть таблица  
           </h2>

        </div>
      </div>
    </div>
  </body>
</html>
