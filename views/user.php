<?php

/**
 * @var \App\models\User $user
 */

echo <<<php
   <h3>{$user->user_name}</h3>
   <p> 
      {$user->user_login}
   </p>
   <p>
      {$user->user_last_action}
   </p>
  

php;
include $_SERVER['DOCUMENT_ROOT'] . '/App/views/userUpdate.php';
