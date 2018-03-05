<?php
include_once("session_check.php");
include_once("db_connect.php");
include_once("roles.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Новости</title>
    <link rel="stylesheet" href="bootstrap.min.css">
  </head>
  <body>
    <?php include_once("nav.php"); ?>
    <div class="container">
      <?php if(isset($_GET['q'])){
        switch ($_GET['q']) {
          case 'y':
            $alert_class="alert-success";
            $alert_text = "<strong>Готово!</strong> Новость успешно отправлена на проверку";
            break;

          case 'n':
            $alert_class="alert-warning";
            $alert_text = "<strong>Ошибка!</strong> Не был указан текст новости";
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
          <h3>Новости
            <?php if($user_roles["creator"]){ ?>
            <a href="news_post.php" class="btn btn-primary pull-right">Предложить новость</a>
            <?php } ?>
          </h3>
          <?php
            $news_q = mysql_query("SELECT text, lastname, firstname, DATE_FORMAT(date_p,'%d.%m') as date, DATE_FORMAT(date_p,'%H:%i') as time FROM news JOIN users ON news.author_id=users.id WHERE status=2");
            while ($news = mysql_fetch_assoc($news_q)) { ?>
              <blockquote>
                <p><?php echo $news["text"]; ?></p>
                <footer><?php echo "$firstname $lastname"; ?> <i><?php echo $news["date"]; ?> в <?php echo $news["time"]; ?></i></footer>
              </blockquote>
            <?php }
              if(mysql_num_rows($news_q)==0){
                echo "<span class='text-muted'>Нет новостей</span>";
              }
            ?>
        </div>
      </div>
    </div>
  </body>
</html>
