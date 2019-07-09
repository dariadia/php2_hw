<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Домашка</title>
</head>

<body>

    <h5>1. Придумать класс, который описывает любую сущность из предметной области интернет-магазинов: продукт, ценник, посылка и т.п.</h5>
    <h5>2. Описать свойства класса из п.1 (состояние).</h5>
    <h5> 3. Описать поведение класса из п.1 (методы).</h5>
    <h5 style="margin-bottom: 50px;"> 4. Придумать наследников класса из п.1. Чем они будут отличаться?</h5>

    <?php
    class Product
    {
        protected $product_id;
        protected $product_name;
        protected $product_price;
        protected $product_description;
        protected $product_pic;
        public $is_available;

        const SHIPPED = true;

        public function __construct($id, $name, $price, $description, $img_src, $available)
        {
            $this->product_id = $id;
            $this->product_price = $price;
            $this->product_name = $name;
            $this->product_description = $description;
            $this->product_pic = $img_src;
            $this->is_available = $available;
        }

        protected function getContents()
        {
            $product_box = <<<php
        <h1 style="color: blue">{$this->product_name}</h1>
        <img height="150px;" src="{$this->product_pic}">
        <h5>Стоит {$this->product_price} kr</h5>
        <p>{$this->product_description}</p>
        <p>есть на складе : {$this->is_available}</p>
php;
            return $product_box;
        }

        protected function isShipped()
        {
            if (Product::SHIPPED) {
                return $shipped = '<p>доставляем в  любой уголок земли</p>';
            } else {
                return $shipped = '<p>придется за ним приехать</p>';
            }
        }
        protected function addToCart(){}
        protected function deleteFromCart(){}

        public function display()
        {
            $product_box = $this->getContents();
            $product_box .= $this->isShipped();
            echo $product_box;
        }
    }

    class Rarity extends Product
    {
        protected $functioning; //этот продукт старинней и может не работать
        protected $can_customize; // этот продукт можно адаптировать 
        protected $customized;

        public function __construct($id, $name, $price, $description, $img_src, $available, $functioning, $customize)
        {
            parent::__construct($id, $name, $price, $description, $img_src, $available);
            $this->functioning = $functioning;
            $this->can_customize = $customize;
        }
        public function customize($color, $bedazzled){ //можно перекрасить
            if ($bedazzled) {
                $bedazzled = 'в блестках';
            }
            echo $this->customized = 'цвет : '.$color.', '.$bedazzled.'<br/>';
        }

        public function display()
        {
            $product_box = $this->getContents();
            $product_box .= $this->isShipped();
            $product_box .= 'все еще работает : '.$this->functioning.'<br/>';
            $product_box .= 'можно кастомизировать : '.$this->can_customize.'<br/>';
            $product_box .= $this->customized;
            echo $product_box;
        }
    }


    $product = new Product(
        1,
        'Телефон',
        100,
        'крутой телефон, навевает воспоминания, вызывает меланхолию',
        'tel.jpg',
        'да'
    );
    $product->display();

    $rare_product = new Rarity(
        2,
        'Телефон для коллекционеров',
        1000,
        'раритет, пострадал в историческом событии',
        'tel.jpg',
        'нет',
        'нет',
        'да'
    );
    $rare_product->display();
    $rare_product->customize('белый', true);

    ?>

<h5> Задания 5 и 6 </h5>
<?php 
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A(); //создан новый экземпляр класса А
$a2 = new A(); //создан еще один новый экземпляр класса А
$a1->foo(); //1, к статичной переменной в классе А сначала +1, потом выводится она
$a2->foo(); //2, так как статичная $x = 1 сохранилась в самом классе А с прошлого действия, +1, и так далее
$a1->foo(); //3
$a2->foo(); //4

echo '</br></br>';

class B extends A {
}
$a1 = new A(); 
$b1 = new B(); //новый экземпляр класса B
$a1->foo();// 5, считает с сохраненной в классе А статичной x=4 из предыдущего задания
$b1->foo(); //1, это уже новый класс B, поэтому статичная переменная в первом вызове 0+1, дальше ведет себя как и А
$a1->foo(); //6
$b1->foo();//2

?>

<h5> Задание 7 </h5>
<?php //я а и б переименовала, чтобы с предыдущими заданиями не путались
class C {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class D extends C {
}
$c1 = new C;// класс может и без скобок указан, но параметров в конструктор мы все равно не передавали. так что все равно ведет себя как раньше. Итого у нас 2 объекта разных классов, у каждого своя статичная x, к ней сначала +1, потом отображается через echo
$d1 = new D;
$c1->foo(); //1
$d1->foo(); //1
$c1->foo(); //2
$d1->foo(); //2
?>

</body>

</html>