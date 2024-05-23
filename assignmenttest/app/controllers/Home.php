<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;

class Home extends Controller {
    protected $product;

    public function __construct($db) {
        parent::__construct($db);
        $this->product = new Product($this->db);
    }

    public function index() {
        $products = $this->product->getProducts();
        $this->view('Home', ['products' => $products]);
    }

    public function displayProductsByType($type) {
        $products = $this->product->getProducts();
        $filteredProducts = [];

        foreach ($products as $product) {
            if ($product['product_type'] === $type) {
                $class = "App\\Controllers\\$type";
                if (class_exists($class) && method_exists($class, 'displayProductType')) {
                    $filteredProduct = $class::displayProductType($product);
                    if ($filteredProduct && !in_array($filteredProduct, $filteredProducts)) {
                        $filteredProducts[] = $filteredProduct;
                    }
                }
            }
        }

        return $filteredProducts;
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productIds = $_POST['product_ids'] ?? [];
            foreach ($productIds as $id) {
                $product = new Product($this->db);
                $product->setId($id);
                $product->deleteProduct();
            }
        }
    
        header("Location: " . BASE_URL . "/home");
        exit;
    }
}
