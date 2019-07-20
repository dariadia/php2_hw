<?php

namespace App\controllers;

use App\models\User;

class UserController
{
    protected $defaultAction = 'users';
    protected $action;

    public function run($action)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = $this->action . 'Action';
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo '404';
        }
    }

    public function userAction()
    {
        $params = [
            'user' =>  User::getOne(2)
        ];

        echo $this->render('user', $params);
    }

    public function usersAction()
    {
        $params = [
            'users' =>  User::getAll()
        ];

        echo $this->render('users', $params);
    }

    public function deleteAction()
    {
        $params = [
            'delete' =>  User::delete(4)
        ];
        echo '<script type="text/javascript">alert("' . 'Удалили!' . '")</script>';
        $this->run('users');
    }

    public function saveAction()
    {
        $params = [
            'save' =>  User::save()
        ];
        echo '<script type="text/javascript">alert("' . 'обновили!' . '")</script>';
        echo $this->run('users', $params);
    }

    public function render($template, $params = [])
    {
        $content = $this->renderTmpl($template, $params);
        return $this->renderTmpl('layouts/main', [
            'content' => $content
        ]);
    }

    public function renderTmpl($template, $params = [])
    {
        ob_start();
        extract($params);
        include $_SERVER['DOCUMENT_ROOT'] . '/App/views/' . $template . '.php';
        return ob_get_clean();
    }
}
