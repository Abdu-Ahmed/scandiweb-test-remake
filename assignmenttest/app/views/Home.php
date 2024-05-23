<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <header class="d-flex justify-content-between align-items-center pb-3 border-bottom mb-4">
            <h1 class="mb-0">Product List</h1>
            <div>
                <form id="delete-form" action="<?php echo BASE_URL; ?>/delete" method="POST" class="d-inline">
                    <a href="<?php echo BASE_URL; ?>/add" id="add" class="add btn btn-primary me-2">ADD</a>
                    <button id="delete-product-btn" type="submit" class="btn btn-danger">MASS DELETE</button>
            </div>
        </header>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <!-- DVD Products -->
            <?php $dvdProducts = $this->displayProductsByType('DVD'); ?>
            <?php foreach ($dvdProducts as $product): ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <input class="delete-checkbox form-check-input" type="checkbox" name="product_ids[]" value="<?php echo $product['id']; ?>">
                            <h5 class="card-title text-center"><?php echo ($product['name']); ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted text-center">SKU: <?php echo ($product['sku']); ?></h6>
                            <p class="card-text text-center"><?php echo ($product['price']); ?>$</p>
                            <p class="card-text text-center">Size: <?php echo ($product['size']); ?> MB</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Book Products -->
            <?php $bookProducts = $this->displayProductsByType('Book'); ?>
            <?php foreach ($bookProducts as $product): ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <input class="delete-checkbox form-check-input" type="checkbox" name="product_ids[]" value="<?php echo $product['id']; ?>">
                            <h5 class="card-title text-center"><?php echo ($product['name']); ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted text-center">SKU: <?php echo ($product['sku']); ?></h6>
                            <p class="card-text text-center"><?php echo ($product['price']); ?>$</p>
                            <p class="card-text text-center">Weight: <?php echo ($product['weight']); ?> KG</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Furniture Products -->
            <?php $furnitureProducts = $this->displayProductsByType('Furniture'); ?>
            <?php foreach ($furnitureProducts as $product): ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <input class="delete-checkbox form-check-input" type="checkbox" name="product_ids[]" value="<?php echo $product['id']; ?>">
                            <h5 class="card-title text-center"><?php echo ($product['name']); ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted text-center">SKU: <?php echo ($product['sku']); ?></h6>
                            <p class="card-text text-center"><?php echo ($product['price']); ?>$</p>
                            <p class="card-text text-center">Dimensions: <?php echo $product['height'] . 'x' . $product['width'] . 'x' . $product['length'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
     </form>
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
