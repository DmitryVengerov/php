<?php
include_once("session_check.php");
include_once("db_connect.php");
include_once("roles.php");

if(!$user_roles["creator"]){
  header("Location: /");
  exit;
}

if(isset($_POST["gopost"])&&trim($_POST["text"])!=""){
  $text = trim($_POST["text"]);
  mysql_query("INSERT INTO news(text,author_id,status,date_p) values('$text','$user_id','1',NOW())");
  header("Location: news_list.php?q=y");
}else{
  header("Location: news_list.php?q=n");
}
exit;

?>
