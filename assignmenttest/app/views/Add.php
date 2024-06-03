<?php error_reporting(E_ALL); ini_set('display_errors', 1); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <!-- TypeSwitcher JS -->
    <script src="../public/assets/js/TypeSwitcher.js" defer></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
    <header class="d-flex justify-content-between align-items-center pb-5 border-bottom mb-4">
    <div class="container">
        <form id="product_form" action="<?php echo BASE_URL; ?>/save" method="POST">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="mb-0">Add Product</h1>
                <div>
                    <button type="submit" class="btn btn-primary me-2">Save</button>
                    <a href="<?php echo BASE_URL; ?>/home" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
    </div>
    </header>
            <?php if (!empty($message)): ?>
                <div class="alert alert-danger" role="alert">
                    <p><?php echo htmlspecialchars($message); ?></p>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" class="form-control w-25" id="sku" name="sku" value="<?php echo htmlspecialchars($postData['sku'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control w-25" id="name" name="name" value="<?php echo htmlspecialchars($postData['name'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control w-25" id="price" name="price" value="<?php echo htmlspecialchars($postData['price'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="productType" class="form-label">Product Type</label>
                <select class="form-select w-25" id="productType" name="productType">
                    <option value="" data-fields="" selected>Select a product type</option>
                    <option value="DVD" data-fields="DVDField" <?php echo (isset($postData['productType']) && $postData['productType'] == 'DVD') ? 'selected' : ''; ?>>DVD</option>
                    <option value="Furniture" data-fields="FurnitureField" <?php echo (isset($postData['productType']) && $postData['productType'] == 'Furniture') ? 'selected' : ''; ?>>Furniture</option>
                    <option value="Book" data-fields="BookField" <?php echo (isset($postData['productType']) && $postData['productType'] == 'Book') ? 'selected' : ''; ?>>Book</option>
                </select>
            </div>
            <!-- DVD Size Input -->
            <div id="DVDField" style="display: none;">
                <label for="size" class="form-label">Please provide DVD Size:</label>
                <input type="text" class="form-control w-25" id="size" name="size" placeholder="Size (MB)" value="<?php echo htmlspecialchars($postData['size'] ?? ''); ?>">
            </div>
            <!-- Book Weight Input -->
            <div id="BookField" style="display: none;">
                <label for="weight" class="form-label">Please provide book weight:</label>
                <input type="text" class="form-control w-25" id="weight" name="weight" placeholder="Weight (KG)" value="<?php echo htmlspecialchars($postData['weight'] ?? ''); ?>">
            </div>
            <!-- Furniture Dimensions Inputs -->
            <div id="FurnitureField" style="display: none;">
            <label for="length" class="form-label">Please, provide furniture dimensions:</label>
                <input type="text" class="form-control w-25" id="height" name="height" placeholder="Height (CM)" value="<?php echo htmlspecialchars($postData['height'] ?? ''); ?>"><br>
                <input type="text" class="form-control w-25" id="width" name="width" placeholder="Width (CM)" value="<?php echo htmlspecialchars($postData['width'] ?? ''); ?>"><br>
                <input type="text" class="form-control w-25" id="length" name="length" placeholder="Length (CM)" value="<?php echo htmlspecialchars($postData['length'] ?? ''); ?>">
            </div>
        </form>
    </div>
    <footer class="fixed-bottom">
        <div class="container">
            <div class="border-top pt-3 py-5">
                <div class="container text-center">
                    <span>Scandiweb test assignment</span>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
