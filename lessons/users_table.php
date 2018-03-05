<?php

include_once("session_check.php");
include_once("db_connect.php");
include_once("roles.php");

if(!$user_roles["admin"]){
  header("Location: /");
  exit;
}

if(isset($_GET["deluser"])){
  $id = $_GET["deluser"];
  mysql_query("DELETE FROM users WHERE id=$id");
}

function showUsersTable($users){
    $table='<table class="table">
      <thead>
        <tr>
          <th>
            Фамилия Имя
          </th>
          <th>
            Пол
          </th>
          <th>
            Город
          </th>
          <th>
            Дополнительно
          </th>
          <th>
            Возможности
          </th>
          <th>
            Действия
          </th>
        </tr>
      </thead><tbody>';

      while($row = mysql_fetch_assoc($users)){
        $id = $row["id"];
        $lastname = $row["lastname"];
        $firstname = $row["firstname"];
        $gender = $row["gender"];
        $city = $row["city"];
        $student = $row["student"];
        $login=$row["login"];

        $table.="<tr><td>$lastname $firstname</td>";
        switch ($gender) {
          case '1':
            $table.="<td>М</td>";
            break;

          case '2':
            $table.="<td>Ж</td>";
            break;

          default:
            $table.="<td>x</td>";
            break;
        }
        $table.="<td>$city</td>";
        $table.="<td>";
        if ($student==1) $table.="Студент";
        $table.="</td>";

        $user_roles = mysql_query("SELECT name FROM users_roles JOIN roles ON users_roles.role_id=roles.id WHERE user_id=$id");
        $user_roles_str = "";

        while($row = mysql_fetch_assoc($user_roles)){
          $user_roles_str.= $row["name"]."<br>";
        }

        $user_roles_str = rtrim($user_roles_str,"<br>");

        if($user_roles_str=="") $user_roles_str = "<span class='text-muted'>Только просмотр новостей</span>";

        $table.="<td>$user_roles_str</td>";

        $table.="<td>
          <a href='users_table.php?deluser=$id' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a>
          <a href='add.php?edituser=$id' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>";
        if($login=="") $table.=" <a href='auth.php?user=$id' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-lock' aria-hidden='true'></span></a>";
        $table.="</td>";

        $table.="</tr>";
      }

      if(mysql_num_rows($users)==0){
        $table="<tr><td colspan='6' class='text-center text-muted'>Пользователей не найдено</td></tr>";
      }

      $table.='</tbody></table>';

      return $table;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Пользователь</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
      .glyphicon{
        top: 2px;
      }
    </style>
  </head>
  <body>
    <?php include_once "nav.php"; ?>
    <div class="container">
      <?php if(isset($_GET['code'])){
        switch ($_GET['code']) {
          case '0':
            $alert_class="alert-success";
            $alert_text = "<strong>Готово!</strong> Пользователь был успешно добавлен";
            break;

          case '1':
            $alert_class="alert-warning";
            $alert_text = "<strong>Готово!</strong> Пользователь был успешно сохранен";
            break;

          case '2':
            $alert_class="alert-danger";
            $alert_text = "<strong>Ошибка!</strong> Имя или фамилия пользователя не были указаны";
            break;

          default:
            $alert_class="alert-info";
            $alert_text = "<strong>Стоп!</strong> Неизвестный код ошибки";
            break;
        }

      ?>
      <div class="row">
        <div class="col-md-12">
          <div class="alert <?php echo $alert_class;  ?>" role="alert" style="margin-top: 20px;">
            <?php echo $alert_text; ?>
          </div>
        </div>
      </div>
      <?php } ?>
      <div class="row">
        <div class="col-md-12">
          <h3 style="margin-bottom: 40px;">
             Пользователи сайта
             <a href="add.php" class="btn btn-primary pull-right">Добавление пользователей</a>
          </h3>
          <?php
            $users = mysql_query("SELECT users.id, lastname, firstname, name as city, gender,student,login FROM users JOIN cities ON users.city_id=cities.id ORDER BY lastname ASC");
            echo showUsersTable($users);
          ?>
        </div>
      </div>
      <div class="row" style='margin-top: 20px;'>
        <div class="col-md-12">
          <form action="users_table.php" method="get">
            <div class="input-group">
              <input type="text" name="query" class="form-control" placeholder="Введите имя">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Найти!</button>
              </span>
            </div>
          </form>
        </div>
      </div>
      <?php if (isset($_GET["query"])) { ?>
        <div class="row" style='margin-top: 20px;'>
          <div class="col-md-12">
            <h3>Результаты поиска</h3>
            <div>
              <?php
                $query = $_GET["query"];
                $result = mysql_query("SELECT users.id, lastname,firstname,gender,name as city,student,login FROM users JOIN cities ON users.city_id=cities.id WHERE CONCAT(lastname,' ',firstname) like '%$query%' ORDER BY lastname ASC");
                echo showUsersTable($result);
              ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </body>
</html>
 