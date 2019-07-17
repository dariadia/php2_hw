<?php

use  \App\models\User;
use  \App\models\Good;
use  \App\services\BD;

include $_SERVER['DOCUMENT_ROOT'] . '/App/services/Autoload.php';

spl_autoload_register(
    [
        new Autoload(),
        'loadClass'
    ]
);

$user = new User();
$good = new Good();

//var_dump($good->getAll());
// $good->deleteOne(3); // удалить товар с id 3, работает :)
// $good->insertGood('laptop', 'cool', '40000', '1', 'c.jpg'); // добавить товар, работает :)
//$good->updateOne(1, 'good_price', 1200); изменить что-то в товаре, работает :)


//var_dump($user->getOne(2)); // показать юзера с id 2
// var_dump($user->getAll()); // показать юзеров, работает :)
// $user->insertUser('Babilo', 'blabla', '14fs3', '2019-07-16 06:14:00'); // добавить юзера, работает :)
