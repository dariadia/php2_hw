<?php

// $db = new PredisClient();
// $sessionHandler = new SessionHandler($db);
// session_set_save_handler(
//     array($sessionHandler, 'open'),
//     array($sessionHandler, 'close'),
//     array($sesssessionHandlerHandler, 'read'),
//     array($sessionHandler, 'write'),
//     array($sessionHandler, 'destroy'),
//     array($sessionHandler, 'gc')
// );
// session_start();



include $_SERVER['DOCUMENT_ROOT'] .
    '/../vendor/autoload.php';
$request = new \App\services\Request();

//try{
//    $request->getError();
//} catch (\App\services\newException $e) {
//    $e->dumpError();
//} catch (Exception $e) {
//    $e->getMessage();
//}

$controllerName = $request->getControllerName() ?: 'user';
$actionName = $request->getActionName();

// var_dump($controllerName);
// var_dump($request);

$controllerClass = 'App\\controllers\\' .
    ucfirst($controllerName) . 'Controller';
if (class_exists($controllerClass)) {
    $controller = new $controllerClass(
        new \App\services\renders\TwigRenderServices(),
        $request
    );
    $controller->run($actionName);
}

//$loader = new \Twig\Loader\ArrayLoader([
//    'index' => 'Hello {{ name }}!',
//]);
//$a = new \Twig\Environment($loader);
