<?php

namespace App\services\renders;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRenderServices implements IRenderService
{
    public function renderTmpl($template, $params = [])
    {
        ob_start();
        extract($params);

        //var_dump($params); //тут массив с объектами на месте, а в шаблоне пусто...

        $loader = new FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . '/App/views/twig');
        $twig = new Environment($loader);



        echo $twig->render($template . '.html.twig', [
            'params' => $params,
            'content' => 'users',
        ]);

        // var_dump($params); а тут уже два массива вместо положенного 1

        return ob_get_clean();
    }
}
