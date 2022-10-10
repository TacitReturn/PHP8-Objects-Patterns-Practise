<?php

    namespace App\Chapter3;

    use JetBrains\PhpStorm\Pure;
    use PDO;

    class ShopProduct
    {
        private int $id = 0;

        private int|float $discount = 0;

        public const AVAILABLE = 0;
        public const OUT_OF_STOCK = 1;

        public function __construct(
            private string $title,
            private string $producerFirstName,
            private string $producerMainName,
            protected int|float $price
        ) {
        }

        public function __toString()
        {
            $str = "Title: {$this->title}".PHP_EOL;
            $str .= "First Name: {$this->producerFirstName}".PHP_EOL;
            $str .= "Main Name: {$this->producerMainName}".PHP_EOL;

            return $str;
        }

        public function setID(int $id): void
        {
            $this->id = $id;
        }

        public static function getInstance(int $id, \PDO $pdo)
        {
            if (!$id) {
                return "This item doesn't exist in the database";
            }

            $statement = $pdo->prepare("SELECT * FROM products WHERE id =?");
            $result = $statement->execute([$id]);
            $row = $statement->fetch();
            if (empty($row)) {
                return null;
            }

            if ($row["type"] == "book") {
                $product = new BookProduct(
                    $row["title"],
                    $row["firstname"],
                    $row["mainname"],
                    (float) $row["price"],
                    (int) $row["numpages"],
                );
            } elseif ($row["type"] == "cd") {
                $product = new CdProduct(
                    $row["title"],
                    $row["firstname"],
                    $row["mainname"],
                    (float) $row["price"],
                    (int) $row["playlength"],
                );
            } else {
                $firstname = (is_null($row["firstname"])) ? "" :
                    $row["firstname"];
                $product = new ShopProduct(
                    $row["title"],
                    $firstname,
                    $row["mainname"],
                    (float) $row["price"],
                );
            }

            $product->setID((int) $row["id"]);
            $product->setDiscount((int) $row["discount"]);

            return $product;
        }

        public function getProducerFirstName(): string
        {
            return $this->producerFirstName;
        }

        public function getProducerMainName(): string
        {
            return $this->producerMainName;
        }

        public function setDiscount(int|float $num): void
        {
            $this->discount = $num;
        }

        public function getDiscount(): int
        {
            return $this->discount;
        }

        public function getTitle(): string
        {
            return $this->title;
        }

        public function getPrice(): int|float
        {
            return ($this->price - $this->discount);
        }

        public function getProducer(): string
        {
            return "{$this->producerFirstName} {$this->producerMainName}";
        }

        public function getSummaryLine(): string
        {
            $base = "{$this->title} ({$this->producerMainName}, ";
            $base .= "{$this->producerFirstName} )";
            return $base;
        }
    }

    class CdProduct extends ShopProduct
    {
        public function __construct(
            string $title,
            string $firstName,
            string $mainName,
            int|float $price,
            private int $playLength
        ) {
            parent::__construct($title, $firstName, $mainName, $price);

            $this->playLength = $playLength;
        }

        public function getPlayLength(): int
        {
            return $this->playLength;
        }

        public function getSummaryLine(): string
        {
            $base = parent::getSummaryLine();
            $base .= "play length - $this->playLength";

            return $base;
        }
    }

    class BookProduct extends ShopProduct
    {
        #[Pure]
        public function __construct(
            string $title,
            string $firstName,
            string $mainName,
            int|float $price,
            private int $numPages
        ) {
            parent::__construct($title, $firstName, $mainName, $price);

            $this->numPages = $numPages;
        }

        public function getNumberOfPages(): int
        {
            return $this->numPages;
        }

        public function getSummaryLine(): string
        {
            $base = parent::getSummaryLine();
            $base .= ": page count - {$this->numPages}";

            return $base;
        }

        public function getPrice(): int|float
        {
            return $this->price;
        }

    }

    abstract class ShopProductWriter
    {
        protected array $products = [];

        public function addProduct(ShopProduct $shopProduct): void
        {
            $this->products[] = $shopProduct;
        }

//        public function write(): void
//        {
//            $str = "";
//
//            foreach ($this->products as $shopProduct) {
//                $str .= "{$shopProduct->getTitle()}: ";
//                $str .= "{$shopProduct->getProducer()} ";
//                $str .= "{$shopProduct->getPrice()} \n";
//            }
//
//            print $str;
//        }

        abstract public function write(): void;
    }

    class XmlProductWriter extends ShopProductWriter
    {
        public function write(): void
        {
            $writer = new \XMLWriter();
            $writer->openMemory();
        }
    }

    $host = "127.0.0.1";
    $db = "PHP8Objects";
    $user = "root";
    $pass = "root";
    $charset = "utf8mb4";

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $pdo = new \PDO($dsn, $user, $pass, $options);
        echo "Connected to database successfully..";
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }

    $obj = ShopProduct::getInstance(1, $pdo);




