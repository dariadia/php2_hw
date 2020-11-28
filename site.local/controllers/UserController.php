<?php

namespace App\controllers;

use App\main\App;
use App\models\entities\User;
use App\models\repositories\UserRepository;

class UserController extends Controller
{
    protected $defaultAction = 'users';

    public function userAction()
    {
        $id = $this->getId();
        $getDate = getdate();
        $date = $getDate['mday'] . $getDate['mon'];
        $params = [
            'date' => $date,
            'user' => App::call()->userRepository->getOne($id),
            'auth' => $_SESSION['isAuth']
        ];

        echo $this->render('user', $params);
    }

    public function usersAction()
    {
        $params = [
            'users' =>  App::call()->userRepository->getAll()
        ];

        echo $this->render('users', $params);
    }


    public function authAction()
    {
        if (!isset($_SESSION['isAuth'])) {
            $_SESSION['username'] = 'guest';
        }
    }

    protected function safe($data)
    {
        return htmlspecialchars(strip_tags($data));
    }

    protected function login()
    {
        //кривовато что переменные тут болтаются, но если я наоборот не хочу их за пределы функции таскать ...?
        $login = '';
        $password = '';

        if (isset($_POST['user_login']) && isset($_POST['user_password'])) {
            $login = $this->safe($_POST['user_login']);
            $password = $this->safe($_POST['user_password']);

            $user = App::call()->userRepository->getOneByLogin($login);
            // $user = App::call()->userRepository->getOne($id);

            if ($user) {
                if (password_verify($password, $user['user_password'])) {
                    $_SESSION['isAuth'] = true;
                    $_SESSION['username'] = $user['user_login'];
                    return $this->redirect();
                } else {
                    echo "<script type='text/javascript'>alert('Пароль не верный! Проверьте данные и повторите снова');</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('Логин не верный! Проверьте данные и повторите снова');</script>";
                $_SESSION['isAuth'] = false;
            }
        }
    }

    protected function logout()
    {
        if (isset($_POST['logout'])) {
            session_start();
            session_destroy();
            return $this->redirect();
        }
    }


    public function deleteAction()
    {
        $id = $this->getId();
        $user = App::call()->userRepository->getOne($id);
        App::call()->userRepository->delete($user);
        return $this->redirect();
    }

    public function insertAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $user->user_name = $_POST['user_name'];
            $user->user_login = $_POST['user_login'];
            $user->user_password = $_POST['user_password'];
            $user->user_last_action = $_POST['user_last_action'];
            $user->user_order = serialize($_SESSION); // заказ из корзины строкой уйдет в базу, сможем доставать и пользоваться как решим потом
            $user->user_credit_card = $_POST['user_credit_card'];
            $user->user_address = $_POST['user_address'];
            App::call()->userRepository->save($user);
            return $this->redirect();
        }
        echo $this->render('userInsert', []);
    }
}
