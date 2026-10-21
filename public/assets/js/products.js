/**
 * 📊 INVENTORY DATA RENDERING & PILL FILTER CONTROLLER (public/assets/js/products.js)
 */

let globalInventoryData = []; // Store products cache locally for rapid calculations

document.addEventListener("DOMContentLoaded", () => {
    console.log("🏁 Product pipeline dashboard initialized.");
    initializeDashboardEngine();
});

async function initializeDashboardEngine() {
    await fetchMasterInventory(); // 1. Pull products first to count items per category
    await buildCategoryPipeline(); // 2. Generate the visual card row
    renderInventoryTable("");      // 3. Show all items initially
}

/**
 * Pulls master product records from the PHP API backend channel
 */
async function fetchMasterInventory() {
    try {
        const response = await fetch("../../api/products/read.php");
        const result = await response.json();
        if (result.success) {
            globalInventoryData = result.data;
        }
    } catch (err) {
        console.error("❌ Failed to parse data streams:", err);
    }
}

/**
 * Builds the interactive InsuredMine style card filter row dynamically
 */
async function buildCategoryPipeline() {
    const pillsRow = document.getElementById("category-pills-row");
    if (!pillsRow) return;

    try {
        const response = await fetch("../../api/categories/read.php");
        const result = await response.json();

        if (result.success) {
            pillsRow.innerHTML = "";

            // Create the initial "All Categories" master card pill
            const allPill = document.createElement("button");
            allPill.className = "category-pill active-pill";
            allPill.innerHTML = `📁 All <span class="pill-count">${globalInventoryData.length}</span>`;
            allPill.addEventListener("click", (e) => switchActiveFilter(e, ""));
            pillsRow.appendChild(allPill);

            // Loop over categories and count active product rows inside each
            result.data.forEach(category => {
                const itemCount = globalInventoryData.filter(item => item.CategoryName === category.CategoryName).length;
                
                const pill = document.createElement("button");
                pill.className = "category-pill";
                pill.innerHTML = `${category.CategoryName} <span class="pill-count">${itemCount}</span>`;
                
                // Clicking filters table rows immediately
                pill.addEventListener("click", (e) => switchActiveFilter(e, category.CategoryName));
                pillsRow.appendChild(pill);
            });
        }
    } catch (err) {
        console.error("❌ Failed rendering pipeline pills:", err);
    }
}

/**
 * Manages active card selection highlights and triggers table rendering reloads
 */
function switchActiveFilter(event, categoryName) {
    // Clear the active highlight styles off all pills in the container row
    document.querySelectorAll(".category-pill").forEach(p => p.classList.remove("active-pill"));
    
    // Add the active color class onto the clicked target element
    const clickedPill = event.target.closest(".category-pill");
    if (clickedPill) clickedPill.classList.add("active-pill");

    renderInventoryTable(categoryName);
}

/**
 * Renders inventory table spreadsheet data rows based on card selection matches
 */
function renderInventoryTable(categoryFilter = "") {
    const tableBody = document.getElementById("product-table-body");
    if (!tableBody) return;

    // Filter list cache locally based on chosen string parameter
    const displayedItems = categoryFilter === "" 
        ? globalInventoryData 
        : globalInventoryData.filter(item => item.CategoryName === categoryFilter);

    if (displayedItems.length === 0) {
        tableBody.innerHTML = `<tr><td colspan="7" style="text-align: center; padding: 30px; color: #64748b;">📦 No inventory products matching this pipeline.</td></tr>`;
        return;
    }

    tableBody.innerHTML = "";

    displayedItems.forEach(product => {
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
                <button class="action-btn" onclick="window.location.href='edit-product.php?id=${product.ProductID}'">✏️ Edit</button>
                <button class="action-btn" onclick="confirmDelete(${product.ProductID})">🗑️ Delete</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}
