<?php

namespace App\controllers;

use App\models\User;

class UserController extends Controller
{
    protected $defaultAction = 'users';

    public function userAction()
    {
        $id = (int) $_GET['id'];
        $params = [
            'user' =>  User::getOne($id)
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
        $id = (int) $_GET['id'];
        $user = User::getOne($id);
        $user->delete();
        header('Location: ?a=users');
    }

    public function insertAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $user->user_name = $_POST['user_name'];
            $user->user_login = $_POST['user_login'];
            $user->user_password = $_POST['user_password'];
            $user->user_last_action = $_POST['user_last_action'];
            $user->save();
            header('Location: ?a=users');
            exit;
        }
        echo $this->render('userInsert', []);
    }

    public function updateAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = (int) $_GET['id'];
            $user = new User();
            $user->id = $id;

            $user->user_name = $_POST['user_name'];
            $user->user_login = $_POST['user_login'];
            $user->user_password = $_POST['user_password'];
            $user->user_last_action = $_POST['user_last_action'];
            $user->save();
            header('Location: ?a=users');
            exit;
        }
        //echo $this->render('userUpdate', []);
    }
}
