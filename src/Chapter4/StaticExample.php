<?php
    /*
    * StaticExample.php
    * PHP8ObjectsPatternsPractise
    * Created: 06, 07 2022
    *@author Glenn G. Rudge <glenn@hyperwebdev.com>
    *@package
    */

    namespace App\Chapter4;

    class StaticExample
    {
        public static int $aNum = 0;

        public static function sayHello(): void
        {
            print "hello";
        }
    }

    class StaticExample2
    {
        public static int $aNum = 0;

        public static function sayHello(): void
        {
            self::$aNum++;

            print("hello (" . self::$aNum . ")\n");
        }
    }

    $staticExample = new StaticExample();

    $staticExample2 = new StaticExample2();

    $staticExample2::$aNum;

    $staticExample2::sayHello();
    $staticExample2::sayHello();
    $staticExample2::sayHello();
