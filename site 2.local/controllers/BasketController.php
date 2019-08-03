<?php

namespace App\controllers;

use App\models\repositories\GoodRepository;

class BasketController extends Controller
{
    const GOODS = 'goods';

    protected $defaultAction = 'index';

    public function addBasketAction()
    {
        $id = $this->getId();
        if (empty($id)) {
            return $this->redirect();
        }
        $good = (new GoodRepository())->getOne($id);
        if (empty($good)) {
            return $this->redirect();
        }

        $goods = $this->request->getSession(self::GOODS);
        if (array_key_exists($id, $goods)) {
            $goods[$id]['count']++;
        } else {
            $goods[$id] = [
                'name' => $good->name,
                'price' => $good->price,
                'count' => 1,
            ];
        }

        $this->request->setSession(self::GOODS, $goods);
        return $this->redirect();
    }

    public function updateBasketAction()
    {
        $id = $this->getId();
        $goods = $this->request->getSession(self::GOODS);
        if (array_key_exists($id, $goods)) {
            $goods[$id]['count'] = $_POST['count'];
        }
        $this->request->setSession(self::GOODS, $goods);
        return $this->redirect('/user/insert');
    }

    // из массива масисов делаем массив объектов чтобы выводить как товары и юзеров в твиге
    public function convertBasketSession()
    {
        $session_basket = array();
        $this_session = $_SESSION;
        foreach ($this_session as $to_obj) {
            $session_basket[] = (object) $to_obj;
        }
        return $session_basket;
    }

    public function indexAction()
    {
        //var_dump($_SESSION);

        $params = [
            'basket' =>  $this->convertBasketSession() // приходит массив объектов, загоняем его ф шаблон
        ];
        echo $this->render('basket', $params);
    }
}
