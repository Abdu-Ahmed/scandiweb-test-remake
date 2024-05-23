<?php
namespace App\Controllers;

use App\Core\Validator;
use App\Core\Database;
use App\Core\Products;
use App\Models\Product;

class Furniture extends Products {
    protected $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function addProduct($db, $productType) {
        $productModel = new Product($this->db);
        $productModel->setSku($this->getSku());
        $productModel->setName($this->getName());
        $productModel->setPrice($this->getPrice());
        $productModel->setHeight($this->getHeight());
        $productModel->setWidth($this->getWidth());
        $productModel->setLength($this->getLength());
        $productModel->setProductType($productType);
        $productModel->addProduct();
    }
    
    public static function validateAttributes(Validator $validator, array $attributes): bool {
        return $validator->validateInteger($attributes['height']) &&
               $validator->validateInteger($attributes['width']) &&
               $validator->validateInteger($attributes['length']);
    }
    
    public static function displayProductType($product) {
        return [
            'id' => $product['id'],
            'sku' => $product['sku'],
            'name' => $product['name'],
            'price' => $product['price'],
            'height' => $product['height'], 
            'width'  =>  $product['width'], 
            'length' => $product['length']
        ];
    }
}
