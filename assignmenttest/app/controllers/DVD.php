<?php
namespace App\Controllers;

use App\Core\Database;
use App\Core\Products;
use App\Core\Validator;
use App\Models\Product;

class DVD extends Products {
    protected $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function addProduct($db, $productType) {
        $productModel = new Product($this->db);
        $productModel->setSku($this->getSku());
        $productModel->setName($this->getName());
        $productModel->setPrice($this->getPrice());
        $productModel->setSize($this->getSize());
        $productModel->setProductType($productType);
        $productModel->addProduct();
    }
    
    public static function validateAttributes(Validator $validator, array $attributes): bool {
        return $validator->validateInteger($attributes['size']);
    }
    
    public static function displayProductType($product) {
        return [
            'id' => $product['id'],
            'sku' => $product['sku'],
            'name' => $product['name'],
            'price' => $product['price'],
            'size' => $product['size']
        ];
    }
}
