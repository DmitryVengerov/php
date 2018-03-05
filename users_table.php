<?php
include ("db_connect.php"); // подключение базы данных
//if(isset($_GET["deluser"])){
  //$id = $_GET["deluser"];
  //mysql_query("DELETE FROM users WHERE id=$id");
//}
function showUsersTable($users){
    $table='<table class="table">
      <thead>
        <tr>
          <th>
            Имя Фамилия
          </th>
          <th>
            Логин
          <th>
            Пароль
          </th>
          <th>
            Почта
          </th>
        </tr>
      </thead><tbody>';
      while($row = mysql_fetch_assoc($users)){
        $id = $row["id"];
        $name = $row["name"];
        $lastname = $row["lastname"];
        $login = $row["login"];
        $password = $row["password"];
        $mail = $row["mail"];

        $table.="<tr><td>$name $lastname</td>";
        //$table.="<td>$lastname</td>";
        $table.="<td>$login</td>";
        $table.="<td>$password</td>";
        $table.="<td>$mail</td>";
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
      .glyphicon
        {
        top: 2px;
      }
    </style>
  </head>
  <body>
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
          </h3>
          <?php
//**********************************************
            $users = mysql_query("SELECT login , password , name , lastname , mail FROM user_table ");
//**********************************************
            echo showUsersTable($users);
          ?>
        </div>
      </div>

  </body>
</html>
