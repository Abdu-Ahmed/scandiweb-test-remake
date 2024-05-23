document.addEventListener("DOMContentLoaded", function () {
    const productTypeSelect = document.getElementById("productType");
    const productFields = document.querySelectorAll("[id$='Field']");

    // Object mapping product types to their corresponding field IDs
    const productFieldMap = {
        "DVD": "DVDField",
        "Furniture": "FurnitureField",
        "Book": "BookField"
    };

    // Function to show selected product's fields and hide others
    function updateProductFields() {
        const selectedOption = productTypeSelect.options[productTypeSelect.selectedIndex];
        const selectedFieldsId = productFieldMap[selectedOption.value];

        // Hide all product fields
        productFields.forEach(field => {
            field.style.display = "none";
        });

        // Show fields for the selected product type
        if (selectedFieldsId) {
            document.getElementById(selectedFieldsId).style.display = "block";
        }
    }

    // Initial call to update fields on page load
    updateProductFields();

    // Event listener for product type change
    productTypeSelect.addEventListener("change", updateProductFields);
});