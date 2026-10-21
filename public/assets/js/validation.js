/**
 * 🛡️ CLIENT-SIDE VALIDATION & TRANSACTION FORM CONTROLLER (public/assets/js/validation.js)
 */

document.addEventListener("DOMContentLoaded", () => {
    // Select your product input form element from your page layout
    const productForm = document.getElementById("add-product-form");

    if (productForm) {
        console.log("🏁 Product form script listening to active interface fields.");
        
        productForm.addEventListener("submit", async (event) => {
            // Prevent standard browser refreshing actions completely! 
            // We want to handle this behind the scenes using asynchronous requests.
            event.preventDefault();

            // 1. Gather values keyed in by the user from form inputs
            const productName     = document.getElementById("product-name").value.trim();
            const categoryId      = document.getElementById("category-id").value;
            const productPrice    = document.getElementById("product-price").value.trim();
            const productSku      = document.getElementById("product-sku").value.trim();
            const productQuantity = document.getElementById("product-qty").value.trim();
            const productDesc     = document.getElementById("product-desc").value.trim();

            // 2. Fast UI Validation: Intercept raw invalid structural inputs instantly
            if (!productName || !categoryId || !productPrice || !productSku || !productQuantity) {
                alert("⚠️ Validation Error: Please fill in all required parameters.");
                return;
            }

            if (isNaN(productPrice) || parseFloat(productPrice) <= 0) {
                alert("⚠️ Validation Error: Price value must be a valid positive currency decimal.");
                return;
            }

            if (isNaN(productQuantity) || parseInt(productQuantity) < 0) {
                alert("⚠️ Validation Error: Stock quantity must be a non-negative whole integer.");
                return;
            }

            // 3. Package individual metrics neatly into a structural JavaScript dictionary matrix
            const structuredFormData = {
                ProductName: productName,
                CategoryID: parseInt(categoryId),
                Price: parseFloat(productPrice),
                sku: productSku,
                Description: productDesc,
                QuantityInStock: parseInt(productQuantity)
            };

            try {
                // Change UI layout states temporarily to display process status cues
                const submitButton = productForm.querySelector("button[type='submit']");
                if (submitButton) submitButton.textContent = "Saving Record...";

                // 4. Establish an HTTP POST connection directly out to the API router layer path
                const response = await fetch("../../api/products/create.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(structuredFormData) // Flatten payload into an exchangeable text string
                });

                const result = await response.json();

                // Reset the UI button back to normal text layout patterns
                if (submitButton) submitButton.textContent = "Save Product";

                if (result.success) {
                    alert("🎉 " + result.message);
                    productForm.reset(); // Wipe all fields clean automatically
                    
                    // Re-route the view page back to your active data dashboard layout
                    window.location.href = "products.php";
                } else {
                    alert("❌ Operation Denied: " + result.message);
                }

            } catch (error) {
                console.error("❌ Critical runtime transmission network failure:", error);
                alert("⚠️ Connection Failure: Server infrastructure did not respond. Check your XAMPP console status.");
            }
        });
    }
});


// Append this block inside the existing DOMContentLoaded listener in validation.js:

const editProductForm = document.getElementById("edit-product-form");

if (editProductForm) {
    console.log("🏁 Product modifier script tracking editing interface fields.");

    editProductForm.addEventListener("submit", async (event) => {
        event.preventDefault();

        // 1. Collect both fields and the hidden tracker ID matching the targeted product
        const productId       = document.getElementById("edit-product-id").value;
        const productName     = document.getElementById("edit-product-name").value.trim();
        const categoryId      = document.getElementById("edit-category-id").value;
        const productPrice    = document.getElementById("edit-product-price").value.trim();
        const productSku      = document.getElementById("edit-product-sku").value.trim();
        const productQuantity = document.getElementById("edit-product-qty").value.trim();
        const productDesc     = document.getElementById("edit-product-desc").value.trim();

        if (!productName || !categoryId || !productPrice || !productSku || !productQuantity) {
            alert("⚠️ Validation Error: Please fill in all required modifications.");
            return;
        }

        // 2. Package parameters neatly to send to the backend
        const structuredUpdateData = {
            ProductID: parseInt(productId),
            ProductName: productName,
            CategoryID: parseInt(categoryId),
            Price: parseFloat(productPrice),
            sku: productSku,
            Description: productDesc,
            QuantityInStock: parseInt(productQuantity)
        };

        try {
            // 3. Fire HTTP POST connection out to the dedicated update endpoint
            const response = await fetch("../../api/products/update.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(structuredUpdateData)
            });

            const result = await response.json();

            if (result.success) {
                alert("🎉 " + result.message);
                window.location.href = "products.php"; // Redirect back to your spreadsheet table grid view
            } else {
                alert("❌ Operation Denied: " + result.message);
            }
        } catch (error) {
            console.error("❌ Critical update transaction communication failure:", error);
        }
    });
}
