<?php include_once("roles.php");
$user_id = $_SESSION['user'];
$user_q = mysql_query("SELECT id_user, name, lastname FROM user_table where users.id=$user_id");
echo "$user_q";
$user_info = mysql_fetch_assoc($user_q);
$name = $user_info["name"];
$lastname = $user_info["lastname"];
echo "$name $lastname";
?>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">Coinhunter LOGO</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav" color="red">
        <!--<li><a href="profile.php">Профиль</span></a></li>-->
        <!-- Ссылка на пока еще не существующую страницу где будут списки имеющихся монет-->
        <li><a href="whatihave.php">Имеющиеся</span></a></li>
        <li><a href="whatihave.php">Имеющиеся</span></a></li>
        <li><a href="notfound.php">Обмен</span></a></li>
        <li><a href="notfound.php">Не хватает</span></a></li>
        <!--
        <li>
          <a href="news_list.php">Новости</span></a>
        </li>

        <li>
          <a href="moder.php">Модерация</span></a>
        </li>
        <li>
          <a href="users_table.php">Администрирование</span></a>
        </li>
        -->
      </ul>
      <a type="button" href="logout.php" class="btn btn-default navbar-btn navbar-right" style="margin-left: 10px;">Выйти</a>
      <p class="navbar-text navbar-right">
        <?php echo "$name $lastname"; ?>
      </p>
    </div>
  </div>
</nav>
