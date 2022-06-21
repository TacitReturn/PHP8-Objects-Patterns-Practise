<?php
    class StaticExample2
    {
        public static int $aNum = 0;

        public static function sayHello(): void
        {
            self::$aNum;
            print("hello (" . self::$aNum . " )". PHP_EOL)
        }

    }

