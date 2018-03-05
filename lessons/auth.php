<?php
  include_once("db_connect.php");
  $user = trim($_GET["user"]);
  $check=false;

  if ($user) {
    $user_info = mysql_query("SELECT lastname,login FROM users WHERE id=$user");

    if(mysql_num_rows($user_info)>0){
      $user_info_row = mysql_fetch_assoc($user_info);
      if($user_info_row["login"]==""){
        $login = substr(sha1(rand()), 0, 16);
        $pass = substr(sha1(rand()), 0, 8);
        $shapass = sha1("%^&*@B#".$pass."%^&*FG");
        $check = true;

        mysql_query("UPDATE users set login='$login', pass='$shapass' WHERE id=$user");
      }
    }
  }





?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Новый пароль</title>
    <link rel="stylesheet" href="bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3" style="margin-top: 100px;">
          <?php if ($check) { ?>
            <div class="well text-center">
              <p>
                <strong>Логин:</strong> <?php echo $login; ?>
              </p>
                <strong>Пароль:</strong> <?php echo $pass; ?>
            </div>
            <a href="users_table.php">Вернуться к таблице</a>
            <a href="users_table.php" class="pull-right">Отправить на почту</a>
          <?php }else{ ?>
            <div class="alert alert-danger">
              Пользователь не найден или уже имеет логин!
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </body>
</html>
