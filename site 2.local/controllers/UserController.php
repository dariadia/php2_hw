<?php

namespace App\controllers;

use App\main\App;
use App\models\entities\User;
use App\models\repositories\UserRepository;

class UserController extends Controller
{
    protected $defaultAction = 'login';

    public function userAction()
    {
        $id = $this->getId();
        // $getDate = getdate();
        // $date = $getDate['mday'] . $getDate['mon'];
        $params = [
            //'date' => $date,
            'user' => App::call()->userRepository->getOne($id),
            'auth' => $_SESSION['isAuth'],
            'isAdmin' => $_SESSION['isAdmin']
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

    // отображает форму входа + есть кнопка регистрации
    public function loginAction()
    {
        $params = [
            // здесь пусто: данных о пользователе у нас пока нет
        ];

        echo $this->render('login', $params);
    }

    public function authAction()
    {
        if (!isset($_SESSION['isAuth'])) {
            $_SESSION['username'] = 'guest';
        }
    }

    protected function checkIfAdmin($user)
    {
        if ($user->$user_login === 'admin') return true;
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
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['isAdmin'] = $this->checkIfAdmin($user);
                    if ($_SESSION['isAdmin']) return $this->redirect('/users'); //перенаправляем в админку - тут можно удалять других юзеров, так же сюда можно перейти по ссылке (в шаблоне twig) которая видна только админу
                    return $this->redirect('/good');
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
            return $this->redirect('/good');
        }
    }


    public function deleteAction()
    {
        $id = $this->getId();
        $user = App::call()->userRepository->getOne($id);
        App::call()->userRepository->delete($user);
        return $this->redirect('/good');
    }

    public function insertAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $user->user_name = $_POST['user_name'];
            $user->user_login = $_POST['user_login'];
            $user->user_password = $_POST['user_password'];
            App::call()->userRepository->save($user);
            return $this->redirect(); // вернуть на страницу логина, теперь он может войти
        }
        echo $this->render('userInsert', []);
    }

    public function orderInsertAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['user_address'] && $_POST['user_credit_card']) {
            $user = new User();

            $user->user_login = $_SESSION['username'];
            $user->id = $_SESSION['id'];
            $user->user_order = serialize($_SESSION); // заказ из корзины строкой уйдет в базу, сможем доставать и пользоваться как решим потом

            $user->user_credit_card = $_POST['user_credit_card'];
            $user->user_address = $_POST['user_address'];
            App::call()->userRepository->save($user);
            return $this->redirect('/good');
        }
        echo $this->render('userInsert', []);
    }
}
