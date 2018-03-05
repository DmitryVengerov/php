<?php
  $host = "localhost";
  $user = "root";
  $password = "mysql";
  $db = "poks";
  $connect = mysql_connect($host,$user,$password) or die("MySQL сервер недоступен!".mysql_error());
  mysql_select_db($db) or die("Нет соединения с БД".mysql_error());
  mysql_query("set names utf8");

  $firstname = trim($_POST["firstname"]);
  $lastname = trim($_POST["lastname"]);
  $gender = trim($_POST["gender"]);
  $city = trim($_POST["city"]);
  $roles = $_POST["roles"];
  if(isset($_POST["remember"])){
    $student=1;
  }else{
    $student=0;
  }

  $code=0;

  if(isset($_POST["firstname"])&&$firstname!=""&&isset($_POST["lastname"])&&$lastname!=""){
    if(isset($_POST["user_id"])){
      $user_id = trim($_POST["user_id"]);
      mysql_query("UPDATE users SET firstname='$firstname', lastname='$lastname', city_id='$city', gender='$gender', student='$student' WHERE id='$user_id'");
      mysql_query("DELETE FROM users_roles WHERE user_id=$user_id");
      $code=1;
    }else{
      mysql_query("INSERT INTO users(firstname,lastname,city_id,gender,student) values('$firstname','$lastname','$city','$gender','$student')") or die("error: ".mysql_error());
      $user_id = mysql_insert_id();
    }
    foreach ($roles as $role) {
      mysql_query("INSERT INTO users_roles(user_id,role_id) values('$user_id','$role')");
    }
  }else{
    $code=2;
  }

  header("Location: users_table.php?code=$code");
  exit;

?>
