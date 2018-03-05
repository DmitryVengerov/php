<?php
session_start();
if(!isset($_SESSION['user'])){
  header("Location: /");
  exit;
}

include_once("db_connect.php");



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Профиль</title>
    <link rel="stylesheet" href="bootstrap.min.css">
  </head>
  <body>
    <?php include_once("nav.php"); ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          Меня зовут <?php echo "$firstname $lastname" ?>. Я <?php
          switch ($gender) {
            case '1':
              echo "парень";
              break;

            case '2':
              echo "девушка";
              break;

            default:
              echo "человек (???)";
              break;
          }
           ?> из города <?php echo $city; ?>.
           <?php if($student=="1") echo "Я студент."; ?>
           <?php if($user_roles["creator"]){ ?>
           <h2>
             Предложенные новости
           </h2>
           <?php
             $news_q = mysql_query("SELECT text, lastname, firstname, DATE_FORMAT(date_p,'%d.%m') as date, DATE_FORMAT(date_p,'%H:%i') as time FROM news JOIN users ON news.author_id=users.id WHERE status=1 and users.id=$user_id");
             while ($news = mysql_fetch_assoc($news_q)) { ?>
               <div class="well">
                 <p>
                   <?php echo $news["text"]; ?>
                 </p>
                 <div class="text-muted">
                   <i>Предложена <?php echo $news["date"]; ?> в <?php echo $news["time"]; ?></i>
                 </div>
               </div>
             <?php }
               if(mysql_num_rows($news_q)==0){
                 echo "<span class='text-muted'>Нет таких</span>";
               }
             ?>

             <?php } ?>

        </div>
      </div>
    </div>
  </body>
</html>
