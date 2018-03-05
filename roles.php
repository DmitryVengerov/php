<?php
session_start();
$user_id = $_SESSION["user"];

$user_roles_q = mysql_query("SELECT role_id FROM user_roles WHERE user_id=$user_id");
echo "$user_roles_q";
$user_roles_arr = array();
while($row = mysql_fetch_assoc($user_roles_q)){
  $user_roles_arr[] =  $row["role_id"];
}

$user_roles["user"] = in_array(1,$user_roles_arr);
$user_roles["admin"] = in_array(2,$user_roles_arr);
//$user_roles["moder"] = in_array(3,$user_roles_arr);
?>
