<?php
namespace App\Controllers;

use App\Core\Database;
use App\Core\Products;
use App\Core\Validator;
use App\Models\Product;

class Book extends Products {
    protected $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function addProduct($db, $productType) {
        $productModel = new Product($this->db);
        $productModel->setSku($this->getSku());
        $productModel->setName($this->getName());
        $productModel->setPrice($this->getPrice());
        $productModel->setWeight($this->getWeight());
        $productModel->setProductType($productType);
        $productModel->addProduct();
    }
    
    public static function validateAttributes(Validator $validator, array $attributes): bool {
        return $validator->validateInteger($attributes['weight']);
    }
    
    public static function displayProductType($product) {
        return [
            'id' => $product['id'],
            'sku' => $product['sku'],
            'name' => $product['name'],
            'price' => $product['price'],
            'weight' => $product['weight'],
        ];
    }
}
