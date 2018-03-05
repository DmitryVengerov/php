<?php
  include ("db_connect.php");
  mysql_query("set names utf8");
// СОЕДНИЕНИЕ С БД
// id_user, name, lastname, login, password, @mail
  $name = trim($_POST["name"]);
  $lastname = trim($_POST["lastname"]);
  $mail = trim($_POST["mail"]);

  if(isset($_POST["name"]) && $name!="" && isset($_POST["lastname"]) && $lastname!=""){
    if(isset($_POST["id_user"])){
      $user_id = trim($_POST["id_user"]);
      mysql_query("UPDATE user_table SET name='$name', lastname='$lastname', mail='$mail' WHERE id='$id_user'");
    }else{
      mysql_query("INSERT INTO users_table(name,lastname,mail) values('$name','$lastname','$mail')") or die("error: ".mysql_error());
      $user_id = mysql_insert_id();
      echo($user_id);
      echo("xxx");
    }
  }
  
  exit;
  echo($name);
  echo($lastname);
  echo "$mail";
  echo($user_id);
  echo("xxx");
?>
