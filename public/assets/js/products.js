/**
 * 📊 INVENTORY DATA RENDERING CONTROLLER (public/assets/js/products.js)
 * 
 * WHAT THIS SCRIPT DOES:
 * 1. Uses the browser's native asynchronous Fetch API to call PHP endpoint.
 * 2. Processes the incoming backend JSON data safely.
 * 3. Dynamically injects structured HTML table body rows onto dashboard screen.
 */

// Execute automatically as soon as the browser finishes loading the structural HTML DOM grid
document.addEventListener("DOMContentLoaded", () => {
    console.log("🏁 Product data interface controller initialized. Fetching streams...");
    loadInventoryTable();
});

/**
 * Asynchronously makes an HTTP request to PHP backend API endpoint
 */
async function loadInventoryTable() {
    // Target the table body container element where  dynamic rows should go
    const tableBody = document.getElementById("product-table-body");
    
    // Safety check: Don't execute if the active page doesn't have the table layout (e.g., on the form pages)
    if (!tableBody) return;

    try {
        // Show a helpful visual status row while waiting for XAMPP to answer
        tableBody.innerHTML = `<tr><td colspan="7" style="text-align: center; color: #94a3b8;">📡 Fetching live storage records...</td></tr>`;

        // 1. Fire an asynchronous HTTP GET request to the exact relative backend API route path
        const response = await fetch("../../api/products/read.php");

        // 2. Transmute the text stream response directly into a readable JavaScript dictionary array object
        const result = await response.json();

        // 3. Fallback protection: If the database block fails internally, throw an operation exception
        if (!result.success) {
            throw new Error(result.message || "Failed to parse system entries.");
        }

        // 4. Verification check: Handle empty inventories gracefully if no rows are returned
        if (result.count === 0) {
            tableBody.innerHTML = `<tr><td colspan="7" style="text-align: center; color: #f59e0b;">📦 Inventory is currently empty. Add a product to get started!</td></tr>`;
            return;
        }

        // 5. Clean out existing placeholders before building new content items
        tableBody.innerHTML = "";

        // 6. Loop over every incoming database product item and map it into structured HTML row cells
        result.data.forEach(product => {
            const row = document.createElement("tr");

            // Format the price securely into standard local decimal currency layout
            const formattedPrice = parseFloat(product.Price).toFixed(2);

            // Structure individual cell tokens to perfectly match case-sensitive schema strings
            row.innerHTML = `
                <td><strong>#${product.ProductID}</strong></td>
                <td>${product.ProductName}</td>
                <td><span class="category-badge">${product.CategoryName}</span></td>
                <td><code>${product.sku}</code></td>
                <td>R ${formattedPrice}</td>
                <td><span class="stock-count">${product.QuantityInStock}</span></td>
                <td>
                    <button class="action-btn edit-btn" onclick="editProduct(${product.ProductID})">✏️ Edit</button>
                    <button class="action-btn delete-btn" onclick="confirmDelete(${product.ProductID})">🗑️ Delete</button>
                </td>
            `;

            // Append the finished node cleanly onto dashboard interface stack
            tableBody.innerHTML += row.outerHTML;
        });

    } catch (error) {
        console.error("❌ Framework Error observed during dynamic data loop assembly:", error);
        tableBody.innerHTML = `<tr><td colspan="7" style="text-align: center; color: #ef4444;">⚠️ Connection Failure: ${error.message}</td></tr>`;
    }
}

// Append this function to the bottom of your existing public/assets/js/products.js script:

/**
 * Intercepts user delete confirmation actions and passes operational requests to the API router layer
 * @param {number} targetedProductId - The explicit case-sensitive database index key tracking ID
 */
async function confirmDelete(targetedProductId) {
    // Native browser window modal logic to avoid accidental clicks
    const processDeletionConfirmation = confirm(`⚠️ Are you completely sure you want to permanently delete Product #${targetedProductId} from your active warehouse ledger?`);
    
    if (!processDeletionConfirmation) {
        console.log("🛡️ Delete action aborted securely by user request.");
        return; 
    }

    try {
        console.log(`🧹 Processing deletion request sequence for Product #${targetedProductId}...`);

        // 1. Establish connection out to your brand new backend API deletion layer script route
        const response = await fetch("../../api/products/delete.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ ProductID: parseInt(targetedProductId) }) // Map attributes securely into a JSON payload data string
        });

        const result = await response.json();

        if (result.success) {
            alert("🧹 " + result.message);
            // 2. Automatically refresh the visual data table to immediately remove the item record from view
            loadInventoryTable(); 
        } else {
            alert("❌ Operation Denied: " + result.message);
        }

    } catch (error) {
        console.error("❌ Critical transactional runtime transmission error observed:", error);
        alert("⚠️ Connection Failure: Server infrastructure did not respond. Check your XAMPP console status.");
    }
}

/**
 * 📊 INVENTORY DATA RENDERING & FILTER CONTROLLER (public/assets/js/products.js)
 */

document.addEventListener("DOMContentLoaded", () => {
    console.log("🏁 Product dashboard system ready.");
    loadCategoryFilterDropdown(); // Load category options into filter boxes dynamically
    loadInventoryTable("");        // Fetch and show all items on start up
    
    // Setup event listener to catch dropdown selector shifts
    const dynamicFilterDropdown = document.getElementById("category-filter");
    if (dynamicFilterDropdown) {
        dynamicFilterDropdown.addEventListener("change", (e) => {
            const chosenCategoryName = e.target.value;
            console.log(`🔍 Filtering view timeline exclusively for: "${chosenCategoryName}"`);
            loadInventoryTable(chosenCategoryName);
        });
    }
});

/**
 * Loads backend category records directly into the UI selection filter element
 */
async function loadCategoryFilterDropdown() {
    const filterBox = document.getElementById("category-filter");
    if (!filterBox) return;

    try {
        const response = await fetch("../../api/categories/read.php");
        const result = await response.json();

        if (result.success) {
            // Keep the base 'All Categories' option active
            filterBox.innerHTML = `<option value="">📁 All Categories</option>`;
            result.data.forEach(category => {
                filterBox.innerHTML += `<option value="${category.CategoryName}">${category.CategoryName}</option>`;
            });
        }
    } catch (err) {
        console.error("❌ Failed to populate category filtering nodes:", err);
    }
}

/**
 * Asynchronously pulls inventory rows and renders them with optional category string matching filtering
 * @param {string} filterTerm - The textual category name string to check matches against
 */
async function loadInventoryTable(filterTerm = "") {
    const tableBody = document.getElementById("product-table-body");
    if (!tableBody) return;

    try {
        tableBody.innerHTML = `<tr><td colspan="7" style="text-align: center; color: #94a3b8;">📡 Fetching live storage records...</td></tr>`;

        const response = await fetch("../../api/products/read.php");
        const result = await response.json();

        if (!result.success) throw new Error(result.message);

        // Filter the array data locally based on user choice if a specific selection was checked
        const processedItemsList = filterTerm === "" 
            ? result.data 
            : result.data.filter(item => item.CategoryName === filterTerm);

        if (processedItemsList.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="7" style="text-align: center; color: #f59e0b;">📦 No active items found matching current filter scope.</td></tr>`;
            return;
        }

        tableBody.innerHTML = "";

        processedItemsList.forEach(product => {
            const row = document.createElement("tr");
            const formattedPrice = parseFloat(product.Price).toFixed(2);

            row.innerHTML = `
                <td><strong>#${product.ProductID}</strong></td>
                <td>${product.ProductName}</td>
                <td><span class="category-badge">${product.CategoryName}</span></td>
                <td><code>${product.sku}</code></td>
                <td>R ${formattedPrice}</td>
                <td><span class="stock-count">${product.QuantityInStock}</span></td>
                <td>
                    <button class="action-btn edit-btn" onclick="editProduct(${product.ProductID})">✏️ Edit</button>
                    <button class="action-btn delete-btn" onclick="confirmDelete(${product.ProductID})">🗑️ Delete</button>
                </td>
            `;
            tableBody.appendChild(row);
        });

    } catch (error) {
        console.error("❌ Renderer Failure:", error);
        tableBody.innerHTML = `<tr><td colspan="7" style="text-align: center; color: #ef4444;">⚠️ Connection Failure: ${error.message}</td></tr>`;
    }
}
