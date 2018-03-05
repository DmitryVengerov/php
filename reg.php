<?php
include("db_connect.php");
 ?>
﻿<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <title>registration</title>
      <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="well" style="margin-top: 150px;">
              <form action="save_user.php" method="post" autocomplete="off">

                <div class="from-group">
                  <label>Ваш логин:</label>
                  <input name="login" type="text" class="form-control" placeholder="Логин" required="true">
                </div>
                <div class="from-group">
                  <label>Ваш пароль:</label>
                  <input name="password" type="password" class="form-control" placeholder="Пароль" required="true">
                </div>
                <div class="from-group">
                  <label>Ваше Имя:</label>
                  <input name="name" type="name" class="form-control" placeholder="Имя" required="true">
                </div>
                <div class="from-group">
                  <label>Ваша Фамилия:</label>
                  <input name="lastname" type="lastname" class="form-control" placeholder="Фамилия" required="true">
                </div>
                <div class="from-group">
                  <label>Ваша Почта:</label>
                  <input name="mail" type="mail" class="form-control" placeholder="Почта" required="true">
                </div>
                <div class="from-group">
                   <label></label>
                  <!-- **** Костыль **** -->
                  <!--<input name="mail" type="mail" class="form-control" placeholder="Почта">-->
                </div>
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </body>
    </html>
