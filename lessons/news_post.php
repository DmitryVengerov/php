<?php
include_once("session_check.php");
include_once("db_connect.php");
include_once("roles.php");

if(!$user_roles["creator"]){
  header("Location: /");
  exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Создание новости</title>
    <link rel="stylesheet" href="bootstrap.min.css">
  </head>
  <body>
    <?php include_once("nav.php"); ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3>
            Создание новости
          </h3>
          <form action="news_add.php" method="post">
            <p>
              <textarea name="text" rows="8" class="form-control"></textarea>
            </p>
            <button type="submit" class="btn btn-primary" name="gopost">Создать и отправить на модерацию</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
