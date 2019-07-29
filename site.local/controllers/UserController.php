<?php

namespace App\controllers;

use App\models\entities\User;
use App\models\repositories\UserRepository;

class UserController extends Controller
{
    protected $defaultAction = 'users';

    public function userAction()
    {
        //        $id = $this->request->get(); // array
        //        $id = $this->request->post(); // array
        //        $id = $this->request->get('id'); // string|null
        //        $id = $this->request->post('id');// string|null

        $id = $this->getId();
        //$date = '20019-12-12';
        $params = [
            //'date' => $date,
            'user' => (new UserRepository())->getOne($id)
        ];

        echo $this->render('user', $params);
    }

    public function usersAction()
    {
        $params = [
            'users' => (new UserRepository())->getAll()
        ];

        echo $this->render('users', $params);
    }

    public function deleteAction()
    {
        $id = $this->getId();
        $userRepository = new UserRepository();
        $user = $userRepository->getOne($id);
        $userRepository->delete($user);
        header('Location: users');
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
            header('Location: users');
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
            header('Location: users');
            exit;
        }
        //echo $this->render('userUpdate', []);
    }
}
