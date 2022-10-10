<?php

use App\Chapter3\BookProduct;
use App\Chapter3\CdProduct;
use App\Chapter3\ShopProduct;

    class StaticExample2
    {
        public static int $aNum = 0;

        public static function sayHello(): void
        {
            self::$aNum;
            print("hello (" . self::$aNum . ")". PHP_EOL);
        }
    }

