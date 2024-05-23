<?php

namespace App\Core;
use App\Core\Database;
class Controller
{
    protected $db;
    public function __construct(Database $db) {
        $this->db = $db;
    }

    protected function model($model) 
    {
        $modelClass = 'App\\Models\\' . $model;
        if (class_exists($modelClass)) {
            return new $modelClass($this->db); // Pass the database instance to the model constructor
        } else {
            throw new \Exception("Model '$modelClass' not found.");
        }
    }

    protected function view($view, $data = []) 
    {
        $viewFile = __DIR__ . "/../views/{$view}.php";
        if (file_exists($viewFile)) {
            extract($data);
            require $viewFile;
        } else {
            throw new \Exception("View file '$viewFile' not found.");
        }
    }
    protected function handlePostRequest($modelMethod, $requestData) 
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $product = $this->model('Product');
            if (method_exists($product, $modelMethod)) {
                // Call the specified method in the product model with the provided data
                call_user_func_array([$product, $modelMethod], $requestData);
            } else {
                throw new \Exception("Method '$modelMethod' not found in product model.");
            }
        }
    }
}
