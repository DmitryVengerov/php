<?php

  include_once("session_check.php");

  include_once("db_connect.php");
  include_once("roles.php");

  if(!$user_roles["admin"]){
    header("Location: /");
    exit;
  }


  $editmode = false;
  if (isset($_GET["edituser"])) $editmode = true;

  if($editmode){
    $user_id = $_GET["edituser"];
    $user = mysql_query("SELECT lastname,firstname,gender,city_id,student FROM users WHERE id=$user_id");
    if(mysql_num_rows($user)>0){
      $user_info = mysql_fetch_assoc($user);
      $lastname = $user_info["lastname"];
      $firstname = $user_info["firstname"];
      $student = $user_info["student"];
      $gender = $user_info["gender"];
      $city_id = $user_info["city_id"];
    }else{
      $editmode=false;
    }

  }
?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Test page</title>
    <link rel="stylesheet" href="bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3>
            <?php if ($editmode) {
              echo "Редактирование пользователя '$lastname $firstname'";
            }else{
              echo "Добавление пользователя";
            } ?>
          </h3>
          <form action="users.php" method="post">

            <?php if($editmode) echo "<input type='hidden' name='user_id' value='$user_id'>"; ?>

            <div class="form-group">
              <input required="true" type="text" class="form-control" name="firstname" placeholder="Имя" <?php if($editmode) echo "value='$firstname'"; ?>>
            </div>
            <div class="form-group">
              <input required="true" type="text" class="form-control" name="lastname" placeholder="Фамилия" <?php if($editmode) echo "value='$lastname'"; ?>>
            </div>
            <div class="checkbox">
              <label>
                <input name="remember" type="checkbox" <?php if($editmode&&$student==1) echo "checked='true'"; ?>> Я студент
              </label>
            </div>
            <div class="well">
              <h5>
                Возможности
              </h5>
            <?php
              if($editmode){
                  $user_roles = mysql_query("SELECT role_id FROM users_roles WHERE user_id=$user_id");
                  $user_roles_arr = array();
                  while($row = mysql_fetch_assoc($user_roles)){
                    $user_roles_arr[] =  $row["role_id"];
                  }

              }

              $roles = mysql_query("SELECT id,name FROM roles ORDER BY name ASC");
              while($row = mysql_fetch_assoc($roles)){
                $id=$row["id"];
                $name=$row["name"];
                ?>
                <div class="checkbox">
                  <label>
                    <input name="roles[]" value="<?php echo $id; ?>" <?php if($editmode&&in_array($id,$user_roles_arr)) echo "checked='true'"; ?> type="checkbox"> <?php echo $name; ?>
                  </label>
                </div>
              <?php } ?>
            </div>

            <div class="radio">
              <label>
                <input type="radio" name="gender" value="1" <?php if(($editmode&&$gender==1)||!$editmode){ echo "checked='true'"; } ?> > Муж.
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="gender" value="2" <?php if($editmode&&$gender==2){ echo "checked='true'"; } ?> > Жен.
              </label>
            </div>
            <div class="form-group">
              <label>
                Город
                <select name="city">
                  <?php
                  $cities = mysql_query("SELECT id,name FROM cities ORDER BY name ASC");
                  while($row = mysql_fetch_assoc($cities)){
                    $name = $row["name"];
                    $id = $row["id"]; ?>
                    <option value="<?php echo $id; ?>" <?php if($editmode&&$city_id==$id) echo "selected='true'"; ?>><?php echo $name; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </label>
            </div>
            <button type="submit" class="btn btn-primary">
              <?php if ($editmode) {
                echo "Сохранить";
              }else{
                echo "Добавить!";
              } ?>
            </button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
