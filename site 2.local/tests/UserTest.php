<?php

namespace App\tests;


use App\models\entities\User;
use App\services\StringService;
use PHPUnit\Framework\TestCase;


class UserTest extends TestCase
{
    // проверяет что пользователь где то живет :)
    public function testIsValidAddress(string $address)
    {
        if (!filter_var(
            $address,
            FILTER_VALIDATE_REGEXP,
            array(
                "options" => array("regexp" => "'/[a-zA-Z\s]/'")
            )
        )) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" это недопустимый адрес',
                    $address
                )
            );
        }
    }

    // например логин должен быть 1-99 знаков, проверим так ли
    public function testIsValidLogin(string $login)
    {
        $this->assertGreaterThan(0, strlen($login));
        $this->assertLessThan(“100”, $login);
    }

    // пройдена ли аутентификация
    public function testAuthFailure(bolean $isAuth)
    {
        $this->assertTrue($isAuth);
    }

    // проверим вот это $_SESSION['isAdmin'] = $this->checkIfAdmin($user); т е админ ли вошел в акк
    public function testIsAdmin($loginStatus)
    {
        $this->assertArrayHasKey($loginStatus, $_SESSION);
    }


    // public function testPrivateProperty()
    // {
    //     $reflectionUsers = new \ReflectionClass(User::class);
    //     $reflectionNewUser = $reflectionUsers->getProperty('id');

    //     $user = new User();
    //     $reflectionNewUser->setAccessible(true);
    //     $reflectionNewUser->setValue($user, 'TestId');
    //     $this->assertEquals('TestId', $user->getOne());

    //     $reflectionMethod = $reflectionUsers->getMethod('getAnother');
    //     $reflectionMethod->setAccessible(true);

    //     echo $reflectionMethod->invoke($user, '3');
    // }
}
