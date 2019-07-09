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


        public function display()
        {
            $product_box = $this->getContents();
            $product_box .= $this->isShipped();
            echo $product_box;
        }
    }

    class Rarity extends Product
    {
        protected $functioning;

        public function __construct($id, $name, $price, $description, $img_src, $available, $functioning)
        {
            parent::__construct($id, $name, $price, $description, $img_src, $available);
            $this->functioning = $functioning;
        }

        public function display()
        {
            $product_box = $this->getContents();
            $product_box .= $this->isShipped();
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
        'нет'
    );
    $rare_product->display();




    ?>


</body>

</html>