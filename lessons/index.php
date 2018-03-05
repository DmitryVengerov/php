<?php
  session_start();
  if(isset($_SESSION['user'])){
    header("Location: profile.php");
    exit;
  }

  if(isset($_POST['login'])){
    $code = 0;

    $login = trim($_POST['login']);
    $pass = trim($_POST['pass']);
    if($login!=""&&$pass!=""){
      $host = "localhost";
      $user = "root";
      $password = "mysql";
      $db = "poks";
      $connect = mysql_connect($host,$user,$password) or die("MySQL сервер недоступен!".mysql_error());
      mysql_select_db($db) or die("Нет соединения с БД".mysql_error());
      mysql_query("set names utf8");

      $users = mysql_query("SELECT id, login, pass, firstname, lastname FROM users");

      while($row = mysql_fetch_assoc($users)){
        $thislogin = $row["login"];
        if($thislogin==$login){
          $dbpass = sha1("%^&*@B#".$pass."%^&*FG");
          $thispass = $row["pass"];
          if($thispass==$dbpass){
            $authuser_id = $row["id"];
            $_SESSION["user"] = $row["id"];
            header("Location: profile.php");
            exit;
          }
        }
      }
    }else{
      $code=1;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="well" style="margin-top: 100px;">
            <form action="/" method="POST">
              <div class="form-group">
                <label for="inputLogin">Логин</label>
                <input type="text" name="login" class="form-control" id="inputLogin" placeholder="Логин">
              </div>
              <div class="form-group">
                <label for="inputPass">Пароль</label>
                <input type="password" name="pass" class="form-control" id="inputPass" placeholder="Пароль">
              </div>
              <button type="submit" class="btn btn-default">Войти</button>
            </form>
          </div>
        </div>
      </div>
      <?php if(isset($_POST['login'])){ ?>
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <?php switch ($code) {
            case '0':
              echo "Пользователь не найден";
              break;

            case '1':
              echo "Заполните все поля!";
              break;

            default:
              echo "Неизвестный код";
              break;
          } ?>
        </div>
      </div>
      <?php } ?>
    </div>
  </body>
</html>
