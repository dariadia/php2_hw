<?php


echo <<<php
   
<form action="?a=update&id={$user->id}" method="post">
    <hr>
    <h5>Обновить инфо пользователя</h5>
    <input type="text" name="id" value="{$user->id}" disabled>

    <input type="text" placeholder="name" name="user_name">
    <input type="text" placeholder="login" name="user_login">
    <input type="password" placeholder="password" name="user_password">
    <input type="text" placeholder="action" name="user_last_action">
    <input type="submit">
    </form>
  

php;
