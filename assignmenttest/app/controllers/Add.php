<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Validator;
use App\Core\Database;

class Add extends Controller {
    public function index() {
        $error = isset($_GET['error']);
        $invalidSku = isset($_GET['invalidsku']);
        $emptyFields = isset($_GET['emptyfields']);
        $message = null;

        if ($error) {
            $message = Validator::VALIDATION_MESSAGE;
        } elseif ($invalidSku) {
            $message = "SKU already exists!";
        } elseif ($emptyFields) {
            $message = Validator::EMPTY_FIELD_MESSAGE;
        }

        $this->view('Add', ['message' => $message]);
    }

    public function save() {
        $validator = new Validator;
        $postData = $_POST ?? [];

        // check if sku already exists
        $product = new \App\Models\Product(new Database());
        if (!$product->checkSku($postData['sku'])) {
            header("Location:" . BASE_URL . "/add?invalidsku");
            exit();
        }

        // Validate common fields
        $errors = [];
        $emptyErrors = [];
        if (!$validator->validateNotEmpty($postData['sku'])) {
            $emptyErrors[] = Validator::EMPTY_FIELD_MESSAGE;
        }
        if (!$validator->validateNotEmpty($postData['name'])) {
            $emptyErrors[] = Validator::EMPTY_FIELD_MESSAGE;
        }
        if (!$validator->validateNotEmpty($postData['price'])) {
            $emptyErrors[] = Validator::EMPTY_FIELD_MESSAGE;
        }

        // If there are any empty field errors, redirect back to the add form with empty field error message
        if (!empty($emptyErrors)) {
            header("Location:" . BASE_URL . "/add?emptyfields");
            exit();
        }

        // Validate specific attributes based on product type
        $specificAttributesMap = [
            'DVD' => ['size'],
            'Book' => ['weight'],
            'Furniture' => ['height', 'width', 'length']
        ];

        $productType = $postData['productType'];
        $specificAttributes = array_intersect_key($postData, array_flip($specificAttributesMap[$productType] ?? []));

        // Create an instance of the corresponding product class based on the selected type
        $productClass = "\\App\\Controllers\\$productType";
        if (!class_exists($productClass)) {
            echo "Invalid product type.";
            exit();
        }

        // Instantiate the product class
        $product = new $productClass(new Database());

        // Set common attributes
        $product->setSku($postData['sku']);
        $product->setName($postData['name']);
        $product->setPrice($postData['price']);
        $product->setProductType($productType); // Set product_type dynamically

       // Set specific attributes and validate them
        foreach ($specificAttributes as $attribute => $value) {
            $setterMethod = 'set' . ucfirst($attribute);
            if (method_exists($product, $setterMethod)) {
                $product->$setterMethod($value);
            }
            if (!$validator->validateInteger($value)) {
                $errors[] = Validator::VALIDATION_MESSAGE;
            }
        }

        // Perform validation
        if (!$productClass::validateAttributes($validator, $specificAttributes)) {
            $errors[] = Validator::VALIDATION_MESSAGE;
        }

        // If there are any validation errors, redirect back to the add form with error message
        if (!empty($errors)) {
            header("Location:" . BASE_URL . "/add?error");
            exit();
        }

        // Add the product to the database
        $product->addProduct($this->db, $productType);

        // Redirect to the home page after adding the product
        header("Location:" . BASE_URL . "/home");
        exit();
    }
}