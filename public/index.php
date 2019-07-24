<?php


//include $_SERVER['DOCUMENT_ROOT'] .'/App/services/Autoload.php';
include $_SERVER['DOCUMENT_ROOT'] .
    '/App/vendor/autoload.php';


// use Twig\Environment;
// use Twig\Loader\FilesystemLoader;
// use App\models\User;

// $loader = new FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . '/App/views/twig');
// $twig = new Environment($loader);

// $user = new User();
// $one = $user->getOne(2);
// $usersAll = $user->getAll();


// echo $twig->render('user.html.twig', [
//     'user' => $one,
// ]);
// echo $twig->render('users.html.twig', [
//     'users' => $usersAll,
// ]);

$controllerName = $_GET['c'] ?: 'user';
$actionName = $_GET['a'];

$controllerClass = 'App\\controllers\\' .
    ucfirst($controllerName) . 'Controller';
if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new \App\services\renders\TwigRenderServices());
    $controller->run($actionName);
}
