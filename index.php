<?php
  if(isset($_POST['login']))
  {
    $login = trim($_POST['login']);
    $pass = trim($_POST['pass']);
    if($login!="" && $pass!="")
    {
      /*.$host = "localhost";
      $user = "root";
      $password = "1234";
      $db = "coinhunter";
      $connect = mysql_connect($host,$user,$password) or die("MySQL сервер недоступен!".mysql_error());

      mysql_select_db($db) or die("Нет соединения с БД".mysql_error());
      mysql_query("set names utf8");
      */
      include("db_connect.php");
      $users = mysql_query("SELECT id_user, name, lastname, login, password, mail FROM user_table");
      while($row = mysql_fetch_assoc($users))
      {
        $thislogin = $row["login"];
        if($thislogin==$login)
        {
          $dbpass = sha1("%^&*@B#".$pass."%^&*FG");
          $thispass = $row["pass"];
          if($thispass==$dbpass)
          {
            $authuser_id = $row["id"];
            $_SESSION["users"] = $row["id"];
            header("Location: profile.php");
            exit;
          }
        }
      }
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <title>authorization</title>
    <link rel="stylesheet" href="bootstrap.min.css">
     <style>
    .center 
    {
    width:  500px;
    margin: 0 auto;
    }

    .text {
    text-align:  center;
   }

    </style>
  </head>
  <body>
    <form action="testreg.php" method="post" autocomplete="off">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="well" style="margin-top: 150px;">
            <form action="/" method="POST">
              <div class="form-group">
                <label for="inputLogin">Логин</label>
                <input type="text" name="login" class="form-control" id="inputLogin" placeholder="Логин">
              </div>
              <div class="form-group">
                <label for="inputPass">Пароль</label>
                <input type="password" name="pass" class="form-control" id="inputPass" placeholder="Пароль">
              </div>
              <a href="profile.php" type="input" class="btn btn-primary">Войти</a>
              <a href="reg.php" type="input" class="btn btn-default">Зарегистрироваться</a>
            </form>
          </div>
        </div>
      </div>
      <div class="menu">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div  style="margin-top: 150px;">
              <a id="contact-us" style="text" data-bypass href="mailto:hardbeat34@gmail.com">Contact Us</a>
            </div>
            <diV style="text">
            <h>By Vengerov</h>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
