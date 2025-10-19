<?php

class Product
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;

        $this->pdo->query('DROP TABLE IF EXISTS product');
        $this->pdo->query("CREATE TABLE product (
                name varchar(255) COLLATE utf8mb4_unicode_ci,
                art varchar(100) COLLATE utf8mb4_unicode_ci,
                price mediumint unsigned NOT NULL COMMENT 'rub',
                quantity tinyint unsigned NOT NULL DEFAULT 0,
                PRIMARY KEY (name, art)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ");
    }

    public function seedTable(string $fileName): void
    {
        $file = fopen($fileName, 'r'); 

        if (!$file) {
            exit("Error opening file.");
        }

        $updated = 0;
        $created = 0;

        $isFirstLine = true;

        try {
            while (($data = fgetcsv($file, separator: ';')) !== FALSE) {
                if ($isFirstLine) {
                    $isFirstLine = false;
                    continue;
                }
                // $this->updateOrCreate($updated, $created, ...$data);
                $this->createOrUpdate($updated, $created, ...$data);
            }
        } catch (Exception $e) {
            echo 'Seed error' . PHP_EOL . $e;
        } 

        fclose($file);

        echo "Created: $created" . PHP_EOL;
        echo "Updated: $updated" . PHP_EOL;
    }

    private function updateOrCreate(
        int &$updated, 
        int &$created, 
        string $name, 
        string $art, 
        int $price, 
        int $quantity
    ): void {
        $query = 'SELECT * FROM `product` WHERE name = :name AND `art` = :art';
        $compArr = compact(['name', 'art']);
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($compArr);
        $row = $stmt->fetch();

        $compArr = compact(['name', 'art', 'price', 'quantity']);
        if ($row) {
            $query = "UPDATE `product` 
                SET price = :price, quantity = :quantity 
                WHERE name = :name 
                AND art = :art";
            $stmt = $this->pdo->prepare($query);
            $rslt = $stmt->execute($compArr);
            if ($rslt) {
                $updated++;
            }
        } else {
            $query = 'INSERT INTO `product` VALUES (:name, :art, :price, :quantity)';
            $stmt = $this->pdo->prepare($query);
            $rslt = $stmt->execute($compArr);
            if ($rslt) {
                $created++;
            }
        }
    }

    private function createOrUpdate(
        int &$updated, 
        int &$created, 
        string $name, 
        string $art, 
        int $price, 
        int $quantity
    ): void {
        $compArr = compact(['name', 'art', 'price', 'quantity']);

        try {
            $query = 'INSERT INTO `product` VALUES (:name, :art, :price, :quantity)';
            $stmt = $this->pdo->prepare($query);
            $rslt = $stmt->execute($compArr);
            if ($rslt) {
                $created++;
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000 && $e->errorInfo[1] == 1062) {   // Duplicate entry
                $query = "UPDATE `product` 
                    SET price = :price, quantity = :quantity 
                    WHERE name = :name 
                    AND art = :art";
                $stmt = $this->pdo->prepare($query);
                $rslt = $stmt->execute($compArr);
                if ($rslt) {
                    $updated++;
                }
            } else {
                echo $e . PHP_EOL;
                exit (1);
            }
        }
    }
}