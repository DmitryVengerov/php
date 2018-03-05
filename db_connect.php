<?php
$host = "localhost";
$user = "root";
$password = "1234";
$db = "coinhunter";
$connect = mysql_connect($host,$user,$password) or die("MySQL сервер недоступен!".mysql_error());
mysql_select_db($db) or die("Нет соединения с БД".mysql_error());
mysql_query("set names utf8");
?>
