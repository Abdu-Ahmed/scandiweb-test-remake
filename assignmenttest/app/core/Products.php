<?php
namespace App\Core;

use App\Core\Database;

abstract class Products {
    protected $id;
    protected $sku;
    protected $name;
    protected $price;
    protected $height;
    protected $width;
    protected $length;
    protected $size;
    protected $weight;
    protected $product_type;

    // Getter methods
    public function getId() { return $this->id; }
    public function getSku() { return $this->sku; }
    public function getName() { return $this->name; }
    public function getPrice() { return $this->price; }
    public function getHeight() { return $this->height; }
    public function getWidth() { return $this->width; }
    public function getLength() { return $this->length; }
    public function getSize() { return $this->size; }
    public function getWeight() { return $this->weight; }
    public function getProductType() { return $this->product_type;}

    // Setter methods
    public function setId($id) { $this->id = $id; }
    public function setSku(string $sku) { $this->sku = $sku; }
    public function setName(string $name) { $this->name = $name; }
    public function setPrice(float $price) { $this->price = $price; }
    public function setHeight(int $height) { $this->height = $height; }
    public function setWidth(int $width) { $this->width = $width; }
    public function setLength(int $length) { $this->length = $length; }
    public function setSize($size) { $this->size = $size; }
    public function setWeight($weight) { $this->weight = $weight; }
    public function setProductType($product_type) {
        $this->product_type = $product_type;
    }

    abstract public function addProduct(Database $db, $productType);
    abstract public static function validateAttributes(Validator $validator, array $attributes): bool;
    abstract public static function displayProductType($products);
}
