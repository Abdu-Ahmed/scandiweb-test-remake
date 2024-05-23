<?php
namespace App\Models;

use App\Core\Database;

class Product {
    protected $db;
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

    public function __construct(Database $db) {
        $this->db = $db;
    }

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
    public function getProductType() { return $this->product_type; }

    // Setter methods
    public function setId($id) { $this->id = $id; }
    public function setSku($sku) { $this->sku = $sku; }
    public function setName($name) { $this->name = $name; }
    public function setPrice($price) { $this->price = $price; }
    public function setHeight($height) { $this->height = $height; }
    public function setWidth($width) { $this->width = $width; }
    public function setLength($length) { $this->length = $length; }
    public function setSize($size) { $this->size = $size; }
    public function setWeight($weight) { $this->weight = $weight; }
    public function setProductType($product_type) { $this->product_type = $product_type; }

    // Method to insert new product into db
    public function addProduct() {
        $sql = 'INSERT INTO products(sku, name, price, height, width, length, size, weight, product_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute([
            $this->getSku(),
            $this->getName(),
            $this->getPrice(),
            $this->getHeight(),
            $this->getWidth(),
            $this->getLength(),
            $this->getSize(),
            $this->getWeight(),
            $this->getProductType()
        ]);
    }
    // Method to get all products from db (ordered by their id)
    public function getProducts() {
        $sql = 'SELECT * FROM products ORDER BY id ASC;';
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Method to check if sku exists
    public function checkSku($sku) {
        $sql = 'SELECT * FROM products WHERE sku = ?';
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute([$sku]);
        return $stmt->rowCount() > 0 ? false : true;
    }

    // Method to delete a product using the checkbox and the mass delete button
    public function deleteProduct() {
        if (!$this->getId()) {
            // If $id is not set, don't proceed with deletion
            return false;
        }
        $sql = 'DELETE FROM products WHERE id = ?';
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute([$this->getId()]);
    }
}
