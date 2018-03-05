<?php include_once("roles.php");
$user_id = $_SESSION['user'];
$user_q = mysql_query("SELECT users.id, lastname, firstname, name as city, gender,student FROM users JOIN cities ON users.city_id=cities.id WHERE users.id=$user_id");
$user_info = mysql_fetch_assoc($user_q);
$firstname = $user_info["firstname"];
$lastname = $user_info["lastname"];
$city = $user_info["city"];
$gender = $user_info["gender"];
$student = $user_info["student"];
?>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">ПОКС</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li>
          <a href="profile.php">Профиль</span></a>
        </li>
        <li>
          <a href="news_list.php">Новости</span></a>
        </li>
        <?php if($user_roles["moder"]){ ?>
        <li>
          <a href="moder.php">Модерация</span></a>
        </li>
        <?php } ?>
        <?php if($user_roles["admin"]){ ?>
        <li>
          <a href="users_table.php">Администрирование</span></a>
        </li>
        <?php } ?>
      </ul>
      <a type="button" href="logout.php" class="btn btn-default navbar-btn navbar-right" style="margin-left: 10px;">Выйти</a> 
      <p class="navbar-text navbar-right">
        <?php echo "$firstname $lastname"; ?>
      </p>
    </div>
  </div>
</nav>
