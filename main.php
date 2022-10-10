<?php
    /*
    * main.php
    * PHP8ObjectsPatternsPractise
    * Created: 06, 07 2022
    *@author Glenn G. Rudge <glenn@hyperwebdev.com>
    *@package
    */

    require "vendor/autoload.php";

    use App\Chapter3\BookProduct;
    use App\Chapter3\CdProduct;
    use App\Chapter3\ShopProduct;
    use App\Chapter3\ShopProductWriter;
    use App\Chapter4\StaticExample;
    use App\Chapter4\StaticExample2;

    $newShopProduct = new ShopProduct("title", "producer first name", "producer main name", 100.75);

    $writer = new ShopProductWriter();

    $writer->addProduct($newShopProduct);

    print(PHP_EOL);

    $newCDProduct = new CdProduct("Exile On Coldharbour Lane", "The", "Alabama 3", 10.99, 55.00);

    print(PHP_EOL);

    $writer->addProduct($newCDProduct);

    $writer->write();

    $product5 = new CdProduct("Lorem Ipsum Band", "The", "Alabama 3", 12.99, 100.75);

    $newBookProduct = new BookProduct("Catcher In The Rye", "JD", "Salanger", 25.75, 375);

    print \App\Chapter4\StaticExample::$aNum;
    echo PHP_EOL;

    // echo StaticExample::sayHello() . PHP_EOL;
    echo StaticExample2::sayHello() . PHP_EOL;

    try {
        $user = "root";
        $pass = "root";
        $pdo = new PDO('mysql:host=localhost;dbname=PHP8Objects', $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        print "Database connected.." . PHP_EOL;

        $obj = ShopProduct::getInstance(2, $pdo);

        print $obj;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . PHP_EOL;
    }


    