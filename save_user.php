<?php
    include_once("db_connect.php");
    
    if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) { $password = $_POST['password']; if ($password =='') { unset($password);} }
    if (isset($_POST['name'])) { $name = $_POST['name']; if ($name =='') { unset($name);} }
    if (isset($_POST['lastname'])) { $lastname = $_POST['lastname']; if ($lastname =='') { unset($lastname);} }
    if (isset($_POST['mail'])) { $mail = $_POST['mail']; if ($mail =='') { unset($mail);} }

    if (empty($login) or empty($password) or empty($name) or empty($lastname) or empty($mail) ) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
      exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
      
      /*echo '<script language="javascript">';
      echo 'alert("Вы ввели не всю информацию, вернитесь назад и заполните все поля")';
      echo '</script>';
      exit;
      */
      //echo "<script>javascript: alert('Вы ввели не всю информацию, вернитесь назад и заполните все поля')></script>";
    }
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $name = stripslashes($name);
    $name = htmlspecialchars($name);
    $lastname = stripslashes($lastname);
    $lastname = htmlspecialchars($lastname);
    $mail = stripslashes($mail);
    $mail = htmlspecialchars($mail);
    $login = trim($login);
    $password = trim($password);
    $name = trim($name);
    $lastname = trim($lastname);
    $mail = trim($mail);
 // проверка на существование пользователя с таким же логином
    $result = mysql_query("SELECT id_user FROM user_table WHERE login='$login'");
    $myrow = mysql_fetch_array($result);
    if (mysql_num_rows($result)!=0)
    {
    //$alert_text = "<strong>Стоп!</strong>";
      exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
      //echo '<script language="javascript">';
      //echo 'alert("message successfully sent")';
      //echo '</script>';
    }
    // если такого нет, то сохраняем данные
    $result2 = mysql_query("INSERT INTO user_table ( login , password , name , lastname , mail ) VALUES( '$login' , '$password' , '$name' , '$lastname' , '$mail')");
    // Проверяем, есть ли ошибки
    if ($result2=='TRUE')
    {
      // максимум 13 знаков должно быть в передаваемых данных в бд, тк стоит ограничение 13 символов
      echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='index.php'>Главная страница</a>";
    }
    else
    {
      // максимум 13 знаков должно быть в передаваемых данных в бд, тк стоит ограничение 13 символов
      echo "Ошибка! Вы не зарегистрированы. Ваши данные превысили ограничение на ввод символов.";
    }
    ?>
